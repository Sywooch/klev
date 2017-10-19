<?php

$functons = new \app\models\Functions();
$bread = \app\models\Functions::getBread($product->cat->cat_id);

foreach ($bread as $key => $value) {
    $this->params['breadcrumbs'][] = ['label' => $value['name'], 'url' => [\app\models\Cats::get_url($value['id'])]];
}
$this->params['breadcrumbs'][] = $product->name;
$this->title = ($product->metatitle ? $product->metatitle : $product->name);
if ($product->metakeywords) {
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $product->metakeywords
    ]);
}
if ($product->metadescription) {
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $product->metadescription
    ]);
} ?>

<div class="view-product1">
    <div class="container">
        <div class="view-product1__wrap">
            <div class="view-product1__wrap_bread">
                <ul>
                    <li><a href="/">Главная страница</a></li>
                    <li><a href="/catalog/internet-magazin_166">Интернет магазин</a></li>
                    <li>Металлическая мебель</li>
                </ul>
            </div>
            <div class="view-product1__wrap_title">
                <span class="span1">Название товара</span>
                <span class="span2">
                    <div class="view-product1__wrap_title_reviews">
                        <a href="#">5 отзывов</a>
                    </div>
                    <div class="view-product1__wrap_title_oc">
                        <div class="view-product1__wrap_title_oc_list">
                            <div class="view-product1__wrap_title_oc_list_item">
                                <img src="/images/site_images/zv_yellow.png" alt="">
                            </div>
                            <div class="view-product1__wrap_title_oc_list_item">
                                <img src="/images/site_images/zv_yellow.png" alt="">
                            </div>
                            <div class="view-product1__wrap_title_oc_list_item">
                                <img src="/images/site_images/zv_yellow.png" alt="">
                            </div>
                            <div class="view-product1__wrap_title_oc_list_item">
                                <img src="/images/site_images/zv_yellow.png" alt="">
                            </div>
                            <div class="view-product1__wrap_title_oc_list_item">
                                <img src="/images/site_images/zv_gray.png" alt="">
                            </div>
                        </div>
                    </div>
                </span>
            </div>
            <div class="view-product1__wrap_info1">
                
            </div>
        </div>
    </div>
</div>