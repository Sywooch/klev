<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "obrat_values_for_fields".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $field_id
 */
class ObratValuesForFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'obrat_values_for_fields';
    }

    /**
     * @inheritdoc
     */
    public $names;
    public function rules()
    {
        return [
            [['sort', 'field_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['names', 'each', 'rule' => ['default', 'value' => date('Y-m-d')]]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Значение',
            'sort' => 'Sort',
            'field_id' => 'Field ID',
            'names' => 'Значение',
        ];
    }
}
