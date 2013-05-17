<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Database;

use Framework\Database\Engine;

/**
 * Подгатавливаемый запрос
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Statement extends \PDOStatement {

	/**
	 * Адаптор доступа к бд
	 *
	 * @var \Framework\Database\Engine
	 */
	private $engine;


	/**
	 * Конструктор
	 *
	 * @param \Framework\Database\Engine $engine Адаптор доступа к бд
	 */
	private function __construct(Engine $engine) {
		$this->engine = $engine;
	}

}