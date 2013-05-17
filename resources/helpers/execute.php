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
 * Хелпер вызывающий контроллер
 *
 * @param string $pointer Вызываемый контроллер
 * @param array  $params  Параметры
 *
 * @return string
 */
return function ($pointer, array $params = array()) use ($utility) {
	return $utility->execute($pointer, $params);
};