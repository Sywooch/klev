<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "obrat_fields".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $placeholder
 * @property integer $sort
 * @property integer $active
 * @property string $reg_date
 */
class ObratFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $types = [
        'textinput'=>'Текстовое поле',
        'textarea'=>'Абзац',
        'checkbox'=>'Чекбокс',
        'select'=>'Выпадающий список',
        'radio'=>'Радио кнопка',
    ];
    public static function tableName()
    {
        return 'obrat_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'placeholder'], 'string'],
            [['sort', 'active','obrat_item_id'], 'integer'],
            [['reg_date'], 'safe'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название поля',
            'type' => 'Тип',
            'placeholder' => 'Подсказка (только для Текстового поля и абзаца)',
            'sort' => 'Сортировка',
            'active' => 'Активность',
            'reg_date' => 'Дата создания',
        ];
    }

    public function getParent(){
        return $this->hasOne(ObratList::className(),['id'=>'obrat_item_id']);
    }
    public function getValues_for_field(){
        return $this->hasMany(ObratValuesForFields::className(),['field_id'=>'id']);
    }
}
