<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Восстановление пароля от личного кабинета';
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;

?>
<div class="site-request-password-reset custom-password-reset1">
    <div class="container">
        <h1 class="custom-password-reset1__title"><?= Html::encode($this->title) ?></h1>
        <?php echo $session->getFlash('error');?>
        <div class=" custom-password-reset1__form">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <div><?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+7 (999) 999-99-99',
                    ]) ?></div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('users', 'SEND'), ['class' => 'custom-black-btn1 custom-password-reset1__form_submit']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
