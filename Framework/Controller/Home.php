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
use Framework\Http\Redirection\Found;
use Framework\Http\ClientError\NotFound;
use Framework\Model\CurrentUser;

/**
 * Главный контроллер
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Home extends Controller {

	/**
	 * Форма авторизации
	 *
	 * @return array
	 */
	public function loginAction() {
		$current_user = new CurrentUser();

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
		$current_user = new CurrentUser();
		$current_user->destroy();
		throw new Found($this->getURLHelper()->getUrl('home'));
	}

	/**
	 * Главная
	 *
	 * @return array
	 */
	public function adminAction() {
		$current_user = new CurrentUser();
		if (!$current_user->isAdmin()) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
		return array();
	}
}