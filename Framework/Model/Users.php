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

use Framework\Table\Users as UsersTable;
use Framework\Database\Engine;


/**
 * Модель пользователей
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Users extends UsersTable {

	/**
	 * Роль обычного пользователя
	 *
	 * @var integer
	 */
	const ROLE_USER = 0;

	/**
	 * Роль администратора
	 *
	 * @var integer
	 */
	const ROLE_ADMIN = 1;

	/**
	 * Минимальная длинна паролья
	 *
	 * @var integer
	 */
	const PASSWORD_MIN_LENGTH = 5;

	/**
	 * Минимальная длинна ФИО
	 *
	 * @var integer
	 */
	const NAME_MIN_LENGTH = 5;


	/**
	 * Выбирает пользователя по email и паролю
	 *
	 * @param string $email    Email
	 * @param string $password Пароль
	 *
	 * @return array
	 */
	public function getUserByPass($email, $password) {
		$st = $this->engine->prepare('
			SELECT
				*
			FROM
				`'.self::TABLE_NAME.'`
			WHERE
				`email` = :email AND
				`password` = :password
		');
		$st->bindValue(':email', $email, Engine::PARAM_STR);
		$st->bindValue(':password', md5($password), Engine::PARAM_STR);
		$st->execute();
		return $st->fetch();
	}

	/**
	 * Возвращает список пользовтелей
	 *
	 * @return array
	 */
	public function getList() {
		$users_groups_table = $this->factory->UsersGroups()->getTableName();
		$st = $this->engine->prepare('
			SELECT
				`u`.*,
				`ug`.`name` AS `group`
			FROM
				`'.self::TABLE_NAME.'` AS `u`
			INNER JOIN
				`'.$users_groups_table.'` AS `ug`
				ON
					`ug`.`id` = `u`.`group_id`
			ORDER BY
				`u`.`name` ASC
		');
		$st->execute();
		return $st->fetchAll();
	}

}