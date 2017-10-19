<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "licenses".
 *
 * @property integer $id
 * @property string $image
 * @property integer $active
 * @property string $reg_date
 * @property string $name
 */
class Licenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'licenses';
    }

    /**
     * @inheritdoc
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['reg_date'], 'safe'],
            [['name'], 'string'],
            [['image'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg','checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Картинка',
            'active' => 'Активность',
            'imageFile' => 'Картинка',
            'reg_date' => 'Дата создания',
            'name' => 'Название',
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $filename = md5(date('d m Y H i s').$this->imageFile->baseName) . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('images/licenses/' .$filename);
            return $filename;
        } else {
            return false;
        }
    }
}
