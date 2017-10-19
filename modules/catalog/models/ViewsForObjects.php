<?php

namespace app\modules\catalog\models;

use app\models\IspObjects;
use Yii;

/**
 * This is the model class for table "views_for_objects".
 *
 * @property integer $id
 * @property integer $object_id
 * @property string $reg_date
 * @property integer $views_count
 */
class ViewsForObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'views_for_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'views_count'], 'integer'],
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
            'views_count' => 'Views Count',
        ];
    }
    public function getObjects(){
        return $this->hasMany(IspObjects::className(),['id'=>'object_id'])->where('user_id = '.Yii::$app->user->id.'');
    }
}
