<div class="lc-view-bron">
    <div class="lc-view-bron__inner">
        <div class="lc-view-bron__inner_title">
            Бронь #<?=$bron->id?> на <?=\app\models\Functions::get_ad_date(date('d.m.Y',strtotime($bron->priezd)))?>
        </div>
        <div class="lc-view-bron__inner_object_name">
            <div class="lc-view-bron__inner_object_name_text1">
                Объект:
            </div>
            <div class="lc-view-bron__inner_object_name_text2">
                <?=$bron->object_name?>
            </div>
        </div>
        <?php if ($bron->people_count) : ?>
            <div class="lc-view-bron__inner_people_count">
                <div class="lc-view-bron__inner_people_count_text1">
                    Количество человек:
                </div>
                <div class="lc-view-bron__inner_people_count_text2">
                    <?=$bron->people_count?>
                </div>
            </div>
        <?php endif;?>
        <?php if ($bron->home_count) : ?>
            <div class="lc-view-bron__inner_home">
                <div class="lc-view-bron__inner_home_text1">
                    Дом:
                </div>
                <div class="lc-view-bron__inner_home_text2">
                    <?=$bron->home_name?> (количество: <?=$bron->home_count?>)
                </div>
            </div>
        <?php endif;?>

        <div class="lc-view-bron__inner_priezd">
            <div class="lc-view-bron__inner_priezd_text1">
                Приезд:
            </div>
            <div class="lc-view-bron__inner_priezd_text2">
                <?=\app\models\Functions::get_ad_date(date('d.m.Y',strtotime($bron->priezd))).', '.\app\models\Functions::getDayOfWeek(getdate(strtotime($bron->priezd)))?>
            </div>
        </div>
        <div class="lc-view-bron__inner_uezd">
            <div class="lc-view-bron__inner_priezd_text1">
                Уезд:
            </div>
            <div class="lc-view-bron__inner_uezd_text2">
                <?=\app\models\Functions::get_ad_date(date('d.m.Y',strtotime($bron->uezd))).', '.\app\models\Functions::getDayOfWeek(getdate(strtotime($bron->uezd)))?>
            </div>
        </div>
        <div class="lc-view-bron__inner_info1">
            <div class="lc-view-bron__inner_info1_text1">
                Инфо гостя:
            </div>
            <div class="lc-view-bron__inner_info1_text2">
                Имя:<?=$bron->client_name?>, телефон: <?=$bron->client_tel?>
            </div>
        </div>
    </div>
</div>