<?php
use kartik\tree\TreeView;
$this->title = 'Главная';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
echo TreeView::widget([
    // single query fetch to render the tree
    'query'             => \app\models\Tree::find()->addOrderBy('root, lft'),
    'headingOptions'    => ['label' => 'Дерево'],
    'isAdmin'           => true,                       // optional (toggle to enable admin mode)
    'displayValue'      => 1,                           // initial display value
    'softDelete'      => true,                        // normally not needed to change
    'cacheSettings'   => ['enableCache' => true]      // normally not needed to change
]);
?>