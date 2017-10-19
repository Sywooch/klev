<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model budyaga\users\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи  ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'username',
            'auth_key',
            'password_hash',
            'email:email',
            'photo',
            'sex',
            'status',
            'created_at',
            'updated_at',
            'employment',
            'last_activity',
            'city',
            'birthday',
            'first_name',
            'surname',
            'lastname',
            'tel',
            'activation_code',
        ],
    ]) ?>

</div>
