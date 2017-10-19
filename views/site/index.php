<?php
$this->title = 'Главная';
use yii\helpers\Url;
use yii\db\Expression;
use kartik\date\DatePicker;
?>

<div class="header1">
    <div class="header1-block1">
        <div class="container">
            <div class="header1__logo">
                <a href="">
                    <img src="/images/site_images/logo1.png" alt="">
                </a>
            </div>
            <div class="header1__logo_buttons">
                <div class="header1__logo_buttons_lc">
                    <a href="/lc/add">Зарегистрировать свой объект</a>
                </div>
                <!--<div class="header1__logo_buttons_reg">
                    <a href="#">Зарегистрироваться</a>
                </div>-->
                <?php if (Yii::$app->user->isGuest) : ?>
                    <div class="header1__logo_buttons_login">
                        <a href="/login">Войти в аккаунт</a>
                    </div>
                <?php else: ?>
                    <div class="header1__logo_buttons_login">
                        <a href="/logout">Выйти из аккаунта</a>
                    </div>
                <?php endif;?>

            </div>
        </div>
    </div>
    <div class="header1-block2">
        <div class="header1-block2__text1">
            Найдём для Вас рыбное место
        </div>
        <div class="header1-block2__text2">
            Найдём и забронируем лучшие чартеры и глубоководную рыбалку <br>
            по всей России
        </div>
    </div>
    <div class="header1-block3">
        <div class="container">
            <div class="header1-block3__inner">
                <div class="header1-block3__inner_form">
                    <form action="/catalog" method="post">
                        <div class="header1-block3__inner_form_mesto">
                            <?php
                            $template = '<span>{{value}}</span>';
                            echo \kartik\typeahead\Typeahead::widget([
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
                        <div class="header1-block3__inner_form_date">
                            <?php
                            echo DatePicker::widget([
                                'name' => 'priezd',
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => Yii::$app->request->post('priezd') ? Yii::$app->request->post('priezd') :date('d.m.Y',strtotime('+3 DAY')),
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd.mm.yyyy'
                                ]
                            ]);
                            ?>
                            <div class="header1-block3__inner_form_date_arrow">
                                <img src="/images/site_images/arrow-down1.png" alt="">
                            </div>
                        </div>
                        <div class="header1-block3__inner_form_count">
                            <select name="people_count" id="">
                                <?php for($i = 1;$i<7;$i++) : ?>
                                    <option <?=Yii::$app->request->post('people_count') == $i ? 'selected' : '' ?> value="<?=$i?>"><?=$i?></option>
                                <?php endfor;?>
                            </select>
                            <div class="catalog1__inner_left_block1_form_item_count_arrow index">
                                <img src="/images/site_images/arrow-down1.png" alt="">
                            </div>
                        </div>
                        <div class="header1-block3__inner_form_btn">
                            <button type="submit">Поиск</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="header1-block4">
        <div class="container">
            <div class="header1-block4__inner">
                <div class="header1-block4__inner_list1">
                    <div class="header1-block4__inner_list1_item">
                        <div class="header1-block4__inner_list1_item_wrap">
                            <div class="header1-block4__inner_list1_item_wrap_name">
                                Сервис, котрого <br>
                                не хватало
                            </div>
                            <div class="header1-block4__inner_list1_item_wrap_border1">

                            </div>
                            <div class="header1-block4__inner_list1_item_wrap_content">
                                <div class="header1-block4__inner_list1_item_wrap_content_img">
                                    <img src="/images/site_images/header-geo1.png" alt="">
                                </div>
                                <div class="header1-block4__inner_list1_item_wrap_content_text">
                                    Уникальный сервис <br>
                                    бронирования мест <br>
                                    рыбалки.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header1-block4__inner_list1_item">
                        <div class="header1-block4__inner_list1_item_wrap">
                            <div class="header1-block4__inner_list1_item_wrap_name">
                                Самые популярные <br>
                                и клёвые места
                            </div>
                            <div class="header1-block4__inner_list1_item_wrap_border1">

                            </div>
                            <div class="header1-block4__inner_list1_item_wrap_content">
                                <div class="header1-block4__inner_list1_item_wrap_content_img">
                                    <img src="/images/site_images/header-popular1.png" alt="">
                                </div>
                                <div class="header1-block4__inner_list1_item_wrap_content_text">
                                    Более 1000 <br>
                                    рыболовных мест <br>
                                    по самым популярным <br>
                                    направлениям.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header1-block4__inner_list1_item">
                        <div class="header1-block4__inner_list1_item_wrap">
                            <div class="header1-block4__inner_list1_item_wrap_name">
                                Забронировал и поехал, <br>
                                всё просто
                            </div>
                            <div class="header1-block4__inner_list1_item_wrap_border1">

                            </div>
                            <div class="header1-block4__inner_list1_item_wrap_content">
                                <div class="header1-block4__inner_list1_item_wrap_content_img">
                                    <img src="/images/site_images/header-basket1.png" alt="">
                                </div>
                                <div class="header1-block4__inner_list1_item_wrap_content_text">
                                    Всего три шага <br>
                                    для рыбалки <br>
                                    твоей мечты.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="index-custom1">
    <div class="index-custom1__title">
        Совсем рядом
    </div>
    <div class="index-custom1__text1">
        Откройте для себя новые, захватывающие рыбалки рядом с Вами
    </div>
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
<div class="index-bestplaces">
    <div class="container">
        <div class="index-bestplaces__inner">
            <div class="index-bestplaces__inner_title">
                Лучшие места
            </div>
            <div class="index-bestplaces__inner_text1">
                Мы отобрали для Вас более 1000 мест и выделили лучшие
            </div>
            <div class="index-bestplaces__inner_list1">
                <div class="index-bestplaces__inner_list1_inner">
                    <a href="/catalog">
                        <div class="index-bestplaces__inner_list1_inner_item">
                            <div class="index-bestplaces__inner_list1_inner_item_inner">
                                <div class="index-bestplaces__inner_list1_inner_item_inner_img" style="background-image: url(/images/site_images/index-best-places__1.jpg)"></div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_text">
                                <span>
                                    Москва и <br>
                                    подмосковье
                                </span>
                                </div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_shadow"></div>
                            </div>
                        </div>
                    </a>
                    <a href="/catalog">
                        <div class="index-bestplaces__inner_list1_inner_item">
                            <div class="index-bestplaces__inner_list1_inner_item_inner">
                                <div class="index-bestplaces__inner_list1_inner_item_inner_img" style="background-image: url(/images/site_images/index-best-places__2.jpg)"></div>

                                <div class="index-bestplaces__inner_list1_inner_item_inner_text">
                                <span>
                                   Астрахань<br>
                                   и облась
                                </span>
                                </div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_shadow"></div>
                            </div>
                        </div>
                    </a>
                    <a href="/catalog">
                        <div class="index-bestplaces__inner_list1_inner_item">
                            <div class="index-bestplaces__inner_list1_inner_item_inner">
                                <div class="index-bestplaces__inner_list1_inner_item_inner_img" style="background-image: url(/images/site_images/index-best-places__3.jpg)"></div>

                                <div class="index-bestplaces__inner_list1_inner_item_inner_text">
                                <span>
                                    Ахтуба<br>
                                    и область
                                </span>
                                </div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_shadow"></div>
                            </div>
                        </div>
                    </a>
                    <a href="/catalog">
                        <div class="index-bestplaces__inner_list1_inner_item">
                            <div class="index-bestplaces__inner_list1_inner_item_inner">
                                <div class="index-bestplaces__inner_list1_inner_item_inner_img" style="background-image: url(/images/site_images/index-best-places__4.jpg)"></div>

                                <div class="index-bestplaces__inner_list1_inner_item_inner_text">
                                <span>
                                    Белое<br>
                                    море
                                </span>
                                </div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_shadow"></div>
                            </div>
                        </div>
                    </a>
                    <a href="/catalog">
                        <div class="index-bestplaces__inner_list1_inner_item">
                            <div class="index-bestplaces__inner_list1_inner_item_inner">
                                <div class="index-bestplaces__inner_list1_inner_item_inner_img" style="background-image: url(/images/site_images/index-best-places__5.jpg)"></div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_text">
                                <span>
                                    Владивосток
                                </span>
                                </div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_shadow"></div>
                            </div>
                        </div>
                    </a>
                    <a href="/catalog">
                        <div class="index-bestplaces__inner_list1_inner_item">
                            <div class="index-bestplaces__inner_list1_inner_item_inner">
                                <div class="index-bestplaces__inner_list1_inner_item_inner_img" style="background-image: url(/images/site_images/index-best-places__6.jpg)"></div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_text">
                                <span>
                                    Карелия
                                </span>
                                </div>
                                <div class="index-bestplaces__inner_list1_inner_item_inner_shadow"></div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="index-join1">
    <div class="container">
        <div class="index-join1__inner">
            <div class="index-join1__inner_title">
                Присоединяйтесь к тысячам рыбаков по всей России
            </div>
            <div class="index-join1__inner_list1">
                <div class="index-join1__inner_list1_item">
                    <div class="index-join1__inner_list1_item_wrap">
                        <div class="index-join1__inner_list1_item_wrap_img">
                            <img src="/images/site_images/index-join1__title.png" alt="">
                        </div>
                        <div class="index-join1__inner_list1_item_wrap_text1">
                            Василий А.В. только что забронировал
                            рыбалку «Пруд Пихтино» в Республике
                            Татарстан, Заинский район
                        </div>
                        <div class="index-join1__inner_list1_item_wrap_ava">

                        </div>
                    </div>
                </div>
                <div class="index-join1__inner_list1_item">
                    <div class="index-join1__inner_list1_item_wrap">
                        <div class="index-join1__inner_list1_item_wrap_img">
                            <img src="/images/site_images/index-join1__title.png" alt="">
                        </div>
                        <div class="index-join1__inner_list1_item_wrap_text1">
                            Василий А.В. только что забронировал
                            рыбалку «Пруд Пихтино» в Республике
                            Татарстан, Заинский район
                        </div>
                        <div class="index-join1__inner_list1_item_wrap_ava">

                        </div>
                    </div>
                </div>
                <div class="index-join1__inner_list1_item">
                    <div class="index-join1__inner_list1_item_wrap">
                        <div class="index-join1__inner_list1_item_wrap_img">
                            <img src="/images/site_images/index-join1__title.png" alt="">
                        </div>
                        <div class="index-join1__inner_list1_item_wrap_text1">
                            Василий А.В. только что забронировал
                            рыбалку «Пруд Пихтино» в Республике
                            Татарстан, Заинский район
                        </div>
                        <div class="index-join1__inner_list1_item_wrap_ava">

                        </div>
                    </div>
                </div>
            </div>
            <div class="index-join1__inner_title2">
                сервис, которого не хватало
            </div>
            <div class="index-join1__inner_text1">
                <p>Рыбалка — это уже не только вид ремесла, рыбалка — это отдых, эмоции,
                    приключение. На рыбалке мы можем снять повседневный ярлык, который носим
                    в городе, в обществе. Мы полностью отдаем себя природе, образуя единое
                    целое. Здесь, мы забываем негативные мысли, забываем городскую суету и
                    наслаждаемся, прежде всего чистотой и свежестью воздуха, наслаждаемся
                    разговорами у костра, ну и, конечно же, самой рыбалкой.</p>
                <p>Возможно ли найти то самое место, где клюет и ловится именно то что вы
                    хотите словить, как до него добраться, как забронировать, чтобы это
                    место не занял кто-нибудь другой, как словить ту рыбу, которая грезится
                    перед каждым забросом удочки. Это возможно, потому что мы скрупулезно
                    анализируем ваши желания, мы ищем и собираем информацию о всех местах
                    лова и создаем сервис рыбакам от рыбаков, которого не хватало.
                    <br>
                    <br>
                    Разделите с нами волнение от поклевки, азарт и адреналин от борьбы на
                    другом конце лески и радость победы.
                    <br>
                    Найдите свое клевое место!</p>

            </div>
        </div>
    </div>
</div>
<div class="index-preim1">
    <div class="container">
        <div class="preim1">
            <div class="preim1__inner">
                <div class="preim1__inner_list1">
                    <div class="preim1__inner_list1_item">
                        <div class="preim1__inner_list1_item_left">
                            <div class="preim1__inner_list1_item_left_img">
                                <img src="/images/site_images/preim1.png" alt="">
                            </div>
                        </div>
                        <div class="preim1__inner_list1_item_right">
                            <div class="preim1__inner_list1_item_right_title">
                                Отличная рыбалка на любой бюджет
                            </div>
                            <div class="preim1__inner_list1_item_right_text">
                                Бронирование без комиссии и дополнительных услуг, всегда актуальные
                                и цены и специальные предложения
                            </div>
                        </div>
                    </div>
                    <div class="preim1__inner_list1_item">
                        <div class="preim1__inner_list1_item_left">
                            <div class="preim1__inner_list1_item_left_img">
                                <img src="/images/site_images/preim2.png" alt="">
                            </div>
                        </div>
                        <div class="preim1__inner_list1_item_right">
                            <div class="preim1__inner_list1_item_right_title">
                                Прозрачная рейтинговая система и отзывы
                            </div>
                            <div class="preim1__inner_list1_item_right_text">
                                Реальные поездки, отзывы и бронирование. Опираясь на мнение
                                рыбаков, посетивших места, вы сможете принять правильное решение
                            </div>
                        </div>
                    </div>
                    <div class="preim1__inner_list1_item">
                        <div class="preim1__inner_list1_item_left">
                            <div class="preim1__inner_list1_item_left_img">
                                <img src="/images/site_images/preim3.png" alt="">
                            </div>
                        </div>
                        <div class="preim1__inner_list1_item_right">
                            <div class="preim1__inner_list1_item_right_title">
                                Более 1 000 предложений для рыбалки
                            </div>
                            <div class="preim1__inner_list1_item_right_text">
                                По всей России в каждом регионе и области, от бюджетных вариантов
                                и до предложений «Всё включено»
                            </div>
                        </div>
                    </div>
                    <div class="preim1__inner_list1_item">
                        <div class="preim1__inner_list1_item_left">
                            <div class="preim1__inner_list1_item_left_img">
                                <img src="/images/site_images/preim4.png" alt="">
                            </div>
                        </div>
                        <div class="preim1__inner_list1_item_right">
                            <div class="preim1__inner_list1_item_right_title">
                                Специальная поддержка от сервиса
                            </div>
                            <div class="preim1__inner_list1_item_right_text">
                                Готовы помочь Вам круглосуточно, ежедневно. Находите часто
                                задаваемые вопросы на специальной странице поддержки
                            </div>
                        </div>
                    </div>
                    <div class="preim1__inner_list1_item">
                        <div class="preim1__inner_list1_item_left">
                            <div class="preim1__inner_list1_item_left_img">
                                <img src="/images/site_images/preim5.png" alt="">
                            </div>
                        </div>
                        <div class="preim1__inner_list1_item_right">
                            <div class="preim1__inner_list1_item_right_title">
                                Детальное бронирование рыбалки
                            </div>
                            <div class="preim1__inner_list1_item_right_text">
                                Бронируйте, изменяйте бронь или вовсе отменяйте её в любое время,
                                выбирайте необходимые дополнения к рыбалке и отдыху
                            </div>
                        </div>
                    </div>
                    <div class="preim1__inner_list1_item">
                        <div class="preim1__inner_list1_item_left">
                            <div class="preim1__inner_list1_item_left_img">
                                <img src="/images/site_images/preim6.png" alt="">
                            </div>
                        </div>
                        <div class="preim1__inner_list1_item_right">
                            <div class="preim1__inner_list1_item_right_title">
                                Единственный подобный сервис в РФ
                            </div>
                            <div class="preim1__inner_list1_item_right_text">
                                Уникальное предложение для рыбоков России, сервис, который
                                позволит насладиться рыбалкой в проверенных местах
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="index-map1">
    <div class="container">
        <div class="index-map1__logo">
            <div class="index-map1__logo_img">
                <img src="/images/site_images/index-logo2.png" alt="">
            </div>
            <div class="index-map1__logo_text">
                клев в любом субъекте россии
            </div>
        </div>
    </div>
    <div class="index-map1__content1">
        <img src="/images/site_images/index-map1.png" alt="">
        <!--<div class="container">
            <div class="index-map1__content1_text1">
                Башкортостан: 11 мест для рыбалки
            </div>
            <div class="index-map1__content1_text2">
                <a href="#">Перейти</a>
            </div>
        </div>-->
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
