<?php


namespace app\models;


use app\modules\lc\models\UserBuyHistory;
use app\modules\regions\models\GeobaseCity;
use app\modules\regions\models\GeobaseRegion;
use budyaga\users\models\User;
use Yii;
use app\models\HelpCounter;
use yii\base\Model;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use app\models\CseDelivery;
use yii\helpers\Html;


/**
 * LoginForm is the model behind the login form.
 */
class Functions extends Model
{
    public static function translit($str)
    {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ', '/', ',', '"', '_');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'ZH', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', '', 'Y', 'E', 'E', 'Ju', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'ju', 'ya', '-', '-', '', '', '');
        return str_replace($rus, $lat, $str);
    }

    public static function str2url($str)
    {
        // переводим в транслит
        $str = self::translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        //~[^-a-z0-9_]+~u (было)
        $str = preg_replace('~[^-a-z0-9_]+~i', '-', $str);
        $str = preg_replace('~([-])\1+~i', '\\1', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        //удаляем начинания цифр
        return $str;
    }

    public static function get_ad_date($date)
    {
        $date = explode('.', $date);
        switch ($date[1]) {
            case '01':
                $month = 'января';
                break;
            case '02':
                $month = 'февраля';
                break;
            case '03':
                $month = 'марта';
                break;
            case '04':
                $month = 'апреля';
                break;
            case '05':
                $month = 'мая';
                break;
            case '06':
                $month = 'июня';
                break;
            case '07':
                $month = 'июля';
                break;
            case '08':
                $month = 'августа';
                break;
            case '09':
                $month = 'сентября';
                break;
            case '10':
                $month = 'октября';
                break;
            case '11':
                $month = 'ноября';
                break;
            case '12':
                $month = 'декабря';
                break;
        }
        return $date = $date[0] . ' ' . $month . ' ' . $date[2];
    }
    public static function getDayOfWeek($day)
    {
        $day = $day['weekday'];

        switch ($day) {
            case 'Monday':
                $res = 'Понедельник';
                break;
            case 'Tuesday':
                $res = 'Вторник';
                break;
            case 'Wednesday':
                $res = 'Среда';
                break;
            case 'Thursday':
                $res = 'Четверг';
                break;
            case 'Friday':
                $res = 'Пятница';
                break;
            case 'Saturday':
                $res = 'Суббота';
                break;
            case 'Sunday':
                $res = 'Воскресенье';
                break;
        }
        return $res;
    }


    public static function calculate_age($birthday)
    {
        $birthday_timestamp = strtotime($birthday);
        $age = date('Y') - date('Y', $birthday_timestamp);
        if (date('md', $birthday_timestamp) > date('md')) {
            $age--;
        }
        return $age;
    }



    public static function custom_email1($congig)
    {

        $emails = ObratSettings1::find()->where('active = 1')->all();
        foreach ($emails as $key => $value) {
            $email_list[] = $value['email'];
        }
        Yii::$app->mailer->compose()
            ->setFrom('cms.iden@gmail.com')
            ->setTo($email_list)
            ->setSubject($congig['subject'])
            ->setHtmlBody($congig['text'])
            ->send();
    }
    public static function custom_email2($congig)
    {
        $a = Yii::$app->mailer->compose()
            ->setFrom('cms.iden@gmail.com')
            ->setTo(trim($congig['to']))
            ->setSubject($congig['subject'])
            ->setHtmlBody($congig['text'])
            ->send();
    }

    public static function admin_menu1($admin_menu_config){
        $html = '';
        foreach (Yii::$app->params['admin_menu']['modules'] as $key => $value) {
            $html.='<li> <a href="'.$value['url'].'"><div class="admin-menu1__wrap_list_item_img"><img src="'.$admin_menu_config['assets']->baseUrl.'/images/'.$value['icon'].'" alt=""></div><span>'.$value['title'].'</span></a></li>';
        }
        echo $html;
    }
    public static function uslugi_list1(){
        $uslugi = Uslugi::find()->where('active = 1')->orderBy('sort DESC')->all();
        $html = '';
        foreach ($uslugi as $key=>$value){
            $html.= '<li><a href="/uslugi/'.self::str2url($value->name).'_'.$value->id.'"><span class="img"><img src="/images/site_images/list1.png" alt=""></span><span class="text">'.$value->name.'</span></a></li>';

        }
        return $html;
    }
    public static function objects_list1(){
        $objects = Objects::find()->where('active = 1 and service_id=3')->orderBy('sort DESC')->all();
        $html = '';
        foreach ($objects as $key=>$value){
            if ($key==4) {
                $html.='<div>';
            }else{
                $class = '';
            }
            $html.='<li class="'.$class.'"><a href="/objects/'.self::str2url($value->name).'_'.$value->id.'">'.$value->name.'</a></li>';
            if ($key==count($objects) - 1) $html.='</div>';
        }
        return $html;
    }

    public static function reviews_list1(){
        $objects = Reviews::find()->where('active = 1')->orderBy('sort DESC,id desc')->all();
        $html = '';
        foreach ($objects as $key=>$value){
            $html.='
            <div class="swiper-slide">
                <div class="slider2__item">
                    <div class="slider2__item_wrap">
                        <div class="slider2__item_wrap_left">
                            <div class="slider2__item_wrap_left_img">
                                '.($value->image ? '<img src="/images/reviews/'.$value->image.'">' : '').'
                            </div>
                            <div class="slider2__item_wrap_left_img_name">
                                '.$value->author.'
                                <span>'.$value->prof.'</span>
                            </div>
                        </div>
                        <div class="slider2__item_wrap_right">
                            <div class="slider2__item_wrap_right_text1">
                                '.$value->text_short.'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        return $html;
    }

    public static function licenses_list1(){
        $objects = Licenses::find()->where('active = 1')->orderBy('id DESC')->limit(4)->all();
        $html = '';
        foreach ($objects as $key=>$value){

            $html.='
            <a href="/images/licenses/'.$value->image.'" data-sub-html="'.$value->name.'" >
                <div class="index-lic__wrap_list1_wrap_item">
                    <div class="index-lic__wrap_list1_wrap_item_wrap">
                            <img src="/images/licenses/'.$value->image.'" alt="">
                    </div>
                </div>
            </a>
            ';
        }
        return $html;
    }
    public static function partners_list1(){
        $partners = Partners::find()->where('active = 1')->orderBy('sort desc,id DESC')->all();
        $html = '';
        foreach ($partners as $key=>$value){

            $html.='
            <div class="swiper-slide">
                <div class="slider3__item">
                    <div class="index-dov1__wrap_partners_wrap_list_item">
                        <img src="/images/partners/'.$value->image.'" alt="">
                    </div>
                </div>
            </div>
            ';
        }
        return $html;
    }
    public static function getBread($cat_id)
    {
        $cat = Cats::findOne($cat_id);
        if ($cat_id == 0) return $mas = [];
        if (!$cat) return false;
        $mas[] = [
            'id' => $cat->id,
            'name' => $cat->name,
            'url' => $cat->url
        ];
        if ($cat->parent_id != 0) {
            while ($cat->parent_id != 0) {
                $cat = Cats::findOne($cat->parent_id);
                if (!$cat) continue;
                $mas[] = [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'url' => $cat->url
                ];
            }
        }
        return array_reverse($mas);
    }

    function getcharacteristics($cat_id, $config = [])
    {
        if (isset($config['characteristics_for_product'])) {
            foreach ($config['characteristics_for_product'] as $key => $value) {
                $mas[$value['character_data_id']] = $value['character_data_id'];
            }
        }

        $chars = CharacteristicsForCats::find()->where(['cat_id' => $cat_id])->all();
        if (!$chars){
            $tmp_cat = Cats::findOne($cat_id);
            if ($tmp_cat){
                while ($tmp_cat->parent_id > 0){
                    $tmp_cat = Cats::findOne(['id'=>$tmp_cat->parent_id]);
                    $chars = CharacteristicsForCats::find()->where(['cat_id' => $tmp_cat->id])->all();
                    if ($chars) break;
                }
            }
        }
        $tmp = '';

        foreach ($chars as $key => $value) {
            $type = $value->characteristics->type;
            $charact_name = $value->characteristics->name;
            if ($type == 0) {
                $val = '';
                if (isset($config['characteristics_for_product'])) {
                    $model = CharacteristicsForProducts::find()
                        ->select(['characteristics_for_products.*', 'characteristics_data.name'])
                        ->where(['characteristics_for_products.product_id' => $config['product_id']])
                        ->innerJoin('characteristics_data', 'characteristics_data.id=characteristics_for_products.character_data_id AND characteristics_data.parent_id=' . $value->characteristics->id)
                        ->asArray()
                        ->one();
                    $val = $model['name'];
                }

                $tmp .= '
                <div class="char">
                <p>' . $charact_name . '</p>
                <p><input class="form-control" value="' . $val . '" name="characteristics[' . $value->characteristics->id . ']"/></p>
                </div>
                ';
            } elseif ($type == 1) {
                $tmp .= '
                <div class="char">
                <p>' . $charact_name . '</p>
                <div class="options">'
                ;
                foreach ($value->characteristics->characteristicsData as $key2 => $value2) {
                    $checked = '';
                    if (isset($mas[$value2['id']])) {
                        $checked = ' checked ';
                    }
                    $tmp .= '<div class="option"><label><input ' . $checked . ' type="radio" name="characteristics[' . $value->characteristics->id . ']" value="' . $value2['id'] . '"/>' . $value2->name.'</label></div>';
                }
                $tmp.='</div>
                </div>';
            } elseif ($type == 2) {
                $tmp .= '
                <div class="char">
                <p>' . $charact_name . '</p>';
                $tmp.='<div class="options">';
                foreach ($value->characteristics->characteristicsData as $key2 => $value2) {
                    $checked = '';
                    if (isset($mas[$value2['id']])) {
                        $checked = ' checked ';
                    }
                    $tmp .= '<div class="option"><label><input ' . $checked . ' type="checkbox" name="characteristics[' . $value->characteristics->id . '][]" value="' . $value2['id'] . '"/>' . $value2->name.'</label></div>';
                }
                $tmp.='</div>
                </div>';
            } elseif ($type == 3) {
                $tmp .= '
                <div class="char">
                <p>' . $charact_name . '</p>';
                $tmp .= '<select class="form-control" name="characteristics[' . $value->characteristics->id . ']">';
                $tmp .= '<option selected disabled>Выберите</option>';
                foreach ($value->characteristics->characteristicsData as $key2 => $value2) {
                    $checked = '';
                    if (isset($mas[$value2['id']])) {
                        $checked = ' selected ';
                    }
                    $tmp .= '<option ' . $checked . ' value="' . $value2['id'] . '">' . $value2->name . '</option>';
                }
                $tmp .= '</select>
                </div>';
            }
        }

        return $tmp;

    }


    public static function getMenu1(){
        $alias = Yii::$app->request->get('page');
        if (!$alias){
            $alias = Yii::$app->controller->action->id;
        }

        $menu = \app\models\Tree::find()->where('active = 1 and lvl=1 and root=5')->orderBy('rgt ASC')->all();
        foreach ($menu as $key=>$value) {
            echo '<li '.($value->alias == $alias ? 'class="active"' : '').'><a href="/'.$value->alias.'">'.$value->name.'</a></li>';
        }
    }
    public static function getMenu2(){
        $alias = Yii::$app->request->get('page');
        $menu = \app\models\Tree::find()->where('active = 1 and lvl=1 and root=5')->orderBy('rgt ASC')->all();
        foreach ($menu as $key=>$value) {
            echo '<li '.($value->alias == $alias ? 'class="active"' : '').'><a href="/'.$value->alias.'"><span class="img"><img src="/images/site_images/list1.png" alt=""></span><span class="text">'.$value->name.'</span></a></li>';
        }
    }

    public static function getMenu3(){
        $alias = Yii::$app->request->get('page');
        $menu = \app\models\Tree::find()->where('active = 1 and lvl=1 and root=19')->orderBy('rgt ASC')->all();
        foreach ($menu as $key=>$value) {
            echo '<li '.($value->alias == $alias ? 'class="active"' : '').'><a href="/'.$value->alias.'"><span class="img"><img src="/images/site_images/list1.png" alt=""></span><span class="text">'.$value->name.'</span></a></li>';
        }
    }
    public static function getMenu4(){
        $alias = Yii::$app->request->get('page');
        $menu = \app\models\Tree::find()->where('active = 1 and lvl=1 and root=19')->orderBy('rgt ASC')->all();
        foreach ($menu as $key=>$value) {
            echo '<li '.($value->alias == $alias ? 'class="active"' : '').'><a href="/'.$value->alias.'"><span class="img"><img src="/images/site_images/list1.png" alt=""></span><span class="text">'.$value->name.'</span></a></li>';
        }
    }
    public static function peremena($par){
        $peremena = Peremena::findOne(['code'=>$par]);
        if ($peremena) return $peremena->text;
    }

    public static function randObjectts(){
        $objects = Objects::find()->where('active = 1')->orderBy(new Expression('rand()'))->all();
        $tmp = '';
        foreach ($objects as $key => $value) {
            foreach ($value->photos_for_object as $key2=>$value2    ) {
                if (!$value2->on_main) continue;
                $tmp.='
                <div class="swiper-slide">
                    <div class="slider4__item">
                        <div class="onjects1__wrap_list1_item" style="background-image: url(/images/objects/preview/'.$value2->image.')">
                        </div>
                    </div>
                </div>
                ';
            }
        }
        return $tmp;
    }

    public static function getPlaceUrl($city_id = '',$region_id = ''){
        if ($city_id){
            $city = GeobaseCity::findOne($city_id);
            $url = '/catalog/'.$city->region->url.'/'.$city->url;
        }else{
            $region = GeobaseRegion::findOne($region_id);
            $url = '/catalog/'.$region->url;
        }
        return $url;
    }

    public static function getObjectUrl($object_id){
        $object = IspObjects::findOne($object_id);
        if ($object){
            $url = '/catalog/'.$object->city->url.'/'.$object->region->url.'/'.self::str2url($object->name).'_'.$object->id;
            return $url;
        }
        return false;
    }

    public static function calculateReviews1($reviews){
        $sum = 0;
        foreach ($reviews as $key=>$value) {
            $sum+=$value->ocenka;
        }
        $res['sr'] = ceil($sum / count($reviews)).',0';
        if ($res['sr']<5){
            $res['oc'] = 'Нормально';
        }elseif($res['sr']>=5){
            $res['oc'] = 'Хорошо';
        }elseif($res['sr']>7.5){
            $res['oc'] = 'Отлично';
        }
        return $res;
    }
    public static function calendar($imagePath){
        $events = array();
        //Testing
        $cal = [];
        $current_user = User::findOne(Yii::$app->user->id);

        foreach ($current_user->bron as $key=>$value) {
            $cal[date('d-m-Y',strtotime($value->priezd))][] = [
                'id'=>$value->id,
                'priezd'=>$value->priezd,
            ];
        }


        if ($cal){
            foreach ($cal as $key=>$value) {
                foreach ($value as $key2=>$value2) {
                    $Event = new \yii2fullcalendar\models\Event();
                    $Event->id = $value2['id'];
                    $Event->title = count($cal[$key]);
                    $Event->className = date('Y-m-d',strtotime($value2['priezd'])) <= date('Y-m-d') ? 'today' : '';
                    $Event->url= '/lc/reserve?date='.date('d-m-Y',strtotime($value2['priezd'])).'';
                    $Event->start = date('Y-m-d',strtotime($value2['priezd']));
                }
                $events[] = $Event;
            }

        }

        ?>

        <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
            'events'=> $events,
            'options' => [
                'lang' => 'ru',

                //... more options to be defined here!
            ],
            'clientOptions' => [
                'defaultView'=> 'month',
                'header'=>[
                    'left'=> 'prev,next ',
                    'center'=> 'title',
                    'right'=> ''
                ],
                'height'=>550

            ],
        ));
    }


}

