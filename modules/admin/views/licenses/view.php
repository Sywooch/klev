<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Licenses */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Лицензии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licenses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
                'value'=>$model->image ? '<div class="licenses-view__image"><img src="/images/licenses/'.$model->image.'" alt=""></div>' : ''
            ],
            'name:ntext',
        ],
    ]) ?>

</div>
