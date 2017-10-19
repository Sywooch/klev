<?php
use kartik\date\DatePicker;
?>

<div class="header2">
    <div class="container">
        <div class="header2__inner">
            <div class="header2__inner_block1">
                <div class="header2__inner_block1_logo">
                    <a href="/">
                        <img src="/images/site_images/catalog/logo1.png" alt="">
                        <span class="header2__inner_block1_logo_text">
                            сервис клёвых места
                        </span>
                    </a>
                </div>
            </div>
            <div class="header2__inner_block2">
                <div class="header2__inner_block2_object">
                    <a href="#">Зарегистрировать свой объект</a>
                </div>
                <div class="header2__inner_block2_reg">
                    <a href="#">Зарегистрироваться</a>
                </div>
                <div class="header2__inner_block2_lc">
                    <a href="#">Войти в аккаунт</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="breadcrumb1">
    <div class="container">
        <div class="breadcrumb1__inner">
            <div class="breadcrumb1__inner_items">
                <li><a href="#">Главная</a></li>
                <li>
                    <a href="#">
                        Республика Татарстан
                        <span>25 мест для рыбалки</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Тукаевский район
                        <span>11 мест для рыбалки</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Евлеево
                        <span>5 мест для рыбалки</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Результаты поиска
                        <span>Река Евлеевка, 2 взрослых на 25 сек.</span>
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
                    Река Евлеевка - одно из популярных мест
                    в Республике Татарстан, забронировано 45% мест.
                </div>
            </div>

        </div>
    </div>
</div>
<div class="catalog1">
    <div class="container">
        <div class="catalog1__inner">
            <div class="catalog1__inner_left">
                <div class="catalog1__inner_left_block1">
                    <div class="catalog1__inner_left_block1_form">
                        <form action="">
                            <div class="catalog1__inner_left_block1_form_item">
                                <label>
                                    <span class="catalog1__inner_left_block1_form_item_name">Место поездки:</span>
                                    <div class="catalog1__inner_left_block1_form_item_mesto">
                                        <?php
                                        use kartik\typeahead\Typeahead;
                                        use yii\helpers\Url;
                                        $template = '<span>{{value}}</span>';
                                        echo Typeahead::widget([
                                            'name' => 'search',
                                            'options' => [
                                                'placeholder' => 'Поиск...',
                                            ],
                                            'pluginOptions' => ['highlight'=>true],
                                            'dataset' => [
                                                [
                                                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                                    'display' => 'value',
                                                    'templates' => [
                                                        'header' => '<h3 class="league-name">Регионы</h3>',
                                                        'suggestion' => new \yii\web\JsExpression("Handlebars.compile('{$template}')")
                                                    ],
                                                    'remote' => [
                                                        'url' => Url::to(['/ajax/places-list1']) . '?q=%QUERY',
                                                        'wildcard' => '%QUERY',
                                                    ],
                                                    'limit'=>6
                                                ],
                                                [
                                                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                                    'display' => 'value',
                                                    'templates' => [
                                                        'header' => '<h3 class="league-name">Города</h3>',
                                                        'suggestion' => new \yii\web\JsExpression("Handlebars.compile('{$template}')")
                                                    ],
                                                    'remote' => [
                                                        'url' => Url::to(['/ajax/places-cities-list1']) . '?q=%QUERY',
                                                        'wildcard' => '%QUERY',
                                                    ],
                                                ],
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </label>
                            </div>
                            <div class="catalog1__inner_left_block1_form_item">
                                <label>
                                    <span class="catalog1__inner_left_block1_form_item_name">Приезжаем:</span>
                                    <div class="catalog1__inner_left_block1_form_item_priezd">
                                        <?php
                                        echo DatePicker::widget([
                                            'name' => 'priezd',
                                            'type' => DatePicker::TYPE_INPUT,
                                            'value' => date('d.m.Y',strtotime('+3 DAY')),
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'dd.mm.yyyy'
                                            ]
                                        ]);
                                        ?>
                                        <div class="catalog1__inner_left_block1_form_item_priezd_arrow">
                                            <img src="/images/site_images/arrow-down1.png" alt="">
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="catalog1__inner_left_block1_form_item">
                                <label>
                                    <span class="catalog1__inner_left_block1_form_item_name">Уезжаем:</span>
                                    <div class="catalog1__inner_left_block1_form_item_uezd">
                                        <?php
                                        echo DatePicker::widget([
                                            'name' => 'uezd',
                                            'type' => DatePicker::TYPE_INPUT,
                                            'value' => date('d.m.Y',strtotime('+3 DAY')),
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'dd.mm.yyyy'
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </label>
                            </div>
                            <div class="catalog1__inner_left_block1_form_item">
                                <label>
                                    <span class="catalog1__inner_left_block1_form_item_name">Количество человек:</span>
                                    <div class="catalog1__inner_left_block1_form_item_count">
                                           <select name="" id="">
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                           </select>
                                           <div class="catalog1__inner_left_block1_form_item_count_arrow">
                                               <img src="/images/site_images/arrow-down1.png" alt="">
                                           </div>
                                    </div>
                                </label>
                            </div>
                            <div class="catalog1__inner_left_block1_form_btn">
                                <button type="submit">Поиск</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="catalog1__inner_left_filter1">
                    <div class="catalog1__inner_left_filter1_title">
                        Уточните критерии поиска
                    </div>
                    <div class="catalog1__inner_left_filter1_form">
                        <form action="">
                            <div class="catalog1__inner_left_filter1_form_list1">
                                <div class="catalog1__inner_left_filter1_form_list1_title">
                                    Тип водоема
                                </div>
                                <div class="catalog1__inner_left_filter1_form_list1_items">
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_left_filter1_form_list1">
                                <div class="catalog1__inner_left_filter1_form_list1_title">
                                    Тип водоема
                                </div>
                                <div class="catalog1__inner_left_filter1_form_list1_items">
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_left_filter1_form_list1">
                                <div class="catalog1__inner_left_filter1_form_list1_title">
                                    Тип водоема
                                </div>
                                <div class="catalog1__inner_left_filter1_form_list1_items">
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                    <div class="catalog1__inner_left_filter1_form_list1_items_item">
                                        <label>
                                            <input type="checkbox" name="" id="">
                                            <span class="img"></span>
                                            <span class="name">Море</span>
                                        </label>
                                        <div class="catalog1__inner_left_filter1_form_list1_items_item_count">
                                            25
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="catalog1__inner_left_map1">
                    <div class="catalog1__inner_left_map1_inner">
                        <div class="catalog1__inner_left_map1_inner_img">
                            <img src="/images/site_images/catalog/map2.jpg" alt="">
                        </div>
                        <div class="catalog1__inner_left_map1_inner_text1">
                            <a href="#">Посмотреть на карте</a>
                        </div>
                        <div class="catalog1__inner_left_map1_inner_text2">
                            <a href="#">Татарстан</a>
                        </div>
                    </div>
                </div>
                <div class="catalog1__inner_left_block2">
                    <div class="catalog1__inner_left_block2_inner">
                        <div class="catalog1__inner_left_block2_inner_title">
                            Рыбалка поблизости
                        </div>
                        <div class="catalog1__inner_left_block2_inner_list1">
                            <div class="catalog1__inner_left_block2_inner_list1_item">
                                <div class="catalog1__inner_left_block2_inner_list1_item_title">
                                    <a href="#">Татарстан</a>
                                </div>
                                <div class="catalog1__inner_left_block2_inner_list1_item_count">
                                    25 мест
                                </div>
                                <div class="catalog1__inner_left_block2_inner_list1_item_text1">
                                    Особенности: местный колорит, живописная
                                    природа и комфорт.
                                </div>
                            </div>
                            <div class="catalog1__inner_left_block2_inner_list1_item">
                                <div class="catalog1__inner_left_block2_inner_list1_item_title">
                                    <a href="#">Татарстан</a>
                                </div>
                                <div class="catalog1__inner_left_block2_inner_list1_item_count">
                                    25 мест
                                </div>
                                <div class="catalog1__inner_left_block2_inner_list1_item_text1">
                                    Особенности: местный колорит, живописная
                                    природа и комфорт.
                                </div>
                            </div>
                            <div class="catalog1__inner_left_block2_inner_list1_item">
                                <div class="catalog1__inner_left_block2_inner_list1_item_title">
                                    <a href="#">Татарстан</a>
                                </div>
                                <div class="catalog1__inner_left_block2_inner_list1_item_count">
                                    25 мест
                                </div>
                                <div class="catalog1__inner_left_block2_inner_list1_item_text1">
                                    Особенности: местный колорит, живописная
                                    природа и комфорт.
                                </div>
                            </div>
                            <div class="catalog1__inner_left_block2_inner_list1_item">
                                <div class="catalog1__inner_left_block2_inner_list1_item_title">
                                    <a href="#">Татарстан</a>
                                </div>
                                <div class="catalog1__inner_left_block2_inner_list1_item_count">
                                    25 мест
                                </div>
                                <div class="catalog1__inner_left_block2_inner_list1_item_text1">
                                    Особенности: местный колорит, живописная
                                    природа и комфорт.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="catalog1__inner_right">
                <div class="catalog1__inner_right_inner">
                    <div class="catalog1__inner_right_inner_block1">
                        <div class="catalog1__inner_right_inner_title">
                            Река Евлеевка (Республика Татарстан): найдено 5 мест для рыбалки
                        </div>
                        <div class="catalog1__inner_right_inner_text1">
                            <span>Всего в Республике Татарстан 25 мест для клёвой рыбалки</span>
                            <span>Особенности: местный колорит, живописная природа и комфорт</span>
                        </div>
                    </div>
                    <div class="catalog1__inner_right_inner_block2">
                        <a href="#">
                            <img src="/images/site_images/catalog/map1.png" alt="">
                        </a>
                    </div>
                    <div class="catalog1__inner_right_filter1">
                        <div class="catalog1__inner_right_filter1_inner">
                            <div class="catalog1__inner_right_filter1_inner_title">
                                Отсортируйте результаты поиска, чтобы найти подходящий вариант для рыбалки!
                            </div>
                            <div class="catalog1__inner_right_filter1_inner_block1">
                                <div class="catalog1__inner_right_filter1_inner_block1_list1">
                                    <ul>
                                        <li class="active"><a href="#">Наше предложение</a></li>
                                        <li><a href="#">Низкая цена</a></li>
                                        <li><a href="#">Сортировка по отзывам</a></li>
                                        <li><a href="#">По цене и отзывам</a></li>
                                        <li><a href="#">Сортировка по конфорту</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="catalog1__inner_right_list1">
                        <div class="catalog1__inner_right_list1_inner">
                            <div class="catalog1__inner_right_list1_inner_item">
                                <div class="catalog1__inner_right_list1_inner_item_inner">
                                    <div class="catalog1__inner_right_list1_inner_item_inner_img" style="background-image: url('/images/site_images/catalog/catalog1-item1.jpg')"></div>
                                    <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                <a href="#">Рыбное хозяйство «Лёвка»</a>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                    <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                <span>Река Евлеевка</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                15 человек сейчас просматривают данное предложение
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                Бронирование без предоплаты
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                <span class="big">большой спрос</span>
                                                <span>За последние 24 часа забронировано 51 раз</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl2.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl3.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl4.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">
                                                Хорошо 7.5
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                255 отзывов
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                <span>Мгновенное бронирование!</span>
                                                <span>Брнирование без предоплаты!</span>
                                                <span>Бесплатная отмена брони!</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                3 520Р
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                <a href="#">Посмотреть и забронировать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_right_list1_inner_item">
                                <div class="catalog1__inner_right_list1_inner_item_inner">
                                    <div class="catalog1__inner_right_list1_inner_item_inner_img" style="background-image: url('/images/site_images/catalog/catalog1-item1.jpg')"></div>
                                    <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                <a href="#">Рыбное хозяйство «Лёвка»</a>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                    <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                <span>Река Евлеевка</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                15 человек сейчас просматривают данное предложение
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                Бронирование без предоплаты
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                <span class="big">большой спрос</span>
                                                <span>За последние 24 часа забронировано 51 раз</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl2.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl3.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl4.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">
                                                Хорошо 7.5
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                255 отзывов
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                <span>Мгновенное бронирование!</span>
                                                <span>Брнирование без предоплаты!</span>
                                                <span>Бесплатная отмена брони!</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                3 520Р
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                <a href="#">Посмотреть и забронировать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_right_list1_inner_item">
                                <div class="catalog1__inner_right_list1_inner_item_inner">
                                    <div class="catalog1__inner_right_list1_inner_item_inner_img" style="background-image: url('/images/site_images/catalog/catalog1-item1.jpg')"></div>
                                    <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                <a href="#">Рыбное хозяйство «Лёвка»</a>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                    <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                <span>Река Евлеевка</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                15 человек сейчас просматривают данное предложение
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                Бронирование без предоплаты
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                <span class="big">большой спрос</span>
                                                <span>За последние 24 часа забронировано 51 раз</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl2.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl3.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl4.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">
                                                Хорошо 7.5
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                255 отзывов
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                <span>Мгновенное бронирование!</span>
                                                <span>Брнирование без предоплаты!</span>
                                                <span>Бесплатная отмена брони!</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                3 520Р
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                <a href="#">Посмотреть и забронировать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_right_list1_inner_item">
                                <div class="catalog1__inner_right_list1_inner_item_inner">
                                    <div class="catalog1__inner_right_list1_inner_item_inner_img" style="background-image: url('/images/site_images/catalog/catalog1-item1.jpg')"></div>
                                    <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                <a href="#">Рыбное хозяйство «Лёвка»</a>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                    <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                <span>Река Евлеевка</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                15 человек сейчас просматривают данное предложение
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                Бронирование без предоплаты
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                <span class="big">большой спрос</span>
                                                <span>За последние 24 часа забронировано 51 раз</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl2.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl3.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl4.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">
                                                Хорошо 7.5
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                255 отзывов
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                <span>Мгновенное бронирование!</span>
                                                <span>Брнирование без предоплаты!</span>
                                                <span>Бесплатная отмена брони!</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                3 520Р
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                <a href="#">Посмотреть и забронировать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_right_list1_inner_reviews">
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
                            </div>
                            <div class="catalog1__inner_right_list1_inner_item">
                                <div class="catalog1__inner_right_list1_inner_item_inner">
                                    <div class="catalog1__inner_right_list1_inner_item_inner_img" style="background-image: url('/images/site_images/catalog/catalog1-item1.jpg')"></div>
                                    <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                <a href="#">Рыбное хозяйство «Лёвка»</a>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                    <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                <span>Река Евлеевка</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                15 человек сейчас просматривают данное предложение
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                Бронирование без предоплаты
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                <span class="big">большой спрос</span>
                                                <span>За последние 24 часа забронировано 51 раз</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl2.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl3.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl4.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">
                                                Хорошо 7.5
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                255 отзывов
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                <span>Мгновенное бронирование!</span>
                                                <span>Брнирование без предоплаты!</span>
                                                <span>Бесплатная отмена брони!</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                3 520Р
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                <a href="#">Посмотреть и забронировать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_right_list1_inner_item">
                                <div class="catalog1__inner_right_list1_inner_item_inner">
                                    <div class="catalog1__inner_right_list1_inner_item_inner_img" style="background-image: url('/images/site_images/catalog/catalog1-item1.jpg')"></div>
                                    <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                <a href="#">Рыбное хозяйство «Лёвка»</a>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                    <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                <span>Река Евлеевка</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                15 человек сейчас просматривают данное предложение
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                Бронирование без предоплаты
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                <span class="big">большой спрос</span>
                                                <span>За последние 24 часа забронировано 51 раз</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl2.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl3.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl4.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">
                                                Хорошо 7.5
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                255 отзывов
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                <span>Мгновенное бронирование!</span>
                                                <span>Брнирование без предоплаты!</span>
                                                <span>Бесплатная отмена брони!</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                3 520Р
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                <a href="#">Посмотреть и забронировать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_right_list1_inner_item">
                                <div class="catalog1__inner_right_list1_inner_item_inner">
                                    <div class="catalog1__inner_right_list1_inner_item_inner_img" style="background-image: url('/images/site_images/catalog/catalog1-item1.jpg')"></div>
                                    <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                <a href="#">Рыбное хозяйство «Лёвка»</a>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                    <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                <span>Река Евлеевка</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                15 человек сейчас просматривают данное предложение
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                Бронирование без предоплаты
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                <span class="big">большой спрос</span>
                                                <span>За последние 24 часа забронировано 51 раз</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl2.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl3.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl4.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">
                                                Хорошо 7.5
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                255 отзывов
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                <span>Мгновенное бронирование!</span>
                                                <span>Брнирование без предоплаты!</span>
                                                <span>Бесплатная отмена брони!</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                3 520Р
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                <a href="#">Посмотреть и забронировать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog1__inner_right_list1_inner_item">
                                <div class="catalog1__inner_right_list1_inner_item_inner">
                                    <div class="catalog1__inner_right_list1_inner_item_inner_img" style="background-image: url('/images/site_images/catalog/catalog1-item1.jpg')"></div>
                                    <div class="catalog1__inner_right_list1_inner_item_inner_content">
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block1">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_title">
                                                <a href="#">Рыбное хозяйство «Лёвка»</a>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate_list1_item">
                                                        <img src="/images/site_images/catalog/star1.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_rate2">
                                                    <a href="#"><img src="/images/site_images/catalog/geo3.png" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_geo1">
                                                <span>Река Евлеевка</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_views1">
                                                15 человек сейчас просматривают данное предложение
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_bron">
                                                Бронирование без предоплаты
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_spros">
                                                <span class="big">большой спрос</span>
                                                <span>За последние 24 часа забронировано 51 раз</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service">
                                                <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1">
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl1.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl2.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl3.png" alt="">
                                                    </div>
                                                    <div class="catalog1__inner_right_list1_inner_item_inner_content_block1_service_list1_item">
                                                        <img src="/images/site_images/catalog/usl4.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="catalog1__inner_right_list1_inner_item_inner_content_block2">
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text1">
                                                Хорошо 7.5
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_text2">
                                                255 отзывов
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_preim">
                                                <span>Мгновенное бронирование!</span>
                                                <span>Брнирование без предоплаты!</span>
                                                <span>Бесплатная отмена брони!</span>
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_price">
                                                3 520Р
                                            </div>
                                            <div class="catalog1__inner_right_list1_inner_item_inner_content_block2_bron">
                                                <a href="#">Посмотреть и забронировать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <span><a href="#">Перейти к сортировке</a></span>
                                    <span><a href="#">Перейти к критериям</a></span>
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
                                > <span><a href="#">Республика Татарстан</a></span>
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
                            <span>Республика Татарстан</span> - одно из популярных мест рыбалки в России, забронировано 65% мест.
                            Всего в Республике Татарстан 25 мест для клёвой рыбалки.
                            Особенности: местный колорит, живописная природа и комфорт.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="catalog1__inner_photos">
        <div class="catalog1__inner_photos_title">
            Республика Татарстан
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
<div class="footer1">
    <div class="container">
        <div class="footer1__wrap">
            <div class="footer1__wrap_menu">
                <li><a href="#">Компания</a></li>
                <li><a href="#">Положения и Условия</a></li>
                <li><a href="#">Карьера</a></li>
                <li><a href="#">Юридическая информация</a></li>
                <li><a href="#">Вакансии</a></li>
                <li><a href="#">Политика конфиденциальности</a></li>
                <li><a href="#">Пресса</a></li>
                <li><a href="#">Карта сайта</a></li>
                <li><a href="#">Служба поддержки</a></li>
                <li><a href="#">Политика использования файлов cookie</a></li>
                <li><a href="#">Investor Relations</a></li>
            </div>
        </div>
    </div>
</div>
<div class="footer2">
    <div class="container">
        <div class="footer2__inner">
            <div class="footer2__inner_logo">
                <img src="/images/site_images/index-logo3.png" alt="">
            </div>
            <div class="footer2__inner_copy">
                <div class="footer2__inner_copy_text1">
                    <a href="#">Авторские права</a>&nbsp;
                </div>
                <div class="footer2__inner_copy_text2">
                    |&nbsp;2017 «Где клёв» &nbsp;
                </div>
                <div class="footer2__inner_copy_text3">
                    |&nbsp;Все права защищены
                </div>
            </div>
        </div>
    </div>
</div>
