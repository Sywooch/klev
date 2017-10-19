<?php
use yii\widgets\Breadcrumbs;
$this->params['breadcrumbs'][] = $page->name;
$this->title = $page->name;
if ($page->meta_keywords){
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $page->meta_keywords
    ]);
}
if ($page->meta_description){
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $page->meta_description
    ]);
}
?>
<div class="static-text1">
    <div class="container">
        <?=$page->content?>
    </div>
</div>
