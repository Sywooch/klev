<?php
use kartik\date\DatePicker;
use app\models\Functions;

$assets = \app\modules\catalog\assets\CatalogAsset::register($this);
$imagePath = $assets->baseUrl;
if ($place_type == 'city'){
    $this->title = 'Поиск объектов в '.$place->dop_1.', '.$region->name;
}elseif ($place_type == 'region'){
    $this->title = 'Поиск объектов в '.$region->dop_1;
}else{
    $this->title = 'Поиск объектов в России';
}
?>
<?php
$this->registerJs(
    '$("document").ready(function(){
            
            $("#my-pjax1").on("pjax:beforeSend", function() {
                $(".catalog1__inner_right").addClass("blur");
            });
            $("#my-pjax1").on("pjax:end", function() {
                $(".catalog1__inner_right").removeClass("blur");
                var destination = $(\'.catalog1__inner\').offset().top;
                $(\'body,html\').animate({
                    scrollTop: 0
                }, 1000);
                if ($(\'.hidden_search\').find(\'span\').length > 0){
                    $(".twitter-typeahead input").val($(\'.hidden_search\').find(\'span\').text());
                    console.log($(\'.hidden_search\').find(\'span\').text());
                }
            });
            if ($(\'.hidden_search\').find(\'span\').length > 0){
                    $(".twitter-typeahead input").val($(\'.hidden_search\').find(\'span\').text());
                    console.log($(\'.hidden_search\').find(\'span\').text());
                }
           
    });'
);
?>

<?php echo $this->render('header1');?>
<div class="breadcrumb1">
    <div class="container">
        <div class="breadcrumb1__inner">
            <div class="breadcrumb1__inner_items">
                <li><a href="/">Главная</a></li>
                <li>
                    <a href="/catalog">
                        Россия
                        <span><?=\app\models\IspObjects::find()->where('active = 1')->count()?> мест для рыбалки</span>
                    </a>
                </li>
                <?php if ($region) : ?>
                    <li>
                        <a href="<?=Functions::getPlaceUrl('',$region->id)?>">
                            Регион <?=$region->name?>
                            <span><?=$region->ispObjectsCount?> мест для рыбалки</span>
                        </a>
                    </li>
                <?php endif;?>
                <?php if ($place_type == 'city') : ?>
                    <li>
                        <a href="<?=Functions::getPlaceUrl($place->id,'')?>">
                            <?=$place->name?>
                            <span><?=$place->ispObjectsCount?> мест для рыбалки</span>
                        </a>
                    </li>
                <?php endif;?>
                <!--<li>
                    <a href="#">
                        Результаты поиска
                        <span>Река Евлеевка, 2 взрослых на 25 сек.</span>
                    </a>
                </li>-->
            </div>
            <div class="breadcrumb1__inner_block1">
                <?php if ($place_type == 'city' || $place_type == 'region') : ?>
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
                        <?php if ($place_type == 'city') : ?>
                            <?=$place->name?> - одно из популярных мест
                            <?=$region->dop_1?>, забронировано 45% мест.
                        <?php elseif ($place_type == 'region'): ?>
                            <?=$region->name?> - один из популярных регионов
                            в России, забронировано 45% мест.
                        <?php endif;?>
                    </div>
                <?php endif;?>
            </div>

        </div>
    </div>
</div>
<div class="catalog1">
    <div class="container">
        <div class="catalog1__inner">
            <?php \yii\widgets\Pjax::begin(['id'=>'my-pjax1']);?>
            <div class="catalog1__inner_left">
                <form action="/catalog" method="POST" data-pjax="true">
                <?php echo $this->render('search1');?>
                <div class="catalog1__inner_left_filter1">
                    <div class="catalog1__inner_left_filter1_title">
                        Уточните критерии поиска
                    </div>
                    <div class="catalog1__inner_left_filter1_form">
                            <div class="catalog1__inner_left_filter1_form_list1">
                                <div class="catalog1__inner_left_filter1_form_list1_title">
                                    Удобства
                                </div>
                                <div class="catalog1__inner_left_filter1_form_list1_items">
                                    <?php foreach ($comfort_list1 as $key=>$value) : ?>

                                        <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                            <label>
                                                <input type="checkbox" <?=in_array($value->id,$current_comfort) ? 'checked' : ''?> name="comfort[]" value="<?=$value->id?>" id="">
                                                <span class="img"></span>
                                                <span class="name"><?=$value->name?></span>
                                            </label>
                                            <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                                <!--25-->
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="catalog1__inner_left_filter1_form_list1">
                                <div class="catalog1__inner_left_filter1_form_list1_title">
                                    Виды рыб
                                </div>
                                <div class="catalog1__inner_left_filter1_form_list1_items">
                                    <?php foreach ($fishes_list1 as $key=>$value) : ?>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                            <label>
                                                <input type="checkbox" <?=in_array($value->id,$current_fishes) ? 'checked' : ''?> name="fishes[]" value="<?=$value->id?>" id="">
                                                <span class="img"></span>
                                                <span class="name"><?=$value->name?></span>
                                            </label>
                                            <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                                <!--25-->
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                                <?php if (count($fishes_list1) > 9) : ?>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_all">
                                        <a href="#">Показать все</a>
                                    </div>
                                <?php endif;?>
                            </div>
                    </div>
                </div>
                <?php if ($place_type == 'city' || $place_type == 'region') : ?>
                    <div class="catalog1__inner_left_map1">
                        <div class="catalog1__inner_left_map1_inner">
                            <div class="catalog1__inner_left_map1_inner_img">
                                <img src="/images/site_images/catalog/map2.jpg" alt="">
                            </div>
                            <div class="catalog1__inner_left_map1_inner_text1">
                                <a class="no_href" href="#">Посмотреть на карте</a>
                            </div>
                            <div class="catalog1__inner_left_map1_inner_text2">
                                <a class="no_href" href="#"><?=$place_type == 'city' ? $place->name : $region->name?></a>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if ($similar_cities) :?>
                    <div class="catalog1__inner_left_block2">
                        <div class="catalog1__inner_left_block2_inner">
                            <div class="catalog1__inner_left_block2_inner_title">
                                Рыбалка поблизости
                            </div>
                            <div class="catalog1__inner_left_block2_inner_list1">
                                <?php foreach ($similar_cities as $key=>$value) : ?>
                                    <div class="catalog1__inner_left_block2_inner_list1_item">
                                        <div class="catalog1__inner_left_block2_inner_list1_item_title">
                                            <a href="<?=Functions::getPlaceUrl($value->id,'')?>"><?=$value->name?></a>
                                        </div>
                                        <div class="catalog1__inner_left_block2_inner_list1_item_count">
                                            <?=$value->ispObjectsCount?> мест
                                        </div>
                                        <div class="catalog1__inner_left_block2_inner_list1_item_text1">
                                            Особенности: местный колорит, живописная
                                            природа и комфорт.
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                </form>
            </div>
            <div class="catalog1__inner_right">
                <div class="catalog1__inner_right_inner">
                    <div class="catalog1__inner_right_inner_block1">
                        <div class="catalog1__inner_right_inner_title">
                            <?php if ($place_type == 'city'): ?>
                                <?=$place->name?> (регион «<?=$region->name?>»): найдено <?=count($isp_objects)?> мест для рыбалки
                             <?php elseif ($place_type == 'region'): ?>
                                Регион «<?=$region->name?>»: найдено <?=count($isp_objects)?> мест для рыбалки
                             <?php else: ?>
                                Россия: по запросу найдено <?=count($isp_objects)?> мест для рыбалки
                            <?php endif;?>

                        </div>
                        <div class="catalog1__inner_right_inner_text1">
                            <?php if ($place_type == 'city' || $place_type == 'region') : ?>
                                <span>Всего <?=$region->dop_1 ? $region->dop_1 : 'в регионе '.$region->name?> <?=$region->ispObjectsCount?> мест для клёвой рыбалки</span>
                                <span>Особенности: местный колорит, живописная природа и комфорт</span>
                            <?php else: ?>
                                <span>Всего в России <?=\app\models\IspObjects::find()->where('active = 1')->count()?> мест для клёвой рыбалки</span>
                                <span>Особенности: местный колорит, живописная природа и комфорт</span>
                            <?php endif;?>


                        </div>
                    </div>
                    <div class="catalog1__inner_right_inner_block2">
                        <a class="no_href" href="#">
                            <img src="/images/site_images/catalog/map1.png" alt="">
                        </a>
                    </div>
                    <?php if (!$isp_objects) : ?>
                        <div class="catalog1__nf">
                            Извините, по данному запросу ничего не найдено, попробуйте изменить критерии поиска или <a
                                    href="/catalog">сбросить фильтр</a>
                        </div>
                    <?php else: ?>
                        <div class="catalog1__inner_right_filter1">
                            <div class="catalog1__inner_right_filter1_inner">
                                <div class="catalog1__inner_right_filter1_inner_title">
                                    Отсортируйте результаты поиска, чтобы найти подходящий вариант для рыбалки!
                                </div>
                                <div class="catalog1__inner_right_filter1_inner_block1">
                                    <div class="catalog1__inner_right_filter1_inner_block1_list1">
                                        <ul>
                                            <?php
                                            $url1 = '/catalog'.(Yii::$app->request->get('region') ? '/'.Yii::$app->request->get('region') : ''.(Yii::$app->request->get('city') ? '/'.Yii::$app->request->get('city') : ''.''));
                                            ?>

                                            <li class="<?=(Yii::$app->request->post('order1') == 'default' ? 'active' : '')?>"><a class="default" href="<?=$url1?>">Наше предложение</a></li>
                                            <li class=" <?=(Yii::$app->request->post('order1') == 'price_asc' ? 'active' : '')?>"><a class="price" href="<?=$url1?>?order=price">Низкая цена</a></li>
                                            <!-- <li><a href="#">Сортировка по отзывам</a></li>
                                             <li><a href="#">По цене и отзывам</a></li>
                                             <li><a href="#">Сортировка по конфорту</a></li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>

                    <?php if ($isp_objects) : ?>
                        <div class="catalog1__inner_right_list1">
                            <div class="catalog1__inner_right_list1_inner">
                                <?php foreach ($isp_objects as $key=>$value) : ?>
                                    <?php
                                    if ($value->reviews){
                                        $res = Functions::calculateReviews1($value->reviews);
                                    }else{
                                        $res['sr'] = 6.5;
                                        $res['oc'] = 'Хорошо';
                                    }
                                    ?>
                                    <?php $object_url = Functions::getObjectUrl($value->id);?>
                                    <div class="catalog1__inner_right_list1_inner_item">
                                        <div class="catalog1__inner_right_list1_inner_item_inner">
                                            <a data-pjax="0" href="<?=$object_url?>">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_img" <?=$value->photo ? 'style="background-image: url(/images/isp_objects/'.$value->photo->image.')' : ''?>"></div>
                                            </a>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                        <a data-pjax="0" href="<?=$object_url?>"><?=$value->name?></a>
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                            <?php for ($i = 1;$i<=ceil($res['sr'] / 2);$i++) : ?>
                                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                                    <img src="/images/site_images/catalog/star1.png" alt="">
                                                                </div>
                                                            <?php endfor;?>
                                                        </div>
                                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                            <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                        </div>
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                        <a href="<?=Functions::getPlaceUrl($value->city->id,'')?>">
                                                            <span><?=$value->city->name?></span>
                                                        </a>
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                        <?=$value->currentViewsCount?> человек сейчас просматривают данное предложение
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                        Оплата без комиссии
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                        <span class="big">большой спрос</span>
                                                        <span>За последние 24 часа забронировано <?=rand(6,24)?> раз</span>
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                            <?php if ($value->max_ulov > 5) : ?>
                                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                                    <img src="/images/site_images/catalog/usl1.png" alt="">
                                                                </div>
                                                            <?php endif;?>
                                                            <?php if ($value->snasti) : ?>
                                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                                    <img src="/images/site_images/catalog/usl2.png" alt="">
                                                                </div>
                                                            <?php endif;?>
                                                            <?php if ($value->homes) : ?>
                                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                                    <img src="/images/site_images/catalog/usl3.png" alt="">
                                                                </div>
                                                            <?php endif;?>
                                                            <?php if ($value->homes) : ?>
                                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                                    <img src="/images/site_images/catalog/usl4.png" alt="">
                                                                </div>
                                                            <?php endif;?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">

                                                        <?=$res['oc']?> <?=$res['sr']?>
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                        <?=count($value->reviews)?> отзывов
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                        <span>Мгновенное бронирование!</span>
                                                        <span>Брнирование комиссии!</span>
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                        <?=$value->price1?>Р (за человека)
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                        <a data-pjax="0" href="<?=$object_url?>">Посмотреть и забронировать</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>

                                <!--<div class="catalog1__inner_right_list1_inner_reviews">
                                    <div class="catalog1__inner_right_list1_inner_reviews_list1">
                                        <div class="catalog1__inner_right_list1_inner_reviews_list1_item">
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_img">
                                                <img src="/images/site_images/catalog/reviews1_treug1.png" alt="">
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_text1">
                                                <span>
                                                    Василий А.В. только что забронировал
                                                    рыбалку «Пруд Пихтино» в Республике
                                                    Татарстан, Заинский район
                                                </span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_text1_ava">

                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_reviews_list1_item">
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_img">
                                                <img src="/images/site_images/catalog/reviews1_treug1.png" alt="">
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_text1">
                                                <span>
                                                    Василий А.В. только что забронировал
                                                    рыбалку «Пруд Пихтино» в Республике
                                                    Татарстан, Заинский район
                                                </span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_text1_ava">

                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_reviews_list1_item">
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_img">
                                                <img src="/images/site_images/catalog/reviews1_treug1.png" alt="">
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_text1">
                                                <span>
                                                    Василий А.В. только что забронировал
                                                    рыбалку «Пруд Пихтино» в Республике
                                                    Татарстан, Заинский район
                                                </span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_reviews_list1_item_text1_ava">

                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    <?php endif;?>

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
                                    <span><a href="#" class="sort">Перейти к сортировке</a></span>
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
                                <?php if ($place_type == 'city' || $place_type == 'region') : ?>
                                    Рыбалка в этом же регионе: <br>
                                    > <span><a href="<?=Functions::getPlaceUrl($region->id)?>"><?=$region->name?></a></span>
                                <?php else : ?>
                                    Рыбалка в этой же стране: <br>
                                    > <span><a href="/catalog">Россия</a></span>
                                <?php endif;?>

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
                            <?php if ($place_type == 'city' || $place_type == 'region') : ?>
                                <span>Регион «<?=$region->name?>»</span> - одно из популярных мест рыбалки в России, забронировано 65% мест.
                                Всего в <?=$region->dop_1?> <?=$region->ispObjectsCount?> мест для клёвой рыбалки.
                                Особенности: местный колорит, живописная природа и комфорт.
                            <?php else: ?>
                                Всего в России <?=\app\models\IspObjects::find()->where('active = 1')->count()?> мест для клёвой рыбалки.
                                Особенности: местный колорит, живописная природа и комфорт.
                            <?php endif;?>

                        </div>
                    </div>

                </div>
            </div>
            <div class="hidden_search">
                <?php if (Yii::$app->request->post('search')) : ?>
                    <span><?=Yii::$app->request->post('search')?></span>
                <?elseif ($place_type == 'city') :?>
                    <span><?=$place->name?></span>
                <?elseif ($place_type == 'region') :?>
                    <span><?=$region->name?></span>
                <?php endif;?>
            </div>
            <?php \yii\widgets\Pjax::end();?>
        </div>
    </div>
    <div class="catalog1__inner_photos">
        <div class="catalog1__inner_photos_title">
        <?php if ($place_type == 'city' || $place_type == 'region') : ?>
            Регион <?=$region->name?>
        <?php else:?>
            Россия
        <?php endif;?>

        </div>
        <div class="catalog1__inner_photos_text1">
            Фотографии улова, присланные рыбаками
        </div>
        <div class="catalog1__inner_photos_content">
            <div class="index-slider1">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img"
                                     style="background-image: url(/images/site_images/index-slider1__1.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img"
                                     style="background-image: url(/images/site_images/index-slider1__2.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img"
                                     style="background-image: url(/images/site_images/index-slider1__3.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img"
                                     style="background-image: url(/images/site_images/index-slider1__4.jpg);"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="index-slider1__item">
                                <div class="index-slider1__item_img"
                                     style="background-image: url(/images/site_images/index-slider1__5.jpg);"></div>
                            </div>
                        </div>

                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

        </div>
    </div>

</div>
<?php echo $this->render('footer1');?>