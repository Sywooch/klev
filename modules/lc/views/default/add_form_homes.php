<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInputAsset;
use kartik\file\FileInputThemeAsset;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\IspHomes */
/* @var $form ActiveForm */

?>
<?php $form2 = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data','data-pjax' => true]]); ?>
<div class="lc-index-right__informers_right_add_block1_list1_item_content_item">
    <div class="default-add_form_homes">
        <div class="default-add_form_homes_title">
            Дом № <?=rand(1,100);?>
        </div>
        <?= $form2->field($model, 'room_counts[]') ?>
        <?= $form2->field($model, 'prices[]') ?>
        <?= $form2->field($model, 'descriptions[]')->textarea() ?>
    </div><!-- default-add_form_homes -->
</div>


