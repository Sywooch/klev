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

AppAsset::register($this);
LcAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Smart 27</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
echo $this->render('@app/views/site/header2',[
    'page'=>NULL
]);
?>
<div class="container lc-wrap">
    <div class="lc-wrap__right">
        <?= Breadcrumbs::widget([
            'homeLink'=>['label'=>'Главная','url'=>'/'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<?php
echo $this->render('@app/views/site/footer');
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
