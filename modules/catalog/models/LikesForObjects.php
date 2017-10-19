<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "likes_for_objects".
 *
 * @property integer $id
 * @property integer $object_id
 * @property string $reg_date
 */
class LikesForObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'likes_for_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id','likes'], 'integer'],
            [['reg_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_id' => 'Object ID',
            'reg_date' => 'Reg Date',
        ];
    }
}
