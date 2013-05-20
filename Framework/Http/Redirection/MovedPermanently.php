<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Http\Redirection;

use Framework\Http\Redirection\Redirection as RedirectionHttp;
use Framework\Http\Status;

/**
 * Исключение MovedPermanently
 * 
 * @package Framework\Http\Redirection
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class MovedPermanently extends RedirectionHttp {

	/**
	 * Конструктор
	 * 
	 * @param string|null $url     URL адресс
	 * @param string|null $message Сообщение
	 */
	public function __construct($url = '/', $message = '') {
		$this->url = $url;
		parent::__construct($message, Status::MOVED_PERMAMENTLY);
	}

}