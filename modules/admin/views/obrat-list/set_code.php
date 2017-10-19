<div class="modal fade" id="myModal<?=$model->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="cms-obrat">
                    <div class="cms-obrat__head">
                        <div class="cms-obrat__head_title">
                            <?=$model->name?>
                        </div>
                    </div>
                    <div class="cms-obrat__body">
                        <div class="cms-obrat__body_wrap">
                            <div class="cms-obrat__body_wrap_form">
                                <form action="" method="post">
                                    <div class="cms-obrat__body_wrap_form_fields">
                                        <?php foreach ($model->fields as $key=>$value) :?>
                                            <div class="cms-obrat__body_wrap_form_fields_item">
                                                <label><span><?=$value->name?></span>
                                                    <?php if ($value->type == 'textinput') : ?>
                                                         <input type="text" <?=($value->placeholder ? 'placeholder="'.$value->placeholder.'"' : '')?> name="item_<?=$value->id?>">
                                                    <?php elseif ($value->type == 'textarea') :?>
                                                        <textarea <?=($value->placeholder ? 'placeholder="'.$value->placeholder.'"' : '')?> name="item_<?=$value->id?>"></textarea>
                                                    <?php elseif ($value->type == 'checkbox') :?>
                                                        <?php foreach ($value->values_for_field as $key2=>$value2) : ?>
                                                            <div class="cms-obrat__body_wrap_form_fields_item_value">
                                                                <input type="checkbox" value="item_<?=$value2->id?>">
                                                                <span><?=$value2->name?></span>
                                                            </div>
                                                        <?php endforeach;?>
                                                    <?php elseif ($value->type == 'radio') :?>
                                                        <?php foreach ($value->values_for_field as $key2=>$value2) : ?>
                                                            <div class="cms-obrat__body_wrap_form_fields_item_value">
                                                                <input type="radio" value="item_<?=$value2->id?>">
                                                                <span><?=$value2->name?></span>
                                                            </div>
                                                        <?php endforeach;?>
                                                    <?php elseif ($value->type == 'select') :?>
                                                        <select>
                                                            <?php foreach ($value->values_for_field as $key2=>$value2) : ?>
                                                                <option value="item_<?=$value2->id?>"><?=$value2->name?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    <?php endif;?>

                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="cms-obrat__body_wrap_form_error"></div>
                                    <div class="cms-obrat__body_wrap_form_success"></div>
                                    <div class="cms-obrat__body_wrap_form_btn">
                                        <input data-loading-text="Подождите..." type="submit"  href="#" value="Отправить">
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




