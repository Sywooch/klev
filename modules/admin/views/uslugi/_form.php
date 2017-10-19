<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;


/* @var $this yii\web\View */
/* @var $model app\models\Uslugi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uslugi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'clicable_objects')->checkbox() ?>

    <?php if (!$model->isNewRecord) : ?>
        <?= $form->field($model, 'sort')->textInput() ?>
    <?php endif; ?>


    <?php
    echo $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 400,
            'replaceTags' => false,
            'replaceDivs' => false,
            'maxHeight' => 400,
            'imageUpload' => \yii\helpers\Url::to(['/site/image-upload']),
            'fileUpload' => \yii\helpers\Url::to(['/site/file-upload']),
            'plugins' => [
                'clips',
                'fullscreen',
                'fontsize',
                'fontcolor',
                'table',
                'filemanager'
            ]
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
