<?php

namespace budyaga\users\controllers;

use app\models\PhotosForUser;
use budyaga\users\models\forms\ChangeEmailForm;
use budyaga\users\models\forms\ChangePasswordForm;
use budyaga\users\models\forms\RetryConfirmEmailForm;
use budyaga\users\models\User;
use budyaga\users\models\UserEmailConfirmToken;
use budyaga\users\models\forms\LoginForm;
use budyaga\users\models\forms\PasswordResetRequestForm;
use budyaga\users\models\forms\ResetPasswordForm;
use budyaga\users\models\forms\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;

class UserController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'uploadphoto' => [
                'class' => 'budyaga\cropper\actions\UploadAction',
                'url' => Yii::$app->controller->module->userPhotoUrl,
                'path' => Yii::$app->controller->module->userPhotoPath,
            ]
        ];
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login','profile'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => [],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['profile'],
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }
    public $layout = '@app/views/layouts/main_static';
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(Url::previous());
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render($this->module->getCustomView('login'), [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        $url = Url::previous();
        Yii::$app->user->logout();


        return $this->redirect($url);
    }

    public function actionSignup()
    {
       if (!Yii::$app->user->isGuest){
           return $this->redirect('/lc');
       }
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && !($model->activation_code1)) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($user = $model->signup()) {
                if (true/*$user->createEmailConfirmToken() *//*&& $user->sendEmailConfirmationMail(Yii::$app->controller->module->getCustomMailView('confirmNewEmail'), 'new_email')*/) {
                    \Yii::$app->sms->sms_send( '7'.$user->username, 'Код подтверждения: '.$user->activation_code);
                    Yii::$app->getSession()->setFlash('success', '<div class="alert alert-danger">На ваш телефон было отправлено смс с кодом подтверждения, введите полученный код в поле ниже.</div>');
                    $transaction->commit();

                    return $this->render($this->module->getCustomView('signup'), [
                        'model' => $model,
                        'user'=> $user
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', Yii::t('users', 'CAN_NOT_SEND_EMAIL_FOR_CONFIRMATION'));
                    $transaction->rollBack();
                };
            }
            else {
                Yii::$app->getSession()->setFlash('error', Yii::t('users', 'CAN_NOT_CREATE_NEW_USER'));
                $transaction->rollBack();
            }
        }elseif ($model->load(Yii::$app->request->post()) && ($model->activation_code1)){
            if ($user_id = Yii::$app->request->post('User')['id']){
                $user = User::findOne($user_id);
                if ($user){
                    if ($user->activation_code == $model->activation_code1){
                        $user->status = User::STATUS_ACTIVE;
                        $user->save();
                        $login = new LoginForm();
                        $login->login_custom($user->id);
                        return $this->redirect('/lc');
                        Yii::$app->getSession()->setFlash('success', '<div class="alert alert-success">Регистрация прошла успешно, Вы можете авторизоваться.</div>');
                        return $this->redirect('/login');
                    }else{
                        $model->addError('activation_code1','Неверный код подтверждения. попроюбуйте снова.');
                        return $this->render($this->module->getCustomView('signup'), [
                            'model' => $model,
                            'user'=> $user
                        ]);
                    }
                }
            }
        }
        if (Yii::$app->request->get('referer_id')){
            $model->parent_id = Yii::$app->request->get('referer_id');
        }else{
            $cookies = Yii::$app->request->cookies;
            if (($cookie = $cookies->get('referer_id')) !== null) {
                $referer_id = $cookie->value;
                $model->parent_id = $referer_id;
            }

        }


        return $this->render($this->module->getCustomView('signup'), [
            'model' => $model,
        ]);
    }

    public function actionRetryConfirmEmail()
    {
        $model = new RetryConfirmEmailForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->user->sendEmailConfirmationMail(Yii::$app->module->getCustomMailView('confirmNewEmail'), 'new_email')) {
                Yii::$app->getSession()->setFlash('success', Yii::t('users', 'CHECK_YOUR_EMAIL_FOR_FURTHER_INSTRUCTION'));
                return $this->redirect(Url::toRoute('/user/user/retry-confirm-email'));
            }
        }

        return $this->render($this->module->getCustomView('retryConfirmEmail'), [
            'model' => $model
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $user = User::findOne(['username' => $model->tel]);
            if ($user && $user->status!= 3){
                $new_pass = rand(100000,999999);
                $user->status = $user::STATUS_ACTIVE;
                $user->setPassword($new_pass);
                $user->generateAuthKey();
                $user->save();
                \Yii::$app->sms->sms_send( '7'.$user->username, 'Ваш новый пароль: '.$new_pass);
                Yii::$app->getSession()->setFlash('success', '<div class="alert alert-success">На ваш номер телефона был отправлен новый пароль</div>');
                return $this->redirect('/login');
            }else{
                if ($user && $user->status==3){
                    Yii::$app->getSession()->setFlash('error', '<div class="alert alert-danger">Ваш номер заблокирован, пожалуйста, <a href="/contacts">свяжитесь с администрацией сайта</a></div>');
                }else{
                    Yii::$app->getSession()->setFlash('error', '<div class="alert alert-danger">Данный номер телефона не зарегистрирован</div>');
                }
            }
        }

        return $this->render($this->module->getCustomView('requestPasswordResetToken'), [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('users', 'NEW_PASSWORD_WAS_SAVED'));

            return $this->goHome();
        }

        return $this->render($this->module->getCustomView('resetPassword'), [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
    $this->layout = '@app/modules/lc/views/layouts/lc';

        $model = Yii::$app->user->identity;
        $changePasswordForm = new ChangePasswordForm;
        $changeEmailForm = new ChangeEmailForm;
        if ($model->load(Yii::$app->request->post())) {
            $model->birthday = date('Y-m-d H:i:s',strtotime($model->birthday));
            $model->tel = $model->username;
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile){
                if ($image = $model->upload()) {
                    $model->photo = $image;
                }
            }
            $model->save();
            Yii::$app->getSession()->setFlash('success', '<div class="custom-alert3 alert alert-success">Информация успешно сохранена.</div>');

            return $this->redirect(Url::toRoute('/user/user/profile'));
        }

        if ($model->password_hash != '') {
            $changePasswordForm->scenario = 'requiredOldPassword';
        }

        if ($changePasswordForm->load(Yii::$app->request->post()) && $changePasswordForm->validate()) {
            $model->setPassword($changePasswordForm->new_password);
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', '<div class="custom-alert2 alert alert-success">Информация успешно сохранена.</div>');
                return $this->redirect(Url::toRoute('/user/user/profile'));
            }
        }

        if ($changeEmailForm->load(Yii::$app->request->post()) && $changeEmailForm->validate() && $model->setEmail($changeEmailForm->new_email)) {
            Yii::$app->getSession()->setFlash('success', Yii::t('users', 'TO_YOURS_EMAILS_WERE_SEND_MESSAGES_WITH_CONFIRMATIONS'));
            return $this->redirect(Url::toRoute('/user/user/profile'));
        }
        $model->birthday = date('d.m.Y',strtotime($model->birthday));
        return $this->render($this->module->getCustomView('profile'), [
            'model' => $model,
            'changePasswordForm' => $changePasswordForm,
            'changeEmailForm' => $changeEmailForm
        ]);
    }

    public function actionConfirmEmail($token)
    {
        $tokenModel = UserEmailConfirmToken::findToken($token);

        if ($tokenModel) {
            Yii::$app->getSession()->setFlash('success', $tokenModel->confirm($token));
        } else {
            Yii::$app->getSession()->setFlash('error', Yii::t('users', 'CONFIRMATION_LINK_IS_WRONG'));
        }

        return $this->redirect(Url::toRoute('/'));
    }
}
