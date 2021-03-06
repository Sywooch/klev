<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">

    <meta name="viewport" content="width=1280">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Euroboor-rus.ru</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap cats_layout">
    <?= $this->render('@app/views/layouts/modals') ?>
    <?= $this->render('@app/views/layouts/header1') ?>
    <?= $content ?>
    <?= $this->render('@app/views/layouts/footer') ?>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
