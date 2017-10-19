<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ObratFields */

$this->title = 'Редактирование поля:' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['/admin/obrat']];
$this->params['breadcrumbs'][] = ['label' => $model->parent->name, 'url' => ['/admin/obrat-list/update?id='.$model->parent->id.'']];
$this->params['breadcrumbs'][] = ['label' => 'Поля для обратной связи', 'url' => ['index?obrat_id='.$model->parent->id.'']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="obrat-fields-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'values_model' => $values_model,
    ]) ?>

</div>
