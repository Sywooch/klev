<?php

namespace app\models;

use app\modules\catalog\models\BronForObjects;
use app\modules\catalog\models\LikesForObjects;
use app\modules\catalog\models\Reviews;
use app\modules\regions\models\GeobaseCity;
use app\modules\regions\models\GeobaseRegion;
use Yii;

/**
 * This is the model class for table "isp_objects".
 *
 * @property integer $id
 * @property string $name
 * @property string $description1
 * @property string $reg_date
 * @property integer $active
 * @property integer $sort
 * @property integer $user_id
 * @property integer $price1
 * @property string $geo
 */
class IspObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isp_objects';
    }

    /**
     * @inheritdoc
     */
    public $imageFiles;
    public $tmp_city;
    public $fishes;
    public function rules()
    {
        return [
            [['name','price1','description1','tmp_city'], 'required'],
            [['description1'], 'string'],
            [['reg_date','fishes'], 'safe'],
            [['active', 'sort', 'user_id', 'price1','city_id','region_id','lodki','pitanie','snasti','max_ulov','views'], 'integer'],
            [['name', 'geo'], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            ['tmp_city', function ($attribute, $params) {
                if (!$model = GeobaseCity::findOne(['name'=>trim($this->$attribute)])) {
                    $this->addError($attribute, 'Пожалуйста, выберите населенный пункт из списка');
                }
            }],
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
            'lodki' => 'Предоставление лодок',
            'pitanie' => 'Питание и напитки',
            'snasti' => 'Предоставление снастей',
            'description1' => 'Описание',
            'reg_date' => 'Дата создания',
            'active' => 'Активность',
            'sort' => 'Сортировка',
            'user_id' => 'User ID',
            'price1' => 'Стоимость',
            'geo' => 'Местоположение',
            'imageFiles' => 'Фотографии объекта',
            'tmp_city' => 'Город',
            'fishes' => 'Рыбы',
            'max_ulov' => 'Максимальный улов (кг)',
        ];
    }
    public function upload()
    {
        $filenames = [];
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $filename = md5(date('d m Y H i s').$file->baseName) . '.' . $file->extension;
                $file->saveAs('images/isp_objects/' .$filename);
                $filenames[] = $filename;
            }
            return $filenames;
        } else {
            return false;
        }
    }
    public function getPhotos(){
        return $this->hasMany(PhotosForIspObjects::className(),['object_id'=>'id']);
    }
    public function getPhoto(){
        return $this->hasOne(PhotosForIspObjects::className(),['object_id'=>'id'])->orderBy('id DESC');
    }
    public function getHomes(){
        return $this->hasMany(IspHomes::className(),['object_id'=>'id'])->orderBy('isp_homes.id ASC');
    }
    public function getFishes_list(){
        return $this->hasMany(FishesForObject::className(),['object_id'=>'id'])->innerJoinWith('fish')->orderBy('fishes.name ASC');
    }
    public function getCity(){
        return $this->hasOne(GeobaseCity::className(),['id'=>'city_id']);
    }
    public function getRegion(){
        return $this->hasOne(GeobaseRegion::className(),['id'=>'region_id']);
    }
    public function getReviews(){
        return $this->hasMany(Reviews::className(),['object_id'=>'id'])->where('isp_objects_reviews.active = 1')->orderBy('isp_objects_reviews.id DESC');
    }
    public function getLikes(){
        return $this->hasOne(LikesForObjects::className(),['object_id'=>'id']);
    }
    public function getCurrentViewsCount(){
        return $this->hasMany(SessionViewsForObjects::className(),['object_id'=>'id'])->count();
    }
    public function getCurrentViewsCountToday(){
        return $this->hasMany(SessionViewsForObjects::className(),['object_id'=>'id'])->where('DATE_FORMAT(reg_date,"%Y-%m-%d") = DATE_FORMAT(NOW(),"%Y-%m-%d")')->count();
    }
    public function getBronPastDontAcceptedCount(){
        return $this->hasMany(BronForObjects::className(),['object_id'=>'id'])->where('priezd >= DATE_FORMAT(NOW(),"%Y-%m-%d") AND status = 0')->count();
    }
    public function getBronTodayCount(){
        return $this->hasMany(BronForObjects::className(),['object_id'=>'id'])->where('DATE_FORMAT(reg_date,"%Y-%m-%d") = DATE_FORMAT(NOW(),"%Y-%m-%d")')->count();
    }
}
