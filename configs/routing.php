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
	'users_list' => array(
		'pattern'    => '/admin/users/',
		'controller' => 'Users::list',
		'present'    => 'html'
	),
	'users_add' => array(
		'pattern'    => '/admin/users/add.html',
		'controller' => 'Users::add',
		'present'    => 'html'
	),
	'users_edit' => array(
		'pattern'    => '/admin/users/edit.html',
		'controller' => 'Users::edit',
		'present'    => 'html'
	),
	'users_remove' => array(
		'pattern'    => '/admin/users/remove.html',
		'controller' => 'Users::remove',
		'present'    => 'html'
	),
	'groups_list' => array(
		'pattern'    => '/admin/groups/',
		'controller' => 'Groups::list',
		'present'    => 'html'
	),
	'groups_add' => array(
		'pattern'    => '/admin/groups/add.html',
		'controller' => 'Groups::add',
		'present'    => 'html'
	),
	'groups_edit' => array(
		'pattern'    => '/admin/groups/edit.html',
		'controller' => 'Groups::edit',
		'present'    => 'html'
	),
	'groups_remove' => array(
		'pattern'    => '/admin/groups/remove.html',
		'controller' => 'Groups::remove',
		'present'    => 'html'
	),
);