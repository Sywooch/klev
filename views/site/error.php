<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $exception->getMessage();
$this->params['breadcrumbs'][] = $this->title;

if ($exception->statusCode == 403) {
    Url::remember();
}
?>
<div class="site-error">
    <div class="container">
        <div class="row">
            <div class="site-error__title">
                <h1>Что-то пошло не так.</h1>
            </div>
            <div class="site-error__text1 alert alert-danger">
                <?= $exception->getMessage(); ?>
            </div>
            <?php
            if ($exception->statusCode==404) : ?>
                <div class="site-error__text2">
                    Пожалуйста, вернитесь на <a href="/">Главную страницу</a>
                </div>
            <?php elseif ($exception->statusCode==403) : ?>
                <div class="site-error__text2">
                    <a href="/login">Войти</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
