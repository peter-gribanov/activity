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

use Framework\Exception;
use Framework\Table\Table;

/**
 * Фабрика моделей
 * 
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Factory {

	/**
	 * Список загруженных моделей
	 * 
	 * @var array
	 */
	private $models = array();

	/**
	 * Фабрика
	 *
	 * @var \Framework\Factory
	 */
	private $factory;


	/**
	 * Конструктор
	 *
	 * @param \Framework\Factory $factory Фабрика
	 */
	public function __construct(\Framework\Factory $factory) {
		$this->factory = $factory;
	}

	/**
	 * Получение модели по имени
	 * 
	 * @param string $name Название модели
	 *
	 * @return \Framework\Database\Table
	 */
	public function get($name) {
		if (!isset($this->models[$name])) {
			$class_name = '\Framework\Model\\'.$name;
			$this->models[$name] = new $class_name($this->factory->getDatabaseEngine(), $this);
			if (!($this->models[$name] instanceof Table)) {
				throw new Exception('Некорректная модель');
			}
		}
		return $this->models[$name];
	}

	/**
	 * Модель пользователей
	 *
	 * @return \Framework\Model\Users
	 */
	public function Users() {
		return $this->get('Users');
	}

	/**
	 * Модель комментариев
	 *
	 * @return \Framework\Model\Comments
	 */
	public function Comments() {
		return $this->get('Comments');
	}

	/**
	 * Модель мероприятий
	 *
	 * @return \Framework\Model\Activity
	 */
	public function Activity() {
		return $this->get('Activity');
	}

}