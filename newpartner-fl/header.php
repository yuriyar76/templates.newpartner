<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $USER;
use Bitrix\Main\Localization\Loc;
$id_user = $USER->GetID();
$arGroups = CUser::GetUserGroup($id_user);
$access=false;
foreach($arGroups as $value){
    if($value=='29'){
        $access = true;
        break;
    }
}
if(!$access){
    header("location:/");
    exit;
}

$params_user = CUser::GetByID($id_user);
$arResult['PERSONAL_PHONE'] = $params_user->arResult[0]['PERSONAL_PHONE'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?=LANG_CHARSET?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php $APPLICATION->ShowTitle(); ?></title>

    <!-- Custom fonts for this template-->
    <link href="/bitrix/templates/newpartner-fl/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/bitrix/templates/newpartner-2016/css/jquery-ui.css" rel="stylesheet">
    <link href="/bitrix/templates/newpartner-fl/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/bitrix/templates/newpartner-fl/css/styles.css" rel="stylesheet">

    <script>

        function auto_city_send(id){
            $('#city_'+id).autocomplete({
                source: '/api.php?type=city&form=calc',
                minLength: 0,
                select: function( event, ui ) {
                    $(this).val( ui.item.value);
                    $('#citycode_'+id).val( ui.item.id);
                    return false;
                }
            });
            console.log(id);
        }

        function delItem(id, sess_id){
            let url = '/tools/change_user_fl.php?delete=Y';
            let data = {
                id: id,
                sess_id: sess_id
            };
            $.post(url, data, function(res){
                //let data = JSON.parse(res);
                //console.log(res);
                location.reload();
            });
        }
/* функция если нет возможности использовать форму */
        function editItem(id_f){
            let elem = $('#'+id_f+' .modal-body').find('input');
            let arr = {};
            for(let i=0; i<elem.length; i++){
                let name = $(elem[i]).attr('name');
                arr[name] = $(elem[i]).val();
            }
           // console.log(arr);
            let $fData = JSON.stringify(arr);

            $.ajax({
                url: '/tools/change_user_fl.php?edit=Y',
                type: 'post',
                data: {form_data: $fData},
                dataType: 'json',
                success: function(json){
                    //console.log(json);
                    if(!json.change){
                       // console.log(json.id);
                        let id = json.id;
                        let id_modal = $('#'+id+' .err_edit');
                        id_modal.empty();
                        id_modal.append( `
                          <div class="alert alert-danger" role="alert">
                           ${json.messerr}
                          </div>
                          `);
                    }else{
                        location.reload();
                    }

                    //
                }
            });
            //console.log(arr);

        }

       /* функция если есть форма */
        function editItem_old(id_f, id_s) {
            console.log(id_f+'  '+id_s);
            $('#'+id_f).on('submit', function(e){
                e.preventDefault();
                let $that = $(this),
                    fData = $that.serializeArray();
                $.ajax({
                    url: $that.attr('action'),
                    type: $that.attr('method'),
                    data: {form_data: fData},
                    dataType: 'json',
                    success: function(json){

                       if(!json.change){
                           console.log(json.id);
                          let id = json.id;
                          let id_modal = $('#'+id+' .err_edit');
                          id_modal.empty();
                          id_modal.append( `
                          <div class="alert alert-danger" role="alert">
                           ${json.messerr}
                          </div>
                          `);
                       }else{
                           location.reload();
                       }

                       //
                    }
                });
            });
            $('#'+id_s).click();
        }

        function getval(sel, name, phone, adress) {
            let sdn = $.cookie('ds_name');
            let sdp = $.cookie('ds_phone');
            let sda = $.cookie('ds_adr');
            let rdn = $.cookie('dr_name');
            let rdp = $.cookie('dr_phone_name');
            let rda = $.cookie('dr_adr');
            let cookies = document.cookie;
            let arrc = cookies.split(';');
            let re = new RegExp("[a-z]{2}_[a-z]{2,4}_[0-9]+=.+");
            let arrcv = [];
            for(let i=0; i<arrc.length; i++){
               if( re.test(arrc[i])){
                arrcv[i] = arrc[i].split('=');
               }
            }
            //console.log(arrcv);

            let select = sel.value;

            let name_input = $('#modal_order_service_form_pay input[name=form_text_50]');
            let phone_input = $('#modal_order_service_form_pay input[name=form_text_51]');
            let adress_input = $('#modal_order_service_form_pay textarea[name=form_textarea_56]');


            let name_input_2 = $('#modal_order_service_form_pay input[name=form_text_62]');
            let phone_input_2 = $('#modal_order_service_form_pay input[name=form_text_149]');
            let adress_input_2 = $('#modal_order_service_form_pay textarea[name=form_textarea_103]');

            let sel_name_wrap_sender = $('#sender_name_select_wrap');
            let input_name_sender = $('#sender_name_select');
            let sel_name_wrap_recipient = $('#recipient_name_select_wrap');
            let input_name_recipient = $('#recipient_name_select');

            let type_pay =  $('#form_dropdown_pay');
            let option_pay_bank = $("#form_dropdown_pay option[value='61']");
            let option_pay_cache = $("#form_dropdown_pay option[value='59']");

            let payment_wrap = $('#form_dropdown_payment_wrap');
            let payment_type = $('#form_dropdown_payment');


            if(select == '102'){                           /* Отправителем */

                sel_name_wrap_sender.attr('style', 'display:none');
                input_name_sender.attr('disabled','disabled');
                sel_name_wrap_recipient.attr('style', 'display:block');
                input_name_recipient.removeAttr('disabled');
                name_input.val(name);
                phone_input.val(phone);
                adress_input.val(adress);
                name_input.attr('disabled','disabled');
                phone_input.attr('disabled','disabled');
                adress_input.attr('disabled','disabled');


                name_input_2.removeAttr('disabled');
                phone_input_2.removeAttr('disabled');
                adress_input_2.removeAttr('disabled');

                if(rdn) {name_input_2.val(rdn);}
                if(rdp) {phone_input_2.val(rdp);}
                if(rda) {adress_input_2.val(rda);}

                type_pay.removeAttr('disabled');
                payment_wrap.attr('style', 'display:none');
                payment_type.attr('disabled','disabled');

                /* options */
                if(arrcv.length > 0){
                  $.each(arrcv, function (index, value) {
                      if(value){
                          console.log(value[0]+' '+value[1]);
                      }

                  });
                }


            }
            if(select == '121'){                              /* Получателем */
                input_name_recipient.attr('disabled','disabled');
                sel_name_wrap_recipient.attr('style', 'display:none');
                sel_name_wrap_sender.attr('style', 'display:block');
                input_name_sender.removeAttr('disabled');
                name_input_2.val(name);
                phone_input_2.val(phone);
                adress_input_2.val(adress);
                name_input_2.attr('disabled','disabled');
                phone_input_2.attr('disabled','disabled');
                adress_input_2.attr('disabled','disabled');


                name_input.removeAttr('disabled');
                phone_input.removeAttr('disabled');
                adress_input.removeAttr('disabled');
                if(sdn) {name_input.val(sdn);}
                if(sdp) {phone_input.val(sdp);}
                if(sda) {adress_input.val(sda);}

                type_pay.removeAttr('disabled');
                payment_wrap.attr('style', 'display:none');
                payment_type.attr('disabled','disabled');


            }
            if(select == 'creator'){                            /* Заказчиком */


                name_input.removeAttr('disabled');
                phone_input.removeAttr('disabled');
                adress_input.removeAttr('disabled');


                name_input_2.removeAttr('disabled');
                phone_input_2.removeAttr('disabled');
                adress_input_2.removeAttr('disabled');

                option_pay_bank.attr("selected", "selected");
                option_pay_cache.removeAttr('selected');

                type_pay.attr('disabled','disabled');

                sel_name_wrap_sender.attr("style", "display:block");
                input_name_sender.removeAttr('disabled');

                sel_name_wrap_recipient.attr("style", "display:block");
                input_name_recipient.removeAttr('disabled');

                payment_wrap.attr('style', 'display:block');
                payment_type.removeAttr('disabled');


            }
        }

        function getidval (id){
           let idel = +id.value;
           let url = "/tools/change_user_fl.php";
           let data = {
                 getid: idel
           };
           $.get(
               url,
               data,
               function (data) {
                   let res =  JSON.parse(data);
                   if(res.TYPE_ID == '415'){
                       $("#modal_order_service_form_pay input[name=form_text_62]").val(res.NAME);
                       $("#modal_order_service_form_pay textarea[name=form_textarea_103]").val(res.ADRESS);
                       $("#modal_order_service_form_pay input[name=form_text_149]").val(res.PHONE);

                   }
                   if(res.TYPE_ID == '414'){
                       $("#modal_order_service_form_pay input[name=form_text_50]").val(res.NAME);
                       $("#modal_order_service_form_pay textarea[name=form_textarea_56]").val(res.ADRESS);
                       $("#modal_order_service_form_pay input[name=form_text_51]").val(res.PHONE);

                   }
                   console.log(res);
           });
        }

        function setpayment(pay){
            let type_pay =  $('#form_dropdown_pay');
            let option_pay_bank = $("#form_dropdown_pay option[value='61']");
            let option_pay_cache = $("#form_dropdown_pay option[value='59']");
            type_pay.attr('disabled','disabled');
            if(pay.value === 'sender_pay' || pay.value === 'recipient_pay'){
                option_pay_cache.attr("selected", "selected");
                option_pay_bank.removeAttr('selected');

            }

            if(pay.value === 'creator_pay'){
                option_pay_cache.removeAttr('selected');
                option_pay_bank.attr("selected", "selected");


            }

        }

        function banItem(id, key){
            let url = '/tools/change_user_fl.php?ban=Y';
            let data = {
                id: id,
                key: key
            };
            $.post(url, data, function(res){
                let data = JSON.parse(res);
                let el = $('#radio_'+data.key);
                el.removeAttr('checked');
                //console.log(el);

            });
        }


    </script>

    <?php $APPLICATION->ShowHead();?>
</head>

<body id="page-top">
<div id="p_prldr">
    <div class="contpre">
        <span class="svg_anm"></span>
    </div>
</div>

<div id="p_prldr_track">
    <div class="contpre_track">
        <span class="svg_anm_track"></span>
    </div>
</div>

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <!--<div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>-->
            <div class="sidebar-brand-text mx-3">Новый Партнер</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/customers-lk/?add=Y">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Панель управления</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item">
            <a class="nav-link" href="/customers-lk/">
                <i class="fas fa-fw fa-table"></i>
                <span>Заявки</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/customers-lk/?arch=Y">
                <i class="fas fa-fw fa-table"></i>
                <span>Архив</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/customers-lk/?add=Y">
                <i class="fas fa-fw fa-table"></i>
                <span>Новая Заявка</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Адреса</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Справочник адресов:</h6>
                    <a class="collapse-item" href="/customers-lk/?sender_add=Y">Отправители</a>
                    <a class="collapse-item" href="/customers-lk/?recipient_add=Y">Получатели</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="" data-toggle="modal" data-target="#fl_profile">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Профиль</span></a>
        </li>
        <!-- Nav Item - Utilities Collapse Menu -->


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <h1 class="h3 mb-2 text-gray-800"><?=$USER->GetFirstName()?></h1>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder=
                                    "Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>



                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$USER->GetLogin()?></span>
                            <img class="img-profile rounded-circle" src="/bitrix/templates/newpartner-fl/img/nobody_m.1024x1024-1.jpg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#fl_profile">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i><?= Loc::getMessage("NEWPARTNER_FL_PROFILE") ?></a>

                            <div class="dropdown-divider"></div>
                            <a id="logout_profile" class="dropdown-item" href="?logout=Y" >
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Выход
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
