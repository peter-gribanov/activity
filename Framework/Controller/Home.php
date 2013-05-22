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
use Framework\Model\User;

/**
 * Главный контроллер
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Home extends Controller {

	/**
	 * Главная
	 *
	 * @return array
	 */
	public function indexAction() {
		$current_user = new User();
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

		$current_user = new User();

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
			throw new Found($this->getURLHelper()->getUrl('home_show', array('id' => $id)));
		}

		return array(
			'event' => $event,
			'is_login' => $current_user->isLogin(),
			'is_admin' => $current_user->isAdmin(),
			'comments' => $this->getFactory()->getModel()->Comments()->getActionComments($id)
		);
	}

	/**
	 * Форма авторизации
	 *
	 * @return array
	 */
	public function loginAction() {
		$current_user = new User();

		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST' &&
			($email = $this->getRequest()->post('email')) &&
			($password = $this->getRequest()->post('password'))
		) {
			$users = $this->getFactory()->getModel()->Users();
			if ($user = $users->getUserByPass($email, $password)) {
				$current_user->setData($user);
				throw new Found($this->getURLHelper()->getUrl('home'));
			} else {
				return array('error' => 'Не верный логин или пароль');
			}
		}

		return array(
			'user' => $current_user->getData(),
			'is_admin' => $current_user->isAdmin()
		);
	}

	/**
	 * Разавторизироваться
	 *
	 * @throws Found
	 */
	public function logoutAction() {
		$current_user = new User();
		$current_user->destroy();
		throw new Found($this->getURLHelper()->getUrl('home'));
	}
}