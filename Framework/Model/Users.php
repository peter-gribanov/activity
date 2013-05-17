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

use Framework\Database\Table;

/**
 * Модель пользователей
 * 
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Users extends Table {

	public function get($id) {
		// TODO get data from sql
		/*$result = mysql_query('
			SELECT
				`first`,
				`last`
			FROM
				`users`
			WHERE
				`id` = '.intval($id));
		return mysql_fetch_assoc($result);*/

		// возвращаем данные заглушки вместо реального запроса
		return array(
			'first' => 'Arnold',
            'last'  => 'Schwarzenegger'
		);
	}

}