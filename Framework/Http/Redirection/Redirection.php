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

use Framework\Http\Http;

/**
 * Исключение Redirection
 * 
 * @package Framework\Http\Redirection
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
abstract class Redirection extends Http {

	/**
	 * URL адресс
	 *
	 * @var string
	 */
	protected $url = '/';

	/**
	 * Возвращает URL адресс
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

}