<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "obrat_settings".
 *
 * @property integer $id
 * @property string $email
 * @property string $reg_date
 * @property integer $active
 */
class ObratSettings1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'obrat_settings1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'active'], 'required'],
            [['reg_date'], 'safe'],
            [['active'], 'integer'],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'reg_date' => 'Дата',
            'active' => 'Активность',
        ];
    }
}
