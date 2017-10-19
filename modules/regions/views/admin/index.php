<?php
use app\modules\regions\assets\RegionsAsset;
use kartik\typeahead\Typeahead;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

$this->title = 'Административная панель | Регионы и города';

$this->params['breadcrumbs'][] = 'Регионы и города';
RegionsAsset::register($this);
?>
<style>
    .priority_input {
        width: 60%;
    }
</style>
<div class="row">
    <?php
    $session = Yii::$app->session;
    echo $session->getFlash('add');
    if (!empty(Yii::$app->session->get('region_id'))) {
        $reg_id = Yii::$app->session->get('region_id');
        $city_name = Yii::$app->session->get('city_name');
        echo '
        <div class="alert alert-success">Добавлен новый город: ' . $city_name . '</div>
        ';
    } else {
        $reg_id = 0;
    }
    ?>
    <div class="panel-group col-md-12" id="accordion">
        <?php
        $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => '{label}{input}',
            ],
        ]);
        ?>
        <?php
        // Defines a custom template with a <code>Handlebars</code> compiler for rendering suggestions
        echo '<label class="control-label">Поиск по городам</label>';
        $template = '<a href="/regions/admin/editcity?city_id={{id}}">{{value}} ({{region}})</a>';
        echo Typeahead::widget([
            'name' => 'twitter_oss',
            'options' => [
                'placeholder' => 'Введите город...',
            ],
            'dataset' => [
                [
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                    'display' => 'value',
                    'templates' => [
                        'notFound' => '<div class="text-danger" style="padding:8px;">Город не найден!</div>',
                        'suggestion' => new JsExpression("Handlebars.compile('{$template}')")
                    ],
                    'remote' => [
                        'url' => Url::to(['admin/adminregionslist']) . '?q=%QUERY',
                        'wildcard' => '%QUERY'
                    ]
                ]
            ]
        ]);
        echo '<hr>';
        ?>
        <div class="geobase_list">
            <?php
            $span = '<a href="#" class="custom_tree_glyph"><span class="glyphicon glyphicon-chevron-down"></span></a>';
            $html = '<ul class="custom_tree_ul custom_ul_show">';
            foreach ($strany_list as $key => $value) {
                $html .= '<li>' . $span . $value->name.Html::a(' <span class="glyphicon glyphicon-plus"></span>', ['/regions/admin/create_region', 'strana_id' => $value['id']],['title'=>'Добавить регион в эту страну'])
                .'<a href="' .Url::to(['/regions/admin/editstrana', 'strana_id' => $value['id']]).'"><span  title="Редактирвоать"  class="glyphicon glyphicon-pencil"></span></a>'
                .Html::checkbox('delete_strana[' . $value['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;']);

                $html .= '<ul class="custom_tree_ul ">';
                foreach ($value->regions as $key2 => $value2) {
                    $html .= '<li data-id="'.$value2->id.'">' . $span . $value2->name . ''.Html::a(' <span class="glyphicon glyphicon-plus"></span>', ['/regions/admin/create_city', 'id' => $value2['id']],['title'=>'Добавить город в этот регион']).' <a href="' . Url::to(['/regions/admin/editregion', 'region_id' => $value2['id']]) . '"><span  title="Редактирвоать"  class="glyphicon glyphicon-pencil"></span></a>
                            ' . Html::checkbox('delete_region[' . $value2['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;']) . '
                           ';

                    $html .= '<ul class="custom_tree_ul custom_ul_hide">';
                    $html .= '<div class="content"></div>';
                    /*foreach ($value2->cities as $key3 => $value3) {
                        $html .= '<li>' . $value3->name . '<a style="margin-left:5px;" href="' . Url::to(['/regions/admin/editcity', 'city_id' => $value3['id']]) . '"><span title="Редактировать" class="glyphicon glyphicon-pencil"></span></a>' . Html::checkbox('delete_city[' . $value3['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;']) . '
                                        ' . Html::checkbox('popular_city[' . $value3['id'] . ']', ($value3['popular'] == 1 ? true : false), ['label' => 'Вывести в популярные города', 'style' => 'margin-left:5px;']) . '
                                        <label><input type="text" class="form-control priority_city_input"  name="priority_city[' . $value3['id'] . ']" value="' . $value3['priority'] . '"></label></li>';
                    }*/
                    //$html .= $form->field($model, 'region_id')->hiddenInput(['value' => $value2['id']])->label(false, ['style' => 'display:none, margin:0']);
                    $html .= Html::a('Добавить город', ['/regions/admin/create_city', 'id' => $value2['id']]);
                    $html .= '</ul>';
                    $html .= '</li>';
                }
                $html .= Html::a('Добавить регион', ['/regions/admin/create_region', 'strana_id' => $value['id']]);
                $html .= '</ul>';
                $html .= '</li>';
            }
            $html .= '</ul>';
            echo $html;
            ?>
            <div class="geobase-btn">
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) ?>
                </div>
            </div>

        </div>
        <?php ActiveForm::end();
        ?>
    </div>
</div>

