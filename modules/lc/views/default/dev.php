<?php
$this->title = 'Извините, данная страница находится в разработке';
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

//маркер конца строки, обязательно сразу, без пробелов и табуляции
?>
<div class="lc-index-right">
    <?=$this->render('head1',[
        'imagePath'=>$imagePath
    ])?>
    <div class="lc-index-right__bread">
        <div class="lc-index-right__bread_text1">
            Главная страница панели управления
        </div>
        <div class="lc-index-right__bread_text2">
            Управляйте всем из одного места
        </div>
    </div>
    <div class="lc-index-right__informers">
        <div class="lc-index-right__informers_left">
            <div class="lc-index-right__informers_left_add_block1 lc_mh4">
                <div class="lc-index-right__informers_left_add_block1_alert">
                    <div class="alert alert-danger">Извините, данная страница находится в разработке</div>
                </div>
            </div>
        </div>
    </div>

</div>
