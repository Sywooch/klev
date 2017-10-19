<?php
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Добавить товары через конфигуратор';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configurator-form">
    <h1>Редактировать товары через конфигуратор</h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="configurator-form-btn">
        <?= $form->field($model, 'configurator')->fileInput(['multiple' => false]) ?>
    </div>
    <hr>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>