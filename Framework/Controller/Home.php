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
		return array();
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
	 * Редактирование таблици
	 *
	 * @return array
	 */
	public function editAction() {
		return array();
	}

	/**
	 * Редактирование пользователей
	 *
	 * @return array
	 */
	public function usersAction() {
		return array();
	}

	/**
	 * Форма авторизации
	 *
	 * @return array
	 */
	public function loginAction() {
		return array();
	}
}