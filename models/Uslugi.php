<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uslugi".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $active
 * @property string $text
 */
class Uslugi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uslugi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'string'],
            [['sort', 'active','clicable_objects'], 'integer'],
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
            'active' => 'Активность',
            'text' => 'Содержимое',
            'sort' => 'Сортировка',
            'clicable_objects' => 'Объекты ссылками',
        ];
    }
    public function getObjects(){
        return $this->hasMany(Objects::className(),['service_id'=>'id'])->orderBy('sort DESC');
    }
}
