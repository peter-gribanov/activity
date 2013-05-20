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

use Framework\Table\Table;

/**
 * Базовая модель пользователей
 *
 * @property integer $id         ID
 * @property string  $name       ФИО
 * @property string  $department Департамент
 * @property string  $email      Email
 * @property string  $password   Пароль
 * @property integer $role       Роль
 *
 * @package Framework\Table
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Users extends Table {

	/**
	 * Название таблицы
	 *
	 * @var string
	 */
	const TABLE_NAME = 'users';

	/**
	 * Ключевой столбец
	 *
	 * @var string
	 */
	protected $column_primary = 'id';

}