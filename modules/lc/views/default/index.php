<?php
$this->title = 'Главная';
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
        '\yii\jui\JuiAsset',
    ]
]
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
        <div class="lc-index-right__informers_left lc-index">
            <div class="lc-index-right__informers_left_block1">
                <div class="lc-index-right__informers_left_block1_title">
                    <div class="lc-index-right__informers_left_block1_title_text1">
                        Зарегестрировано объектов <span><?=count($isp_objects)?></span>
                    </div>
                    <div class="lc-index-right__informers_left_block1_title_text2">
                        <a href="/lc/add">Добавить объект</a>
                    </div>
                </div>


                <div class="lc-index-right__informers_left_block1_list1">
                    <?php foreach ($isp_objects as $key=>$value) :?>
                        <div class="lc-index-right__informers_left_block1_list1_item">
                            <div class="lc-index-right__informers_left_block1_list1_item_img">
                                <div class="lc-index-right__informers_left_block1_list1_item_img_inner <?=$value->photo ? '' : 'no_photo'?>" style="background-image: url('<?=($value->photo ? '/images/isp_objects/'.$value->photo->image.'' : '/images/site_images/no_object.png')?>')">

                                </div>
                            </div>
                            <div class="lc-index-right__informers_left_block1_list1_item_content">
                                <div class="lc-index-right__informers_left_block1_list1_item_content_title">
                                    <div class="lc-index-right__informers_left_block1_list1_item_content_title_name">
                                        <a target="_blank" href="<?=\app\models\Functions::getObjectUrl($value->id)?>"><?=$value->name?></a>
                                    </div>
                                    <div class="lc-index-right__informers_left_block1_list1_item_content_title_actions">
                                        <!--<span><a href="#"><img src="<?/*= $imagePath */?>/images/stat1.png" alt=""></a></span>-->
                                        <span><a target="_blank" href="<?=\app\models\Functions::getObjectUrl($value->id)?>"><img src="<?= $imagePath ?>/images/view1.png" alt=""></a></span>
                                        <span><a href="/lc/edit?id=<?=$value->id?>"><img src="<?= $imagePath ?>/images/change1.png" alt=""></a></span>
                                    </div>
                                </div>
                                <div class="lc-index-right__informers_left_block1_list1_item_bron">
                                    <div class="lc-index-right__informers_left_block1_list1_item_bron_date">
                                        <a href="#">08.09.17 - 15.09.17 </a>
                                    </div>
                                    <div class="lc-index-right__informers_left_block1_list1_item_bron_text1">
                                        - Забронировано на 75%
                                    </div>
                                </div>
                                <div class="lc-index-right__informers_left_block1_list1_item_info1">
                                    <div class="lc-index-right__informers_left_block1_list1_item_info1_text">
                                        Просмотров сегодня: <span><?=$value->currentViewsCountToday?></span> человек
                                    </div>
                                    <div class="lc-index-right__informers_left_block1_list1_item_info2_text">
                                        Забронировано сегодня: <span><?=$value->bronTodayCount?></span> человек
                                    </div>
                                </div>
                                <div class="lc-index-right__informers_left_block1_list1_item_info2">
                                    <div class="lc-index-right__informers_left_block1_list1_item_info2_text1">
                                        Ожидают подтверждения: <span><?=$value->bronPastDontAcceptedCount?> заявок</span> | <a href="/lc/reserve">Перейти</a>
                                    </div>
                                </div>
                                <!--<div class="lc-index-right__informers_left_block1_list1_item_over">
                                    <a href="#">Другой объект</a>
                                </div>-->
                            </div>
                        </div>
                    <?php endforeach;?>

                </div>
            </div>
            <?if ($dates) : ?>
                <div class="lc-index-right__informers_left_block2">
                    <div class="lc-index-right__informers_left_block2_title">
                        Статистика объектов <!--(<a href="#">просмотры</a> | <a href="#">заявки</a>)-->
                    </div>
                    <div class="lc-index-right__informers_left_block2_graf">
                        <?php
                        echo \dosamigos\highcharts\HighCharts::widget([
                            'clientOptions' => [
                                'lang'=>[
                                    'downloadPDF'=>'Скачать в PDF',
                                    'downloadPNG'=>'Скачать в PNG',
                                    'downloadSVG'=>'Скачать в SVG',
                                    'downloadJPEG'=>'Скачать в JPEG',
                                    'printChart'=>'Распечатать...',
                                ],
                                'chart' => [
                                    'type' => 'line'
                                ],
                                'title' => [
                                    'text' => 'Статистика просмотров объектов'
                                ],
                                'xAxis' => array(
                                    'categories'=> $dates
                                ),
                                'yAxis' => [
                                    'title' => [
                                        'text' => 'Количество просмотров'
                                    ]
                                ],
                                'series' => [
                                    ['name' => 'Просмотры', 'data' => $views],
                                ]
                            ]
                        ]);
                        ?>

                    </div>
                </div>
            <?php endif;?>

            <!--<div class="lc-index-right__informers_left_block3">
                <div class="lc-index-right__informers_left_block3_inner">
                    <div class="lc-index-right__informers_left_block3_title">
                        <div class="lc-index-right__informers_left_block3_title_name">
                            Рыбное хозяйство «Ляо»
                        </div>
                        <div class="lc-index-right__informers_left_block3_title_name_over">
                            <a href="#">
                                <div class="lc-index-right__informers_left_block3_title_name_over_text">
                                    <span>Другой объект</span>
                                </div>
                                <div class="lc-index-right__informers_left_block3_title_name_over_img">
                                    <img src="<?/*= $imagePath */?>/images/arrow-right3.png" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="lc-index-right__informers_left_block3_stat1">
                        Статистика за <a href="#">08.09.17 - 15.09.17</a> (<a href="#">неделя</a> | <a href="#">месяц</a> |
                        <a href="#">год</a>)
                    </div>
                    <div class="lc-index-right__informers_left_block3_views1">
                        Просмотров за неделю: <span>186</span> раз
                    </div>
                    <div class="lc-index-right__informers_left_block3_bron1">
                        Забронировано за неделю: <span>39</span> заявок
                    </div>
                </div>
            </div>-->
        </div>
        <div class="lc-index-right__informers_right lc-index">
            <div class="lc-index-right__informers_right_calendar">
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
                    <div class="lc-index-right__informers_right_calendar_right_title">
                        <?=\app\models\Functions::get_ad_date(date('d.m.Y'))?>, <?=\app\models\Functions::getDayOfWeek(getdate(strtotime(date('.d.m.Y'))))?>
                    </div>
                    <div class="lc-index-right__informers_right_calendar_right_actual">
                        <div class="lc-index-right__informers_right_calendar_right_actual_title">
                            Актуальные заявки на сегодня:
                        </div>
                        <div class="lc-index-right__informers_right_calendar_right_actual_list1">
                            <?php if ($bronToday = $user->bronToday) : ?>
                                <?php foreach ($bronToday as $key=>$value) : ?>
                                    <div class="lc-index-right__informers_right_calendar_right_actual_list1_item">
                                        <div class="lc-index-right__informers_right_calendar_right_actual_list1_item_text1">
                                            <span class="img1"><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'circle1.png' : 'check1.png'?>" alt=""></span>
                                            <span class="text">Бронь #<?=$value->id?> на <?=date('d.m.Y',strtotime($value->priezd))?> | <?=$value->object_name?></span>
                                        </div>
                                        <div class="lc-index-right__informers_right_calendar_right_actual_list1_item_actions">
                                            <span><a class="view" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8" ><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'eye2.png' : 'eye1.png'?>" alt=""></a></span>
                                            <span><a class="reserve-edit1" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8"><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'edit2.png' : 'edit1.png'?>" alt=""></a></span>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php else:?>
                                <div class="lc-index-right__informers_right_calendar_right_actual_list1_none">
                                    Заявок на сегодня нет
                                </div>
                            <?php endif;?>

                            <!--<div class="lc-index-right__informers_right_calendar_right_actual_list1_item">
                                <div class="lc-index-right__informers_right_calendar_right_actual_list1_item_text1">
                                    <span class="img1"><img src="<?/*= $imagePath */?>/images/circle1.png" alt=""></span>
                                    <span class="text">Бронь #115068 на 11.09.17 | Рыбалка</span>
                                </div>
                                <div class="lc-index-right__informers_right_calendar_right_actual_list1_item_actions">
                                    <span><a href="#"><img src="<?/*= $imagePath */?>/images/eye2.png" alt=""></a></span>
                                    <span><a href="#"><img src="<?/*= $imagePath */?>/images/edit2.png" alt=""></a></span>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="lc-index-right__informers_right_calendar_right_blizh">
                        <div class="lc-index-right__informers_right_calendar_right_blizh_title">
                            Ближайшие заявки:
                        </div>
                        <div class="lc-index-right__informers_right_calendar_right_blizh_list1">
                            <?php if ($bronPast = $user->bronPast) : ?>
                                <?php foreach ($bronPast as $key=>$value) : ?>
                                    <?php $bronPastTmp = \app\modules\catalog\models\BronForObjects::find()->where('executor_id = '.$user->id.' and priezd = "'.$value->priezd.'"')->orderBy('id ASC')->all();?>
                                    <div class="lc-index-right__informers_right_calendar_right_blizh_list1_item">
                                        <div class="lc-index-right__informers_right_calendar_right_blizh_list1_item_text">
                                            <?=\app\models\Functions::get_ad_date(date('d.m.Y',strtotime($value->priezd)))?>, <?=\app\models\Functions::getDayOfWeek(getdate(strtotime($value->priezd)))?>
                                        </div>
                                        <div class="lc-index-right__informers_right_calendar_right_blizh_list1_item_caret">
                                            <a href="#"><img src="<?= $imagePath ?>/images/arrow-down1.png" alt=""></a>
                                        </div>
                                        <ul>
                                            <?php foreach ($bronPastTmp as $key=>$value2) : ?>
                                                <li>
                                                    <span class="img"><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'circle1.png' : 'check1.png'?>" alt=""></span>
                                                    <span class="text">Бронь #<?=$value2->id?> | <?=$value2->object_name?></span>
                                                    <span class="actions">
                                                    <span><a href="#" class="view" data-id="<?=$value2->id?>" data-toggle="modal" data-target="#myModal8" ><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'eye2.png' : 'eye1.png'?>" alt=""></a></span>
                                                    <span><a class="reserve-edit1" href="#" data-id="<?=$value->id?>" data-toggle="modal" data-target="#myModal8"><img src="<?= $imagePath ?>/images/<?=$value->status == 0 ? 'edit2.png' : 'edit1.png'?>" alt=""></a></span>
                                                </span>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                <?php endforeach;?>
                                <?php else:?>
                                    <div class="lc-index-right__informers_right_calendar_right_actual_list1_none">
                                        Заявок на сегодня нет
                                    </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>