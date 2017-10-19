<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fishes_for_object".
 *
 * @property integer $id
 * @property integer $fish_id
 * @property integer $object_id
 */
class FishesForObject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fishes_for_object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fish_id', 'object_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fish_id' => 'Fish ID',
            'object_id' => 'Object ID',
        ];
    }

    public function getFish(){
        return $this->hasOne(Fishes::className(),['id'=>'fish_id']);
    }
}
