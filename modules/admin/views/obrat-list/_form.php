<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ObratList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obrat-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput([]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'emails')->textarea(['rows' => 6,'placeholder'=>'Через запятую, если несколько']) ?>
    <?php
        if (!$model->isNewRecord && $model->fields){
            $model->code = Yii::$app->formatter->asRaw($model->code);
            echo $form->field($model, 'code')->textarea(['rows' => 12]);
        }
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
