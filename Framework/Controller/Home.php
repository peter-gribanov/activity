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
use Framework\Database\Engine;
use Framework\Model\Users;
use Framework\Http\ClientError\Forbidden;
use Framework\Http\Redirection\Found;

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
		return array(
			'list' => $this->getFactory()->getModel()->Activity()->getActivityList(),
			'is_admin' => !empty($_SESSION['user']) && $_SESSION['user']['role'] == Users::ROLE_ADMIN
		);
	}

	/**
	 * Карточка мероприятия
	 *
	 * @return array
	 */
	public function cardAction() {
		return array();
	}

	/**
	 * Редактирование мероприятия
	 *
	 * @return array
	 */
	public function editAction() {
		return array();
	}

	/**
	 * Добавление мероприятия
	 *
	 * @return array
	 */
	public function addAction() {
		return array();
	}

	/**
	 * Удаление мероприятия
	 *
	 * @return array
	 */
	public function removeAction() {
		return array();
	}

	/**
	 * Редактирование пользователей
	 *
	 * @return array
	 */
	public function usersAction() {
		if (empty($_SESSION['user']) || $_SESSION['user']['role'] != Users::ROLE_ADMIN) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
		$users = $this->getFactory()->getModel()->Users();
		$users_list = $users->fetchAll();
		return array(
			'users' => $users_list
		);
	}

	/**
	 * Форма авторизации
	 *
	 * @return array
	 */
	public function loginAction() {
		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST' &&
			($email = $this->getRequest()->post('email')) &&
			($password = $this->getRequest()->post('password'))
		) {
			$users = $this->getFactory()->getModel()->Users();
			if ($user = $users->getUserByPass($email, $password)) {
				$_SESSION['user'] = $user;
				throw new Found($this->getURLHelper()->getUrl('home'));
			} else {
				return array('error' => 'Не верный логин или пароль');
			}
		}

		return array(
			'user' => !empty($_SESSION['user']) ? $_SESSION['user'] : array()
		);
	}
}