<?php
$this->title = 'Добавление объекта';
$this->params['breadcrumbs'][] = $this->title;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\file\FileInputAsset;
FileInputAsset::register($this);
FileInputAsset::register($this);
?>
<?php
echo Yii::$app->getSession()->getFlash('success');
?>
<?php
$assets = \app\modules\lc\assets\LcAsset::register($this);
$imagePath = $assets->baseUrl;
$this->registerJsFile(''.$imagePath.'/js/dragger.js');


?>
<div class="lc-index-right">

    <?=$this->render('head1',[
        'imagePath'=>$imagePath
    ])?>
    <div class="lc-index-right__bread">
        <div class="lc-index-right__bread_text1">
            Управление объектами
        </div>
        <div class="lc-index-right__bread_text2">
            Добавляйте или редактируйте свои объекты
        </div>
    </div>
    <div class="lc-index-right__informers">
        <div class="lc-index-right__informers_left">
            <div class="lc-index-right__informers_left_add_block1">
                <div class="lc-index-right__informers_left_add_block1_title">
                    <div class="lc-index-right__informers_left_add_block1_title_name">
                        Ваши объекты
                    </div>
                    <div class="lc-index-right__informers_left_add_block1_title_add">
                        <a href="/lc/add">Добавить объект</a>
                    </div>
                </div>
                <div class="lc-index-right__informers_left_add_block1_list1">
                    <?php foreach ($objects as $key=>$value) : ?>
                        <div class="lc-index-right__informers_left_add_block1_list1_item">
                            <div class="lc-index-right__informers_left_add_block1_list1_item_info1">
                                <div class="lc-index-right__informers_left_add_block1_list1_item_info1_img <?=$value->photo ? '' : 'no_photo'?>" style="background-image: url('<?=($value->photo ? '/images/isp_objects/'.$value->photo->image.'' : '/images/site_images/no_object.png')?>')">

                                </div>
                                <div class="lc-index-right__informers_left_add_block1_list1_item_info1_content">
                                    <div class="lc-index-right__informers_left_add_block1_list1_item_info1_content_title">
                                    <span class="text">
                                        <?=$value->name?>
                                    </span>
                                        <span class="actions">
                                        <!--<a href="#">
                                            <img src="<?/*= $imagePath */?>/images/stat1.png" alt="">
                                        </a>-->
                                        <a class="eye" target="_blank" href="<?=\app\models\Functions::getObjectUrl($value->id)?>">
                                            <img src="<?= $imagePath ?>/images/eye1.png" alt="">
                                        </a>
                                        <a href="/lc/edit?id=<?=$value->id?>">
                                            <img src="<?= $imagePath ?>/images/edit1.png" alt="">
                                        </a>
                                    </span>
                                    </div>
                                    <div class="lc-index-right__informers_left_add_block1_list1_item_info1_content_actions1">
                                        <div class="lc-index-right__informers_left_add_block1_list1_item_info1_content_actions1_edit">
                                        <span class="img">
                                            <img src="<?=$imagePath?>/images/edit1.png" alt="">
                                        </span>
                                            <span class="text">
                                            <a href="/lc/edit?id=<?=$value->id?>">Редактировать объект</a>
                                        </span>
                                        </div>
                                        <div class="lc-index-right__informers_left_add_block1_list1_item_info1_content_actions1_delete">
                                        <span class="img">
                                            <img src="<?=$imagePath?>/images/delete1.png" alt="">
                                        </span>
                                            <span class="text">
                                            <a class="delete" data-id="<?=$value->id?>" href="#">Удалить объект</a>
                                        </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php if ($value->homes) : ?>
                                <div class="lc-index-right__informers_left_add_block1_list1_item_info2">
                                    <div class="lc-index-right__informers_left_add_block1_list1_item_info2_title">
                                        Варианты размещения
                                    </div>
                                    <div class="lc-index-right__informers_left_add_block1_list1_item_info2_list1">
                                        <div class="lc-index-right__informers_left_add_block1_list1_item_info2_list1_item">
                                            <div class="lc-index-right__informers_left_add_block1_list1_item_info2_list1_item_title">
                                                <div class="lc-index-right__informers_left_add_block1_list1_item_info2_list1_item_title_name">
                                                    <a href="#">Дома</a>
                                                </div>
                                                <div class="lc-index-right__informers_left_add_block1_list1_item_info2_list1_item_title_caret">
                                                    <!--<span class="text">50 мест</span>-->
                                                    <span class="img">
                                                <a href="#">
                                                    <img src="<?= $imagePath ?>/images/arrow-down1.png" alt="">
                                                </a>
                                            </span>
                                                </div>
                                            </div>
                                            <ul>
                                                <?php if ($value->homes) : ?>
                                                    <?php foreach ($value->homes as $key2=>$value2) : ?>
                                                        <li>Дом #<?=$key2+1?></li>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>


                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <div class="lc-index-right__informers_right">
            <?php if (true) : ?>
                <div class="lc-index-right__informers_right_add_block1">

                    <div class="lc-index-right__informers_right_title">
                        <div class="lc-index-right__informers_right_title_name">
                            Добавление объекта
                        </div>
                        <div class="lc-index-right__informers_right_title_btn add">
                            <?= \yii\bootstrap\Html::submitButton('Сохранить изменения', ['class' => '']) ?>
                        </div>
                    </div>
                    <div class="lc-index-right__informers_right_add_block1_list1">
                        <div class="lc-index-right__informers_right_add_block1_list1_item active">
                            <div class="lc-index-right__informers_right_add_block1_list1_item_title">
                            <span class="text">
                                <a href="#">Основная информация объекта</a>
                            </span>
                                <span class="arrow">
                                <a href="#">
                                    <img src="<?= $imagePath ?>/images/arrow-down1.png" alt="">
                                </a>
                            </span>
                            </div>
                            <div class="lc-index-right__informers_right_add_block1_list1_item_content">
                                <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data','data-pjax' => true]]); ?>
                                <?=$this->render('add_form',[
                                    'form'=>$form,
                                    'model'=>$model,
                                    'image_path'=>$imagePath,
                                ]);?>
                                <div class="lc-index-right__informers_right_add_block1_list1_item_content_homes_btn">
                                    <button type="submit">
                                        <span class="img"><img src="<?=$imagePath?>/images/save2.png" alt=""></span>
                                        <span class="text">Сохранить</span>
                                    </button>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>

</div>
