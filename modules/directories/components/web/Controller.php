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
					['label' => 'IP компьютеров', 'url' => ['/directory/computer'], 'active' => $this->id == 'computer'],
					['label' => 'Активные дни и интервалы', 'url' => ['/directory/active-day'], 'active' => $this->id == 'active-day'],
					['label' => 'Типы пользователей', 'url' => ['/directory/user-type'], 'active' => $this->id == 'user-type'],
					['label' => 'Пользователи', 'url' => ['/directory/user'], 'active' => $this->id == 'user'],
					['label' => 'Помещения для бронирования', 'url' => ['/directory/room'], 'active' => $this->id == 'room'],
					['label' => 'Учебные заведения', 'url' => ['/directory/lib-school'], 'active' => $this->id == 'lib-school'],
				]
			],
			[
				'label' => 'Услуги', 'items' => [
					// ['label' => 'График работы услуг', 'url' => ['/directory/service-time'], 'active' => $this->id == 'service-time'],
					['label' => 'Категории услуг', 'url' => ['/directory/service-type'], 'active' => $this->id == 'service-type'],
					['label' => 'Категории клиентов', 'url' => ['/directory/client-category'], 'active' => $this->id == 'client-category'],
					['label' => 'Стоимость услуг', 'url' => ['/directory/price'], 'active' => $this->id == 'price'],
					['label' => 'Типы скидок', 'url' => ['/directory/client-type'], 'active' => $this->id == 'client-type'],
					['label' => 'Услуги', 'url' => ['/directory/service'], 'active' => $this->id == 'service'],
				]
			],
			[
				'label' => 'Консультанты', 'items' => [
					['label' => 'Список консультантов', 'url' => ['/directory/consultant'], 'active' => $this->id == 'consultant'],
					['label' => 'Тип консультантов', 'url' => ['/directory/consultants-type'], 'active' => $this->id == 'consultants-type'],
					['label' => 'Категории консультантов', 'url' => ['/directory/consultants-category'], 'active' => $this->id == 'consultants-category'],
				]
			],
		];

		return true;
	}
}