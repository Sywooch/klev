<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Objects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?php if (!$model->isNewRecord) : ?>
        <?= $form->field($model, 'sort')->textInput() ?>
    <?php endif;?>


    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'service_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Uslugi::find()->all(), 'id', 'name')) ?>
    <div class="objects-form__values">
        <?php if (!$model->isNewRecord) : ?>
            <hr>
            <h4>Фотографии:</h4>
            <div class="objects-form__values_content">
                <?php foreach ($model->photos_for_object as $key => $value) : ?>
                    <?php $values_model->names[$key] = $value->name; ?>
                    <?php $values_model->photos[$key] = $value->image; ?>
                    <?php $values_model->ids[$key] = $value->id; ?>
                    <div class="row objects__values_content_field">
                        <div class="col-sm-6"><?= $form->field($values_model, 'names[' . $key . ']')->textInput() ?></div>
                        <div class="col-sm-6">


                            <?= $form->field($values_model, 'photos[' . $key . ']')->fileInput() ?>
                            <?php if ($value->image) : ?>
                                <div class="objects__values_content_field_img">
                                    <img src="/images/objects/<?= $value->image ?>" alt="">
                                </div>
                            <?php endif; ?>
                            <?= $form->field($values_model, 'ids[' . $key . ']')->hiddenInput()->label(false) ?>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <div class="row">
                    <div class="col-sm-6"><?= $form->field($values_model, 'names[]')->textInput() ?></div>
                    <div class="col-sm-6"><?= $form->field($values_model, 'photos[]')->fileInput() ?></div>
                </div>
            </div>
            <p><a class="add" href="#">Добавить</a></p>
        <?php endif; ?>
    </div>
</div>


<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
