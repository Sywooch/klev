<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property string $image
 * @property string $reg_date
 * @property integer $active
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['reg_date','text'], 'safe'],
            [['active','sort'], 'integer'],
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
            'imageFile' => 'Картинка',
            'reg_date' => 'Дата создания',
            'active' => 'Активность',
            'text' => 'Текст',
            'sort' => 'Сортировка',
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $filename = md5(date('d m Y H i s').$this->imageFile->baseName) . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('images/partners/' .$filename);
            return $filename;
        } else {
            return false;
        }
    }
}
