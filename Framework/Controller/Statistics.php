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
 * Статистика
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Statistics extends Controller {

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
	 * Статистика по посещениям
	 *
	 * @return array
	 */
	public function indexAction() {
		return array();
	}
}