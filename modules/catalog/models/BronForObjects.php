<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "bron_for_objects".
 *
 * @property integer $id
 * @property integer $object_id
 * @property string $object_name
 * @property integer $people_count
 * @property string $home_name
 * @property integer $home_count
 * @property string $priezd
 * @property string $uezd
 * @property string $client_name
 * @property string $client_tel
 * @property string $reg_date
 * @property integer $executor_id
 */
class BronForObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bron_for_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'people_count', 'home_count', 'executor_id','status'], 'integer'],
            [['object_name'], 'string'],
            [['priezd', 'uezd', 'reg_date'], 'safe'],
            [['home_name', 'client_name', 'client_tel'], 'string', 'max' => 255],
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
            'object_name' => 'Object Name',
            'people_count' => 'People Count',
            'home_name' => 'Home Name',
            'home_count' => 'Home Count',
            'priezd' => 'Priezd',
            'uezd' => 'Uezd',
            'client_name' => 'Client Name',
            'client_tel' => 'Client Tel',
            'reg_date' => 'Reg Date',
            'executor_id' => 'Executor ID',
            'status' => 'Статус',
        ];
    }
}
