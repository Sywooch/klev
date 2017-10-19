<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photos_for_objects".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $reg_date
 * @property integer $sort
 * @property integer $object_id
 */
class PhotosForObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $names;
    public $photos;
    public $ids;
    public static function tableName()
    {
        return 'photos_for_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['reg_date'], 'safe'],
            [['sort', 'object_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['photos','names','ids'], 'each', 'rule' => ['default', 'value' => '']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'reg_date' => 'Reg Date',
            'sort' => 'Sort',
            'object_id' => 'Object ID',
            'names' => 'Название',
            'photos' => 'Фотография',
        ];
    }
    public function upload($key)
    {
        if ($this->validate()){

            $filename = md5(date('d m Y H i s')).$this->photos[$key]->baseName . '.' . $this->photos[$key]->extension;
            $this->photos[$key]->saveAs('images/objects/' .$filename);
            return $filename;
        } else {
            return false;
        }
    }
}
