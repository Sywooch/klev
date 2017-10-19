<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use budyaga\users\components\AuthChoice;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\forms\LoginForm */

$this->title = Yii::t('users', 'LOGIN');
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;

?>
<div class="site-login lc-custom-signup">
    <div class="container">
        <div class="col-xs-12 lc-custom-signup__form">

            <div class="lc-custom-signup__form">
                <div class="col-lg-5">
                    <?php echo $session->getFlash('success');?>
                    <h1 class="lc-custom-signup__title"><?= Html::encode($this->title) ?></h1>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?php
                    echo $form->field($model, 'username')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+7 (999) 999 99 99',
                    ])->label('Номер телефона');
                    echo '<div style="visibility:hidden;height: 0;">'.$form->field($model, 'test')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+7 (999) 999 99 99',
                        ]).'</div>';
                    ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    <div class="site-login__register">
                        <a href="/signup">Регистрация</a>
                    </div>
                    <div style="color:#999;margin:1em 0">
                        <?= Yii::t('users', 'YOU_CAN_RESET_PASSWORD', ['url' => Url::toRoute('/user/user/request-password-reset')])?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('users', 'LOGIN'), ['class' => 'custom-black-btn1 lc-custom-signup__form_submit', 'name' => 'login-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="clearfix"></div>
