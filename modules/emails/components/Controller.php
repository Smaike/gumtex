<?php

namespace app\modules\emails\components;

class Controller extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/admin-sidebar.php';

    /**
     * @var array
     */
    public $menus;


    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if ($this->id == 'default') {
            $this->view->params['breadcrumbs'][] = 'Почтовые события';
        } else {
            $this->view->params['breadcrumbs'][] = ['label' => 'Почтовые события', 'url' => ['/emails']];
        }

        $this->menus = [
            [
                'label' => 'Почтовые события', 'items' => [
                ['label' => 'Шаблоны писем', 'url' => ['/emails/emails-tpls'], 'active' => $this->id == 'active-day'],
                ['label' => 'Отправка писем', 'url' => ['/emails/emails-send'], 'active' => $this->id == 'client-category'],
                ['label' => 'История писем', 'url' => ['/emails/emails-history'], 'active' => $this->id == 'client-category'],
            ]
            ]
        ];

        return true;
    }
}