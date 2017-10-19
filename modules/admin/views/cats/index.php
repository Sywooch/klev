<?php
use yii\widgets\Pjax;


$this->params['home'] = [
    'label' => 'Категории',
    'url' => '/admin/cats/index',
];
if (empty($bread)) {
    $this->params['breadcrumbs'][] = 'Главные категории';
    $this->title = 'Главные категории';
}
foreach ($bread as $key => $value) {
    if ($key < count($bread) - 1) {
        $this->params['breadcrumbs'][] = ['label' => $value['name'], 'url' => ['/admin/cats/index?parent_id=' . $value['id']]];
    } else {
        $this->title = 'Категория '.$value['name'];
        $this->params['breadcrumbs'][] = $value['name'];
    }
}
$session = Yii::$app->session;
echo $session->getFlash('add');

?>
<?php if ($current_cat) : ?>
    <h2>Категория «<?=$current_cat->name?>»</h2>
<?php else : ?>
    <h2>Корневые категории</h2>
<?php endif;?>
<hr>
<?php if (empty($bread)): ?>
<?php else: ?>
    <div class="admin-add-products">
        <a class="btn btn-primary" href="/admin/cats/update?cat_id=<?=$current_cat->id?>">Редактировать категорию</a>
        <?php if (!$current_cat->childs) : ?>
            <a class="btn btn-success" href="/admin/products/index?cat_id=<?=$current_cat->id?>">Список товаров категории</a>
            <a class="btn btn-success" href="/admin/products/create?cat_id=<?=$current_cat->id?>">Добавить товар в категорию</a>
            <a class="btn btn-danger" href="/admin/cats/delete?cat_id=<?=$current_cat->id?>">Удалить категорию</a>
        <?php else: ?>
            <hr>
        <?php endif;?>
    </div>
<?php endif; ?>

<div class="cats">
    <?php
    echo $cats;
    ?>
</div>
<hr>
<?php if (empty($bread)) : ?>
    <h3>Добавить категорию в главную ветку</h3>
<?php else : ?>
    <h3>Добавить категорию в ветку «<?=$bread[count($bread)-1]['name']?>»</h3>
<?php endif;?>
<?= $this->render('cats_form', [
    'model' => $model
]) ?>
