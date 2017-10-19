<?php
use yii\widgets\ActiveForm;
$form = ActiveForm::begin();
?>
<div class="row">
    <div class="col-sm-6"><?=$form->field($model,'names[]')->textInput()?></div>
    <div class="col-sm-6"><?=$form->field($model,'photos[]')->fileInput()?></div>
</div>



