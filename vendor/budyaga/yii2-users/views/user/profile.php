<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use budyaga\cropper\Widget;
use budyaga\users\models\User;
use budyaga\users\components\AuthKeysManager;
use budyaga\users\UsersAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\User */

$this->title = 'Мой профиль';
$this->params['breadcrumbs'][] = $this->title;
$assets = UsersAsset::register($this);
$script = <<< JS
    $(function() {
      if ($('div').is('.custom-alert3')){
          var int1 = setInterval(function() {
             $('.custom-alert3').fadeOut('slow');
             clearInterval(int1);
          },3000)
      }
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>

<?php
$assets = \app\modules\lc\assets\LcAsset::register($this);
$imagePath = $assets->baseUrl;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
?>
<div class="lc-right">
    <?=$this->render('@app/modules/lc/views/default/head1',[
            'imagePath'=>$imagePath
    ])?>
    <div class="lc-right__bread">
        <div class="lc-right__bread_block1">
            <div class="lc-right__bread_block1_img">
                <img src="<?= $imagePath ?>/images/profile1.png" alt="">
            </div>
        </div>
        <div class="lc-right__bread_block2">
            <div class="lc-right__bread_block2_title">
                Управление профилем
            </div>
            <div class="lc-right__bread_block2_text1">
                На данной странице Вы можете сменить пароль и внести изменения в профиль
            </div>
        </div>
    </div>
    <div class="lc-right__block1 ">
        <div class="lc-right__block1_profile_left">
            <div class="lc-right__block1_profile_left_title">
                <span class="name">Ваш профиль</span>
                <!--<span class="edit">
                    <a href="#">
                        <span class="img">
                             <img src="<?/*=$imagePath*/?>/images/edit1.png" alt="">
                        </span>
                        <span class="text">
                            Редактировать
                        </span>
                    </a>
                </span>-->
            </div>
            <div class="lc-right__block1_profile_left_info1">
                <div class="lc-right__block1_profile_left_info1_img" style="background-image: url('<?=$model->photo ? '/images/users/'.$model->photo.'' : '/images/site_images/no_object.png'?>')">

                </div>
                <div class="lc-right__block1_profile_left_info1_content">
                    <div class="lc-right__block1_profile_left_info1_content_title">
                        <div class="lc-right__block1_profile_left_info1_content_title_name">
                            <?=$model->surname.' '.$model->first_name.' '.$model->lastname?>
                        </div>
                        <div class="lc-right__block1_profile_left_info1_content_title_id">
                            ID: <?=Yii::$app->user->id?>
                        </div>
                    </div>
                    <div class="lc-right__block1_profile_left_info1_content_city">
                         <?=mb_substr($model::getSexArray()[$model->sex],0,1,'UTF-8')?>, <?=date('d.m.Y',strtotime($model->birthday))?>, <?=$model->city?>
                    </div>
                    <!--<div class="lc-right__block1_profile_left_info1_content_email">
                        <div class="lc-right__block1_profile_left_info1_content_email_text">
                            kilinanatoly@gmail.com
                        </div>
                        <div class="lc-right__block1_profile_left_info1_content_email_approve">
                            | Подтверждено
                        </div>
                    </div>-->
                    <div class="lc-right__block1_profile_left_info1_content_tel">
                        <div class="lc-right__block1_profile_left_info1_content_tel_text">
                            +7<?=$model->username?>
                        </div>
                        <div class="lc-right__block1_profile_left_info1_content_tel_approve">
                            | Подтверждено
                        </div>
                    </div>
                </div>
            </div>
            <div class="lc-right__block1_profile_left_change-pass">
                <div class="lc-right__block1_profile_left_change-pass_title">
                    Быстрая смена пароля
                </div>
                <div class="lc-right__block1_profile_left_change-pass_content">
                    <div class="lc-right__block1_profile_left_change-pass_content_form">
                        <div class="lc-right__block1_profile_left_change-pass_content_form_inputs">
                            <?php $form = ActiveForm::begin(['id' => 'form-password']); ?>
                            <?php if ($model->password_hash != '') : ?>
                                <?= $form->field($changePasswordForm, 'old_password', [
                                    'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                                ])->passwordInput(); ?>
                            <?php endif; ?>
                            <?= $form->field($changePasswordForm, 'new_password', [
                                'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                            ])->passwordInput(); ?>
                            <?= $form->field($changePasswordForm, 'new_password_repeat', [
                                'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                            ])->passwordInput(); ?>
                        </div>
                        <div class="lc-right__block1_profile_left_change-pass_content_form_btn">
                            <button type="submit">
                                <span class="img"><img src="<?=$imagePath?>/images/save2.png" alt=""></span>
                                <span class="text">Сохранить</span>
                            </button>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="lc-right__block1_profile_left_change-pass_content_i">
                        <div class="lc-right__block1_profile_left_change-pass_content_i_img">
                            <img src="<?= $imagePath ?>/images/i1.png" alt="">
                        </div>
                        <div class="lc-right__block1_profile_left_change-pass_content_i_text">
                            Введите свой текущий пароль,
                            новый пароль, и повторите ввод
                            нового пароля, чтобы исключить
                            возможность опечатки.
                        </div>
                    </div>

                </div>
            </div>
            <div class="lc-right__block1_profile_left_tech">
                <div class="lc-right__block1_profile_left_tech_title">
                    Техническая поддержка
                </div>
                <div class="lc-right__block1_profile_left_tech_content">
                    <div class="lc-right__block1_profile_left_tech_content_text1">
                        <span>Ваш ID: <?=Yii::$app->user->id?></span>
                        (необходим, если вы обратились в техническую поддержку по почте или телефону)
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lc-right__block2 ">
        <div class="lc-right__block2_profile_right">
            <?php $form = ActiveForm::begin(['id' => 'form-profile', 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="lc-right__block2_profile_right_title">
                <div class="name">
                    Редактирование профиля
                </div>
                <div class="save">
                    <button type="submit">
                        <span class="img">
                            <img src="<?=$imagePath?>/images/save1.png" alt="">
                        </span>
                        <span class="text">
                            Сохранить изменения
                        </span>
                    </button>
                </div>
            </div>
            <div class="lc-right__block2_profile_right_info1">
                <?=Yii::$app->getSession()->getFlash('success');?>
                <div class="lc-right__block2_profile_right_info1_form">
                    <?= $form->field($model, 'surname', [
                        'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                    ]) ?>
                    <?= $form->field($model, 'first_name', [
                        'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                    ]) ?>
                    <?= $form->field($model, 'lastname', [
                        'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                    ]) ?>
                    <?= $form->field($model, 'sex', [
                        'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                    ])->dropDownList($model::getSexArray()) ?>

                    <?= $form->field($model, 'birthday', [
                        'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                    ])->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '99.99.9999',
                    ]) ?>
                    <?= $form->field($model, 'city', [
                        'template' => '<div class="label1">{label}</div>{input}{error}{hint}'
                    ]) ?>
                </div>

                <div class="lc-right__block2_profile_right_info1_form_photo">
                    <div class="lc-right__block2_profile_right_info1_form_photo_img" style="background-image: url('<?=$model->photo ? '/images/users/'.$model->photo.'' : '/images/site_images/no_object.png'?>')">

                    </div>
                    <div class="lc-right__block2_profile_right_info1_form_photo_actions">
                        <a href="#">Удалить фото</a>
                    </div>
                    <div class="lc-right__block2_profile_right_info1_form_photo_new">
                        <?php
                        echo $form->field($model, 'imageFile')->widget(\kartik\file\FileInput::classname(), [
                            'options' => ['multiple' => false, 'accept' => 'image/*'],
                            'pluginOptions' => ['showUpload' => false,'previewFileType' => 'image',],
                        ]);
                        ?>
                    </div>

                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>


