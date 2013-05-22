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

use Framework\Table\Comments as CommentsTable;
use Framework\Database\Engine;


/**
 * Модель комментариев
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Comments extends CommentsTable {

	/**
	 * Возвращает комментарии мероприятия
	 *
	 * @param integer $id ID мероприятия
	 *
	 * @return array
	 */
	public function getActionComments($id) {
		$table_comments = $this->getTableName();
		$table_users = $this->factory->Users()->getTableName();
		$st = $this->engine->prepare('
			SELECT
				*
			FROM
				`'.$table_comments.'` AS `c`
			INNER JOIN
				`'.$table_users.'` AS `u`
				ON
					`c`.`user_id` = `u`.`id`
			WHERE
				`c`.`event_id` = :id
			ORDER BY
				`time` DESC
		');
		$st->bindValue(':id', $id, Engine::PARAM_INT);
		$st->execute();
		return (array)$st->fetchAll();
	}
}