<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prof')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text_short')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?php if (!$model->isNewRecord) : ?>
        <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
    <?php endif;?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?php if (!$model->isNewRecord && $model->image) : ?>
        <div class="reviews-form__img">
            <img src="/images/reviews/<?= $model->image ?>" alt="">
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
