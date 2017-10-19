<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comfort_for_isp_homes".
 *
 * @property integer $id
 * @property integer $comfort_id
 * @property integer $home_id
 */
class ComfortForIspHomes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comfort_for_isp_homes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comfort_id', 'home_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comfort_id' => 'Comfort ID',
            'home_id' => 'Home ID',
        ];
    }
    public function getComfort(){
        return $this->hasOne(Comfort::className(),['id'=>'comfort_id']);
    }
}
