$(document).ready(function() {
    $("#btn_modal_cost").on('click', function(){
        $('.alert.alert-danger.display-error').css('display', 'none');
        $('#price_calc_p').css('display', 'block');
        let cost_from = $("#cost_from span").text();
        let cost_to = $("#cost_to span").text();
        let cost_tarif =  $("#cost_tarif span").text();
        let cost_weight = $("#cost_weight span").text();
        $('#city_to5').attr({value:cost_from, disabled: true});
        $('#city_to_hidden5').attr('value',cost_from);
        $('#city_from5').attr({value:cost_to, disabled: true});
        $('#city_from_hidden5').attr('value',cost_to);
        $('#form_text_weight').attr({value:cost_weight, disabled: true});
        $('#form_text_weight_hidden').attr('value',cost_weight);
        $('#price_calc').attr('value',cost_tarif);
        $('#price_calc_p span').text(cost_tarif);
        $('#modal_calculate_cost_new').modal('hide');
        $('#modal_order_service_pay').modal('show');

    });
    $("#calc_form").submit(function( event ) {
        event.preventDefault();
        let fields = $(this).serializeArray();
        let msgerr = '';
        $('#modal_calculate_cost_new .modal-body .list-group').remove();
        $('#modal_calculate_cost_new .modal-content .display-error .messerr').remove();

        $.ajaxSetup({cache: false});
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/tools/calc.php?mode=index",
            data: fields,
            success: function(data){
                $.each(data , function (index, value){
                    if(value.ERROR){
                        $.each(value.ERROR , function (index, value){
                            msgerr+= '<span>'+value+'</span></br>';
                            let mserr = `<div class="messerr">${msgerr}</div>`;
                            console.log(mserr);
                            $('#modal_calculate_cost_new .modal-content .display-error').attr('style', 'display:block; margin-bottom:0; margin-top:25px;').append(mserr);
                            $('#modal_calculate_cost_new #payment_module').attr('style', 'display:none;');
                        });
                }else{
                        console.log(value);
                        $('#modal_calculate_cost_new .modal-content .display-error').attr('style', 'display:none');
                        $('#modal_calculate_cost_new #payment_module').attr('style', 'display:block;');
                        let messogr = `<div class="list-group-item list-group-item-action list-group-item-danger">
                             ВНИМАНИЕ! СРОКИ ДОСТАВКИ В СВЯЗИ С ЭПИДЕМИЕЙ КОРОНОВИРУСА МОГУТ БЫТЬ УВЕЛИЧЕНЫ!</div>`;
                   if (value.ID_SENDER == '8054' && value.ID_RECIPIENT == '8054'){
                       $('#modal_calculate_cost_new #payment_module').attr('style', 'display:none;');
                let messmsk = `
                           <div class="list-group">
                 ${messogr}          
                <div class="list-group-item list-group-item-action list-group-item-info"><span style="font-size: 20px">Доставка внутри МКАД</span>, <span style="font-size: 18px; color:#000;">"тариф Стандарт"</span> </div>
                <div class="list-group-item list-group-item-action list-group-item-info">Время доставки:   <span style="font-size: 16px;">${value.TIMEDEV.STANDART}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-info">Полный вес:   <span style="font-size: 16px;">${value.FULLWEIGTH}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-info">Итого тариф:   <span style="font-size: 16px;">${value.TARIF_ITOG_MSK.STANDART} руб.</span></div></div>
                <div class="list-group">
                <div class="list-group-item list-group-item-action list-group-item-success"><span style="font-size: 20px">Доставка внутри МКАД</span>, <span style="font-size: 18px; color:#000;">"тариф Экспресс 8"</span> </div>
                <div class="list-group-item list-group-item-action list-group-item-success">Вызов курьера:   <span style="font-size: 16px;">${value.CALLCOURIER.EXPRESS_8}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-success">Время доставки:   <span style="font-size: 16px;">${value.TIMEDEV.EXPRESS_8}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-success">Полный вес:   <span style="font-size: 16px;">${value.FULLWEIGTH}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-success">Итого тариф:   <span style="font-size: 16px;">${value.TARIF_ITOG_MSK.EXPRESS_8} руб.</span></div></div>
                <div class="list-group">
                <div class="list-group-item list-group-item-action list-group-item-warning"><span style="font-size: 20px">Доставка внутри МКАД</span>, <span style="font-size: 18px; color:#000;">"тариф Экспресс 4"</span> </div>
                <div class="list-group-item list-group-item-action list-group-item-warning">Вызов курьера:   <span style="font-size: 16px;">${value.CALLCOURIER.EXPRESS_4}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-warning">Время доставки:   <span style="font-size: 16px;">${value.TIMEDEV.EXPRESS_4}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-warning">Полный вес:   <span style="font-size: 16px;">${value.FULLWEIGTH}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-warning">Итого тариф:   <span style="font-size: 16px;">${value.TARIF_ITOG_MSK.EXPRESS_4} руб.</span></div></div>
                <div class="list-group">
                <div class="list-group-item list-group-item-action list-group-item-danger"><span style="font-size: 20px">Доставка внутри МКАД</span>, <span style="font-size: 18px; color:#000;">"тариф Экспресс 2"</span> </div>
                <div class="list-group-item list-group-item-action list-group-item-danger">Вызов курьера:   <span style="font-size: 16px;">${value.CALLCOURIER.EXPRESS_2}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-danger">Время доставки:   <span style="font-size: 16px;">${value.TIMEDEV.EXPRESS_2}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-danger">Полный вес:   <span style="font-size: 16px;">${value.FULLWEIGTH}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-danger">Итого тариф:   <span style="font-size: 16px;">${value.TARIF_ITOG_MSK.EXPRESS_2} руб.</span></div></div>                    
                `;
                $('#modal_calculate_cost_new .modal-body').append(messmsk);
                        }else{
                let mess = `<div class="list-group">
                ${messogr}  
                <div id="cost_from" class="list-group-item list-group-item-action list-group-item-success">Откуда:   <span style="font-size: 16px;">${value.SENDER.FULLNAME}</span></div>
                <div id="cost_to" class="list-group-item list-group-item-action list-group-item-success">Куда:   <span style="font-size: 16px;">${value.RECIPIENT.FULLNAME}</span></div>
                <div class="list-group-item list-group-item-action list-group-item-success">Доставка дней:   <span style="font-size: 16px;">${value.TIMEDEV}</span></div>
                <div  id="cost_weight" class="list-group-item list-group-item-action list-group-item-success">Полный вес:   <span style="font-size: 16px;">${value.FULLWEIGTH}</span></div>
                <div id="cost_tarif" class="list-group-item list-group-item-action list-group-item-success">Итого тариф:   <span style="font-size: 18px;">${value.TARIF_ITOG} руб.</span></div></div>`;
                $('#modal_calculate_cost_new .modal-body').append(mess);

                  }
                }
                });
                $('#modal_calculate_cost_new').modal('show');
                }
            });
        });
    // форма соискателя работы курьером
    $("#courier_mess_submit").on('click', function(){
        $("#mess_err").remove();
        let req   = $('#courier_mess_form').serialize();
        //console.log(req);
        //$.ajaxSetup({cache: false});
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: "/mess_courier.php?mode=new",
            data: req,
            success: function(data){
                let msg = "";
                let  msgs = "";
                let mess = "";
                $.each(data , function (index, value){
                    console.log(value);
                    if(value.err){
                        msg += value.err+'<br>';
                    }else{
                        msgs = value;
                    }

                });
                if(msg){
                    mess = `<div id="mess_err" class="alert alert-danger" role="alert">${msg}</div>`;
                    $('#courier_mess_submit').removeAttr('disabled');
                }
                if(msgs){
                    mess = `<div id="mess_err" class="alert alert-success" role="alert">${msgs}</div>`;
                    $('#courier_mess_submit').attr('disabled', 'true');
                }
                $('#courier_mess_form').append(mess);
            }
        });
    });

    $("#hr_mess_form").on('submit', function(e){
        e.preventDefault();
        var $that = $(this),
        formData = new FormData($that.get(0));
        $("#mess_err").remove();
        //let req   = $('#hr_mess_form').serialize();
        //console.log(req);
        //$.ajaxSetup({cache: false});
        $.ajax({
            contentType: false,
            processData: false,
            method: 'post',
            dataType: 'json',
            url: "/mess_hr.php?mode=new",
            data: formData,
            success: function(data){
                console.log(data);
                let msg = "";
                let  msgs = "";
                let mess = "";
                $.each(data , function (index, value){
                    console.log(value);
                    if(value.err){
                        msg += value.err+'<br>';
                    }else{
                        msgs = value;
                    }

                });
                if(msg){
                    mess = `<div id="mess_err" class="alert alert-danger" role="alert">${msg}</div>`;
                    $('#hr_mess_submit').removeAttr('disabled');
                }
                if(msgs){
                    mess = `<div id="mess_err" class="alert alert-success" role="alert">${msgs}</div>`;
                    $('#hr_mess_submit').attr('disabled', 'true');
                }
                $('#hr_mess_form').append(mess);

            }
        });
    });

});
/* функции калькулятора */
function  DeletePlace(id){
    $('#row'+id).remove();
    let t = $('table tbody tr');
    //let lastId = t.eq(-1).attr('id');
    //$('#'+lastId+' .hidden').css('display', 'block');
}
function CopyPlace(id){
    let idn = $('table tbody tr').last().attr('id');
    if(idn.length === 3 ){
        idn = idn[3];
    }else{
        idn = Number(idn.replace(/\D+/g,""))
    }

    let idnew = +idn+1;
    let info =  $('#row'+id+' td input');
    let inp = [];
    for (let i = 0; i < info.length; i++) {
        inp[i] = info[i].value;
    }
    let content = `<tr id="row${idnew}">
                    <td width="100"><input type="number" class="r1" value="${inp[0]}" name="r1[]" min="0"></td>
                    <td width="100"><input type="number" class="r2" value="${inp[1]}" name="r2[]" min="0"></td>
                    <td width="100"><input type="number" class="r3" value="${inp[2]}" name="r3[]" min="0"></td>
                    <td width="100"><input type="text" class="ves" value="${inp[3]}" name="ves[]" ></td>
                    <td  width="100" style="text-align:right;">
                       <div class="wrbt">
                           <div class="place_delete" onClick="return DeletePlace('${idnew}')" title="Удалить место">-</div>
                           <div class="place_add_copy" onClick="return CopyPlace('${idnew}')" title="Добавить копированием"> <i class="fa fa-clone" aria-hidden="true"></i></div>
                       </div>
                    </td>
                    </tr>`;
    $('table tbody').append(content);
    //console.log(inp);
}
function AddNewPlace(id)
{
    let idn = $('table tbody tr').last().attr('id');
    if(idn.length === 3 ){
        idn = idn[3];
    }else{
        idn = Number(idn.replace(/\D+/g,""))
    }
    let idnew = +idn+1;
    if(id=='1'){
        $('.place_add').css('display', 'none');
    }
    $('#row1 .wrbt .place_add').remove();
    $('#row1 .wrbt .place_add_copy').remove();
    let cont = ` <div class="place_add" onClick="return AddNewPlace('${idnew}')" title="Добавить еще место">+</div>
                     <div class="place_add_copy" onClick="return CopyPlace('${idnew}')" title="Добавить копированием"><i class="fa fa-clone" aria-hidden="true"></i></div>`;
    $('#row1 .wrbt').append(cont);
    let content = `<tr id="row${idnew}">
                    <td width="100"><input type="number" class="r1"  name="r1[]" min="0"></td>
                    <td width="100"><input type="number" class="r2"  name="r2[]" min="0"></td>
                    <td width="100"><input type="number" class="r3"  name="r3[]" min="0"></td>
                    <td width="100"><input type="text" class="ves" name="ves[]" value="1.00" ></td>
                    <td  width="100" style="text-align:right;">
                       <div class="wrbt">
                           <div class="place_delete" onClick="return DeletePlace('${idnew}')" title="Удалить место">-</div>
                           <div class="place_add_copy" onClick="return CopyPlace('${idnew}')" title="Добавить копированием"> <i class="fa fa-clone" aria-hidden="true"></i></div>
                       </div>
                    </td>
                    </tr>`;
    $('.hidden'+id).css('display', 'none');
    $('table tbody').append(content);
}
