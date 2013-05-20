<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework;

use Framework\View\Php as View;
use Framework\Router;
use Framework\Request;
use Framework\Router\URLHelper;
use Framework\Exception;
use Framework\Utility\Arr as ArrayUtility;
use Framework\Database\Engine;
use Framework\Model\Factory as FactoryModel;

/**
 * Райтинг
 *
 * @package Framework
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Factory {

	/**
	 * Контроллер распределения запросов
	 *
	 * @var \Framework\AppCore
	 */
	private $app;

	/**
	 * Представление
	 *
	 * @var \Framework\View
	 */
	private $view;

	/**
	 * Роутер
	 *
	 * @var \Framework\Router
	 */
	private $router;

	/**
	 * Корневая дирректория
	 *
	 * @var string
	 */
	private $dir = '';

	/**
	 * Конфигурации
	 *
	 * @var array
	 */
	private $config = array();

	/**
	 * Запрос
	 *
	 * @var \Framework\Request
	 */
	private $request;

	/**
	 * URL хелпер
	 *
	 * @var \Framework\Router\URLHelper
	 */
	private $url_helper;

	/**
	 * Список подключений к бд
	 *
	 * @var array
	 */
	private $db_connections;

	/**
	 * Фабрика моделей
	 *
	 * @var \Framework\Model\Factory
	 */
	private $model_factory;


	/**
	 * Конструктор
	 *
	 * @param \Framework\AppCore $app     Контроллер распределения запросов
	 * @param string             $dir     Корневая дирректория
	 * @param array              $routing Роутинг
	 * @param array              $config  Конфигурации
	 */
	public function __construct(AppCore $app, $dir, array $routing = array(), array $config = array()) {
		$this->router = new Router($routing);
		$this->dir    = $dir;
		$this->config = $config;
		$this->app    = $app;
	}

	/**
	 * Представление
	 *
	 * @return \Framework\View\Iface
	 */
	public function getView() {
		if (!$this->view) {
			$this->view = new View(
				$this->getDir().'/resources/templates',
				$this->getDir().'/resources/helpers',
				$this->getURLHelper(),
				$this->app,
				$this->getConfig('debug')
			);
		}
		return $this->view;
	}

	/**
	 * Роутер
	 *
	 * @return \Framework\Router
	 */
	public function getRouter() {
		return $this->router;
	}

	/**
	 * Возвращает корневую дирректорию
	 *
	 * @return string
	 */
	public function getDir() {
		return $this->dir;
	}

	/**
	 * Возвращает объект ответа
	 *
	 * @param string $present Формат ответа
	 * @param mixed  $content Контент
	 *
	 * @return \Framework\Response\Response
	 */
	public function getResponse($present, $content = '') {
		$classname = '\Framework\Response\\'.ucwords($present);
		return new $classname($content);
	}

	/**
	 * Возвращает параметр из конфигураций
	 *
	 * @param string     $param   Название параметра
	 * @param mixed|null $default Значение по умолчанию
	 *
	 * @return mixed
	 */
	public function getConfig($param, $default = null) {
		return ArrayUtility::getByPath($this->config, $param, $default);
	}

	/**
	 * Устанавливает запрос
	 *
	 * @param \Framework\Request $request Запрос
	 *
	 * @return \Framework\Factory
	 */
	public function setRequest(Request $request) {
		$this->request = $request;
		return $this;
	}

	/**
	 * Возвращает запрос
	 *
	 * @return \Framework\Request
	 */
	public function getRequest() {
		if (!($this->request instanceof Request)) {
			throw new Exception('Не установлен запрос');
		}
		return $this->request;
	}

	/**
	 * Возвращает URL хелпер
	 *
	 * @return \Framework\Router\URLHelper
	 */
	public function getURLHelper() {
		if (!($this->url_helper instanceof URLHelper)) {
			$this->url_helper = new URLHelper($this->getRequest(), $this->getRouter());
		}
		return $this->url_helper;
	}

	/**
	 * Возвращает адаптор бд
	 *
	 * @param string|null $connect Подключение
	 *
	 * @return \Framework\Database\Engine
	 */
	public function getDatabaseEngine($connect = null) {
		$connect = $connect ?: $this->getConfig('database.default_connect');
		if (!$connect) {
			throw new Exception('Не выбрано подключение');
		}
		if (!isset($this->db_connections[$connect])) {
			$this->db_connections[$connect] = new Engine($this->getConfig('database.connections.'.$connect, array()));
		}
		return $this->db_connections[$connect];
	}

	/**
	 * Возвращает фабрику моделей
	 *
	 * @return \Framework\Model\Factory
	 */
	public function getModel() {
		if (!$this->model_factory) {
			$this->model_factory = new FactoryModel($this);
		}
		return $this->model_factory;
	}

}