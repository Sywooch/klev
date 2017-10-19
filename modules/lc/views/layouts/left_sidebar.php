<?php
$assets = \app\modules\lc\assets\LcAsset::register($this);
$imagePath = $assets->baseUrl;
?>

<div class="executor-left">
    <div class="executor-left__inner">
        <div class="executor-left__inner_logo">
            <img src="<?= $imagePath ?>/images/logo1.png" alt="">
        </div>
        <div class="left__inner_menu">
            <ul>
                <li class="<?=Yii::$app->controller->action->id == 'index' ? 'active' : ''?>">
                    <a href="/lc/index">
                        <span class="img">
                        <img src="<?= $imagePath ?>/images/lc-menu-icon1.png" alt="">
                        </span>
                            <span class="text">
                            Главная страница
                        </span>
                    </a>
                </li>
                <li class="<?=Yii::$app->controller->action->id == 'profile' ? 'active' : ''?>">
                    <a href="/lc/profile">
                        <span class="img">
                              <img src="<?= $imagePath ?>/images/lc-menu-icon2.png" alt="">
                        </span>
                        <span class="text">
                         Профиль
                        </span>
                    </a>
                    <span class="img2">
                         <a href="#">
                             <img src="<?= $imagePath ?>/images/lc-menu-icon1_2.png" alt="">
                         </a>
                    </span>
                </li>
                <li class="<?=(Yii::$app->controller->action->id == 'add' || Yii::$app->controller->action->id=='edit') ? 'active' : ''?>">
                    <a href="/lc/add">
                        <span class="img">
                        <img src="<?= $imagePath ?>/images/lc-menu-icon3.png" alt="">
                    </span>
                        <span class="text">
                         Объекты
                    </span>
                    </a>
                    <span class="img2 img2_arrow">
                         <a href="#">
                             <img src="<?= $imagePath ?>/images/lc-menu-icon_arrow1.png" alt="">
                         </a>
                    </span>
                    <?php $objects = \app\models\IspObjects::find()->where('user_id = '.Yii::$app->user->id.'')->orderBy('id DESC')->all();?>
                    <?php if ($objects) : ?>
                        <ul>
                            <?php foreach ($objects as $key=>$value) : ?>
                                <li>
                                    <a href="/lc/edit?id=<?=$value->id?>"><?=$value->name?></a>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                </li>
                <li>
                    <a href="/lc/reserve">
                        <span class="img">
                            <img src="<?= $imagePath ?>/images/lc-menu-icon4.png" alt="">
                        </span>
                        <span class="text">
                            Бронь и заявки
                        </span>
                        <span class="custom-badge">
                            <?php if ($bronPastDontAccepted = Yii::$app->user->identity->bronPastDontAccepted) : ?>
                                +<?=count($bronPastDontAccepted);?>
                            <?php else:?>
                                0
                            <?php endif;?>

                        </span>
                    </a>
                </li>
                <li>
                    <a href="/lc/dev">
                        <span class="img">
                        <img src="<?= $imagePath ?>/images/lc-menu-icon5.png" alt="">
                    </span>
                        <span class="text">
                         Статистика
                    </span>
                    </a>
                    <span class="img2 img2_arrow">
                         <a href="#">
                             <img src="<?= $imagePath ?>/images/lc-menu-icon_arrow1.png" alt="">
                         </a>
                    </span>
                </li>
                <li>
                    <a href="/lc/dev">
                        <span class="img">
                        <img src="<?= $imagePath ?>/images/lc-menu-icon6.png" alt="">
                    </span>
                        <span class="text">
                         Инструкция
                    </span>
                    </a>
                </li>
                <li>
                    <a href="/lc/dev">
                        <span class="img">
                        <img src="<?= $imagePath ?>/images/lc-menu-icon7.png" alt="">
                        </span>
                            <span class="text">
                             Поддержка
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>