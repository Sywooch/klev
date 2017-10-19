<?php

namespace app\modules\admin\controllers;

use app\models\Catalog;
use app\models\CompanyBalance;
use app\models\Functions;
use app\models\Orders;
use app\models\VyvodRequests;
use app\modules\lc\models\UserBuyHistory;
use budyaga\users\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Default controller for the `lc` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'pages', 'update', 'delete', 'view'],
                        'roles' => ['administrator'],
                    ],
                ],
            ],
        ];
    }




    
    public $layout = 'admin';
    public function actionIndex()
    {
        return $this->render('index',[
        ]);
    }

    public function actionPages(){
        return $this->render('pages');
    }


}
