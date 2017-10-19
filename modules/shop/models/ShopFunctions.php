<?php


namespace app\modules\shop\models;


use app\modules\lc\models\UserBuyHistory;
use budyaga\users\models\User;
use Yii;
use app\models\HelpCounter;
use yii\base\Model;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use app\models\CseDelivery;
use yii\helpers\Html;
use app\models\CharacteristicsData;


/**
 * LoginForm is the model behind the login form.
 */
class ShopFunctions extends Model
{
    public static function getcharacteristicsfilter($chars, $config = [])
    {
        if (isset($config['current_vals'])) {
            foreach ($config['current_vals'] as $key => $value) {
                $mas[$key] = $value;
            }
        }
        $tmp = '';
        foreach ($chars as $key => $value) {
            //если не показывать в фильтре то делаем след итерацию
            if ($value->characteristics->view_filter==0) continue;
            $f = 0;
            $type = $value->characteristics->type;
            $charact_name = $value->characteristics->name;
            if ($type == 0) {
                $test_str = CharacteristicsData::find()
                    ->where('parent_id=' . $value->characteristics->id . ' AND name<>"textinput"')
                    ->all();
                //теперь проверяем все ли значения это цифры что б понять испольовать его в фильтре или нет
                foreach ($test_str as $key9 => $value9) {
                    if (!intval($value9->name)) {
                        $f = 1;
                        break;
                    }
                }
                if ($f == 1) {
                    continue;
                }
                $min_val = '';
                $max_val = '';
                //получаем максимальное значение

                if (isset($config['current_vals'])) {
                    $tmpp = explode(',', $config['current_vals'][$value->characteristics->id]);
                    $min_val = $tmpp[0];
                    $max_val = $tmpp[1];
                }else{

                }
                $tmp .= '
                <div class="filter_item textinput">
                     <label class="main_label mh2">' . $charact_name . '</label>
                     <span class="minn">'.$min_val.'</span> <input  name="characteristics[' . $value->characteristics->id . ']" type="text" class="span2 ex2" value="" data-slider-min="0" data-slider-max="'.($value->characteristics->max_val ? $value->characteristics->max_val : 10000).'" data-slider-step="1" data-slider-value="[' . ($min_val ? $min_val : 0) . ',' . ($max_val ? $max_val : 10000) . ']"/><span class="maxx">'.$max_val.'</span>
                </div>';
                $tmp .= '<div class="clearfix"></div>';

            } elseif ($type == 1) {
                $tmp .= '
                <div class="filter_item radioinput">
                <label class="main_label mh2">' . $charact_name . '</label>
                <div class=" btn-group " data-toggle="buttons">';

                foreach ($value->characteristics->characteristicsData as $key2 => $value2) {
                    $checked = '';
                    $active = '';
                    if (isset($mas[$value->characteristics->id]) && $value2->id == $mas[$value->characteristics->id]) {
                        $checked = ' checked ';
                        $active = ' active ';
                    }
                    $tmp .= '<label class="btn btn-primary ' . $active . '"><input ' . $checked . ' type="radio" name="characteristics[' . $value->characteristics->id . ']" value="' . $value2['id'] . '"/>' . $value2->name . '</label>';
                }
                $tmp .= '</div>';
                $tmp .= '</div>';
                $tmp .= '<div class="clearfix"></div>';

            } elseif ($type == 2) {
                $tmp .= '
                <div class="filter_item checkboxx">
                <label class="main_label mh2">' . $charact_name . '</label>
                <div class=" btn-group " data-toggle="buttons">';
                foreach ($value->characteristics->characteristicsData as $key2 => $value2) {
                    $checked = '';
                    $active = '';


                    if (isset($mas[$value->characteristics->id]) && in_array($value2['id'], $mas[$value->characteristics->id])) {
                        $checked = ' checked ';
                        $active = ' active ';

                    }
                    $tmp .= '<label class="btn btn-primary ' . $active . '"><input ' . $checked . ' type="checkbox" name="characteristics[' . $value->characteristics->id . '][]" value="' . $value2['id'] . '"/>' . $value2->name . '</label>';
                }
                $tmp .= '</div>';
                $tmp .= '</div>';
                $tmp .= '<div class="clearfix"></div>';

            } elseif ($type == 3) {
                $tmp .= '
                <div class="filter_item select">
                <label class="main_label mh2">' . $charact_name . '</label>';
                $tmp .= '<select class="form-control" name="characteristics[' . $value->characteristics->id . ']">';
                $tmp .= '<option selected disabled>Выберите</option>';
                foreach ($value->characteristics->characteristicsData as $key2 => $value2) {
                    $checked = '';
                    if (isset($mas[$value->characteristics->id]) && $value2['id'] == $mas[$value->characteristics->id]) {
                        $checked = ' selected ';
                    }
                    $tmp .= '<option ' . $checked . ' value="' . $value2['id'] . '">' . $value2->name . '</option>';
                }
                $tmp .= '</select></div>';
                $tmp .= '<div class="clearfix"></div>';

            }

        }
        $tmp = '
        <form action="" method="POST">
          <input type="hidden" name="_csrf" value="123123123">

            ' . $tmp . '
            <p><button class="btn btn-default filter__submit" type="submit">Отфильтровать</button></p>
        </form>
        ';
        return $tmp;

    }
}