<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peremena */

$this->title = 'Добавить переменную';
$this->params['breadcrumbs'][] = ['label' => 'Переменные', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peremena-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
