<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Objects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-view">

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
        <?php if (Yii::$app->request->get('service_id')) : ?>
           <?= Html::a('Добавить в эту эту же категорию', ['create', 'service_id' => $model->service_id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            [
                'attribute'=>'active',
                'format'=>'raw',
                'value'=>$model->active ? 'Активно' : 'Не активно'
            ],
            'sort',
            [
                'attribute'=>'service_id',
                'format'=>'raw',
                'value'=>$model->service->name
            ],
            [
                'attribute'=>'reg_date',
                'format'=>'raw',
                'value'=>date('d.m.Y в H:i:s',strtotime($model->reg_date))
            ],
        ],
    ]) ?>

</div>
