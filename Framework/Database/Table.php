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

/**
 * Таблица базы данных
 *
 * @package Framework\Database
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Table {

	/**
	 * Имя таблици
	 *
	 * @var string
	 */
	const TABLE_NAME = 'table';

	/**
	 * Главное поле
	 *
	 * @var string
	 */
	const PRIMARY_COLUMN = 'id';


	/**
	 * Возвращает имя таблици
	 *
	 * @return string
	 */
	public function getTableName() {
		return static::TABLE_NAME;
	}

}