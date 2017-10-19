<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\ObratFields;
use app\modules\admin\models\ObratFieldsSearch;
use app\modules\admin\models\ObratList;
use app\modules\admin\models\ObratValuesForFields;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ObratFieldsController implements the CRUD actions for ObratFields model.
 */
class ObratFieldsController extends Controller
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
     * Lists all ObratFields models.
     * @return mixed
     */
    public $layout = 'admin';

    public function actionIndex()
    {
        $searchModel = new ObratFieldsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $parent = ObratList::findOne(Yii::$app->request->get('obrat_id'));
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'parent' => $parent,
        ]);
    }

    /**
     * Displays a single ObratFields model.
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
     * Creates a new ObratFields model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ObratFields();

        if ($model->load(Yii::$app->request->post())) {
            $model->obrat_item_id = Yii::$app->request->get('obrat_id');
            $model->save();
            return $this->redirect(['/admin/obrat-fields/index', 'obrat_id' => Yii::$app->request->get('obrat_id')]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ObratFields model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $values_model = new ObratValuesForFields();

        if ($model->load(Yii::$app->request->post())) {
            if ($values_model->load(Yii::$app->request->post())) {
                ObratValuesForFields::deleteAll(['field_id'=>$model->id]);
                if ($model->type == 'checkbox' || $model->type == 'select' || $model->type == 'radio'){
                    foreach ($values_model->names as $key => $value) {
                        $values_model2 = new ObratValuesForFields();
                        $values_model2->field_id = $model->id;
                        $values_model2->name = $value;
                        $values_model2->sort = 0;
                        $values_model2->save();
                    }
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'values_model' => $values_model,
            ]);
        }
    }

    /**
     * Deletes an existing ObratFields model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['/admin/obrat-fields?obrat_id=' . $model->obrat_item_id . '']);
    }

    /**
     * Finds the ObratFields model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ObratFields the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ObratFields::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
