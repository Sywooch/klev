<?php
namespace app\modules\lc\controllers;
use app\models\Balance;
use app\models\Catalog;
use app\models\Functions;
use app\models\IspHomes;
use app\models\IspObjects;
use app\models\Orders;
use app\models\PhotosForIspHomes;
use app\models\PhotosForIspObjects;
use app\models\VyvodRequests;
use app\modules\catalog\models\BronForObjects;
use app\modules\regions\models\GeobaseCity;
use budyaga\users\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
/**
 * Default controller for the `lc` module
 */
class AjaxController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionHomesAddField(){
        $model = new IspHomes();
        $result['status'] = 'success';
        $result['html'] = $this->renderAjax('@app/modules/lc/views/default/add_form_homes',['model'=>$model]);

        return Json::encode($result);
    }
    public function actionDelPhoto1(){
        if($image_id = Yii::$app->request->post('image_id')){
            PhotosForIspHomes::deleteAll(['id'=>$image_id]);
            $result['status'] = 'success';
            $result['html'] = '';
            return Json::encode($result);
        }
        $result['status'] = 'error';
        $result['html'] = '';

        return Json::encode($result);
    }
    public function actionDelPhoto2(){
        if($image_id = Yii::$app->request->post('image_id')){
            PhotosForIspObjects::deleteAll(['id'=>$image_id]);
            $result['status'] = 'success';
            $result['html'] = '';
            return Json::encode($result);
        }
        $result['status'] = 'error';
        $result['html'] = '';

        return Json::encode($result);
    }
    public function actionDelObject1(){
        if($object_id = Yii::$app->request->post('object_id')){
            IspObjects::deleteAll(['id'=>$object_id]);
            $result['status'] = 'success';
            $result['html'] = '';
            return Json::encode($result);
        }
        $result['status'] = 'error';
        $result['html'] = '';

        return Json::encode($result);
    }

    public function actionPhotoDel1(){
        $model = User::find()->where(['id'=>Yii::$app->user->id])->limit(1)->one();
        $model->photo = '';
        $model->save();
        $result['status'] = 'success';
        $result['html'] = '';
        return Json::encode($result);
    }
    public function actionDelHome1(){
        if($home_id = Yii::$app->request->post('home_id')){
            IspHomes::deleteAll(['id'=>$home_id]);
            $result['status'] = 'success';
            $result['html'] = '';
            return Json::encode($result);
        }
        $result['status'] = 'error';
        $result['html'] = '';

        return Json::encode($result);
    }

    public function actionViewBron1(){
        if($bron_id = Yii::$app->request->post('bron_id')){
            $bron = BronForObjects::findOne($bron_id);
            $html = $this->renderAjax('view_bron',[
                'bron'=>$bron
            ]);

            $result['status'] = 'success';
            $result['html'] = $html;
            return Json::encode($result);

        }
        $result['status'] = 'error';
        $result['html'] = '';
        return Json::encode($result);
    }
    public function actionEditBron1(){
        if($bron_id = Yii::$app->request->post('bron_id')){
            $bron = BronForObjects::findOne($bron_id);
            $html = $this->renderAjax('edit_bron1',[
                'bron'=>$bron
            ]);

            $result['status'] = 'success';
            $result['html'] = $html;
            return Json::encode($result);

        }
        $result['status'] = 'error';
        $result['html'] = '';
        return Json::encode($result);
    }
    public function actionReserveFormEdit1(){


        if(Yii::$app->request->post('id')!==NULL && Yii::$app->request->post('status')!== NULL){
            $reserve = BronForObjects::findOne(Yii::$app->request->post('id'));
            $reserve->status = Yii::$app->request->post('status');
            $reserve->save();

            $result['status'] = 'success';
            $result['html'] = '';
            return Json::encode($result);

        }
        $result['status'] = 'error';
        $result['html'] = '';
        return Json::encode($result);
    }



}

