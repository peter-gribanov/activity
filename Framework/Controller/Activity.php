<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Controller;

use Framework\Controller\Controller;
use Framework\Model\Users;
use Framework\Http\Redirection\Found;
use Framework\Http\ClientError\NotFound;
use Framework\Model\CurrentUser;

/**
 * Управление мероприятиями
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Activity extends Controller {

	/**
	 * Список мероприятий
	 *
	 * @return array
	 */
	public function listAction() {
		$current_user = new CurrentUser();
		return array(
			'list' => $this->getFactory()->getModel()->Activity()->getActivityList(),
			'is_admin' => $current_user->isAdmin()
		);
	}

	/**
	 * Просмотр мероприятия
	 *
	 * @return array
	 */
	public function showAction() {
		if (!($id = $this->getRequest()->get('id'))) {
			throw new NotFound('Не выбрано мероприятие');
		}
		if (!($event = $this->getFactory()->getModel()->Activity()->get($id))) {
			throw new NotFound('Мероприятие не найдено');
		}

		$current_user = new CurrentUser();

		// добавление комментария
		if ($current_user->isLogin() &&
			$this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST' &&
			($comment = $this->getRequest()->post('comment'))
		) {
			$comments = $this->getFactory()->getModel()->Comments();
			$comments->insert(array(
				'user_id' => $current_user->id,
				'event_id' => $id,
				'time' => time(),
				'comment' => $comment
			));
			throw new Found($this->getURLHelper()->getUrl('event_show', array('id' => $id)));
		}

		return array(
			'event' => $event,
			'is_login' => $current_user->isLogin(),
			'is_admin' => $current_user->isAdmin(),
			'comments' => $this->getFactory()->getModel()->Comments()->getActionComments($id)
		);
	}

	/**
	 * Редактирование мероприятия
	 *
	 * @return array
	 */
	public function editAction() {
		$current_user = new CurrentUser();
		if (!$current_user->isAdmin()) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
		if (!($id = $this->getRequest()->get('id'))) {
			throw new NotFound('Не выбрано мероприятие');
		}
		if (!($event = $this->getFactory()->getModel()->Activity()->get($id))) {
			throw new NotFound('Мероприятие не найдено');
		}

		// обновление мероприятия
		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST') {
			// получение данных и их валидация
			$data = $this->getDataFromRequest();
			if (($result = $this->validateData($data)) !== true) {
				return array('error' => $result);
			}

			// игнорируем id при сравнении
			unset($event['id']);
			if ($data = array_diff_assoc($data, $event)) {
				$event['id'] = $id;
				$this->getFactory()->getModel()->Activity()->updateById($data, $id);
				// отправляем уведомление об изменениях если изменены не заметки
				if (array_keys($data) != array('note')) {
					$this->notifyUsers('Home/edit/message.html.tpl', array('chenges' => $data, 'event' => $event));
				}
			}
			throw new Found($this->getURLHelper()->getUrl('home'));
		}
		return array(
			'event' => $event
		);
	}

	/**
	 * Добавление мероприятия
	 *
	 * @return array
	 */
	public function addAction() {
		$current_user = new CurrentUser();
		if (!$current_user->isAdmin()) {
			throw new Forbidden('Доступ к разделу запрещен');
		}

		// добавление мероприятия
		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST') {
			// получение данных и их валидация
			$data = $this->getDataFromRequest();
			if (($result = $this->validateData($data)) !== true) {
				return array('error' => $result);
			}

			$id = $this->getFactory()->getModel()->Activity()->insert($data);
			throw new Found($this->getURLHelper()->getUrl('event_show', array('id' => $id)));
		}
		return array();
	}

	/**
	 * Удаление мероприятия
	 *
	 * @return array
	 */
	public function removeAction() {
		$current_user = new CurrentUser();
		if (!$current_user->isAdmin()) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
		if (!($id = $this->getRequest()->get('id'))) {
			throw new NotFound('Не выбрано мероприятие');
		}
		if (!($event = $this->getFactory()->getModel()->Activity()->get($id))) {
			throw new NotFound('Мероприятие не найдено');
		}

		// удаление или перенаправление домой
		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST' &&
			($remove = $this->getRequest()->post('remove'))
		) {
			if ($remove == 'yes') {
				$this->getFactory()->getModel()->Activity()->deleteById($id);
			}
			throw new Found($this->getURLHelper()->getUrl('home'));
		}

		return array(
			'event' => $event
		);
	}

	/**
	 * Уведомление пользователей
	 *
	 * @param string $template Шаблон
	 * @param array  $data     Данные
	 */
	private function notifyUsers($template, array $data = array()) {
		$current_user = new CurrentUser();

		$data['author'] = $current_user->getData();
		$from = $current_user->isLogin() ? $current_user->email : 'no-replay@example.com';
		$headers  = 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
		$headers .= 'From: '.$from."\r\n";

		$users = $this->getFactory()->getModel()->Users()->fetchAll();
		foreach ($users as $user) {
			// не отправляем себе
			if ($user['email'] != $from) {
				$data['recipient'] = $user;
				$message = $this->getView()->assign($data)->render($template);
				mail($user['email'], 'В мероприятии произведены изменения', $message, $headers);
			}
		}
	}

	/**
	 * Возвращает данные мероприятия из запроса
	 *
	 * @return array
	 */
	private function getDataFromRequest() {
		$request = $this->getRequest();
		return array(
			'name' => $request->post('name'),
			'date_start' => strtotime($request->post('date_start')),
			'date_end' => strtotime($request->post('date_end')),
			'company' => $request->post('company'),
			'venue' => $request->post('venue'),
			'price' => $request->post('price'),
			'offer' => $request->post('offer'),
			'used' => $request->post('used'),
			'note' => $request->post('note'),
			'program' => $request->post('program'),
		);
	}

	/**
	 * Проверяет валидность данных мероприятия
	 *
	 * @param array $data Данные мероприятия
	 *
	 * @return boolean
	 */
	private function validateData(array $data) {
		if (empty($data['name'])) {
			return 'Не указано название мероприятия';
		}
		if (empty($data['company'])) {
			return 'Не указан организатор мероприятия';
		}
		if (empty($data['venue'])) {
			return 'Не указано мето проведения мероприятия';
		}
		if (empty($data['date_start'])) {
			return 'Не указана дата начала мероприятия';
		}
		if (empty($data['date_end'])) {
			return 'Не указана дата окончания мероприятия';
		}
		if (!$data['date_start']) {
			return 'Некорректно указана дата начала мероприятия';
		}
		if (!$data['date_end']) {
			return 'Некорректно указана дата окончания мероприятия';
		}
		if ($data['date_end'] < $data['date_start']) {
			return 'Дата окончания мероприятия раньше даты начала';
		}
		return true;
	}
}