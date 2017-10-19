<?php
use kartik\date\DatePicker;
use kartik\typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;
?>

<div class="catalog1__inner_left_block1 search">
    <div class="catalog1__inner_left_block1_form">
            <div class="catalog1__inner_left_block1_form_item">
                <label>
                    <span class="catalog1__inner_left_block1_form_item_name">Место поездки:</span>
                    <div class="catalog1__inner_left_block1_form_item_mesto">
                        <?php
                        /*echo \kartik\select2\Select2::widget([
                            'name' => 'search',
                            'language' => 'ru',
                            'options' => ['placeholder' => ''],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'ajax' => [
                                    'url' => '/ajax/place-list1',
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(city) { return city.text; }'),
                                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                            ],
                        ]);*/



                        $template = '<span>{{value}}</span>';
                        echo typeahead\Typeahead::widget([
                            'name' => 'search',
                            'options' => [
                                'placeholder' => 'Поиск...',
                            ],
                            'pluginOptions' => ['highlight'=>true],
                            'dataset' => [
                                [
                                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                    'display' => 'value',
                                    'templates' => [
                                        'header' => '<h3 class="league-name">Регионы</h3>',
                                        'suggestion' => new \yii\web\JsExpression("Handlebars.compile('{$template}')")
                                    ],
                                    'remote' => [
                                        'url' => Url::to(['/ajax/places-list1']) . '?q=%QUERY',
                                        'wildcard' => '%QUERY',
                                    ],
                                    'limit'=>6
                                ],
                                [
                                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                    'display' => 'value',
                                    'templates' => [
                                        'header' => '<h3 class="league-name">Города</h3>',
                                        'suggestion' => new \yii\web\JsExpression("Handlebars.compile('{$template}')")
                                    ],
                                    'remote' => [
                                        'url' => Url::to(['/ajax/places-cities-list1']) . '?q=%QUERY',
                                        'wildcard' => '%QUERY',
                                    ],
                                ],
                            ]
                        ]);
                        ?>
                    </div>
                </label>
            </div>
            <div class="catalog1__inner_left_block1_form_item">
                <label>
                    <span class="catalog1__inner_left_block1_form_item_name">Приезжаем:</span>
                    <div class="catalog1__inner_left_block1_form_item_priezd">
                        <?php
                        echo DatePicker::widget([
                            'name' => 'priezd',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => Yii::$app->request->post('priezd') ? Yii::$app->request->post('priezd') :date('d.m.Y',strtotime('+3 DAY')),
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy'
                            ]
                        ]);
                        ?>
                        <div class="catalog1__inner_left_block1_form_item_priezd_arrow">
                            <img src="/images/site_images/arrow-down1.png" alt="">
                        </div>
                    </div>
                </label>
            </div>
            <div class="catalog1__inner_left_block1_form_item">
                <label>
                    <span class="catalog1__inner_left_block1_form_item_name">Уезжаем:</span>
                    <div class="catalog1__inner_left_block1_form_item_uezd">
                        <?php
                        echo DatePicker::widget([
                            'name' => 'uezd',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => Yii::$app->request->post('uezd') ? Yii::$app->request->post('uezd') :date('d.m.Y',strtotime('+3 DAY')),
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy'
                            ]
                        ]);
                        ?>
                    </div>
                </label>
            </div>
            <div class="catalog1__inner_left_block1_form_item">
                <label>
                    <span class="catalog1__inner_left_block1_form_item_name">Количество человек:</span>
                    <div class="catalog1__inner_left_block1_form_item_count">
                        <select name="people_count" id="">
                            <?php for($i = 1;$i<7;$i++) : ?>
                                <option <?=Yii::$app->request->post('people_count') == $i ? 'selected' : '' ?> value="<?=$i?>"><?=$i?></option>
                            <?php endfor;?>
                        </select>
                        <div class="catalog1__inner_left_block1_form_item_count_arrow">
                            <img src="/images/site_images/arrow-down1.png" alt="">
                        </div>
                    </div>
                </label>
            </div>
            <div class="catalog1__inner_left_block1_form_hidens">
                 <input type="hidden" name="order1" value="<?=Yii::$app->request->post('order1') ? Yii::$app->request->post('order1') : ''?>">
            </div>
            <div class="catalog1__inner_left_block1_form_btn">
                <button type="submit">Поиск</button>
            </div>
    </div>
</div>
