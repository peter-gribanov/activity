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
use Framework\Model\User;

/**
 * Статистика
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Statistics extends Controller {

	/**
	 * Статистика по посещениям
	 *
	 * @return array
	 */
	public function indexAction() {
		return array();
	}
}