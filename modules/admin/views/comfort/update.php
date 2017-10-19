<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comfort */

$this->title = 'Редактирование удобства: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Удобства', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comfort-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
