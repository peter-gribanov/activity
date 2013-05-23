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

use Framework\Table\Activity as ActivityTable;
use Framework\Database\Engine;


/**
 * Модель мероприятий
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Activity extends ActivityTable {

	/**
	 * Возвращает список мероприятий с последним комментарием
	 *
	 * @param integer $start Начало интервалов
	 * @param integer $end   Окончание интервалов
	 *
	 * @return array
	 */
	public function getActivityList($start, $end) {
		// получем комментарии
		$activity_table = $this->getTableName();
		$comments_table = $this->factory->Comments()->getTableName();
		$users_table = $this->factory->Users()->getTableName();
		$users_groups_table = $this->factory->UsersGroups()->getTableName();
		$st = $this->engine->prepare('
			SELECT
				`a`.*,
				`c`.`time` AS `comment_time`,
				`c`.`comment` AS `comment_text`,
				`u`.`name` AS `comment_author`,
				`ug`.`name` AS `comment_group`
			FROM
				`'.$activity_table.'` AS `a`
			LEFT JOIN
				`'.$comments_table.'` AS `c`
				ON
					`a`.`id` = `c`.`event_id`
			LEFT JOIN
				`'.$users_table.'` AS `u`
				ON
					`u`.`id` = `c`.`user_id`
			LEFT JOIN
				`'.$users_groups_table.'` AS `ug`
				ON
					`ug`.`id` = `u`.`group_id`
			WHERE
				`a`.`date_start` >= :start AND
				`a`.`date_end` <= :end
			GROUP BY
				`a`.`id`
			ORDER BY
				`date_start`,
				strftime(\'%s\', `time`) ASC
		');
		$st->bindValue(':start', $start);
		$st->bindValue(':end', $end);
		$st->execute();
		$result = $st->fetchAll();
		// конвертация данных
		foreach ($result as $key => $value) {
			// оформляем последний комментарий
			$result[$key]['comment'] = array();
			if ($value['comment_time'] && $value['comment_text'] && $value['comment_author']) {
				$result[$key]['comment'] = array(
					'time'   => $value['comment_time'],
					'author' => $value['comment_author'],
					'text'   => $value['comment_text'],
					'group'  => $value['comment_group'],
				);
			}
			unset($result[$key]['comment_time'], $result[$key]['comment_text'], $result[$key]['comment_author'], $result[$key]['comment_group']);
		}

		return $result;
	}

}