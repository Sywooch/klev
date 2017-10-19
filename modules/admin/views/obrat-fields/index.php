<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ObratFieldsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поля для обратной связи';
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['/admin/obrat-list']];
$this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['/admin/obrat-list/update?id='.$parent->id.'']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obrat-fields-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить поле', ['create?obrat_id='.Yii::$app->request->get('obrat_id').''], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            [
                'attribute'=>'type',
                'format'=>'raw',
                'value'=>function($data){
                    return $data->types[$data['type']];
                }
            ],
            'placeholder:ntext',
            [
                'attribute'=>'active',
                'format'=>'raw',
                'value'=>function($data){
                    return $data->active ? 'Активно' : 'Не активно';
                }
            ],
            // 'reg_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
