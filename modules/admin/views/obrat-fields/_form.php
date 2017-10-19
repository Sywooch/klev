<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ObratFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obrat-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList($model->types) ?>

    <?php if (!$model->isNewRecord) :?>
        <div class="obrat-fields-form__values <?=($model->type == 'checkbox' || $model->type == 'select' || $model->type == 'radio' ? 'show' : ''  )?>">
            <h4>Возможные значения:</h4>
            <div class="obrat-fields-form__values_content">
                <?php  foreach ($model->values_for_field as $key=>$value) : ?>
                    <?php $values_model->names[$key] = $value->name;?>
                    <div class="row obrat-fields-form__values_content_field"><div class="col-sm-6"><?=$form->field($values_model,'names['.$key.']')->textInput()?></div><div class="col-sm-4"><a data-id="<?=$value->id?>" href="#">Удалить</a></div></div>
                <?php endforeach;?>
                <div class="row"><div class="col-sm-6"><?= $form->field($values_model,'names[]')->textInput()?></div></div>
            </div>
            <p><a class="add" href="#">Добавить</a></p>
        </div>
    <?php endif;?>

    <?= $form->field($model, 'placeholder')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
