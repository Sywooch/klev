<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comfort".
 *
 * @property integer $id
 * @property string $name
 * @property string $reg_date
 * @property integer $active
 * @property integer $sort
 */
class Comfort extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comfort';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_date'], 'safe'],
            [['active', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'reg_date' => 'Дата создания',
            'active' => 'Активность',
            'sort' => 'Сортировка',
        ];
    }


}
