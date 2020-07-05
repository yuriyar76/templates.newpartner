<!-- Modal -->
<div class="modal fade color3" id="modal_calculate_cost" tabindex="-1" role="dialog" aria-labelledby="modal_calculate_cost">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
        <form id="modal_calculate_cost_form" action="" method="post">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="�������"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">���������� ��������� �������� �� ������</h4>
            </div>
            <div class="modal-body">
            	<div class="info"></div>
				<div class="alert alert-danger display-error" style="display: none"></div>
            	<div class="form-group">
                    <label for="" class="control-label">����� ����������:*</label>
                    <input type="text" class="form-control city_autocomplete_in" value="" name="city_to">
                    <input id="city_autocomplete_id" value="0" type="hidden" name="city_autocomplete_id">
            	</div>
            	<div class="form-group">
                    <label for="" class="control-label">���:*</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="" placeholder="" name="weight" value="1">
                        <div class="input-group-addon">��</div>
                    </div>
            	</div>
                <div class="form-group">
                	<label for="" class="control-label">��������:</label>
                    <div class="row">
                    	<div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="" placeholder="" name="size1">
                                <div class="input-group-addon">��</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="" placeholder="" name="size2">
                                <div class="input-group-addon">��</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="" placeholder="" name="size3">
                                <div class="input-group-addon">��</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-info">
                        � ������ ���������� ��������� ���� ��� ����������� ��������� �������������� �� ��������� ���� (1�<sup>3</sup>=200��)
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            	<button type="submit" class="btn">���������� ���������</button>

            </div>
            </form>
        </div>
    </div>
</div>
<script>
	function changeLabels()
	{
		var ch = parseInt($('#form_radio_SIMPLE_QUESTION_971 option:selected').val(), 10);
		$("#form_dropdown_PAYER").children().removeAttr("selected");
		if (ch == 102)
		{
			$('#chLabel1').html('����� ����������');
			$('#chLabel2').html('��� ����������');
			$('#chLabel3').html('����� ����������');
			$('#chLabel4').html('����� �������� ����������');
			$('#form_dropdown_PAYER').val(139);
		}
		if (ch == 121)
		{
			$('#chLabel1').html('����� �����������');
			$('#chLabel2').html('��� �����������');
			$('#chLabel3').html('����� �����������');
			$('#chLabel4').html('����� �������� �����������');
			$('#form_dropdown_PAYER').val(140);
		}
	}
</script>
<div class="modal fade color2" id="modal_order_service_pay" tabindex="-1" role="dialog" aria-labelledby="modal_order_service_pay">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modal_order_service_form_pay" action="" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="�������"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">�������� ������</h4>
                    <p id="price_calc_p">����� � ������ - <span></span></p>
                    <input id="price_calc" type="hidden" class="form-control" name="price_calc">
                </div>
                <div class="modal-body">
                    <div class="info"></div>
                    <div class="alert alert-danger display-error" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>���������� � ������</h5>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">�� ������</label>
                                    <select class="form-control" name="form_radio_SIMPLE_QUESTION_971"
                                            id="pay_form_radio_SIMPLE_QUESTION_971">
                                        <option value="102" selected>������������</option>
                                        <option value="121">�����������</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">��� E-mail<span
                                                class="form-required">*</span></label>
                                    <input type="text" class="form-control" name="form_email_52" required
                                           value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_email_52"]);?>">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">��� �����������<span
                                                class="form-required">*</span></label>
                                    <input type="text" class="form-control" name="form_text_50" required
                                           value="<?=iconv('utf-8','windows-1251',
                                               $_COOKIE["np_form_text_50"]);?>">
                                </div>

                                <?
                                    $radio_102 = " selected";
                                    $radio_121 = "";
                                    $chLabel1 = '����� ����������';
                                    $chLabel2 = '��� ����������';
                                    $chLabel3 = '����� ����������';
                                    $chLabel4 = '����� �������� ����������'
                                ?>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">����� �������� �����������<span
                                                class="form-required">*</span></label>
                                    <input type="text" class="form-control" name="form_text_51" required
                                           value="<?=iconv('utf-8','windows-1251',
                                               $_COOKIE["np_form_text_51"]);?>">
                                </div>

                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">����� �����������<span class="form-required">*</span></label>
                                    <input type="hidden"  id="city_to_hidden5" name="form_text_hidden55"
                                           value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_55"]);?>">
                                    <input type="text" class="form-control city_autocomplete" id="city_to5"
                                           name="form_text_55" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_55"]);?>">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">����� �����������<span class="form-required">*</span></label>
                                    <textarea class="form-control" required name="form_textarea_56"><?=iconv('utf-8','windows-1251',$_COOKIE["np_form_textarea_56"]);?>
                                    </textarea>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">��� �����������</label>
                                    <div class="input-group">
                                        <input id="form_text_weight_hidden" type="hidden" name="form_text_hidden58">
                                        <input id="form_text_weight" type="text" class="form-control" name="form_text_58"
                                               aria-describedby="basic-addon-form_text_58">
                                        <span class="input-group-addon" id="basic-addon-form_text_58">��</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">����<span class="form-required">*</span></label>
                                    <div class="input-group">
                            			<span class="input-group-addon" id="basic-addon-form_text_53">
				<?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.calendar",
                    ".default",
                    array(
                        "SHOW_INPUT" => "N",
                        "FORM_NAME" => "",
                        "INPUT_NAME" => "form_text_53",
                        "INPUT_NAME_FINISH" => "",
                        "INPUT_VALUE" => "",
                        "INPUT_VALUE_FINISH" => false,
                        "SHOW_TIME" => "N",
                        "HIDE_TIMEBAR" => "Y",
                    ),
                    false
                );
                ?>
			</span>
                                        <input type="text" class="form-control maskdate" required name="form_text_53" placeholder="��.��.����" ria-describedby="basic-addon-form_text_53">
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">�����</label>
                                    <input type="text" class="form-control masktime" name="form_text_54">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label"><span id="chLabel1"><?=$chLabel1;?></span><span class="form-required">*</span></label>
                                    <input id="city_from_hidden5" type="hidden"  name="form_text_hidden57">
                                    <input id="city_from5" type="text" class="form-control city_autocomplete" required name="form_text_57">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label"><span id="chLabel3"><?=$chLabel3;?></span><span class="form-required">*</span></label>
                                    <textarea class="form-control" required name="form_textarea_103"></textarea>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label"><span id="chLabel2"><?=$chLabel2;?></span><span class="form-required">*</span></label>
                                    <input type="text" class="form-control" required name="form_text_62">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label"><span id="chLabel4"><?=$chLabel4;?></span><span class="form-required">*</span></label>
                                    <input type="text" class="form-control " required name="form_text_149">
                                </div>
                                <div class="form-group form-group-sm">
                                    <?
                                    $radio_59 = " selected";
                                    $radio_60 = "";

                                    ?>
                                    <label for="" class="control-label">������ ������</label>
                                    <select class="form-control" name="form_dropdown_SIMPLE_QUESTION_526">
                                        <option value="61"<?=$radio_60;?>>���������� �����</option>
                                        <option value="59"<?=$radio_59;?>>��������</option>
                                   </select>
                                </div>

                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">����������</label>
                                    <textarea class="form-control" name="form_textarea_61"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="confirmation_order_service" required name="form_checkbox_confirmation" value="146"> ������� ������ &laquo;��������&raquo;, � ����������� ���� ��������������, ��� �������� �� ��������� ����� ������������ ������ � ������������ � <a href="http://newpartner.ru/personal-data/" target="_blank">��������� ������������� ������������ ������<font color="red"><span class="form-required">*</span></font></a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><font color="red"><span class="form-required">*</span></font> - ����, ������������ ��� ����������</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-body">
                        <button  type="submit" class="btn">��������</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade color2" id="modal_order_service" tabindex="-1" role="dialog" aria-labelledby="modal_order_service">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modal_order_service_form" action="" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="�������"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">�������� ������</h4><?=CSite::InDir('/api/')?>
                </div>
                <div class="modal-body">
                    <div class="info"></div>
                    <div class="alert alert-danger display-error" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>���������� � ������</h5>
                                <div class="form-group form-group-sm">
                                    <?
                                    $radio_102 = " selected";
                                    $radio_121 = "";
                                    $chLabel1 = '����� ����������';
                                    $chLabel2 = '��� ����������';
                                    $chLabel3 = '����� ����������';
                                    $chLabel4 = '����� �������� ����������';
                                    if (intval($_COOKIE["np_form_radio_SIMPLE_QUESTION_971"]) == 121)
                                    {
                                        $radio_102 = "";
                                        $radio_121 = " selected";
                                        $chLabel1 = '����� �����������';
                                        $chLabel2 = '��� �����������';
                                        $chLabel3 = '����� �����������';
                                        $chLabel4 = '����� �������� �����������';
                                    }
                                    ?>
                                    <label for="" class="control-label">�� ������</label>
                                    <select class="form-control" name="form_radio_SIMPLE_QUESTION_971" onChange="changeLabels();" id="form_radio_SIMPLE_QUESTION_971">
                                        <option value="102"<?=$radio_102;?>>������������</option>
                                        <option value="121"<?=$radio_121;?>>�����������</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">�����������</label>
                                    <input type="text" class="form-control" name="form_text_49" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_49"]);?>">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">���������� ����<span class="form-required">*</span></label>
                                    <input type="text" class="form-control" name="form_text_50" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_50"]);?>">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">����� ��������<span class="form-required">*</span></label>
                                    <input type="text" class="form-control " name="form_text_51" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_51"]);?>">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">E-mail<span class="form-required">*</span></label>
                                    <input type="text" class="form-control" name="form_email_52" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_email_52"]);?>">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">��� �����<span class="form-required">*</span></label>
                                    <input type="text" class="form-control city_autocomplete" id="city_to5" name="form_text_55" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_55"]);?>">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">��� �����<span class="form-required">*</span></label>
                                    <textarea class="form-control" name="form_textarea_56"><?=iconv('utf-8','windows-1251',$_COOKIE["np_form_textarea_56"]);?></textarea>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">��� �����������</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="form_text_58" aria-describedby="basic-addon-form_text_58">
                                        <span class="input-group-addon" id="basic-addon-form_text_58">��</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">��������</label>
                                    <input type="text" class="form-control" name="form_text_138">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">����<span class="form-required">*</span></label>
                                    <div class="input-group">
                            			<span class="input-group-addon" id="basic-addon-form_text_53">
				<?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.calendar",
                    ".default",
                    array(
                        "SHOW_INPUT" => "N",
                        "FORM_NAME" => "",
                        "INPUT_NAME" => "form_text_53",
                        "INPUT_NAME_FINISH" => "",
                        "INPUT_VALUE" => "",
                        "INPUT_VALUE_FINISH" => false,
                        "SHOW_TIME" => "N",
                        "HIDE_TIMEBAR" => "Y",
                    ),
                    false
                );
                ?>
			</span>
                                        <input type="text" class="form-control maskdate" name="form_text_53" placeholder="��.��.����" ria-describedby="basic-addon-form_text_53">
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">�����</label>
                                    <input type="text" class="form-control masktime" name="form_text_54">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label"><span id="chLabel1"><?=$chLabel1;?></span><span class="form-required">*</span></label>
                                    <input type="text" class="form-control city_autocomplete" name="form_text_57">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label"><span id="chLabel3"><?=$chLabel3;?></span><span class="form-required">*</span></label>
                                    <textarea class="form-control" name="form_textarea_103"></textarea>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label"><span id="chLabel2"><?=$chLabel2;?></span><span class="form-required">*</span></label>
                                    <input type="text" class="form-control" name="form_text_62">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label"><span id="chLabel4"><?=$chLabel4;?></span><span class="form-required">*</span></label>
                                    <input type="text" class="form-control " name="form_text_149">
                                </div>
                                <div class="form-group form-group-sm">
                                    <?
                                    $radio_59 = " selected";
                                    $radio_60 = "";
                                    if (intval($_COOKIE["np_form_dropdown_SIMPLE_QUESTION_526"]) == 60)
                                    {
                                        $radio_59 = "";
                                        $radio_60 = " selected";
                                    }
                                    ?>
                                    <label for="" class="control-label">������ ������</label>
                                    <select class="form-control" name="form_dropdown_SIMPLE_QUESTION_526">
                                        <option value="59"<?=$radio_59;?>>��������</option>
                                        <option value="60"<?=$radio_60;?>>�����������</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-sm">
                                    <?
                                    $radio_139 = " selected";
                                    $radio_140 = "";
                                    $radio_141 = "";
                                    if (intval($_COOKIE["np_form_dropdown_PAYER"]) == 140)
                                    {
                                        $radio_139 = "";
                                        $radio_140 = " selected";
                                        $radio_141 = "";
                                    }
                                    elseif (intval($_COOKIE["np_form_dropdown_PAYER"]) == 141)
                                    {
                                        $radio_139 = "";
                                        $radio_140 = "";
                                        $radio_141 = " selected";
                                    }
                                    ?>
                                    <label for="form_dropdown_PAYER" class="control-label">����������</label>
                                    <select class="form-control" name="form_dropdown_PAYER" id="form_dropdown_PAYER">
                                        <option value="139"<?=$radio_139;?>>�����������</option>
                                        <option value="140"<?=$radio_140;?>>����������</option>
                                        <option value="141"<?=$radio_141;?>>������</option>
                                    </select>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">����������</label>
                                    <textarea class="form-control" name="form_textarea_61"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="confirmation_order_service" name="form_checkbox_confirmation" value="146"> ������� ������ &laquo;��������&raquo;, � ����������� ���� ��������������, ��� �������� �� ��������� ����� ������������ ������ � ������������ � <a href="http://newpartner.ru/personal-data/" target="_blank">��������� ������������� ������������ ������<font color="red"><span class="form-required">*</span></font></a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><font color="red"><span class="form-required">*</span></font> - ����, ������������ ��� ����������</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-body">
                        <button  type="submit" class="btn">��������</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade color1" id="modal_enter_into_contract" tabindex="-1" role="dialog" aria-labelledby="modal_enter_into_contract">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<form id="modal_contract_form" action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="�������"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">��������� �������</h4>
                </div>
                <div class="modal-body">
                	<div class="info"></div>
					<div class="alert alert-danger display-error" style="display: none"></div>
                      <div class="form-group" id="group_form_email_128">
                        <label for="form_email_128" class="control-label">E-mail<span class="form-required">*</span></label>
                        <input type="text" class="form-control" value="" name="form_email_128" id="form_email_128">
                      </div>
                      <div class="form-group" id="group_form_text_159">
                        <label for="form_text_159" class="control-label">����� ��������</label>
                        <input type="text" class="form-control " value="" name="form_text_159" id="form_text_159">
                      </div>
                     <div class="form-group">
                        <label for="recipient-name" class="control-label">���������</label>
                         <div class="btn btn-plus fileinput-button">
                         	�������� �����
                         	<input type="hidden" id="filesize" value="0">
                            <input type="hidden" id="filecount" value="0">
                            <input type="hidden" id="filelist" value="" name="filelist">
                            <input id="fileupload" type="file" name="files[]" multiple>
                        </div>
                        <p id="files-upload-info"></p>
                        <div id="files" class="files"></div>
                      </div>
                     <div class="form-group" id="group_form_radio_TAXATION">
                       <label for="" class="control-label">���� ���������������<span class="form-required">*</span></label>
                       <div class="radio">
  <label for="form_checkbox_TAXATION_142">
    <input type="radio" name="form_radio_TAXATION" id="form_checkbox_TAXATION_142" value="142">
    � ���
  </label>
</div>
<div class="radio">
  <label for="form_checkbox_TAXATION_143">
    <input type="radio" name="form_radio_TAXATION" id="form_checkbox_TAXATION_143" value="143">
    ��� ���
  </label>
</div>
                        </div>
                      <div class="form-group">
                        <label for="form_text_131" class="control-label">�����-���</label>
                        <input type="text" class="form-control" value="" name="form_text_131" id="form_text_131">
                      </div>
					<div class="checkbox">
						<label>
							<input type="checkbox" id="confirmation_contract_form" name="form_checkbox_confirmation" value="147"> ������� ������ &laquo;���������&raquo;, � ����������� ���� ��������������, ��� �������� �� ��������� ����� ������������ ������ � ������������ � <a href="http://newpartner.ru/personal-data/" target="_blank">��������� ������������� ������������ ������<font color="red"><span class="form-required">*</span></font></a>
						</label>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn">���������</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade color6" id="modal_delivery_note" tabindex="-1" role="dialog" aria-labelledby="modal_delivery_note">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="modal_delivery_note_form" onkeypress="return event.keyCode != 13;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="�������"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">��������� �����������</h4>
                </div>
				<div class="alert alert-danger display-error" style="display: none"></div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="recipient-name" class="control-label">����� ���������:</label>
                      <input type="text" class="form-control" name="delivery_note_number" value="">
                    </div>
                    <div class="loadergif"></div>
                  <div id="delivery_note_info">
                  </div>
                </div>
                <div class="modal-footer">
  				  <input id="delivery_note" class="btn" type="button" value="���������" />

                </div>
		</form>
		</div>
	</div>
</div>



<div class="modal fade color7" tabindex="-1" role="dialog" id="modal_mess" aria-labelledby="modal_mess">
	<div class="modal-dialog">
		<div class="modal-content">
            <form id="modal_mess_form" action="" method="post">
                <div class="modal-header">
                  <button aria-label="�������" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">�������� ���</h4>
                </div>
                <div class="modal-body">
                    <div class="info"></div>
                    <div class="form-group">
                      <label for="">���<span class="form-required">*</span></label>
                      <input type="text" placeholder="" id="" class="form-control" name="form_text_74" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_50"]);?>">
                    </div>
                      <div class="form-group">
                      <label for="">Email<span class="form-required">*</span></label>
                      <input type="text" placeholder="" id="" class="form-control" name="form_email_75" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_email_52"]);?>">
                    </div>
                      <div class="form-group">
                      <label for="">����� ���������<span class="form-required">*</span></label>
                      <textarea class="form-control" name="form_textarea_76"></textarea>
                    </div>
					<div class="checkbox">
						<label>
							<input type="checkbox" id="confirmation_mess" name="form_checkbox_confirmation" value="144"> ������� ������ &laquo;���������&raquo;, � ����������� ���� ��������������, ��� �������� �� ��������� ����� ������������ ������ � ������������ � <a href="http://newpartner.ru/personal-data/" target="_blank">��������� ������������� ������������ ������<font color="red"><span class="form-required">*</span></font></a>
						</label>
					</div>
                    <p><font color="red"><span class="form-required">*</span></font> - ����, ������������ ��� ����������</p>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" type="submit">���������</button>
                </div>
            </form>
		</div>
	</div>
</div>


<div class="modal fade color7" tabindex="-1" role="dialog" id="modal_call" aria-labelledby="modal_call">
	<div class="modal-dialog">
		<div class="modal-content">
        	<form id="modal_call_form" action="" method="post">
 				<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="�������"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">�������� �������� ������</h4>
                </div>
                <div class="modal-body">
                	<div class="info"></div>
					<div class="alert alert-danger display-error" style="display: none"></div>
                    <div class="form-group">
                      <label for="">�����<span class="form-required">*</span></label>
                      <input type="text" class="form-control city_autocomplete" id="" placeholder="" name="form_text_63" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_55"]);?>">
                    </div>
                      <div class="form-group">
                      <label for="">����� ��������<span class="form-required">*</span></label>
                      <input type="text" class="form-control " id="" placeholder="" name="form_text_64" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_51"]);?>">
                    </div>
                    <div class="form-group">
                      <label for="">���������� ����<span class="form-required">*</span></label>
                      <input type="text" class="form-control" id="" placeholder="" name="form_text_65" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_text_50"]);?>">
                    </div>
                      <div class="form-group">
                      <label for="">Email<span class="form-required">*</span></label>
                      <input type="text" class="form-control" id="" placeholder="" name="form_email_66" value="<?=iconv('utf-8','windows-1251',$_COOKIE["np_form_email_52"]);?>">
                    </div>
					<div class="checkbox">
						<label>
							<input type="checkbox" id="confirmation_call" name="form_checkbox_confirmation" value="148"> ������� ������ &laquo;���������&raquo;, � ����������� ���� ��������������, ��� �������� �� ��������� ����� ������������ ������ � ������������ � <a href="http://newpartner.ru/personal-data/" target="_blank">��������� ������������� ������������ ������<font color="red"><span class="form-required">*</span></font></a>
						</label>
					</div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">���������</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade color2" tabindex="-1" role="dialog" id="modal_order_transport" aria-labelledby="modal_order_transport">
	<div class="modal-dialog">
		<div class="modal-content">
        	<form id="modal_order_transport_form" action="" method="post">
 				<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="�������"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">�������� ������������ ������</h4>
                </div>
                <div class="modal-body">
                	<div class="info"></div>
					<div class="alert alert-danger display-error" style="display: none"></div>

<div class="form-group">
                        	<label for="" class="control-label">����</label>
                            <div class="input-group">
                            			<span class="input-group-addon" id="basic-addon-date-transport">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:main.calendar",
					".default",
					array(
						"SHOW_INPUT" => "N",
						"FORM_NAME" => "",
						"INPUT_NAME" => "date-transport",
						"INPUT_NAME_FINISH" => "",
						"INPUT_VALUE" => "",
						"INPUT_VALUE_FINISH" => false,
						"SHOW_TIME" => "N",
						"HIDE_TIMEBAR" => "Y",
					),
					false
				);
				?>
			</span>
                            <input type="text" class="form-control maskdate" name="date-transport" placeholder="��.��.����" ria-describedby="basic-addon-date-transport">
                            </div>
                        </div>

                      <div class="form-group">
                      <label for="">����� ��������<span class="form-required">*</span></label>
                      <input type="text" class="form-control " id="" placeholder="" name="">
                    </div>
                              <div class="form-group">
                      <label for="">���������� ����<span class="form-required">*</span></label>
                      <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                      <div class="form-group">
                      <label for="">Email<span class="form-required">*</span></label>
                      <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">���������</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade color3" id="modal_calculate_cost_new" tabindex="-1" role="dialog" aria-labelledby="modal_calculate_cost_new">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="�������"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">������ ��������� ��������</h4>
            </div>
            <div style="margin-bottom: 0!important; display: none;" class="alert alert-danger display-error">
                <div class="messerr"></div>
            </div>
            <div class="modal-body">
                <div class="info"></div>
             <div class="list-group">

             </div>

             <div id = "payment_module" class="main_block color2">
                    <p>�������� ������</p>
                    <span style="font-size: 96%; margin-bottom: 10px;"><i> ��� ������ ���� ������ "���������� ������",
                            �� ������� �������� ������ �� �����. ���� ��
                        ���������� �������� ������ ���������, ��������� ��� ������ - "���������"</i></span>
                    <div class="form-group">
                         <div class="input-group">
			             <div class="input-group-btn">
                        <button id="btn_modal_cost" class="btn btn-default "
                                onclick="yaCounter50408199.reachGoal('KURIER');
                        return true;" >&nbsp;</button>
                       </div>
                       </div>
                     </div>
            </div>

        </div>
    </div>
</div>

