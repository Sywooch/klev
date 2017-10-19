<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить отзыв', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text_short:ntext',
            'sort',
            [
                'attribute'=>'reg_date',
                'format'=>'raw',
                'value'=>function($data){
                    return date('d.m.Y H:i:s',strtotime($data->reg_date));
                }
            ],
            [
                'attribute'=>'image',
                'format'=>'raw',
                'value'=>function($data){
                    return $data->image ? '<div class="reviews-index__image"><img src="/images/reviews/'.$data->image.'" alt=""></div>' : '';
                }
            ],
            'author',
            'prof',
            [
                'attribute'=>'active',
                'filter' => ['0'=>'Не активно','1'=>'Активно'],
                'format'=>'raw',
                'value'=>function($data){
                    return $data->active ? 'Активно' : 'Не активно';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
