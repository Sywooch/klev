<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Добавить продукт';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->active = 1;
$model->price = 0;
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        echo Yii::$app->getSession()->getFlash('alert');
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
