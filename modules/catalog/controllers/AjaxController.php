<?php
namespace app\modules\catalog\controllers;
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
use app\modules\catalog\models\DislikesForReviews;
use app\modules\catalog\models\LikesForObjects;
use app\modules\catalog\models\LikesForReviews;
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
    public function actionReviewLike(){
        if($review_id = Yii::$app->request->post('review_id')){
            DislikesForReviews::deleteAll(['user_id'=>Yii::$app->user->id,'review_id'=>$review_id]);

            if (!(LikesForReviews::find()->where('user_id = '.Yii::$app->user->id. ' and review_id = '.$review_id.'')->count())){
                $model = new LikesForReviews();
                $model->review_id = $review_id;
                $model->user_id = Yii::$app->user->id;
                $model->save();
                $result['status'] = 'success';
                $result['html'] = '';
                return Json::encode($result);
            }

        }
        $result['status'] = 'error';
        $result['html'] = '';
        return Json::encode($result);
    }
    public function actionReviewDislike(){
        if($review_id = Yii::$app->request->post('review_id')){
            LikesForReviews::deleteAll(['user_id'=>Yii::$app->user->id,'review_id'=>$review_id]);
            if (!DislikesForReviews::find()->where('user_id = '.Yii::$app->user->id. ' and review_id = '.$review_id)->count()){
                $model = new DislikesForReviews();
                $model->review_id = $review_id;
                $model->user_id = Yii::$app->user->id;
                $model->save();
                $result['status'] = 'success';
                $result['html'] = '';
                return Json::encode($result);
            }

        }
        $result['status'] = 'error';
        $result['html'] = '';
        return Json::encode($result);
    }
    public function actionObjectLike(){
        @session_start();
        if($object_id = Yii::$app->request->post('object_id')){
            $event = Yii::$app->request->post('event');
            if (!$model = LikesForObjects::findOne(['object_id'=>$object_id])) {
                $model = new LikesForObjects();
                $model->likes = 1;
                $model->object_id = $object_id;
            }else{
                $model->likes = $event == 'like' ? $model->likes +1 : $model->likes - 1;
            }
            if ($event == 'like'){
                $_SESSION['objects_likes'][$object_id] = $object_id;
            }else{
                unset($_SESSION['objects_likes'][$object_id]);
            }
            $model->save();
            $result['status'] = 'success';
            $result['html'] = '';
            return Json::encode($result);
        }
        $result['status'] = 'error';
        $result['html'] = '';
        return Json::encode($result);
    }
    public function actionHomeView(){
        if($home_id = Yii::$app->request->post('home_id')){
            $home = IspHomes::findOne($home_id);
            $html = $this->renderAjax('home_view_ajax',[
                'home'=>$home
            ]);

            $result['status'] = 'success';
            $result['html'] = $html;
            return Json::encode($result);

        }
        $result['status'] = 'error';
        $result['html'] = '';
        return Json::encode($result);
    }
    public function actionBron(){
        if (Yii::$app->request->post()){
            $object = IspObjects::findOne(Yii::$app->request->post('object_id'));
            $model = new BronForObjects();
            $model->client_name = Yii::$app->request->post('client_name');
            if (!$model->client_name){
                $result['status'] = 'error';
                $result['html'] = 'Пожалуйста, представьтесь';
                return Json::encode($result);
            }
            $model->client_tel = Yii::$app->request->post('client_tel');
            if (!$model->client_tel){
                $result['status'] = 'error';
                $result['html'] = 'Пожалуйста, заполните номер телефона';
                return Json::encode($result);
            }
            $model->object_id = Yii::$app->request->post('object_id');
            $model->object_name = Yii::$app->request->post('object_name');
            $model->executor_id =$object->user_id;
            $model->home_count = Yii::$app->request->post('home_count');
            $model->home_name = Yii::$app->request->post('home_name');
            $model->people_count = Yii::$app->request->post('people_count');
            $model->uezd = date('Y-m-d H:i:s',strtotime(Yii::$app->request->post('uezd')));
            $model->priezd = date('Y-m-d H:i:s',strtotime(Yii::$app->request->post('priezd')));
            $model->save();
            $executor = User::findOne($model->executor_id);
            $message = $model->object_name;
            if ($model->home_name && $model->home_count){
                $message.=','.$model->home_name.','.$model->home_count.' дом(а)';
            }
            if ($model->people_count){
                $message.=','.$model->people_count.' человек(а)';
            }
            if ($model->people_count){
                $message.=','.Yii::$app->request->post('priezd').'-'.Yii::$app->request->post('uezd');
            }
            $message.=','.$model->client_name.','.$model->client_tel;
            \Yii::$app->sms->sms_send( '7'.$executor->username, $message);
            $result['status'] = 'success';
            $result['html'] = 'Поздравляем! Вы успешно забронировали «'.$object->name.'», с Вами в скором времени свяжутся менеджеры.';
            return Json::encode($result);
        }
        $result['status'] = 'error';
        $result['html'] = '';
        return Json::encode($result);
    }
}

