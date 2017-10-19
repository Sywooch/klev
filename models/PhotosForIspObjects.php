<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photos_for_isp_objects".
 *
 * @property integer $id
 * @property string $image
 * @property integer $sort
 * @property integer $main
 * @property integer $object_id
 */
class PhotosForIspObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photos_for_isp_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'main', 'object_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'sort' => 'Sort',
            'main' => 'Main',
            'object_id' => 'Object ID',
        ];
    }
}
