<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обеды';
$this->params['breadcrumbs'][] = ['label' => 'Платежи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
     <?= GridView::widget([
        'dataProvider' => $dp,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            [
                'attribute' => 'fullName',
                'label' => 'ФИО'
            ],
        ],
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    ]); ?>
    <?=Html::a('Сохранить', null, ['class' => 'btn btn-primary', 'id' => 'pay'])?>
</div>
<?php $this->registerJs("
    $(document).on('click', '#pay', function(){
        var keys = $('#w0').yiiGridView('getSelectedRows');
        console.log(keys);
        $.ajax({
          url: '" . Url::to('payment/ajax-dinner', true) . "',
          type: 'POST',   
          data: {'keys':keys}, 
          success: function(response){
            alert('Успешно');
          }
        });
    });

",
    View::POS_END,
     'my-options');
?>