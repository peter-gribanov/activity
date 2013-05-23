<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Model;

use Framework\Model\Users;

/**
 * Модель текущего пользователя
 *
 * @property integer $id
 * @property string  $name
 * @property string  $email
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class CurrentUser {

	/**
	 * Конструктор
	 * 
	 * @param $data Данные пользователя
	 */
	public function __construct(array $data = array()) {
		if (!isset($_SESSION['user'])) {
			$_SESSION['user'] = array();
		}
		$this->setData($data);
	}

	/**
	 * Возвращает данные пользователя
	 *
	 * @return array
	 */
	public function getData() {
		return $_SESSION['user'];
	}

	/**
	 * Устанавливает данные пользователя
	 *
	 * @param array $data Данные пользователя
	 *
	 * @return \Framework\Model\User
	 */
	public function setData(array $data) {
		$_SESSION['user'] = array_merge($_SESSION['user'], $data);
		return $this;
	}

	/**
	 * Удаляет сессию пользователя
	 *
	 * @return \Framework\Model\User
	 */
	public function destroy() {
		unset($_SESSION['user']);
		return $this;
	}

	/**
	 * Пользователь авторезирован
	 *
	 * @return boolean
	 */
	public function isLogin() {
		return !empty($_SESSION['user']);
	}

	/**
	 * Пользователь администратор
	 *
	 * @return boolean
	 */
	public function isAdmin() {
		return !empty($_SESSION['user']) && $_SESSION['user']['role'] == Users::ROLE_ADMIN;
	}

	/**
	 * Возвращает значение поля
	 *
	 * @param string $name Название поля
	 *
	 * @return mixed
	 */
	public function __get($name) {
		return in_array($name, array('id', 'name', 'email')) ? $_SESSION['user'][$name] : null;
	}

	/**
	 * Устанавливает значение поля
	 *
	 * @param string $name  Название поля
	 * @param mixed  $value Значение
	 */
	public function __set($name, $value) {
		$_SESSION['user'][$name] = $value;
	}
}