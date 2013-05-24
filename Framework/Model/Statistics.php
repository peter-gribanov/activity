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

use Framework\Table\Statistics as StatisticsTable;
use Framework\Database\Engine;


/**
 * Модель статистики
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Statistics extends StatisticsTable {

	/**
	 * Возвращает статистику по пользователям
	 *
	 * @return array
	 */
	public function getList() {
		$users_table = $this->factory->Users()->getTableName();
		$users_groups_table = $this->factory->UsersGroups()->getTableName();
		$st = $this->engine->prepare('
			SELECT
				`s`.*,
				`u`.`name`,
				`ug`.`name` AS `group`
			FROM
				`'.static::TABLE_NAME.'` AS `s`
			INNER JOIN
				`'.$users_table.'` AS `u`
				ON
					`s`.`user_id` = `u`.`id`
			INNER JOIN
				`'.$users_groups_table.'` AS `ug`
				ON
					`u`.`group_id` = `ug`.`id`
			ORDER BY
				`u`.`name` ASC
		');
		$st->execute();
		return $st->fetchAll();
	}
}