<?php
use app\models\Functions;
$assets = \app\modules\catalog\assets\CatalogAsset::register($this);
$imagePath = $assets->baseUrl;
$this->title = $object->name.' &mdash; '.$object->city->name.', '.$object->region->name;
@session_start();
?>
<style>
    .catalog1__inner_left_block1{
        margin-top:20px;
    }
</style>
<?php echo $this->render('header1');?>
<?=$this->render('modals',[
   'imagePath'=>$imagePath,
    'object'=>$object
])?>
<div class="breadcrumb1">
    <div class="container">
        <div class="breadcrumb1__inner">
            <div class="breadcrumb1__inner_items">
                <li><a href="#">Главная</a></li>
                <li>
                    <a href="/catalog">
                        Россия
                        <span><?=\app\models\IspObjects::find()->where('active = 1')->count()?> мест для рыбалки</span>
                    </a>
                </li>
                <li>
                    <a href="<?=Functions::getPlaceUrl('',$object->region)?>">
                        Регион <?=$object->region->name?>
                        <span><?=$object->region->ispObjectsCount?> мест для рыбалки</span>
                    </a>
                </li>
                <li>
                    <a href="<?=Functions::getPlaceUrl($object->city->id,'')?>">
                        <?=$object->city->name?>
                        <span><?=$object->city->ispObjectsCount?> мест для рыбалки</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        Просмотр объекта
                        <span><?=$object->name?></span>
                    </a>
                </li>
            </div>
            <div class="breadcrumb1__inner_block1">
                <div class="breadcrumb1__inner_block1_rate">
                    <div class="breadcrumb1__inner_block1_rate_img">
                        <img src="/images/site_images/catalog/rate1.png" alt="">
                    </div>
                    <div class="breadcrumb1__inner_block1_rate_text">
                        45%
                        <span>забронировано</span>
                    </div>
                </div>
                <div class="breadcrumb1__inner_block1_text1">
                    <?=$object->city->name?> - одно из популярных мест
                    в регионе <?=$object->region->name?>, забронировано 45% мест.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="item1">
    <div class="container">
        <div class="item1__inner">
            <div class="item1__inner_left">
                <div class="item1__inner_left_bron1">
                    <a href="#"  >Мгновенное бронирование</a>
                </div>
                <form action="/catalog" method="POST">
                    <?php echo $this->render('search1');?>
                </form>

                <div class="item1__inner_left_map1">
                    <div class="item1__inner_left_map1_inner">
                        <div class="item1__inner_left_map1_inner_img">
                            <img src="/images/site_images/catalog/map2.jpg" alt="">
                        </div>
                        <div class="item1__inner_left_map1_inner_text1">
                            <a class="no_href" href="#">Посмотреть на карте</a>
                        </div>
                        <div class="item1__inner_left_map1_inner_text2">
                            <a class="no_href" href="#"><?=$object->city->name?></a>
                        </div>
                    </div>
                </div>
                <div class="item1__inner_left_faq1">
                    <div class="item1__inner_left_faq1_inner">
                        <div class="item1__inner_left_faq1_inner_title">
                            Часто задаваемые вопросы
                        </div>
                        <div class="item1__inner_left_faq1_inner_title_content">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                Бронирование рыбалки
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <a href="#">Ссылка</a>
                                            <a href="#">Ссылка</a>
                                            <a href="#">Ссылка</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                Цены
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Да работаем.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                Оплата
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Да, участвуем.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                                Порядок предоставления услуг
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Да, занимаемся.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                                Дополнительные услуги
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse5" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Нет, так как мебель имеет порошковое покрытие, которое по экспертным оценкам
                                            имеет наиболее
                                            качественный, недорогой и эффективный способ обработки изделия, обладающее
                                            великолепными
                                            эксплуатационными и антикоррозийными свойствами.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item1__inner_left_faq1_inner_title_content_btn">
                                <a href="#">Узнать больше</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($similar_cities) : ?>
                    <div class="item1__inner_left_block2">
                        <div class="item1__inner_left_block2_inner">
                            <div class="item1__inner_left_block2_inner_title">
                                Рыбалка поблизости
                            </div>
                            <div class="item1__inner_left_block2_inner_list1">
                                <?php foreach ($similar_cities as $key=>$value) :?>
                                    <div class="item1__inner_left_block2_inner_list1_item">
                                        <div class="item1__inner_left_block2_inner_list1_item_title">
                                            <a href="<?=Functions::getPlaceUrl($value->id)?>"><?=$value->name?></a>
                                        </div>
                                        <div class="item1__inner_left_block2_inner_list1_item_count">
                                            <?=$value->ispObjectsCount?> мест
                                        </div>
                                        <div class="item1__inner_left_block2_inner_list1_item_text1">
                                            Особенности: местный колорит, живописная
                                            природа и комфорт.
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>

                <?php if ($object->likes) : ?>
                    <div class="item1__inner_left_block2_likes">
                        <div class="item1__inner_left_block2_likes_text1">
                            <?=$object->likes ? $object->likes->likes : 0?>  рыбакам здесь понравилось!
                        </div>
                        <div class="item1__inner_left_block2_likes_border1"></div>
                    </div>
                <?php endif;?>

                <div class="item1__inner_left_block2_reviews">
                    <?php if ($object->reviews) : ?>
                        <div class="item1__inner_left_block2_reviews_list1">
                            <?php foreach ($object->reviews as $key=>$value) : ?>
                                <div class="item1__inner_left_block2_reviews_list1_item">
                                    <div class="item1__inner_left_block2_reviews_list1_item_block1">
                                        <div class="item1__inner_left_block2_reviews_list1_item_block1_ava">
                                            <span><?=mb_substr($value->author,0,1)?></span>
                                        </div>
                                        <div class="item1__inner_left_block2_reviews_list1_item_block1_name">
                                            <div class="item1__inner_left_block2_reviews_list1_item_block1_name_text1">
                                                <?=$value->author?>
                                            </div>
                                            <div class="item1__inner_left_block2_reviews_list1_item_block1_name_text2">
                                                <?=$value->city?>
                                            </div>
                                        </div>
                                        <div class="item1__inner_left_block2_reviews_list1_item_block1_name_oc">
                                            <div class="item1__inner_left_block2_reviews_list1_item_block1_name_oc_text1">
                                                оценка
                                            </div>
                                            <div class="item1__inner_left_block2_reviews_list1_item_block1_name_oc_text2">
                                                <span><?=$value->ocenka?>,0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item1__inner_left_block2_reviews_list1_item_block2">
                                        <?=$value->pluses?>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <div class="item1__inner_right">
                <div class="item1__inner_right_inner">
                    <div class="item1__inner_right_inner_block1">
                        <div class="item1__inner_right_inner_block1_title">
                            <?=$object->name?>
                        </div>
                        <?php
                        if ($object->reviews){
                            $res = Functions::calculateReviews1($object->reviews);
                        }else{
                            $res['sr'] = 6.5;
                            $res['oc'] = 'Хорошо';
                        }

                        ?>
                        <div class="item1__inner_right_inner_block1_rate1">
                            <div class="item1__inner_right_inner_block1_rate1_list1">
                                <?php for ($i = 1;$i<=ceil($res['sr'] / 2);$i++) : ?>
                                    <div class="item1__inner_right_inner_block1_rate1_list1_item">
                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                    </div>
                                <?php endfor;?>
                            </div>
                        </div>
                        <div class="item1__inner_right_inner_block1_geo">
                            <img src="/images/site_images/catalog/geo3.png" alt="">
                        </div>
                        <div class="item1__inner_right_inner_bread">
                            <?=$object->city->name?>, Регион <?=$object->region->name?>, Россия - <a class="no_href" href="#">Посмотреть на карте</a>
                        </div>
                    </div>
                    <div class="item1__inner_right_inner_block2">
                        <div class="item1__inner_right_inner_block2_bron">
                            <a href="#" >Забронировать</a>
                        </div>


                        <div class="item1__inner_right_inner_block2_like">
                            <a href="#" class="<?=(isset($_SESSION['objects_likes'][$object->id]) ? 'active' : '')?>" data-id="<?=$object->id?>"><img src="/images/site_images/item/like1.png" alt=""></a>
                        </div>
                        <div class="item1__inner_right_inner_block2_share">
                            <a  href="https://vk.com/share.php?url=<?=Yii::$app->request->url?>" target="_blank"><img src="/images/site_images/item/share1.png" alt=""></a>

                        </div>
                        <div class="item1__inner_right_inner_block2_garant">
                            <div class="item1__inner_right_inner_block2_garant_img">
                                <img src="/images/site_images/item/garant1.png" alt="">
                            </div>
                            <div class="item1__inner_right_inner_block2_garant_text1">
                                Гарантия лучшей цены!
                            </div>
                        </div>
                    </div>
                    <div class="item1__inner_right_inner_block3">
                        <div class="item1__inner_right_inner_block3_slider">
                            <div class="item1__inner_right_inner_block3_slider_inner">
                                <ul class="slickslide">
                                    <?php foreach ($object->photos as $key => $value) :?>
                                        <li class="slickslide__item">
                                            <div style="background-image: url('/images/isp_objects/<?=$value->image?>');"></div>
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                                <div class="slick-thumbs">
                                    <ul>
                                        <?php foreach ($object->photos as $key => $value) :?>
                                            <li>
                                                <div style="background-image: url('/images/isp_objects/<?=$value->image?>');"></div>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item1__inner_right_inner_block3_custom1">
                            <div class="item1__inner_right_inner_block3_custom1_oc1">
                                <div class="item1__inner_right_inner_block3_custom1_oc1_img">
                                    <img src="/images/site_images/item/reviews1.png" alt="">
                                </div>
                                <div class="item1__inner_right_inner_block3_custom1_oc1_text">

                                    <span class="span1"><?=$res['oc']?> <?=$res['sr']?></span>
                                    <span class="span2"><?=count($object->reviews)?> отзывов</span>
                                </div>
                            </div>
                            <?php if ($object->reviews) : ?>
                                <div class="item1__inner_right_inner_block3_custom1_reviews-slider">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($object->reviews as $key=>$value) : ?>
                                                <div class="swiper-slide">
                                                    <div class="item1__inner_right_inner_block3_custom1_reviews_item">
                                                        <div class="item1__inner_right_inner_block3_custom1_reviews_item_text1">
                                                            <?=$value->pluses?>
                                                        </div>
                                                        <div class="item1__inner_right_inner_block3_custom1_reviews_item_text2">
                                                            <div class="item1__inner_right_inner_block3_custom1_reviews_item_text2_name">
                                                                <div class="item1__inner_right_inner_block3_custom1_reviews_item_text2_name_img">
                                                                    <img src="/images/site_images/item/people1.png" alt="">
                                                                </div>
                                                                <div class="item1__inner_right_inner_block3_custom1_reviews_item_text2_name_text">
                                                                    <?=$value->author?>
                                                                </div>
                                                            </div>
                                                            <div class="item1__inner_right_inner_block3_custom1_reviews_item_text2_city">
                                                                <?=$value->city?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                        <div class="swiper-button-prev swiper-button-prev2"></div>
                                        <div class="swiper-button-next swiper-button-next2"></div>
                                    </div>
                                </div>

                            <?php endif;?>


                            <div class="item1__inner_right_inner_block3_custom2">
                                <div class="item1__inner_right_inner_block3_custom2_list">
                                    <?php if ($object->max_ulov > 5) : ?>
                                        <div class="item1__inner_right_inner_block3_custom2_list_img">
                                            <img src="/images/site_images/item/custom2-item1.png" alt="">
                                        </div>
                                    <?php endif;?>
                                    <?php if ($object->snasti) : ?>
                                        <div class="item1__inner_right_inner_block3_custom2_list_img">
                                            <img src="/images/site_images/item/custom2-item2.png" alt="">
                                        </div>
                                    <?php endif;?>
                                    <?php if ($object->homes) : ?>
                                        <div class="item1__inner_right_inner_block3_custom2_list_img">
                                            <img src="/images/site_images/item/custom2-item3.png" alt="">
                                        </div>
                                        <div class="item1__inner_right_inner_block3_custom2_list_img">
                                            <img src="/images/site_images/item/custom2-item4.png" alt="">
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="item1__inner_right_inner_block3_custom3">
                                <div class="item1__inner_right_inner_block3_custom3_text">
                                    Мгновенное бронирование!
                                    Брнирование без комиссии!
                                </div>
                                <div class="item1__inner_right_inner_block3_custom3_price">
                                    <?=$object->price1?>Р <br>(за человека)
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="item1__inner_right_inner_description1">
                        <div class="item1__inner_right_inner_description1_inner">
                            <div class="item1__inner_right_inner_description1_inner_left">
                                <div class="item1__inner_right_inner_description1_inner_left_title">
                                    Описание объекта
                                </div>
                                <div class="item1__inner_right_inner_description1_inner_left_text1">
                                    <?=$object->description1?>
                                </div>
                                <div class="item1__inner_right_inner_description1_inner_left_list1">

                                    <?php if ($object->max_ulov > 5) : ?>
                                        <div class="item1__inner_right_inner_description1_inner_left_list1_item">
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_img">
                                                <img src="/images/site_images/item/preim-list1__1.png" alt="">
                                            </div>
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_text">
                                                Трофейный улов
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <?php if ($object->pitanie) : ?>
                                        <div class="item1__inner_right_inner_description1_inner_left_list1_item">
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_img">
                                                <img src="/images/site_images/item/preim-list1__2.png" alt="">
                                            </div>
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_text">
                                                Питание и напитки
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <?php if ($object->pitanie && $object->homes && $object->snasti) : ?>
                                        <div class="item1__inner_right_inner_description1_inner_left_list1_item">
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_img">
                                                <img src="/images/site_images/item/preim-list1__3.png" alt="">
                                            </div>
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_text">
                                                Широкий спектр услуг
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <?php if ($object->homes) : ?>
                                        <div class="item1__inner_right_inner_description1_inner_left_list1_item">
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_img">
                                                <img src="/images/site_images/item/preim-list1__4.png" alt="">
                                            </div>
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_text">
                                                Рыбалка с удобствами
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <?php if ($object->snasti) : ?>
                                        <div class="item1__inner_right_inner_description1_inner_left_list1_item">
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_img">
                                                <img src="/images/site_images/item/preim-list1__5.png" alt="">
                                            </div>
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_text">
                                                Предоставление снастей
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <?php if ($object->lodki) : ?>
                                        <div class="item1__inner_right_inner_description1_inner_left_list1_item">
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_img">
                                                <img src="/images/site_images/item/preim-list1__6.png" alt="">
                                            </div>
                                            <div class="item1__inner_right_inner_description1_inner_left_list1_item_text">
                                                Предоставление плавательных средств
                                            </div>
                                        </div>
                                    <?php endif;?>


                                </div>
                            </div>
                            <div class="item1__inner_right_inner_description1_inner_right">
                                <div class="item1__inner_right_inner_description1_inner_right_inner">
                                    <div class="item1__inner_right_inner_description1_inner_right_inner_like">
                                        <div class="item1__inner_right_inner_description1_inner_right_inner_like_title">
                                            Вам понравится!
                                        </div>
                                        <div class="item1__inner_right_inner_description1_inner_right_inner_like_text1">
                                            <?=$object->name?>
                                        </div>
                                        <div class="item1__inner_right_inner_description1_inner_right_inner_like_text2">
                                            <div class="item1__inner_right_inner_description1_inner_right_inner_like_text2_img">
                                                <img src="/images/site_images/item/geo1.png" alt="">
                                            </div>
                                            <div class="item1__inner_right_inner_description1_inner_right_inner_like_text2_text">
                                                <a href="<?=Functions::getPlaceUrl($object->city->id);?>"><?=$object->city->name?></a>
                                            </div>
                                        </div>
                                        <div class="item1__inner_right_inner_description1_inner_right_inner_like_views">
                                            <?=$object->currentViewsCount?> человек сейчас
                                            просматривают данное
                                            предложение
                                        </div>
                                        <div class="item1__inner_right_inner_description1_inner_right_inner_like_spros">
                                            <div class="span1">Большой спрос</div>
                                            <div class="span2">За последние 24 часа
                                                забронировано 51 раз
                                            </div>
                                        </div>
                                        <div class="item1__inner_right_inner_description1_inner_right_inner_like_bron">
                                            Бронирование без
                                            комиссии
                                        </div>
                                        <div class="item1__inner_right_inner_description1_inner_right_inner_like_bron_now">
                                            <a href="#">Забронировать сейчас</a>
                                        </div>
                                        <div class="item1__inner_right_inner_description1_inner_right_inner_like_garant">
                                            <div class="item1__inner_right_inner_description1_inner_right_inner_like_garant_img">
                                                <img src="/images/site_images/item/garant1.png" alt="">
                                            </div>
                                            <div class="item1__inner_right_inner_description1_inner_right_inner_like_garant_text">
                                                Гарантия лучшей цены!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item1__inner_right_inner_about1">
                        <div class="item1__inner_right_inner_about1_title">
                            О месте
                        </div>
                        <div class="item1__inner_right_inner_about1_list1">
                            <!--<div class="item1__inner_right_inner_about1_list1_item">
                                <div class="item1__inner_right_inner_about1_list1_item_left">
                                    Тип водоема
                                </div>
                                <div class="item1__inner_right_inner_about1_list1_item_right">
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                        Пруд
                                    </div>
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text2">
                                        Краткое описание водоёма, краткое описание водоёма, краткое описание
                                        водоёма, краткое описание водоёма, краткое описание водоёма, краткое
                                        описание водоёма, краткое описание водоёма.
                                    </div>
                                </div>
                            </div>-->
                            <div class="item1__inner_right_inner_about1_list1_item">
                                <div class="item1__inner_right_inner_about1_list1_item_left">
                                    Способ рыбалки
                                </div>
                                <div class="item1__inner_right_inner_about1_list1_item_right">
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                        Поплавочный, донный, троллинг, нахлыст, подводная рыбалка
                                        Все необходимые снасти Вы можете взять напрокат прямо на месте!
                                    </div>
                                    <!--<div class="item1__inner_right_inner_about1_list1_item_right_text2">
                                        Все необходимые снасти Вы можете взять напрокат прямо на месте!
                                    </div>-->
                                </div>
                            </div>
                            <div class="item1__inner_right_inner_about1_list1_item">
                                <div class="item1__inner_right_inner_about1_list1_item_left">
                                    Плавательные средства
                                </div>
                                <div class="item1__inner_right_inner_about1_list1_item_right">
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                        Весельная лодка, моторная лодка, катер
                                    </div>
                                    <!--<div class="item1__inner_right_inner_about1_list1_item_right_text2">
                                        Плавательные средства на прокат прямо на месте!
                                    </div>-->
                                </div>
                            </div>
                            <div class="item1__inner_right_inner_about1_list1_item">
                                <div class="item1__inner_right_inner_about1_list1_item_left">
                                    Сезон рыбалки
                                </div>
                                <div class="item1__inner_right_inner_about1_list1_item_right">
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                        Летняя рыбалка и зимняя рыбалка
                                    </div>
                                </div>
                            </div>
                            <?php if ($object->fishes_list) : ?>
                                <div class="item1__inner_right_inner_about1_list1_item">
                                    <div class="item1__inner_right_inner_about1_list1_item_left">
                                        Возможный улов
                                    </div>
                                    <div class="item1__inner_right_inner_about1_list1_item_right">
                                        <div class="item1__inner_right_inner_about1_list1_item_right_ulov">
                                            <div class="item1__inner_right_inner_about1_list1_item_right_ulov_list1 <?=count($object->fishes_list)>6 ? 'more' : ''?>">
                                                <?php foreach ($object->fishes_list as $key=>$value) : ?>
                                                    <div class="item1__inner_right_inner_about1_list1_item_right_ulov_list1_item">
                                                        <div class="item1__inner_right_inner_about1_list1_item_right_ulov_list1_item_title">
                                                            <?=$value->fish->name?>
                                                        </div>
                                                        <div class="item1__inner_right_inner_about1_list1_item_right_ulov_list1_item_img">
                                                            <img src="/images/site_images/item/fish.png" alt="">
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                            <?php if (count($object->fishes_list)>6) :?>
                                                <div class="item1__inner_right_inner_about1_list1_item_right_ulov_btn">
                                                    <a href="#">Показать всех рыб</a>
                                                </div>s
                                            <?php endif;?>

                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>

                            <!--<div class="item1__inner_right_inner_about1_list1_item">
                                <div class="item1__inner_right_inner_about1_list1_item_left">
                                    Питание и напитки
                                </div>
                                <div class="item1__inner_right_inner_about1_list1_item_right">
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                        Завтрак, обед, ужин, всё включено
                                    </div>
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text2">
                                        Повар может разделать и приготовить Ваш улов!
                                    </div>
                                </div>
                            </div>-->
                            <?php if ($object->homes) : ?>
                                <div class="item1__inner_right_inner_about1_list1_item">
                                    <div class="item1__inner_right_inner_about1_list1_item_left">
                                        Ночлег / тип размещения
                                    </div>
                                    <div class="item1__inner_right_inner_about1_list1_item_right">
                                        <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                            Дом
                                        </div>
                                        <div class="item1__inner_right_inner_about1_list1_item_right_text2">
                                            Вы можете переночевать с комфортом!
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>

                            <div class="item1__inner_right_inner_about1_list1_item">
                                <div class="item1__inner_right_inner_about1_list1_item_left">
                                    Правила бронирования
                                </div>
                                <div class="item1__inner_right_inner_about1_list1_item_right">
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                        Оплата перед приездом
                                    </div>
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text2">
                                        Вы можете оплатить прямо с карты!
                                    </div>
                                </div>
                            </div>
                            <!--<div class="item1__inner_right_inner_about1_list1_item">
                                <div class="item1__inner_right_inner_about1_list1_item_left">
                                    Удобства и сервис
                                </div>
                                <div class="item1__inner_right_inner_about1_list1_item_right">
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                        Интернет, парковка,  бассейн, отдельная ванная, детская площадка
                                    </div>
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text2">
                                        Включено в стоимость при бронировании номера в отеле или при аренде дома!
                                    </div>
                                </div>
                            </div>-->
                            <!--<div class="item1__inner_right_inner_about1_list1_item">
                                <div class="item1__inner_right_inner_about1_list1_item_left">
                                    Услуги
                                </div>
                                <div class="item1__inner_right_inner_about1_list1_item_right">
                                    <div class="item1__inner_right_inner_about1_list1_item_right_text1">
                                        Трансфер, беседки, фитнесс, СПА, ресторан, баня, коптильня, бильярд, квадроциклы/снегоходы, пейнтбол, велосипеды, организация мероприятий
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="item1__inner_right_inner_nalichie_mest">
                        <div class="item1__inner_right_inner_nalichie_mest_title">
                            Наличие мест
                        </div>
                        <!--<div class="item1__inner_right_inner_nalichie_mest_block1">
                            <div class="item1__inner_right_inner_nalichie_mest_block1_form">
                                <form action="">
                                    <div class="item1__inner_right_inner_nalichie_mest_block1_form_date">
                                        <label>
                                            <span class="item1__inner_right_inner_nalichie_mest_block1_form_date_title">
                                                Дата заезда:
                                            </span>
                                            <div class="item1__inner_right_inner_nalichie_mest_block1_form_date_input">
                                                <input type="text" name="" id="" placeholder="Дата поездки...">
                                                <div class="item1__inner_right_inner_nalichie_mest_block1_form_date_arrow">
                                                    <img src="/images/site_images/arrow-down1.png" alt="">
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="item1__inner_right_inner_nalichie_mest_block1_form_date">
                                        <label>
                                            <span class="item1__inner_right_inner_nalichie_mest_block1_form_date_title">
                                                Дата отъезда:
                                            </span>
                                            <div class="item1__inner_right_inner_nalichie_mest_block1_form_date_input">
                                                <input type="text" name="" id="" placeholder="Дата поездки...">
                                                <div class="item1__inner_right_inner_nalichie_mest_block1_form_date_arrow">
                                                    <img src="/images/site_images/arrow-down1.png" alt="">
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="item1__inner_right_inner_nalichie_mest_block1_form_count">
                                        <label>
                                            <div class="item1__inner_right_inner_nalichie_mest_block1_form_count_title">
                                                Гости
                                            </div>
                                            <div class="item1__inner_right_inner_nalichie_mest_block1_form_count_input">
                                                <input type="text" name="count" id="" placeholder="Количество человек...">
                                                <div class="item1__inner_right_inner_nalichie_mest_block1_form_count_arrow">
                                                    <img src="/images/site_images/arrow-down1.png" alt="">
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="item1__inner_right_inner_nalichie_mest_block1_form_btn">
                                        <button type="submit"><span>Проверить даты</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>-->
                    </div>
                    <div class="item1__inner_right_inner_razm">
                        <div class="item1__inner_right_inner_razm_inner">
                            <div class="item1__inner_right_inner_razm_inner_header">
                                <ul>
                                    <li><span>Тип размещения</span></li>
                                    <li><span>Вместимость</span></li>
                                    <li><span>Стоимость</span></li>
                                    <li><span>Бесплатно</span></li>
                                    <li><span>Количество</span></li>
                                    <li><span>Подтвердить бронь</span></li>
                                </ul>
                            </div>
                            <div class="item1__inner_right_inner_razm_inner_body">
                                <div class="item1__inner_right_inner_razm_inner_body_left">
                                    <div class="item1__inner_right_inner_razm_inner_body_left_list1">
                                        <ul class="default">
                                            <li>Без размещения</li>
                                            <li>Сейчас доступно 21 место</li>
                                            <li>
                                                <span class="span1"><?=$object->price1?>Р</span>
                                                только за рыбалку в сутки
                                            </li>
                                            <li>

                                            </li>
                                            <li>
                                                <select name="" id="" >
                                                    <option  disabled selected value="Выбрать...">Выбрать...</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </li>
                                        </ul>
                                        <?php if ($object->homes) : ?>
                                            <?php foreach ($object->homes as $key=>$value) : ?>
                                                <ul class="homes">
                                                    <li><a  data-id = "<?=$value->id?>" data-toggle="modal" data-target="#myModal7" href="#" class="home name"><?=$value->name?></a></li>
                                                    <li>Сейчас доступно 10 мест</li>
                                                    <li>
                                                        <span class="span1"><?=$value->price?>Р</span>
                                                    </li>
                                                    <li>
                                                        <?php $tmp = '';?>
                                                        <?php foreach ($value->comfort2 as $key2=>$value2) : ?>
                                                            <?php
                                                            $tmp.=$value2->comfort->name.', ';
                                                            ?>
                                                        <?php endforeach;?>
                                                        <?=trim($tmp,', ')?>

                                                    </li>
                                                    <li>
                                                        <select name="" id="" >
                                                            <option  disabled selected value="Выбрать...">Выбрать...</option>
                                                            <?php for ($i = 1;$i<=$value->room_count;$i++) :?>
                                                                <option value = "<?=$i?>"><?=$i?></option>
                                                            <?php endfor;?>
                                                        </select>
                                                    </li>
                                                </ul>
                                            <?php endforeach;?>
                                        <?php endif;?>



                                    </div>
                                </div>
                                <div class="item1__inner_right_inner_razm_inner_body_right">
                                    <div class="item1__inner_right_inner_razm_inner_body_right_inner">
                                        <div class="item1__inner_right_inner_razm_inner_body_right_inner_btn">
                                            <a href="#">Я бронирую</a>
                                        </div>
                                        <div class="item1__inner_right_inner_razm_inner_body_right_inner_text1">
                                            За прошлый месяц здесь побывало 158 рыбаков!
                                        </div>
                                        <div class="item1__inner_right_inner_razm_inner_body_right_inner_text2">
                                            Сейчас просматривают 25 человек
                                        </div>
                                        <div class="item1__inner_right_inner_razm_inner_body_right_inner_text3">
                                            <span>Гарантия</span>
                                            лучшей цены!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item1__inner_right_inner_best_choice">
                        <div class="item1__inner_right_inner_best_choice_title">
                            <?=$object->name?> <br>
                            Преимущества и причины для хорошего выбора!
                        </div>
                        <div class="item1__inner_right_inner_best_choice_border"></div>
                        <div class="item1__inner_right_inner_best_choice_list1">
                            <div class="item1__inner_right_inner_best_choice_list1_block1">
                                <div class="item1__inner_right_inner_best_choice_list1_block1_text1">
                                    Реальные оценки и отзывы
                                    от реальных рыбаков!
                                </div>
                                <div class="item1__inner_right_inner_best_choice_list1_block1_custom1">
                                    <div class="item1__inner_right_inner_best_choice_list1_block1_custom1_img">
                                        <img src="/images/site_images/item/preim-list2__reviews.png" alt="">
                                    </div>
                                    <div class="item1__inner_right_inner_best_choice_list1_block1_custom1_content">


                                        <div class="item1__inner_right_inner_best_choice_list1_block1_custom1_content_text1">
                                            <?=$res['oc']?> <?=$res['sr']?>
                                        </div>
                                        <div class="item1__inner_right_inner_best_choice_list1_block1_custom1_content_text2">
                                            <a href="#"><?=count($object->reviews)?> отзывов</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item1__inner_right_inner_best_choice_list1_block2">
                                <div class="item1__inner_right_inner_best_choice_list1_block2_list1">
                                    <ul>
                                        <?php if ($object->max_ulov > 5) : ?>
                                            <li>
                                                <span class="img">
                                                    <img src="/images/site_images/item/preim-list2__1.png" alt="">
                                                </span>
                                                    <span class="text">
                                                    Трофейный улов
                                                </span>
                                            </li>
                                        <?php endif;?>

                                        <?php if ($object->pitanie) : ?>
                                            <li>
                                                <span class="img">
                                                    <img src="/images/site_images/item/preim-list2__2.png" alt="">
                                                </span>
                                                    <span class="text">
                                                    Питание и напитки
                                                </span>
                                            </li>
                                        <?php endif;?>
                                        <?php if ($object->pitanie && $object->homes && $object->snasti) : ?>
                                            <li>
                                                <span class="img">
                                                    <img src="/images/site_images/item/preim-list2__3.png" alt="">
                                                </span>
                                                    <span class="text">
                                                    Широкий спектр услуг
                                                </span>
                                            </li>
                                        <?php endif;?>
                                        <?php if ($object->homes) : ?>
                                            <li>
                                                <span class="img">
                                                    <img src="/images/site_images/item/preim-list2__4.png" alt="">
                                                </span>
                                                    <span class="text">
                                                    Рыбалка с удобствами
                                                </span>
                                            </li>
                                        <?php endif;?>
                                        <?php if ($object->snasti) : ?>
                                            <li>
                                                <span class="img">
                                                    <img src="/images/site_images/item/preim-list2__5.png" alt="">
                                                </span>
                                                    <span class="text">
                                                    Предоставление снастей
                                                </span>
                                            </li>
                                        <?php endif;?>
                                        <?php if ($object->lodki):?>
                                            <li>
                                                <span class="img">
                                                    <img src="/images/site_images/item/preim-list2__6.png" alt="">
                                                </span>
                                                    <span class="text">
                                                    Предоставление лодок
                                                </span>
                                            </li>
                                        <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item1__inner_right_inner_reviews">
                        <?php if ($object->reviews) : ?>
                        <div class="item1__inner_right_inner_reviews_title">
                            <?=$object->name?> — самые последние отзывы
                        </div>
                        <div class="item1__inner_right_inner_reviews_list1">
                            <?php foreach ($object->reviews as $key=>$value) : ?>
                                <div class="item1__inner_right_inner_reviews_list1_item">
                                    <div class="item1__inner_right_inner_reviews_list1_left">
                                        <div class="item1__inner_right_inner_reviews_list1_left_ava">
                                            <span><?=mb_substr($value->author,0,1)?></span>
                                        </div>
                                        <div class="item1__inner_right_inner_reviews_list1_left_name"><?=$value->author?></div>
                                        <div class="item1__inner_right_inner_reviews_list1_left_city"><?=$value->city?></div>
                                        <div class="item1__inner_right_inner_reviews_list1_left_custom1">
                                            <span class="img"><img src="/images/site_images/item/reviews-peoples1.png" alt=""></span>
                                            <span class="text">«Полезный отзыв»</span>
                                            <span class="text2"><span><?=$value->likesCount?></span> человек согласны</span>
                                        </div>
                                    </div>
                                    <div class="item1__inner_right_inner_reviews_list1_right">
                                        <div class="item1__inner_right_inner_reviews_list1_right_inner">
                                            <div class="item1__inner_right_inner_reviews_list1_right_inner_block1">
                                                <div class="item1__inner_right_inner_reviews_list1_right_inner_block1_oc">
                                                    <?=$value->ocenka?>,0
                                                </div>
                                                <div class="item1__inner_right_inner_reviews_list1_right_inner_block1_title">
                                                    «<?=$value->title?>»
                                                </div>
                                                <div class="item1__inner_right_inner_reviews_list1_right_inner_block1_date">
                                                    <?=Functions::get_ad_date(date('d.m.Y',strtotime($value->reg_date)));?>
                                                </div>
                                                <?php if (!Yii::$app->user->isGuest) : ?>
                                                    <div class="item1__inner_right_inner_reviews_list1_right_inner_block1_likes">
                                                        <span class="like">
                                                            <a href="#" class="<?=$value->userLikesCount ? 'active' : ''?>" data-id = "<?=$value->id?>">
                                                                <img src="/images/site_images/item/like2.png" alt="">
                                                            </a>
                                                        </span>
                                                            <span class="dislike">
                                                            <a href="#" class="<?=$value->userDislikesCount ? 'active' : ''?>" data-id = "<?=$value->id?>">
                                                                <img src="/images/site_images/item/dislike2.png" alt="">
                                                            </a>
                                                        </span>
                                                    </div>
                                                <?php else:?>
                                                    <div class="item1__inner_right_inner_reviews_list1_right_inner_block1_likes_guest">
                                                        Авторизуйтесь, что бы ставить оценку
                                                    </div>
                                                <?php endif;?>



                                            </div>
                                            <div class="item1__inner_right_inner_reviews_list1_right_inner_block2">
                                                <div class="item1__inner_right_inner_reviews_list1_right_inner_block2_list">
                                                    <ul>
                                                        <li class="img">
                                                            <img src="/images/site_images/item/dislike3.png" alt="">
                                                        </li>
                                                        <li class="text">
                                                            <?=$value->minuses?>
                                                        </li>
                                                    </ul>
                                                    <ul>
                                                        <li class="img">
                                                            <img src="/images/site_images/item/like3.png" alt="">
                                                        </li>
                                                        <li class="text">
                                                            <?=$value->pluses?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            <!--<div class="item1__inner_right_inner_reviews_list1_more">
                                <a href="#">Еще отзывы</a>
                            </div>-->
                        <?php endif;?>

                            <div class="item1__inner_right_inner_reviews_list1_add">
                                <a href="#">Добавить отзыв</a>
                            </div>
                            <?=$this->render('new_review',[
                                'model'=>$review_model,
                                'imagePath'=>$imagePath
                            ])?>
                        </div>

                    </div>
                    <div class="catalog1__inner_right_inner_change_filter">
                        <div class="catalog1__inner_right_inner_change_filter_title">
                            Управляйте критериями поиска и найдите идеальное место!
                        </div>
                        <div class="catalog1__inner_right_inner_change_filter_list1">
                            <div class="catalog1__inner_right_inner_change_filter_list1_block1">
                                <div class="catalog1__inner_right_inner_change_filter_list1_block1_img">
                                    <img src="/images/site_images/catalog/filter1.png" alt="">
                                </div>
                                <div class="catalog1__inner_right_inner_change_filter_list1_block1_content">
                                    <span><a href="#" class="krit">Перейти к критериям</a></span>
                                </div>
                            </div>
                            <div class="catalog1__inner_right_inner_change_filter_list1_arrow1">
                                <img src="/images/site_images/catalog/arrow-right1.png" alt="">
                            </div>
                            <div class="catalog1__inner_right_inner_change_filter_list1_block2">
                                <span><a href="#">Изменить свой поиск</a></span>
                                <span><a href="#">Выбрать другие даты</a></span>
                            </div>
                            <div class="catalog1__inner_right_inner_change_filter_list1_arrow2">
                                <img src="/images/site_images/catalog/arrow-right1.png" alt="">
                            </div>
                            <div class="catalog1__inner_right_inner_change_filter_list1_block3">
                                Рыбалка в этом же регионе: <br>
                                &gt; <span><a href="<?=Functions::getPlaceUrl('',$object->region->id)?>"><?=$object->region->name?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="catalog1__inner_right_inner_change_rate">
                        <div class="catalog1__inner_right_inner_change_rate_img">
                            <img src="/images/site_images/catalog/rate2.png" alt="">
                        </div>
                        <div class="catalog1__inner_right_inner_change_rate_text">
                            65%
                            <span>забронировано</span>
                        </div>
                        <div class="catalog1__inner_right_inner_change_rate_text2">
                            <span>Регион «<?=$object->region->name?>»</span> - одно из популярных мест рыбалки в России, забронировано 65% мест.
                            Всего в <?=$object->region->dop_1?> <?=$object->region->ispObjectsCount?> мест для клёвой рыбалки.
                            Особенности: местный колорит, живописная природа и комфорт.
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="catalog1__inner_photos">
        <div class="catalog1__inner_photos_title">
            Регион <?=$object->region->name?>
        </div>
        <div class="catalog1__inner_photos_text1">
            Фотографии улова, присланные рыбаками
        </div>
        <div class="catalog1__inner_photos_content">
            <div class="index-slider1">
                <div class="swiper-container swiper-container-horizontal">
                    <div class="swiper-wrapper" style="transform: translate3d(-1349px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__1.jpg);"></div>
                            </div>
                        </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__2.jpg);"></div>
                            </div>
                        </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__3.jpg);"></div>
                            </div>
                        </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__4.jpg);"></div>
                            </div>
                        </div><div class="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="4" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__5.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__1.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__2.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide" data-swiper-slide-index="2" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__3.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide" data-swiper-slide-index="3" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__4.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide" data-swiper-slide-index="4" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__5.jpg);"></div>
                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__1.jpg);"></div>
                            </div>
                        </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__2.jpg);"></div>
                            </div>
                        </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__3.jpg);"></div>
                            </div>
                        </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__4.jpg);"></div>
                            </div>
                        </div><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 269.8px;">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img" style="background-image: url(/images/site_images/index-slider1__5.jpg);"></div>
                            </div>
                        </div></div>
                    <!-- Add Pagination -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo $this->render('footer1');?>
