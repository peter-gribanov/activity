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
 * Возвращает русскоязычное представление интервала дат
 *
 * @param integer $start     Начало интервала
 * @param integer $end       Окончание интервала
 * @param integer $show_year Показывать год
 *
 * @return string
 */
return function ($start, $end = null, $show_year = false) {
	$months = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентебря', 'Октября', 'Ноября', 'Декабря');
	$end = $end ?: $start;

	// дата начала и дата окончания совпадают
	if (date('dm', $start) == date('dm', $end)) {
		if (date('dmY', $start) == date('dmY')) {
			return 'Сегодня';
		} elseif (date('dmY', $start) == date('dmY', time()-86400)) {
			return 'Вчера';
		} else {
			return date('j ', $start).$months[date('n', $start)-1].($show_year ? date(' Y', $start) : '');
		}

	// начало и окончание в одном месяце
	} elseif (date('mY', $start) == date('mY', $end)) {
		return date('j', $start).date('-j ', $end).$months[date('n', $start)-1].($show_year ? date(' Y', $start) : '');

	} else {
		return date('j ', $start).$months[date('n', $start)-1].($show_year ? date(' Y', $start) : '').
			'-'.date('j ', $end).$months[date('n', $end)-1].($show_year ? date(' Y', $end) : '');
	}
};