<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isp_homes".
 *
 * @property integer $id
 * @property integer $object_id
 * @property integer $room_count
 * @property integer $price
 * @property string $description
 * @property string $reg_date
 * @property integer $active
 */
class IspHomes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isp_homes';
    }

    /**
     * @inheritdoc
     */
    public  $room_counts;
    public  $prices;
    public  $descriptions;
    public  $people_counts;
    public  $ids;
    public $imageFiles;
    public $services;
    public $names;

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return $scenarios;
    }
    public function rules()
    {
        return [
            [['object_id', 'room_count', 'price', 'active','room_counts','prices','people_counts','people_count'], 'integer'],
            [['room_count','people_count', 'price'], 'required'],
            [['description','name','names'], 'string',],
            [['reg_date'], 'safe'],
            [['services'], 'safe'],
            [['names','room_counts','people_counts','services','prices','descriptions','ids','imageFiles'], 'each', 'rule' => ['default', 'value' => '']],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => '','maxFiles'=>100],
            [['room_counts','people_counts','prices','descriptions','names'], 'safe','on'=>'new'], //сюда можно дописать другие обязательные поля
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_id' => 'Object ID',
            'room_count' => 'Количество домов',
            'room_counts' => 'Количество домов',
            'people_count' => 'Вместимость',
            'people_counts' => 'Вместимость',
            'price' => 'Стоимость за сутки',
            'prices' => 'Стоимость за сутки',
            'description' => 'Описание',
            'descriptions' => 'Описание',
            'reg_date' => 'Дата создания',
            'active' => 'Активность',
            'imageFiles' => 'Фотографии',
            'services' => 'Удобства',
            'names' => 'Название дома',
        ];
    }
    public function getPhotos(){
        return $this->hasMany(PhotosForIspHomes::className(),['home_id'=>'id']);
    }
    public function getComfort(){
        return $this->hasMany(ComfortForIspHomes::className(),['home_id'=>'id'])->asArray()->all();
    }
    public function getComfort2(){
        return $this->hasMany(ComfortForIspHomes::className(),['home_id'=>'id']);
    }
}
