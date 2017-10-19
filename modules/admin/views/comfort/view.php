<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comfort */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Удобства', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comfort-view">

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
        <?php if (Yii::$app->request->get('action') == 'create') : ?>
            <?= Html::a('Добавить еще', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif;?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'reg_date',
            [
                'attribute'=>'active',
                'format'=>'raw',
                'value'=>$model->active ? 'Активно' : 'Не активно'
            ],
            'sort',
        ],
    ]) ?>

</div>
