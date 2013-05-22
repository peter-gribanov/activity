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
		'controller' => 'Activity::list',
		'present'    => 'html'
	),
	'login' => array(
		'pattern'    => '/login',
		'controller' => 'Home::login',
		'present'    => 'html'
	),
	'logout' => array(
		'pattern'    => '/logout.html',
		'controller' => 'Home::logout',
		'present'    => 'html'
	),
	'event_show' => array(
		'pattern'    => '/show.html',
		'controller' => 'Activity::show',
		'present'    => 'html'
	),
	'admin' => array(
		'pattern'    => '/admin/',
		'controller' => 'Home::admin',
		'present'    => 'html'
	),
	'event_add' => array(
		'pattern'    => '/admin/add.html',
		'controller' => 'Activity::add',
		'present'    => 'html'
	),
	'event_edit' => array(
		'pattern'    => '/admin/edit.html',
		'controller' => 'Activity::edit',
		'present'    => 'html'
	),
	'event_remove' => array(
		'pattern'    => '/admin/remove.html',
		'controller' => 'Activity::remove',
		'present'    => 'html'
	),
	'statistics' => array(
		'pattern'    => '/admin/statistics.html',
		'controller' => 'Statistics::index',
		'present'    => 'html'
	),
);