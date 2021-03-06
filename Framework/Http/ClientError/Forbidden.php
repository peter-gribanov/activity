<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Http\ClientError;

use Framework\Http\Http;
use Framework\Http\Status;

/**
 * Исключение Forbidden
 * 
 * @package Framework\Http\ClientError
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Forbidden extends Http {

	/**
	 * Конструктор
	 * 
	 * @param string|null $message Сообщение
	 */
	public function __construct($message = '') {
		parent::__construct($message, Status::FORBIDDEN);
	}

}