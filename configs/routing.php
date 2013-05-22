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
	'home_show' => array(
		'pattern'    => '/show.html',
		'controller' => 'Home::show',
		'present'    => 'html'
	),
	'home_login' => array(
		'pattern'    => '/login',
		'controller' => 'Home::login',
		'present'    => 'html'
	),
	'home_logout' => array(
		'pattern'    => '/logout.html',
		'controller' => 'Home::logout',
		'present'    => 'html'
	),
	'admin' => array(
		'pattern'    => '/admin/',
		'controller' => 'Admin::index',
		'present'    => 'html'
	),
	'admin_add' => array(
		'pattern'    => '/admin/add.html',
		'controller' => 'Admin::add',
		'present'    => 'html'
	),
	'admin_edit' => array(
		'pattern'    => '/admin/edit.html',
		'controller' => 'Admin::edit',
		'present'    => 'html'
	),
	'admin_remove' => array(
		'pattern'    => '/admin/remove.html',
		'controller' => 'Admin::remove',
		'present'    => 'html'
	),
);