<?php
$this->title = 'Редактирование объекта «'.$model->name.'»';
$this->params['breadcrumbs'][] = $this->title;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\file\FileInputAsset;
?>
<?php
echo Yii::$app->getSession()->getFlash('success');
?>
<?php
$assets = \app\modules\lc\assets\LcAsset::register($this);
$imagePath = $assets->baseUrl;
$this->registerJsFile(''.$imagePath.'/js/dragger.js');

//маркер конца строки, обязательно сразу, без пробелов и табуляции
?>
<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#my-pjax").on("pjax:beforeSend", function() {
                 $(".lc-index-right__informers_right_add_block1").addClass("blured");
            });
            $("#my-pjax").on("pjax:end", function() {
                 init(); 
                 $("#my-pjax *").removeClass("has-success");
                 var int1 = setInterval(function(){
                    $(".lc-index-right__informers_right_add_block1").removeClass("blured");
                     $(".custom-alert2").fadeIn("slow");
                 },1000);
                 var int2 = setInterval(function(){
                    $(\'.lc-index-right__informers_right_add_block1\').animate({
                        scrollTop: 0
                    }, 1000);
                    $(\'.body,html\').animate({
                        scrollTop: 0
                    }, 1000);
                    setInterval(function(){
                       $(".custom-alert2").fadeOut("slow");
                     },4000);
                    clearInterval(int1);
                    clearInterval(int2);
                 },2000);
            });
            $("#my-pjax1").on("pjax:end", function() {
                 $(".custom-alert1").fadeIn("fast");
                 setInterval(function(){
                    $(".custom-alert1").fadeOut("fast");
                 },3000);
                 $(\'.lc-index-right__informers_right_add_block1_list1_item_content_item.new #isphomes-room_counts\').val(\'1\');
                 $(\'.lc-index-right__informers_right_add_block1_list1_item_content_item.new #isphomes-people-counts\').val(\'5\');
            });
    });'
);
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
            <div class="lc-index-right__informers_left_add_block1 lc_mh4">
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
                                        <a href="/lc/edit?id=<?=$value->id?>" title="Редактировать">
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
                                            <?php foreach ($value->homes as $key2=>$value2) : ?>
                                                <li>Дом #<?=$key2+1?></li>
                                            <?php endforeach;?>
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
                <div class="lc-index-right__informers_right_add_block1 lc_mh4">
                    <div class="lc-index-right__informers_right_title">
                        <div class="lc-index-right__informers_right_title_name">
                            Редактирование объекта <?=$model->name?>
                        </div>
                        <div class="lc-index-right__informers_right_title_btn edit">
                            <button>
                                Сохранить изменения
                            </button>
                        </div>
                    </div>
                    <div class="lc-index-right__informers_right_add_block1_list1">
                        <div class="lc-index-right__informers_right_add_block1_list1_item active ">
                            <div class="custom-alert2 alert alert-success">Изменения успешно сохранены</div>
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
                            <div class="lc-index-right__informers_right_add_block1_list1_item_content pjax1">
                                <?php Pjax::begin(['id' => 'my-pjax']); ?>
                                <?php
                                ?>

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
                                <?php Pjax::end(); ?>
                            </div>
                        </div>
                        <div class="lc-index-right__informers_right_add_block1_list1_item ">
                            <div class="lc-index-right__informers_right_add_block1_list1_item_title">
                                <span class="text">
                                    <a class="more" href="#">Дома</a>
                                </span>
                                    <span class="arrow">
                                    <a class="more" href="#">
                                        <img src="<?= $imagePath ?>/images/arrow-down1.png" alt="">
                                    </a>
                                </span>

                            </div>
                            <div class="lc-index-right__informers_right_add_block1_list1_item_content pjax2 homes">
                                <?php Pjax::begin(['id' => 'my-pjax1']); ?>
                                <?php $form2 = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data','data-pjax' => true]]); ?>
                                <div class="lc-index-right__informers_right_add_block1_list1_item_content_homes">
                                    <?php foreach ($homes as $key=>$value) : ?>
                                        <?php $current_services_total = [];?>
                                        <?php $home_model->names[$key] = $value->name; ?>
                                        <?php $home_model->room_counts[$key] = $value->room_count; ?>
                                        <?php $home_model->people_counts[$key] = $value->people_count; ?>
                                        <?php $home_model->ids[$key] = $value->id; ?>
                                        <?php $home_model->prices[$key] = $value->price; ?>
                                        <?php $home_model->descriptions[$key] = $value->description; ?>

                                        <div class="lc-index-right__informers_right_add_block1_list1_item_content_item">
                                            <div class="default-add_form_homes">
                                                <div class="default-add_form_homes_title">
                                                    <span class="text">
                                                        <a href="#">Дом № <?=$key+1;?></a>
                                                    </span>
                                                    <span class="img">
                                                        <a href="#"><img src="<?=$imagePath?>/images/arrow-down3.png" alt=""></a>
                                                    </span>
                                                    <span class="img2">
                                                        <a href="#" data-id="<?=$value->id?>"><img src="<?=$imagePath?>/images/delete-button.png" alt=""></a>
                                                    </span>
                                                </div>
                                                <div class="default-add_form_homes_content">
                                                    <?= $form2->field($home_model, 'names[' . $key . ']')->textInput() ?>
                                                    <?= $form->field($home_model, 'ids[' . $key . ']')->hiddenInput()->label(false) ?>
                                                    <?= $form2->field($home_model, 'room_counts[' . $key . ']',[
                                                        'template' => '{label} 
                                                        <div class="default-add_form_homes_content_room_count">
                                                            <a href="#" class="minus"><img src="'.$imagePath.'/images/left1.png"> </a>
                                                                {input}
                                                            <a href="#" class="plus"><img src="'.$imagePath.'/images/right1.png"></a>
                                                        </div>
                                                        {error}{hint}',
                                                    ]) ?>
                                                    <?= $form2->field($home_model, 'people_counts[' . $key . ']',[
                                                        'template' => '{label} 
                                                        <div class="default-add_form_homes_content_room_count">
                                                            <a href="#" class="minus"><img src="'.$imagePath.'/images/left1.png"> </a>
                                                                {input}
                                                            <a href="#" class="plus"><img src="'.$imagePath.'/images/right1.png"></a>
                                                        </div>
                                                        {error}{hint}',
                                                    ]) ?>
                                                    <?= $form2->field($home_model, 'prices[' . $key . ']',[
                                                        'template' => '{label} 
                                                        <div class="default-add_form_homes_content_price">
                                                                {input}
                                                        </div>
                                                        {error}{hint}',
                                                    ]) ?>
                                                    <?= $form2->field($home_model, 'descriptions[' . $key . ']')->textarea() ?>
                                                    <div class="default-add_form_homes_content_services">
                                                        <div class="default-add_form_homes_content_services_label">
                                                            Удобства
                                                        </div>
                                                        <div class="default-add_form_homes_content_services_label_content">
                                                            <?php
                                                                $current_services = $value->comfort;
                                                                if ($current_services){
                                                                    foreach ($current_services as $key5=>$value5) {
                                                                        $current_services_total[$key][] = $value5['comfort_id'];
                                                                    }
                                                                }
                                                            ?>
                                                            <?php foreach ($services as $key4=>$value4) : ?>
                                                                <div class="default-add_form_homes_content_services_label_content_item">
                                                                    <label>
                                                                        <input type="checkbox" value="<?=$value4->id?>" <?=isset($current_services_total[$key]) && in_array($value4->id,$current_services_total[$key]) ? 'checked' : ''?> name="IspHomes[services][<?=$value->id?>][]" />
                                                                        <span class="img"></span>
                                                                        <span class="text"><?=$value4->name?></span>
                                                                    </label>
                                                                </div>
                                                            <?php endforeach;?>
                                                        </div>
                                                    </div>

                                                    <div class="default-add_form_homes_content_files">
                                                        <?php if ($value->photos) : ?>
                                                            <div class="default-add_form_homes_content_files_current">
                                                                <div class="default-add_form_homes_content_files_current_label">
                                                                    <div class="text1">
                                                                        Фотографии дома
                                                                    </div>
                                                                    <div class="text2">
                                                                        Вы можете прикрепить всего 4 фотографии
                                                                    </div>
                                                                </div>
                                                                <div class="default-add_form_homes_content_files_current_content">
                                                                    <div class="default-add_form_homes_content_files_current_content_list1">

                                                                        <?php foreach ($value->photos as $key3=>$value3) : ?>
                                                                            <div class="default-add_form_homes_content_files_current_content_list1_item" style="background-image: url(/images/home_photos/<?=$value3->image?>)">
                                                                                <div class="default-add_form_homes_content_files_current_content_list1_item_close">
                                                                                    <a href="#" data-id="<?=$value3->id?>">
                                                                                        <img src="<?= $imagePath ?>/images/close1.png"
                                                                                             alt="">
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        <?php endforeach;?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif;?>
                                                        <div class="default-add_form_homes_content_files_new">
                                                            <?php
                                                            echo $form->field($home_model, 'imageFiles['.$key.'][]')->widget(\kartik\file\FileInput::classname(), [
                                                                'options' => ['multiple' => true],
                                                                'pluginOptions' => [
                                                                    'showPreview' => false,
                                                                    'showRemove' => false,
                                                                    'showUpload' => false,
                                                                ]
                                                            ]);
                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div><!-- default-add_form_homes -->

                                       </div>
                                    <?php endforeach;?>
                                    <div class="custom-alert1">
                                        <div class="alert alert-success">Изменения успешно сохранены</div>
                                    </div>
                                    <div class="lc-index-right__informers_right_add_block1_list1_item_content_item new">
                                        <div class="lc-index-right__informers_right_add_block1_list1_item_content_item_title">
                                            <a href="#">
                                                <span class="text">Добавить дом</span>
                                                <span class="img"><img src="<?= $imagePath ?>/images/plus1.png" alt=""></span>
                                            </a>
                                        </div>
                                        <div class="default-add_form_homes">
                                            <?= $form2->field($home_model, 'names[]')->textInput() ?>
                                            <?= $form2->field($home_model, 'room_counts[]',[
                                                'template' => '{label} 
                                                        <div class="default-add_form_homes_content_room_count">
                                                            <a href="#" class="minus"><img src="'.$imagePath.'/images/left1.png"> </a>
                                                                {input}
                                                            <a href="#" class="plus"><img src="'.$imagePath.'/images/right1.png"></a>
                                                        </div>
                                                        {error}{hint}',
                                            ]) ?>
                                            <?= $form2->field($home_model, 'people_counts[]',[
                                                'template' => '{label} 
                                                        <div class="default-add_form_homes_content_room_count">
                                                            <a href="#" class="minus"><img src="'.$imagePath.'/images/left1.png"> </a>
                                                                {input}
                                                            <a href="#" class="plus"><img src="'.$imagePath.'/images/right1.png"></a>
                                                        </div>
                                                        {error}{hint}',
                                            ]) ?>
                                                <?= $form2->field($home_model, 'prices[]',[
                                                    'template' => '{label} 
                                                        <div class="default-add_form_homes_content_price">
                                                                {input}
                                                        </div>
                                                        {error}{hint}',
                                                ]) ?>
                                            <?= $form2->field($home_model, 'descriptions[]')->textarea() ?>

                                            <div class="default-add_form_homes_content_services">
                                                <div class="default-add_form_homes_content_services_label">
                                                    Удобства
                                                </div>
                                                <div class="default-add_form_homes_content_services_label_content">
                                                    <?php foreach ($services as $key4=>$value4) : ?>
                                                        <div class="default-add_form_homes_content_services_label_content_item">
                                                            <label>
                                                                <input type="checkbox" value="<?=$value4->id?>"  name="IspHomes[services][new][]" />
                                                                <span class="img"></span>
                                                                <span class="text"><?=$value4->name?></span>
                                                            </label>
                                                        </div>
                                                    <?php endforeach;?>
                                                </div>
                                            </div>
                                            <div class="default-add_form_homes_files">
                                                <?php
                                                echo $form->field($home_model, 'imageFiles['.'new'.'][]')->widget(\kartik\file\FileInput::classname(), [
                                                    'options' => ['multiple' => true],
                                                    'pluginOptions' => [
                                                        'showPreview' => false,
                                                        'showRemove' => false,
                                                        'showUpload' => false,
                                                    ]
                                                ]);
                                                ?>
                                            </div>
                                        </div>
                                    <div class="lc-index-right__informers_right_add_block1_list1_item_content_homes_btn">
                                        <button type="submit">
                                            <span class="img"><img src="<?=$imagePath?>/images/save2.png" alt=""></span>
                                            <span class="text">Сохранить</span>
                                        </button>
                                    </div>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                                <?php Pjax::end();?>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
    </div>

</div>
