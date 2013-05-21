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
	 * @return array
	 */
	public function getActivityList() {
		// получем комментарии
		$activity_table = $this->getTableName();
		$comments_table = $this->factory->Comments()->getTableName();
		$users_table = $this->factory->Users()->getTableName();
		$st = $this->engine->prepare('
			SELECT
				`a`.*,
				`c`.`time` AS `comment_time`,
				`c`.`comment` AS `comment_text`,
				`u`.`name` AS `comment_author`,
				`u`.`department` AS `comment_department`
			FROM
				`'.$activity_table.'` AS `a`
			LEFT JOIN
				`'.$comments_table.'` AS `c`
				ON
					`a`.`id` = `c`.`action_id`
			LEFT JOIN
				`'.$users_table.'` AS `u`
				ON
					`u`.`id` = `c`.`user_id`
			GROUP BY
				`a`.`id`
			ORDER BY
				`date_start`,
				strftime(\'%s\', `time`) ASC
		');
		$st->execute();
		$result = $st->fetchAll();
		// конвертация данных
		foreach ($result as $key => $value) {
			// оформляем последний комментарий
			$result[$key]['comment'] = array();
			if ($value['comment_time'] && $value['comment_text'] && $value['comment_author']) {
				$result[$key]['comment'] = array(
					'time'       => $value['comment_time'],
					'author'     => $value['comment_author'],
					'text'       => $value['comment_text'],
					'department' => $value['comment_department'],
				);
			}
			unset($result[$key]['comment_time'], $result[$key]['comment_text'], $result[$key]['comment_author'], $result[$key]['comment_department']);
		}

		return $result;
	}

	/**
	 * (non-PHPdoc)
	 * @see Framework\Database.Table::get()
	 */
	public function get($id) {
		if ($item = parent::get($id)) {
			$item['date_start'] = strtotime($item['date_start']);
			$item['date_end'] = strtotime($item['date_end']);
		}
		return $item;
	}

}