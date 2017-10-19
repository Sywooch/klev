<?php

namespace app\controllers;

use app\models\Balance;
use app\models\Cats;
use app\models\CatsForProducts;
use app\models\CompanyBalance;
use app\models\ConfirmCode1;
use app\models\Contacts;
use app\models\FullHistory;
use app\models\Functions;
use app\models\ImagesForProducts;
use app\models\Licenses;
use app\models\Modal3SignUpForm;
use app\models\CustomForm3;
use app\models\Orders;
use app\models\Partners;
use app\models\PerepiskaQueries;
use app\models\PhotosForReviews;
use app\models\Products;
use app\models\Reviews;
use app\models\StaticText;
use app\models\Tmp;
use app\models\Tree;
use app\models\Uslugi;
use app\modules\admin\models\ObratValuesForFields;
use app\modules\lc\models\UserBuyHistory;
use budyaga\users\models\forms\SignupForm;
use budyaga\users\models\User;
use vova07\imperavi\actions\GetAction;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\httpclient\XmlParser;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use Zelenin\yii\extensions\Sms;
use yii\data\Pagination;
use app\models\YandexKassa;
use app\models\HelpCounter;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'error'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['error'],
                        'roles' => [],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        @session_start();
        Url::remember();
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    /**
     * @inheritdoc
     */
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();
            return $this->render('error', [
                'exception' => $exception,
                'statusCode' => $statusCode,
                'name' => $name,
                'message' => $message
            ]);
        }
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/images/content_images',
                'path' => '@webroot/images/content_images',
                'type' => GetAction::TYPE_IMAGES,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/images/content_images',
                'path' => '@webroot/images/content_images',
            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/images/files', // Directory URL address, where files are stored.
                'path' => '@webroot/files/', // Or absolute path to directory where files are stored.
                'uploadOnlyImage' => false, // For not image-only uploading.
            ],

        ];
    }


    public function actionIndex()
    {

        return $this->render('index');
    }
    public function actionInvestoram()
    {
        return $this->render('investoram', [
        ]);
    }
    public function actionPresse()
    {
        return $this->render('presse', [
        ]);
    }



    public function actionStatic($page){
        $page = Tree::find()->where('alias = "'.$page.'"')->limit(1)->one();
        if (!$page) throw new NotFoundHttpException('Страница не найдена');
        return $this->render('static',[
            'page'=>$page
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }



}
