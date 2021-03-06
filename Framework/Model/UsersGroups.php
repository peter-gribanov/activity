<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Model;

use Framework\Table\UsersGroups as UsersGroupsTable;
use Framework\Database\Engine;


/**
 * Модель групп пользователей
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class UsersGroups extends UsersGroupsTable {

	/**
	 * Минимальная длинна названия
	 *
	 * @var integer
	 */
	const NAME_MIN_LENGTH = 4;


	/**
	 * Возвращает список групп
	 *
	 * @return array {id:name}
	 */
	public function getList() {
		return $this->fetchAll('1=1 ORDER BY `name`');
	}

}