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
 * Подгатавливаемый запрос
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Statement extends \PDOStatement {

	/**
	 * (non-PHPdoc)
	 * @see PDOStatement::bindValue()
	 */
	public function bindValue($parameter, $value, $data_type = null) {
		if ($data_type == Engine::PARAM_ID) {
			$value = preg_replace('/\\*`/', '\`', $value);
			parent::bindValue($parameter, '`'.$value.'`');
		} else {
			parent::bindValue($parameter, $value, $data_type);
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see PDOStatement::bindParam()
	 */
	public function bindParam($parameter, &$variable, $data_type = null, $length = null, $driver_options = null) {
		if ($data_type == Engine::PARAM_ID) {
			$this->bindValue($parameter, $variable, $data_type);
		} else {
			parent::bindParam($parameter, $variable, $data_type, $length, $driver_options);
		}
	}

}