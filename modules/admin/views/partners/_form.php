<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Partners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partners-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?php if (!$model->isNewRecord && $model->image) : ?>
        <div class="partners-form__img">
            <img src="/images/partners/<?= $model->image ?>" alt="">
        </div>
    <?php endif; ?>
    <br>
    <?= $form->field($model, 'text')->textarea(['rows'=>8]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>


    <?= $form->field($model, 'active')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
