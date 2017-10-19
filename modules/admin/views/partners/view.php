<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Partners */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->request->get('action') == 'add') : ?>
            <?= Html::a('Добавить еще', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
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
            [
                'attribute'=>'active',
                'format'=>'raw',
                'value'=>$model->active ? 'Активно' : 'Не активно'
            ],
            [
                'attribute'=>'reg_date',
                'format'=>'raw',
                'value'=>date('d.m.Y H:i:s',strtotime($model->reg_date))
            ],
            [
                'attribute'=>'image',
                'format'=>'raw',
                'value'=>$model->image ? '<div class="partners-view__image"><img src="/images/partners/'.$model->image.'" alt=""></div>' : ''
            ],
            'text',
            'sort',
            'active'
        ],
    ]) ?>

</div>

