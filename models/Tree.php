<?php
namespace app\models;

use Yii;

class Tree extends \kartik\tree\models\Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree';
    }
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['content', 'safe'];
        $rules[] = ['alias', 'safe'];
        $rules[] = ['meta_keywords', 'safe'];
        $rules[] = ['meta_description', 'safe'];
        return $rules;
    }
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['content'] = 'Содержимое страницы';
        $labels['alias'] = 'Url страницы (можно оставить пустым)';
        $labels['meta_keywords'] = 'Meta keywords';
        $labels['meta_description'] = 'Meta description';

        return $labels;
    }
}
?>
