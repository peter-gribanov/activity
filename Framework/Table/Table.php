<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Table;

use Framework\Database\Table as TableDatabase;
use Framework\Database\Engine;
use Framework\Model\Factory;

/**
 * Таблица базы данных
 *
 * @package Framework\Table
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
abstract class Table extends TableDatabase {

	/**
	 * Фабрика моделей
	 *
	 * @var \Framework\Model\Factory
	 */
	protected $factory;


	/**
	 * Конструктор
	 *
	 * @param \Framework\Database\Engine $engine  Адаптор доступа к бд
	 * @param \Framework\Model\Factory   $factory Фабрика моделей
	 */
	public function __construct(Engine $engine, Factory $factory) {
		$this->factory = $factory;
		parent::__construct($engine);
	}

}