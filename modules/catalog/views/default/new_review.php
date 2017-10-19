<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */
/* @var $form ActiveForm */
?>
<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#my-pjax1").on("pjax:end", function() {
                 $(".default-new_review").slideUp("slow");
                    var destination = $(\'.custom-alert1\').offset().top;
                    console.log(destination);
                    $(\'body,html\').animate({
                        scrollTop: destination -50
                    }, 1000);
                 setInterval(function(){
                    $(".custom-alert1").fadeOut("fast");
                 },3000);
            });
    });'
);
?>
<?php \yii\widgets\Pjax::begin(['id'=>'my-pjax1'])?>
<?=Yii::$app->getSession()->getFlash('alert');?>
<div class="default-new_review">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
        <div class="view-object1__wrap_new_review_form">
            <form action="" method="post">
                <div class="view-object1__wrap_new_review_form_title">
                    <?= $form->field($model, 'title')->textInput(['placeholder'=>'Заголовок отзыва*']) ?>
                </div>
                <div class="view-object1__wrap_new_review_form_name">
                    <?= $form->field($model, 'author')->textInput(['placeholder'=>'Ваше имя*']) ?>
                </div>
                <div class="view-object1__wrap_new_review_form_city">
                    <?= $form->field($model, 'city')->textInput(['placeholder'=>'Ваш город*']) ?>
                </div>
                <div class="view-object1__wrap_new_review_form_pluses">
                    <?= $form->field($model, 'pluses')->textInput(['placeholder'=>'Опишите, пожалуйста, плюсы']) ?>
                </div>
                <div class="view-object1__wrap_new_review_form_right_minuses">
                    <?= $form->field($model, 'minuses')->textInput(['placeholder'=>'Опишите, пожалуйста, минусы']) ?>
                </div>
                <div class="view-object1__wrap_new_review_form_right_rate">
                    <div class="view-object1__wrap_new_review_form_right_title">
                        <?= $form->field($model, 'ocenka')->radioList([1,2,3,4,5,6,7,8,9,10])->hiddenInput() ?>
                    </div>
                    <div class="view-object1__wrap_new_review_form_right_list">
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="1">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="2">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="3">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="4">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="5">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="6">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="7">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="8">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>
                        <div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="9">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div><div class="view-object1__wrap_new_review_form_right_list_item">
                            <a href="#" data-eval="10">
                                <img src="<?=$imagePath?>/images/zv_yellow2.png" alt="">
                            </a>
                        </div>

                    </div>
                </div>


                <div class="view-object1__wrap_new_review_form_btn">
                    <button data-loading-text="Подождите..." type="submit">Отправить отзыв</button>
                </div>
            </form>
        </div>


        <div class="form-group">
        </div>
        <?php ActiveForm::end(); ?>

</div><!-- default-new_review -->
<?php \yii\widgets\Pjax::end();?>
