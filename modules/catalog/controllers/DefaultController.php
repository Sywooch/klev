<?php

namespace app\modules\catalog\controllers;

use app\models\Comfort;
use app\models\Fishes;
use app\models\IspObjects;
use app\models\SessionViewsForObjects;
use app\modules\catalog\models\Reviews;
use app\modules\catalog\models\ViewsForObjects;
use app\modules\regions\models\GeobaseCity;
use app\modules\regions\models\GeobaseRegion;
use app\modules\regions\models\GeobaseStrany;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `catalog` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function beforeAction($action)
    {
        Url::remember();

        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actionIndex($region = '',$city = '')
    {

        $isp_objects = [];
        $place = [];
        $place_type = [];
        $similar_cities = [];
        $current_comfort = [];
        $current_fishes = [];


        if (Yii::$app->request->post('search') || ( $region || $city)){
            $place_type = 'region';
            if ($city || $region){
                $place_input = $city ? $city : $region;

                if (!$place = GeobaseRegion::findOne(['url'=>$place_input])){
                    $place = GeobaseCity::findOne(['url'=>$place_input]);
                    $place_type = 'city';
                }
            }else{
                $place_input = Yii::$app->request->post('search');
                if (!$place = GeobaseRegion::findOne(['name'=>$place_input])){
                    $place = GeobaseCity::findOne(['name'=>$place_input]);
                    $place_type = 'city';
                }
            }
            if (!$place) return $this->redirect('/catalog');
            //тут мы точно узнаем что за регион
            if ($place_type == 'region'){
                $region = $place;
            }else if ($place_type == 'city'){
                $region = $place->region;
                $similar_cities = GeobaseCity::find()->innerJoinWith('ispObjects')->where('geobase_city.region_id = '.$region->id.' and geobase_city.id!= '.$place->id.'')->orderBy(new Expression('RAND()'))->limit(5)->all();
            }
            if ($place){
                $isp_objects = IspObjects::find()->joinWith('fishes_list')->joinWith('homes')->joinWith('homes.comfort2')->where(($place_type == 'region' ? 'region_id' : 'city_id').' = '.$place->id.'')->orderBy('isp_objects.reg_date DESC');
            }else{
                return $this->redirect('/catalog');
            }

        }else{
            $isp_objects = IspObjects::find()->joinWith('fishes_list')->joinWith('homes')->joinWith('homes.comfort2')->where('isp_objects.active = 1')->orderBy('isp_objects.reg_date DESC');
        }

        //тут проверяем прислали ли удобства
        if (Yii::$app->request->post('comfort')){
            $comfort_join = implode(',',Yii::$app->request->post('comfort'));

            $isp_objects->andWhere('comfort_for_isp_homes.comfort_id IN('.$comfort_join.')');

            $current_comfort = Yii::$app->request->post('comfort');
        }

        //тут проверяем прислали ли рыб
        if (Yii::$app->request->post('fishes')){
            $fishes_join = implode(',',Yii::$app->request->post('fishes'));
            $isp_objects->andWhere('fishes_for_object.fish_id IN('.$fishes_join.')');
            $current_fishes = Yii::$app->request->post('fishes');
        }
        if (Yii::$app->request->get('order')=='price'){
            $isp_objects->orderBy('isp_objects.price1 ASC');
        }elseif(Yii::$app->request->get('order')=='reviews'){
            $isp_objects->joinWith('reviews')->orderBy('isp_objects_reviews.id')->groupBy('isp_objects.id');
        }




        $comfort_list1 = Comfort::find()->where('active = 1')->all();
        $fishes_list1 = Fishes::find()->orderBy('name ASC')->all();

        $strana = GeobaseStrany::findOne(['name'=>'Россия']);
        if (Yii::$app->request->post('order1') == 'price_asc'){
            $isp_objects->orderBy('isp_objects.price1 ASC');
        }
        if (Yii::$app->request->post('order1') == 'default'){
            $isp_objects->orderBy('isp_objects.reg_date DESC');
        }

        $isp_objects->groupBy('isp_objects.id');


        return $this->render('catalog',[
            'comfort_list1'=>$comfort_list1,
            'fishes_list1'=>$fishes_list1,
            'current_values'=>Yii::$app->request->post(),
            'isp_objects'=>$isp_objects->all(),
            'place'=>$place,
            'place_type'=>$place_type,
            'region'=>$region,
            'similar_cities'=>$similar_cities,
            'strana'=>$strana,
            'current_comfort'=>$current_comfort,
            'current_fishes'=>$current_fishes,

        ]);
    }

    public function actionObject($object_name,$id){
        if (/*!SessionViewsForObjects::findOne(['ip'=>Yii::$app->request->userIP,'object_id'=>$id])*/true){
            $new_session_view = new SessionViewsForObjects();
            $new_session_view->object_id = $id;
            $new_session_view->ip = Yii::$app->request->userIP;
            $new_session_view->save();
        }


        @session_start();
        $review_model = new Reviews();

        $isp_object = IspObjects::find()
            ->with('city')
            ->with('region')
            ->with('homes')
            ->with('photos')
            ->with('fishes_list')
            ->where('id = '.$id.'')->limit(1)->one();

        $model = ViewsForObjects::findOne(['object_id' => $id, 'DAYOFMONTH(reg_date)' => date('d')]);
        if ($model) {
            $model->updateCounters(['views_count' => 1]);
        } else {
            $model = new ViewsForObjects();
            $model->object_id = $id;
            $model->views_count = 1;
            $model->save();
        }
        if (!$isp_object) throw new NotFoundHttpException('Объект не найден');

        if (Yii::$app->request->post() && $review_model->load(Yii::$app->request->post())){
            $review_model->active = 1;
            $review_model->object_id = $id;
            $review_model->save();
            Yii::$app->getSession()->setFlash('alert','<div class="alert alert-success custom-alert1">Большое спасибо! Отзыв будет добавлен после модерации</div>');
            $review_model = new $review_model();
        }
        $similar_cities = GeobaseCity::find()->innerJoinWith('ispObjects')->where('geobase_city.region_id = '.$isp_object->region->id.' and geobase_city.id!= '.$isp_object->city->id.'')->orderBy(new Expression('RAND()'))->limit(5)->all();


        return $this->render('object',[
            'object'=>$isp_object,
            'similar_cities'=>$similar_cities,
            'review_model'=>$review_model
        ]);
    }
}
