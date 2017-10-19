<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CustomForm1 */

$this->title = 'Create Custom Form1';
$this->params['breadcrumbs'][] = ['label' => 'Custom Form1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-form1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
