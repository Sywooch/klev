<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session_views_for_objects".
 *
 * @property integer $id
 * @property string $ip
 * @property string $reg_date
 * @property integer $object_id
 */
class SessionViewsForObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session_views_for_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_date'], 'safe'],
            [['object_id'], 'integer'],
            [['ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'reg_date' => 'Reg Date',
            'object_id' => 'Object ID',
        ];
    }
}
