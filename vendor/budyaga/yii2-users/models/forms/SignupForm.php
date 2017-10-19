<?php
namespace budyaga\users\models\forms;

use budyaga\users\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $sex;
    public $photo;
    public $city;
    public $birthday;
    public $first_name;
    public $tel;
    public $activation_code1;
    public $parent_id;
    public $surname;
    public $lastname;
    public $sms_accept = true;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','first_name','city'], 'required','on'=>'new_user'], //сюда можно дописать другие обязательные поля
            ['username', 'filter', 'filter' => 'trim'],
            [['first_name'], 'required'],
            [['sms_accept'], 'required', 'requiredValue' => 1, 'message' => 'Для регистрации необхоимо согласиться с получением смс уведомлений'],
            [['first_name','surname','lastname'], 'string', 'max' => 255],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'unique', 'targetClass' => '\budyaga\users\models\User', 'message' => 'Логин уже занят'],
            ['email', 'filter', 'filter' => 'trim'],
            [['tel'], 'filter', 'filter' => function($value){
                return str_replace(["+7 (",")"," ","-" ],'' , $value);
            }],
            ['tel', 'unique', 'targetClass' => '\budyaga\users\models\User', 'message' => 'Этот номер телефона уже зарегистрирован в нашей системе'],
            ['tel', 'required'],
            ['tel', 'string', 'min' => 10, 'max' => 30],
            ['email', 'email'],
            [['city','activation_code1','parent_id'], 'integer'],
            ['parent_id', 'default', 'value' => '0'],
            ['birthday', 'string'],
            ['sms_accept', 'boolean'],
            ['email', 'unique', 'targetClass' => '\budyaga\users\models\User', 'message' => 'Этот почтовый ящик уже занят'],
            ['sex', 'in', 'range' => [User::SEX_MALE, User::SEX_FEMALE]],
            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'email',
            'sex' => 'Пол',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
            'photo' => 'Фото',
            'city' => 'Город',
            'birthday' => 'Дата рождения',
            'first_name' => 'Имя',
            'surname' => 'Фамилия',
            'lastname' => 'Отчество',
            'tel' => 'Номер телефона',
            'activation_code1' => 'Код подтверждения',
            'sms_accept' => 'Я согласен получать смс на указанный номер',

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->username = $user->tel;
            $user->status = User::STATUS_NEW;
            $user->activation_code = rand(100000,999999);
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save()) {
                $userRole = Yii::$app->authManager->getRole('user');
                Yii::$app->authManager->assign($userRole, $user->getId());
                return $user;
            }
        }

        return null;
    }

}
