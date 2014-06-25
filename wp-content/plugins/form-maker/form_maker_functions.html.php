<?php

if(!current_user_can('manage_options')) {
	die('Access Denied');
}

function html_update_form_maker($row, $labels, $themes) {
	$form_file_url = plugins_url('', __FILE__);
  @session_start();
  $all_updates = $_SESSION['all_updates'];
  $current_updates = $_SESSION['current_updates'] - 1;
  $perc = (int)(($current_updates / $all_updates) * 100);
?>
  <br />
  <br />
  <style>
    .calendar .button {
      display: table-cell !important;
    }
    .big_div {
      width:100%;
      background-color: transparent;
      height: 40px;
      border-radius: 20px;
      border: 6px #00AEEF solid;
      text-align: center !important;
    }
    .small_div {
      background-color: #00AEEF;
      height: 40px;
      border-radius: 12px;
      text-align: right;
      float: left;
    }
    .progress_span {
      padding-right: 10px;
      line-height: 40px;
      color: #000 !important;
      font-size: 20px;
    }
    .forms_span {
      padding-right: 10px;
      line-height: 20px;
      font-size: 12px;
      font-style: italic;
      color: #999 !important;
    }
  </style>
  <div style="" class="big_div">
    <div style="width:<?php echo $perc ?>%;"  class="small_div">
      <span class="progress_span"><?php echo $perc ?>%</span>
    </div>
    <span class="forms_span"> Updated forms <?php echo $current_updates ?></br> Forms remaining <b style="color:red"><?php echo $all_updates-$current_updates?></b> </span>
  </div>    
  <br />
  <script type="text/javascript">
    count_of_filds_form = 10000;
    function submitbutton (pressbutton) {
      var form = document.adminForm;
      tox = '';
      for (t = 1; t <= form_view_max; t++) {
        if (document.getElementById('form_id_tempform_view'+t)) {
          form_view_element = document.getElementById('form_id_tempform_view' + t);
          n = form_view_element.childNodes.length - 2;
          for (z = 0; z <= n; z++) {
            if (form_view_element.childNodes[z].nodeType != 3) {
              if (!form_view_element.childNodes[z].id) {
                GLOBAL_tr = form_view_element.childNodes[z];
                for (x = 0; x < GLOBAL_tr.firstChild.childNodes.length; x++) {
                  table = GLOBAL_tr.firstChild.childNodes[x];
                  tbody = table.firstChild;
                  for (y = 0; y < tbody.childNodes.length; y++) {
                    tr = tbody.childNodes[y];
                    l_label = document.getElementById( tr.id + '_element_labelform_id_temp').innerHTML;
                    l_label = l_label.replace(/(\r\n|\n|\r)/gm," ");
                    if (tr.getAttribute('type') == "type_address") {
                      addr_id = parseInt(tr.id);
                      tox = tox+addr_id+'#**id**#'+'Street Line'+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 
                      tox = tox+addr_id+'#**id**#'+'Street Line2'+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 
                      tox = tox+addr_id+'#**id**#'+'City'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
                      tox = tox+addr_id+'#**id**#'+'State'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
                      tox = tox+addr_id+'#**id**#'+'Postal'+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
                      tox = tox+addr_id+'#**id**#'+'Country'+'#**label**#'+tr.getAttribute('type')+'#****#'; 
                    }
                    else {
                      tox=tox+tr.id+'#**id**#'+l_label+'#**label**#'+tr.getAttribute('type')+'#****#';
                    }
                  }
                }
              }
            }
          }
        }
      }
      document.getElementById('label_order').value = tox;
      refresh_();
      document.getElementById('pagination').value = document.getElementById('pages').getAttribute("type");
      document.getElementById('show_title').value = document.getElementById('pages').getAttribute("show_title");
      document.getElementById('show_numbers').value = document.getElementById('pages').getAttribute("show_numbers");
      submitform( pressbutton );
    }
    function submitform(pressbutton) {
      document.getElementById('adminForm').action = document.getElementById('adminForm').action + "&task=" + pressbutton;
      document.getElementById('adminForm').submit();
    }
    function remove_whitespace(node) {
      for (ttt = 0; ttt < node.childNodes.length; ttt++) {
        if (node.childNodes[ttt].nodeType == '3') {
          if (!node.childNodes[ttt]) {
            node.removeChild(node.childNodes[ttt]);
          }
        }
        else {
          if (node.childNodes[ttt].childNodes.length) {
            remove_whitespace(node.childNodes[ttt]);
          }
        }
      }
      return;
    }
    function refresh_() {
      document.getElementById('form').value = document.getElementById('take').innerHTML;
      gen = document.getElementById('counter').value;
      n = gen;
      for (i = 0; i < n; i++) {
        if (document.getElementById(i)) {	
          for (z = 0; z < document.getElementById(i).childNodes.length; z++) {
            if (document.getElementById(i).childNodes[z].nodeType == 3) {
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[z]);
            }
          }
          if (document.getElementById(i).getAttribute('type') == "type_captcha" || document.getElementById(i).getAttribute('type') == "type_recaptcha") {
            if (document.getElementById(i).childNodes[10]) {
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            }
            else {
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            }
            continue;
          }
          if (document.getElementById(i).childNodes[10]) {
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          }
          else {
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          }
        }
      }      
      for (i = 0; i <= n; i++) {	
        if (document.getElementById(i)) {
          type = document.getElementById(i).getAttribute("type");
          switch(type) {
            case "type_text":
            case "type_number":
            case "type_password":
            case "type_submitter_mail":
            case "type_own_select":
            case "type_country":
            case "type_hidden":
            case "type_map": {
              remove_add_(i+"_elementform_id_temp");
              break;
            }            
            case "type_submit_reset": {
              remove_add_(i + "_element_submitform_id_temp");
              if (document.getElementById(i + "_element_resetform_id_temp")) {
                remove_add_(i + "_element_resetform_id_temp");
              }
              break;
            }
            case "type_captcha": {
              remove_add_("_wd_captchaform_id_temp");
              remove_add_("_element_refreshform_id_temp");
              remove_add_("_wd_captcha_inputform_id_temp");
              break;
            }
            case "type_file_upload": {
              remove_add_(i + "_elementform_id_temp");
              break;
            }
            case "type_textarea": {
              remove_add_(i + "_elementform_id_temp");
              break;
            }
            case "type_name": {
              if (document.getElementById(i + "_element_titleform_id_temp")) {
                remove_add_(i + "_element_titleform_id_temp");
                remove_add_(i + "_element_firstform_id_temp");
                remove_add_(i + "_element_lastform_id_temp");
                remove_add_(i + "_element_middleform_id_temp");
              }
              else {
                remove_add_(i + "_element_firstform_id_temp");
                remove_add_(i + "_element_lastform_id_temp");
              }
              break;
            }
            case "type_phone": {
              remove_add_(i + "_element_firstform_id_temp");
              remove_add_(i + "_element_lastform_id_temp");
              break;
            }
            case "type_address": {	
              remove_add_(i + "_street1form_id_temp");
              remove_add_(i + "_street2form_id_temp");
              remove_add_(i + "_cityform_id_temp");
              remove_add_(i + "_stateform_id_temp");
              remove_add_(i + "_postalform_id_temp");
              remove_add_(i + "_countryform_id_temp");
              break;
            }
            case "type_checkbox":
            case "type_radio": {
              is = true;
              for (j = 0; j < 100; j++) {
                if (document.getElementById(i + "_elementform_id_temp" + j)) {
                  remove_add_(i + "_elementform_id_temp" + j);
                }
              }
              break;
            }
            case "type_button": {
              for (j = 0; j < 100; j++) {
                if(document.getElementById(i+"_elementform_id_temp"+j)) {
                  remove_add_(i + "_elementform_id_temp" + j);
                }
              }
              break;
            }
            case "type_time": {
              if (document.getElementById(i + "_ssform_id_temp")) {
                remove_add_(i + "_ssform_id_temp");
                remove_add_(i + "_mmform_id_temp");
                remove_add_(i + "_hhform_id_temp");
              }
              else {
                remove_add_(i + "_mmform_id_temp");
                remove_add_(i + "_hhform_id_temp");
              }
              break;
            }
            case "type_date": {
              remove_add_(i + "_elementform_id_temp");
              remove_add_(i + "_buttonform_id_temp");
              break;
            }
            case "type_date_fields": {	
              remove_add_(i + "_dayform_id_temp");
              remove_add_(i + "_monthform_id_temp");
              remove_add_(i + "_yearform_id_temp");
              break;
            }
          }
        }
      }
      for (i = 1; i <= form_view_max; i++) {
        if (document.getElementById('form_id_tempform_view' + i)) {
          if (document.getElementById('page_next_' + i)) {
            document.getElementById('page_next_' + i).removeAttribute('src');
          }
          if (document.getElementById('page_previous_' + i)) {
            document.getElementById('page_previous_' + i).removeAttribute('src');
          }
          document.getElementById('form_id_tempform_view' + i).parentNode.removeChild(document.getElementById('form_id_tempform_view_img' + i));
          document.getElementById('form_id_tempform_view' + i).removeAttribute('style');
        }
      }
      for (t = 1;t <= form_view_max; t++) {
        if (document.getElementById('form_id_tempform_view' + t)) {
          form_view_element = document.getElementById('form_id_tempform_view' + t);
          n = form_view_element.childNodes.length - 2;
          for (q = 0; q <= n; q++) {
            if (form_view_element.childNodes[q]) {
              if(form_view_element.childNodes[q].nodeType != 3) {
                if(!form_view_element.childNodes[q].id) {
                  del = true;
                  GLOBAL_tr = form_view_element.childNodes[q];
                  for (x = 0; x < GLOBAL_tr.firstChild.childNodes.length; x++) {
                    table = GLOBAL_tr.firstChild.childNodes[x];
                    tbody = table.firstChild;
                    if (tbody.childNodes.length) {
                      del = false;
                    }
                  }
                  if (del) {
                    form_view_element.removeChild(form_view_element.childNodes[q]);
                  }
                }
              }
            }
          }
        }
      }
      document.getElementById('form_front').value = document.getElementById('take').innerHTML;
    }
    // Add main form id.
    gen=<?php echo $row->counter; ?>;
    function enable() {
      for (iiiii = 0; iiiii < 1000; iiiii++) {
        if (document.getElementsByTagName("iframe")[iiiii]) {
          if (document.getElementsByTagName("iframe")[iiiii].id == 'form_maker_editor_ifr') {
            id_ifr_editor = iiiii;
            break;
          }
        }
      }
      alltypes = Array('customHTML','text','checkbox','radio','time_and_date','select','file_upload','captcha','map','button','page_break','section_break');
      for (x = 0; x < 12; x++) {
        document.getElementById('img_' + alltypes[x]).src = "<?php echo $form_file_url; ?>/images/" + alltypes[x] + ".png";
      }
      document.getElementById('formMakerDiv').style.display	= (document.getElementById('formMakerDiv').style.display == 'block' ? 'none' : 'block');
      document.getElementById('formMakerDiv1').style.display = (document.getElementById('formMakerDiv1').style.display == 'block' ? 'none' : 'block');
      if (document.getElementById('formMakerDiv').offsetWidth) {
        document.getElementById('formMakerDiv1').style.width = (document.getElementById('formMakerDiv').offsetWidth - 60) + 'px';
      }
      document.getElementById('when_edit').style.display = 'none';
    }
    function enable2() {
      for (iiiii = 0; iiiii < 1000; iiiii++) {
        if (document.getElementsByTagName("iframe")[iiiii]) {
          if (document.getElementsByTagName("iframe")[iiiii].id == 'form_maker_editor_ifr') {
            id_ifr_editor = iiiii;
            break;
          }
        }
      }
      alltypes = Array('customHTML','text','checkbox','radio','time_and_date','select','file_upload','captcha','map','button','page_break','section_break');
      for (x = 0; x < 12; x++) {
        document.getElementById('img_'+alltypes[x]).src = "<?php echo $form_file_url; ?>/images/" + alltypes[x] + ".png";
      }
      document.getElementById('formMakerDiv').style.display	= (document.getElementById('formMakerDiv').style.display == 'block' ? 'none' : 'block');
      document.getElementById('formMakerDiv1').style.display	=(document.getElementById('formMakerDiv1').style.display == 'block' ? 'none' : 'block');
      if (document.getElementById('formMakerDiv').offsetWidth) {
        document.getElementById('formMakerDiv1').style.width = (document.getElementById('formMakerDiv').offsetWidth - 60) + 'px';
      }
      document.getElementById('when_edit').style.display = 'block';
      if (document.getElementById('field_types').offsetWidth) {
        document.getElementById('when_edit').style.width = document.getElementById('field_types').offsetWidth + 'px';
      }
      if (document.getElementById('field_types').offsetHeight) {
        document.getElementById('when_edit').style.height	= document.getElementById('field_types').offsetHeight + 'px';
      }
    }
    function set_preview() {
      appWidth = parseInt(document.body.offsetWidth);
      appHeight = parseInt(document.body.offsetHeight);
      //document.getElementById('toolbar-popup-preview').childNodes[1].href='index.php?option=com_formmaker&task=preview&tmpl=component&theme='+document.getElementById('theme').value;
      //document.getElementById('toolbar-popup-preview').childNodes[1].setAttribute('rel',"{handler: 'iframe', size: {x:"+(appWidth-100)+", y: "+531+"}}");
    }
  </script>
  <style>
    #when_edit {
      position:absolute;
      background-color:#666;
      z-index:101;
      display:none;
      width:100%;
      height:100%;
      opacity: 0.7;
      filter: alpha(opacity = 70);
    }
    #formMakerDiv {
      position:fixed;
      background-color:#666;
      z-index:100;
      display:none;
      left:0;
      top:0;
      width:100%;
      height:100%;
      opacity: 0.7;
      filter: alpha(opacity = 70);
    }
    #formMakerDiv1 {
      position:fixed;
      z-index:100;
      background-color:transparent;
      top:0;
      left:0;
      display:none;
      margin-left:30px;
      margin-top:15px;
    }
  </style>
  <form action="admin.php?page=Form_maker&id=<?php echo $row->id; ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    <table style="border:6px #00aeef solid; background-color:#00aeef" width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="middle" rowspan="3" style="padding:10px;">
          <img src="<?php echo $form_file_url; ?>/images/formmaker.png" />
        </td>
        <td width="70" align="right" valign="middle">
          <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Form title:&nbsp;&nbsp;</span>
        </td>
        <td width="153" align="center" valign="middle">
          <div style="background-image:url(<?php echo $form_file_url; ?>/images/input.png);">
            <input id="title" name="title" <?php  echo 'value="'.htmlspecialchars($row->title).'"' ?> style="background:none; width:151px; height:17px; border:none; font-size:11px" />
          </div>
        </td>
      </tr>
      <tr>
        <td width="300" align="right" valign="middle">
          <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Email to Send Submissions to:&nbsp;&nbsp;</span>
        </td>
        <td width="153" align="center" valign="middle">
          <div style="background-image:url(<?php echo $form_file_url; ?>/images/input.png);">
            <input id="mail" name="mail" <?php  echo 'value="'.$row->mail.'"' ?> style="background:none; width:151px; height:17px; border:none; font-size:11px" />
          </div>
        </td>
      </tr>
      <tr>
        <td width="300" align="right" valign="middle">
          <span style="font-size:16.76pt; font-family:BauhausItcTEEMed; color:#FFFFFF; vertical-align:middle;">Theme:&nbsp;&nbsp;</span>
        </td>
        <td width="153" align="center" valign="middle">
          <div style="height:19px">
            <select id="theme" name="theme" style="background:transparent; width:151px; height:19px; border:none; font-size:11px"  onChange="set_preview()">
              <?php
              $form_theme = '';
              foreach ($themes as $theme) {
                if ($theme->id == $row->theme) {
                  echo '<option value="' . $theme->id . '" selected>' . $theme->title . '</option>';
                  $form_theme = $theme->css;
                }
                else {
                  echo '<option value="'.$theme->id.'">' . $theme->title . '</option>';
                }
              }
              ?>
            </select>
          </div>
        </td>
      </tr>
      <tr>
        <td align="left" colspan="3">
          <img src="<?php echo $form_file_url; ?>/images/addanewfield.png" onclick="enable(); Enable()" style="cursor:pointer;margin:10px;" />
        </td>
      </tr>
    </table>
    <div id="formMakerDiv" onclick="close_window()"></div>
    <div id="formMakerDiv1" align="center">
      <table border="0" width="100%" cellpadding="0" cellspacing="0" height="100%" style="border:6px #00aeef solid; background-color:#FFF">
        <tr>
          <td style="padding:0px">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
              <tr valign="top">
                <td width="15%" height="100%" style="border-right:dotted black 1px;" id="field_types">
                  <div id="when_edit" style="display:none"></div>
			            <table border="0" cellpadding="0" cellspacing="3" width="100%">
                    <tr>
                      <td align="center" onClick="addRow('customHTML')" class="field_buttons" id="table_editor">
                        <img src="<?php echo $form_file_url; ?>/images/customHTML.png" style="margin:5px" id="img_customHTML"/>
                      </td>
                      <td align="center" onClick="addRow('text')" class="field_buttons" id="table_text">
                        <img src="<?php echo $form_file_url; ?>/images/text.png" style="margin:5px" id="img_text"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('time_and_date')" class="field_buttons" id="table_time_and_date">
                        <img src="<?php echo $form_file_url; ?>/images/time_and_date.png" style="margin:5px" id="img_time_and_date"/>
                      </td>
                      <td align="center" onClick="addRow('select')" class="field_buttons" id="table_select">
                        <img src="<?php echo $form_file_url; ?>/images/select.png" style="margin:5px" id="img_select"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('checkbox')" class="field_buttons" id="table_checkbox">
                        <img src="<?php echo $form_file_url; ?>/images/checkbox.png" style="margin:5px" id="img_checkbox"/>
                      </td>
                      <td align="center" onClick="addRow('radio')" class="field_buttons" id="table_radio">
                        <img src="<?php echo $form_file_url; ?>/images/radio.png" style="margin:5px" id="img_radio"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('file_upload')" class="field_buttons" id="table_file_upload">
                        <img src="<?php echo $form_file_url; ?>/images/file_upload.png" style="margin:5px" id="img_file_upload"/>
                      </td>
                      <td align="center" onClick="addRow('captcha')" class="field_buttons" id="table_captcha">
                        <img src="<?php echo $form_file_url; ?>/images/captcha.png" style="margin:5px" id="img_captcha"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('page_break')" class="field_buttons" id="table_page_break">
                        <img src="<?php echo $form_file_url; ?>/images/page_break.png" style="margin:5px" id="img_page_break"/>
                      </td>
                      <td align="center" onClick="addRow('section_break')" class="field_buttons" id="table_section_break">
                        <img src="<?php echo $form_file_url; ?>/images/section_break.png" style="margin:5px" id="img_section_break"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('map')" class="field_buttons" id="table_map">
                        <img src="<?php echo $form_file_url; ?>/images/map.png" style="margin:5px" id="img_map"/>
                      </td>
                      <td align="center" onClick="addRow('button')" class="field_buttons" id="table_button">
                        <img src="<?php echo $form_file_url; ?>/images/button.png" style="margin:5px" id="img_button"/>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="35%" height="100%" align="left">
                  <div id="edit_table" style="padding:0px; overflow-y:scroll; height:575px"></div>
                </td>
                <td align="center" valign="top" style="background:url(<?php echo $form_file_url; ?>/images/border2.png) repeat-y;">&nbsp;</td>
                <td style="padding:15px">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
                    <tr>
                      <td align="right"><input type="radio" value="end" name="el_pos" checked="checked" id="pos_end" onclick="Disable()"/>
                        At The End
                        <input type="radio" value="begin" name="el_pos" id="pos_begin" onclick="Disable()"/>
                        At The Beginning
                        <input type="radio" value="before" name="el_pos" id="pos_before" onclick="Enable()"/>
                        Before
                        <select style="width:100px; margin-left:5px" id="sel_el_pos" disabled="disabled"></select>
                        <img alt="ADD" title="add" style="cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo $form_file_url; ?>/images/save.png" onClick="add(0)"/>
                        <img alt="CANCEL" title="cancel"  style=" cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo $form_file_url; ?>/images/cancel_but.png" onClick="close_window()"/>
				              	<hr style=" margin-bottom:10px" />
                      </td>
                    </tr>
                    <tr height="100%" valign="top">
                      <td id="show_table"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    <input type="hidden" id="old" />
    <input type="hidden" id="old_selected" />
    <input type="hidden" id="element_type" />
    <input type="hidden" id="editing_id" />
    <div id="main_editor" style="position:absolute; display:none; z-index:140;">
      <?php
      if (function_exists('the_editor') || function_exists('wp_editor')) {
        if (get_bloginfo('version') < '3.3') { ?>
      <div  style=" max-width:500px; height:300px;text-align:left" id="poststuff">
        <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea"><?php the_editor("","form_maker_editor","title",$media_buttons = true, $tab_index = 1, $extended = true ); ?></div>
      </div>
        <?php
        }
        else {
          echo "<style>#wp-form_maker_editor-media-buttons{ text-align:left }</style>"; wp_editor("", "form_maker_editor");
        }
      }
      else {
      ?>
      <textarea name="editor" id="editor" cols="40" rows="6" style="width: 450px; height: 350px; " class="mce_editable" aria-hidden="true"></textarea>
      <?php
      }
      ?>
    </div>
    <br />
    <br />
    <fieldset>
      <legend>
        <h2 style="color:#00aeef">Form</h2>
      </legend>
      <?php
      global $first_css;
      echo '<style>'. $first_css.'</style>';
      ?>
      <table width="100%" style="margin:8px">
        <tr id="page_navigation">
          <td align="center" width="90%" id="pages" show_title="<?php echo $row->show_title; ?>" show_numbers="<?php echo $row->show_numbers; ?>" type="<?php echo $row->pagination; ?>"></td>
          <td align="left" id="edit_page_navigation"></td>
        </tr>
      </table>
      <div id="take" class="main">
        <table cellpadding="4" cellspacing="0" class="wdform_table1" style="border-top:0px solid black;">
          <tbody id="form_id_tempform_view1" class="wdform_tbody1" page_title="Untitled page" next_title="Next" next_type="button" next_class="wdform_page_button" next_checkable="false" previous_title="Previous" previous_type="button" previous_class="wdform_page_button" previous_checkable="false">
            <tr class="wdform_tr1">
              <td class="wdform_td1" >
                <table class="wdform_table2">
                  <tbody class="wdform_tbody2"></tbody>
                </table>
              </td>
            </tr>
            <tr class="wdform_footer">
              <td colspan="100" valign="top">
                <table width="100%" style="padding-right:170px">
                  <tbody>
                    <tr id="form_id_temppage_nav1"></tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tbody id="form_id_tempform_view_img1" style="float:right ;" >
              <tr>
                <td width="0%"></td>
                <td align="right">
                  <img src="<?php echo $form_file_url; ?>/images/minus.png" title="Show or hide the page" class="page_toolbar" onclick="show_or_hide('1')" id="show_page_img_1" />
                </td>
                <td>
                  <img src="<?php echo $form_file_url; ?>/images/page_delete.png" title="Delete the page"  class="page_toolbar" onclick="remove_page('1')" />
                </td>
                <td>
                  <img src="<?php echo $form_file_url; ?>/images/page_delete_all.png" title="Delete the page with fields" class="page_toolbar" onclick="remove_page_all('1')" />
                </td>
                <td>
                  <img src="<?php echo $form_file_url; ?>/images/page_edit.png" title="Edit the page"  class="page_toolbar" onclick="edit_page_break('1')" />
                </td>
              </tr>
          </tbody>
        </table>
      </div>
      <div id="take_old" style="display:none">
        <?php
        echo $row->form;
        ?>
      </div>
    </fieldset>
    <input type="hidden" name="form" id="form">
    <input type="hidden" name="form_front" id="form_front">
    <input type="hidden" value="<?php echo plugins_url("", __FILE__) ?>" id="form_plugins_url" />
    <input type="hidden" name="pagination" id="pagination" />
    <input type="hidden" name="show_title" id="show_title" />
    <input type="hidden" name="show_numbers" id="show_numbers" />
	  <input type="hidden" name="public_key" id="public_key" />
    <input type="hidden" name="private_key" id="private_key" />
    <input type="hidden" name="recaptcha_theme" id="recaptcha_theme" />
    <input type="hidden" id="label_order" name="label_order" value="<?php echo $row->label_order;?>" />
    <input type="hidden" name="counter" id="counter" value="<?php echo $row->counter;?>">
    <script type="text/javascript">
      form_view = 1;
      form_view_count = 1;
      form_view_max = 1;
      function formOnload() {
        // Enable maps.
        form_view = document.getElementById('form_view');
        GLOBAL_tr = form_view.firstChild;
        for (qqq=0; qqq < GLOBAL_tr.childNodes.length; qqq++) {
          td=GLOBAL_tr.childNodes[qqq];
          tbody=td.firstChild.firstChild;
          for (yyy=0; yyy < tbody.childNodes.length; yyy++) {
            tr=tbody.childNodes[yyy];
            l_id=tr.id;
            add_new_field(l_id);
            td=GLOBAL_tr.childNodes[qqq];
            tbody=td.firstChild.firstChild;
            for (zzz=0; zzz < qqq; zzz++) {
              right_row(l_id);
            }
          }
        }
        submitbutton('save_update');
      }
      function formAddToOnload() {
        if (formOldFunctionOnLoad) {
          formOldFunctionOnLoad();
        }
        formOnload();
      }
      function formLoadBody() {
        formOldFunctionOnLoad = window.onload;
        window.onload = formAddToOnload;
      }
      var formOldFunctionOnLoad = null;
      formLoadBody();
      function add_new_field(id) {
        enable2();
        type=document.getElementById(id).getAttribute('type');
        // Parameter take.
        if (document.getElementById(id + '_element_label').innerHTML) {
          w_field_label = document.getElementById(id + '_element_label').innerHTML;
        }
        w_choices = new Array();
        w_choices_checked = new Array();
        w_choices_disabled = new Array();
        w_allow_other_num = 0;
        if (document.getElementById(id+'_label_and_element_section')) {
          w_field_label_pos = "top";
        }
        else {
          w_field_label_pos = "left";
        }
        if (document.getElementById(id + "_element")) {
          s = document.getElementById(id + "_element").style.width;
          w_size = s.substring(0, s.length - 2);
        }
        if (document.getElementById(id+"_required")) {
          w_required=document.getElementById(id+"_required").value;
        }
        if (document.getElementById(id+'_label_section')) {
          w_class=document.getElementById(id+'_label_section').getAttribute("class");
          if (!w_class) {
            w_class = "";
          }
        }
        t = 0;	
        gen = id;
        switch(type) {
          case 'type_editor': {
            w_editor=document.getElementById(id+"_element_section").innerHTML;
            type_editor(gen, w_editor); add(0); break;
          }
          case 'type_text': {
            w_first_val=document.getElementById(id+"_element").value;
            w_title=document.getElementById(id+"_element").title;
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_text(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, 'no', w_class,  w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_password': {
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            if(w_class=='')
              w_class='wdform_input';
            type_password(gen, w_field_label, w_field_label_pos, w_size, w_required, 'no', w_class, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_textarea': {
            w_first_val=document.getElementById(id+"_element").value;
            w_title=document.getElementById(id+"_element").title;
            s=document.getElementById(id+"_element").style.height;
            w_size_h=s.substring(0,s.length-2);

            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_textarea(gen, w_field_label, w_field_label_pos, w_size, w_size_h, w_first_val, w_title, w_required, 'no', w_class, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_name': {
            if (document.getElementById(id+'_element_middle')) {
              w_name_format="extended";
            }
            else {
              w_name_format="normal";
            }
            w_first_val=['', ''];
            w_title=['', ''];
            s = document.getElementById(id+"_element_first").style.width;
            w_size=s.substring(0,s.length-2);
            atrs=return_attributes(id+'_element_first');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_name(gen, w_field_label, w_field_label_pos, w_first_val, w_title, w_size, w_name_format, w_required, 'no', w_class, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_submitter_mail': {
            w_first_val=document.getElementById(id+"_element").value;
            w_title=document.getElementById(id+"_element").title;
            w_send=document.getElementById(id+"_send").value;
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_submitter_mail(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_send, w_required, 'no', w_class, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_checkbox': {
            if (document.getElementById(id + '_hor')) {
              w_flow = "hor";
            }
            else {
              w_flow = "ver";
            }
            v = 0;
            for (k = 0; k < 100; k++) {
              if (document.getElementById(id+"_element"+k)) {
                if (document.getElementById(id+"_element"+k).getAttribute('other')) {
                  if (document.getElementById(id+"_element"+k).getAttribute('other') == '1') {
                    w_allow_other_num=t;
                  }
                }
                w_choices[t] = document.getElementById(id + "_element" + k).value;
                w_choices_checked[t]=document.getElementById(id+"_element"+k).checked;
                t++;
                v=k;
              }
            }
            atrs=return_attributes(id+'_element'+v);
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_checkbox(gen, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_required, 'no','no', '0', w_class, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_radio': {	
            if (document.getElementById(id+'_hor')) {
              w_flow="hor";
            }
            else {
              w_flow="ver";
            }
            v = 0;
            for (k = 0; k < 100; k++) {
              if (document.getElementById(id+"_element"+k)) {
                w_choices[t]=document.getElementById(id+"_element"+k).value;
                w_choices_checked[t]=document.getElementById(id+"_element"+k).checked;
                t++;
                v=k;
              }
            }
            atrs = return_attributes(id + '_element' + v);
            w_attr_name = atrs[0];
            w_attr_value = atrs[1];
            type_radio(gen, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_required, 'no', 'no', 0, w_class, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_time': {	
            atrs=return_attributes(id+'_hh');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            w_hh=document.getElementById(id+'_hh').value;
            w_mm=document.getElementById(id+'_mm').value;
            if (document.getElementById(id+'_ss')) {
              w_ss=document.getElementById(id+'_ss').value;
              w_sec="1";
            }
            else {
              w_ss="";
              w_sec="0";
            }
            if (document.getElementById(id+'_am_pm_select')) {
              w_am_pm=document.getElementById(id+'_am_pm').value;
              w_time_type="12";
            }
            else {
              w_am_pm=0;
              w_time_type="24";
            }
            type_time(gen, w_field_label, w_field_label_pos, w_time_type, w_am_pm, w_sec, w_hh, w_mm, w_ss, w_required, w_class, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_date': {	
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            w_date=document.getElementById(id+'_element').value;
            w_format=document.getElementById(id+'_button').getAttribute("format");
            w_but_val=document.getElementById(id+'_button').value;
            type_date(gen, w_field_label, w_field_label_pos, w_date, w_required, w_class, w_format, w_but_val, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_date_fields': {	
            atrs			=return_attributes(id+'_day');
            w_attr_name		=atrs[0];
            w_attr_value	=atrs[1];
            w_day			=document.getElementById(id+'_day').value;
            w_month			=document.getElementById(id+'_month').value;
            w_year			=document.getElementById(id+'_year').value;
            w_day_type		=document.getElementById(id+'_day').tagName;
            w_month_type	=document.getElementById(id+'_month').tagName;
            w_year_type		=document.getElementById(id+'_year').tagName;
            w_day_label		=document.getElementById(id+'_day_label').innerHTML;
            w_month_label	=document.getElementById(id+'_month_label').innerHTML;
            w_year_label	=document.getElementById(id+'_year_label').innerHTML;
            s				=document.getElementById(id+'_day').style.width;
            w_day_size		=s.substring(0,s.length-2);
            s				=document.getElementById(id+'_month').style.width;
            w_month_size	=s.substring(0,s.length-2);
            s				=document.getElementById(id+'_year').style.width;
            w_year_size		=s.substring(0,s.length-2);
            if(w_year_type=='SELECT') {
              w_from			=document.getElementById(id+'_year').getAttribute('from');
              w_to			=document.getElementById(id+'_year').getAttribute('to');
            }
            else {
              w_from			='1901';
              w_to			='2012';
            }
            w_divider		=document.getElementById(id+'_separator1').innerHTML;
            type_date_fields(gen, w_field_label, w_field_label_pos, w_day, w_month, w_year, w_day_type, w_month_type, w_year_type, w_day_label, w_month_label, w_year_label, w_day_size, w_month_size, w_year_size, w_required, w_class, w_from, w_to, w_divider, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_own_select': {	
            for (k = 0; k < 100; k++) {
              if(document.getElementById(id+"_option"+k)) {
                w_choices[t]=document.getElementById(id+"_option"+k).innerHTML;
                w_choices_checked[t]=document.getElementById(id+"_option"+k).selected;
                if(document.getElementById(id+"_option"+k).value=="") {
                  w_choices_disabled[t]=true;
                }
                else {
                  w_choices_disabled[t]=false;
                }
                t++;
              }
            }
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_own_select(gen, w_field_label, w_field_label_pos, w_size, w_choices, w_choices_checked, w_required, w_class, w_attr_name, w_attr_value, w_choices_disabled); add(0); break;
          }
          case 'type_country': {	
            w_countries=[];
            select_=document.getElementById(id+'_element');
            n=select_.childNodes.length;
            for (i=0; i<n; i++) {
              w_countries.push(select_.childNodes[i].value);
            }
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_country(gen, w_field_label, w_countries, w_field_label_pos, w_size, w_required, w_class,  w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_file_upload': {
            w_destination=document.getElementById(id+"_destination").value.replace("***destinationverj"+id+"***", "").replace("***destinationskizb"+id+"***", "");
            w_extension  =document.getElementById(id+"_extension").value.replace("***extensionverj"+id+"***", "").replace("***extensionskizb"+id+"***", "");
            w_max_size   =document.getElementById(id+"_max_size").value.replace("***max_sizeverj"+id+"***", "").replace("***max_sizeskizb"+id+"***", "");
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_file_upload(gen, w_field_label, w_field_label_pos, w_destination,w_extension, w_max_size, w_required, w_class,  w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_map': {
            w_lat=[];
            w_long=[];
            w_info=[];
            w_zoom  = document.getElementById(id+"_element").getAttribute("zoom");
            w_width = parseInt(document.getElementById(id+"_element").style.width);
            w_height= parseInt(document.getElementById(id+"_element").style.height);
            w_lat.push(document.getElementById(id+"_element").getAttribute("lat"));
            w_long.push(document.getElementById(id+"_element").getAttribute("long"));
            w_info.push(document.getElementById(id+"_element").getAttribute("info"));
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_map(gen, w_long, w_lat, w_long, w_lat, w_zoom, w_width, w_height, w_class, w_info, w_attr_name, w_attr_value); add(0);break;
          }
          case 'type_submit_reset': {
            atrs=return_attributes(id+'_element_submit');
            w_act=!(document.getElementById(id+"_element_reset").style.display=="none");
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            w_submit_title = document.getElementById(id+"_element_submit").value;
            w_reset_title  = document.getElementById(id+"_element_reset").value;
            type_submit_reset(gen, w_submit_title , w_reset_title , w_class, w_act, w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_button': {
            w_title	=new Array();
            w_func	=new Array();
            t=0;
            v=0;
            for (k = 0; k < 100; k++) {
              if (document.getElementById(id+"_element"+k)) {
                w_title[t]=document.getElementById(id+"_element"+k).value;
                w_func[t]=document.getElementById(id+"_element"+k).getAttribute("onclick");
                t++;
                v=k;
              }
            }
            atrs=return_attributes(id+'_element'+v);
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_button (gen, w_title , w_func , w_class,w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_hidden': {
            w_value  = document.getElementById(id+"_element").value;
            w_name  = document.getElementById(id+"_element").name;
            atrs=return_attributes(id+'_element');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_hidden (gen, w_name, w_value , w_attr_name, w_attr_value); add(0); break;
          }
          case 'type_captcha': {
            w_digit=document.getElementById("wd_captcha").getAttribute("digit");
            atrs=return_attributes('wd_captcha');
            w_attr_name=atrs[0];
            w_attr_value=atrs[1];
            type_captcha(gen, w_field_label, w_field_label_pos, w_digit, w_class,  w_attr_name, w_attr_value); add(0);break;
          }
        }
      }
      plugin_url = document.getElementById('form_plugins_url').value;
    </script>
    <input type="hidden" name="option" value="com_formmaker" />
    <input type="hidden" name="id" value="<?php echo $row->id?>" />
    <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" id="araqel" value="0" />
  </form>
  <?php
}

////////////////////////////////////////////////////////////////////////////////////////////////////
function html_forchrome_update() {
  ?>
  <script type="text/javascript">
    window.onload = val;
    function val() {
      var form = document.adminForm;
      submitform();
    }
    function submitform(pressbutton) {
      document.getElementById('adminForm').action = document.getElementById('adminForm').action + "&task=update";
      document.getElementById('adminForm').submit();
    }
  </script>
  <form action="admin.php?page=Form_maker&id=<?php echo $id; ?>" method="post" id="adminForm" name="adminForm">
  </form>
  <?php
}

function update_complete() {
  ?>
  <div class="updated"><p><strong><?php _e('All forms are updated!'); ?></strong></p></div>
  <?php
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function html_display_form_lists($rows, $pageNav, $sort, $old_version, $can_update_form) {
  global $wpdb;
  ?>
  <script language="javascript">
    function confirmation(href,title) {
      var answer = confirm("Are you sure you want to delete '"+title+"'?");
      if (answer) {
        document.getElementById('admin_form').action=href;
        document.getElementById('admin_form').submit();
      }
    }
    function ordering(name,as_or_desc) {
      document.getElementById('asc_or_desc').value=as_or_desc;		
      document.getElementById('order_by').value=name;
      document.getElementById('admin_form').submit();
    }
    function doNothing() {
      var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
      if (keyCode == 13) {
        if (!e) {
          var e = window.event;
        }
        e.cancelBubble = true;
        e.returnValue = false;
        if (e.stopPropagation) {
          e.stopPropagation();
          e.preventDefault();
        }
      }
    }
	</script>
  <style>
    .calendar .button {
      display: table-cell !important;
    }
  </style>
  <form method="post" onkeypress="doNothing()" action="admin.php?page=Form_maker" id="admin_form" name="admin_form">
    <br />
    <div style="font-size:14px; font-weight:bold">
      <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a>
      <br />
      This section allows you to create forms.
      <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">More...</a>
    </div>
    <table cellspacing="10" width="100%">
      <tr>
        <td style="width:50px">
          <img src="<?php echo plugins_url("images/formmakerLogo-48.png",__FILE__); ?>" />
        </td>
        <td style="width:140px;">
        <h2 style="vertical-align:top;">Form Maker</h2></td>
        <td style="width:90px; text-align:right;"><input class="button-secondary action" type="button" value="Add a Form"
                                                         name="custom_parametrs"
                                                         onclick="window.location.href='admin.php?page=Form_maker&task=add_form'"/>
        </td>
        <?php if ($old_version && $can_update_form) { ?>
        <td style="width:90px; text-align:right;"><input class="button-primary action" type="button" value=" Update Forms"
                                                         name="update_forms"
                                                         onclick="window.location.href='admin.php?page=Form_maker&task=update'"/>
        </td><?php } if (!$can_update_form && $old_version) { ?>
        <td style="width:90px; text-align:right;"><input class="button-primary action" type="button" value=" Update Forms"
                                                         name="update_forms"
                                                         onclick="alert('You cant update the forms of pro version with the free version. Please get the pro version')"/>
        </td><?php }?>
        <td>
          <div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:90%">
            <a href="http://web-dorado.com/files/fromFormMaker.php" target="_blank"
               style="color:red; text-decoration:none;">
              <img src="<?php echo plugins_url('images/header.png', __FILE__); ?>" border="0" alt="www.web-dorado.com"
                   width="215"><br>
              Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
            </a>
          </div>
        </td>
      </tr>
    </table>
    <?php
    $serch_value='';
    if (isset($_POST['serch_or_not'])) {
      if (esc_html($_POST['serch_or_not']) == "search") {
        $serch_value = esc_html($_POST['search_events_by_title']);
      }
      else {
        $serch_value = "";
      }
    } 
    $serch_fields = '
    <div class="alignleft actions" style="width:250px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
      <input type="text" name="search_events_by_title" value="' . $serch_value . '" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
    <div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';document.getElementById(\'admin_form\').submit();" class="button-secondary action">
      <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=Form_maker\'" class="button-secondary action">
    </div>';
    print_html_nav($pageNav['total'], $pageNav['limit'], $serch_fields);
    ?>
    <table class="wp-list-table widefat fixed pages" style="width:95%">
      <thead>
        <TR>
          <th scope="col" id="id" class="<?php if ($sort["sortid_by"] == "id")
        echo $sort["custom_style"];
      else echo $sort["default_style"]; ?>" style="width:110px"><a
        href="javascript:ordering('id',<?php if ($sort["sortid_by"] == "id")
          echo $sort["1_or_2"];
        else echo "1"; ?>)"><span>ID</span><span class="sorting-indicator"></span></a></th>
      <th scope="col" id="title" class="<?php if ($sort["sortid_by"] == "title")
        echo $sort["custom_style"];
      else echo $sort["default_style"]; ?>" style=""><a
        href="javascript:ordering('title',<?php if ($sort["sortid_by"] == "title")
          echo $sort["1_or_2"];
        else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>
      <th scope="col" id="mail" class="<?php if ($sort["sortid_by"] == "mail")
        echo $sort["custom_style"];
      else echo $sort["default_style"]; ?>"><a href="javascript:ordering('mail',<?php if ($sort["sortid_by"] == "mail")
        echo $sort["1_or_2"];
      else echo "1"; ?>)"><span>Email to send submissions to</span><span class="sorting-indicator"></span></a></th>
          <th style="width:80px">Edit</th>
          <th style="width:80px">Delete</th>
        </TR>
      </thead>
      <tbody>
        <?php
        for ($i = 0; $i < count($rows); $i++) {
        ?>
        <tr>
          <?php
          $old_version = false;
          if (strpos($rows[$i]->form, "wdform_table1") === false) {
            $old_version = true;
          }
          ?>
          <td><?php if (!$old_version) { ?><a
        href="admin.php?page=Form_maker&task=edit_form&id=<?php echo $rows[$i]->id?>"><?php echo $rows[$i]->id; ?></a><?php }
      else { ?>   <p style="color:red; cursor:pointer; margin:0px"
                     onclick="alert('Update forms to new version!')"><?php echo $rows[$i]->id; ?></p><?php }?></td>
      <td><?php if (!$old_version) { ?><a
        href="admin.php?page=Form_maker&task=edit_form&id=<?php echo $rows[$i]->id?>"><?php echo $rows[$i]->title; ?></a><?php }
      else { ?>   <p style="color:red; cursor:pointer; margin:0px"
                     onclick="alert('Update forms to new version!')"><?php echo $rows[$i]->title; ?></p><?php }?></td>
      <td><?php echo $rows[$i]->mail; ?></td>
      <td><?php if (!$old_version) { ?><a href="admin.php?page=Form_maker&task=edit_form&id=<?php echo $rows[$i]->id?>">Edit</a><?php }
      else { ?>   <p style="color:red; cursor:pointer; margin:0px" onclick="alert('Update forms to new version!')">
        Edit</p><?php }?></td>
      <td><a
        href="javascript:confirmation('admin.php?page=Form_maker&task=remove_form&id=<?php echo $rows[$i]->id?>','<?php echo $rows[$i]->title; ?>')">Delete</a>
      </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_html($_POST['asc_or_desc']);?>"  />
    <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_html($_POST['order_by']);?>"  />
  </form>
  <?php
}

// Add a form.
function html_add_form($themes) {
  ?>
  <script type="text/javascript">
    // Edit paypal properties page open in popup.
    function form_maker_edit_in_popup(id) {
    $ = jQuery;
    var thickDims, tbWidth, tbHeight;
    thickDims = function() {
      var tbWindow = jQuery('#TB_window'), H = jQuery(window).height(), W = jQuery(window).width(), w, h;
      w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
      h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;
      if (tbWindow.size()) {
        tbWindow.width(w).height(h);
        jQuery('#TB_iframeContent').width(w).height(h - 27);
        tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
        if (typeof document.body.style.maxWidth != 'undefined') {
          tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
        }
      }
    };
    thickDims();
    jQuery(window).resize( function() { thickDims() } );
    jQuery('a.thickbox-preview' + id).click( function() {
      tb_click.call(this);
      var alink = jQuery(this).parents('.available-theme').find('.activatelink'), link = '', href = jQuery(this).attr('href'), url, text;
      if (tbWidth = href.match(/&tbWidth=[0-9]+/)) {
        tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
      }
      else {
        tbWidth = jQuery(window).width() - 120;
      }
      if (tbHeight = href.match(/&tbHeight=[0-9]+/)) {
        tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
      }
      else {
        tbHeight = jQuery(window).height() - 120;
      }
      if (alink.length) {
        url = alink.attr('href') || '';
        text = alink.attr('title') || '';
        link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
      }
      else {
        text = jQuery(this).attr('title') || '';
        link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
      }
      jQuery('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
      jQuery('#TB_closeAjaxWindow').css({'float':'left'});
      jQuery('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);
      jQuery('#TB_iframeContent').width('100%');
      thickDims();
      return false;
    });
  }
  var already_submitted = false;
  function refresh_() {
    document.getElementById('form').value = document.getElementById('take').innerHTML;
    document.getElementById('counter').value = gen;
    n = gen;
    for (i = 0; i < n; i++) {
      if (document.getElementById(i)) {
        for (z = 0; z < document.getElementById(i).childNodes.length; z++)
          if (document.getElementById(i).childNodes[z].nodeType == 3)
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[z]);

        if (document.getElementById(i).getAttribute('type') == "type_captcha" || document.getElementById(i).getAttribute('type') == "type_recaptcha") {
          if (document.getElementById(i).childNodes[10]) {
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          }
          else {
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          }
          continue;
        }
        if (document.getElementById(i).getAttribute('type') == "type_section_break") {
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          continue;
        }
        if (document.getElementById(i).childNodes[10]) {
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
        }
        else {
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
        }
      }
    }
    for (i = 0; i <= n; i++) {
      if (document.getElementById(i)) {
        type = document.getElementById(i).getAttribute("type");
        switch (type) {
          case "type_text":
          case "type_number":
          case "type_password":
          case "type_submitter_mail":
          case "type_own_select":
          case "type_country":
          case "type_hidden":
          case "type_map":
          {
            remove_add_(i + "_elementform_id_temp");
            break;
          }

          case "type_submit_reset":
          {
            remove_add_(i + "_element_submitform_id_temp");
            if (document.getElementById(i + "_element_resetform_id_temp"))
              remove_add_(i + "_element_resetform_id_temp");
            break;
          }

          case "type_captcha":
          {
            remove_add_("_wd_captchaform_id_temp");
            remove_add_("_element_refreshform_id_temp");
            remove_add_("_wd_captcha_inputform_id_temp");
            break;
          }

          case "type_recaptcha":
          {
            document.getElementById("public_key").value = document.getElementById("wd_recaptchaform_id_temp").getAttribute("public_key");
            document.getElementById("private_key").value = document.getElementById("wd_recaptchaform_id_temp").getAttribute("private_key");
            document.getElementById("recaptcha_theme").value = document.getElementById("wd_recaptchaform_id_temp").getAttribute("theme");
            document.getElementById('wd_recaptchaform_id_temp').innerHTML = '';
            remove_add_("wd_recaptchaform_id_temp");
            break;
          }

          case "type_file_upload":
          {
            remove_add_(i + "_elementform_id_temp");
            break;
          }

          case "type_textarea":
          {
            remove_add_(i + "_elementform_id_temp");

            break;
          }

          case "type_name":
          {

            if (document.getElementById(i + "_element_titleform_id_temp")) {
              remove_add_(i + "_element_titleform_id_temp");
              remove_add_(i + "_element_firstform_id_temp");
              remove_add_(i + "_element_lastform_id_temp");
              remove_add_(i + "_element_middleform_id_temp");
            }
            else {
              remove_add_(i + "_element_firstform_id_temp");
              remove_add_(i + "_element_lastform_id_temp");

            }
            break;

          }

          case "type_phone":
          {

            remove_add_(i + "_element_firstform_id_temp");
            remove_add_(i + "_element_lastform_id_temp");

            break;

          }

          case "type_address":
          {
            remove_add_(i + "_street1form_id_temp");
            remove_add_(i + "_street2form_id_temp");
            remove_add_(i + "_cityform_id_temp");
            remove_add_(i + "_stateform_id_temp");
            remove_add_(i + "_postalform_id_temp");
            remove_add_(i + "_countryform_id_temp");
            break;
          }
          case "type_checkbox":
          case "type_radio":
          {
            is = true;
            for (j = 0; j < 100; j++)
              if (document.getElementById(i + "_elementform_id_temp" + j)) {
                remove_add_(i + "_elementform_id_temp" + j);
              }
            break;
          }
          case "type_star_rating":
          {	
            remove_add_(i+"_elementform_id_temp");
          
              break;
          }	
          
          case "type_scale_rating":
          {	
            remove_add_(i+"_elementform_id_temp");
          
              break;
          }
          
          case "type_spinner":
          {	
            remove_add_(i+"_elementform_id_temp");
                  
              break;
          }
          
          case "type_slider":
          {	
            remove_add_(i+"_elementform_id_temp");
                  
              break;
          }
          case "type_range":
          {	
            remove_add_(i+"_elementform_id_temp0");
            remove_add_(i+"_elementform_id_temp1");
            
              break;
          }
          case "type_grading":
          {
            
            for(k=0; k<100; k++)
              if(document.getElementById(i+"_elementform_id_temp"+k))
              {
                remove_add_(i+"_elementform_id_temp"+k);
              }
          
            break;
          }
          case "type_matrix":
          {	
            remove_add_(i+"_elementform_id_temp");
          
              break;
          }

          case "type_button":
          {
            for (j = 0; j < 100; j++)
              if (document.getElementById(i + "_elementform_id_temp" + j)) {
                remove_add_(i + "_elementform_id_temp" + j);
              }
            break;
          }

          case "type_time":
          {
            if (document.getElementById(i + "_ssform_id_temp")) {
              remove_add_(i + "_ssform_id_temp");
              remove_add_(i + "_mmform_id_temp");
              remove_add_(i + "_hhform_id_temp");
            }
            else {
              remove_add_(i + "_mmform_id_temp");
              remove_add_(i + "_hhform_id_temp");
            }
            break;

          }

          case "type_date":
          {
            remove_add_(i + "_elementform_id_temp");
            remove_add_(i + "_buttonform_id_temp");
            break;
          }
          case "type_date_fields":
          {
            remove_add_(i + "_dayform_id_temp");
            remove_add_(i + "_monthform_id_temp");
            remove_add_(i + "_yearform_id_temp");
            break;
          }
        }
      }
    }

    for (i = 1; i <= form_view_max; i++) {
      if (document.getElementById('form_id_tempform_view' + i)) {
        if (document.getElementById('page_next_' + i))
          document.getElementById('page_next_' + i).removeAttribute('src');
        if (document.getElementById('page_previous_' + i))
          document.getElementById('page_previous_' + i).removeAttribute('src');
        document.getElementById('form_id_tempform_view' + i).parentNode.removeChild(document.getElementById('form_id_tempform_view_img' + i));
        document.getElementById('form_id_tempform_view' + i).removeAttribute('style');
      }
    }
    for (t = 1; t <= form_view_max; t++) {
      if (document.getElementById('form_id_tempform_view' + t)) {
        form_view_element = document.getElementById('form_id_tempform_view' + t);
        n = form_view_element.childNodes.length - 2;
        for (z = 0; z <= n; z++) {
          if (form_view_element.childNodes[z]) {
            if (form_view_element.childNodes[z].nodeType != 3) {
              if (!form_view_element.childNodes[z].id) {
                del = true;
                GLOBAL_tr = form_view_element.childNodes[z];
                //////////////////////////////////////////////////////////////////////////////////////////
                for (x = 0; x < GLOBAL_tr.firstChild.childNodes.length; x++) {
                  table = GLOBAL_tr.firstChild.childNodes[x];
                  tbody = table.firstChild;
                  if (tbody.childNodes.length)
                    del = false;
                }
                if (del) {
                  form_view_element.removeChild(form_view_element.childNodes[z]);
                }
              }
            }
          }
        }
      }
    }
    document.getElementById('form_front').value = document.getElementById('take').innerHTML;
  }
  function submitbutton(pressbutton) {
    var form = document.adminForm;
    if (already_submitted) {
      submitform(pressbutton);
      return;
    }
    if (pressbutton == 'cancel') {
      submitform(pressbutton);
      return;
    }
    if (form.title.value == "") {
      alert("The form must have a title.");
      return;
    }
    tox = '';
    for (t = 1; t <= form_view_max; t++) {
      if (document.getElementById('form_id_tempform_view' + t)) {
        form_view_element = document.getElementById('form_id_tempform_view' + t);
        n = form_view_element.childNodes.length - 2;
        for (z = 0; z <= n; z++) {
          if (form_view_element.childNodes[z].nodeType != 3)
            if (!form_view_element.childNodes[z].id) {
              GLOBAL_tr = form_view_element.childNodes[z];
              //////////////////////////////////////////////////////////////////////////////////////////
              for (x = 0; x < GLOBAL_tr.firstChild.childNodes.length; x++) {
                table = GLOBAL_tr.firstChild.childNodes[x];
                tbody = table.firstChild;
                for (y = 0; y < tbody.childNodes.length; y++) {
                  tr = tbody.childNodes[y];
                  l_label = document.getElementById(tr.id + '_element_labelform_id_temp').innerHTML;
                  l_label = l_label.replace(/(\r\n|\n|\r)/gm, " ");

                  if (tr.getAttribute('type') == "type_address") {
                    addr_id = parseInt(tr.id);
                    id_for_country= addr_id;
								
									if(document.getElementById(id_for_country+"_mini_label_street1"))										tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_street1").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 									if(document.getElementById(id_for_country+"_mini_label_street2"))										tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_street2").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 									if(document.getElementById(id_for_country+"_mini_label_city"))										tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_city").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 									if(document.getElementById(id_for_country+"_mini_label_state"))										tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_state").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++;									if(document.getElementById(id_for_country+"_mini_label_postal"))																			tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_postal").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 									if(document.getElementById(id_for_country+"_mini_label_country"))																			tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_country").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#'; 
                  }
                  else
                    tox = tox + tr.id + '#**id**#' + l_label + '#**label**#' + tr.getAttribute('type') + '#****#';
                }
              }
            }
        }
      }
    }
    document.getElementById('label_order').value = tox;
    document.getElementById('label_order_current').value = tox;
    refresh_();
    document.getElementById('pagination').value = document.getElementById('pages').getAttribute("type");
    document.getElementById('show_title').value = document.getElementById('pages').getAttribute("show_title");
    document.getElementById('show_numbers').value = document.getElementById('pages').getAttribute("show_numbers");
    already_submitted = true;
    submitform(pressbutton);
  }
    function submitform(pressbutton) {
      document.getElementById('adminForm').action=document.getElementById('adminForm').action+"&task="+pressbutton;
      document.getElementById('adminForm').submit();
    }
    gen = 1;
    form_view = 1;
    form_view_max = 1;
    form_view_count = 1;
    function set_preview() {
      appWidth = parseInt(document.body.offsetWidth);
      appHeight = parseInt(document.body.offsetHeight);
      document.getElementById('preview_form').href='<?php echo admin_url('admin-ajax.php'); ?>?action=frommakerpreview&id='+document.getElementById('theme').value+'&TB_iframe=1';
    }
    function enable() {
      for (iiiii = 0; iiiii < 1000; iiiii++) {
        if (document.getElementsByTagName("iframe")[iiiii]) {
          if (document.getElementsByTagName("iframe")[iiiii].id == 'form_maker_editor_ifr') {
            id_ifr_editor = iiiii;
            break;
          }
        }
      }
      alltypes = Array('customHTML', 'text', 'checkbox', 'radio', 'time_and_date', 'select', 'file_upload', 'captcha', 'map', 'button', 'page_break', 'section_break', 'paypal', 'survey');
      for (x = 0; x < 14; x++) {
        document.getElementById('img_' + alltypes[x]).src = "<?php echo  plugins_url("images",__FILE__) ?>/" + alltypes[x] + ".png";
      }
      if (document.getElementById('formMakerDiv').style.display == 'block') {
        jQuery('#formMakerDiv').slideToggle(200);
      }
      else {
        jQuery('#formMakerDiv').slideToggle(400);
      }
      if (document.getElementById('formMakerDiv').offsetWidth) {
        document.getElementById('formMakerDiv1').style.width = (document.getElementById('formMakerDiv').offsetWidth - 60) + 'px';
      }
      if (document.getElementById('formMakerDiv1').style.display == 'block') {
        jQuery('#formMakerDiv1').slideToggle(200);
      }
      else {
        jQuery('#formMakerDiv1').slideToggle(400);
      }
      document.getElementById('when_edit').style.display = 'none';
    }
    function enable2() {
      alltypes = Array('customHTML', 'text', 'checkbox', 'radio', 'time_and_date', 'select', 'file_upload', 'captcha', 'map', 'button', 'page_break', 'section_break', 'paypal', 'survey');
      for (x = 0; x < 14; x++) {
        document.getElementById('img_' + alltypes[x]).src = "<?php echo  plugins_url("images",__FILE__) ?>/" + alltypes[x] + ".png";
      }
      if (document.getElementById('formMakerDiv').style.display == 'block') {
        jQuery('#formMakerDiv').slideToggle(200);
      }
      else {
        jQuery('#formMakerDiv').slideToggle(400);
      }
      if (document.getElementById('formMakerDiv').offsetWidth) {
        document.getElementById('formMakerDiv1').style.width = (document.getElementById('formMakerDiv').offsetWidth - 60) + 'px';
      }
      if (document.getElementById('formMakerDiv1').style.display == 'block') {
        jQuery('#formMakerDiv1').slideToggle(200);
      }
      else {
        jQuery('#formMakerDiv1').slideToggle(400);
      }
      document.getElementById('when_edit').style.display = 'block';
      if (document.getElementById('field_types').offsetWidth) {
        document.getElementById('when_edit').style.width = document.getElementById('field_types').offsetWidth + 'px';
      }
      if (document.getElementById('field_types').offsetHeight) {
        document.getElementById('when_edit').style.height = document.getElementById('field_types').offsetHeight + 'px';
      }
    }
    var thickDims, tbWidth, tbHeight;
    jQuery(document).ready(function($) {
      thickDims = function() {
        var tbWindow = jQuery('#TB_window'), H = jQuery(window).height(), W = jQuery(window).width(), w, h;
        w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
        h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;
        if (tbWindow.size()) {
          tbWindow.width(w).height(h);
          jQuery('#TB_iframeContent').width(w).height(h - 27);
          tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
          if (typeof document.body.style.maxWidth != 'undefined') {
            tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
          }
        }
      };
      thickDims();
      jQuery(window).resize(function() { thickDims() });
      jQuery('a.thickbox-preview').click( function() {
        tb_click.call(this);
        var alink = jQuery(this).parents('.available-theme').find('.activatelink'), link = '', href = jQuery(this).attr('href'), url, text;
        if (tbWidth = href.match(/&tbWidth=[0-9]+/)) {
          tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
        }
        else {
          tbWidth = jQuery(window).width() - 120;
        }
        if (tbHeight = href.match(/&tbHeight=[0-9]+/)) {
          tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
        }
        else {
          tbHeight = jQuery(window).height() - 120;
        }
        if (alink.length) {
          url = alink.attr('href') || '';
          text = alink.attr('title') || '';
          link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
        }
        else {
          text = jQuery(this).attr('title') || '';
          link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
        }
        jQuery('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
        jQuery('#TB_closeAjaxWindow').css({'float':'left'});
        jQuery('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);
        jQuery('#TB_iframeContent').width('100%');
        thickDims();
        return false;
      });
      // Theme details.
      jQuery('.theme-detail').click(function () {
        jQuery(this).siblings('.themedetaildiv').toggle();
        return false;
      });
    });
  </script>
  <style>
    .calendar .button {
      display: table-cell !important;
    }
    #when_edit {
      position:absolute;
      background-color:#666;
      z-index:101;
      display:none;
      width:100%;
      height:100%;
      opacity: 0.7;
      filter: alpha(opacity = 70);
    }
    #formMakerDiv {
      position:fixed;
      background-color:#666;
      z-index:100;
      display:none;
      left:0;
      top:0;
      width:100%;
      height:100%;
      opacity: 0.7;
      filter: alpha(opacity = 70);
    }
    #formMakerDiv1 {
      padding-top:15px;
      position:fixed;
      z-index:100;
      background-color:transparent;
      top:0;
      left:0;
      display:none;
      margin-left:30px;
      margin-top:15px;
    }
    .formmaker_table input {
      border-radius: 3px;
      padding: 2px;
    }

    .formmaker_table {
      border-radius: 8px;
      border: 6px #00aeef solid;
      background-color: #00aeef;
      height: 120px;
      width: 98%;
    }
  </style>
  <?php
  foreach ($themes as $theme) {
    if ($theme->default == 1) {		
			$my_selected_theme = $theme->id;
		}	
	}
  ?>
  <div style="font-size:14px; font-weight:bold">
    <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a>
    <br />
    This section allows you to add fields to your form.
    <a href="http://web-dorado.com/wordpress-form-maker-guide-4.html" target="_blank" style="color:blue; text-decoration:none;">More...</a>
  </div>
  <table width="95%">
    <thead>
    <tr>
      <td colspan="11">
        <div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
          <a href="http://web-dorado.com/files/fromFormMaker.php" target="_blank"
             style="color:red; text-decoration:none;">
            <img src="<?php echo plugins_url('images/header.png', __FILE__); ?>" border="0" alt="www.web-dorado.com"
                 width="215"><br>
            Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
          </a>
        </div>
      </td>
    </tr>
    </thead>
    <tr>
      <td width="100%" ><?php echo "<h2>Form Maker</h2>"; ?></td>
      <td>
        <a id="preview_form" href="<?php echo admin_url('admin-ajax.php').'?action=frommakerpreview&id='.$my_selected_theme.'&TB_iframe=1'; ?>" class="thickbox-preview" title="Form Preview" onclick="return false;"><input type="button"  value="preview" class="button-primary" /></a>
      </td>
      <td>
        <input type="button" onclick="submitbutton('form_options')" value="Form options" class="button-primary" />
      </td>
      <td align="right"><input type="button" onclick="submitbutton('Save')" value="Save" class="button-secondary action" /> </td>  
      <td align="right"><input type="button" onclick="submitbutton('Apply')" value="Apply"  class="button-secondary action"/> </td> 
      <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Form_maker'" value="Cancel" class="button-secondary action" /> </td> 
    </tr>
  </table>
  <br />
  <form action="admin.php?page=Form_maker" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
    <div class="formmaker_table" width="100%">
      <div style="float:left; text-align:center">
        </br>
        <img src="<?php echo  plugins_url("images/formmaker.png",__FILE__) ?>"/>
        </br>
        </br>
        <img src="<?php echo  plugins_url("images/logo.png",__FILE__) ?>"/>
      </div>
      <div style="float:right">
        <span style="font-size:16.76pt; font-family:tahoma; color:#FFFFFF; vertical-align:middle;">Form title:&nbsp;&nbsp;</span>
        <input type="hidden" value="<?php echo plugins_url("",__FILE__) ?>" id="form_plugins_url" />
        <input id="title" name="title" style="width:160px; height:19px; border:none; font-size:11px;" value=""/>
        <br />
        <img src="<?php echo plugins_url("images/formoptions.png",__FILE__)  ?>" onclick="submitbutton('form_options')" style="cursor:pointer;margin:10px 0 10px 10px; float:right"/>
        <br />
        <br />
        <br />
        <img src="<?php echo plugins_url("images/addanewfield.png",__FILE__)  ?>" onclick="enable(); Enable()" style="cursor:pointer;margin:10px 0 10px 10px; float:right"/>
      </div>
    </div>
    <div id="formMakerDiv" onclick="close_window()"></div>
    <div id="formMakerDiv1" align="center">
      <table border="0" width="95%" cellpadding="0" cellspacing="0" height="100%" style="border:6px #00aeef solid; background-color:#FFF">
        <tr>
          <td style="padding:0px">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
              <tr valign="top">
                <td width="15%" height="100%" style="border-right:dotted black 1px;" id="field_types">
                  <div id="when_edit" style="display:none"></div>
                  <table border="0" cellpadding="0" cellspacing="3" width="100%">
                    <tr>
                      <td align="center" onClick="addRow('customHTML')" id="table_editor" class="field_buttons"><img
                        src="<?php echo plugins_url("images/customHTML.png", __FILE__); ?>" style="margin:5px"
                        id="img_customHTML"/></td>

                      <td align="center" onClick="addRow('text')" id="table_text" class="field_buttons"><img
                        src="<?php echo plugins_url("images/text.png", __FILE__); ?>" style="margin:5px" id="img_text"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('time_and_date')" id="table_time_and_date" class="field_buttons">
                        <img src="<?php echo plugins_url("images/time_and_date.png", __FILE__); ?>" style="margin:5px"
                             id="img_time_and_date"/></td>

                      <td align="center" onClick="addRow('select')" id="table_select" class="field_buttons"><img
                        src="<?php echo plugins_url("images/select.png", __FILE__); ?>" style="margin:5px" id="img_select"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('checkbox')" id="table_checkbox" class="field_buttons"><img
                        src="<?php echo plugins_url("images/checkbox.png", __FILE__); ?>" style="margin:5px"
                        id="img_checkbox"/></td>

                      <td align="center" onClick="addRow('radio')" id="table_radio" class="field_buttons"><img
                        src="<?php echo plugins_url("images/radio.png", __FILE__); ?>" style="margin:5px" id="img_radio"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center"
                          onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')"
                          style="background-color: rgb(114, 113, 113) !important;" id="table_file_upload"
                          class="field_buttons"><img src="<?php echo plugins_url("images/file_upload.png", __FILE__); ?>"
                                                     style="margin:5px" id="img_file_upload"/></td>

                      <td align="center" onClick="addRow('captcha')" id="table_captcha" class="field_buttons"><img
                        src="<?php echo plugins_url("images/captcha.png", __FILE__); ?>" style="margin:5px"
                        id="img_captcha"/></td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('page_break')" id="table_page_break" class="field_buttons"><img
                        src="<?php echo plugins_url("images/page_break.png", __FILE__); ?>" style="margin:5px"
                        id="img_page_break"/></td>

                      <td align="center" onClick="addRow('section_break')" id="table_section_break" class="field_buttons">
                        <img src="<?php echo plugins_url("images/section_break.png", __FILE__); ?>" style="margin:5px"
                             id="img_section_break"/></td>
                    </tr>
                    <tr>
                      <td align="center"
                          onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')"
                          style="background-color: rgb(114, 113, 113) !important;" id="table_map" class="field_buttons"><img
                        src="<?php echo plugins_url("images/map.png", __FILE__); ?>" style="margin:5px" id="img_map"/></td>
                      <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" style="background-color: rgb(114, 113, 113) !important;" id="table_paypal" class="field_buttons"><img src="<?php echo plugins_url("images/paypal.png",__FILE__); ?>" style="margin:5px" id="img_paypal"/></td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('survey')" class="field_buttons" id="table_survey"><img src="<?php echo plugins_url("images/survey.png", __FILE__); ?>" style="margin:5px" id="img_survey"/></td>
                      <td align="center" onClick="addRow('button')" id="table_button" class="field_buttons"><img src="<?php echo plugins_url("images/button.png", __FILE__); ?>" style="margin:5px" id="img_button"/></td>
                    </tr>
                  </table>
                </td>
                <td width="40%" height="100%" align="left">
                  <div id="edit_table" style="padding:0px; overflow-y:scroll; height:575px"></div>
                </td>
                <td align="center" valign="top" style="background:url(<?php echo plugins_url("images/border2.png",__FILE__); ?>) repeat-y;">&nbsp;</td>
                <td style="padding:15px">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
                    <tr>
                      <td align="right"><input type="radio" value="end" name="el_pos" checked="checked" id="pos_end" onclick="Disable()"/>
                        At The End
                        <input type="radio" value="begin" name="el_pos" id="pos_begin" onclick="Disable()"/>
                        At The Beginning
                        <input type="radio" value="before" name="el_pos" id="pos_before" onclick="Enable()"/>
                        Before
                        <select style="width:100px; margin-left:5px" id="sel_el_pos" disabled="disabled">
                        </select>
                        <img alt="ADD" title="add" style="cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo plugins_url("images/save.png",__FILE__); ?>" onClick="add(0)"/>
                        <img alt="CANCEL" title="cancel"  style=" cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo plugins_url("images/cancel_but.png",__FILE__); ?>" onClick="close_window()"/>
                        <hr style=" margin-bottom:10px" />
                      </td>
                    </tr>
                    <tr height="100%" valign="top">
                      <td  id="show_table"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <input type="hidden" id="old" />
      <input type="hidden" id="old_selected" />
      <input type="hidden" id="element_type" />
      <input type="hidden" id="editing_id" />
      <input type="hidden" id="editing_page_break" />
      <div id="main_editor" style="position:absolute; display:none; z-index:140;">
        <?php
        if (function_exists ('the_editor') || function_exists ('wp_editor')) {
          if (get_bloginfo('version') < '3.3') {
          ?>
        <div style=" max-width:500px; height:300px;text-align:left" id="poststuff">
          <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea"><?php the_editor("","form_maker_editor","title",$media_buttons = true, $tab_index = 1, $extended = true ); ?>
          </div>
        </div>
          <?php
          }
          else {
            echo "<style>#wp-form_maker_editor-media-buttons{ text-align:left }</style>"; wp_editor("","form_maker_editor");
          }
        }
        else {
        ?>
        <textarea name="editor" id="editor" cols="40" rows="6" style="width: 450px; height: 350px; " class="mce_editable" aria-hidden="true"></textarea>
        <?php
        }
        ?>
      </div>
    </div>
    <?php
    if (!function_exists ('the_editor')) {
    ?>
      <iframe id="tinymce" style="display:none"></iframe>
    <?php
    }
    ?>
    <br />
    <br />
    <fieldset>
      <legend><h2 style="color:#00aeef">Form</h2></legend>
      <style><?php global $first_css; echo $first_css; ?></style>
      <table width="100%" style="margin:8px">
        <tr id="page_navigation">
          <td align="center" width="90%" id="pages" show_title="false" show_numbers="true" type="none"></td>
          <td align="left" id="edit_page_navigation"></td>
        </tr>
      </table>
      <div id="take" class="main">
        <table cellpadding="4" cellspacing="0" class="wdform_table1" style="border-top:0px solid black;">
          <tbody id="form_id_tempform_view1" class="wdform_tbody1" page_title="Untitled page" next_title="Next" next_type="button" next_class="wdform_page_button" next_checkable="false" previous_title="Previous" previous_type="button" previous_class="wdform_page_button" previous_checkable="false">
            <tr class="wdform_tr1">
              <td class="wdform_td1" >
                <table class="wdform_table2">
                  <tbody class="wdform_tbody2"></tbody>
                </table>
              </td>
            </tr>
            <tr class="wdform_footer">
              <td colspan="100" valign="top">
                <table width="100%" style="padding-right:170px"><tbody><tr id="form_id_temppage_nav1"></tr></tbody></table>
              </td>
            </tr>
            <tbody id="form_id_tempform_view_img1" style="float:right !important ;" >
              <tr>
                <td width="0%"></td>
                <td align="right">
                  <img src="<?php echo plugins_url("images/minus.png",__FILE__); ?>" title="Show or hide the page" class="page_toolbar" onclick="show_or_hide('1')" onmouseover="chnage_icons_src(this,'minus')"  onmouseout="chnage_icons_src(this,'minus')" id="show_page_img_1" />
                </td>
                <td>
                  <img src="<?php echo plugins_url("images/page_delete.png",__FILE__); ?>" title="Delete the page"  class="page_toolbar" onclick="remove_page('1')" onmouseover="chnage_icons_src(this,'page_delete')"  onmouseout="chnage_icons_src(this,'page_delete')" />
                </td>
                <td>
                  <img src="<?php echo plugins_url("images/page_delete_all.png",__FILE__); ?>" title="Delete the page with fields"  class="page_toolbar" onclick="remove_page_all('1')" onmouseover="chnage_icons_src(this,'page_delete_all')"  onmouseout="chnage_icons_src(this,'page_delete_all')" />
                </td>
                <td>
                  <img src="<?php echo plugins_url("images/page_edit.png",__FILE__); ?>" title="Edit the page"  class="page_toolbar" onclick="edit_page_break('1')" onmouseover="chnage_icons_src(this,'page_edit')"  onmouseout="chnage_icons_src(this,'page_edit')" />
                </td>
              </tr>
          </tbody>
        </table>
      </div>
    </fieldset>
    <input type="hidden" name="form_front" id="form_front" />
    <input type="hidden" name="form" id="form" />
    <input type="hidden" name="counter" id="counter" />
    <input type="hidden" name="pagination" id="pagination" />
    <input type="hidden" name="show_title" id="show_title" />
    <input type="hidden" name="show_numbers" id="show_numbers" />
    <input type="hidden" name="public_key" id="public_key" />
    <input type="hidden" name="private_key" id="private_key" />
    <input type="hidden" name="recaptcha_theme" id="recaptcha_theme" />
    <input type="hidden" name="script_mail" id="script_mail" value="%all%"/>
    <input type="hidden" name="script_mail_user" id="script_mail_user" value="%all%"/>
    <input type="hidden" name="label_order" id="label_order" />
    <input type="hidden" name="label_order_current" id="label_order_current"/>
    <input type="hidden" name="option" value="com_formmaker" />
    <input type="hidden" name="task" value="" />
  </form>
  <script>
    plugin_url = document.getElementById('form_plugins_url').value;
    //appWidth			=parseInt(document.body.offsetWidth);
    //appHeight			=parseInt(document.body.offsetHeight);
    //document.getElementById('toolbar-popup-popup').childNodes[1].href='index.php?option=com_formmaker&task=preview&tmpl=component&theme='+document.getElementById('theme').value;
    //document.getElementById('toolbar-popup-popup').childNodes[1].setAttribute('rel',"{handler: 'iframe', size: {x:"+(appWidth-100)+", y: "+(appHeight-30)+"}}");
  </script>
  <?php
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function html_edit_form_maker($row, $labels, $themes) {
  ?>
  <script type="text/javascript">
    // Edit paypal properties page open in popup.
    function form_maker_edit_in_popup(id) {
      // $ = jQuery;
      var thickDims, tbWidth, tbHeight;
      thickDims = function() {
        var tbWindow = jQuery('#TB_window'), H = jQuery(window).height(), W = jQuery(window).width(), w, h;
        w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
        h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;
        if (tbWindow.size()) {
          tbWindow.width(w).height(h);
          jQuery('#TB_iframeContent').width(w).height(h - 27);
          tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
          if (typeof document.body.style.maxWidth != 'undefined') {
            tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
          }
        }
      };
      thickDims();
      jQuery(window).resize( function() { thickDims() } );
      jQuery('a.thickbox-preview' + id).click( function() {
        tb_click.call(this);
        var alink = jQuery(this).parents('.available-theme').find('.activatelink'), link = '', href = jQuery(this).attr('href'), url, text;
        if (tbWidth = href.match(/&tbWidth=[0-9]+/)) {
          tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
        }
        else {
          tbWidth = jQuery(window).width() - 120;
        }
        if (tbHeight = href.match(/&tbHeight=[0-9]+/)) {
          tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
        }
        else {
          tbHeight = jQuery(window).height() - 120;
        }
        if (alink.length) {
          url = alink.attr('href') || '';
          text = alink.attr('title') || '';
          link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
        }
        else {
          text = jQuery(this).attr('title') || '';
          link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
        }
        jQuery('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
        jQuery('#TB_closeAjaxWindow').css({'float':'left'});
        jQuery('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);
        jQuery('#TB_iframeContent').width('100%');
        thickDims();
        return false;
      });
    }
    function submitform(pressbutton) {
      document.getElementById('adminForm').action=document.getElementById('adminForm').action+"&task="+pressbutton;
      document.getElementById('adminForm').submit();
    }
    function submitbutton(pressbutton) {
      if (!document.getElementById('araqel')) {
        alert('Please wait while page loading');
        return;
      }
      else
        if(document.getElementById('araqel').value=='0')
        {
          alert('Please wait while page loading');
          return;
        }
      var form = document.adminForm;
      if (pressbutton == 'cancel') {
        submitform(pressbutton);
        return;
      }
      if (form.title.value == "")	{
				alert("The form must have a title.");	
				return;
      }
	    tox = '';
      l_id_array=[<?php echo $labels['id']?>];
      l_label_array=[<?php echo $labels['label']?>];
      l_type_array=[<?php echo $labels['type']?>];
      l_id_removed=[];      
      for (x=0; x< l_id_array.length; x++) {
        l_id_removed[l_id_array[x]]=true;
      }
      for (t=1;t<=form_view_max;t++) {
        if(document.getElementById('form_id_tempform_view'+t))
        {
          form_view_element=document.getElementById('form_id_tempform_view'+t);		
          n=form_view_element.childNodes.length-2;
          
          for(q=0;q<=n;q++)
          {
              if(form_view_element.childNodes[q].nodeType!=3)
              if(!form_view_element.childNodes[q].id)
              {
                GLOBAL_tr=form_view_element.childNodes[q];
                
                for (x=0; x < GLOBAL_tr.firstChild.childNodes.length; x++)
                {
            
                  table=GLOBAL_tr.firstChild.childNodes[x];
                  tbody=table.firstChild;
                  for (y=0; y < tbody.childNodes.length; y++)
                  {
                    is_in_old=false;
                    tr=tbody.childNodes[y];
                    l_id=tr.id;
                    
                    l_label=document.getElementById( tr.id+'_element_labelform_id_temp').innerHTML;
                    l_label = l_label.replace(/(\r\n|\n|\r)/gm," ");
                    l_type=tr.getAttribute('type');
                    for (z = 0; z < l_id_array.length; z++) {
                      if (l_id_array[z] == l_id) {
                        if (l_type_array[z] == "type_address") {
                          if (document.getElementById(l_id + "_mini_label_street1")) {
                            l_id_removed[l_id_array[z]] = false;
                          }
                          if (document.getElementById(l_id+"_mini_label_street2")) {
                            l_id_removed[parseInt(l_id_array[z]) + 1] = false;
                          }
                          if (document.getElementById(l_id+"_mini_label_city")) {
                            l_id_removed[parseInt(l_id_array[z]) + 2] = false;	
                          }
                          if (document.getElementById(l_id+"_mini_label_state")) {
                            l_id_removed[parseInt(l_id_array[z]) + 3] = false;
                          }
                          if (document.getElementById(l_id+"_mini_label_postal")) {
                            l_id_removed[parseInt(l_id_array[z]) + 4] = false;
                          }
                          if (document.getElementById(l_id+"_mini_label_country")) {
                            l_id_removed[parseInt(l_id_array[z]) + 5] = false;	
                          }
                          z = z + 5;
                        }
                        else {
                          l_id_removed[l_id] = false;
                        }
                      }
                    }
                    
                      if(tr.getAttribute('type')=="type_address") {
                        addr_id=parseInt(tr.id);
                        id_for_country= addr_id;
                        if(document.getElementById(id_for_country+"_mini_label_street1"))
                          tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_street1").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 
                        if(document.getElementById(id_for_country+"_mini_label_street2"))
                          tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_street2").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';addr_id++; 
                        if(document.getElementById(id_for_country+"_mini_label_city"))
                          tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_city").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
                        if(document.getElementById(id_for_country+"_mini_label_state"))
                          tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_state").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++;
                        if(document.getElementById(id_for_country+"_mini_label_postal"))									
                          tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_postal").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#';	addr_id++; 
                        if(document.getElementById(id_for_country+"_mini_label_country"))									
                          tox=tox+addr_id+'#**id**#'+document.getElementById(id_for_country+"_mini_label_country").innerHTML+'#**label**#'+tr.getAttribute('type')+'#****#'; 
                      }
                      else {
                        tox=tox+l_id+'#**id**#'+l_label+'#**label**#'+l_type+'#****#';
                      }
                  }
                }
              }
          }
        }	
      }
      document.getElementById('label_order_current').value = tox;
      for (x = 0; x < l_id_array.length; x++) {
        if (l_id_removed[l_id_array[x]]) {
          tox = tox + l_id_array[x] + '#**id**#' + l_label_array[x] + '#**label**#' + l_type_array[x] + '#****#';
        }
      }
      document.getElementById('label_order').value = tox;
      refresh_();
      document.getElementById('pagination').value=document.getElementById('pages').getAttribute("type");
      document.getElementById('show_title').value=document.getElementById('pages').getAttribute("show_title");
      document.getElementById('show_numbers').value=document.getElementById('pages').getAttribute("show_numbers");
      submitform( pressbutton );
    }

    function remove_whitespace(node) {
      var ttt;
      for (ttt = 0; ttt < node.childNodes.length; ttt++) {
        if (node.childNodes[ttt] && node.childNodes[ttt].nodeType == '3' && !/\S/.test(node.childNodes[ttt].nodeValue)) {
          node.removeChild(node.childNodes[ttt]);
          ttt--;
        }
        else {
          if (node.childNodes[ttt].childNodes.length) {
            remove_whitespace(node.childNodes[ttt]);
          }
        }
      }
      return;
    }
    function refresh_() {
      document.getElementById('form').value = document.getElementById('take').innerHTML;
      document.getElementById('counter').value = gen;
      n = gen;
      for (i = 0; i < n; i++) {
        if (document.getElementById(i)) {
          for (z = 0; z < document.getElementById(i).childNodes.length; z++)
            if (document.getElementById(i).childNodes[z].nodeType == 3)
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[z]);

          if (document.getElementById(i).getAttribute('type') == "type_captcha" || document.getElementById(i).getAttribute('type') == "type_recaptcha") {
            if (document.getElementById(i).childNodes[10]) {
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            }
            else {
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
              document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            }
            continue;
          }

          if (document.getElementById(i).getAttribute('type') == "type_section_break") {
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            continue;
          }


          if (document.getElementById(i).childNodes[10]) {
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
          }
          else {
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
            document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
          }
        }
      }

      for (i = 0; i <= n; i++) {
        if (document.getElementById(i)) {
          type = document.getElementById(i).getAttribute("type");
          switch (type) {
            case "type_text":
            case "type_number":
            case "type_password":
            case "type_submitter_mail":
            case "type_own_select":
            case "type_country":
            case "type_hidden":
            case "type_map":
            {
              remove_add_(i + "_elementform_id_temp");
              break;
            }

            case "type_submit_reset":
            {
              remove_add_(i + "_element_submitform_id_temp");
              if (document.getElementById(i + "_element_resetform_id_temp"))
                remove_add_(i + "_element_resetform_id_temp");
              break;
            }

            case "type_captcha":
            {
              remove_add_("_wd_captchaform_id_temp");
              remove_add_("_element_refreshform_id_temp");
              remove_add_("_wd_captcha_inputform_id_temp");
              break;
            }

            case "type_recaptcha":
            {
              document.getElementById("public_key").value = document.getElementById("wd_recaptchaform_id_temp").getAttribute("public_key");
              document.getElementById("private_key").value = document.getElementById("wd_recaptchaform_id_temp").getAttribute("private_key");
              document.getElementById("recaptcha_theme").value = document.getElementById("wd_recaptchaform_id_temp").getAttribute("theme");
              document.getElementById('wd_recaptchaform_id_temp').innerHTML = '';
              remove_add_("wd_recaptchaform_id_temp");
              break;
            }

            case "type_file_upload":
            {
              remove_add_(i + "_elementform_id_temp");

              break;
            }

            case "type_textarea":
            {
              remove_add_(i + "_elementform_id_temp");

              break;
            }

            case "type_name":
            {

              if (document.getElementById(i + "_element_titleform_id_temp")) {
                remove_add_(i + "_element_titleform_id_temp");
                remove_add_(i + "_element_firstform_id_temp");
                remove_add_(i + "_element_lastform_id_temp");
                remove_add_(i + "_element_middleform_id_temp");
              }
              else {
                remove_add_(i + "_element_firstform_id_temp");
                remove_add_(i + "_element_lastform_id_temp");
              }
              break;

            }

            case "type_phone":
            {

              remove_add_(i + "_element_firstform_id_temp");
              remove_add_(i + "_element_lastform_id_temp");
              break;

            }
            case "type_address":
            {
              if (document.getElementById(id_for_country+"_disable_fieldsform_id_temp")) {
                if(document.getElementById(id_for_country+"_disable_fieldsform_id_temp").getAttribute('street1')=='no')
                  remove_add_(i+"_street1form_id_temp");
                if(document.getElementById(id_for_country+"_disable_fieldsform_id_temp").getAttribute('street2')=='no')	
                  remove_add_(i+"_street2form_id_temp");
                if(document.getElementById(id_for_country+"_disable_fieldsform_id_temp").getAttribute('city')=='no')
                  remove_add_(i+"_cityform_id_temp");
                if(document.getElementById(id_for_country+"_disable_fieldsform_id_temp").getAttribute('state')=='no')
                  remove_add_(i+"_stateform_id_temp");
                if(document.getElementById(id_for_country+"_disable_fieldsform_id_temp").getAttribute('postal')=='no')
                  remove_add_(i+"_postalform_id_temp");
                if(document.getElementById(id_for_country+"_disable_fieldsform_id_temp").getAttribute('country')=='no')
                  remove_add_(i+"_countryform_id_temp");
              }
              break;

            }


            case "type_checkbox":
            case "type_radio":
            {
              is = true;
              for (j = 0; j < 100; j++)
                if (document.getElementById(i + "_elementform_id_temp" + j)) {
                  remove_add_(i + "_elementform_id_temp" + j);
                }
              break;
            }
            case "type_star_rating":
						{	
							remove_add_(i+"_elementform_id_temp");
						
								break;
						}	
						
            case "type_scale_rating":
						{	
						remove_add_(i+"_elementform_id_temp");
						
								break;
						}
            case "type_spinner":
						{	
						remove_add_(i+"_elementform_id_temp");
						
								break;
						}
            case "type_slider":
						{	
						remove_add_(i+"_elementform_id_temp");
										
								break;
						}
            case "type_range":
						{	
						remove_add_(i+"_elementform_id_temp0");
						remove_add_(i+"_elementform_id_temp1");
							
								break;
						}
            case "type_grading":
						{
							
							for(k=0; k<100; k++)
								if(document.getElementById(i+"_elementform_id_temp"+k))
								{
									remove_add_(i+"_elementform_id_temp"+k);
								}
						
							
							break;
						}
            case "type_matrix":
						{	
						remove_add_(i+"_elementform_id_temp");
						
								break;
						}

            case "type_button":
            {
              for (j = 0; j < 100; j++)
                if (document.getElementById(i + "_elementform_id_temp" + j)) {
                  remove_add_(i + "_elementform_id_temp" + j);
                }
              break;
            }

            case "type_time":
            {
              if (document.getElementById(i + "_ssform_id_temp")) {
                remove_add_(i + "_ssform_id_temp");
                remove_add_(i + "_mmform_id_temp");
                remove_add_(i + "_hhform_id_temp");
              }
              else {
                remove_add_(i + "_mmform_id_temp");
                remove_add_(i + "_hhform_id_temp");

              }
              break;

            }

            case "type_date":
            {
              remove_add_(i + "_elementform_id_temp");
              remove_add_(i + "_buttonform_id_temp");

              break;
            }
            case "type_date_fields":
            {
              remove_add_(i + "_dayform_id_temp");
              remove_add_(i + "_monthform_id_temp");
              remove_add_(i + "_yearform_id_temp");
              break;
            }
          }
        }
      }

      for (i = 1; i <= form_view_max; i++) {
        if (document.getElementById('form_id_tempform_view' + i)) {
          if (document.getElementById('page_next_' + i))
            document.getElementById('page_next_' + i).removeAttribute('src');
          if (document.getElementById('page_previous_' + i))
            document.getElementById('page_previous_' + i).removeAttribute('src');

          document.getElementById('form_id_tempform_view' + i).parentNode.removeChild(document.getElementById('form_id_tempform_view_img' + i));
          document.getElementById('form_id_tempform_view' + i).removeAttribute('style');
        }
      }

      for (t = 1; t <= form_view_max; t++) {
        if (document.getElementById('form_id_tempform_view' + t)) {
          form_view_element = document.getElementById('form_id_tempform_view' + t);
          remove_whitespace(form_view_element);
          n = form_view_element.childNodes.length - 2;
          for (q = 0; q <= n; q++) {
            if (form_view_element.childNodes[q]) {
              if (form_view_element.childNodes[q].nodeType != 3) {
                if (!form_view_element.childNodes[q].id) {
                  del = true;
                  GLOBAL_tr = form_view_element.childNodes[q];
                  for (x = 0; x < GLOBAL_tr.firstChild.childNodes.length; x++) {
                    table = GLOBAL_tr.firstChild.childNodes[x];
                    tbody = table.firstChild;
                    if (tbody.childNodes.length) {
                      del = false;
                    }
                  }

                  if (del) {
                    form_view_element.removeChild(form_view_element.childNodes[q]);
                  }
                }
              }
            }
          }
        }
      }
      document.getElementById('form_front').value = document.getElementById('take').innerHTML;
    }
    function set_preview() {
      appWidth = parseInt(document.body.offsetWidth);
      appHeight = parseInt(document.body.offsetHeight);
      document.getElementById('preview_form').href = '<?php echo admin_url('admin-ajax.php'); ?>?action=frommakerpreview&id='+document.getElementById('theme').value+'&TB_iframe=1';
    }
    gen = <?php echo $row->counter; ?>;
    function enable() {
      for (iiiii = 0; iiiii < 1000; iiiii++) {
        if (document.getElementsByTagName("iframe")[iiiii]) {
          if (document.getElementsByTagName("iframe")[iiiii].id == 'form_maker_editor_ifr') {
            id_ifr_editor = iiiii;
            break;
          }
        }
      }
      alltypes = Array('customHTML', 'text', 'checkbox', 'radio', 'time_and_date', 'select', 'file_upload', 'captcha', 'map', 'button', 'page_break', 'section_break', 'paypal', 'survey');
      for (x = 0; x < 14; x++) {
        document.getElementById('img_' + alltypes[x]).src = "<?php echo plugins_url("images/",__FILE__) ?>" + alltypes[x] + ".png";
      }
      if (document.getElementById('formMakerDiv').style.display == 'block') {
        jQuery('#formMakerDiv').slideToggle(200);
      }
      else {
        jQuery('#formMakerDiv').slideToggle(400);
      }
      if (document.getElementById('formMakerDiv').offsetWidth) {
        document.getElementById('formMakerDiv1').style.width = (document.getElementById('formMakerDiv').offsetWidth - 60) + 'px';
      }
      if (document.getElementById('formMakerDiv1').style.display == 'block') {
        jQuery('#formMakerDiv1').slideToggle(200);
      }
      else {
        jQuery('#formMakerDiv1').slideToggle(400);
      }
      document.getElementById('when_edit').style.display = 'none';
    }
    function enable2() {
      alltypes = Array('customHTML', 'text', 'checkbox', 'radio', 'time_and_date', 'select', 'file_upload', 'captcha', 'map', 'button', 'page_break', 'section_break', 'paypal', 'survey');
      for (x = 0; x < 14; x++) {
        document.getElementById('img_' + alltypes[x]).src = "<?php echo plugins_url("images/",__FILE__) ?>" + alltypes[x] + ".png";
      }
      if (document.getElementById('formMakerDiv').style.display == 'block') {
        jQuery('#formMakerDiv').slideToggle(200);
      }
      else {
        jQuery('#formMakerDiv').slideToggle(400);
      }
      if (document.getElementById('formMakerDiv').offsetWidth) {
        document.getElementById('formMakerDiv1').style.width = (document.getElementById('formMakerDiv').offsetWidth - 60) + 'px';
      }
      if (document.getElementById('formMakerDiv1').style.display == 'block') {
        jQuery('#formMakerDiv1').slideToggle(200);
      }
      else {
        jQuery('#formMakerDiv1').slideToggle(400);
      }
      document.getElementById('when_edit').style.display = 'block';
      if (document.getElementById('field_types').offsetWidth) {
        document.getElementById('when_edit').style.width = document.getElementById('field_types').offsetWidth + 'px';
      }
      if (document.getElementById('field_types').offsetHeight) {
        document.getElementById('when_edit').style.height = document.getElementById('field_types').offsetHeight + 'px';
      }
    }
    var thickDims, tbWidth, tbHeight;
    jQuery(document).ready(function($) {
      thickDims = function() {
        var tbWindow = jQuery('#TB_window'), H = jQuery(window).height(), W = jQuery(window).width(), w, h;
        w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
        h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;
        if (tbWindow.size()) {
          tbWindow.width(w).height(h);
          jQuery('#TB_iframeContent').width(w).height(h - 27);
          tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
          if (typeof document.body.style.maxWidth != 'undefined') {
            tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
          }
        }
      };
      thickDims();
      jQuery(window).resize(function() { thickDims() });
      jQuery('a.thickbox-preview').click( function() {
        tb_click.call(this);
        var alink = jQuery(this).parents('.available-theme').find('.activatelink'), link = '', href = jQuery(this).attr('href'), url, text;
        if (tbWidth = href.match(/&tbWidth=[0-9]+/)) {
          tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
        }
        else {
          tbWidth = jQuery(window).width() - 120;
        }
        if (tbHeight = href.match(/&tbHeight=[0-9]+/)) {
          tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
        }
        else {
          tbHeight = jQuery(window).height() - 120;
        }
        if (alink.length) {
          url = alink.attr('href') || '';
          text = alink.attr('title') || '';
          link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
        }
        else {
          text = jQuery(this).attr('title') || '';
          link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
        }
        jQuery('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
        jQuery('#TB_closeAjaxWindow').css({'float':'left'});
        jQuery('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);
        jQuery('#TB_iframeContent').width('100%');
        thickDims();
        return false;
      });
      // Theme details
      jQuery('.theme-detail').click(function () {
        jQuery(this).siblings('.themedetaildiv').toggle();
        return false;
      });
    });
  </script>
  <style>
    .calendar .button {
      display: table-cell !important;
    }
    #when_edit {
      position:absolute;
      background-color:#666;
      z-index:101;
      display:none;
      width:100%;
      height:100%;
      opacity: 0.7;
      filter: alpha(opacity = 70);
    }
    #formMakerDiv {
      position:fixed;
      background-color:#666;
      z-index:100;
      display:none;
      left:0;
      top:0;
      width:100%;
      height:100%;
      opacity: 0.7;
      filter: alpha(opacity = 70);
    }
    #formMakerDiv1 {
      padding-top:15px;
      position:fixed;
      z-index:100;
      background-color:transparent;
      top:0;
      left:0;
      display:none;
      margin-left:30px;
      margin-top:15px;
    }
    .formmaker_table input {
      border-radius: 3px;
      padding: 2px;
    }
    .formmaker_table {
      border-radius: 8px;
      border: 6px #00aeef solid;
      background-color: #00aeef;
      height: 120px;
      width: 98%;
    }
    .formMakerDiv1_table {
      border: 6px #00aeef solid;
      background-color: #FFF;
      border-radius: 8px;
    }
  </style>
  <div style="font-size:14px; font-weight:bold">
    <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a>
    <br />
    This section allows you to add fields to your form.
    <a href="http://web-dorado.com/wordpress-form-maker-guide-4.html" target="_blank" style="color:blue; text-decoration:none;">More...</a>
  </div>
  <table width="95%">
    <thead>
    <tr>
      <td colspan="11">
        <div style="text-align:right;font-size:16px;padding:20px; padding-right:50px; width:100%">
          <a href="http://web-dorado.com/files/fromFormMaker.php" target="_blank"
             style="color:red; text-decoration:none;">
            <img src="<?php echo plugins_url('images/header.png', __FILE__); ?>" border="0" alt="www.web-dorado.com"
                 width="215"><br>
            Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
          </a>
        </div>
      </td>
    </tr>
    </thead>
    <tr>
      <td width="100%"><?php echo "<h2>Form Maker</h2>"; ?></td>
      <td><a id="preview_form"
             href="<?php echo admin_url('admin-ajax.php') . '?action=frommakerpreview&id=' . $row->theme . '&TB_iframe=1'; ?>"
             class="thickbox-preview" title="Form Preview" onclick="return false;"><input type="button" value="preview"
                                                                                          class="button-primary"/></a>
      </td>
      <td><input type="button" onclick="submitbutton('form_options')" value="Form options" class="button-primary" /></td>
      <td style="width:300px"><input type="button" onclick="submitbutton('save_as_copy')" value="Save As Copy" class="button-secondary action" /> </td>
      <td align="right"><input type="button" onclick="submitbutton('Save')" value="Save" class="button-secondary action"/>
      </td>
      <td align="right"><input type="button" onclick="submitbutton('Apply')" value="Apply"
                               class="button-secondary action"/></td>
      <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Form_maker'" value="Cancel"
                               class="button-secondary action"/></td>
    </tr>
  </table>
  <br />
  <form action="admin.php?page=Form_maker&id=<?php echo $row->id; ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    <div class="formmaker_table" width="100%">
      <div style="float:left; text-align:center">
        </br>
        <img src="<?php echo plugins_url("images/formmaker.png",__FILE__) ?>"/>
        </br>
        </br>
        <img src="<?php echo plugins_url("images/logo.png",__FILE__) ?>"/>
      </div>
      <div style="float:right">
        <span style="font-size:16.76pt; font-family:tahoma; color:#FFFFFF; vertical-align:middle;">Form title:&nbsp;&nbsp;</span>
        <input id="title" name="title" style="width:160px; height:19px; border:none; font-size:11px;" value="<?php echo $row->title; ?>"/>
        <br />
        <img src="<?php echo plugins_url("images/formoptions.png",__FILE__)  ?>" onclick="submitbutton('form_options')" style="cursor:pointer;margin:10px 0 10px 10px; float:right"/>
        <br />
        <br />
        <br />
        <img src="<?php echo plugins_url("images/addanewfield.png",__FILE__) ?>" onclick="enable(); Enable()" style="cursor:pointer;margin:10px 0 10px 10px; float:right"/>
      </div>
    </div>
    <div id="formMakerDiv" onclick="close_window()"></div>
    <div id="formMakerDiv1" style="padding-top:20px" align="center">
      <table border="0" width="100%" cellpadding="0" cellspacing="0" height="100%" style="border:6px #00aeef solid; background-color:#FFF">
        <tr>
          <td style="padding:0px">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
              <tr valign="top">
                <td width="15%" height="100%" style="border-right:dotted black 1px;" id="field_types">
                  <div id="when_edit" style="display:none"></div>
                  <table border="0" cellpadding="0" cellspacing="3" width="100%">
                    <tr>
                      <td align="center" onClick="addRow('customHTML')" style="cursor:pointer" id="table_editor"
                          class="field_buttons"><img src="<?php echo plugins_url("images/customHTML.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_customHTML"/></td>

                      <td align="center" onClick="addRow('text')" style="cursor:pointer" id="table_text"
                          class="field_buttons"><img src="<?php echo plugins_url("images/text.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_text"/></td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('time_and_date')" style="cursor:pointer" id="table_time_and_date"
                          class="field_buttons"><img src="<?php echo plugins_url("images/time_and_date.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_time_and_date"/></td>

                      <td align="center" onClick="addRow('select')" style="cursor:pointer" id="table_select"
                          class="field_buttons"><img src="<?php echo plugins_url("images/select.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_select"/></td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('checkbox')" style="cursor:pointer" id="table_checkbox"
                          class="field_buttons"><img src="<?php echo plugins_url("images/checkbox.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_checkbox"/></td>

                      <td align="center" onClick="addRow('radio')" style="cursor:pointer" id="table_radio"
                          class="field_buttons"><img src="<?php echo plugins_url("images/radio.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_radio"/></td>
                    </tr>
                    <tr>
                      <td align="center"
                          onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')"
                          style="background-color: rgb(114, 113, 113) !important; cursor:pointer" id="table_file_upload"
                          class="field_buttons"><img src="<?php echo plugins_url("images/file_upload.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_file_upload"/></td>

                      <td align="center" onClick="addRow('captcha')" style="cursor:pointer" id="table_captcha"
                          class="field_buttons"><img src="<?php echo plugins_url("images/captcha.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_captcha"/></td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('page_break')" style="cursor:pointer" id="table_page_break"
                          class="field_buttons"><img src="<?php echo plugins_url("images/page_break.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_page_break"/></td>

                      <td align="center" onClick="addRow('section_break')" style="cursor:pointer" id="table_section_break"
                          class="field_buttons"><img src="<?php echo plugins_url("images/section_break.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_section_break"/></td>
                    </tr>
                    <tr>
                      <td align="center"
                          onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')"
                          style="background-color: rgb(114, 113, 113) !important; cursor:pointer" id="table_map"
                          class="field_buttons"><img src="<?php echo plugins_url("images/map.png", __FILE__) ?>"
                                                     style="margin:5px" id="img_map"/></td>
                      <td align="center" onClick="alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.')" style="background-color: rgb(114, 113, 113) !important; id="table_paypal" class="field_buttons">
                        <img src="<?php echo plugins_url("images/paypal.png",__FILE__) ?>" style="margin:5px" id="img_paypal"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" onClick="addRow('survey')" class="field_buttons" id="table_survey"><img src="<?php echo plugins_url("images/survey.png", __FILE__); ?>" style="margin:5px" id="img_survey"/></td>
                      <td align="center" onClick="addRow('button')" id="table_button" class="field_buttons"><img src="<?php echo plugins_url("images/button.png", __FILE__); ?>" style="margin:5px" id="img_button"/></td>
                    </tr>
                  </table>
                </td>
                <td width="35%" height="100%" align="left">
                  <div id="edit_table" style="padding:0px; overflow-y:scroll; height:575px"></div>
                </td>
                <td align="center" valign="top" style="background:url(<?php echo plugins_url("images/border2.png",__FILE__) ?>) repeat-y;">&nbsp;</td>
                <td style="padding:15px">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
                    <tr>
                      <td align="right">
                        <input type="radio" value="end" name="el_pos" checked="checked" id="pos_end" onclick="Disable()"/>
                        At The End
                        <input type="radio" value="begin" name="el_pos" id="pos_begin" onclick="Disable()"/>
                        At The Beginning
                        <input type="radio" value="before" name="el_pos" id="pos_before" onclick="Enable()"/>
                        Before
                        <select style="width:100px; margin-left:5px" id="sel_el_pos" disabled="disabled"></select>
                        <img alt="ADD" title="add" style="cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo plugins_url("images/save.png",__FILE__) ?>" onClick="add(0)"/>
                        <img alt="CANCEL" title="cancel"  style=" cursor:pointer; vertical-align:middle; margin:5px" src="<?php echo plugins_url("images/cancel_but.png",__FILE__) ?>" onClick="close_window()"/>
				               	<hr style=" margin-bottom:10px" />
                      </td>
                    </tr>
                    <tr height="100%" valign="top">
                      <td id="show_table"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <input type="hidden" id="old" />
      <input type="hidden" id="old_selected" />
      <input type="hidden" id="element_type" />
      <input type="hidden" id="editing_id" />
      <input type="hidden" value="<?php echo plugins_url("",__FILE__) ?>" id="form_plugins_url" />
      <div id="main_editor" style="position:absolute; display:none; z-index:140;">
        <?php
        if (function_exists ('the_editor') || function_exists ('wp_editor')) {
          if (get_bloginfo('version') < '3.3') {
        ?>
        <div  style=" max-width:500px; height:300px;text-align:left" id="poststuff">
          <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea"><?php the_editor("","form_maker_editor","title",$media_buttons = true, $tab_index = 1, $extended = true ); ?></div>
        </div>
          <?php
          }
          else {
            echo "<style>#wp-form_maker_editor-media-buttons{ text-align:left }</style>"; wp_editor("","form_maker_editor");
          }
        }
        else {
        ?>
        <textarea name="form_maker_editor" id="form_maker_editor" cols="40" rows="6" style="width: 440px; height: 350px; " class="mce_editable" aria-hidden="true"></textarea>
        <?php
        }
        ?>
      </div>
    </div>
    <?php
    if (!function_exists ('the_editor')) {
      ?>
      <iframe id="tinymce" style="display:none"></iframe>
      <?php
    }
    ?>
    <br />
    <br />
    <fieldset>
      <legend><h2 style="color:#00aeef">Form</h2></legend>
      <?php
      global $first_css;
      echo '<style>'.$first_css.'</style>';
      ?>
      <table width="100%" style="margin:8px">
        <tr id="page_navigation">
          <td align="center" width="90%" id="pages" show_title="<?php echo $row->show_title; ?>" show_numbers="<?php echo $row->show_numbers; ?>" type="<?php echo $row->pagination; ?>">
          </td>
          <td align="left" id="edit_page_navigation"></td>
        </tr>
      </table>
      <div id="take">
        <?php
        if ($row->form) {
          echo $row->form;
        }
        else {
          echo '<table border="0" cellpadding="4" cellspacing="0" class="wdform_table1" width="100%" style="border-top:0px solid black;"><tbody id="form_view1" style="float:left;" page_title="Untitled page" next_title="Next" next_type="button" next_class="" next_checkable="true" previous_title="Previous" previous_type="button" previous_class="" previous_checkable="true"><tr><td valign="top"><table class="wdform_table2"><tbody></tbody></table></td></tr><tr><td colspan="100" valign="top"><table width="100%" style="padding-right:170px"><tbody><tr id="page_nav1"></tr></tbody></table></td></tr><tbody id="form_view_img1" style="float:right ;display:none" ><tr><td width="0%"></td><td align="right"><img src="'.plugins_url("images/minus.png",__FILE__).'" title="Show or hide the page" class="page_toolbar" onclick="show_or_hide("1")" id="show_page_img_1" /></td><td><img src="'.plugins_url("images/page_delete.png",__FILE__).'" title="Delete the page" class="page_toolbar" onclick="remove_page("1")" /></td><td><img src="'.plugins_url("images/page_delete_all.png",__FILE__).'" title="Delete the page with fields"  class="page_toolbar" onclick="remove_page_all("1")" /></td><td><img src="'.plugins_url("images/page_edit.png",__FILE__).'"  title="Edit the page" class="page_toolbar" onclick="edit_page_break("1")" /></td></tr></tbody></table>';
        }
        ?>
      </div>
    </fieldset>
    <input type="hidden" name="form" id="form">
    <input type="hidden" name="form_front" id="form_front">
    <input type="hidden" name="pagination" id="pagination" />
    <input type="hidden" name="show_title" id="show_title" />
    <input type="hidden" name="show_numbers" id="show_numbers" />
    <input type="hidden" name="public_key" id="public_key" />
    <input type="hidden" name="private_key" id="private_key" />
    <input type="hidden" name="recaptcha_theme" id="recaptcha_theme" />
    <input type="hidden" id="label_order" name="label_order" value="<?php echo $row->label_order;?>" />
    <input type="hidden" name="counter" id="counter" value="<?php echo $row->counter;?>">
    <input type="hidden" id="label_order_current" name="label_order_current" value="<?php echo $row->label_order_current;?>"/>
    <script type="text/javascript">
      function formOnload() {
      // Enable maps.
      for (t = 0; t < <?php echo $row->counter;?>; t++)
        if (document.getElementById(t+"_typeform_id_temp")) {
          if (document.getElementById(t+"_typeform_id_temp").value=="type_map" || document.getElementById(t+"_typeform_id_temp").value=="type_mark_map") {
            if_gmap_init(t);
            for (q = 0; q < 20; q++) {
              if (document.getElementById(t+"_elementform_id_temp").getAttribute("long"+q)) {
                w_long=parseFloat(document.getElementById(t+"_elementform_id_temp").getAttribute("long"+q));
                w_lat=parseFloat(document.getElementById(t+"_elementform_id_temp").getAttribute("lat"+q));
                w_info=parseFloat(document.getElementById(t+"_elementform_id_temp").getAttribute("info"+q));
                add_marker_on_map(t,q, w_long, w_lat, w_info, false);
              }
            }
          }
          else
            if (document.getElementById(t+"_typeform_id_temp").value == "type_date") {
              Calendar.setup({
                  inputField: t+"_elementform_id_temp",
                  ifFormat: document.getElementById(t+"_buttonform_id_temp").getAttribute('format'),
                  button: t+"_buttonform_id_temp",
                  align: "Tl",
                  singleClick: true,
                  firstDay: 0
                  });
            }
           else				
		if(document.getElementById(t+"_typeform_id_temp").value=="type_spinner")	{

				var spinner_value = jQuery("#" + t + "_elementform_id_temp").get( "aria-valuenow" );
				var spinner_min_value = document.getElementById(t+"_min_valueform_id_temp").value;
				var spinner_max_value = document.getElementById(t+"_max_valueform_id_temp").value;
			    var spinner_step = document.getElementById(t+"_stepform_id_temp").value;
					  
					 jQuery( "#"+t+"_elementform_id_temp" ).removeClass( "ui-spinner-input" )
			.prop( "disabled", false )
			.removeAttr( "autocomplete" )
			.removeAttr( "role" )
			.removeAttr( "aria-valuemin" )
			.removeAttr( "aria-valuemax" )
			.removeAttr( "aria-valuenow" );
			
			span_ui= document.getElementById(t+"_elementform_id_temp").parentNode;
				span_ui.parentNode.appendChild(document.getElementById(t+"_elementform_id_temp"));
				span_ui.parentNode.removeChild(span_ui);
				
				jQuery("#"+t+"_elementform_id_temp")[0].spin = null;
				
				spinner = jQuery( "#"+t+"_elementform_id_temp" ).spinner();
				spinner.spinner( "value", spinner_value );
				jQuery( "#"+t+"_elementform_id_temp" ).spinner({ min: spinner_min_value});    
                jQuery( "#"+t+"_elementform_id_temp" ).spinner({ max: spinner_max_value});
                jQuery( "#"+t+"_elementform_id_temp" ).spinner({ step: spinner_step});
				
		}
				else
			if(document.getElementById(t+"_typeform_id_temp").value=="type_slider")	{
 
				var slider_value = document.getElementById(t+"_slider_valueform_id_temp").value;
				var slider_min_value = document.getElementById(t+"_slider_min_valueform_id_temp").value;
				var slider_max_value = document.getElementById(t+"_slider_max_valueform_id_temp").value;
				
				var slider_element_value = document.getElementById( t+"_element_valueform_id_temp" );
				var slider_value_save = document.getElementById( t+"_slider_valueform_id_temp" );
				
				document.getElementById(t+"_elementform_id_temp").innerHTML = "";
				document.getElementById(t+"_elementform_id_temp").removeAttribute( "class" );
				document.getElementById(t+"_elementform_id_temp").removeAttribute( "aria-disabled" );

				 jQuery("#"+t+"_elementform_id_temp")[0].slide = null;	
			
					jQuery(function() {
				jQuery( "#"+t+"_elementform_id_temp").slider({
				range: "min",
				value: eval(slider_value),
				min: eval(slider_min_value),
				max: eval(slider_max_value),
				slide: function( event, ui ) {	
					slider_element_value.innerHTML = "" + ui.value ;
					slider_value_save.value = "" + ui.value; 

		}
	});
	
	
});	
		
				
		}
		else
       if(document.getElementById(t+"_typeform_id_temp").value=="type_range"){
                var spinner_value0 = jQuery("#" + t+"_elementform_id_temp0").get( "aria-valuenow" );
			    var spinner_step = document.getElementById(t+"_range_stepform_id_temp").value;
					  
					 jQuery( "#"+t+"_elementform_id_temp0" ).removeClass( "ui-spinner-input" )
			.prop( "disabled", false )
			.removeAttr( "autocomplete" )
			.removeAttr( "role" )
			.removeAttr( "aria-valuenow" );
			
			span_ui= document.getElementById(t+"_elementform_id_temp0").parentNode;
				span_ui.parentNode.appendChild(document.getElementById(t+"_elementform_id_temp0"));
				span_ui.parentNode.removeChild(span_ui);
				
				
				jQuery("#"+t+"_elementform_id_temp0")[0].spin = null;
				jQuery("#"+t+"_elementform_id_temp1")[0].spin = null;
				
				spinner0 = jQuery( "#"+t+"_elementform_id_temp0" ).spinner();
				spinner0.spinner( "value", spinner_value0 );
                jQuery( "#"+t+"_elementform_id_temp0" ).spinner({ step: spinner_step});
				
				
				
				var spinner_value1 = jQuery("#" + t+"_elementform_id_temp1").get( "aria-valuenow" );
			   					  
					 jQuery( "#"+t+"_elementform_id_temp1" ).removeClass( "ui-spinner-input" )
			.prop( "disabled", false )
			.removeAttr( "autocomplete" )
			.removeAttr( "role" )
			.removeAttr( "aria-valuenow" );
			
			span_ui1= document.getElementById(t+"_elementform_id_temp1").parentNode;
				span_ui1.parentNode.appendChild(document.getElementById(t+"_elementform_id_temp1"));
				span_ui1.parentNode.removeChild(span_ui1);
					
				spinner1 = jQuery( "#"+t+"_elementform_id_temp1" ).spinner();
				spinner1.spinner( "value", spinner_value1 );
                jQuery( "#"+t+"_elementform_id_temp1" ).spinner({ step: spinner_step});
				
					var myu = t;
        jQuery(document).ready(function() {	

		jQuery("#"+myu+"_mini_label_from").click(function() {
		if (jQuery(this).children('input').length == 0) {
			var from = "<input type='text' id='from' class='from' size='6' style='outline:none; border:none; background:none; font-size:11px;' value=\""+jQuery(this).text()+"\">";
				jQuery(this).html(from);
				jQuery("input.from").focus();
				jQuery("input.from").blur(function() {
			var id_for_blur = document.getElementById('from').parentNode.id.split('_');
			var value = jQuery(this).val();
		jQuery("#"+id_for_blur[0]+"_mini_label_from").text(value);
		});
	}
	});
     	
		jQuery("label#"+myu+"_mini_label_to").click(function() {
	if (jQuery(this).children('input').length == 0) {	
	
		var to = "<input type='text' id='to' class='to' size='6' style='outline:none; border:none; background:none; font-size:11px;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(to);			
			jQuery("input.to").focus();					
			jQuery("input.to").blur(function() {	
			var id_for_blur = document.getElementById('to').parentNode.id.split('_');			
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_mini_label_to").text(value);
		});	
		 
	}	
	});
	
	
	
	});	
      }	

		else
       if(document.getElementById(t+"_typeform_id_temp").value=="type_name"){
		var myu = t;
        jQuery(document).ready(function() {	

		jQuery("#"+myu+"_mini_label_first").click(function() {		
	
		if (jQuery(this).children('input').length == 0) {	

			var first = "<input type='text' id='first' class='first' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
				jQuery(this).html(first);							
				jQuery("input.first").focus();			
				jQuery("input.first").blur(function() {	
			
			var id_for_blur = document.getElementById('first').parentNode.id.split('_');
			var value = jQuery(this).val();			
		jQuery("#"+id_for_blur[0]+"_mini_label_first").text(value);		
		});	
	}	
	});	    
     	
		jQuery("label#"+myu+"_mini_label_last").click(function() {	
	if (jQuery(this).children('input').length == 0) {	
	
		var last = "<input type='text' id='last' class='last'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(last);			
			jQuery("input.last").focus();					
			jQuery("input.last").blur(function() {	
			var id_for_blur = document.getElementById('last').parentNode.id.split('_');			
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_mini_label_last").text(value);	
		});	
		 
	}	
	});
	
		jQuery("label#"+myu+"_mini_label_title").click(function() {		
		if (jQuery(this).children('input').length == 0) {				
			var title = "<input type='text' id='title' class='title' size='10' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
				jQuery(this).html(title);							
				jQuery("input.title").focus();			
				jQuery("input.title").blur(function() {	
				var id_for_blur = document.getElementById('title').parentNode.id.split('_');
			var value = jQuery(this).val();			


		jQuery("#"+id_for_blur[0]+"_mini_label_title").text(value);		
		});	
	}	
	
	});		


	jQuery("label#"+myu+"_mini_label_middle").click(function() {	
	if (jQuery(this).children('input').length == 0) {		
		var middle = "<input type='text' id='middle' class='middle'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(middle);			
			jQuery("input.middle").focus();					
			jQuery("input.middle").blur(function() {	
            var id_for_blur = document.getElementById('middle').parentNode.id.split('_');			
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_mini_label_middle").text(value);	
		});	
	}	
	});
	
	});		
		 }						
		else
       if(document.getElementById(t+"_typeform_id_temp").value=="type_address"){
		var myu = t;
       
	jQuery(document).ready(function() {		
	jQuery("label#"+myu+"_mini_label_street1").click(function() {			

		if (jQuery(this).children('input').length == 0) {				
		var street1 = "<input type='text' id='street1' class='street1' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
		jQuery(this).html(street1);					
		jQuery("input.street1").focus();		
		jQuery("input.street1").blur(function() {	
		var id_for_blur = document.getElementById('street1').parentNode.id.split('_');
		var value = jQuery(this).val();			
		jQuery("#"+id_for_blur[0]+"_mini_label_street1").text(value);		
		});		
		}	
		});		
	
	jQuery("label#"+myu+"_mini_label_street2").click(function() {		
	if (jQuery(this).children('input').length == 0) {		
	var street2 = "<input type='text' id='street2' class='street2'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
	jQuery(this).html(street2);					
	jQuery("input.street2").focus();		
	jQuery("input.street2").blur(function() {	
	var id_for_blur = document.getElementById('street2').parentNode.id.split('_');
	var value = jQuery(this).val();			
	jQuery("#"+id_for_blur[0]+"_mini_label_street2").text(value);		
	});		
	}	
	});	
	
	
	jQuery("label#"+myu+"_mini_label_city").click(function() {	
		if (jQuery(this).children('input').length == 0) {	
		var city = "<input type='text' id='city' class='city'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
		jQuery(this).html(city);			
		jQuery("input.city").focus();				
		jQuery("input.city").blur(function() {	
		var id_for_blur = document.getElementById('city').parentNode.id.split('_');		
		var value = jQuery(this).val();		
		jQuery("#"+id_for_blur[0]+"_mini_label_city").text(value);		
	});		
	}	
	});	
	
	jQuery("label#"+myu+"_mini_label_state").click(function() {		
		if (jQuery(this).children('input').length == 0) {	
		var state = "<input type='text' id='state' class='state'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(state);		
			jQuery("input.state").focus();		
			jQuery("input.state").blur(function() {	
		var id_for_blur = document.getElementById('state').parentNode.id.split('_');					
		var value = jQuery(this).val();			
	jQuery("#"+id_for_blur[0]+"_mini_label_state").text(value);	
	});	
	}
	});		

	jQuery("label#"+myu+"_mini_label_postal").click(function() {		
	if (jQuery(this).children('input').length == 0) {			
	var postal = "<input type='text' id='postal' class='postal'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
	jQuery(this).html(postal);			
	jQuery("input.postal").focus();			
	jQuery("input.postal").blur(function() {
    var id_for_blur = document.getElementById('postal').parentNode.id.split('_');	
	var value = jQuery(this).val();		
	jQuery("#"+id_for_blur[0]+"_mini_label_postal").text(value);		
	});	
	}
	});	
	
	
	jQuery("label#"+myu+"_mini_label_country").click(function() {		
		if (jQuery(this).children('input').length == 0) {		
			var country = "<input type='country' id='country' class='country'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
			jQuery(this).html(country);		
			jQuery("input.country").focus();	
			jQuery("input.country").blur(function() {	
			var id_for_blur = document.getElementById('country').parentNode.id.split('_');				
			var value = jQuery(this).val();			
			jQuery("#"+id_for_blur[0]+"_mini_label_country").text(value);			
			});	
		}	
	});
	});	

	   }						
		else
       if(document.getElementById(t+"_typeform_id_temp").value=="type_phone"){
		var myu = t;
      
	jQuery(document).ready(function() {	
	jQuery("label#"+myu+"_mini_label_area_code").click(function() {		
	if (jQuery(this).children('input').length == 0) {		

		var area_code = "<input type='text' id='area_code' class='area_code' size='10' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";		

		jQuery(this).html(area_code);		
		jQuery("input.area_code").focus();		
		jQuery("input.area_code").blur(function() {	
		var id_for_blur = document.getElementById('area_code').parentNode.id.split('_');
		var value = jQuery(this).val();			
		jQuery("#"+id_for_blur[0]+"_mini_label_area_code").text(value);		
		});		
	}	
	});	

	
	jQuery("label#"+myu+"_mini_label_phone_number").click(function() {		

	if (jQuery(this).children('input').length == 0) {			
		var phone_number = "<input type='text' id='phone_number' class='phone_number'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";						

		jQuery(this).html(phone_number);					

		jQuery("input.phone_number").focus();			
		jQuery("input.phone_number").blur(function() {		
		var id_for_blur = document.getElementById('phone_number').parentNode.id.split('_');
		var value = jQuery(this).val();			
		jQuery("#"+id_for_blur[0]+"_mini_label_phone_number").text(value);		
		});	
	}	
	});
	
	});	
		 }						
		else
       if(document.getElementById(t+"_typeform_id_temp").value=="type_date_fields"){
		var myu = t;
      
	jQuery(document).ready(function() {	
	jQuery("label#"+myu+"_day_label").click(function() {		
		if (jQuery(this).children('input').length == 0) {				
			var day = "<input type='text' id='day' class='day' size='8' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
				jQuery(this).html(day);							
				jQuery("input.day").focus();			
				jQuery("input.day").blur(function() {	
			var id_for_blur = document.getElementById('day').parentNode.id.split('_');
			var value = jQuery(this).val();			

		jQuery("#"+id_for_blur[0]+"_day_label").text(value);		
		});	
	}	
	});		


	jQuery("label#"+myu+"_month_label").click(function() {	
	if (jQuery(this).children('input').length == 0) {		
		var month = "<input type='text' id='month' class='month' size='8' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(month);			
			jQuery("input.month").focus();					
			jQuery("input.month").blur(function() {	
			var id_for_blur = document.getElementById('month').parentNode.id.split('_');			
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_month_label").text(value);	
		});	
	}	
	});
	
		jQuery("label#"+myu+"_year_label").click(function() {	
	if (jQuery(this).children('input').length == 0) {		
		var year = "<input type='text' id='year' class='year' size='8' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(year);			
			jQuery("input.year").focus();					
			jQuery("input.year").blur(function() {	
		var id_for_blur = document.getElementById('year').parentNode.id.split('_');				
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_year_label").text(value);	
		});	
	}	
	});
	
	});	

	
		 }						
			else
       if(document.getElementById(t+"_typeform_id_temp").value=="type_time"){
		var myu = t;
      
jQuery(document).ready(function() {	
	jQuery("label#"+myu+"_mini_label_hh").click(function() {		
		if (jQuery(this).children('input').length == 0) {				
			var hh = "<input type='text' id='hh' class='hh' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
				jQuery(this).html(hh);							
				jQuery("input.hh").focus();			
				jQuery("input.hh").blur(function() {	
				var id_for_blur = document.getElementById('hh').parentNode.id.split('_');	
			var value = jQuery(this).val();			


		jQuery("#"+id_for_blur[0]+"_mini_label_hh").text(value);		
		});	
	}	
	});		


	jQuery("label#"+myu+"_mini_label_mm").click(function() {	
	if (jQuery(this).children('input').length == 0) {		
		var mm = "<input type='text' id='mm' class='mm' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(mm);			
			jQuery("input.mm").focus();					
			jQuery("input.mm").blur(function() {
            var id_for_blur = document.getElementById('mm').parentNode.id.split('_');				
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_mini_label_mm").text(value);	
		});	
	}	
	});
	
		jQuery("label#"+myu+"_mini_label_ss").click(function() {	
	if (jQuery(this).children('input').length == 0) {		
		var ss = "<input type='text' id='ss' class='ss' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(ss);			
			jQuery("input.ss").focus();					
			jQuery("input.ss").blur(function() {
   var id_for_blur = document.getElementById('ss').parentNode.id.split('_');				
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_mini_label_ss").text(value);	
		});	
	}	
	});
	
		jQuery("label#"+myu+"_mini_label_am_pm").click(function() {		
		if (jQuery(this).children('input').length == 0) {				
			var am_pm = "<input type='text' id='am_pm' class='am_pm' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
				jQuery(this).html(am_pm);							
				jQuery("input.am_pm").focus();			
				jQuery("input.am_pm").blur(function() {	
		    var id_for_blur = document.getElementById('am_pm').parentNode.id.split('_');	
			var value = jQuery(this).val();			

		jQuery("#"+id_for_blur[0]+"_mini_label_am_pm").text(value);		
		});	
	}	
	});	
	});
		
		 }	

		else
       if(document.getElementById(t+"_typeform_id_temp").value=="type_paypal_price"){
		var myu = t;
        jQuery(document).ready(function() {	

		jQuery("#"+myu+"_mini_label_dollars").click(function() {		
	
		if (jQuery(this).children('input').length == 0) {	

			var dollars = "<input type='text' id='dollars' class='dollars' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
				jQuery(this).html(dollars);							
				jQuery("input.dollars").focus();			
				jQuery("input.dollars").blur(function() {	
			
			var id_for_blur = document.getElementById('dollars').parentNode.id.split('_');
			var value = jQuery(this).val();			
		jQuery("#"+id_for_blur[0]+"_mini_label_dollars").text(value);		
		});	
	}	
	});	    
     	
		jQuery("label#"+myu+"_mini_label_cents").click(function() {	
	if (jQuery(this).children('input').length == 0) {	
	
		var cents = "<input type='text' id='cents' class='cents'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(cents);			
			jQuery("input.cents").focus();					
			jQuery("input.cents").blur(function() {	
			var id_for_blur = document.getElementById('cents').parentNode.id.split('_');			
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_mini_label_cents").text(value);	
		});	
		 
	}	
	});
	
	
	
	});		
		 }	

	else
       if(document.getElementById(t+"_typeform_id_temp").value=="type_scale_rating"){
		var myu = t;
        jQuery(document).ready(function() {	

		jQuery("#"+myu+"_mini_label_worst").click(function() {		
	
		if (jQuery(this).children('input').length == 0) {	

			var worst = "<input type='text' id='worst' class='worst' size='6' style='outline:none; border:none; background:none; font-size:11px;' value=\""+jQuery(this).text()+"\">";	
				jQuery(this).html(worst);							
				jQuery("input.worst").focus();			
				jQuery("input.worst").blur(function() {	
			
			var id_for_blur = document.getElementById('worst').parentNode.id.split('_');
			var value = jQuery(this).val();			
		jQuery("#"+id_for_blur[0]+"_mini_label_worst").text(value);		
		});	
	}	
	});	    
     	
		jQuery("label#"+myu+"_mini_label_best").click(function() {	
	if (jQuery(this).children('input').length == 0) {	
	
		var best = "<input type='text' id='best' class='best' size='6' style='outline:none; border:none; background:none; font-size:11px;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(best);			
			jQuery("input.best").focus();					
			jQuery("input.best").blur(function() {	
			var id_for_blur = document.getElementById('best').parentNode.id.split('_');			
			var value = jQuery(this).val();			
			
			jQuery("#"+id_for_blur[0]+"_mini_label_best").text(value);	
		});	
		 
	}	
	});
	
	
	
	});		
		 }
        }
        form_view = 1;
        form_view_count = 0;
        for (i = 1; i <= 30; i++) {
          if (document.getElementById('form_id_tempform_view'+i)) {
            form_view_count++;
            form_view_max=i;
          }
        }
        if (form_view_count > 1) {
          for (i=1; i<=form_view_max; i++) {
            if (document.getElementById('form_id_tempform_view'+i)) {
              first_form_view=i;
              break;
            }
          }
          form_view=form_view_max;
          generate_page_nav(first_form_view);
          var img_EDIT = document.createElement("img");
          img_EDIT.setAttribute("src", "<?php echo plugins_url('',__FILE__) ?>/images/edit.png");
          img_EDIT.style.cssText = "margin-left:40px; cursor:pointer";
          img_EDIT.setAttribute("onclick", 'el_page_navigation()');
          var td_EDIT = document.getElementById("edit_page_navigation");
          td_EDIT.appendChild(img_EDIT);
          document.getElementById('page_navigation').appendChild(td_EDIT);
        }
        //if(document.getElementById('take').innerHTML.indexOf('up_row(')==-1) location.reload(true);
        //else 
        document.getElementById('form').value=document.getElementById('take').innerHTML;
        document.getElementById('araqel').value = 1;
      }
      function formAddToOnload() { 
        if (formOldFunctionOnLoad) {
          formOldFunctionOnLoad();
        }
        formOnload();
      }
      function formLoadBody() {
        formOldFunctionOnLoad = window.onload;
        window.onload = formAddToOnload;
      }
      var formOldFunctionOnLoad = null;
      formLoadBody();
    </script>
    <input type="hidden" name="option" value="com_formmaker" />
    <input type="hidden" name="id" value="<?php echo $row->id?>" />
    <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" id="araqel" value="0" />
  </form>
  <script>
    plugin_url = document.getElementById('form_plugins_url').value;
    appWidth = parseInt(document.body.offsetWidth);
    appHeight = parseInt(document.body.offsetHeight);
    //	document.getElementById('toolbar-popup-popup').childNodes[1].href='index.php?option=com_formmaker&task=preview&tmpl=component&theme='+document.getElementById('theme').value;
    //	document.getElementById('toolbar-popup-popup').childNodes[1].setAttribute('rel',"{handler: 'iframe', size: {x:"+(appWidth-100)+", y: "+(appHeight-30)+"}}");
  </script>
  <?php
}

//////////////////////////////////////////////////////////////////////////////////////////
function html_form_options($row, $themes) {
  $label_id = array();
  $label_label = array();
  $label_type = array();
  $label_all = explode('#****#', $row->label_order_current);
  $label_all = array_slice($label_all, 0, count($label_all) - 1);
  foreach ($label_all as $key => $label_each) {
    $label_id_each = explode('#**id**#', $label_each);
    array_push($label_id, $label_id_each[0]);
    $label_order_each = explode('#**label**#', $label_id_each[1]);
    array_push($label_label, $label_order_each[0]);
    array_push($label_type, $label_order_each[1]);
  }
  ?>
  <script language="javascript" type="text/javascript">
    function submitbutton(pressbutton) {
      var form = document.adminForm;
      if (pressbutton == 'cancel') {
        submit_in(pressbutton);
        return;
      }
      // Set selected ab id to hidden input.
      var fieldset = document.getElementsByTagName('fieldset');
      for (i = 0; i < fieldset.length; i++) {
        if (fieldset[i].style.display != "none") {
          document.getElementById("fieldset_id").value = fieldset[i].id;
        }
      }
      if (form.mail.value != '') {
        subMailArr = form.mail.value.split(',');
        emailListValid = true;
        for (subMailIt = 0; subMailIt < subMailArr.length; subMailIt++) {
          trimmedMail = subMailArr[subMailIt].replace(/^\s+|\s+$/g, '');
          if (trimmedMail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1) {
            alert("This is not a list of valid email addresses.");
            emailListValid = false;
            break;
          }
        }
        if (!emailListValid) {
          return;
        }
      }
      if (form.from_mail.value != '') {
        trimmedMail = form.from_mail.value.replace(/^\s+|\s+$/g, '');
        emailListValid = true;
        if (trimmedMail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1) {
          alert("From Email is not a valid email address.");
          emailListValid = false;
        }
        if (!emailListValid) {
          return;
        }
      }
      submit_in(pressbutton);
    }
    function check_isnum(e) {
      var chCode1 = e.which || e.keyCode;
      if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57)) {
        return false;
      }
      return true;
    }
    function insertAtCursor(myField, myValue) {
      if (myField.style.display == "none") {
        tinyMCE.execCommand('mceInsertContent', false, "%" + myValue + "%");
        return;
      }
      if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
      }
      else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos)
          + "%" + myValue + "%"
          + myField.value.substring(endPos, myField.value.length);
      }
      else {
        myField.value += "%" + myValue + "%";
      }
    }
    gen = "<?php echo $row->counter; ?>";
    form_view_max = 20;
    function remove_article() {
      document.getElementById('id_name').value = "Select an Article";
      document.getElementById('article_id').value = "";
    }
    function set_type(type) {
      switch(type) {
        case 'post':
        document.getElementById('post').removeAttribute('style');
        document.getElementById('page').setAttribute('style','display:none');
        document.getElementById('custom_text').setAttribute('style','display:none');
        document.getElementById('url').setAttribute('style','display:none');
        document.getElementById('none').setAttribute('style','display:none');
        break;
        case 'page':
          document.getElementById('page').removeAttribute('style');
          document.getElementById('post').setAttribute('style','display:none');
          document.getElementById('custom_text').setAttribute('style','display:none');
          document.getElementById('url').setAttribute('style','display:none');
          document.getElementById('none').setAttribute('style','display:none');
          break;
        case 'custom_text':
          document.getElementById('page').setAttribute('style','display:none');
          document.getElementById('post').setAttribute('style','display:none');
          document.getElementById('custom_text').removeAttribute('style');
          document.getElementById('url').setAttribute('style','display:none');
          document.getElementById('none').setAttribute('style','display:none');
          break;
        case 'url':
          document.getElementById('page').setAttribute('style','display:none');
          document.getElementById('post').setAttribute('style','display:none');
          document.getElementById('custom_text').setAttribute('style','display:none');
          document.getElementById('url').removeAttribute('style');
          document.getElementById('none').setAttribute('style','display:none');
          break;
        case 'none':
          document.getElementById('page').setAttribute('style','display:none');
          document.getElementById('post').setAttribute('style','display:none');
          document.getElementById('custom_text').setAttribute('style','display:none');
          document.getElementById('url').setAttribute('style','display:none');
          document.getElementById('none').removeAttribute('style');
          break;
      }
    }
    function set_preview() {
      appWidth = parseInt(document.body.offsetWidth);
      appHeight = parseInt(document.body.offsetHeight);
      document.getElementById('preview_form').href = '<?php echo admin_url('admin-ajax.php'); ?>?action=form_preview_product_option&form_id=<?php echo $row->id ?>&id='+document.getElementById('theme').value+'&TB_iframe=1';
    }
    function submit_in(pressbutton) {
      document.getElementById('adminForm').action = document.getElementById('adminForm').action+"&task="+pressbutton;
      document.getElementById('adminForm').submit();
    }
    var thickDims, tbWidth, tbHeight;
    jQuery(document).ready(function($) {
      thickDims = function() {
        var tbWindow = jQuery('#TB_window'), H = jQuery(window).height(), W = jQuery(window).width(), w, h;
        w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
        h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;
        if (tbWindow.size()) {
          tbWindow.width(w).height(h);
          jQuery('#TB_iframeContent').width(w).height(h - 27);
          tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
          if (typeof document.body.style.maxWidth != 'undefined') {
            tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
          }
        }
      };
      thickDims();
      jQuery(window).resize(function() { thickDims() });
      jQuery('a.thickbox-preview').click( function() {
        tb_click.call(this);
        var alink = jQuery(this).parents('.available-theme').find('.activatelink'), link = '', href = jQuery(this).attr('href'), url, text;
        if (tbWidth = href.match(/&tbWidth=[0-9]+/)) {
          tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
        }
        else {
          tbWidth = jQuery(window).width() - 120;
        }
        if (tbHeight = href.match(/&tbHeight=[0-9]+/)) {
          tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
        }
        else {
          tbHeight = jQuery(window).height() - 120;
        }
        if (alink.length) {
          url = alink.attr('href') || '';
          text = alink.attr('title') || '';
          link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
        }
        else {
          text = jQuery(this).attr('title') || '';
          link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
        }
        jQuery('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
        jQuery('#TB_closeAjaxWindow').css({'float':'left'});
        jQuery('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);
        jQuery('#TB_iframeContent').width('100%');
        thickDims();
        return false;
      });
      // Theme details.
      jQuery('.theme-detail').click(function () {
        jQuery(this).siblings('.themedetaildiv').toggle();
        return false;
      });
    });
  </script>
  <style>
    .borderer {
      border-radius:5px;
      padding-left:5px;
      background-color:#F0F0F0;
      height:19px;
      width:153px;
    }
    fieldset.adminform {
      border-radius: 7px;
      border: 1px solid;
      padding: 5px;
      width: 97%;
    }
    table.admintable td.key,
    table.admintable td.paramlist_key {
      background-color: #F6F6F6;
      border-bottom: 1px solid #E9E9E9;
      border-right: 1px solid #E9E9E9;
      color: #666666;
      font-weight: bold;
      text-align: right;
      width: 200px;
    }
    .submenu-box {
      background-color: #F4F4F4;
      border: 1px solid #CCCCCC;
      border-radius: 7px 7px 7px 7px;
      padding: 6px 5px;
      margin: 5px 0;
    }
    #submenu li {
      display: inline;
      margin: 0;
      padding: 0;
    }
    #submenu {
      margin: 0;
      padding: 0;
    }
    #general {
      padding: 0 15px;
    }
    #submenu a:hover, #submenu a.active, #submenu span.nolink.active {
      background: none repeat scroll 0 0 #FFFFFF;
      color: #146295;
    }
    #submenu li a, #submenu span.nolink {
      border-right: 1px solid #CCCCCC;
      color: #808080;
      cursor: pointer;
      font-size: 1.1em;
      font-weight: bold;
      height: 12px;
      line-height: 14px;
      padding: 0 15px;
    }
  </style>
  <div style="font-size:14px; font-weight:bold">
    <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a>
    <br />
    This section allows you to edit form options.
    <a href="http://web-dorado.com/wordpress-form-maker-guide-3.html" target="_blank" style="color:blue; text-decoration:none;">More...</a>
  </div>
  <form action="admin.php?page=Form_maker&id=<?php echo $row->id; ?>" id="adminForm" method="post" name="adminForm">
    <input type="hidden" name="take" id="take" value="<?php $row->form ?>">
    <table width="97%">
      <tbody>
        <tr>
          <td style="margin:5px;float:right" align="right"><input type="button" onclick="window.location.href='admin.php?page=Form_maker&task=edit_form&id=<?php echo $row->id; ?>'" value="Cancel" class="button-secondary action"> </td>
          <td style="margin:5px;float:right" align="right"><input type="button" onclick="submitbutton('Apply_form_options')" value="Apply" class="button-secondary action"></td>
          <td style="margin:5px;float:right" align="right"><input type="button" onclick="submitbutton('Save_form_options')" value="Save" class="button-secondary action"></td>
        </tr>
      </tbody>
    </table>
    <script>
      function form_maker_options_tabs(id) {
        document.getElementById("actions_fieldset").style.display = "none";
        document.getElementById("custom_fieldset").style.display = "none";
        document.getElementById("general_fieldset").style.display = "none";
        document.getElementById("payment_fieldset").style.display = "none";
        document.getElementById("javascript_fieldset").style.display = "none";
        document.getElementById("actions").setAttribute('class', '');
        document.getElementById("custom").setAttribute('class', '');
        document.getElementById("general").setAttribute('class', '');
        document.getElementById("payment").setAttribute('class', '');
        document.getElementById("javascript").setAttribute('class', '');
        if (document.getElementById(id)) {
          document.getElementById(id + "_fieldset").style.display = "";
          document.getElementById(id).setAttribute('class', 'active');
        }
        return false;
      }
    </script>
    <div class="submenu-box" style="width:97%">
      <div class="submenu-pad">
        <ul id="submenu" class="configuration">
          <li>
            <a id="general" onclick="form_maker_options_tabs('general')" href="#">General Options</a>
          </li>
          <li>
            <a id="actions" onclick="form_maker_options_tabs('actions')" href="#">Actions after Submission</a>
          </li>
          <li>
            <a id="payment" onclick="form_maker_options_tabs('payment')" href="#">Payment Options</a>
          </li>
          <li>
            <a id="javascript" onclick="form_maker_options_tabs('javascript')" href="#">JavaScript</a>
          </li>
          <li>
            <a id="custom" onclick="form_maker_options_tabs('custom')" href="#">Custom Text in Email</a>
          </li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>
    <fieldset id="actions_fieldset" class="adminform">
      <legend style="color:#0B55C4;font-weight: bold;">Actions after submission</legend>
      <table class="admintable">
        <tr valign="top">
          <td class="key">
            <label for="submissioni text">Action type</label>
          </td>
          <td>
            <input type="radio" name="submit_text_type" onclick="set_type('none')" value="1" <?php if($row->submit_text_type!=2 and $row->submit_text_type!=3 and $row->submit_text_type!=4 and $row->submit_text_type!=5 ) echo "checked"; ?> /> Stay on Form<br/>
            <input type="radio" name="submit_text_type" onclick="set_type('post')" value="2" <?php if($row->submit_text_type==2 ) echo "checked"; ?> /> Post<br/>
            <input type="radio" name="submit_text_type" onclick="set_type('page')" value="5" <?php if($row->submit_text_type==5 ) echo "checked"; ?> /> Page<br/>
            <input type="radio" name="submit_text_type" onclick="set_type('custom_text')" value="3" <?php if($row->submit_text_type==3 ) echo "checked"; ?> /> Custom Text<br/>
            <input type="radio" name="submit_text_type" onclick="set_type('url')" value="4" <?php if($row->submit_text_type==4 ) echo "checked"; ?> /> URL
          </td>
        </tr>
        <tr  id="none" <?php if ($row->submit_text_type == 2 or $row->submit_text_type == 3 or $row->submit_text_type==4 or $row->submit_text_type == 5) echo 'style="display:none"' ?> >
          <td class="key">
            <label> Stay on Form </label>
          </td>
          <td>
            <img src="<?php echo plugins_url("images/tick.png",__FILE__); ?>" border="0">
          </td>
        </tr>
        <tr id="post" <?php if ($row->submit_text_type != 2) echo 'style="display:none"'; ?>>
          <td class="key">
            <label for="post_name"> Post </label>
          </td>
          <td>
            <select id="post_name" name="post_name" style="width:153px; font-size:11px;">
              <option value="0">- Select Post -</option>
              <?php
              // The Query.
              $args = array('posts_per_page'  => 10000);
              query_posts($args);
              // The Loop.
              while (have_posts()) : the_post(); ?>
              <option value="<?php $x = get_permalink(get_the_ID()); echo  $x; ?>" <?php if ($row->article_id == $x) {echo ' selected="selected"';} ?>><?php the_title();	?></option>
              <?php
              endwhile;
              // Reset Query.
              wp_reset_query();
              ?>
            </select>
          </td>
        </tr>
        <tr id="page" <?php if($row->submit_text_type!=5) echo 'style="display:none"' ?>>
          <td class="key">
            <label for="page_num"> Page </label>
          </td>
          <td>
            <select id="page_num" name="page_name" style="width:153px; font-size:11px;">
              <option value="0">- Select Page -</option>
              <?php
              // The Query.
              $pages = get_pages();
              // The Loop.
              foreach ($pages as $page) {
                ?>
              <option value="<?php $x = get_page_link($page->ID); echo $x; ?>" <?php if ($row->article_id == $x) {echo ' selected="selected"';} ?>> <?php echo $page->post_title;	?></option>
                <?php
              }
              // Reset Query.
              wp_reset_query();
              ?>
            </select>
          </td>
        </tr>
        <tr <?php if($row->submit_text_type!=3 ) echo 'style="display:none"' ?> id="custom_text">
          <td class="key">
            <label for="poststuff"> Text </label>
          </td>
          <td>
            <?php if (get_bloginfo('version') < '3.3'){ ?>
            <div style="height:200px;text-align:left" id="poststuff">
              <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea"><?php the_editor($row->submit_text,"content","title",$media_buttons = true, $tab_index = 1, $extended = true ); ?></div>   
            </div>
            <?php } else { wp_editor($row->submit_text,"content");}?>
          </td>
        </tr>
        <tr <?php if($row->submit_text_type != 4 ) echo 'style="display:none"' ?> id="url">
          <td class="key">
            <label for="url"> URL </label>
          </td>
          <td>
            <input type="text" id="url" name="url" style="width:300px" value="<?php echo $row->url ?>" />
          </td>
        </tr>
      </table>
    </fieldset>
    <fieldset id="custom_fieldset" class="adminform">
      <legend style="color:#0B55C4;font-weight: bold;">Custom text in email</legend>
      <table class="admintable">
        <tr>
          <td class="key" valign="top">
            <label>For Administrator</label>
          </td>
          <td>
            <div style="margin-bottom:5px">
              <?php
              for ($i = 0; $i < count($label_label); $i++) {
                if ($label_type[$i] == "type_submit_reset" || $label_type[$i] == "type_editor" || $label_type[$i] == "type_map" || $label_type[$i] == "type_mark_map" || $label_type[$i] == "type_captcha" || $label_type[$i] == "type_recaptcha" || $label_type[$i] == "type_button") {
                  continue;
                }
                $param = "'" . htmlspecialchars(addslashes($label_label[$i])) . "'";
                $choise = 'document.getElementById(\'script_mail\')';
                echo '<input style="border:1px solid silver; font-size:10px;" type="button" value="' . htmlspecialchars(addslashes($label_label[$i])) . '" onClick="insertAtCursor(' . $choise . ',' . $param . ')" /> ';
              }
              $choise = 'document.getElementById(\'script_mail\')';
              echo '<input style="border:1px solid silver; font-size:10px; margin:3px;" type="button" value="All fields list" onClick="insertAtCursor(' . $choise . ',\'all\')" /> ';
              ?>
            </div>
            <?php
            if (function_exists('wp_editor') || function_exists('the_editor')) {
              if (get_bloginfo('version') < '3.3') {
                the_editor($row->script_mail, $idd = 'script_mail', $prev_id = 'script_mail', $media_buttons = true, $tab_index = 1, $extended = TRUE);
              }
              else {
                wp_editor($row->script_mail, $idd = 'script_mail');
              }
            }
            else {
              ?>
            <textarea name="script_mail" id="script_mail" cols="20" rows="10" style="width:300px; height:450px;"><?php echo $row->script_mail ?></textarea>
            <?php
            }
            ?>
          </td>
        </tr>
        <tr>
          <td valign="top" height="30"></td>
          <td valign="top"></td>
        </tr>
        <tr>
          <td class="key" valign="top">
            <label>For User</label>
          </td>
          <td>
            <div style="margin-bottom:5px">
              <?php
              for ($i = 0; $i < count($label_label); $i++) {
                if ($label_type[$i] == "type_submit_reset" || $label_type[$i] == "type_editor" || $label_type[$i] == "type_map" || $label_type[$i] == "type_mark_map" || $label_type[$i] == "type_captcha" || $label_type[$i] == "type_recaptcha" || $label_type[$i] == "type_button") {
                  continue;
                }
                $param = "'" . htmlspecialchars(addslashes($label_label[$i])) . "'";
                // if (!$is_editor) {
                  $choise = 'document.getElementById(\'script_mail_user\')';
                  echo '<input style="border:1px solid silver; font-size:10px;" type="button" value="' . htmlspecialchars(addslashes($label_label[$i])) . '" onClick="insertAtCursor(' . $choise . ',' . $param . ')" /> ';
                // }
                // else {
                  // echo '<input type="button" value="' . htmlspecialchars(addslashes($label_label[$i])) . '" onClick="insertAtCursorEditor(' . $param . ')" /> ';
                // }
              }
              // if (!function_exists('wp_editor') && !function_exists('the_editor')) {
                $choise = 'document.getElementById(\'script_mail_user\')';
                echo '<input style="border:1px solid silver; font-size:10px; margin:3px;" type="button" value="All fields list" onClick="insertAtCursor(' . $choise . ',\'all\')" /> ';
              // }
              // else {
                // echo '<input style="margin:3px" type="button" value="All fields list" onClick="insertAtCursorEditor(\'all\')" /> ';
              // }
              ?>
            </div>
            <?php
            if (function_exists('wp_editor') || function_exists('the_editor')) {
              if (get_bloginfo('version') < '3.3') {
                the_editor($row->script_mail_user, $idd = 'script_mail_user', $prev_id = 'script_mail_user', $media_buttons = true, $tab_index = 1, $extended = TRUE);
              }
              else {
                wp_editor($row->script_mail_user, $idd = 'script_mail_user');
              }
            }
            else {
              ?>
            <textarea name="script_mail_user" id="script_mail_user" cols="20" rows="10" style="width:300px; height:350px;"><?php echo $row->script_mail_user ?></textarea>
            <?php
            }
            ?>
          </td>
        </tr>
      </table>
    </fieldset>
    <fieldset id="general_fieldset" class="adminform">
      <legend style="color:#0B55C4;font-weight: bold;">Advanced Options</legend>
      <table class="admintable" style="float:left">
        <tr valign="top">
          <td class="key">
            <label for="mail">Email to send submissions to</label>
          </td>
          <td>
            <input id="mail" name="mail" value="<?php echo $row->mail; ?>" style="width:250px;"/>
          </td>
        </tr>
        <tr valign="top">
          <td class="key">
            <label for="from_mail">From Email</label>
          </td>
          <td>
            <input id="from_mail" name="from_mail" value="<?php echo $row->from_mail; ?>" style="width:250px;"/>
          </td>
        </tr>
        <tr valign="top">
          <td class="key">
            <label for="from_name">From Name</label>
          </td>
          <td>
            <input id="from_name" name="from_name" value="<?php echo $row->from_name; ?>" style="width:250px;"/>
          </td>
        </tr>
        <tr valign="top">
          <td class="key">
            <label for="theme">Theme</label>
          </td>
          <td>
            <select id="theme" name="theme" style="width:260px; " onChange="set_preview()">
              <?php
              $form_theme = '';
              foreach ($themes as $theme) {
                if ($theme->id == $row->theme) {
                  echo '<option value="' . $theme->id . '" selected>' . $theme->title . '</option>';
                  $form_theme=$theme->css;
                }
                else
                  echo '<option value="' . $theme->id . '">' . $theme->title . '</option>';
              }
              ?>
            </select>
            <a id="preview_form" href="<?php echo admin_url('admin-ajax.php').'?action=form_preview_product_option&form_id=' . $row->id . '&id=' . $row->theme . '&TB_iframe=1'; ?>" class="thickbox-preview" title="Form Preview" onclick="return false;">
              <input type="button" value="preview" class="button-primary" />
            </a>
          </td>
        </tr>
      </table>
      <style>
        div.wd_preview span {
          float: none;
          width: 32px;
          height: 32px;
          margin: 0 auto;
          display: block;
        }
        div.wd_preview a {
          display: block;
          float: left;
          white-space: nowrap;
          border: 1px solid #fbfbfb;
          padding: 1px 5px;
          cursor: pointer;
          text-decoration: none
        }
      </style>
    </fieldset>
    <fieldset id="payment_fieldset" class="adminform">
      <legend style="color:#0B55C4;font-weight: bold;">Payment Options</legend>
      <div class="error">Paypal Options are disabled in free version.</div>
      <table class="admintable">
        <tr valign="top">
          <td class="key">
            <label>Turn Paypal On</label>
          </td>
          <td>
            <input disabled="disabled" type="radio" name="paypal_mode" id="paypal_mode1" value="1" <?php if ($row->paypal_mode == "1")
              echo "checked" ?> /> <label for="paypal_mode1">On </label><br/>
            <input disabled="disabled" type="radio" name="paypal_mode" id="paypal_mode2" value="0" <?php if ($row->paypal_mode != "1")
              echo "checked" ?> /> <label for="paypal_mode2">Off </label><br/>
          </td>
        </tr>
        <tr valign="top">
          <td class="key">
            <label>Checkout Mode</label>
          </td>
          <td>
            <input disabled="disabled" type="radio" name="checkout_mode" id="checkout_mode1"
                   value="production" <?php if ($row->checkout_mode == "production")
              echo "checked" ?> /> <label for="checkout_mode1">Production </label><br/>
            <input disabled="disabled" type="radio" name="checkout_mode" id="checkout_mode2"
                   value="testmode" <?php if ($row->checkout_mode != "production")
              echo "checked" ?> /> <label for="checkout_mode2">Testmode</label><br/>
          </td>
        </tr>
        <tr valign="top">
          <td class="key">
            <label>Paypal email</label>
          </td>
          <td>
            <input disabled="disabled" type="text" name="paypal_email" id="paypal_email" value="<?php echo $row->paypal_email; ?>" class="text_area" style="width:250px">
          </td>
        </tr>
        <tr valign="top">
          <td class="key">
            <label>Payment Currency</label>
          </td>
          <td>
            <select disabled="disabled" id="payment_currency" name="payment_currency" style="width:253px">
              <option value="USD" <?php echo (($row->payment_currency == 'USD') ? 'selected' : ''); ?>>$ &#8226; U.S. Dollar</option>
              <option value="EUR" <?php echo (($row->payment_currency == 'EUR') ? 'selected' : ''); ?>>&#8364; &#8226; Euro</option>
              <option value="GBP" <?php echo (($row->payment_currency == 'GBP') ? 'selected' : ''); ?>>&#163; &#8226; Pound Sterling</option>
              <option value="JPY" <?php echo (($row->payment_currency == 'JPY') ? 'selected' : ''); ?>>&#165; &#8226; Japanese Yen</option>
              <option value="CAD" <?php echo (($row->payment_currency == 'CAD') ? 'selected' : ''); ?>>C$ &#8226; Canadian Dollar</option>
              <option value="MXN" <?php echo (($row->payment_currency == 'MXN') ? 'selected' : ''); ?>>Mex$ &#8226; Mexican Peso</option>
              <option value="HKD" <?php echo (($row->payment_currency == 'HKD') ? 'selected' : ''); ?>>HK$ &#8226; Hong Kong Dollar</option>
              <option value="HUF" <?php echo (($row->payment_currency == 'HUF') ? 'selected' : ''); ?>>Ft &#8226; Hungarian Forint</option>
              <option value="NOK" <?php echo (($row->payment_currency == 'NOK') ? 'selected' : ''); ?>>kr &#8226; Norwegian Kroner</option>
              <option value="NZD" <?php echo (($row->payment_currency == 'NZD') ? 'selected' : ''); ?>>NZ$ &#8226; New Zealand Dollar</option>
              <option value="SGD" <?php echo (($row->payment_currency == 'SGD') ? 'selected' : ''); ?>>S$ &#8226; Singapore Dollar</option>
              <option value="SEK" <?php echo (($row->payment_currency == 'SEK') ? 'selected' : ''); ?>>kr &#8226; Swedish Kronor</option>
              <option value="PLN" <?php echo (($row->payment_currency == 'PLN') ? 'selected' : ''); ?>>zl &#8226; Polish Zloty</option>
              <option value="AUD" <?php echo (($row->payment_currency == 'AUD') ? 'selected' : ''); ?>>A$ &#8226; Australian Dollar</option>
              <option value="DKK" <?php echo (($row->payment_currency == 'DKK') ? 'selected' : ''); ?>>kr &#8226; Danish Kroner</option>
              <option value="CHF" <?php echo (($row->payment_currency == 'CHF') ? 'selected' : ''); ?>>CHF &#8226; Swiss Francs</option>
              <option value="CZK" <?php echo (($row->payment_currency == 'CZK') ? 'selected' : ''); ?>>Kc &#8226; Czech Koruny</option>
              <option value="ILS" <?php echo (($row->payment_currency == 'ILS') ? 'selected' : ''); ?>>&#8362; &#8226; Israeli Sheqel</option>
              <option value="BRL" <?php echo (($row->payment_currency == 'BRL') ? 'selected' : ''); ?>>R$ &#8226; Brazilian Real</option>
              <option value="TWD" <?php echo (($row->payment_currency == 'TWD') ? 'selected' : ''); ?>>NT$ &#8226; Taiwan New Dollars</option>
              <option value="MYR" <?php echo (($row->payment_currency == 'MYR') ? 'selected' : ''); ?>>RM &#8226; Malaysian Ringgit</option>
              <option value="PHP" <?php echo (($row->payment_currency == 'PHP') ? 'selected' : ''); ?>>&#8369; &#8226; Philippine Peso</option>
              <option value="THB" <?php echo (($row->payment_currency == 'THB') ? 'selected' : ''); ?>>&#xe3f; &#8226; Thai Bahtv</option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <td class="key">
            <label for="tax">Tax</label>
          </td>
          <td>
            <input disabled="disabled" type="text" name="tax" id="tax" value="<?php echo $row->tax; ?>" class="text_area" style="width:30px" onKeyPress="return check_isnum(event)"> %
          </td>
        </tr>
      </table>
    </fieldset>
    <fieldset id="javascript_fieldset" class="adminform">
      <legend style="color:#0B55C4;font-weight: bold;">JavaScript</legend>
      <table class="admintable">
        <tr valign="top">
          <td class="key">
            <label for="javascript">Javascript</label>
          </td>
          <td>
            <textarea style="margin: 0px;" cols="60" rows="30" name="javascript" id="javascript"><?php echo $row->javascript; ?></textarea>
          </td>
        </tr>
      </table>
    </fieldset>
    <input type="hidden" name="option" value="com_formmaker"/>
    <input type="hidden" name="id" value="<?php echo $row->id?>"/>
    <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>"/>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="fieldset_id" id="fieldset_id" value="<?php echo ((isset($_POST['fieldset_id'])) ? esc_html($_POST['fieldset_id']) : 'general_fieldset'); ?>"/>
  </form>
  <script>
    window.onload = form_maker_options_tabs(document.getElementById("fieldset_id").value.replace("_fieldset", ""));
  </script>
  <?php
}
