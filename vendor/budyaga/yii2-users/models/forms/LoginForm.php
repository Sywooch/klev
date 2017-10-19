<?php
namespace budyaga\users\models\forms;

use Yii;
use yii\base\Model;
use budyaga\users\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $username;
    public $password;
    public $test;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username','test'], 'string'],
            [['username'], 'filter', 'filter' => function($value){
                return str_replace(["+7 (",")"," ","-" ],'' , $value);
            }],
            [['rememberMe'], 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный логин/пароль, либо аккаунт не активирован');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('users', 'EMAIL_OR_USERNAME'),
            'password' => Yii::t('users', 'PASSWORD'),
            'rememberMe' => Yii::t('users', 'REMEMBER_ME'),
            'username' => 'Номер телефона',
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
    public function login_custom($user_id)
    {
        if (true) {
            return Yii::$app->user->login(User::findOne($user_id), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmailOrUserName($this->username);
        }

        return $this->_user;
    }

}
