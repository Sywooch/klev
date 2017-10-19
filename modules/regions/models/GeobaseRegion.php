<?php

namespace app\modules\regions\models;

use app\models\IspObjects;
use app\modules\regions\models\GeobaseStrany;
use Yii;

/**
 * This is the model class for table "geobase_region".
 *
 * @property string $id
 * @property string $name
 * @property string $url
 */
class GeobaseRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geobase_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','popular','priority'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['url','dop_1'], 'string', 'max' => 255],
            [['id'], 'unique']
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
            'url' => 'Url',
            'dop_1' => 'Склонение',
        ];
    }

    public function getCities(){
        return $this->hasMany(GeobaseCity::className(),['region_id'=>'id'])->orderBy('CASE `popular`
                WHEN "0" THEN popular
                ELSE 1 END
            DESC,
            CASE `popular`
                WHEN "1" THEN priority
                ELSE 1 END
            DESC,
            name ASC');
    }
    public function getStrana(){
        return $this->hasOne(GeobaseStrany::className(),['id'=>'strana_id']);
    }

    public function getIspObjectsCount(){
        return $this->hasMany(IspObjects::className(),['region_id'=>'id'])->count();
    }
}
