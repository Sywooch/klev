<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use budyaga\users\models\User;
use budyaga\cropper\Widget;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\SignupForm */

$this->title = 'Регистрация';
$session = Yii::$app->session;
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="site-signup container custom-registration1">
    <h1 class="custom-registration1__title"><?= Html::encode($this->title) ?></h1>
    <?php echo $session->getFlash('success');?>
    <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
    <div class="row">
       <!-- <div class="col-xs-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?/*= $form->field($model, 'photo')->widget(Widget::className(), [
                        'uploadUrl' => Url::toRoute('/user/user/uploadphoto'),
                    ]) */?>
                </div>
            </div>
        </div>-->
        <div class="col-xs-12 col-md-6 custom-registration1__form">
            <?php
            if (!isset($user->activation_code) || !$user->activation_code) : ?>
                <div><?= $form->field($model, 'surname')->textInput() ?></div>
                <div><?= $form->field($model, 'first_name')->textInput() ?></div>
                <div><?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+7 (999) 999-99-99',
                    ]) ?></div>
                <div><?= $form->field($model, 'password')->passwordInput() ?></div>
                <div><?= $form->field($model, 'password_repeat')->passwordInput() ?></div>
                <div><?= $form->field($model, 'parent_id', ['template'=>'{input}','options'=>['style'=>'display:none;']])->hiddenInput() ?></div>
            <?php endif;?>
            <?php
            if (isset($user->activation_code) && $user->activation_code) : ?>
                <div><?= $form->field($user, 'id', ['template'=>'{input}','options'=>['style'=>'display:none;']])->hiddenInput() ?></div>
                <div><?= $form->field($model, 'activation_code1')->textInput() ?></div>
            <?php endif;?>
            <?= $form->field($model, 'sms_accept')->checkbox() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('users', 'SIGNUP'), ['class' => 'custom-black-btn1 custom-registration1__form_submit ', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php

?>

