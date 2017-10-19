<?php

namespace app\modules\regions\models;

use app\modules\regions\models\GeobaseRegion;
use Yii;

/**
 * This is the model class for table "geobase_strany".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $active
 */
class GeobaseStrany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geobase_strany';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'required'],
            [['sort', 'active'], 'integer'],
            [['name','url','dop_1'], 'string', 'max' => 25],
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
            'sort' => 'Sort',
            'active' => 'Active',
        ];
    }

    public function getRegions(){
        return $this->hasMany(GeobaseRegion::className(),['strana_id'=>'id'])->orderBy('
            CASE `popular`
                WHEN "0" THEN popular
                ELSE 1 END
            DESC,
            CASE `popular`
                WHEN "1" THEN priority
                ELSE 1 END
            DESC,
            name ASC')->with('cities');
    }
}
