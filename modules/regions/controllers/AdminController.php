<?php

namespace app\modules\regions\controllers;

use app\models\Func;
use app\modules\regions\models\GeobaseCity;
use app\modules\regions\models\GeobaseRegion;
use app\modules\regions\models\Functions;
use app\modules\regions\models\GeobaseStrany;
use Yii;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Session;


class AdminController extends Controller
{
    public $layout = '@app/modules/admin/views/layouts/admin';

    public function actionIndex()
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $functions= new Functions();

        if (Yii::$app->request->post('delete_city')) {
            $del_items = Yii::$app->request->post('delete_city');
            foreach ($del_items as $key => $value) {
                $city = GeobaseCity::findOne(['id' => $key]);
                $city->delete();
            }
        }
        if (Yii::$app->request->post('delete_region')) {
            $del_items = Yii::$app->request->post('delete_region');
            foreach ($del_items as $key => $value) {
                $city = GeobaseRegion::findOne(['id' => $key]);
                $city->delete();
            }
        }
        if (Yii::$app->request->post('delete_strana')) {
            $del_items = Yii::$app->request->post('delete_strana');
            foreach ($del_items as $key => $value) {
                $city = GeobaseStrany::findOne(['id' => $key]);
                $city->delete();
            }
        }

        if (Yii::$app->request->post('popular')) {
            $popular_items = Yii::$app->request->post('popular');
            foreach ($popular_items as $key => $value) {
                $item = GeobaseRegion::findOne(['id' => $key]);
                $item->popular = 1;
                $item->save();
            }
        }

        if (Yii::$app->request->post('priority')) {
            $priority_items = Yii::$app->request->post('priority');
            foreach ($priority_items as $key => $value) {
                if ($value == 0) continue;
                $item = GeobaseRegion::findOne(['id' => $key]);
                if (!$item) continue;
                $item->priority = $value;
                $item->save();
            }
        }


        if (Yii::$app->request->post('popular_city')) {
            $popular_items = Yii::$app->request->post('popular_city');
            foreach ($popular_items as $key => $value) {
                $item = GeobaseCity::findOne(['id' => $key]);
                $item->popular = 1;
                $item->save();
            }
        }

        if (Yii::$app->request->post('priority_city')) {
            $priority_items = Yii::$app->request->post('priority_city');
            foreach ($priority_items as $key => $value) {
                if ($value == 0) continue;
                $item = GeobaseCity::findOne(['id' => $key]);
                $item->priority = $value;
                $item->save();
            }
        }


        $regions = new GeobaseRegion();
        $cities = new GeobaseCity();
        $query = 'SELECT * FROM geobase_region
            ORDER BY
            CASE `popular`
                WHEN "0" THEN popular
                ELSE 1 END
            DESC,
            CASE `popular`
                WHEN "1" THEN priority
                ELSE 1 END
            DESC,
            name ASC
            ';
        $region_list = Yii::$app->db
            ->createCommand($query)
            ->queryAll();


        $strana_model = new GeobaseStrany();
        if ($strana_model->load(Yii::$app->request->post())) {
            if ($strana_model->name) {
                $func = new Func();
                $strana_model->url = strtolower($func->translit($strana_model->name));
                $strana_model->active = 1;
                if ($strana_model->save()) {
                    $session = Yii::$app->session;
                    $session->setFlash('add', '<div class="alert alert-success">Вы успешно добавили страну: ' . $strana_model->name . '.</div>');
                    $strana_model = new GeobaseStrany();
                }
            }
        }
        $strany_list = GeobaseStrany::find()->with('regions')->orderBy('id DESC')->all();

        return $this->render('index',
            [
                'region_list' => $region_list,
                'model' => $cities,
                'model1' => $regions,
                'strany_list' => $strany_list,
                'strana_model' => $strana_model,
            ]);
    }

    public function actionEditregion()
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $region = GeobaseRegion::findOne(['id' => Yii::$app->request->get('region_id')]);
        if ($region->load(Yii::$app->request->post())) {
            if ($region->validate()) {
                $func = new Func();
                if (!$region->url) {
                    $region->url = mb_strtolower($func->translit($region->name), 'UTF-8');
                } else {
                    $region->url = mb_strtolower($func->translit($region->url), 'UTF-8');
                }
                if ($region->save()) {
                    $session = Yii::$app->session;
                    $session->setFlash('alerts', '<div class="alert alert-success">Изменения успешно сохранены</div>');
                    return $this->redirect('editregion?region_id=' . Yii::$app->request->get('region_id'), ['hui' => 'asd']);
                }
            }
        }
        return $this->render('edit_region', [
            'model' => $region,
        ]);
    }

    public function actionEditstrana()
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $region = GeobaseStrany::findOne(['id' => Yii::$app->request->get('strana_id')]);
        if ($region->load(Yii::$app->request->post())) {
            $region->active = 1;
            $func = new Func();

            if (!$region->url) {
                $region->url = mb_strtolower($func->translit($region->name), 'UTF-8');
            } else {
                $region->url = mb_strtolower($func->translit($region->url), 'UTF-8');
            }
            if ($region->save()) {
                $session = Yii::$app->session;
                $session->setFlash('alerts', '<div class="alert alert-success">Изменения успешно сохранены</div>');
                return $this->redirect('editstrana?strana_id=' . $region->id);
            }
        }
        return $this->render('edit_strany', [
            'model' => $region,
        ]);
    }

    public function actionEditcity($city_id)
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $city = GeobaseCity::findOne(['id' => $city_id]);
        $functions = new Functions();
        if ($city->load(Yii::$app->request->post())) {
            $city->url = mb_strtolower(($city->oldAttributes['url'] ? $city->url : $functions->translit($city->name)), 'UTF-8');
            if ($city->save()) {
                $session = Yii::$app->session;
                $session->setFlash('editcity', '<div class="alert alert-success">Изменения успешно сохранены.</div>');
                return $this->redirect(['editcity', 'city_id' => $city_id]);
            }
        }

        return $this->render('edit_city', [
            'model' => $city,
        ]);
    }

    public function actionCreate_city($id)
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $functions_model = new Functions();
        $model = new GeobaseCity();
        $region = GeobaseRegion::findOne(['id' => $id]);

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->url)) $model->url = $functions_model->translit($model->name);

            if (!empty($model->name)) {

                $model->region_id = $id;
                $model->url = mb_strtolower($model->url, 'UTF-8');
                $model->strana_id = $region->strana->id;
                if ($model->validate()) {
                    if ($model->save()) {
                        $session = new Session;
                        $session->open();
                        $session = Yii::$app->session;
                        $session->setFlash('add_city', '<div class="alert alert-success">Вы успешно добавили город.</div>');
                        return $this->redirect('create_city?id=' . $id);
                    }
                } else {
                    $session = Yii::$app->session;
                    $session->setFlash('add_city', '<div class="alert alert-danger">Город уже существует.</div>');
                }
            }
        }
        return $this->render('edit_city', [
            'model' => $model, 'region' => $region
        ]);
    }

    public function actionCreate_region($strana_id)
    {
        @session_start();
        $_SESSION['menu'] = 2;
        $functions_model = new Functions();
        $model1 = new GeobaseRegion();
        if ($model1->load(Yii::$app->request->post())) {
            if (!empty($model1->name)) {
                $model1->url = mb_strtolower($functions_model->translit(trim($model1->name)), 'UTF-8');
                $model1->strana_id = $strana_id;
                if ($model1->validate()) {
                    if ($model1->save()) {
                        $session = Yii::$app->session;
                        $session->setFlash('add', '<div class="alert alert-success">Вы успешно добавили регион: ' . $model1->name . '.</div>');
                        return $this->redirect('/regions/admin/create_region?strana_id=' . $strana_id);
                    }
                }
            }
        }
        $strana = GeobaseStrany::findOne($strana_id);
        if (!$strana) {
            throw new NotFoundHttpException('страна не найдена');
        }
        return $this->render('create_region', [
            'model' => $model1,
            'strana' => $strana
        ]);

    }

    public function actionGetcities()
    {
        $query = 'SELECT * FROM geobase_city
            WHERE region_id=' . Yii::$app->request->post('region_id') . '
            ORDER BY
            CASE `popular`
                WHEN "0" THEN popular
                ELSE 1 END
            DESC,
            CASE `popular`
                WHEN "1" THEN priority
                ELSE 1 END
            DESC,
            name ASC
            ';
        $city_list = Yii::$app->db
            ->createCommand($query)
            ->queryAll();
        $text = '';
        foreach ($city_list as $key => $value) {
            $text .= '<p><a onclick="return false;" href="' . Url::to(['#']) . '">' . $value['name'] . '</a><a style="margin-left:5px;" href="' . Url::to(['/regions/admin/editcity', 'city_id' => $value['id']]) . '"><span title="Редактировать" class="glyphicon glyphicon-pencil"></span></a>' . Html::checkbox('delete_city[' . $value['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;']) . '
                    ' . Html::checkbox('popular_city[' . $value['id'] . ']', ($value['popular'] == 1 ? true : false), ['label' => 'Вывести в популярные города', 'style' => 'margin-left:5px;']) . '
                    <label><input type="text" class="form-control priority_city_input"  name="priority_city[' . $value['id'] . ']" value="' . $value['priority'] . '"></label>
                    </p>';
        }
        return $text;
    }

    public function actionCityList1(){
        $tmp = '';
        if ($region_id = Yii::$app->request->post('region_id')){
            $cities = GeobaseCity::find()->where('region_id = '.$region_id.'')->orderBy('name ASC')->all();
            $result['status'] = 'success';
            foreach ($cities as $key3 => $value3) {
                $tmp .= '<li>' . $value3->name . '<a style="margin-left:5px;" href="' . Url::to(['/regions/admin/editcity', 'city_id' => $value3['id']]) . '"><span title="Редактировать" class="glyphicon glyphicon-pencil"></span></a>' . Html::checkbox('delete_city[' . $value3['id'] . ']', false, ['label' => 'Удалить', 'style' => 'margin-left:5px;']) . '
                                        
                                        </li>';
                    }
            $result['html'] = $tmp;
            return Json::encode($result);
        }else{
            $result['status'] = 'error';
            $result['html'] = '';

            return Json::encode($result);
        }
    }

    public function actionAdminregionslist($q = null)
    {
        $query = new Query();

        $query->select('geobase_city.name,geobase_city.id,geobase_region.name AS RNAME')
            ->from('geobase_city')
            ->leftJoin('geobase_region', 'geobase_region.id=geobase_city.region_id')
            ->where('geobase_city.name LIKE "%' . $q . '%"')
            ->orderBy('geobase_city.name');
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = [
                'value' => $d['name'],
                'id' => $d['id'],
                'region' => $d['RNAME'],
            ];
        }
        echo Json::encode($out);
    }

}
