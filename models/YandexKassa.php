<?php
namespace app\models;

use app\models\Orders;
use Yii;
use yii\base\Model;

class YandexKassa extends Model
{
    public $org_mode = 1;//1-http,2-email
    public $test_mode = 0   ;//1-тестируем,0-боевой

    public $shopid = '97730';
    public $password = '8989898989g';

    public $scid_demo = '549210';
    public $scid_combat = '89846';

    //start MAIN
    public function scid()
    {
        if ($this->test_mode) {
            return $this->scid_demo;
        } else {
            return $this->scid_combat;
        }
    }

    //end

    public function getFormUrl()
    {
        if (!$this->org_mode) {
            return $this->individualGetFormUrl();
        } else {
            return $this->orgGetFormUrl();
        }
    }

    public function individualGetFormUrl()
    {
        if ($this->test_mode) {
            return 'https://demomoney.yandex.ru/quickpay/confirm.xml';
        } else {
            return 'https://money.yandex.ru/quickpay/confirm.xml';
        }
    }

    public function orgGetFormUrl()
    {
        if ($this->test_mode) {
            return 'https://demomoney.yandex.ru/eshop.xml';
        } else {
            return 'https://money.yandex.ru/eshop.xml';
        }
    }

    public function createFormHtml($a)
    {
        if ($this->org_mode) {
            $html = '
            <div class="oplata_yandex">
                <h1>Счет на оплату</h1>
                <hr>
                <p><b>Наименование: </b>' . $a['name'] . '</p>
                <p><b>Количество: </b>' . $a['count'] . '</p>
                <p><b>Сумма: </b>' . $a['sum'] . ' руб. (с учетом комиссии)</p>
                <p><b>Доступные способы оплаты: </b></p>


            <form method="POST" action="' . $this->getFormUrl() . '">';
            //обязательные поля
            $html .= '<input type="hidden" name="shopId" value="' . $this->shopid . '">
				<input type="hidden" name="scId" value="' . $this->scid() . '">
				<input type="hidden" name="Sum" value="' . $a['sum'] . '" data-type="number">';

            //Идентификатор плательщика в ИС Контрагента. В качестве идентификатора может использоваться номер договора плательщика, логин плательщика и т. п. Возможна повторная оплата по одному и тому же идентификатору плательщика
            $html .= '<input type="hidden" name="customerNumber" value="' . $a['customer'] . '" >';

            //не обязательные поля
            $html .= '<input type="hidden" name="orderNumber" value="' . $a['order'] . '">';
            $html .= '<input type="hidden" name="event" value="' . $a['event'] . '">';
            //$html.='<input type="hidden" name="paymentType" value="'.$this->pay_method.'" />';

            //Адрес электронной почты плательщика. Если он передан, то соответствующее поле на странице подтверждения платежа будет предзаполнен
            // $html .= '<input name="cps_email" value="' . $a['email'] . '" type="hidden"/>';

            //PC - Оплата из кошелька в Яндекс.Деньгах.
            //AC - Оплата с произвольной банковской карты.
            //MC - Платеж со счета мобильного телефона.
            //GP - Оплата наличными через кассы и терминалы.
            //WM - Оплата из кошелька в системе WebMoney.
            //SB - Оплата через Сбербанк: оплата по SMS или Сбербанк Онлайн.
            //MP - Оплата через мобильный терминал (mPOS).
            //AB - Оплата через Альфа-Клик.
            //МА - Оплата через MasterPass.
            //PB - Оплата через Промсвязьбанк.
            $html .= '
             <div class="pays">
                    <div class="oplata-yandex-img">
                        <img src="/images/pays/visa.png">
                        <img src="/images/pays/mastercard.png">
                        <img src="/images/pays/ya.png">
                    </div>
                 <p><b>Способ оплаты: </b></p>
                    <p><label><input type="radio" name="paymentType" value="AC" checked >Банковская карта</label></p>
                    <p><label><input type="radio" name="paymentType" value="PC" >Яндекс деньги</label></p>
                 </div>
                <hr>
            ';

            //собственный

            $html .= '<p class="text-center"><button class="btn custom-black-btn1" type="submit">Оплатить</button></p>';
            $html .= '</form>
            </div>';
        } else {
            /*
            $html='<form method="POST" action="'.$this->getFormUrl().'"  id="paymentform" name = "paymentform">
               <input type="hidden" name="receiver" value="'.$this->account.'">
               <input type="hidden" name="formcomment" value="Order '.$this->orderId.'">
               <input type="hidden" name="short-dest" value="Order '.$this->orderId.'">
               <input type="hidden" name="writable-targets" value="'.$this->writable_targets.'">
               <input type="hidden" name="comment-needed" value="'.$this->comment_needed.'">
               <input type="hidden" name="label" value="'.$this->orderId.'">
               <input type="hidden" name="quickpay-form" value="'.$this->quickpay_form.'">
               <input type="hidden" name="payment-type" value="'.$this->pay_method.'">
               <input type="hidden" name="targets" value="Заказ '.$this->orderId.'">
               <input type="hidden" name="sum" value="'.$this->orderTotal.'" data-type="number" >
               <input type="hidden" name="comment" value="'.$this->comment.'" >
               <input type="hidden" name="need-fio" value="'.$this->need_fio.'">
               <input type="hidden" name="need-email" value="'.$this->need_email.'" >
               <input type="hidden" name="need-phone" value="'.$this->need_phone.'">
               <input type="hidden" name="need-address" value="'.$this->need_address.'">
            </form>';
            */
        }
        return $html;
    }

    public function checkSign($callbackParams)
    {
        $order = Orders::findOne($callbackParams['orderNumber']);
        // Тут мы получаем заказ по номеру

        if (!$order || $order->status == 1) return false;
        //тут мы проверяем если заказа с таким номеро нет или он уже оплачен то посылаем нахуй сразу же.

        $format_price = number_format($order->price, 2, '.', '');
        //тут я форматирую стоимость заказа в такой формат (4000.00) . Да, именно такой формат нужен.


        $string = $callbackParams['action'] . ';' . $format_price . ';' . $callbackParams['orderSumCurrencyPaycash'] . ';' . $callbackParams['orderSumBankPaycash'] . ';' . $callbackParams['shopId'] . ';' . $callbackParams['invoiceId'] . ';' . $callbackParams['customerNumber'] . ';' . $this->password;
        //И теперь именно ту стоимость которая должна быть, которую мы вытащили из базы мы сравниваем, а не ту,
        //которую нам прислал яндекс (которую я могу подменить через DOM дерево)
        $md5 = strtoupper(md5($string));
        return ($callbackParams['md5'] == $md5);
    }

    //возмо.но пригодится (используется в каких то cms)
    //header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    //header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    //header("Cache-Control: no-store, no-cache, must-revalidate");
    //header("Cache-Control: post-check=0, pre-check=0", false);
    //header("Pragma: no-cache");

    public function sendAviso($callbackParams, $code)
    {
        header("Content-type: text/xml; charset=utf-8");
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
			<paymentAvisoResponse performedDatetime="' . date("c") . '" code="' . $code . '" invoiceId="' . $callbackParams['invoiceId'] . '" shopId="' . $this->shopid . '"/>';

        echo $xml;
    }

    public function sendCode($callbackParams, $code)
    {
        header("Content-type: text/xml; charset=utf-8");
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
			<checkOrderResponse performedDatetime="' . date("c") . '" code="' . $code . '" invoiceId="' . $callbackParams['invoiceId'] . '" shopId="' . $this->shopid . '"/>';
        echo $xml;
    }


    public function checkOrder($callbackParams, $sendCode = FALSE, $aviso = FALSE)
    {

        if ($this->checkSign($callbackParams)) {
            $code = 0;
        } else {
            $code = 1;
        }

        if ($sendCode) {
            if ($aviso) {
                $this->sendAviso($callbackParams, $code);
            } else {
                $this->sendCode($callbackParams, $code);
            }
            exit;
        } else {
            return $code;
        }
    }

    public function individualCheck($callbackParams)
    {
        $string = $callbackParams['notification_type'] . '&' . $callbackParams['operation_id'] . '&' . $callbackParams['amount'] . '&' . $callbackParams['currency'] . '&' . $callbackParams['datetime'] . '&' . $callbackParams['sender'] . '&' . $callbackParams['codepro'] . '&' . $this->password . '&' . $callbackParams['label'];
        $check = (sha1($string) == $callbackParams['sha1_hash']);
        if (!$check) {
            header('HTTP/1.0 401 Unauthorized');
            return false;
        }
        return true;
    }

    /*
    public function ProcessResult(){
        $callbackParams = $_POST;
        $order_id = false;
        if ($this->org_mode){
            if ($callbackParams['action'] == 'checkOrder'){//Проверка заказа
                $code = $this->checkOrder($callbackParams);
                $this->sendCode($callbackParams, $code);
                $order_id = (int)$callbackParams["orderNumber"];
            }
            if ($callbackParams['action'] == 'paymentAviso'){//Уведомление о переводе
                $this->checkOrder($callbackParams, TRUE, TRUE);
            }
        }else{
            $check = $this->individualCheck($callbackParams);
            if (!$check){
            }else{
                $order_id = (int)$callbackParams["label"];
            }
        }

        return $order_id;
    }
    */

    //start MAIN
    public function respond()
    {
        $callbackParams = $_REQUEST;

        //$text=print_r($callbackParams,TRUE);
        //mysql_query("INSERT INTO `mod_catalog_payment_debug` (`text`,`datetime`)
        //VALUES ('".Sql($text)."',NOW()) ");

        $order_id = FALSE;
        if ($this->org_mode) {
            //Проверка заказа (деньги списаны)
            if ($callbackParams['action'] == 'checkOrder') {
                $this->checkOrder($callbackParams, TRUE, FALSE);
            }
            //Уведомление о переводе (деньги списаны и перечислены на наш счет),
            //лучше фиксировать оплату на этом этапе так как на этапе CheckOrder могут деньги вернутся обратно
            if ($callbackParams['action'] == 'paymentAviso') {

                $code = $this->checkOrder($callbackParams);

                if (!$code) {
                    if ($this->orderpay($callbackParams)) {
                        $order_id = $callbackParams["orderNumber"];
                        $code = 0;
                    } else {
                        $code = 1;
                    }
                }


                $this->sendAviso($callbackParams, $code);
            }
        } else {
            $check = $this->individualCheck($callbackParams);
            if (!$check) {
            } else {
                $order_id = (int)$callbackParams["label"];
            }
        }
        return $order_id;
    }


    //MAIN
    public function orderpay($callbackParams)
    {
        $order_id = $callbackParams["orderNumber"];
        $payment_id = $callbackParams['invoiceId'];
        $payment_type = $callbackParams['paymentType'];
        $event = $callbackParams['event'];
        if ($event == 'cream') {
            //если оплата магазина
            $model = Orders::findOne($order_id);
            $model->status = 1;
            $model->save();
            Functions::raspred1($model);
        }
        return TRUE;
    }

    public function sendmail($from, $to, $subject, $message)
    {
        //$headers="From: ".$from."\n";
        $headers = "From: " . PHOST2 . " <" . $from . ">\n";
        $headers .= "Content-Type:text/html; charset=utf-8";

        $result = mail($to, $subject, $message, $headers);
        return $result;
    }


}

?>