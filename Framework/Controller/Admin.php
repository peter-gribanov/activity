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
use Framework\Router\Node;
use Framework\Factory;
use Framework\Request;
use Framework\Model\Users;
use Framework\Http\ClientError\Forbidden;
use Framework\Http\Redirection\Found;
use Framework\Http\ClientError\NotFound;

/**
 * Администрировние
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Admin extends Controller {

	/**
	 * Конструктор
	 *
	 * @throws \Framework\Http\ClientError\Forbidden
	 *
	 * @param \Framework\Router\Node $node    Нода
	 * @param \Framework\Factory     $factory Фабрика
	 * @param \Framework\Request     $request Запрос
	 */
	public function __construct(Node $node, Factory $factory, Request $request) {
		parent::__construct($node, $factory, $request);
		if (empty($_SESSION['user']) || $_SESSION['user']['role'] != Users::ROLE_ADMIN) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
	}

	/**
	 * Главная
	 *
	 * @return array
	 */
	public function indexAction() {
		$users = $this->getFactory()->getModel()->Users();
		$users_list = $users->fetchAll();
		return array(
			'users' => $users_list
		);
	}

	/**
	 * Редактирование мероприятия
	 *
	 * @return array
	 */
	public function editAction() {
		if (!($id = $this->getRequest()->get('id'))) {
			throw new NotFound('Не выбрано мероприятие');
		}
		if (!($action = $this->getFactory()->getModel()->Activity()->get($id))) {
			throw new NotFound('Мероприятие не найдено');
		}

		// обновление мероприятия
		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST') {
			if (!$this->getRequest()->post('name')) {
				return array('error' => 'Не указано название мероприятия');
			}
			if (!$this->getRequest()->post('company')) {
				return array('error' => 'Не указан организатор мероприятия');
			}
			if (!$this->getRequest()->post('venue')) {
				return array('error' => 'Не указано мето проведения мероприятия');
			}
			if (!strtotime($this->getRequest()->post('date_start')) ||
				!strtotime($this->getRequest()->post('date_end'))
			) {
				return array('error' => 'Некорректно указана дата начала и окончания мероприятия');
			}

			$data = array(
				'name' => $this->getRequest()->post('name'),
				'date_start' => strtotime($this->getRequest()->post('date_start')),
				'date_end' => strtotime($this->getRequest()->post('date_end')),
				'company' => $this->getRequest()->post('company'),
				'venue' => $this->getRequest()->post('venue'),
				'price' => $this->getRequest()->post('price'),
				'offer' => $this->getRequest()->post('offer'),
				'used' => $this->getRequest()->post('used'),
				'note' => $this->getRequest()->post('note'),
			);
			// игнорируем id при сравнении
			unset($action['id']);
			$data = array_diff_assoc($data, $action);
			$action['id'] = $id;

			if ($data) {
				$this->getFactory()->getModel()->Activity()->updateById($data, $id);
				// отправляем уведомление об изменениях если изменены не заметки
				if (array_keys($data) != array('note')) {
					$this->notifyUsers('Home/edit/message.html.tpl', array('chenges' => $data, 'action' => $action));
				}
			}
			throw new Found($this->getURLHelper()->getUrl('home'));
		}
		return array(
			'action' => $action
		);
	}

	/**
	 * Добавление мероприятия
	 *
	 * @return array
	 */
	public function addAction() {
		// добавление мероприятия
		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST') {
			if (!$this->getRequest()->post('name')) {
				return array('error' => 'Не указано название мероприятия');
			}
			if (!$this->getRequest()->post('company')) {
				return array('error' => 'Не указан организатор мероприятия');
			}
			if (!$this->getRequest()->post('venue')) {
				return array('error' => 'Не указано мето проведения мероприятия');
			}
			if (!strtotime($this->getRequest()->post('date_start')) ||
				!strtotime($this->getRequest()->post('date_end'))
			) {
				return array('error' => 'Некорректно указана дата начала и окончания мероприятия');
			}
			$id = $this->getFactory()->getModel()->Activity()->insert(array(
				'name' => $this->getRequest()->post('name'),
				'date_start' => strtotime($this->getRequest()->post('date_start')),
				'date_end' => strtotime($this->getRequest()->post('date_end')),
				'company' => $this->getRequest()->post('company'),
				'venue' => $this->getRequest()->post('venue'),
				'price' => $this->getRequest()->post('price'),
				'offer' => $this->getRequest()->post('offer'),
				'used' => $this->getRequest()->post('used'),
				'note' => $this->getRequest()->post('note'),
			));
			throw new Found($this->getURLHelper()->getUrl('home_show', array('id' => $id)));
		}
		return array();
	}

	/**
	 * Удаление мероприятия
	 *
	 * @return array
	 */
	public function removeAction() {
		if (!($id = $this->getRequest()->get('id'))) {
			throw new NotFound('Не выбрано мероприятие');
		}
		if (!($action = $this->getFactory()->getModel()->Activity()->get($id))) {
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
			'action' => $action
		);
	}

	/**
	 * Уведомление пользователей
	 *
	 * @param string $template Шаблон
	 * @param array  $data     Данные
	 */
	private function notifyUsers($template, array $data = array()) {
		$data['author'] = !empty($_SESSION['user']) ? $_SESSION['user'] : array();
		$from = !empty($_SESSION['user']) ? $_SESSION['user']['email'] : 'no-replay@example.com';
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
}