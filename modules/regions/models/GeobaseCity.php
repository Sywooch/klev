<?php

namespace app\modules\regions\models;

use app\models\IspObjects;
use Yii;

/**
 * This is the model class for table "geobase_city".
 *
 * @property string $id
 * @property string $name
 * @property string $region_id
 * @property double $latitude
 * @property double $longitude
 */
class GeobaseCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geobase_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['region_id', 'strana_id','priority','popular'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name','url','dop_1'], 'string', 'max' => 50],
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
            'region_id' => 'Region ID',
            'strana_id' => 'strana ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'dop_1' => 'Склонение',
        ];
    }
    public function getRegion(){
        return $this->hasOne(GeobaseRegion::className(),['id'=>'region_id']);
    }

    public function getIspObjectsCount(){
        return $this->hasMany(IspObjects::className(),['city_id'=>'id'])->count();
    }
    public function getIspObjects(){
        return $this->hasMany(IspObjects::className(),['city_id'=>'id']);
    }
}
