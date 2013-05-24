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
use Framework\Model\UsersGroups;
use Framework\Http\Redirection\Found;
use Framework\Http\ClientError\NotFound;
use Framework\Http\ClientError\Forbidden;

/**
 * Группы
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Groups extends Controller {

	/**
	 * Конструктор
	 *
	 * @param \Framework\Router\Node $node    Нода
	 * @param \Framework\Factory     $factory Фабрика
	 * @param \Framework\Request     $request Запрос
	 */
	public function __construct(Node $node, Factory $factory, Request $request) {
		parent::__construct($node, $factory, $request);
		$current_user = $this->getFactory()->getModel()->CurrentUser();
		if (!$current_user->isAdmin()) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
	}

	/**
	 * Список групп
	 *
	 * @return array
	 */
	public function listAction() {
		$current_user = $this->getFactory()->getModel()->CurrentUser();
		return array(
			'groups' => $this->getFactory()->getModel()->UsersGroups()->getList(),
			'current_user' => $current_user->getData()
		);
	}

	/**
	 * Добавление группы
	 *
	 * @return array
	 */
	public function addAction() {
		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST') {
			if (!($name = $this->getRequest()->post('name'))) {
				return array('error' => 'Не указано название подразделения');
			}
			if (strlen($name) < UsersGroups::NAME_MIN_LENGTH) {
				return array('error' => 'Название подразделения должно состоять не мение чем из '.UsersGroups::NAME_MIN_LENGTH.' символов');
			}
			$this->getFactory()->getModel()->UsersGroups()->insert(array('name' => $name));
			throw new Found($this->getURLHelper()->getUrl('groups_list'));
		}
		return array();
	}

	/**
	 * Редактирование группы
	 *
	 * @return array
	 */
	public function editAction() {
		if (!($id = $this->getRequest()->get('id'))) {
			throw new NotFound('Не выбрана группа');
		}
		if (!($group = $this->getFactory()->getModel()->UsersGroups()->get($id))) {
			throw new NotFound('Группа не найдена');
		}

		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST') {
			if (!($name = $this->getRequest()->post('name'))) {
				return array('error' => 'Не указано название подразделения', 'group' => $group);
			}
			if (strlen($name) < UsersGroups::NAME_MIN_LENGTH) {
				return array('error' => 'Название подразделения должно состоять не мение чем из '.UsersGroups::NAME_MIN_LENGTH.' символов', 'group' => $group);
			}
			if ($name != $group['name']) {
				$this->getFactory()->getModel()->UsersGroups()->updateById(array('name' => $name), $id);
			}
			throw new Found($this->getURLHelper()->getUrl('groups_list'));
		}

		return array(
			'group' => $group
		);
	}

	/**
	 * Удаление группы
	 *
	 * @return array
	 */
	public function removeAction() {
		if (!($id = $this->getRequest()->get('id'))) {
			throw new NotFound('Не выбрана группа');
		}
		if (!($group = $this->getFactory()->getModel()->UsersGroups()->get($id))) {
			throw new NotFound('Группа не найдена');
		}

		if ($this->getRequest()->server('REQUEST_METHOD', 'GET') == 'POST' &&
			($remove = $this->getRequest()->post('remove'))
		) {
			if ($remove == 'yes') {
				$this->getFactory()->getModel()->UsersGroups()->deleteById($id);
			}
			throw new Found($this->getURLHelper()->getUrl('groups_list'));
		}

		return array(
			'group' => $group
		);
	}
}