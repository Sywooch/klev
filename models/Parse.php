<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parse".
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property string $email
 */
class Parse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tel', 'email'], 'string'],
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
            'tel' => 'Tel',
            'email' => 'Email',
        ];
    }
}
