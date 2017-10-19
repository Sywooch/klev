<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Партнеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить партнера', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'image',
                'format'=>'raw',
                'value'=>function($data){
                    return $data->image ? '<div class="partners-index__image"><img src="/images/partners/'.$data->image.'" alt=""></div>' : '';
                }
            ],
            [
                'attribute'=>'active',
                'filter' => ['0'=>'Не активно','1'=>'Активно'],
                'format'=>'raw',
                'value'=>function($data){
                    return $data->active ? 'Активно' : 'Не активно';
                }
            ],
            [
                'attribute'=>'reg_date',
                'format'=>'raw',
                'value'=>function($data){
                    return date('d.m.Y H:i:s',strtotime($data->reg_date));
                }
            ],
            'text',
            'sort',
            'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
