<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\regions\assets\RegionsAsset;
RegionsAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\ModArendaRegions */
/* @var $form ActiveForm */
$this->params['breadcrumbs'][] = ['label' => 'Регионы и города', 'url' => ['index']];
$this->title = 'Добавление региона в страну '.$strana->name;
$this->params['breadcrumbs'][] = $this->title;

$session = Yii::$app->session;
echo $session->getFlash('add');
?>
<div class="site-edit">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
        <?= Html::a('Вернуться к списку', ['/regions/admin'], ['class' => 'btn btn-default']) ?>
    </div>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'url')->label('URL на латинице (можно оставить пустым)') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?= Html::a('Вернуться к списку', ['/regions/admin'], ['class' => 'btn btn-default']) ?>
</div><!-- site-edit -->
