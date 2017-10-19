<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Functions;
use app\modules\lc\assets\LcAsset;
use yii\widgets\Pjax;

AppAsset::register($this);
LcAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Личный кабинет</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
$assets = \app\modules\lc\assets\LcAsset::register($this);
$imagePath = $assets->baseUrl;
?>
        <div class="executor">
            <?=$this->render('modals',[
              'imagePath'=>$imagePath
            ]);?>
            <?=$this->render('left_sidebar',[
            ]);?>
            <?= $content ?>
        </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
