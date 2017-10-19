<?php

namespace app\modules\shop\controllers;

use app\models\CatsForProducts;
use app\models\CharacteristicsForCats;
use app\models\Objects;
use app\models\Products;
use app\models\Uslugi;
use app\modules\shop\models\ShopFunctions;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Cats;
use app\models\Functions;
use Yii;

/**
 * Default controller for the `uslugi` module
 */
class DefaultController extends Controller
{
    public function actionCats($cat, $cat_id)
    {
        $this->layout = 'cats';
        $cat = Cats::findOne($cat_id);

        if (!$cat) throw new NotFoundHttpException('Категория не найдена!');
        //теперь проверяем есть ли подкатегории
        $childs = Cats::find()->where(['parent_id' => $cat->id])->orderBy('sort DESC')->all();
        if ($childs) {
            return $this->render('cats', [
                'cats' => $childs,
                'cat' => $cat,
            ]);
        } else {

            $functions = new Functions();
            //у нас есть категория $cat
            //получаем типы продуктов для категории
            $char_cats = [];
            $chars = CharacteristicsForCats::find()->where(['cat_id' => $cat_id])->all();
            if (!$chars){
                $tmp_cat = Cats::findOne($cat_id);
                if ($tmp_cat){
                    while ($tmp_cat->parent_id > 0){
                        $tmp_cat = Cats::findOne(['id'=>$tmp_cat->parent_id]);
                        $chars = CharacteristicsForCats::find()->where(['cat_id' => $tmp_cat->id])->all();
                        if ($chars) {
                            $char_cats[] = $tmp_cat;
                            break;
                        }
                    }
                }
            }else{
                $char_cats[] = $cat;
            }
            $filter = '';
            if ($char_cats) {
                //теперь если есть прикрепленные типы продукта к категории, то вытаскиваем прикрепленные
                //характеристики
                $tmp = [];
                foreach ($char_cats as $key => $value) {
                    $chars = CharacteristicsForCats::find()
                        ->innerJoinWith('sort')
                        ->where(['characteristics_for_cats.cat_id' => $value['id']])
                        ->orderBy('characteristics_sort.sort DESC')
                        ->all();
                    foreach ($chars as $key2 => $value2) {
                        $tmp[$value2->characteristic_id] = $value2;
                    }
                }
                $view_flag = 'table';
                //теперь в массиве tmp содержатся все прикрепленные технические характеристики(это только начало)
                //теперь вызываем метод который выведет фильтр
                if (Yii::$app->request->post('characteristics')) {
                    $innerjoines = [];
                    $current_chars = Yii::$app->request->post('characteristics');
                    foreach ($current_chars as $key3 => $value3) {
                        $char = Characteristics::findOne($key3);
                        if ($char->type == 1) {
                            $innerjoines[1][$key3] = '  CFP1' . $key3 . '.character_data_id=' . $value3;
                        } elseif ($char->type == 3) {
                            $innerjoines[3][$key3] = '  CFP3' . $key3 . '.character_data_id=' . $value3;
                        } elseif ($char->type == 2) {
                            $checkox_tmp = [];

                            foreach ($value3 as $key4 => $value4) {
                                $checkox_tmp[] = 'CFP2' . $key3 . '.character_data_id=' . $value4;
                            }
                            if ($checkox_tmp) {
                                $checkox_tmp = ' (' . implode(' OR ', $checkox_tmp) . ')';
                                $innerjoines[2][$key3] = $checkox_tmp;
                            }

                        } elseif ($char->type == 0) {
                            if ($tmpp = explode(',', $value3)) {
                                $value3 = [];
                                if ($tmpp[0] == 0 && $tmpp[1] == 10000) continue;
                                $value3['min'] = $tmpp[0];
                                $value3['max'] = $tmpp[1];
                            }
                            $input_tmp = [];

                            if (isset($value3['min']) || isset($value3['max'])) {
                                if ($value3['min']) {
                                    $tmp_min = ' AND CAST(name AS UNSIGNED)>=' . $value3['min'];
                                }
                                if ($value3['max']) {
                                    $tmp_max = ' AND CAST(name AS UNSIGNED)<=' . $value3['max'];
                                }
                                $model = CharacteristicsData::find()
                                    ->where('parent_id=' . $key3 . $tmp_min . $tmp_max)
                                    ->all();
                                foreach ($model as $key5 => $value5) {
                                    $input_tmp[] = 'CFP0' . $key3 . '.character_data_id=' . $value5->id;
                                }
                                if ($input_tmp) {
                                    $input_tmp = ' (' . implode(' OR ', $input_tmp) . ')';
                                    $innerjoines[0][$key3] = $input_tmp;
                                } else {
                                    $innerjoines[0][$key3] = 'CFP0' . $key3 . '.character_data_id=-1';
                                }
                            }

                        }
                    }
                    $config['current_vals'] = Yii::$app->request->post('characteristics');
                    $filter = ShopFunctions::getcharacteristicsfilter($tmp, $config);
                } else {
                    $filter = ShopFunctions::getcharacteristicsfilter($tmp, []);
                }
                //иначе получаем продукты
                $products = CatsForProducts::find()
                    ->where(['cats_for_products.cat_id' => $cat->id])
                    ->joinWith('sort')
                    ->innerJoinWith('product')
                    ->orderBy('products_sort.sort DESC');
                if (isset($innerjoines[0])) {
                    foreach ($innerjoines[0] as $key10 => $value10) {
                        $products->innerJoin('characteristics_for_products AS CFP0' . $key10, 'CFP0' . $key10 . '.product_id=products.id AND ' . $value10);
                    }
                }
                if (isset($innerjoines[1])) {
                    foreach ($innerjoines[1] as $key10 => $value10) {
                        $products->innerJoin('characteristics_for_products AS CFP1' . $key10, 'CFP1' . $key10 . '.product_id=products.id AND ' . $value10);
                    }
                }
                if (isset($innerjoines[2])) {

                    foreach ($innerjoines[2] as $key10 => $value10) {
                        $products->innerJoin('characteristics_for_products AS CFP2' . $key10, 'CFP2' . $key10 . '.product_id=products.id AND ' . $value10);
                    }
                }
                if (isset($innerjoines[3])) {
                    foreach ($innerjoines[3] as $key10 => $value10) {
                        $products->innerJoin('characteristics_for_products AS CFP3' . $key10, 'CFP3' . $key10 . '.product_id=products.id AND ' . $value10);
                    }
                }
                $products->groupBy('products.id');


                $countQuery = clone $products;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);
                $models = $products->offset($pages->offset)
                    ->limit($pages->limit)
                    ->orderBy('sort DESC,id DESC')
                    ->all();


            }
            return $this->render('products', [
                'products' => $models,
                'pages' => $pages,
                'cat' => $cat,
                'all_chars' => $tmp,
                'filter' => $filter
            ]);
        }
    }

    public function actionProduct($id)
    {
        $product = Products::findOne($id);
        if (!$product) throw new NotFoundHttpException('Товар не найден!');
        $pohozhie = CatsForProducts::find()
            ->select(['products.*', 'cats_for_products.product_id'])
            ->innerJoin('products', 'products.id=cats_for_products.product_id')
            ->where('cats_for_products.cat_id=' . $product->cat->cat_id)
            ->andWhere('products.active=1')
            ->andWhere('products.id<>' . $id)
            ->orderBy('RAND()')
            ->limit(4)
            ->all();
        $files = \app\models\FilesForProducts::find()->where('product_id='.$product->id.'')->asArray()->all();
        return $this->render('product', [
            'product' => $product,
            'pohozhie' => $pohozhie,
            'files' => $files,
        ]);
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}
