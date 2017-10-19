<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "custom_form1".
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property string $time
 * @property string $reg_date
 * @property integer $status
 */
class CustomForm1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'custom_form1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tel', 'time', 'status'], 'required'],
            [['reg_date'], 'safe'],
            [['status'], 'integer'],
            [['name', 'tel', 'time'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'tel' => 'Телефон',
            'time' => 'Удобное время',
            'reg_date' => 'Дата',
            'status' => 'Статус',
        ];
    }
}
