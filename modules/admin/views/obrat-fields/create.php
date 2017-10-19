<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ObratFields */

$this->title = 'Добавить поле';
$this->params['breadcrumbs'][] = ['label' => 'Поля формы обратной связи', 'url' => ['/admin/obrat-fields/index?obrat_id='.Yii::$app->request->get('obrat_id').'']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obrat-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
