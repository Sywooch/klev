<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ObratFields */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['/admin/obrat-list']];
$this->params['breadcrumbs'][] = ['label' => $model->parent->name, 'url' => ['/admin/obrat-list/update?id='.$model->parent->id.'']];
$this->params['breadcrumbs'][] = ['label' => 'Поля для обратной связи', 'url' => ['index?obrat_id='.$model->parent->id.'']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obrat-fields-view">

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
            'name:ntext',
            [
                'attribute'=>'type',
                'value'=>$model->types[$model->type]
            ],
            'placeholder:ntext',
            [
                'attribute'=>'active',
                'value'=>$model->active ? 'Активнос' : 'не активно'
            ],
            [
                'attribute'=>'reg_date',
                'value'=>date('d.m.Y в H:i:s',strtotime($model->reg_date))
            ],
        ],
    ]) ?>

</div>
