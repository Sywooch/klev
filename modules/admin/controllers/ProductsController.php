<?php

namespace app\modules\admin\controllers;

use app\models\Cats;
use app\models\CatsForProducts;
use app\models\Characteristics;
use app\models\CharacteristicsData;
use app\models\CharacteristicsForCats;
use app\models\CharacteristicsForProducts;
use app\models\FilesForProducts;
use app\models\Functions;
use app\models\ProductsTypesForProduct;
use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\ImagesForProducts;
use app\models\ProductsSort;


/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'admin';
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $config = [];
        if (Yii::$app->request->get('cat_id')){
            $config['cat_id'] = Yii::$app->request->get('cat_id');
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$config);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        $functions = new Functions();
        if ($model->load(Yii::$app->request->post())) {
            $model->url =$functions->str2url($model->name);
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $model->files = UploadedFile::getInstances($model, 'files');
            if ($model->save()){
                Yii::$app->getSession()->setFlash('alert','<div class="alert alert-success">Товар успешно добавлен, <a href="/admin/products/update?id='.$model->id.'">редактировать</a></div>');
                if (Yii::$app->request->post('characteristics')){
                    foreach (Yii::$app->request->post('characteristics') as $key => $value) {
                        $model5 = Characteristics::findOne($key);
                        if ($model5){
                            if ($model5->type==0){
                                $model6 = new CharacteristicsData();
                                $model6->parent_id = $key;
                                $model6->name = $value;
                                $model6->save();

                                $model7 = new CharacteristicsForProducts();
                                $model7->product_id = $model->id;
                                $model7->character_data_id = $model6->id;
                                $model7->save();
                            }elseif($model5->type==1){
                                $model7 = new CharacteristicsForProducts();
                                $model7->product_id = $model->id;
                                $model7->character_data_id = $value;
                                $model7->save();
                            }elseif($model5->type==2){
                                foreach ($value as $key2=>$value2) {
                                    $model7 = new CharacteristicsForProducts();
                                    $model7->product_id = $model->id;
                                    $model7->character_data_id = $value2;
                                    $model7->save();
                                }
                            }elseif($model5->type==3){
                                $model7 = new CharacteristicsForProducts();
                                $model7->product_id = $model->id;
                                $model7->character_data_id = $value;
                                $model7->save();
                            }
                        }
                    }

                }
                if ($model->imageFiles){
                    $tmp = $model->upload();
                    if ($tmp){
                        foreach ($tmp  as $key=>$value) {
                            $images_model = new ImagesForProducts();
                            $images_model->url = $value;
                            $images_model->product_id = $model->id;
                            $images_model->save();
                        }
                    }
                }
                if ($model->files){
                    $tmp = $model->upload_files($model->id);
                    if ($tmp){
                        foreach ($tmp  as $key=>$value) {
                            $files_model = new FilesForProducts();
                            $files_model->url = $value;
                            $files_model->product_id = $model->id;
                            $files_model->save();
                        }
                    }
                }
                if (Yii::$app->request->post('cats')){

                    foreach (Yii::$app->request->post('cats') as $key => $value) {
                        $model4 = new CatsForProducts();
                        $model4->cat_id = $value;
                        $model4->product_id = $model->id;
                        $model4->save();
                    }
                }
                if (Yii::$app->request->post('product_types')){
                    $model8 = new ProductsTypesForProduct();
                    $model8->product_id = $model->id;
                    $model8->product_type_id = Yii::$app->request->post('product_types');
                    $model8->save();
                }
            }

            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $functions = new Functions();
        if ($model->load(Yii::$app->request->post())) {
            $model->url =$functions->str2url($model->name);
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $model->files = UploadedFile::getInstances($model, 'files');
            if ($model->save()){
                Yii::$app->getSession()->setFlash('alert','<div class="alert alert-success">Товар успешно обновлен</div>');
                CatsForProducts::deleteAll(['product_id'=>$model->id]);
                if (Yii::$app->request->post('cats')){
                    foreach (Yii::$app->request->post('cats') as $key => $value) {
                        $model4 = new CatsForProducts();
                        $model4->cat_id = $value;
                        $model4->product_id = $model->id;
                        $model4->save();
                    }
                }


                if (Yii::$app->request->post('deleteimage')){
                    foreach (Yii::$app->request->post('deleteimage') as $key => $value) {
                        $tmp = ImagesForProducts::findOne($key)->delete();
                    }
                }
                if (Yii::$app->request->post('deletefile')){
                    foreach (Yii::$app->request->post('deletefile') as $key => $value) {
                        $tmp = FilesForProducts::findOne($key)->delete();
                    }
                }
                CharacteristicsForProducts::deleteAll(['product_id'=>$model->id]);
                if (Yii::$app->request->post('characteristics')){
                    foreach (Yii::$app->request->post('characteristics') as $key => $value) {
                        $model5 = Characteristics::findOne($key);
                        if ($model5){
                            if ($model5->type==0){
                                $model6 = new CharacteristicsData();
                                $model6->parent_id = $key;
                                $model6->name = $value;
                                $model6->save();

                                $model7 = new CharacteristicsForProducts();
                                $model7->product_id = $model->id;
                                $model7->character_data_id = $model6->id;
                                $model7->save();
                            }elseif($model5->type==1){
                                $model7 = new CharacteristicsForProducts();
                                $model7->product_id = $model->id;
                                $model7->character_data_id = $value;
                                $model7->save();
                            }elseif($model5->type==2){
                                foreach ($value as $key2=>$value2) {
                                    $model7 = new CharacteristicsForProducts();
                                    $model7->product_id = $model->id;
                                    $model7->character_data_id = $value2;
                                    $model7->save();
                                }
                            }elseif($model5->type==3){
                                $model7 = new CharacteristicsForProducts();
                                $model7->product_id = $model->id;
                                $model7->character_data_id = $value;
                                $model7->save();
                            }
                        }
                    }

                }
                if ($model->imageFiles){
                    $tmp = $model->upload();
                    if ($tmp){
                        foreach ($tmp  as $key=>$value) {
                            $images_model = new ImagesForProducts();
                            $images_model->url = $value;
                            $images_model->product_id = $model->id;
                            $images_model->save();
                        }
                    }
                }
                ImagesForProducts::updateAll(['main_image' => 0],'product_id = '.$model->id);
                if ($model->files){
                    $tmp = $model->upload_files($model->id);
                    if ($tmp){
                        foreach ($tmp  as $key=>$value) {
                            $files_model = new FilesForProducts();
                            $files_model->url = $value;
                            $files_model->product_id = $model->id;
                            $files_model->save();
                        }
                    }
                }
                if (Yii::$app->request->post('mainimage')){
                    ImagesForProducts::updateAll(['main_image'=>1],'id = '.Yii::$app->request->post('mainimage'));
                }

                return $this->redirect(['update', 'id' => $model->id]);
            }


        }
            $images = ImagesForProducts::find()->where(['product_id'=>$model->id])->asArray()->all();
            $files = FilesForProducts::find()->where(['product_id'=>$model->id])->asArray()->all();
            return $this->render('update', [
                'model' => $model,
                'images' => $images,
                'files' => $files,
            ]);
     }
     public function actionConfigurator_create(){
        $model = new Products();
        if($model->load(Yii::$app->request->post())){
            $model->configurator = UploadedFile::getInstance($model, 'configurator');
            if ($model->configurator){
                $tmp = $model->upload_configurator();
                $objPHPExcel = \PHPExcel_IOFactory::load('./configurator/'.$tmp.'');
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                if ($sheetData){
                    $cats1 = [];
                    $cats2 = [];
                    foreach ($sheetData as $key=>$value ) {
                        if (!$value['D'] || Products::find()->where('article = "'.$value['A'].'"')->limit(1)->one()) continue;
                        $images = [];
                        if ($key==1) continue;
                        $productModel = new Products();
                        $productModel->name = $value['D'];
                        $productModel->description = $value['E'];
                        $productModel->dop_chars = $value['J'];
                        $productModel->price = $value['M'] ? $value['M'] : NULL;
                        $productModel->price = str_replace(',','',$productModel->price);
                        $productModel->price = str_replace('.','',$productModel->price);
                        $productModel->active = 1;
                        $productModel->price_sale = $value['N'];
                        $productModel->article = $value['A'];

                        if ($productModel->save()){
                            if ($value['O']) {
                                $images[] = $value['O'];
                            }
                            if ($value['P']) {
                                $images[] = $value['P'];
                            }
                            if ($value['Q']) {
                                $images[] = $value['Q'];
                            }
                            if ($value['R']) {
                                $images[] = $value['R'];
                            }
                            if ($value['S']) {
                                $images[] = $value['S'];
                            }
                            if ($value['F']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['F']);
                                $new_char->parent_id = 1;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            if ($value['G']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['G']);
                                $new_char->parent_id = 2;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            if ($value['H']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['H']);
                                $new_char->parent_id = 3;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            if ($value['I']){
                                $v = trim($value['I']);
                                if ($m = CharacteristicsData::find()->where('name = "'.$v.'" and parent_id = 4')->limit(1)->one()){
                                    $new_char_for_product = new CharacteristicsForProducts();
                                    $new_char_for_product->product_id = $productModel->id;
                                    $new_char_for_product->character_data_id = $m->id;
                                    $new_char_for_product->save();
                                }else{
                                    $new_char = new CharacteristicsData();
                                    $new_char->name = trim($value['I']);
                                    $new_char->parent_id = 4;
                                    $new_char->sort = 0;
                                    $new_char->save();
                                }
                            }
                            if ($value['K']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['K']);
                                $new_char->parent_id = 6;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            if ($value['L']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['L']);
                                $new_char->parent_id = 5;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            foreach ($images as $key2=>$value2) {
                                if ($key == 0) {
                                    $main_image = 1;
                                }else{
                                    $main_image = 0;
                                }

                                $url = $value2;
                                $path = './images/products/'.$productModel->id.'_'.$key2.'.jpg';
                                if (file_put_contents($path, file_get_contents($url))){
                                    $productModelImage = new ImagesForProducts();
                                    $productModelImage->url = $productModel->id.'_'.$key2.'.jpg';
                                    $productModelImage->product_id = $productModel->id;
                                    $productModelImage->main_image = $main_image;
                                    $productModelImage->save();
                                }
                            }
                            if (!array_key_exists($value['B'],$cats1) && !($tmp_cats1 = Cats::findOne(['name'=>$value['B']]))){
                                $cats_model = new Cats();
                                $cats_model->name = $value['B'];
                                $cats_model->parent_id = 166;
                                $cats_model->url = Functions::str2url($value['B']);
                                $cats_model->view_type = 'blocks';
                                $cats_model->active = 1;
                                $cats_model->sort = 0;
                                $cats_model->save();
                                $cats1[$value['B']] = $cats_model->id;

                                $cats_model2 = new Cats();
                                $cats_model2->name = $value['C'];
                                $cats_model2->parent_id = $cats_model->id;
                                $cats_model2->url = Functions::str2url($value['C']);
                                $cats_model2->view_type = 'blocks';
                                $cats_model2->active = 1;
                                $cats_model2->sort = 0;
                                $cats_model2->save();
                                $cats2[$value['C']] = $cats_model2->id;

                                $cat_for_product = new CatsForProducts();
                                $cat_for_product->cat_id = $cats_model2->id;
                                $cat_for_product->product_id = $productModel->id;
                                $cat_for_product->save();
                            }elseif($tmp_cats1){
                                $cats1[$value['B']] = $tmp_cats1->id;
                                $tmp_cats2 = Cats::findOne(['name'=>$value['C'],'parent_id'=>$cats1[$value['B']]]);
                                $cats2[$value['C']] = $tmp_cats2->id;
                            }

                            if (array_key_exists($value['B'],$cats1)){
                                if (array_key_exists($value['C'],$cats2)){
                                    $cat_for_product = new CatsForProducts();
                                    $cat_for_product->cat_id = $cats2[$value['C']];
                                    $cat_for_product->product_id = $productModel->id;
                                    $cat_for_product->save();
                                }else{
                                    if ($tmp_cats2 = Cats::findOne(['name'=>$value['C'],'parent_id'=>$cats1[$value['B']]])){
                                        $cats2[$value['C']] = $tmp_cats2->id;
                                        $cat_for_product = new CatsForProducts();
                                        $cat_for_product->cat_id = $cats2[$value['C']];
                                        $cat_for_product->product_id = $productModel->id;
                                        $cat_for_product->save();
                                    }else{
                                        $cats_model2 = new Cats();
                                        $cats_model2->name = $value['C'];
                                        $cats_model2->parent_id = $cats1[$value['B']];
                                        $cats_model2->url = Functions::str2url($value['C']);
                                        $cats_model2->view_type = 'blocks';
                                        $cats_model2->active = 1;
                                        $cats_model2->sort = 0;
                                        $cats_model2->save();
                                    }
                                }
                            }

                        }

                    }
                }

            }
        }
        return $this->render('configurator_create', [
             'model' => $model,
        ]);
     }
    public function actionConfigurator_update(){
        ini_set('max_execution_time', 9000);
        $model = new Products();
        if($model->load(Yii::$app->request->post())){
            $model->configurator = UploadedFile::getInstance($model, 'configurator');
            if ($model->configurator){
                $tmp = $model->upload_configurator();
                $objPHPExcel = \PHPExcel_IOFactory::load('./configurator/'.$tmp.'');
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                if ($sheetData){
                    $cats1 = [];
                    $cats2 = [];
                    Products::updateAll(['configurator_sea'=>0]);
                    foreach ($sheetData as $key=>$value ) {
                        if (!$value['D']) continue;
                        $images = [];
                        if ($key==1) continue;
                        $productModel = Products::find()->where('article = "'.$value['A'].'"')->limit(1)->one();
                        if (!$productModel) $productModel = new Products();
                        $productModel->name = $value['D'];
                        $productModel->description = $value['E'];
                        $productModel->dop_chars = $value['J'];
                        $productModel->price = $value['M'] ? $value['M'] : NULL;
                        $productModel->price = str_replace(',','',$productModel->price);
                        $productModel->price = str_replace('.','',$productModel->price);
                        $productModel->price = doubleval($productModel->price);

                        $productModel->price_sale = $value['N'] ? $value['N'] : NULL;
                        $productModel->price_sale = str_replace(',','',$productModel->price_sale);
                        $productModel->price_sale = str_replace('.','',$productModel->price_sale);
                        $productModel->price_sale = doubleval($productModel->price_sale);

                        $productModel->active = 1;
                        $productModel->new = 0;
                        $productModel->best_price = 0;
                        $productModel->article = $value['A'];
                        $productModel->configurator_sea = 1;

                        if ($productModel->save()){
                            if ($value['O']) {
                                $images[] = $value['O'];
                            }
                            if ($value['P']) {
                                $images[] = $value['P'];
                            }
                            if ($value['Q']) {
                                $images[] = $value['Q'];
                            }
                            if ($value['R']) {
                                $images[] = $value['R'];
                            }
                            if ($value['S']) {
                                $images[] = $value['S'];
                            }
                            CharacteristicsForProducts::deleteAll(['product_id'=>$productModel->id]);
                            if ($value['F']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['F']);
                                $new_char->parent_id = 1;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            if ($value['G']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['G']);
                                $new_char->parent_id = 2;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            if ($value['H']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['H']);
                                $new_char->parent_id = 3;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            if ($value['I']){
                                $v = trim($value['I']);
                                if ($m = CharacteristicsData::find()->where('name = "'.$v.'" and parent_id = 4')->limit(1)->one()){
                                    $new_char_for_product = new CharacteristicsForProducts();
                                    $new_char_for_product->product_id = $productModel->id;
                                    $new_char_for_product->character_data_id = $m->id;
                                    $new_char_for_product->save();
                                }else{
                                    $new_char = new CharacteristicsData();
                                    $new_char->name = trim($value['I']);
                                    $new_char->parent_id = 4;
                                    $new_char->sort = 0;
                                    $new_char->save();
                                }
                            }
                            if ($value['K']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['K']);
                                $new_char->parent_id = 6;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            if ($value['L']){
                                $new_char = new CharacteristicsData();
                                $new_char->name = trim($value['L']);
                                $new_char->parent_id = 5;
                                $new_char->sort = 0;
                                $new_char->save();

                                $new_char_for_product = new CharacteristicsForProducts();
                                $new_char_for_product->product_id = $productModel->id;
                                $new_char_for_product->character_data_id = $new_char->id;
                                $new_char_for_product->save();
                            }
                            ImagesForProducts::deleteAll(['product_id'=>$productModel->id]);
                            foreach ($images as $key2=>$value2) {
                                if ($key == 0) {
                                    $main_image = 1;
                                }else{
                                    $main_image = 0;
                                }

                                $url = $value2;
                                $path = './images/products/'.$productModel->id.'_'.$key2.'.jpg';
                                if (file_put_contents($path, file_get_contents($url))){
                                    $productModelImage = new ImagesForProducts();
                                    $productModelImage->url = $productModel->id.'_'.$key2.'.jpg';
                                    $productModelImage->product_id = $productModel->id;
                                    $productModelImage->main_image = $main_image;
                                    $productModelImage->save();
                                }
                            }
                            if (!array_key_exists($value['B'],$cats1) && !($tmp_cats1 = Cats::findOne(['name'=>$value['B']]))){
                                $cats_model = new Cats();
                                $cats_model->name = $value['B'];
                                $cats_model->parent_id = 166;
                                $cats_model->url = Functions::str2url($value['B']);
                                $cats_model->view_type = 'blocks';
                                $cats_model->active = 1;
                                $cats_model->sort = 0;
                                $cats_model->save();
                                $cats1[$value['B']] = $cats_model->id;

                                $cats_model2 = new Cats();
                                $cats_model2->name = $value['C'];
                                $cats_model2->parent_id = $cats_model->id;
                                $cats_model2->url = Functions::str2url($value['C']);
                                $cats_model2->view_type = 'blocks';
                                $cats_model2->active = 1;
                                $cats_model2->sort = 0;
                                $cats_model2->save();
                                $cats2[$value['C']] = $cats_model2->id;

                                $cat_for_product = new CatsForProducts();
                                $cat_for_product->cat_id = $cats_model2->id;
                                $cat_for_product->product_id = $productModel->id;
                                $cat_for_product->save();
                            }elseif($tmp_cats1){
                                $cats1[$value['B']] = $tmp_cats1->id;
                                $tmp_cats2 = Cats::findOne(['name'=>$value['C'],'parent_id'=>$cats1[$value['B']]]);
                                $cats2[$value['C']] = $tmp_cats2->id;
                            }

                            if (array_key_exists($value['B'],$cats1)){
                                if (array_key_exists($value['C'],$cats2)){
                                    $cat_for_product = new CatsForProducts();
                                    $cat_for_product->cat_id = $cats2[$value['C']];
                                    $cat_for_product->product_id = $productModel->id;
                                    $cat_for_product->save();
                                }else{
                                    if ($tmp_cats2 = Cats::findOne(['name'=>$value['C'],'parent_id'=>$cats1[$value['B']]])){
                                        $cats2[$value['C']] = $tmp_cats2->id;
                                        $cat_for_product = new CatsForProducts();
                                        $cat_for_product->cat_id = $cats2[$value['C']];
                                        $cat_for_product->product_id = $productModel->id;
                                        $cat_for_product->save();
                                    }else{
                                        $cats_model2 = new Cats();
                                        $cats_model2->name = $value['C'];
                                        $cats_model2->parent_id = $cats1[$value['B']];
                                        $cats_model2->url = Functions::str2url($value['C']);
                                        $cats_model2->view_type = 'blocks';
                                        $cats_model2->active = 1;
                                        $cats_model2->sort = 0;
                                        $cats_model2->save();
                                    }
                                }
                            }

                        }

                    }
                    Products::deleteAll(['configurator_sea'=>0]);
                }

            }
        }
        return $this->render('configurator_update', [
            'model' => $model,
        ]);
    }


        /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
