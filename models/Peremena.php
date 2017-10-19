<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peremena".
 *
 * @property integer $id
 * @property string $code
 * @property string $text
 * @property string $description
 */
class Peremena extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'peremena';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'description'], 'string'],
            [['code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Идентификатор',
            'text' => 'Код',
            'description' => 'Описание',
        ];
    }
}
