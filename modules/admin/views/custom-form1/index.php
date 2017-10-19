<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomForm1Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-form1-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p><a href="/admin/obrat-settings1">Настройки</a></p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'tel',
            'time',
            [
                'attribute'=>'reg_date',
                'format'=>'raw',
                'value'=>function($data){
                    return date('d.m.Y H:i:s',strtotime($data->reg_date));
                }
            ],
            // 'status',
        ],
    ]); ?>
</div>
