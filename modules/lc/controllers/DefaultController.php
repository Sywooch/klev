<?php
namespace app\modules\lc\controllers;

use app\models\Balance;
use app\models\Catalog;
use app\models\Comfort;
use app\models\ComfortForIspHomes;
use app\models\FishesForObject;
use app\models\Functions;
use app\models\IspHomes;
use app\models\IspObjects;
use app\models\Orders;
use app\models\PhotosForIspHomes;
use app\models\PhotosForIspObjects;
use app\models\VyvodRequests;
use app\modules\catalog\models\BronForObjects;
use app\modules\catalog\models\ViewsForObjects;
use app\modules\regions\models\GeobaseCity;
use budyaga\users\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
                'only' => ['index','add','edit'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','add','edit'],
                        'roles' => ['user'],
                    ],

                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    public $layout = 'lc';

    public function actionIndex()
    {
        $user_model = new User();
        $current_user = User::findOne(Yii::$app->user->id);
        $isp_objects = IspObjects::find()->where('user_id = '.Yii::$app->user->id.'')->orderBy('reg_date DESC')->all();

        $views = ViewsForObjects::find()->innerJoinWith('objects')->orderBy(['reg_date' => SORT_ASC])->all();
        $tmp = [];
        foreach ($views as $key=>$value) {
            $tmp[date('d.m.Y',strtotime($value->reg_date))][] = [
                'views_count'=>$value->views_count
            ];
        }
        foreach ($tmp as $key=>$value) {
            $dates[] = date('d.m.Y', strtotime($key));
            $count1 = 0;
            foreach ($value as $key2 => $value2) {
                $count1 = $count1 + $value2['views_count'];
            }
            $viewss[] = $count1;
        }


        return $this->render('index', [
            'user'=>$current_user,
            'isp_objects'=>$isp_objects,
            'dates' => empty($dates) ? [] : $dates,
            'views' => empty($viewss) ? [] : $viewss,
        ]);

    }
    public function actionReserve()
    {
        $user_model = new User();
        $current_user = User::findOne(Yii::$app->user->id);
        $isp_objects = IspObjects::find()->where('user_id = '.Yii::$app->user->id.'')->orderBy('reg_date DESC')->all();

        $views = ViewsForObjects::find()->innerJoinWith('objects')->orderBy(['reg_date' => SORT_ASC])->all();
        $tmp = [];
        foreach ($views as $key=>$value) {
            $tmp[date('d.m.Y',strtotime($value->reg_date))][] = [
                'views_count'=>$value->views_count
            ];
        }
        foreach ($tmp as $key=>$value) {
            $dates[] = date('d.m.Y', strtotime($key));
            $count1 = 0;
            foreach ($value as $key2 => $value2) {
                $count1 = $count1 + $value2['views_count'];
            }
            $viewss[] = $count1;
        }
        if ($date = Yii::$app->request->get('date')){
            $reserves = BronForObjects::find()
                ->where('executor_id = '.Yii::$app->user->id.'')
                ->andWhere('DATE_FORMAT(priezd,"%Y-%m-%d") = "'.date('Y-m-d',strtotime($date)).'"')
                ->all();
        }


        return $this->render('reserve', [
            'user'=>$current_user,
            'isp_objects'=>$isp_objects,
            'dates' => empty($dates) ? [] : $dates,
            'views' => empty($viewss) ? [] : $viewss,
            'reserves'=>isset($reserves) ? $reserves : ''
        ]);

    }

    public function actionAdd()
    {
        $model = new IspObjects();
        $home_model = new IspHomes();
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $model->active = 1;
            $model->user_id = Yii::$app->user->id;
            $city = GeobaseCity::findOne(['name'=>trim($model->tmp_city)]);
            if ($city){
                $model->city_id = $city->id;
                $model->region_id = $city->region_id;
            }
            if (Yii::$app->request->post('lodki')){
                $model->lodki = 1;
            }else{
                $model->lodki = 0;
            }
            if (Yii::$app->request->post('pitanie')){
                $model->pitanie = 1;
            }else{
                $model->pitanie = 0;
            }
            if (Yii::$app->request->post('snasti')){
                $model->snasti = 1;
            }else{
                $model->snasti = 0;
            }
            if ($model->save()) {
                if ($model->fishes) {
                    foreach ($model->fishes as $key => $value) {
                        $fish_model = new FishesForObject();
                        $fish_model->fish_id = $value;
                        $fish_model->object_id = $model->id;
                        $fish_model->save();
                    }
                }
                if ($model->imageFiles) {
                    $images = $model->upload();
                    if ($images) {
                        foreach ($images as $key => $value) {
                            $image_model = new PhotosForIspObjects();
                            $image_model->image = $value;
                            $image_model->main = ($key == 0 ? 1 : 0);
                            $image_model->object_id = $model->id;
                            $image_model->save();
                        }
                    }
                }
                return $this->redirect('/lc/edit?id='.$model->id.'');
            }
        }
        $objects = IspObjects::find()->where('user_id = '.Yii::$app->user->id.'')->orderBy('id DESC')->all();
        return $this->render('add', [
            'model' => $model,
            'objects'=>$objects,
            'home_model'=>$home_model,
        ]);
    }

    public function actionDev(){
        return $this->render('dev');
    }
    public function actionEdit($id)
    {

        $model = IspObjects::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            FishesForObject::deleteAll(['object_id'=>$model->id]);
            if ($model->fishes) {
                foreach ($model->fishes as $key => $value) {
                    $fish_model = new FishesForObject();
                    $fish_model->fish_id = $value;
                    $fish_model->object_id = $model->id;
                    $fish_model->save();
                }
            }
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $city = GeobaseCity::findOne(['name'=>trim($model->tmp_city)]);
            if ($city){
                $model->city_id = $city->id;
                $model->region_id = $city->region_id;
            }
            if (Yii::$app->request->post('lodki')){
                $model->lodki = 1;
            }else{
                $model->lodki = 0;
            }
            if (Yii::$app->request->post('pitanie')){
                $model->pitanie = 1;
            }else{
                $model->pitanie = 0;
            }
            if (Yii::$app->request->post('snasti')){
                $model->snasti = 1;
            }else{
                $model->snasti = 0;
            }


            if ($model->save()) {
                if ($model->imageFiles) {
                    $images = $model->upload();
                    if ($images) {
                        foreach ($images as $key => $value) {
                            $image_model = new PhotosForIspObjects();
                            $image_model->image = $value;
                            $image_model->main = ($key == 0 ? 1 : 0);
                            $image_model->object_id = $model->id;
                            $image_model->save();
                        }
                    }
                }
            }
        }
        $home_model = new IspHomes(['scenario'=>'new']);
        if ($home_model->load(Yii::$app->request->post())){
            foreach ($home_model->room_counts as $key => $value) {
                $tmp_model = new IspHomes();
                if (isset($home_model->ids[$key])) $tmp_model = IspHomes::findOne($home_model->ids[$key]);
                $tmp_model->room_count = $value;
                $tmp_model->active = 1;
                $tmp_model->name = $home_model->names[$key];
                $tmp_model->price = $home_model->prices[$key];
                $tmp_model->description= $home_model->descriptions[$key];
                $tmp_model->people_count= $home_model->people_counts[$key];
                $tmp_model->object_id = $model->id;
                $tmp_model->save();
                if ($home_model->services){
                    if (isset($home_model->ids[$key]) && isset($home_model->services[$home_model->ids[$key]])){
                        ComfortForIspHomes::deleteAll(['home_id'=>$home_model->ids[$key]]);
                        foreach ($home_model->services[$home_model->ids[$key]] as $key6 => $value6) {
                            $comfort_model = new ComfortForIspHomes();
                            $comfort_model->home_id = $home_model->ids[$key];
                            $comfort_model->comfort_id = $value6;
                            $comfort_model->save();
                        }

                    }
                }
                if (isset($home_model->imageFiles[$key])){
                    $photos = UploadedFile::getInstances($home_model, 'imageFiles['.$key.']');
                    if ($photos){
                        foreach ($photos as $key2=>$value2) {
                            $photo = $value2;
                            if ($photo){
                                $filename = md5(date('d m Y H i s').$photo->baseName).rand(1,999999). '.' .$photo->extension;
                                $filePath = 'images/home_photos/' . $filename;
                                $photo->saveAs($filePath);
                                $photo_model = new PhotosForIspHomes();
                                $photo_model->home_id = $tmp_model->id;
                                $photo_model->image = $filename;
                                $photo_model->save();
                            }
                        }
                    }
                }

            }
            if ($home_model->services){
                if (isset($home_model->services['new'])){
                    foreach ($home_model->services['new'] as $key6 => $value6) {
                        $comfort_model = new ComfortForIspHomes();
                        $comfort_model->home_id = $tmp_model->id;
                        $comfort_model->comfort_id = $value6;
                        $comfort_model->save();
                    }

                }
            }

            if ($home_model->imageFiles){

                if (isset($home_model->imageFiles['new'])){
                    $photos = UploadedFile::getInstances($home_model, 'imageFiles[new]');
                    if ($photos){
                        foreach ($photos as $key2=>$value2) {
                            $photo = $value2;
                            if ($photo){
                                $filename = md5(date('d m Y H i s').$photo->baseName).rand(1,999999). '.' .$photo->extension;
                                $filePath = 'images/home_photos/' . $filename;
                                $photo->saveAs($filePath);
                                $photo_model = new PhotosForIspHomes();
                                $photo_model->home_id = $tmp_model->id;
                                $photo_model->image = $filename;
                                $photo_model->save();
                            }
                        }
                    }

                }
            }

            $home_model = new IspHomes();


        }


        $objects = IspObjects::find()->where('user_id = '.Yii::$app->user->id.'')->orderBy('id DESC')->all();
        $homes = IspHomes::find()->where('object_id  = '.$model->id.'')->orderBy('id ASC')->all();
        $services = Comfort::find()->orderBy('id DESC')->all();
        if ($model->city_id){
            $city = GeobaseCity::findOne(['id'=>$model->city_id]);
            $model->tmp_city = $city->name;
        }
        $current_fishes = [];

        if ($model->fishes_list) {
            foreach ($model->fishes_list as $key => $value) {
                $current_fishes[] = $value->fish_id;
            }
        }
        $model->fishes = $current_fishes;

        return $this->render('edit', [
            'model' => $model,
            'objects'=>$objects,
            'home_model'=>$home_model,
            'homes'=>$homes,
            'services'=>$services,
        ]);
    }

}
