<?php
/**
 * Framework package
 *
 * @package   Framework
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2012, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace Framework\Controller;

use Framework\Controller\Controller;
use Framework\Router\Node;
use Framework\Factory;
use Framework\Request;
use Framework\Model\CurrentUser;
use Framework\Model\Users as UsersModel;
use Framework\Http\Redirection\Found;
use Framework\Http\ClientError\NotFound;

/**
 * Пользователи
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Users extends Controller {

	/**
	 * Конструктор
	 *
	 * @param \Framework\Router\Node $node    Нода
	 * @param \Framework\Factory     $factory Фабрика
	 * @param \Framework\Request     $request Запрос
	 */
	public function __construct(Node $node, Factory $factory, Request $request) {
		parent::__construct($node, $factory, $request);
		$current_user = new CurrentUser();
		if (!$current_user->isAdmin()) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
	}

	/**
	 * Список пользователей
	 *
	 * @return array
	 */
	public function listAction() {
		$current_user = new CurrentUser();
		return array(
			'users' => $this->getFactory()->getModel()->Users()->getList(),
			'current_user_id' => $current_user->id
		);
	}

	/**
	 * Добавление пользователя
	 *
	 * @return array
	 */
	public function addAction() {
		$groups = $this->getFactory()->getModel()->UsersGroups()->getList();

		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST') {
			// получение данных и их валидация
			$data = $this->getDataFromRequest();
			if (($result = $this->validateData($data, $groups)) !== true ||
				($result = $this->validateDataPassword($data)) !== true
			) {
				return array('error' => $result, 'groups' => $groups);
			}
			$this->getFactory()->getModel()->Users()->insert(array(
				'name'     => $data['name'],
				'email'    => $data['email'],
				'group_id' => $data['group'],
				'role'     => $data['role'],
				'password' => md5($data['password']),
			));
			throw new Found($this->getURLHelper()->getUrl('users_list'));
		}
		return array(
			'groups' => $groups
		);
	}

	/**
	 * Редактирование пользователя
	 *
	 * @return array
	 */
	public function editAction() {
		if (!($id = $this->getRequest()->get('id'))) {
			throw new NotFound('Не выбран пользователь');
		}
		if (!($user = $this->getFactory()->getModel()->Users()->get($id))) {
			throw new NotFound('Пользователь не найден');
		}
		$groups = $this->getFactory()->getModel()->UsersGroups()->getList();

		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST') {
			// получение данных и их валидация
			$data = $this->getDataFromRequest();
			if (($result = $this->validateData($data, $groups)) !== true) {
				return array('error' => $result, 'groups' => $groups, 'user' => $user);
			}

			// обновляемые данные
			$update = array(
				'name'     => $data['name'],
				'email'    => $data['email'],
				'group_id' => $data['group'],
				'role'     => $data['role'],
			);

			// проверяем пароль принеобходимости
			if ($data['password']) {
				if (($result = $this->validateDataPassword($data)) !== true) {
					return array('error' => $result, 'groups' => $groups, 'user' => $user);
				}
				$update['password'] = md5($data['password']);
			}

			// игнорируем id при сравнении
			unset($user['id']);
			if ($update = array_diff_assoc($update, $user)) {
				$this->getFactory()->getModel()->Users()->updateById($update, $id);
			}
			throw new Found($this->getURLHelper()->getUrl('users_list'));
		}

		return array(
			'groups' => $groups,
			'user'   => $user
		);
	}

	/**
	 * Удаление пользователя
	 *
	 * @return array
	 */
	public function removeAction() {
		return array();
	}

	/**
	 * Возвращает данные пользователя из запроса
	 *
	 * @return array
	 */
	private function getDataFromRequest() {
		$request = $this->getRequest();
		return array(
			'name'     => $request->post('name'),
			'email'    => $request->post('email'),
			'group'    => $request->post('group'),
			'role'     => $request->post('role'),
			'password' => $request->post('password'),
			'password-confirm' => $request->post('password-confirm'),
		);
	}

	/**
	 * Проверяет корректность данных пользователя
	 *
	 * @param array $data   Данные пользователя
	 * @param array $groups Список групп
	 *
	 * @return string|boolean
	 */
	private function validateData(array $data, array $groups) {
		if (empty($data['name'])) {
			return 'Не указано ФИО пользователя';
		}
		if (empty($data['email'])) {
			return 'Не указан Email пользователя';
		}
		if (empty($data['group'])) {
			return 'Не указано подразделение пользователя';
		}
		if (strlen($data['name']) < UsersModel::NAME_MIN_LENGTH) {
			return 'ФИО должно состоять не мение чем из '.UsersModel::NAME_MIN_LENGTH.' символов';
		}
		if (!array_key_exists($data['group'], $groups)) {
			return 'Недопустимое подразделение пользователя';
		}
		if (!in_array($data['group'], array(UsersModel::ROLE_USER, UsersModel::ROLE_ADMIN))) {
			return 'Недопустимая роль пользователя';
		}
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			return 'Введен некорректный Email';
		}
		return true;
	}

	/**
	 * Проверяет корректность пароля
	 *
	 * @param array $data Данные пользователя
	 *
	 * @return string|boolean
	 */
	private function validateDataPassword(array $data) {
		if (empty($data['password'])) {
			return 'Не указан пароль';
		}
		if (empty($data['password-confirm'])) {
			return 'Не указан пароль подтверждения';
		}
		if ($data['password'] != $data['password-confirm']) {
			return 'Пароль не равен паролю подтверждения';
		}
		if (strlen($data['password']) < UsersModel::PASSWORD_MIN_LENGTH) {
			return 'Пароль должен состоять не мение чем из '.UsersModel::PASSWORD_MIN_LENGTH.' символов';
		}
		return true;
	}
}