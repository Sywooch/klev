<?php
use kartik\file\FileInput;
use yii\bootstrap\BootstrapAsset;

?>
<style>
    body, html {
        padding: 0;
        margin: 0;
        font-family: Arial;
    }
    #map {
        width: 100%;
        height: 200px;
    }

    #marker {
        background-image: url('<?=$image_path?>/images/baloon1.png');
        width: 33px;
        height: 36px;
        position: absolute;
        z-index: 0;
        bottom: 50%;
        margin-bottom:-18px;
        left: 50%;
        margin-left: -16px;
    }
    .header {
        padding: 5px;
    }
</style>
<div class="lc-index-right__informers_right_add_block1_list1_item_content_form pjax1">
    <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_name">
        <?= $form->field($model, 'name') ?>
    </div>
    <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_description1">
        <?= $form->field($model, 'description1')->textarea() ?>
    </div>
    <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_price1">
        <?= $form->field($model, 'price1') ?>
    </div>
    <div class="default-add_form_homes_content_services">
        <div class="default-add_form_homes_content_services_label">
            Услуги
        </div>
        <div class="default-add_form_homes_content_services_label_content">
            <div class="default-add_form_homes_content_services_label_content_item">
                <label>
                    <input type="checkbox" value="1" <?=$model->lodki ? 'checked' : ''?>  name="lodki" />
                    <span class="img"></span>
                    <span class="text">Предоставление лодок</span>
                </label>
            </div>
            <div class="default-add_form_homes_content_services_label_content_item">
                <label>
                    <input type="checkbox" value="1" <?=$model->pitanie ? 'checked' : ''?> name="pitanie" />
                    <span class="img"></span>
                    <span class="text">Питание и напитки</span>
                </label>
            </div>
            <div class="default-add_form_homes_content_services_label_content_item">
                <label>
                    <input type="checkbox" value="1" <?=$model->snasti ? 'checked' : ''?> name="snasti" />
                    <span class="img"></span>
                    <span class="text">Аренда снастей</span>
                </label>
            </div>
        </div>
    </div>
    <?php
    // Usage with ActiveForm and model
    echo $form->field($model, 'fishes')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Fishes::find()->orderBy('name ASC')->all(),'id','name'),
        'options' => ['placeholder' => ''],
        'options' => [
            'placeholder' => 'Выберите рыб...',
            'multiple' => true
        ],
    ]);
    ?>

    <?php
    $template = '<span>{{value}} ({{region}})</span>';
    echo $form->field($model, 'tmp_city',[
        'template' => '{label} 
                        <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_city">
                        {input}
                        </div>
                        {error}{hint}',
    ])->widget(\kartik\typeahead\Typeahead::classname(), [
        'dataset' => [
            [
                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                'display' => 'value',
                'templates' => [
                    'notFound' => '<div class="text-danger" style="padding:8px;">Город не найден!</div>',
                    'suggestion' => new \yii\web\JsExpression("Handlebars.compile('{$template}')")
                ],
                'remote' => [
                    'url' => \yii\helpers\Url::to(['/regions/admin/adminregionslist']) . '?q=%QUERY',
                    'wildcard' => '%QUERY'
                ]
            ]
        ],
        'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Введите ближайший город ...'],
    ]);
    ?>

    <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_geo">
        <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_geo_label">
            Укажите местоположение:
        </div>
        <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_geo_content">
            <div id="map"></div>
            <div id="marker"></div>
        </div>

        <?= $form->field($model, 'geo',['template'=>'{input}'])->hiddenInput() ?>
    </div>
    <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_maxulov">
        <?= $form->field($model, 'max_ulov') ?>
    </div>
    <?php if (!$model->isNewRecord && $model->photos) : ?>
        <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_current_photos">
            <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_current_photos_label">
                Текущие фотографии:
            </div>
            <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_current_photos_content">
                <?php foreach ($model->photos as $key=>$value) : ?>
                    <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_current_photos_content_item" style="background-image: url(/images/isp_objects/<?=$value->image?>)">
                        <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_current_photos_content_item_close">
                            <a href="#" data-id="<?=$value->id?>"><img src="<?= $image_path ?>/images/close1.png" alt=""></a>
                        </div>  
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    <?php endif;?>
    <div class="lc-index-right__informers_right_add_block1_list1_item_content_form_images">
        <?php
        echo $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => ['showUpload' => false,'previewFileType' => 'image','maxFileCount' => 10],
        ]);
        ?>
    </div>
</div>