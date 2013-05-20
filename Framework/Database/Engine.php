<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Database;

use Framework\Exception;

/**
 * Адаптор доступа к бд
 *
 * @package Framework\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Engine {

	/**
	 * Представляет булевый тип данных
	 *
	 * @var integer
	 */
	const PARAM_BOOL = \PDO::PARAM_BOOL;

	/**
	 * Представляет тип данных SQL INTEGER
	 *
	 * @var integer
	 */
	const PARAM_INT = \PDO::PARAM_INT;

	/**
	 * Представляет тип данных больших объектов SQL
	 *
	 * @var integer
	 */
	const PARAM_LOB = \PDO::PARAM_LOB;

	/**
	 * Представляет тип данных SQL NULL
	 *
	 * @var integer
	 */
	const PARAM_NULL = \PDO::PARAM_NULL;

	/**
	 * Представляет типы данных SQL CHAR, VARCHAR и другие строковые типы
	 *
	 * @var integer
	 */
	const PARAM_STR = \PDO::PARAM_STR;

	/**
	 * Указывает, что метод, осуществляющий выборку данных, должен возвращать каждую строку результирующего набора в виде ассоциативного массива,
	 * индексы которого соответствуют именам столбцов результата выборки
	 *
	 * @var integer
	 */
	const FETCH_ASSOC = \PDO::FETCH_ASSOC;

	/**
	 * Указывает, что метод, осуществляющий выборку данных, должен возвращать каждую строку результирующего набора в виде массива.
	 * Индексация массива производится и по именам столбцов и по их порядковым номерам в результирующей таблице. Нумерация начинается с 0
	 *
	 * @var integer
	 */
	const FETCH_BOTH = \PDO::FETCH_BOTH;

	/**
	 * Указывает, что метод, осуществляющий выборку данных, должен возвращать новый объект запрашиваемого класса,
	 * заполняя именованные свойства класса значениями столбцов результирующей таблицы
	 *
	 * @var integer
	 */
	const FETCH_CLASS = \PDO::FETCH_CLASS;

	/**
	 * Указывает, что метод, осуществляющий выборку данных, должен возвращать значение только одного столбца из следующей строки результирующего набора
	 *
	 * @var integer
	 */
	const FETCH_COLUMN = \PDO::FETCH_COLUMN;

	/**
	 * Указывает, что метод, осуществляющий выборку данных, должен возвращать каждую строку результирующего набора в виде массива,
	 * индексы которого соответствуют порядковым номерам столбцов результата выборки. Нумерация начинается с 0
	 *
	 * @var integer
	 */
	const FETCH_NUM = \PDO::FETCH_NUM;

	/**
	 * Указывает, что метод, осуществляющий выборку данных, должен возвращать каждую строку результирующего набора в виде объекта,
	 * имена свойств которого соответствуют именам столбцов результирующей таблицы
	 *
	 * @var integer
	 */
	const FETCH_OBJ = \PDO::FETCH_OBJ;


	/**
	 * PDO
	 *
	 * @var \PDO
	 */
	private $pdo;


	/**
	 * Конструктор
	 *
	 * @param array $connection Параметры подключения
	 */
	public function __construct(array $connection) {
		// проверяем наличие параметров
		if (array_diff(array('dsn', 'username', 'password'), array_keys($connection))) {
			throw new Exception('Некорректные параметры подключения');
		}
		// проверяем поддержку драйвера
		$driver = parse_url($connection['dsn'], PHP_URL_SCHEME);
		if (!$driver || !in_array($driver, \PDO::getAvailableDrivers())) {
			throw new Exception('Не поддерживается драйвер'.($driver ? ' '.$driver : ''));
		}
		// подключаемся
		try {
			$this->pdo = new \PDO($connection['dsn'], $connection['username'], $connection['password'], array(
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_STATEMENT_CLASS => array('\Framework\Database\Statement')
			));
			$this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			throw new Exception('Не удалось подключится к базе данных');
		}
	}

	/**
	 * Инициализация транзакции
	 *
	 * @return boolean
	 */
	public function beginTransaction() {
		return $this->pdo->beginTransaction();
	}

	/**
	 * Фиксирует транзакцию
	 *
	 * @return boolean
	 */
	public function commit() {
		return $this->pdo->commit();
	}

	/**
	 * Возвращает код SQLSTATE результата последней операции с базой данных
	 *
	 * @return mixed
	 */
	public function errorCode() {
		return $this->pdo->errorCode();
	}

	/**
	 * Получает расширенную информацию об ошибке, произошедшей в ходе последнего обращения к базе данных
	 *
	 * @return array
	 */
	public function errorInfo() {
		return $this->pdo->errorInfo();
	}

	/**
	 * Проверяет, есть ли внутри транзакция
	 *
	 * @return boolean
	 */
	public function inTransaction() {
		return $this->pdo->inTransaction();
	}

	/**
	 * Возвращает ID последней вставленной строки или последовательное значение
	 *
	 * @param string|null $name Имя объекта последовательности, который должен выдать ID
	 *
	 * @return string
	 */
	public function lastInsertId($name = null) {
		return $this->pdo->lastInsertId($name);
	}

	/**
	 * Подготавливает запрос к выполнению и возвращает ассоциированный с этим запросом объект
	 *
	 * @param string $statement Это должен быть корректный запрос с точки зрения целевой СУБД
	 *
	 * @return \Framework\Database\Statement
	 */
	public function prepare($statement) {
		return $this->pdo->prepare($statement);
	}

	/**
	 * Выполняет SQL запрос и возвращает результирующий набор в виде объекта PDOStatement
	 *
	 * @param string                     $statement Текст SQL запроса для подготовки и выполнения
	 * @param integer|null               $mode      Режим выборки можно задавать только одной из констант Engine::FETCH_*
	 * @param integer|string|object|null $param     Номер столбца, имя класса или объект
	 * @param array                      $ctorargs  Аргументы конструктора класса
	 *
	 * @return \Framework\Database\Statement
	 */
	public function query($statement, $mode = null, $param = null, array $ctorargs = array()) {
		switch ($mode) {
			case null:
				return $this->pdo->query($statement);
			case self::FETCH_CLASS:
				return $this->pdo->query($statement, $mode, $param, $ctorargs);
			default:
				return $this->pdo->query($statement, $mode, $param);
		}
	}

	/**
	 * Заключает строку в кавычки для использования в запросе
	 *
	 * @param string  $string         Экранируемая строка
	 * @param integer $parameter_type Представляет подсказку о типе данных первого параметра для драйверов, которые имеют альтернативные способы экранирования
	 *
	 * @return string
	 */
	public function quote($string, $parameter_type = self::PARAM_STR) {
		return $this->pdo->quote($string, $parameter_type);
	}

	/**
	 * Откат транзакции
	 *
	 * @return boolean
	 */
	public function rollBack() {
		return $this->pdo->rollBack();
	}

}