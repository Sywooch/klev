<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property integer $id
 * @property string $text
 * @property string $reg_date
 * @property string $image
 * @property string $author
 * @property integer $active
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;
    public static function tableName()
    {
        return 'isp_objects_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author','ocenka','city','title','minuses','pluses'], 'required'],
            [['minuses','pluses','city','title'], 'string'],
            [['reg_date'], 'safe'],
            [['active','sort','ocenka','object_id'], 'integer'],
            [['image', 'author'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg','checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст отзыва',
            'reg_date' => 'Дата добавления',
            'image' => 'Картинка',
            'imageFile' => 'Картинка',
            'pluses' => 'Плюсы',
            'minuses' => 'Минусы',
            'author' => 'Ваше имя',
            'active' => 'Активность',
            'title' => 'Заголовок отзыва',
            'sort' => 'Сортировка',
            'city' => 'Ваш город',
            'ocenka' => 'Рейтинг',
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $filename = md5(date('d m Y H i s').$this->imageFile->baseName) . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('images/reviews/' .$filename);
            return $filename;
        } else {
            return false;
        }
    }
    public function getLikesCount(){
        return $this->hasMany(LikesForReviews::className(),['review_id'=>'id'])->count();
    }
    public function getUserLikesCount(){
        return $this->hasMany(LikesForReviews::className(),['review_id'=>'id'])->where('user_id = '.Yii::$app->user->id.'')->count();
    }
    public function getUserDislikesCount(){
        return $this->hasMany(DislikesForReviews::className(),['review_id'=>'id'])->where('user_id = '.Yii::$app->user->id.'')->count();
    }
}
