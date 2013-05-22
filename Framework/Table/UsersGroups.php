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

/**
 * Базовая модель групп пользователей
 *
 * @package Framework\Table
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class UsersGroups extends Table {

	/**
	 * Название таблицы
	 *
	 * @var string
	 */
	const TABLE_NAME = 'users_groups';

	/**
	 * Ключевой столбец
	 *
	 * @var string
	 */
	protected $column_primary = 'id';

}