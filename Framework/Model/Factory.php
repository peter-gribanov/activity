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

use Framework\Database\Table;

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
	 * Получение модели по имени
	 * 
	 * @param string $name Название модели
	 *
	 * @return \Framework\Database\Table
	 */
	public function get($name) {
		if (!isset($this->models[$name])) {
			$class_name = '\Framework\Model\\'.$name;
			$this->models[$name] = new $class_name();
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

}