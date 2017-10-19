<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property double $price
 * @property integer $spec
 * @property integer $active
 * @property string $description
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public  $imageFiles;
    public  $files;
    public  $configurator;
    public function rules()
    {
        return [
            [['name', 'url','description','dop_chars','description3'], 'string'],
            [['name', 'description','dop_chars','description3','metatitle','metakeywords','metadescription','short_description'], 'string'],
            [['price','price_sale'], 'number'],
            [['spec','new','best_price', 'active', 'configurator_sea'], 'integer'],
            [['url','article'], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 5,'checkExtensionByMimeType' => false],
            [['files'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 5,'checkExtensionByMimeType' => false],
            [['configurator'], 'file', 'skipOnEmpty' => true,'extensions' => 'xls, xlsx','checkExtensionByMimeType' => false],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'url' => 'Url',
            'price' => 'Цена',
            'spec' => 'Спецпредложение?',
            'best_price' => 'Лучшая цена?',
            'new' => 'Новинка?',
            'files' => 'Файлы',
            'active' => 'Активность',
            'description' => 'Описание',
            'imageFiles' => 'Картинки',
            'dop_chars' => 'Технические характеристики',
            'description3' => 'Комплектация',
            'metatitle' => 'Title',
            'configurator' => 'Файл',
            'metakeywords' => 'meta keywords',
            'metadescription' => 'meta description',
            'short_description' => 'Короткое описание (выводится в списке продуктов)',
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $ran = rand(1000,1000000);
                $filename[] = md5($file->baseName.date('Y-m-d-h-i-s').$ran).'.'.$file->extension;
                $filename1 =md5($file->baseName.date('Y-m-d-h-i-s').$ran).'.'.$file->extension;
                $file->saveAs('./images/products/' . $filename1);
            }
            return $filename;
        } else {
            return false;
        }
    }
    public function upload_files($product_id)
    {
        if (!file_exists('./files/' . $product_id)){
            mkdir("./files/$product_id", 0700);
        }
        if ($this->validate()) {
            foreach ($this->files as $file) {
                $filename1 =$file->baseName.'.'.$file->extension;
                $filename[] = $filename1;
                $file->saveAs('./files/'.$product_id.'/' . $filename1);
            }
            return $filename;
        } else {
            return false;
        }
    }
    public function upload_configurator()
    {
        if ($this->validate()) {
            $ran = rand(1000,1000000);
            $file = $this->configurator;
            $filename1 =md5($file->baseName.date('Y-m-d-h-i-s').$ran).'.'.$file->extension;
            $file->saveAs('./configurator/' . $filename1);
            return $filename1;
        } else {
            return false;
        }
    }
    public function getImage(){
        return $this->hasOne(ImagesForProducts::className(),['product_id'=>'id'])->orderBy('main_image DESC,id ASC');
    }
    public function getImages(){
        return $this->hasMany(ImagesForProducts::className(),['product_id'=>'id'])->orderBy('main_image DESC,id ASC');
    }
    public function getCharacteristics(){
        return $this->hasMany(CharacteristicsForProducts::className(),['product_id'=>'id']);
    }
    public function getCat(){
        return $this->hasOne(CatsForProducts::className(),['product_id'=>'id']);
    }
    public function getCats(){
       $parent = $this->cat->cat;
        if (!$parent) return false;
        $parents[] = $parent->id;
        $parents2 = $parent->parents;
        if ($parents2){
            $parents = array_merge($parents,$parents2);
        }
        return $parents;
    }
    public function getSort(){
        return $this->hasMany(ProductsSort::className(),['product_id'=>'id']);
    }
    public static function indexProductsList1(){
        $cats = Cats::find()->where('active = 1 and parent_id = 166')->orderBy('sort DESC')->all();
        if ($cats){
            $tmp='';
            $tmp2 = '';
            foreach ($cats as $key => $value) {
                $url = \app\models\Cats::get_url($value->id);
                $tmp2='';
                if ($key==5){
                    $tmp.='<div class="catalog1__wrap_list1_wrap_hr"></div>';
                }
                if ($value->childs){
                    foreach ($value->childs as $key2 => $value2) {
                        if ($key2<3){
                            $tmp2.=','.$value2->name;
                        }
                    }
                    $tmp2=trim($tmp2,",");
                }
                $tmp.= '
                <div class="catalog1__wrap_list1_wrap_item">
                <a href="'.$url.'">
                     <div class="catalog1__wrap_list1_wrap_item_wrap">
                        <div class="catalog1__wrap_list1_wrap_item_title">
                            '.$value->name.'
                        </div>
                        <div class="catalog1__wrap_list1_wrap_item_img">
                            <img src="'.($value->image ? '/images/cats/'.$value->image : '/images/site_images/no_photo.png').'" alt="">
                        </div>
                        <div class="catalog1__wrap_list1_wrap_item_cat">
                            '.$tmp2.'
                        </div>
                    </div>
                </a>
                    
                </div>';
            }
            echo $tmp;
        }

    }
    public static function getproducturl($product_id)
    {

        $product = Products::findOne($product_id);
        return Cats::get_url($product->cat->cat_id) . '/view/' . Functions::str2url($product->name) . '_' . $product->id;
    }

}
