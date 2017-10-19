<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photos_for_isp_homes".
 *
 * @property integer $id
 * @property string $image
 * @property string $reg_date
 * @property integer $home_id
 */
class PhotosForIspHomes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photos_for_isp_homes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_date'], 'safe'],
            [['home_id'], 'integer'],
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
            'reg_date' => 'Reg Date',
            'home_id' => 'Home ID',
        ];
    }
}
