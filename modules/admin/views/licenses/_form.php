<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Licenses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="licenses-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?php if (!$model->isNewRecord && $model->image) : ?>
        <div class="licenses-form__img">
            <img src="/images/licenses/<?= $model->image ?>" alt="">
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'active')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
