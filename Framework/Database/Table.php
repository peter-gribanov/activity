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

use Framework\Database\Engine;

/**
 * Таблица базы данных
 *
 * @package Framework\Database
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
abstract class Table {

	/**
	 * Название таблицы
	 *
	 * @var string
	 */
	const TABLE_NAME = 'table';

	/**
	 * Ключевой столбец
	 *
	 * @var string
	 */
	protected $column_primary = 'id';

	/**
	 * Адаптор доступа к бд
	 *
	 * @var \Framework\Database\Engine
	 */
	protected $engine;


	/**
	 * Конструктор
	 *
	 * @param \Framework\Database\Engine $engine  Адаптор доступа к бд
	 */
	public function __construct(Engine $engine) {
		$this->engine = $engine;
	}

	/**
	 * Возвращает имя таблици
	 *
	 * @return string
	 */
	public function getTableName() {
		return static::TABLE_NAME;
	}

	/**
	 * Возвращает первичный ключ
	 *
	 * @return string
	 */
	public function getPrimaryKey() {
		return $this->column_primary;
	}

	/**
	 * Выбирает поле по первичному ключу
	 *
	 * @param mixed $id Id
	 *
	 * @return \Framework\Database\Table\Row
	 */
	public function get($id) {
		$st = $this->engine->prepare('
			SELECT
				*
			FROM
				`'.static::TABLE_NAME.'`
			WHERE
				:primary = :id
			');
		$st->bindValue(':primary', $this->column_primary, Engine::PARAM_ID);
		$st->bindValue(':id', $id, Engine::PARAM_STR);
		$st->execute();
		return $st->fetch();
	}

	/**
	 * Выбрать все записи
	 *
	 * @param string $where  Условие выбора
	 * @param array  $params Параметры
	 *
	 * @return array
	 */
	public function fetchAll($where = 'true', array $params = array()) {
		/* @var $st \Framework\Database\Statement */
		$st = $this->engine->prepare('
			SELECT
				*
			FROM
				`'.static::TABLE_NAME.'`
			WHERE
				'.$where
		);
		$st->execute($params);
		return $st->fetchAll();
	}

	/**
	 * Выбрать одну запись
	 *
	 * @param string $where  Условие выбора
	 * @param array  $params Параметры
	 *
	 * @return array
	 */
	public function fetchRow($where, array $params = array()) {
		/* @var $st \Framework\Database\Statement */
		$st = $this->engine->prepare('
			SELECT
				*
			FROM
				`'.static::TABLE_NAME.'`
			WHERE
				'.$where
		);
		$st->execute($params);
		return $st->fetch();
	}
}