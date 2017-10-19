<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#main" data-toggle="tab">Общая информация</a></li>
        <li><a href="#cats" data-toggle="tab">Категории</a></li>
        <li><a href="#images" data-toggle="tab">Изображения</a></li>
        <li><a href="#characteristics" data-toggle="tab">Характеристики</a></li>
    </ul>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="main">

            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'short_description')->textInput() ?>
            <?= $form->field($model, 'metatitle') ?>
            <?= $form->field($model, 'metakeywords') ?>
            <?= $form->field($model, 'metadescription')->textarea() ?>
            <?= $form->field($model, 'price')->textInput() ?>
            <?= $form->field($model, 'spec')->checkbox() ?>
            <?= $form->field($model, 'new')->checkbox() ?>
            <?= $form->field($model, 'best_price')->checkbox() ?>
            <?= $form->field($model, 'active')->checkbox() ?>
           <?php
    echo $form->field($model, 'description')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);

    ?>
        </div>
        <div class="tab-pane" id="cats">
            <div class="cats admin-update-products__cats">
                <?php
                    if ($model->isNewRecord){
                        $cats_model = new \app\models\Cats();
                        $get_cat = Yii::$app->request->get('cat_id') ? Yii::$app->request->get('cat_id') : null;
                        $config['cats1'] = $get_cat;
                        $all_cats = $cats_model->view_cat_for_product($cats_model->get_cat(),0,$config);
                        echo $all_cats;
                    }else{
                        $cats_model = new \app\models\Cats();
                        $config['cats'] = \app\models\CatsForProducts::find()->where(['product_id'=>$model->id])->asArray()->all();
                        $all_cats = $cats_model->view_cat_for_product($cats_model->get_cat(),0,$config);
                        echo $all_cats;
                    }
                ?>
            </div>
        </div>
        <div class="tab-pane" id="images">
            <?php
            if (!$model->isNewRecord){
                foreach ($images as $key => $value) {
                    echo '
                    <div class="image">
                        <p><img class="img-responsive img200" src="/images/products/'.$value['url'].'"> </p>
                        <p><label><input type="checkbox" name="deleteimage['.$value['id'].']">Удалить</label></p>
                        <p><label><input type="radio" name="mainimage" '.($value['main_image'] ? ' checked ': '').'value="'.$value['id'].'">Главная</label></p>
                    </div>
                    ';
                }

            }
            if (!$model->isNewRecord){
                if ($files){
                    echo '<hr>';
                    foreach ($files as $key => $value) {
                        echo '
                    <div class="images">
                        <p><label>'.$value['url'].'<input style="margin-left:10px;" type="checkbox" name="deletefile['.$value['id'].']">Удалить</label></p>
                    </div>
                    ';
                    }
                    echo '<hr>';
                }

            }

            ?>
           <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
           <?= $form->field($model, 'files[]')->fileInput(['multiple' => true]) ?>

        </div>
        <div class="tab-pane" id="characteristics" data-product_id="<?=$model->id?>">
            <?php
                if ($model->isNewRecord){
                    if (Yii::$app->request->get('cat_id')){
                        $functions = new \app\models\Functions();
                        $chars = $functions->getcharacteristics(Yii::$app->request->get('cat_id'));
                        echo $chars;
                    }
                }else{
                    $functions = new \app\models\Functions();
                    $config['characteristics_for_product'] = \app\models\CharacteristicsForProducts::find()->where(['product_id'=>$model->id])->asArray()->all();
                    $config['product_id'] = $model->id;

                    $chars = $functions->getcharacteristics($model->cat->cat_id,$config);
                    echo $chars;
                }
            ?>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
