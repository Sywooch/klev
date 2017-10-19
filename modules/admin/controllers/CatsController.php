<?php

namespace app\modules\admin\controllers;

use app\models\Cats;
use app\models\CharacteristicsForCats;
use app\models\CharacteristicsSort;
use app\models\Functions;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ObratController implements the CRUD actions for Obrat model.
 */
class CatsController extends Controller
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
     * Lists all Obrat models.
     * @return mixed
     */
    public $layout = 'admin';

    public function actionIndex($parent_id = 0)
    {
        $functions = new Functions();
        $model = new Cats();
        if ($model->load(Yii::$app->request->post())) {
            $model->url = $functions->str2url($model->name);
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $last_sort = Cats::find()->where(['parent_id' => $parent_id])->orderBy(['sort' => SORT_DESC])->one();
            if (!$last_sort) {
                $model->sort = 0;
            } else {
                $model->sort = $last_sort->sort + 10;
            }
            $model->parent_id = $parent_id;
            $model->active = 1;
            if ($model->imageFile) {
                if ($model->upload()) {
                    $filename = $model->upload();
                    $model->setAttribute('image', $filename);
                }
            }
            if ($model->validate()) {
                if ($model->save()) {
                    $session = Yii::$app->session;
                    $session->setFlash('add', '<div class="alert alert-success">Вы успешно добавили категорию.</div>');
                    $model = new Cats();
                }
                // form inputs are valid, do something here
            }
        }
        $cats = $model->view_cat($model->get_cat(), $parent_id);
        //вычисляем категорию для хлебной крошки
        $bread = $functions->getBread($parent_id);
        $current_cat = Cats::findOne($parent_id);

        return $this->render('index', [
            'cats' => $cats,
            'model' => $model,
            'bread' => $bread,
            'parent_id' => $parent_id,
            'current_cat' => $current_cat,
        ]);
    }

    public function actionUpdate($cat_id)
    {
        $functions = new Functions();
        $model = Cats::findOne($cat_id);
        if (!$model) return $this->redirect('/admin/cats/index');

        if ($model->load(Yii::$app->request->post())) {
            $model->url = $functions->str2url($model->name);
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile) {
                if ($model->upload()) {
                    $filename = $model->upload();
                    $model->setAttribute('image', $filename);
                }
            }
            if ($model->validate()) {

                if ($model->save()) {

                    CharacteristicsForCats::deleteAll(['cat_id'=>$model->id]);

                    if (Yii::$app->request->post('attributes')){
                        foreach (Yii::$app->request->post('attributes') as $key=>$value) {
                            $model1 = new CharacteristicsForCats();
                            $model1->cat_id = $model->id;
                            $model1->characteristic_id = $value;
                            $model1->save();

                            if (!$model1 = CharacteristicsSort::findOne(['characteristic_id'=>$value])){
                                $model1 = new CharacteristicsSort();
                            }
                            $model1->cat_id = $model->id;
                            $model1->characteristic_id = $value;
                            $model1->sort = 0;
                            $model1->save();
                        }

                    }
                    if (Yii::$app->request->post('sort')){
                        foreach (Yii::$app->request->post('sort') as $key=>$value) {
                            if (!$model1 = CharacteristicsSort::findOne(['characteristic_id'=>$key])){
                                $model1 = new CharacteristicsSort();
                            }
                            $model1->cat_id = $model->id;
                            $model1->characteristic_id = $key;
                            $model1->sort = $value;
                            $model1->save();
                        }


                    }

                    if (Yii::$app->request->post('attributes1')){
                        foreach (Yii::$app->request->post('attributes1') as $key=>$value) {
                            CharacteristicsForCats::deleteAll(['cat_id'=>$model->id,'characteristic_id'=>$value]);
                        }
                    }
                    if (Yii::$app->request->post('sort')){
                        foreach (Yii::$app->request->post('sort') as $key=>$value) {
                            if (!$model1 = CharacteristicsSort::findOne(['characteristic_id'=>$key])){
                                $model1 = new CharacteristicsSort();
                            }
                            $model1->cat_id = $model->id;
                            $model1->characteristic_id = $key;
                            $model1->sort = $value;
                            $model1->save();
                        }
                    }


                    $session = Yii::$app->session;
                    $session->setFlash('add', '<div class="alert alert-success">Сохранено.</div>');

                }
                // form inputs are valid, do something here
            }
        }
        $bread = $functions->getBread($cat_id);
        return $this->render('update', [
            'model' => $model,
            'bread' => $bread,
        ]);
    }

    public function actionDelete($cat_id)
    {
        if (Cats::findOne($cat_id)->delete()) {
            $session = Yii::$app->session;
            $session->setFlash('add', '<div class="alert alert-success">Сохранено.</div>');
            return $this->redirect('/admin/cats/update?cat_id=' . $cat_id);
        }
        return $this->redirect('/admin/cats/index');
    }


}
