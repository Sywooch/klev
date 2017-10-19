<?php

/* @var $this yii\web\View */
$functions = new \app\models\Functions();
$this->title = ($cat->metatitle ? $cat->metatitle : $cat->name);
if ($cat->metakeywords) {
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $cat->metakeywords
    ]);
}
if ($cat->metadescription) {
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $cat->metadescription
    ]);
}
$bread = $functions->getBread($cat->id);
if (count($bread) > 1) {
    foreach ($bread as $key => $value) {
        if (count($bread) - 1 == $key) continue;
        $this->params['breadcrumbs'][] = ['label' => $value['name'], 'url' => [\app\models\Cats::get_url($value['id'])]];
    }
}
$this->params['breadcrumbs'][] = $cat->name;

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

                            echo '<li class="' . ($cat->id == $value->id ? 'active' : '') . '">
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
                        <?= $cat->name ?>
                    </div>
                    <?php if ($cat->text) : ?>
                        <div class="shop-catalog1_wrap_right_wrap_text1">
                            <?=$cat->text?>
                        </div>
                    <?php endif;?>
                    <div class="catalog1__wrap_list1 catalog1__wrap_list1_vn">
                        <div class="catalog1__wrap_list1_wrap">
                            <?php foreach ($cats as $key => $value) : ?>
                                <?php $url = \app\models\Cats::get_url($value->id); ?>
                                <?php if ($key%4 == 0 && $key>0) :?>
                                    <div class="catalog1__wrap_list1_wrap_hr catalog1__wrap_list1_wrap_hr_vn"></div>
                                <?php endif;?>
                                <div class="catalog1__wrap_list1_wrap_item catalog1__wrap_list1_wrap_item_vn">
                                    <a href="<?=$url?>">
                                        <div class="catalog1__wrap_list1_wrap_item_wrap">
                                            <div class="catalog1__wrap_list1_wrap_item_title">
                                                <?=$value->name?>
                                            </div>
                                            <div class="catalog1__wrap_list1_wrap_item_img">
                                               <?=(($value->image && file_exists('images/cats/' . $value->image . '')) ? '<img src="/images/cats/' . $value->image . '"  class="img-responsive" alt="' . $value->name . '">' : '<img src="/images/site_images/no_photo.png"  class="img-responsive" alt="' . $value->name . '">')?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach;?>

                        </div>
                    </div>

                    <div class="shop-catalog1_wrap_right_hr"></div>
                </div>

            </div>
        </div>
    </div>
</div>


