<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id=='index'){
    $index = true;
}else{
    $index = false;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
    <?= Html::csrfMetaTags() ?>
    <title><?=$this->title?> | ГдеКлёв.рф</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?=$this->render('header2');?>
    <?=$content?>
    <?=$this->render('footer1');?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
