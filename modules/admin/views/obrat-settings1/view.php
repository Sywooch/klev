<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ObratSettings1 */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['/admin/custom-form1/index']];
$this->params['breadcrumbs'][] = ['label' => 'Настройки обратной связи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obrat-settings1-view">

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
            'email:email',
            [
                'attribute'=>'reg_date',
                'format'=>'raw',
                'value'=> date('d.m.Y H:i:s',strtotime($model->reg_date))
            ],
            [
                'attribute'=>'active',
                'format'=>'raw',
                'value'=>$model->active  ? 'Активно' : 'Не активно'
            ],
        ],
    ]) ?>

</div>
