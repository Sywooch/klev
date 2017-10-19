<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
$functions = new \app\models\Functions();
$this->title = $cat->name;
$bread = $functions->getBread($cat->id);

if (count($bread) > 1) {
    foreach ($bread as $key => $value) {
        if (count($bread) - 1 == $key) continue;
        $this->params['breadcrumbs'][] = ['label' => $value['name'], 'url' => [\app\models\Cats::get_url($value['id'])]];
    }
}
$this->params['breadcrumbs'][] = $cat->name;
\app\modules\shop\assets\ShopAsset::register($this);
?>

<div class="shop-catalog1">
    <div class="container">
        <div class="shop-catalog1_wrap">
            <div class="shop-catalog1_wrap_left">
                <div class="shop-catalog1_wrap_left_menu">
                    <ul class="menu2__list">
                        <?php

                        $main_cats = \app\models\Cats::find()->where('parent_id=166')->all();
                        foreach ($main_cats as $key => $value) {
                            $url = \app\models\Cats::get_url($value->id);

                            echo '<li class="' . ($cat->parent->id == $value->id ? 'active' : '') . '">
                         <a href="' . $url . '">' . $value->name . '</a>';
                            //показываем второй уровень если он есть
                            if ($value->childs) {
                                echo '<ul>';
                                foreach ($value->childs as $key2 => $value2) {
                                    $url = \app\models\Cats::get_url($value2->id);
                                    echo '<li>
                                 <a ' . ($cat->id == $value2->id ? 'class="active"' : '') . 'href="' . $url . '">' . $value2->name . '</a>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }

                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="shop-catalog1_wrap_left_sale">
                    <div class="shop-catalog1_wrap_left_sale_title">
                        <div class="shop-catalog1_wrap_left_sale_img">
                            <img src="/images/site_images/shop-catalog-sale1.png" alt="">
                        </div>
                        <div class="shop-catalog1_wrap_left_sale_title_title">
                            Распродажа!
                        </div>
                    </div>
                    <div class="shop-catalog1_wrap_left_sale_text1">
                        Сейфы по акции и <br>
                        специальной цене здесь!
                    </div>
                    <div class="shop-catalog1_wrap_left_sale_text2">
                        Сейфы
                    </div>
                    <div class="shop-catalog1_wrap_left_sale_text3">
                        <a href="#">Купить дешевле</a>
                    </div>
                </div>
                <div class="shop-catalog1_wrap_left_delivery">
                    <div class="shop-catalog1_wrap_left_delivery_title">
                        <div class="shop-catalog1_wrap_left_delivery_img">
                            <img src="/images/site_images/shop-catalog-delivery1.png" alt="">
                        </div>
                        <div class="shop-catalog1_wrap_left_delivery_title_title">
                            Бесплатная доставка!
                        </div>
                    </div>
                    <div class="shop-catalog1_wrap_left_delivery_text1">
                        Мы берем на себя доставку
                        товаров, которые вы закажите
                        через наш интернет-магазин,
                        если сумма будет равна или привысит
                        50 000 рублей.
                    </div>
                    <div class="shop-catalog1_wrap_left_delivery_text2">
                        от 50 000Р
                    </div>
                    <div class="shop-catalog1_wrap_left_delivery_text3">
                        <a href="#">Узнать больше</a>
                    </div>
                </div>
            </div>
            <div class="shop-catalog1_wrap_right">
                <div class="shop-catalog1_wrap_right_wrap">
                    <div class="shop-catalog1_wrap_right_wrap_bread">
                        <ul>
                            <?php
                            $bread = \app\models\Functions::getBread($cat->id);
                            if ($bread) {
                                echo '<li><a href="/">Главная страница</a></li>';
                                foreach ($bread as $key => $value) {
                                    if (($key + 1) < count($bread)) {
                                        echo '<li><a href="' . $cat->get_url($value['id']) . '">' . $value['name'] . '</a></li>';
                                    } else {
                                        echo '<li>' . $value['name'] . '</li>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="shop-catalog1_wrap_right_wrap_title1">
                        <?=$cat->name?>
                    </div>
                    <?php if ($cat->text) : ?>
                        <div class="shop-catalog1_wrap_right_wrap_text1">
                            <?=$cat->text?>
                        </div>
                    <?endif;?>

                    <div class="shop-catalog1_wrap_right_list1">

                            <?php
                            $view_table = '';
                            $view_blocks = [];
                            //проверям пришел ли гет параметр как выодить продукты
                            if (Yii::$app->request->get('view')) {
                                $view_flag = Yii::$app->request->get('view');
                            } else {
                                $view_flag = $cat->view_type;
                            }
                            if (!$view_flag) $view_flag = 'table';
                            $view_blocks[] = 'view=blocks';
                            if (Yii::$app->request->get('page')) {
                                $view_blocks[] = 'page=' . Yii::$app->request->get('page');
                            }
                            if (Yii::$app->request->get('per-page')) {
                                $view_blocks[] = 'per-page=' . Yii::$app->request->get('per-page');
                            }
                            $view_blocks = implode('&', $view_blocks);

                            $view_table[] = 'view=table';
                            if (Yii::$app->request->get('page')) {
                                $view_table[] = 'page=' . Yii::$app->request->get('page');
                            }
                            if (Yii::$app->request->get('per-page')) {
                                $view_table[] = 'per-page=' . Yii::$app->request->get('per-page');
                            }
                            $view_table = implode('&', $view_table);

                            if ($products) {
                            echo '
                            <div class="shop-catalog1_wrap_right_list1_wrap">';
                                if ($view_flag == 'blocks') {
                                    foreach ($products as $key => $value) {

                                        $current_chars = $value->product->characteristics;
                                        $tmp = [];
                                        foreach ($current_chars as $key2 => $value2) {
                                            $tmp[$value2->characterdata->parent_id][] = $value2->characterdata->name;
                                        }
                                        $res = '';
                                        //тут в цикле выводим данные продукта, а если нету то прочерк
                                        //на данный момент данные хранятся в tmp
                                        foreach ($all_chars as $key4 => $value4) {
                                            if (isset($tmp[$key4])) {
                                                $val = implode(', ', $tmp[$key4]);
                                                $res.= '<p>'.$value4->characteristics->name.'' . '<span>'.$val . '</span></p>';
                                            }
                                        }


                                        if (!$value->product) continue;
                                        $url = \app\models\Cats::get_url($value->cat_id);
                                        ?>
                                        <div class="shop-catalog1_wrap_right_list1_wrap_item">
                                            <?php if ($value->product->new) : ?>
                                                <div class="shop-catalog1_wrap_right_list1_wrap_item_hit">
                                                    <span>Новинка!</span>
                                                </div>
                                            <?php endif;?>
                                            <div class="shop-catalog1_wrap_right_list1_wrap_item_img">
                                                <img src="/images/<?=$value->product->image->url ? 'products/' . $value->product->image->url : 'site_images/no_photo.png'. '" alt="' . $value->product->name?>">
                                            </div>
                                            <div class="shop-catalog1_wrap_right_list1_wrap_item_title">
                                                <a class="tovar1__item_name" href="<?=\app\models\Products::getproducturl($value->product->id)?>"><?=$value->product->name?></a>
                                            </div>
                                            <div class="shop-catalog1_wrap_right_list1_wrap_item_hr">
                                            </div>
                                            <div class="shop-catalog1_wrap_right_list1_wrap_item_info1">
                                                <div class="shop-catalog1_wrap_right_list1_wrap_item_prices">
                                                    <div class="shop-catalog1_wrap_right_list1_wrap_item_prices_old">
                                                        <?=$value->product->price?> р.
                                                    </div>
                                                    <div class="shop-catalog1_wrap_right_list1_wrap_item_prices_actual">
                                                        <?=$value->product->price_sale?> р.
                                                    </div>
                                                </div>
                                                <div class="shop-catalog1_wrap_right_list1_wrap_item_basket">
                                                    <a href="/cart" data-id="<?=$value->product->id?>">
                                                        <img src="/images/site_images/basket2.png" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="shop-catalog1_wrap_right_list1_wrap_item_info2">
                                                Есть в наличии!
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                                echo '</div>';
                                echo '<div class="clearfix"></div>';
                                echo '<div class="pagination1">'.LinkPager::widget([
                                        'pagination' => $pages,
                                    ]).'</div>';
                            } else {
                                if (Yii::$app->request->post('characteristics')){
                                    echo '<div class="filter1__not_found"><h4>По данному фильтру продуктов не найдено</h4>
                                <p><a href="'.Yii::$app->request->url.'">Сбросить фильтр</a> </p></div>';

                                }else{
                                    echo '<h4>В данной категории продуктов нет</h4>';
                                }
                            }
                            echo '</div>';

                            ?>



                    </div>
                    <!--<div class="shop-catalog1_wrap_right_wrap_title1">
                        Взломостойкие сейфы
                    </div>
                    <div class="shop-catalog1_wrap_right_wrap_text1">
                        Текст о взломостойких сейфах СЕО оптимизированный, до 500 символов, текст о взломостойких сейфах СЕО оптимизированный, до 500
                        символов, текст о взломостойких сейфах СЕО оптимизированный, до 500 символов, текст о взломостойких сейфах СЕО оптимизированный,
                        до 500 символов, екст о взломостойких сейфах СЕО оптимизированный, до 500 символов.
                    </div>
                    <div class="shop-catalog1_wrap_right_wrap_title1">
                        Взломостойкие сейфы
                    </div>
                    <div class="shop-catalog1_wrap_right_wrap_text1">
                        Текст о взломостойких сейфах СЕО оптимизированный, до 500 символов, текст о взломостойких сейфах СЕО оптимизированный, до 500
                        символов, текст о взломостойких сейфах СЕО оптимизированный, до 500 символов, текст о взломостойких сейфах СЕО оптимизированный,
                        до 500 символов, екст о взломостойких сейфах СЕО оптимизированный, до 500 символов.
                    </div>-->
                    <div class="shop-catalog1_wrap_right_hr"></div>
                </div>

            </div>
        </div>
    </div>
</div>

