<?php
$this->title = $object->name;
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/objects']];
$this->params['breadcrumbs'][] = $this->title;
\app\modules\uslugi\assets\UslugiAsset::register($this);
?>
<div class="object1">
    <div class="container">
        <div class="object1__inner">
            <div class="object1__left">
                <div class="object1__left_wrap">
                    <?php if ($photos = $object->photos_for_object) : ?>
                        <div class="object1__left_wrap_list1" id="aniimated-thumbnials1" data-id="1">
                            <?php foreach ($photos as $key => $value) : ?>
                                <a href="/images/objects/<?= $value->image ?>" data-sub-html="<?= $value->name ?>">
                                    <div class="object1__left_wrap_list1_item">
                                        <div class="object1__left_wrap_list1_item_wrap">
                                            <div class="object1__left_wrap_list1_item_wrap_img"
                                                 style="background-image:url('/images/objects/preview/<?= $value->image ?>')">
                                                <div class="object1__left_wrap_list1_item_wrap_img_abs">
                                                    <img src="/images/site_images/lupa1.png" alt="Увеличить">
                                                </div>
                                            </div>
                                            <div class="object1__left_wrap_list1_item_wrap_name">
                                                <?php if (mb_strlen($value->name) < 25) : ?>
                                                    <?= $value->name ?>
                                                <?php else: ?>
                                                    <?php echo mb_substr($value->name, 0, 25) . '...' ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="object1__right">
                <div class="object1__right_wrap">
                    <div class="object1__right_wrap_content">
                        <?php if ($other_objects) : ?>
                            <div class="object1__right_wrap_content_other">
                                <div class="object1__right_wrap_content_other_title">
                                    Объекты
                                </div>
                                <div class="object1__right_wrap_content_other_list1">
                                    <ul>
                                        <?php foreach ($other_objects as $key => $value) : ?>
                                            <li>
                                                <a href="/objects/<?= \app\models\Functions::str2url($value->name) ?>_<?= $value->id ?>"><?= $value->name ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

