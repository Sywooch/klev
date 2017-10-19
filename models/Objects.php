<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objects".
 *
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property integer $sort
 * @property integer $service_id
 * @property string $reg_date
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['active', 'sort', 'service_id'], 'integer'],
            [['reg_date'], 'safe'],
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
            'sort' => 'Сортировка',
            'service_id' => 'Услуга',
            'reg_date' => 'Дата ооздания',
            'serviceName' => 'Услуга',
        ];
    }

    public function getService(){
        return $this->hasOne(Uslugi::className(),['id'=>'service_id']);
    }
    public function getServiceName(){
        return $this->service->name;
    }
    public function getPhotos_for_object(){
        return $this->hasMany(PhotosForObjects::className(),['object_id'=>'id']);
    }
}
