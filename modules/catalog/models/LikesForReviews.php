<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "likes_for_reviews".
 *
 * @property integer $id
 * @property integer $review_id
 * @property integer $user_id
 * @property string $reg_date
 */
class LikesForReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'likes_for_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['review_id', 'user_id'], 'integer'],
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
            'review_id' => 'Review ID',
            'user_id' => 'User ID',
            'reg_date' => 'Reg Date',
        ];
    }
}
