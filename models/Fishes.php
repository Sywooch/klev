<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fishes".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property string $reg_date
 * @property string $img
 */
class Fishes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fishes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['sort'], 'integer'],
            [['reg_date'], 'safe'],
            [['img'], 'string', 'max' => 255],
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
            'sort' => 'Сортировка',
            'reg_date' => 'Дата создания',
            'img' => 'Img',
        ];
    }
}
