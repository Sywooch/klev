<!--<p><a href="#" data-toggle="modal" data-target="#myModal6" class="btn btn-default btn1">Узнать цену</a></p>-->
<?php
use kartik\date\DatePicker;
?>

<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="custom-modal6">
                    <div class="custom-modal6__close">
                        <a href="#" data-dismiss="modal" aria-hidden="true">
                            <img src="/images/site_images/cancel1.png" alt="">
                        </a>
                    </div>

                    <div class="custom-modal6__body">
                        <div class="custom-modal6__body_wrap">
                            <div class="custom-modal6__body_wrap_title">Вы почти у цели!</div>
                            <div class="custom-modal6__body_wrap_form">
                                <form action="" method="post">
                                    <div class="custom-modal6__body_wrap_form_hiddens">
                                        <input type="hidden" name="object_id" value="<?=$object->id?>">
                                        <input type="hidden" name="object_name" value="<?=$object->name?>">
                                        <input type="hidden" name="people_count">
                                        <input type="hidden" name="home_name">
                                        <input type="hidden" name="home_count">
                                    </div>
                                    <div class="custom-modal6__body_wrap_form_item">
                                        <div class="custom-modal6__body_wrap_form_item_label">
                                            Название
                                        </div>
                                        <div class="custom-modal6__body_wrap_form_item_value">
                                            <?=$object->name?>
                                        </div>
                                    </div>
                                    <div class="custom-modal6__body_wrap_form_item">
                                        <div class="custom-modal6__body_wrap_form_item_label">
                                            Местонахождение
                                        </div>
                                        <div class="custom-modal6__body_wrap_form_item_value">
                                            <?=$object->city->name.', '.$object->region->name.''?>
                                        </div>
                                    </div>
                                    <div class="custom-modal6__body_wrap_form_item people_count">
                                        <div class="custom-modal6__body_wrap_form_item_label">
                                            Количество человек
                                        </div>
                                        <div class="custom-modal6__body_wrap_form_item_value">
                                            5
                                        </div>
                                    </div>
                                    <div class="custom-modal6__body_wrap_form_item razm">
                                        <div class="custom-modal6__body_wrap_form_item_label">
                                            Тип размещения
                                        </div>
                                        <div class="custom-modal6__body_wrap_form_item_value">
                                            Дом
                                        </div>
                                    </div>


                                    <div class="custom-modal6__body_wrap_form_date">
                                        <label>
                                            <span class="custom-modal6__body_wrap_form_date_name">Приезжаем:</span>
                                            <div class="custom-modal6__body_wrap_form_date_priezd">
                                                <?php
                                                echo \kartik\date\DatePicker::widget([
                                                    'name' => 'priezd',
                                                    'type' => DatePicker::TYPE_INPUT,
                                                    'value' => Yii::$app->request->post('priezd') ? Yii::$app->request->post('priezd') :date('d.m.Y',strtotime('+3 DAY')),
                                                    'pluginOptions' => [
                                                        'autoclose'=>true,
                                                        'format' => 'dd.mm.yyyy'
                                                    ]
                                                ]);
                                                ?>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="custom-modal6__body_wrap_form_date">
                                        <label>
                                            <span class="custom-modal6__body_wrap_form_date_name">Уезжаем:</span>
                                            <div class="custom-modal6__body_wrap_form_date_uezd">
                                                <?php
                                                echo DatePicker::widget([
                                                    'name' => 'uezd',
                                                    'type' => DatePicker::TYPE_INPUT,
                                                    'value' => Yii::$app->request->post('uezd') ? Yii::$app->request->post('uezd') :date('d.m.Y',strtotime('+4 DAY')),
                                                    'pluginOptions' => [
                                                        'autoclose'=>true,
                                                        'format' => 'dd.mm.yyyy'
                                                    ]
                                                ]);
                                                ?>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="custom-modal6__body_wrap_form_item ">
                                        <div class="custom-modal6__body_wrap_form_item_label">
                                            Пожалуйста, представьтесь
                                        </div>
                                        <div class="custom-modal6__body_wrap_form_item_value">
                                            <input class="form-control" type="text" name="client_name" id="" placeholder="Пожалуйста, представьтесь">
                                        </div>
                                    </div>
                                    <div class="custom-modal6__body_wrap_form_item ">
                                        <div class="custom-modal6__body_wrap_form_item_label">
                                            Ваш номер телефона
                                        </div>
                                        <div class="custom-modal6__body_wrap_form_item_value">
                                            <input class="form-control" type="text" name="client_tel" id="" placeholder="Ваш номер телефона">
                                        </div>
                                    </div>
                                    <div class="modal6_error"></div>
                                    <div class="modal6_success"></div>
                                    <div class="custom-modal6__body_wrap_form_btn">
                                        <button data-loading-text="Подождите..." type="submit">Забронировать!</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="custom-modal7">
                    <div class="custom-modal7__close">
                        <a href="#" data-dismiss="modal" aria-hidden="true">
                            <img src="/images/site_images/cancel1.png" alt="">
                        </a>
                    </div>

                    <div class="custom-modal7__body">
                        <div class="custom-modal7__body_wrap">
                            <div class="custom-modal7__body_wrap_loader">
                                <img src="<?= $imagePath ?>/images/Spinner.svg" alt="">
                            </div>
                            <div class="custom-modal7__body_wrap_content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>