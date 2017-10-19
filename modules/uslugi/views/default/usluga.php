<?php
$this->title = $usluga->name;
$this->params['breadcrumbs'][] = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
$assets = \app\modules\uslugi\assets\UslugiAsset::register($this);
?>
<div class="services1">
    <div class="container">
        <div class="services1__wrap">
            <div class="services1__wrap_left">
                <div class="services1__wrap_left_wrap">
                    <div class="services1__wrap_left_wrap_content">
                        <div class="static-container1">
                            <?=$usluga->text?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services1__wrap_right">
                <div class="services1__wrap_right_wrap">
                    <div class="services1__wrap_right_wrap_content">
                        <?php if ($objects = $usluga->objects) : ?>
                            <div class="services1__wrap_right_wrap_content_title">
                                Объекты по <br>
                                данной услуге:
                            </div>
                            <div class="services1__wrap_right_wrap_content_list">
                                <ul>
                                    <?php foreach ($objects as $key=>$value) : ?>
                                        <li>
                                            <?php if ($usluga->clicable_objects) : ?>
                                                <a href="/objects/<?= \app\models\Functions::str2url($value->name) ?>_<?= $value->id ?>"><?=$value->name?></a>
                                            <?php else: ?>
                                                <span><?=$value->name?></span>
                                            <?php endif;?>

                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="services1__wrap_right_wrap_content_title2 <?=(isset($objects) && !empty($objects) ? 'margin' : '')?>">
                            Услуги
                        </div>
                        <div class="services1__wrap_right_wrap_content_list">
                            <ul>
                                <?php foreach ($other_sevices as $key=>$value) : ?>
                                    <li>
                                        <a href="/uslugi/<?=\app\models\Functions::str2url($value->name)?>_<?=$value->id?>"><?=$value->name?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
