<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  17:54 06.03.15
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
 */

namespace app\modules\directories\components\web;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Controller extends \yii\web\Controller {

	/**
	 * @inheritdoc
	 */
	public $layout = '@app/views/layouts/admin-sidebar.php';

	/**
	 * @var array
	 */
	public $menus;


	/**
	 * @inheritdoc
	 */
	// public function behaviors() {
	// 	return [
	// 		'access' => [
	// 			'class' => AccessControl::className(),
	// 			'rules' => [
	// 				[
	// 					'allow' => true,
	// 					'roles' => ['@'],
	// 				],
	// 			],
	// 		],
	// 	];
	// }

	/**
	 * @param \yii\base\Action $action
	 * @return bool
	 */
	public function beforeAction($action) {
		if(!parent::beforeAction($action)) {
			return false;
		}

		if($this->id == 'default') {
			$this->view->params['breadcrumbs'][] = 'Справочники';
		} else {
			$this->view->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['/directory']];
		}

		$this->menus = [
			[
				'label' => 'Справочники', 'items' => [
					['label' => 'Активные дни и интервалы', 'url' => ['/directory/active-day'], 'active' => $this->id == 'active-day'],
					['label' => 'Категории клиентов', 'url' => ['/directory/client-category'], 'active' => $this->id == 'client-category'],
					['label' => 'Пользователи', 'url' => ['/directory/user'], 'active' => $this->id == 'user'],
					['label' => 'Типы пользователей', 'url' => ['/directory/user-type'], 'active' => $this->id == 'user-type'],
					['label' => 'Типы клиентов', 'url' => ['/directory/client-type'], 'active' => $this->id == 'client-type'],
					['label' => 'Учебные заведения', 'url' => ['/directory/lib-school'], 'active' => $this->id == 'lib-school'],
					['label' => 'IP компьютеров', 'url' => ['/directory/computer'], 'active' => $this->id == 'computer'],
					['label' => 'Помещения для бронирования', 'url' => ['/directory/room'], 'active' => $this->id == 'room'],
				]
			],
			[
				'label' => 'Услуги', 'items' => [
					['label' => 'Услуги', 'url' => ['/directory/service'], 'active' => $this->id == 'service'],
					['label' => 'Типы услуг', 'url' => ['/directory/service-type'], 'active' => $this->id == 'service-type'],
					['label' => 'Стоимость услуг', 'url' => ['/directory/price'], 'active' => $this->id == 'price'],
					['label' => 'График работы услуг', 'url' => ['/directory/service-time'], 'active' => $this->id == 'service-time'],
				]
			],


			// ['label' => 'Агентства', 'items' => [
			// 	['label' => 'Агентства', 'url' => ['/directories/agency'], 'active' => $this->id == 'agency'],
			// 	['label' => 'Хостес', 'url' => ['/directories/hostess'], 'active' => $this->id == 'hostess'],
			// 	['label' => 'Фотографы', 'url' => ['/directories/photographer'], 'active' => $this->id == 'photographer'],
			// ]],
		];

		return true;
	}
}