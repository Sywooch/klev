<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ObratSettings1 */

$this->title = 'Редактирование почты: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['/admin/custom-form1/index']];
$this->params['breadcrumbs'][] = ['label' => 'Настройки обратной связи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="obrat-settings1-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
