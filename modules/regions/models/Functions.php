<?php

namespace app\modules\regions\models;

use app\modules\arenda\models\Ads;
use Yii;
use yii\base\Model;
use app\modules\Tree\models\ModArendaTree;

/**
 * This is the model class for table "mod_arenda_regions".
 *
 * @property integer $id
 * @property string $name
 */
class Functions extends Model
{
    /**
     * @inheritdoc
     */
    // функция превода текста с кириллицы в траскрипт
    function translit($str) {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',' ','/',',','"');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'ZH', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', '', 'Y', 'E', 'E', 'Ju', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'ju', 'ya','-','-','','');
        return str_replace($rus, $lat, $str);
    }

    function check_for_view_ad_name($cat_id)
    {
        //проверяем использовать ли название объявления
        $result = ModArendaTree::findOne(['id'=>$cat_id]);
        while ($result->use_name_for_ads!=1){
            if ($result->parent_id!=0){
                $result = ModArendaTree::findOne(['id'=>$result->parent_id]);
            }else return 0;
        }
        return $result->use_name_for_ads;

    }

    function get_ad_name($cat_id)
    {
        //проверяем использовать ли название объявления
        $result = ModArendaTree::findOne(['id'=>$cat_id]);
        $check = $this->check_for_view_ad_name($result->id);
        $name=[];
        $name[] = $result->name;

        while ($result->parent_id!=0){
            $result = ModArendaTree::findOne(['id'=>$result->parent_id]);
            $name[] = $result->name;

        }
        $total_name='';
        foreach (array_reverse($name) as $key => $value) {
            if ($key<3){
                if (!$check){
                    if ($key<2){
                        continue;
                    }else{
                         $total_name.=$value.' ';
                         continue;
                    }
                }else{
                    continue;
                }
            }
            $total_name.=$value.' ';
        }
        if (empty($total_name)) $total_name = 'error_name';
        return trim($total_name);

    }

     function check_for_price_km($cat_id)
    {
        $result = ModArendaTree::findOne(['id'=>$cat_id]);
        while ($result->use_rub_km!=1){
            if ($result->parent_id!=0){
                $result = ModArendaTree::findOne(['id'=>$result->parent_id]);
            }else return 0;
        }

        return $result->use_rub_km;
    }



}
