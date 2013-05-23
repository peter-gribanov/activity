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
use Framework\Model\CurrentUser;

/**
 * Группы
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Groups extends Controller {

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
	 * Список групп
	 *
	 * @return array
	 */
	public function listAction() {
		return array();
	}

	/**
	 * Добавление группы
	 *
	 * @return array
	 */
	public function addAction() {
		return array();
	}

	/**
	 * Редактирование группы
	 *
	 * @return array
	 */
	public function editAction() {
		return array();
	}

	/**
	 * Удаление группы
	 *
	 * @return array
	 */
	public function removeAction() {
		return array();
	}
}