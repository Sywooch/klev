<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ObratList */

$this->title = 'Редактирование формы ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="obrat-list-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><a class="btn btn-primary" href="/admin/obrat-fields?obrat_id=<?=$model->id?>">Конструктор полей</a></p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
