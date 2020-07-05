<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
header('Content-Type: text/html; charset=utf-8');

include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/components/black_mist/delivery.packages/functions.php");

AddToLogs('REQUESTS_SBER', $_GET);
if($_GET['status']==1){
    $number_file = preg_replace('/^[^0-9]+-/','',$_GET['orderNumber']);
    $number_file = trim($number_file);
    $arrInfDocs = [];
    include $_SERVER['DOCUMENT_ROOT']."/docs/invoice/data_invoice_$number_file.php";
    $id_partner = 27122866;

    if(is_array($arrInfDocs)){
        $arData =  $arrInfDocs;
        //AddToLogs('ardata', [$arData]);
        $city_from_id_data = iconv("utf-8","windows-1251",$arData[3]);
        $city_to_id_data = iconv("utf-8","windows-1251",$arData[8]);
        $city_from_id = GetCityId(htmlspecialcharsEx($city_from_id_data));
        $city_to_id = GetCityId(htmlspecialcharsEx($city_to_id_data));
        $city_from_id = iconv("windows-1251","utf-8",$city_from_id);
        $city_to_id = iconv("windows-1251","utf-8",$city_to_id);
        $date_take = substr($arData[6], 6, 4).'-'.substr($arData[6], 3, 2).'-'.substr($arData[6], 0, 2).' '.$arData[7].':00';
        $instr =$arData[12].' Оплачено в сумме - '.$arData[14];
        //$id_invoice = preg_replace('/^ФЛ-/', '', htmlspecialcharsEx($arData[13]) );
        $id_invoice  = $number_file;
        if( htmlspecialcharsEx(trim($arData[15])) == 'R')
        {
            $phone_major =  htmlspecialcharsEx($arData[11]);
            $name_dev = htmlspecialcharsEx($arData[10]);
            $delivery_p = 'О';
        }elseif(htmlspecialcharsEx(trim($arData[15])) == 'S')
        {
            $phone_major =  htmlspecialcharsEx($arData[1]);
            $name_dev = htmlspecialcharsEx($arData[0]);
            $delivery_p = 'П';
        }
        $data = array(
            'ID' => 'B-'.$id_invoice,
            'DATE_CREATE' => date('Y-m-d H:i:s'),
            'INN' => $id_partner,
            'NUMBER' => htmlspecialcharsEx($arData[13]),
            'NAME' => $name_dev,
            'MAIL_PAYER' => htmlspecialcharsEx($arData[2]),
            'NAME_SENDER' => htmlspecialcharsEx($arData[0]),
            'PHONE_SENDER' => htmlspecialcharsEx($arData[1]),
            'COMPANY_SENDER' => "",
            'CITY_SENDER' => (int)$city_from_id,
            'INDEX_SENDER' => '',
            'ADRESS_SENDER' => htmlspecialcharsEx($arData[4]),
            'NAME_RECIPIENT' =>  htmlspecialcharsEx($arData[10]),
            'PHONE_RECIPIENT' => htmlspecialcharsEx($arData[11]),
            'COMPANY_RECIPIENT' => '',
            'CITY_RECIPIENT' => (int)$city_to_id,
            'INDEX_RECIPIENT' => '',
            'ADRESS_RECIPIENT' => htmlspecialcharsEx($arData[9]),
            'DATE_TAKE_FROM' => htmlspecialcharsEx($date_take),
            'DATE_TAKE_TO' =>htmlspecialcharsEx($date_take),
            'TYPE' => 'Не документы',
            'DELIVERY_TYPE' => 'С',
            'DELIVERY_PAYER' => $delivery_p,
            'PAYMENT_TYPE' => 'Банковская карта',
            'DELIVERY_CONDITION' => 'А',
            'PAYMENT_AMOUNT' => (float) preg_replace('/[^0-9]+/', '', htmlspecialcharsEx($arData[14]) ),
            'PAYMENT_STATUS' => 1,
            'INSTRUCTIONS' => htmlspecialcharsEx($instr),
            'PLACES' => 1,
            'WEIGHT' => (float) htmlspecialcharsEx($arData[5]),
            'SIZE_1' => 0,
            'SIZE_2' => 0,
            'SIZE_3' => 0,
        );
        AddToLogs('ardata', [$data]);

        /* массив для чека */
        $arParamsCheck = [
            "DocNumber"=>'',
            "DocZNumber"=> htmlspecialcharsEx($arData[13]),
            "isGoods"=>0,
            "PaymentType"=>1,
            "CheckEmail"=> htmlspecialcharsEx($arData[2]),
            "CheckPhone"=>$phone_major,
            "Goods"=>[
                "Good_0"=>[
                    "GoodsName"=>"Сумма к оплате",
                    "GoodsCount"=>1,
                    "GoodsPrice"=>(int)htmlspecialcharsEx($arData[14]),
                    "GoodsSum"=>(int)htmlspecialcharsEx($arData[14]),
                    "GoodsNDS"=>0,
                    "GoodsSumNDS"=>0
                ],
            ],
        ];
        $arParamsJsonCheck = array(
            'PaymentType'=>2,
            'ListOfDocs' => json_encode($arParamsCheck)
        );
        //  {"DocNumber":"99-4885033","DocZNumber":"","isGoods":0,"PaymentType":1,"CheckEmail":"","CheckPhone":"","Goods":{"Good_0":{"GoodsName":"Сумма к оплате","GoodsCount":1,"GoodsPrice":390,"GoodsSum":390,"GoodsNDS":"0","GoodsSumNDS":0}}}

        $client = soap_inc();

            if(is_object($client)){
                $result = $client->SetNewCheck ($arParamsJsonCheck);
                $chResult = $result->return;
                if(isset($chResult['NUMBER'])){
                    $data['NUMBER_CHECK'] = $chResult['NUMBER'];
                }
                AddToLogs('OrdersResultCheck',array('Response' => $chResult));
            }else{
                AddToLogs('OrdersResultCheck',array('ERROR' => $client));
            }
       // if(!$USER->isAdmin()){
        $arJson[] = $data;
        $arJsonSend =$arJson;
        $arParamsJson = array(
            'type' => 2,
            'ListOfDocs' => json_encode($arJsonSend)
        );
        AddToLogs('Orders', array('json' => json_encode($arJsonSend)));
            if(is_object($client)){
                $result = $client->SetDocsList($arParamsJson);
                $mResult = $result->return;
                AddToLogs('OrdersResult',array('Response' => $mResult, 'NUMBER' => $data['NUMBER'], 'NAME' => $name_dev));
            }else{
                AddToLogs('OrdersResult',array('ERROR' => $client));
            }


        //}

    }
    /* автоматическая авторизация */

    //AddToLogs('dataWin', [$dataWin]);
    $new_password = randString(7);
    $pass = $new_password;
    $login = $data['MAIL_PAYER'];
    $email = $data['MAIL_PAYER'];

    if( htmlspecialcharsEx($data[15]) == 'S')
    {
        $phone = $data['PHONE_SENDER'];
        $state = 411;

    }elseif(htmlspecialcharsEx($data[15]) == 'R')
    {
        $phone = $data['PHONE_RECIPIENT'];
        $state = 412;

    }

    $name = $data['NAME'];
    $access = true;
    $arFields = array(
      "NAME" => $name ,
      "LOGIN" => $email,
      "EMAIL" => $email,
      "PERSONAL_PHONE" => $phone,
      "LID" => "ru",
      "ACTIVE" => "Y",
      "PASSWORD" => $pass,
      "CONFIRM_PASSWORD" => $pass,
      "GROUP_ID" => [3,29]
  );
              $rsUser = CUser::GetByLogin($data['MAIL_PAYER']);
              if(!($arUser = $rsUser->Fetch())){
                  /* новый пользователь */
                  $arFields['DESCRIPTION'] = "На сайте newpartner.ru прошла автоматическая регистрация пользователя	при оплате заявки банковской картой из формы на главной.";
                  $arFieldsWIN = arFromUtfToWin($arFields);
                  $user     = new CUser;
                  $new_user_ID = $user->Add($arFieldsWIN);
              }
              
              if($new_user_ID){
                  $arFieldsWIN['USER_ID'] = $new_user_ID;
                  AddToLogs('NewUserFL', ['ID'=>$new_user_ID, 'Login'=>$login, 'pass'=>$pass,
                      'name'=>$arFieldsWIN['NAME']]);
              //   if(!$USER->isAdmin()){
                     $event = new CEvent;
                     /* письмо на модерацию */
                     $event->Send("NEW_USER", "s5", $arFieldsWIN, "N", 293 );
                     /* письмо user`у */
                     //  $event->Send("NEWPARTNER_LK", "s5", $arFields, "N", 294 );
               //  }

              }
              $user_ID = ($new_user_ID)?:$user_ID;
              /* автоматическая авторизация end */
              /* сохранение заявки в базе */
                $format = CSite::GetDateFormat(SHORT);
                $date_time = strtotime($data['DATE_TAKE_TO']);
                $date_to =  date('d.m.Y', $date_time);
                $prop = [
                  957 => $data['ID'],
                  944 => $user_ID,
                  945 => $data['NAME_SENDER'],
                  946 => $data['PHONE_SENDER'],
                  947 => $data['CITY_SENDER'],
                  948 => $data['ADRESS_SENDER'],
                  949 => $data['NAME_RECIPIENT'],
                  950 => $data['PHONE_RECIPIENT'],
                  951 => $data['CITY_RECIPIENT'],
                  952 => $data['ADRESS_RECIPIENT'],
                  953 => $date_to,
                  955 => $data['WEIGHT'],
                  958 => $data['INSTRUCTIONS'].' Дата и время забора - '.$date_take,
                  956 => $state,
                  959 =>$chResult['SUM'],
                  960 => $chResult['NUMBER'],
                  962 => 408
              ];
              $fields = [
                  "ACTIVE_FROM" => date('d.m.Y H:i:s'),
                  "IBLOCK_SECTION_ID" => false,
                  "MODIFIED_BY" => $user_ID,
                  "CREATED_BY" => $user_ID,
                  "IBLOCK_ID" => 113,
                  'NAME'=> $data['NUMBER'],
                  'ACTIVE' => 'Y',
                  "PROPERTY_VALUES" => $prop
              ];
              $arSelect = [
                  "NAME",
                  "IBLOCK_ID",
                  "ID",
                  "PROPERTY_*",
              ];
              $fields = arFromUtfToWin($fields);
              //AddToLogs('newApplication', $fields);
              $arrNewApp = saveIblockElement($fields, $arSelect, true);
              if(!empty($arrNewApp)){
                  AddToLogs('newApplication', $arrNewApp);
              }else{
                  AddToLogs('newApplication', ["ERROR"=>iconv('utf-8', 'windows-1251', "Ошибка добавления заявки")]);
              }
             /* отправка писем */
    if( htmlspecialcharsEx($data[15]) == 'S'){
        $data['CREATOR_NAME_TITLE_SENDER'] = "Отправитель(создал заявку)";
        $data['CREATOR_NAME_TITLE_RECIPIENT'] = "Получатель";
        $data['CREATOR_PHONE_TITLE_SENDER'] = "Телефон Отправителя(создал заявку)";
        $data['CREATOR_PHONE_TITLE_RECIPIENT'] = "Телефон Получателя";
    }elseif ( htmlspecialcharsEx($data[15]) == 'R')
    {
        $data['CREATOR_NAME_TITLE_SENDER'] = "Отправитель";
        $data['CREATOR_NAME_TITLE_RECIPIENT'] = "Получатель (создал заявку)";
        $data['CREATOR_PHONE_TITLE_SENDER'] = "Телефон Отправителя";
        $data['CREATOR_PHONE_TITLE_RECIPIENT'] = "Телефон Получателя(создал заявку)";
    }
             $event = new CEvent;
             /* письмо нам */
                $data['DESC'] = "Заказчик $name_dev оформил заявку {$data['NUMBER']} на сайте newpartner.ru на главной из формы Калькулятор (оплата картой)";
                $data['SUBJECT'] = "Заказчик $name_dev оформил заявку {$data['NUMBER']}";
                $data['MAIL_TO'] = "info@newpartner.ru";
                $event->SendImmediate("NEWPARTNER_LK", "s5", $data, "N", 295);

             /* письмо клиенту */
                $data_app['MAIL_TO'] = $data['MAIL_PAYER'];
                $data_app['DESC'] = "Уважаемый(ая) $name_dev! На сайте 'Новый партнер' Вы оформили заявку на доставку №{$data['NUMBER']}.
                 Телефон для справок - +7 495 663-99-18 8-800-55-123-89";
                $data_app['SUBJECT'] = "Заявка на доставку №{$data['NUMBER']} \"Новый партнер\"" ;
                $event->SendImmediate("NEWPARTNER_LK", "s5", $data, "N", 295);
           }
else
{
    $clientw = soap_inc();
    if(is_object($clientw)){
        $d_p =  htmlspecialcharsEx($_COOKIE['pay_form_radio_SIMPLE_QUESTION_971']);
        if($d_p==102){
            $delivery_payment = 'S';
        }elseif($d_p==121){
            $delivery_payment = 'R';
        }
        $city_send = htmlspecialcharsEx($_COOKIE['pay_form_text_hidden55']);
        $city_recipient =  htmlspecialcharsEx($_COOKIE['pay_form_text_hidden57']);
        $date_delivery = htmlspecialcharsEx($_COOKIE['pay_form_text_53']);
        $weight = htmlspecialcharsEx($_COOKIE['pay_form_text_hidden58']);
        $phone_send = htmlspecialcharsEx($_COOKIE['pay_form_text_51']);
        $sum_pay = htmlspecialcharsEx($_COOKIE['pay_price_calc']);
        $mail_send = htmlspecialcharsEx($_COOKIE['pay_form_email_52']);
        $sender_name = htmlspecialcharsEx($_COOKIE['pay_form_text_50']);
        $sender_address = htmlspecialcharsEx($_COOKIE['pay_form_textarea_56']);
        $time = htmlspecialcharsEx($_COOKIE['pay_form_text_54']);
        $recipient_address = htmlspecialcharsEx($_COOKIE['pay_form_textarea_103']);
        $recipient_name = htmlspecialcharsEx($_COOKIE['pay_form_text_62']);
        $phone_recipient = htmlspecialcharsEx($_COOKIE['pay_form_text_149']);
        $desc = htmlspecialcharsEx($_COOKIE['pay_form_textarea_61']);
        $arrInf = [$sender_name, $phone_send, $mail_send, $city_send, $sender_address, $weight, $date_delivery,
            $time, $city_recipient, $recipient_address, $recipient_name, $phone_recipient, $desc, $sum_pay, $delivery_payment
        ];
        $sum_pay_send = $_COOKIE['pay_price_calc'];
        $id_partner = 27122866;
        $arParamsJsonw = array('INN' => $id_partner);
        $resultw = $clientw->GetPrefixAgent1($arParamsJsonw);
        $mResultw = $resultw->return;
        $objw = json_decode($mResultw, true);
        $number = $objw['Prefix_'.$id_partner];
        $number_pay = $objw['Prefix_'.$id_partner];
        $number_file = preg_replace('/^[^0-9]+-/', '', $number_pay );
        $number_file =  trim($number_file);
        $arrInf[] =$number;
        $data = '<?$arrInfDocs ='."['{$sender_name}', 
                            '{$phone_send}', '{$mail_send}', '{$city_send}', 
                            '{$sender_address}', '{$weight}', '{$date_delivery}',
                            '{$time}', '{$city_recipient}', '{$recipient_address}',
                            '{$recipient_name}', '{$phone_recipient}',
                            '{$desc}', '{$number}', '{$sum_pay}', '{$delivery_payment}'
                             ];";
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/docs/invoice/data_invoice_$number_file.php", $data );
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/bitrix/templates/newpartner-payment/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://securepayments.sberbank.ru/payment/docsite/assets/js/ipay.js"></script>
    <script>
        var ipay = new IPAY({api_token: 'fsinfps7lsvajfet45348sf22'});
    </script>
    <?//$APPLICATION->ShowHead();?>
</head>
<body>