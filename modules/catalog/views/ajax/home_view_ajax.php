<?php
$script = <<< JS
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>
<div class="home-view-ajax">
    <div class="home-view-ajax__inner">
        <div class="home-view-ajax__inner_title">
            <?=$home->name?>
        </div>
        <div class="home-view-ajax__inner_left">
            <?php if ($home->photos) : ?>
                <div class="home-slider single-item">
                    <?php foreach ($home->photos as $key=>$value) : ?>
                        <div>
                            <div class="home-slider__img" style="background-image:url('/images/home_photos/<?=$value->image?>') ">
                             </div>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php endif;?>
        </div>
        <div class="home-view-ajax__inner_right">
            <div class="home-view-ajax__inner_right_vmestim">
                <span>Вместимость:</span> <?=$home->room_count?> человек(а)
            </div>
            <?php if ($home->comfort2) : ?>
                <div class="home-view-ajax__inner_right_udobstva">
                    <span>Удобства:</span>

                    <div class="home-view-ajax__inner_right_udobstva_list1">
                        <?php foreach ($home->comfort2 as $key=>$value) : ?>
                            <?=$value->comfort->name?>,
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endif;?>

            <div class="home-view-ajax__inner_right_description">
                <span>Описание:</span><?=$home->description?>
            </div>
        </div>
    </div>
</div>