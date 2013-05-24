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
use Framework\Http\ClientError\Forbidden;
use Framework\Response\Http;

/**
 * Статистика
 *
 * @package Framework\Controller
 * @author  Peter Gribanov <gribanov@professionali.ru>
 */
class Statistics extends Controller {

	/**
	 * PNG картинка 1x1 px с прозрачным фоном
	 *
	 * @var string
	 */
	const ZERO_PIXEL_IMAGE = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAABnRSTlMAAAAAAABupgeRAAAADElEQVQImWNgYGAAAAAEAAGjChXjAAAAAElFTkSuQmCC';


	/**
	 * Статистика по посещениям
	 *
	 * @return array
	 */
	public function indexAction() {
		$current_user = $this->getFactory()->getModel()->CurrentUser();
		if (!$current_user->isAdmin()) {
			throw new Forbidden('Доступ к разделу запрещен');
		}
		return array(
			'statistics' => $this->getFactory()->getModel()->Statistics()->getList()
		);
	}

	/**
	 * Логируем посещение пользователя
	 *
	 * @return array
	 */
	public function zeropixelAction() {
		$current_user = $this->getFactory()->getModel()->CurrentUser();
		// логируем посещение
		if ($current_user->isLogin() && ($referer = $this->getRequest()->server('HTTP_REFERER', '1'))) {
			$query = parse_url($referer, PHP_URL_QUERY);
			$this->getFactory()->getModel()->Statistics()->replace(array(
				'user_id' => $current_user->id,
				'time' => time(),
				'link' => parse_url($referer, PHP_URL_PATH).($query ? '?'.$query : '')
			));
		}

		// отдаем картинку
		$response = new Http(base64_decode(self::ZERO_PIXEL_IMAGE));
		$response->addHeader('Content-Type', 'image/png');
		return $response;
	}
}
