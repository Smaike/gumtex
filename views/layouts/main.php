<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$items = [];
if(!Yii::$app->user->isGuest){
    if(Yii::$app->user->identity->isConsultant()){
        $items[] = ['label' => 'Консультант', 'url' => ['/consultant/search']];
    }else{
        $items = array_merge($items, [
            ['label' => 'Начало', 'url' => ['/site/index']],
            ['label' => 'Справочники', 'url' => ['/directory/default/index']],
            // ['label' => 'Отчеты', 'url' => ['/report/index']],
            ['label' => 'Список клиентов', 'url' => ['/client/index']],
            // ['label' => 'Генератор писем', 'url' => ['/emails/']],
            ['label' => 'Календарь услуг', 'url' => ['/calendar/index']],
            // ['label' => 'Бронирование', 'url' => ['/booking/list']],
        ]);
    }
    $items[] = ['label' => 'В работе', 'url' => ['/consultant/index']];
    $items[] = 
        '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Выход (' . Yii::$app->user->identity->login . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}else{
    $items[] = ['label' => 'Вход', 'url' => ['/site/login']];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Gumtex',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => 'Начало',
                'url' => Yii::$app->homeUrl,
            ],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
