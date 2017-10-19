<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Licenses */

$this->title = 'Добавить лицензию';
$this->params['breadcrumbs'][] = ['label' => 'Лицензии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licenses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
