<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = 'Отзыв # '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить еще', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:ntext',
            'text_short:ntext',
            'sort',
            [
                'attribute'=>'reg_date',
                'format'=>'raw',
                'value'=>date('d.m.Y H:i:s',strtotime($model->reg_date))
            ],
            [
                'attribute'=>'image',
                'format'=>'raw',
                'value'=>$model->image ? '<div class="reviews-view__image"><img src="/images/reviews/'.$model->image.'" alt=""></div>' : ''
            ],
            'author',
            [
                'attribute'=>'active',
                'format'=>'raw',
                'value'=>$model->active ? 'Активно' : 'Не активно'
            ],
        ],
    ]) ?>

</div>
