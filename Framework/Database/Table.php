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
				`'.$this->column_primary.'` = :id
		');
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
	public function fetchAll($where = '', array $params = array()) {
		$st = $this->engine->prepare('SELECT * FROM `'.static::TABLE_NAME.'`'.($where ? ' WHERE '.$where : ''));
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
	public function fetchRow($where = '', array $params = array()) {
		$st = $this->engine->prepare('SELECT * FROM `'.static::TABLE_NAME.'`'.($where ? ' WHERE '.$where : ''));
		$st->execute($params);
		return $st->fetch();
	}

	/**
	 * Вставляет запись в таблицу
	 *
	 * @param array $data Данные
	 *
	 * @return integer
	 */
	public function insert(array $data) {
		if (!$data) {
			return false;
		}
		$st = $this->engine->prepare('
			INSERT INTO
				`'.static::TABLE_NAME.'`
				(`'.implode('`,`', array_keys($data)).'`)
			VALUES
				(:'.implode(',:', array_keys($data)).')
		');
		foreach ($data as $column => $value) {
			$st->bindValue(':'.$column, $value);
		}
		$st->execute();
		return $this->engine->lastInsertId();
	}
}