<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "obrat_list".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property string $emails
 * @property string $description
 */
class ObratList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'obrat_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'emails', 'description'], 'string'],
            [['code'], 'safe'],
            [['sort'], 'integer'],
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
            'emails' => 'Почтовые ящики',
            'description' => 'Описание',
            'code' => 'Исходный код',
        ];
    }
    public function getFields(){
        return $this->hasMany(ObratFields::className(),['obrat_item_id'=>'id']);
    }


}
