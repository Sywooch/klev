<?php
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = $this->title;
?>
<?php
echo Yii::$app->getSession()->getFlash('success');
?>
<?php
$assets = \app\modules\lc\assets\LcAsset::register($this);
$imagePath = $assets->baseUrl;
Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = [
    'depends' => [
        'yii\jui\JuiAsset',
    ]
];
$this->registerJs(
    '$("document").ready(function(){
            
            
            
    });'
);
?>
<div class="lc-index-right">

    <?=$this->render('head1',[
        'imagePath'=>$imagePath
    ])?>
    <?php
    $this->title = 'Бронь и заявки';
    ?>

    <div class="lc-index-right__bread bron">
        <div class="lc-index-right__bread_text1">
            Бронь и заявки
        </div>
        <div class="lc-index-right__bread_text2">
            Принимайте новые заявки и ведите полный учет бронирования в одном месте.
        </div>
    </div>
    <div class="lc-index-right__informers reserve">
        <div class="lc-index-right__informers_left reserve ">
            <div class="lc-index-right__informers_left_block1 reserve">
                <div class="lc-index-right__informers_left_block1_title">
                    <div class="lc-index-right__informers_left_block1_title_text1">
                       Список броней и заявок
                    </div>
                </div>

                <?php if ($bronPastDontAcecpted = $user->bronPastDontAccepted) : ?>
                    <div class="lc-index-right__informers_left_block1_not_accepted">
                        <div class="lc-index-right__informers_left_block1_not_accepted_title">
                            <span><?=count($bronPastDontAcecpted)?> новых заявок</span> ожидают ответа
                        </div>
                        <div class="lc-index-right__informers_left_block1_not_accepted_list1">
                            <ul>
                                <?php foreach ($bronPastDontAcecpted as $key=>$value) : ?>
                                    <li>
                                        <div class="img">
                                            <img src="<?= $imagePath ?>/images/circle1.png" alt="">
                                        </div>
                                        <div class="text">Заявка #<?=$value->id?> на <?=date('d.m.Y',strtotime($value->priezd))?> | <?=$value->object_name?></div>
                                        <div class="actions">
                                            <div class="eye">
                                                <a class="reserve-eye1" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8">
                                                    <img src="<?= $imagePath ?>/images/eye2.png" alt="">
                                                </a>
                                            </div>
                                            <div class="edit">
                                                <a class="reserve-edit1" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8">
                                                    <img src="<?= $imagePath ?>/images/edit2.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                <?php endif;?>
                <div class="lc-index-right__informers_left_block1_today">
                    Сегодня <?=\app\models\Functions::get_ad_date(date('d.m.Y'))?>, <?=\app\models\Functions::getDayOfWeek(getdate(strtotime(date('.d.m.Y'))))?>
                </div>
                <div class="lc-index-right__informers_left_block1_today_list1">
                    <div class="lc-index-right__informers_left_block1_today_list1_title">
                        Актуальные на сегодня:
                    </div>
                    <?php if ($bronToday = $user->bronToday) : ?>
                        <ul>
                            <?php foreach ($bronToday as $key=>$value) : ?>
                                <li class="<?=$value->status == 0 ? 'not_accepted' : 'accepted' ?>">
                                    <div class="img">
                                        <img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'circle1.png' : 'check1.png' ?>" alt="">
                                    </div>
                                    <div class="text">Бронь #<?=$value->id?> на <?=date('d.m.Y',strtotime($value->priezd))?> | <?=$value->object_name?></div>
                                    <div class="actions">
                                        <div class="eye">
                                            <a class="reserve-eye1" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8">
                                                <img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'eye2.png' : 'eye1.png' ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="edit">
                                            <a class="reserve-edit1" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8">
                                                <img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'edit2.png' : 'edit1.png' ?>" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;?>

                        </ul>

                    <?php else:?>
                        <div class="lc-index-right__informers_right_calendar_right_actual_list1_none">
                            Заявок на сегодня нет
                        </div>
                    <?php endif;?>

                </div>
                <div class="lc-index-right__informers_left_block1_past">
                    <div class="lc-index-right__informers_left_block1_past_title">
                        Ближайшие:
                    </div>
                    <div class="lc-index-right__informers_left_block1_past_list1">
                        <?php if ($bronPast = $user->bronPast) : ?>
                            <ul>
                                <?php foreach ($bronPast as $key=>$value) : ?>
                                    <?php $bronPastTmp = \app\modules\catalog\models\BronForObjects::find()->where('executor_id = '.$user->id.' and priezd = "'.$value->priezd.'"')->orderBy('id ASC')->all();?>
                                    <li>
                                        <div class="text"><?=\app\models\Functions::get_ad_date(date('d.m.Y',strtotime($value->priezd)))?>, <?=\app\models\Functions::getDayOfWeek(getdate(strtotime($value->priezd)))?></div>
                                        <div class="arrow">
                                            <a href="#">
                                                <img src="<?= $imagePath ?>/images/arrow-down1.png" alt="">
                                            </a>
                                        </div>
                                        <ul>
                                            <?php foreach ($bronPastTmp as $key=>$value2) : ?>
                                                <li class="<?=$value2->status == 0 ? 'not_accepted' : 'accepted'?>">
                                                    <div class="text">
                                                        Бронь #<?=$value2->id?> | <?=$value2->object_name?>
                                                    </div>
                                                    <div class="actions">
                                                        <div class="eye">
                                                            <a class="reserve-eye1" href="#" data-id="<?=$value2->id?>" data-toggle="modal" data-target="#myModal8">
                                                                <img src="<?= $imagePath ?>/images/<?=$value2->status == 0 ? 'eye2.png' : 'eye1.png'?>" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="edit">
                                                            <a class="reserve-edit1" href="#" data-id="<?=$value2->id?>" data-toggle="modal" data-target="#myModal8">
                                                                <img src="<?= $imagePath ?>/images/<?=$value2->status == 0 ? 'edit2.png' : 'edit1.png'?>" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach;?>



                                        </ul>
                                    </li>

                                <?php endforeach;?>
                            </ul>
                        <?php else:?>
                            <div class="lc-index-right__informers_right_calendar_right_actual_list1_none">
                                Заявок нет
                            </div>
                        <?php endif;?>

                    </div>
                </div>
            </div>
        </div>

        <div class="lc-index-right__informers_right reserve">

            <div class="lc-index-right__informers_right_calendar">
                <?php Pjax::begin(['id'=>'my-pjax1'])?>
                <div class="lc-index-right__informers_right_calendar_title">
                    <div class="lc-index-right__informers_right_calendar_title_name">
                        Календарь бронирования и заявок
                    </div>
                    <!--<div class="lc-index-right__informers_right_calendar_title_razv">
                        <a href="#">Развернуть</a>
                    </div>-->
                </div>
                <div class="lc-index-right__informers_right_calendar_left">
                    <?=\app\models\Functions::calendar([
                        'imagePath'=>$imagePath
                    ])?>
                </div>
                <div class="lc-index-right__informers_right_calendar_right">
                    <?php if (Yii::$app->request->get('date')) : ?>
                        <div class="lc-index-right__informers_right_calendar_right_title">
                            <?=\app\models\Functions::get_ad_date(date('d.m.Y',strtotime(Yii::$app->request->get('date'))))?>, <?=\app\models\Functions::getDayOfWeek(getdate(strtotime(date('.d.m.Y',strtotime(Yii::$app->request->get('date'))))))?>
                        </div>

                        <div class="lc-index-right__informers_right_calendar_right_actual">
                            <div class="lc-index-right__informers_right_calendar_right_actual_list1">
                                <?php if ( $bronToday = $reserves) : ?>
                                    <?php foreach ($bronToday as $key=>$value) : ?>
                                        <div class="lc-index-right__informers_right_calendar_right_actual_list1_item">
                                            <div class="lc-index-right__informers_right_calendar_right_actual_list1_item_text1">
                                                <span class="img1"><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'circle1.png' : 'check1.png'?>" alt=""></span>
                                                <span class="text">Бронь #<?=$value->id?> на <?=date('d.m.Y',strtotime($value->priezd))?> | <?=$value->object_name?></span>
                                            </div>
                                            <div class="lc-index-right__informers_right_calendar_right_actual_list1_item_actions">
                                                <span><a class="view" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8" ><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'eye2.png' : 'eye1.png'?>" alt=""></a></span>
                                                <?php if (date('Y-m-d',strtotime($value->priezd)) > date('Y-m-d')) : ?>
                                                <span><a class="reserve-edit1" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8"><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'edit2.png' : 'edit1.png'?>" alt=""></a></span>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <div class="lc-index-right__informers_right_calendar_right_actual_list1_none">
                                        Заявок на сегодня нет
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
                <?php Pjax::end()?>
            </div>

        </div>

</div>