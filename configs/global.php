<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

return array(
	'debug' => true,
	'database' => array(
		'default_connect' => 'default',
		'connections' => array(
			'default' => array(
				'dsn' => 'sqlite:'.dirname(__DIR__).'/activity.db',
				'username' => null,
				'password' => null,
			)
		)
	),
);