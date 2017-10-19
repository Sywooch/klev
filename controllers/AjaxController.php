<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\Contacts;
use app\models\CustomFormProb;
use app\models\Functions;
use app\models\Messages;
use app\models\Orders;
use app\models\PerepiskaQueries;
use app\models\PhotosForObjects;
use app\models\Products;
use app\models\ProductsSort;
use app\models\Reviews;
use app\modules\admin\models\ObratValuesForFields;
use app\modules\lc\models\CustomForm1;
use app\models\CustomForm3;
use app\modules\regions\models\GeobaseCity;
use app\modules\regions\models\GeobaseRegion;
use budyaga\users\models\User;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;


class AjaxController extends Controller
{
    public function actionPlacesList1($q = null)
    {
        $data = GeobaseRegion::find()->where('name LIKE "%' . $q . '%"')->orderBy('name ASC')->all();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['value' => $d->name, 'query' => $q];
        }
        echo Json::encode($out);
    }
    public function actionPlacesCitiesList1($q = null)
    {
        $data = GeobaseCity::find()->where('name LIKE "%' . $q . '%"')->orderBy('name ASC')->all();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['value' => $d->name, 'query' => $q];
        }
        echo Json::encode($out);
    }
    public function actionPlaceList1($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('geobase_region.name as region_name, geobase_city.id,geobase_city.region_id, geobase_city.name AS text')
                ->from('geobase_city')
                ->innerJoin('geobase_region','geobase_region.id = geobase_city.region_id')
                ->where(['like', 'geobase_city.name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            foreach ($data as $key=>$value) {
                $data[$key]['text'] = $value['text'].' ('.$value['region_name'].')';
            }
            $query2 = new Query();
            $query2->select('id,geobase_region.name ,geobase_region.name AS text')
                ->from('geobase_region')
                ->where(['like', 'geobase_region.name', $q])
                ->limit(20);
            $command2 = $query2->createCommand();
            $data2 = $command2->queryAll();

            $data = array_merge($data2,$data);

            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
        }


        return $out;
    }


}
