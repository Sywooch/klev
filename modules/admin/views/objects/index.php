<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить объект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            [
                'attribute'=>'active',
                'format'=>'raw',
                'filter' => ['0'=>'Не активно','1'=>'Активно'],
                'value'=>function($data){
                    return $data->active ? 'Активно' : 'Не активно';
                }
            ],
            'sort',
            [
                'attribute'=>'reg_date',
                'format'=>'raw',
                'value'=>function($data){
                    return date('d.m.Y H:i:s',strtotime($data->reg_date));
                }
            ],
            [
                'attribute'=>'service_id',
                'format'=>'raw',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Uslugi::find()->all(),'id','name'),
                'value'=>function($data){
                    return $data->service->name;
                }
            ],
            // 'reg_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
