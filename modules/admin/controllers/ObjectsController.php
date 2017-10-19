<?php

namespace app\modules\admin\controllers;

use app\models\Objects;
use app\models\ObjectsSearch;
use app\models\PhotosForObjects;
use Yii;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ObjectsController implements the CRUD actions for Objects model.
 */
class ObjectsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Objects models.
     * @return mixed
     */

    public $layout = 'admin';

    public function actionIndex()
    {
        $searchModel = new ObjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Objects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Objects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Objects();

        if ($model->load(Yii::$app->request->post())) {
            if ($last_object = Objects::find()->orderBy('id DESC')->limit(1)->one()) {
                $model->sort = $last_object->sort + 10;
            } else {
                $model->sort = 0;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'service_id' => $model->service_id]);
            }
        } else {
            $model->active = 1;
            if (Yii::$app->request->get('service_id')) {
                $model->service_id = Yii::$app->request->get('service_id');

            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Objects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $values_model = new PhotosForObjects();
        if (Yii::$app->request->post()) {
            if ($values_model->load(Yii::$app->request->post())) {

                foreach ($values_model->names as $key => $value) {
                    if (isset($values_model->ids[$key]) && !empty($values_model->ids[$key])){
                        $new_photo = PhotosForObjects::findOne($values_model->ids[$key]);
                    }else{
                        $new_photo = new PhotosForObjects();
                    }
                    $new_photo->name = $value ? $value : 'Без названия';
                    $new_photo->object_id = $model->id;
                    if ($last_object = PhotosForObjects::find()->where('object_id = '.$model->id.'')->orderBy('sort DESC')->limit(1)->one()){
                        $new_photo->sort = $last_object->sort + 10;
                    }else{
                        $new_photo->sort = 0;
                    }
                   $photo = UploadedFile::getInstance($values_model, 'photos['.$key.']');
                   if ($photo){
                       $filename = md5(date('d m Y H i s').$photo->baseName).rand(1,999999). '.' .$photo->extension;
                       $photo->saveAs('images/objects/' .$filename);
                       $img = Image::getImagine()->open('images/objects/' .$filename);
                       $size = $img->getSize();
                       $ratio = $size->getWidth()/$size->getHeight();
                       $width = 800;
                       $height = round($width/$ratio);
                       Image::thumbnail('images/objects/' .$filename,$width,$height)->save('images/objects/preview/' . $filename);
                       $new_photo->image = $filename;
                       $photo = NULL;
                       $filename = NULL;
                   }
                   if ($new_photo->image || ($new_photo->name && $new_photo->name!='Без названия')){
                       $new_photo->save();
                   }

                }
            }

        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'values_model' => $values_model,
            ]);
        }
    }

    /**
     * Deletes an existing Objects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Objects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Objects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Objects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
