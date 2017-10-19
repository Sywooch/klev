<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Characteristics */

$this->title = 'Технические характеристики';
$this->params['breadcrumbs'][] = ['label' => 'Технические характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->view_filter = 1;
$model->view_product = 1;
?>
<div class="characteristics-create">
    <?=Yii::$app->getSession()->getFlash('alert');?>

    <h1><?= Html::encode($this->title) ?></h1>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs navtab1" role="tablist">
            <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Параметры</a></li>
            <li role="presentation" class="options" style="display:none;"><a href="#options" aria-controls="options" role="tab" data-toggle="tab">Опции</a></li>
        </ul>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
