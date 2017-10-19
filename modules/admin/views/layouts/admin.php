<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\models\Functions;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
$assets = \app\modules\admin\assets\AdminAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Администраторская панель</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">Администраторская панель</a>
        </div>
        <ul class="nav navbar-nav">
            <li>
                <a href="<?= Yii::$app->request->hostInfo ?>" target="_blank">На сайт</a>
            </li>
        </ul>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav admin-dropdown-ul">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=Yii::$app->user->identity->username?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/logout">Выйти</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="admin_container" style="padding-top:52px;">
        <div class="col-sm-2 admin-menu1_col">
            <div class="admin-menu1_col_abs"></div>
            <div class="admin-menu1">
                <div class="admin-menu1__wrap">
                    <div class="admin-menu1__wrap_title">
                        Модули
                    </div>
                    <div class="admin-menu1__wrap_list">
                        <ul>
                            <?php
                            $admin_menu_config['assets'] = $assets;
                            ?>
                            <?= Functions::admin_menu1($admin_menu_config) ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 admin-content_col">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'homeLink' => isset($this->params['home']) ? $this->params['home'] : ['label' => 'Администраторская панель', 'url' => '/admin']
            ]) ?>
            <?= $content ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


