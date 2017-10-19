<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Cats */
/* @var $form ActiveForm */
?>
<div class="site-cats_update_form">

       <?php $form = ActiveForm::begin([
           'id'=>'form1',
        'options' => [
            'enctype' => 'multipart/form-data',
            'data-pjax' => ''
        ]])
    ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'metatitle') ?>
    <?= $form->field($model, 'metakeywords') ?>
    <?= $form->field($model, 'metadescription')->textarea() ?>
    <?php if ($model->image) : ?>
    <?php endif;?>
        <div class="site-cats_update_form_img">
            <p><b>Текущая картинка:</b></p>
            <p><img class="img200" src="/images/cats/<?=$model->image?>" </p>
        </div>
    <?=  $form->field($model, 'imageFile')->widget(\kartik\file\FileInput::className(), [
        'options' => ['accept' => 'image/*', 'multiple' => false],
    ]);?>
    <?= $form->field($model, 'sort') ?>
    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'text_information')->checkbox() ?>
    <?php
    if ($model->text_information==1){
    echo $form->field($model, 'text')->widget(\vova07\imperavi\Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 400,
            'replaceTags' => false,
            'replaceDivs' => false,
            'maxHeight' => 400,
            'imageUpload' => \yii\helpers\Url::to(['/site/image-upload']),
            'fileUpload' => \yii\helpers\Url::to(['/site/file-upload']),
            'plugins' => [
                'clips',
                'fullscreen',
                'fontsize',
                'fontcolor',
                'table',
                'filemanager'
            ]
        ]
    ]);
    }
     ?>
    <div class="admin-cats-update__chars">
        <div class="left">
            <p><b>Технические характеристики категории</b></p>
            <select name="attributes[]" id="attributes" multiple="multiple" style="overflow-y: scroll ">
                <?php
                $tmp = [];
                //если редактирование то делаем выборку прикрепленных атрибутов
                if (!$model->isNewRecord){
                    $characteristics = \app\models\CharacteristicsForCats::find()->where(['cat_id'=>$model->id])->all();
                    foreach ($characteristics as $key => $value) {
                        echo '<option value="'.$value['characteristic_id'].'" >'.$value->characteristics->name.'('.$value->characteristics->ident.')'.'</option>';
                        $tmp[] = $value['characteristic_id'];
                    }

                }
                ?>
            </select>
        </div>
        <div class="right">
            <p><b>Доступные технические характеристики</b></p>
            <select name="attributes1[]" id="attributesList" multiple="multiple" style="overflow-y: scroll ">
                <?php
                //делаем выборку аттрибутов
                $characteristics = \app\models\Characteristics::find()->orderBy(['name'=>SORT_DESC])->asArray()->all();
                foreach ($characteristics as $key => $value) {
                    if (!in_array($value['id'],$tmp)){
                        echo '<option value="'.$value['id'].'" data-id="'.$value['id'].'">'.$value['name'].'('.$value['ident'].')'.'</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <div class="sort">
        <?php
        if (!$model->isNewRecord){
            echo '<h3>Сортировка аттрибутов:</h3>';
            $characteristics = \app\models\CharacteristicsSort::find()
                ->innerJoinWith('catsforhars')
                ->where(['characteristics_sort.cat_id'=>$model->id])
                ->orderBy(['characteristics_sort.sort'=>SORT_DESC])
                ->all();
            foreach ($characteristics as $key => $value) {
                echo '<p>'.$value->characteristics->name.'<input type="text" name="sort['.$value->characteristic_id.']" class="form-control" value="'.$value->sort.'"/></p>';
            }
            if (!$characteristics) echo '<p>Для сортировки аттрибутов добавьте их в форме выше.</p>';

        }
        ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-cats_form -->
