<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */


/**
 * Форматирование даты
 *
 * @param string  $format    Формат
 * @param mixed   $timestamp UTM время
 * 
 * @return string
 */
return function (array $values, $timestamp = null) {
	if ($timestamp && !is_int($timestamp)) {
		$timestamp = strtotime($timestamp);
	}
	$timestamp = $timestamp ?: time();
	// учитываем при расчете минуты
	$hour = round((date('H', $timestamp)*3600+date('i', $timestamp)) / 3600);

	$values = $values + array('morning', 'day', 'evening', 'night');
	if ($hour >= 4 && $hour < 12) {
		return $values[0];
	} elseif ($hour >= 12 && $hour < 17) {
		return $values[1];
	} elseif ($hour >= 17 && $hour < 24) {
		return $values[2];
	} else {
		return $values[3];
	}
};