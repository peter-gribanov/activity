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
use Framework\Model\CurrentUser;

/**
 * Пользователи
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Users extends Controller {

	/**
	 * Конструктор
	 *
	 * @param \Framework\Router\Node $node    Нода
	 * @param \Framework\Factory     $factory Фабрика
	 * @param \Framework\Request     $request Запрос
	 */
	public function __construct(Node $node, Factory $factory, Request $request) {
		parent::__construct($node, $factory, $request);
		$current_user = new CurrentUser();
		if (!$current_user->isAdmin()) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
	}

	/**
	 * Список пользователей
	 *
	 * @return array
	 */
	public function listAction() {
		return array(
			'users' => $this->getFactory()->getModel()->Users()->fetchAll()
		);
	}

	/**
	 * Добавление пользователя
	 *
	 * @return array
	 */
	public function addAction() {
		return array();
	}

	/**
	 * Редактирование пользователя
	 *
	 * @return array
	 */
	public function editAction() {
		return array();
	}

	/**
	 * Удаление пользователя
	 *
	 * @return array
	 */
	public function removeAction() {
		return array();
	}
}