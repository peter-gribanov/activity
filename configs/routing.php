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
	'home' => array(
		'pattern'    => '/',
		'controller' => 'Home::index',
		'present'    => 'html'
	),
	'home_card' => array(
		'pattern'    => '/card.html',
		'controller' => 'Home::card',
		'present'    => 'html'
	),
	'home_edit' => array(
		'pattern'    => '/edit.html',
		'controller' => 'Home::edit',
		'present'    => 'html'
	),
	'home_users' => array(
		'pattern'    => '/users.html',
		'controller' => 'Home::users',
		'present'    => 'html'
	),
	'home_login' => array(
		'pattern'    => '/login',
		'controller' => 'Home::login',
		'present'    => 'html'
	),
);