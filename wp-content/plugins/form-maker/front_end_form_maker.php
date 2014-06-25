<?php
/**
 * @package Form Maker
 * @author Web-Dorado
 * @copyright (C) 2011 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

function showform($id) {
  global $wpdb;
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id=%d", $id));
  if (!$row) {
    return FALSE;
  }
  $form_theme = $wpdb->get_var($wpdb->prepare("SELECT css FROM " . $wpdb->prefix . "formmaker_themes WHERE id=%d", $row->theme));
  if (!$form_theme) {
    $form_theme = $wpdb->get_var("SELECT css FROM " . $wpdb->prefix . "formmaker_themes");
    if (!$form_theme) {
      return FALSE;
    }
  }
  $label_id = array();
  $label_type = array();
  $label_all = explode('#****#', $row->label_order);
  $label_all = array_slice($label_all, 0, count($label_all) - 1);
  foreach ($label_all as $key => $label_each) {
    $label_id_each = explode('#**id**#', $label_each);
    array_push($label_id, $label_id_each[0]);
    $label_order_each = explode('#**label**#', $label_id_each[1]);
    array_push($label_type, $label_order_each[1]);
  }
  return array(
    $row,
    1,
    $label_id,
    $label_type,
    $form_theme
  );
}

function savedata($form, $id) {
  $all_files = array();
  $correct = FALSE;
  @session_start();
  $id_for_old = $id;
  if (!$form->form_front)
    $id = '';
  if (isset($_POST["counter" . $id])) {
    $counter = esc_html($_POST["counter" . $id]);
    if (isset($_POST["captcha_input"])) {
      $captcha_input = esc_html($_POST["captcha_input"]);
      $session_wd_captcha_code = isset($_SESSION[$id . '_wd_captcha_code']) ? $_SESSION[$id . '_wd_captcha_code'] : '-';
      if ($captcha_input == $session_wd_captcha_code) {
        $correct = TRUE;
      }
      else {
        echo "<script> alert('" . addslashes(__('Error, incorrect Security code.', 'form_maker')) . "');
						</script>";
      }
    }
    elseif (isset($_POST["recaptcha_response_field"])) {
      $recaptcha_response_field = $_POST["recaptcha_response_field"];
      $privatekey = $form->private_key;
      $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $recaptcha_response_field);
      if ($resp->is_valid) {
        $correct = TRUE;
      }
      else {
        echo "<script> alert('" . addslashes(__('Error, incorrect Security code.', 'form_maker')) . "');
							</script>";
      }
    }
    else {
      $correct = TRUE;
    }
    if ($correct) {
      $result_temp = save_db($counter, $id_for_old);
      $all_files = $result_temp[0];
      if (is_numeric($all_files)) {
        remove($all_files, $id_for_old);
      }
      elseif (isset($counter)) {
        gen_mail($counter, $all_files, $id_for_old, $result_temp[1]);
      }
    }
    return $all_files;
  }
  return $all_files;
}

function save_db($counter, $id) {
  global $wpdb;
  $chgnac = TRUE;
  $all_files = array();
  $form = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id= %d", $id));
  $id_old = $id;
  if (!$form->form_front) {
    $id = '';
  }
  $label_id = array();
  $label_label = array();
  $label_type = array();
  $label_all = explode('#****#', $form->label_order);
  $label_all = array_slice($label_all, 0, count($label_all) - 1);
  foreach ($label_all as $key => $label_each) {
    $label_id_each = explode('#**id**#', $label_each);
    array_push($label_id, $label_id_each[0]);
    $label_order_each = explode('#**label**#', $label_id_each[1]);
    array_push($label_label, $label_order_each[0]);
    array_push($label_type, $label_order_each[1]);
  }
  $max = $wpdb->get_var("SELECT MAX( group_id ) FROM " . $wpdb->prefix . "formmaker_submits");
  foreach ($label_type as $key => $type) {
    $value = '';
    if ($type == "type_submit_reset" or $type == "type_map" or $type == "type_editor" or  $type == "type_captcha" or  $type == "type_recaptcha" or  $type == "type_button")
      continue;
    $i = $label_id[$key];
    if ($type != "type_address") {
      $deleted = $_POST[$i . "_type" . $id];
      if (!isset($_POST[$i . "_type" . $id]))
        break;
    }
    if ($type == 'type_paypal_total') {
      continue;
    }
    switch ($type) {
      case 'type_text':
      case 'type_password':
      case 'type_textarea':
      case "type_submitter_mail":
      case "type_date":
      case "type_own_select":
      case "type_country":
      case "type_number":
        {
        $value = $_POST[$i . "_element" . $id];
        break;
        }
      case "type_mark_map":
        {
        $value = $_POST[$i . "_long" . $id] . '***map***' . $_POST[$i . "_lat" . $id];
        break;
        }
      case "type_date_fields":
        {
        $value = $_POST[$i . "_day" . $id] . '-' . $_POST[$i . "_month" . $id] . '-' . $_POST[$i . "_year" . $id];
        break;
        }
      case "type_time":
        {
        $ss = $_POST[$i . "_ss" . $id];
        if (isset($_POST[$i . "_ss" . $id]))
          $value = $_POST[$i . "_hh" . $id] . ':' . $_POST[$i . "_mm" . $id] . ':' . $_POST[$i . "_ss" . $id];
        else
          $value = $_POST[$i . "_hh" . $id] . ':' . $_POST[$i . "_mm" . $id];
        $am_pm = $_POST[$i . "_am_pm" . $id];
        if (isset($_POST[$i . "_am_pm" . $id]))
          $value = $value . ' ' . $_POST[$i . "_am_pm" . $id];
        break;
        }
      case "type_phone":
        {
        $value = $_POST[$i . "_element_first" . $id] . ' ' . $_POST[$i . "_element_last" . $id];
        break;
        }
      case "type_name":
        {
        $element_title = $_POST[$i . "_element_title" . $id];
        if (isset($_POST[$i . "_element_title" . $id]))
          $value = $_POST[$i . "_element_title" . $id] . ' ' . $_POST[$i . "_element_first" . $id] . ' ' . $_POST[$i . "_element_last" . $id] . ' ' . $_POST[$i . "_element_middle" . $id];
        else
          $value = $_POST[$i . "_element_first" . $id] . ' ' . $_POST[$i . "_element_last" . $id];
        break;
        }
      case "type_file_upload":
        {
        $file = $_FILES[$i . '_file' . $id];
        if ($file['name']) {
          $untilupload = $form->form;
          $pos1 = strpos($untilupload, "***destinationskizb" . $i . "***");
          $pos2 = strpos($untilupload, "***destinationverj" . $i . "***");
          $destination = substr($untilupload, $pos1 + (23 + (strlen($i) - 1)), $pos2 - $pos1 - (23 + (strlen($i) - 1)));
          $pos1 = strpos($untilupload, "***extensionskizb" . $i . "***");
          $pos2 = strpos($untilupload, "***extensionverj" . $i . "***");
          $extension = substr($untilupload, $pos1 + (21 + (strlen($i) - 1)), $pos2 - $pos1 - (21 + (strlen($i) - 1)));
          $pos1 = strpos($untilupload, "***max_sizeskizb" . $i . "***");
          $pos2 = strpos($untilupload, "***max_sizeverj" . $i . "***");
          $max_size = substr($untilupload, $pos1 + (20 + (strlen($i) - 1)), $pos2 - $pos1 - (20 + (strlen($i) - 1)));
          $fileName = $file['name'];
          $destination = str_replace(site_url() . '/', '', $destination);
          $fileSize = $file['size'];
          if ($fileSize > $max_size * 1024) {
            echo "<script> alert('" . addslashes(__('The file exceeds the allowed size of', 'form_maker')) . $max_size . " KB');</script>";
            return array($max + 1);
          }
          $uploadedFileNameParts = explode('.', $fileName);
          $uploadedFileExtension = array_pop($uploadedFileNameParts);
          $to = strlen($fileName) - strlen($uploadedFileExtension) - 1;
          $fileNameFree = substr($fileName, 0, $to);
          $invalidFileExts = explode(',', $extension);
          $extOk = FALSE;
          foreach ($invalidFileExts as $key => $value) {
            if (is_numeric(strpos(strtolower($value), strtolower($uploadedFileExtension)))) {
              $extOk = TRUE;
            }
          }
          if ($extOk == FALSE) {
            echo "<script> alert('" . addslashes(__('Sorry, you are not allowed to upload this type of file.', 'form_maker')) . "');</script>";
            return array($max + 1);
          }
          $fileTemp = $file['tmp_name'];
          $p = 1;
          while (file_exists($destination . "/" . $fileName)) {
            $to = strlen($file['name']) - strlen($uploadedFileExtension) - 1;
            $fileName = substr($fileName, 0, $to) . '(' . $p . ').' . $uploadedFileExtension;
            $file['name'] = $fileName;
            $p++;
          }
          if (is_dir(ABSPATH . $destination)) {
            if (!move_uploaded_file($fileTemp, ABSPATH . $destination . '/' . $fileName)) {
              echo "<script> alert('" . addslashes(__('Error, file cannot be moved.', 'form_maker')) . "');</script>";
              return array($max + 1);
            }
          }
          else {
            echo "<script> alert('" . addslashes(__('Error, file destination does not exist.', 'form_maker')) . "');</script>";
            return array($max + 1);
          }
          $value = site_url() . '/' . $destination . '/' . $fileName . '*@@url@@*';
          $file['tmp_name'] = $destination . "/" . $fileName;
          $file['name'] = ABSPATH . $destination . "/" . $fileName;
          array_push($all_files, $file);
        }
        break;
        }
      case 'type_address':
        {
        $value = '*#*#*#';
        if (isset($_POST[$i . "_street1" . $id])) {
          $value = $_POST[$i . "_street1" . $id];
          break;
        }
        if (isset($_POST[$i . "_street2" . $id])) {
          $value = $_POST[$i . "_street2" . $id];
          break;
        }
        if (isset($_POST[$i . "_city" . $id])) {
          $value = $_POST[$i . "_city" . $id];
          break;
        }
        if (isset($_POST[$i . "_state" . $id])) {
          $value = $_POST[$i . "_state" . $id];
          break;
        }
        if (isset($_POST[$i . "_postal" . $id])) {
          $value = $_POST[$i . "_postal" . $id];
          break;
        }
        if (isset($_POST[$i . "_country" . $id])) {
          $value = $_POST[$i . "_country" . $id];
          break;
        }
        break;
        }
      case "type_hidden":
        {
        $value = $_POST[$label_label[$key]];
        break;
        }
      case "type_radio":
        {
        $element = $_POST[$i . "_other_input" . $id];
        if (isset($element)) {
          $value = $element;
          break;
        }
        $value = $_POST[$i . "_element" . $id];
        break;
        }
      case "type_checkbox":
        {
        $start = -1;
        $value = '';
        for ($j = 0; $j < 100; $j++) {
          if (isset($_POST[$i . "_element" . $id . $j])) {
            $start = $j;
            break;
          }
        }
        $other_element_id = -1;
        $is_other = $_POST[$i . "_allow_other" . $id];
        if ($is_other == "yes") {
          $other_element_id = $_POST[$i . "_allow_other_num" . $id];
        }
        if ($start != -1) {
          for ($j = $start; $j < 100; $j++) {
            if (isset($_POST[$i . "_element" . $id . $j])) {
              if ($j == $other_element_id) {
                $value = $value . $_POST[$i . "_other_input" . $id] . '***br***';
              }
              else {
                $value = $value . $_POST[$i . "_element" . $id . $j] . '***br***';
              }
            }
          }
        }
        break;
        }
        case "type_star_rating": {
					if (isset($_POST[$i."_selected_star_amount".$id]) &&  $_POST[$i."_selected_star_amount".$id] != "") {
            $selected_star_amount = $_POST[$i."_selected_star_amount".$id];
          }
					else {
            $selected_star_amount = 0;
          }
					$value = (isset($_POST[$i."_star_amount".$id]) ? $_POST[$i."_star_amount".$id] : '').'***'.$selected_star_amount.'***'.(isset($_POST[$i."_star_color".$id]) ? $_POST[$i."_star_color".$id] : '').'***star_rating***';									
					break;
				}
        case "type_scale_rating": {
					$value = (isset($_POST[$i."_scale_radio".$id]) ? $_POST[$i."_scale_radio".$id] : 0).'/'.(isset($_POST[$i."_scale_amount".$id]) ? $_POST[$i."_scale_amount".$id] : '');									
					break;
				}
        case "type_spinner": {
          $value = (isset($_POST[$i."_element".$id]) ? $_POST[$i."_element".$id] : '');
					break;
				}
				case "type_slider":	{
					$value = (isset($_POST[$i."_slider_value".$id]) ? $_POST[$i."_slider_value".$id] : '');
					break;
				}
				case "type_range": {
					$value = (isset($_POST[$i."_element".$id . '0']) ? $_POST[$i."_element".$id . '0'] : '') .'-'.(isset($_POST[$i."_element".$id.'1']) ? $_POST[$i."_element".$id.'1'] : '');
					break;
				}
				case "type_grading": {
					$value = "";
          if (isset($_POST[$i."_hidden_item".$id])) {
            $items = explode(":", $_POST[$i."_hidden_item".$id]);
            for ($k = 0; $k < sizeof($items) - 1; $k++) {
              if (isset($_POST[$i."_element".$id.$k])) {
                $value .= $_POST[$i."_element".$id.$k].':';
              }
            }
            $value .= $_POST[$i."_hidden_item".$id].'***grading***';
          }
					break;
				}
				case "type_matrix": {
          $rows_of_matrix = explode("***",$_POST[$i."_hidden_row".$id]);
					$rows_count= sizeof($rows_of_matrix)-1;
					$column_of_matrix=explode("***",$_POST[$i."_hidden_column".$id]);
					$columns_count= sizeof($column_of_matrix)-1;
					$row_ids=explode(",",substr($_POST[$i."_row_ids".$id], 0, -1));
					$column_ids=explode(",",substr($_POST[$i."_column_ids".$id], 0, -1));
					if ($_POST[$i."_input_type".$id]=="radio") {
						$input_value="";
						foreach($row_ids as $row_id) {
              $input_value.=(isset($_POST[$i."_input_element".$id.$row_id]) ? $_POST[$i."_input_element".$id.$row_id] : 0)."***";
            }
					}
					if ($_POST[$i."_input_type".$id]=="checkbox") {
						$input_value="";
						foreach($row_ids as $row_id)
              foreach($column_ids as $column_id)
                $input_value .= (isset($_POST[$i."_input_element".$id.$row_id.'_'.$column_id]) ? $_POST[$i."_input_element".$id.$row_id.'_'.$column_id] : 0)."***";
          }
					if ($_POST[$i."_input_type".$id]=="text") {
						$input_value="";
						foreach($row_ids as $row_id)
              foreach($column_ids as $column_id)
                $input_value.=$_POST[$i."_input_element".$id.$row_id.'_'.$column_id]."***";
					}
					if ($_POST[$i."_input_type".$id]=="select") {
						$input_value="";
						foreach($row_ids as $row_id)
						foreach($column_ids as $column_id)
						$input_value.=$_POST[$i."_select_yes_no".$id.$row_id.'_'.$column_id]."***";	
					}
					$value=$rows_count.'***'.$_POST[$i."_hidden_row".$id].$columns_count.'***'.$_POST[$i."_hidden_column".$id].$_POST[$i."_input_type".$id].'***'.$input_value.'***matrix***';	
					break;
				}
    }
    if ($type == "type_address") {
      if ($value == '*#*#*#') {
        //break;?????????????????????????????????????????????????????
        continue; 
      }
    }
    $unique_element = $_POST[$i . "_unique" . $id];
    if ($unique_element == 'yes') {
      $unique = $wpdb->get_col($wpdb->prepare("SELECT id FROM " . $wpdb->prefix . "formmaker_submits WHERE form_id= %d  and element_label= %s and element_value= %s", $id_old, $i, addslashes($value)));
      if ($unique) {
        echo "<script> alert('" . addslashes(__('This field %s requires a unique entry and this value was already submitted.', 'form_maker')) . "'.replace('%s','" . $label_label[$key] . "'));</script>";
        return array($max + 1);
      }
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $r = $wpdb->prefix . "formmaker_submits";
    
    $save_or_no = $wpdb->insert($r, array(
        'form_id' => $id_old,
        'element_label' => $i,
        'element_value' => stripslashes(esc_html($value)),
        'group_id' => ($max + 1),
        'date' => date('Y-m-d H:i:s'),
        'ip' => $ip,
      ), array(
        '%d',
        '%s',
        '%s',
        '%d',
        '%s',
        '%s'
      ));
    if (!$save_or_no) {
      return FALSE;
    }
    $chgnac = FALSE;
  }
  $str = '';
  if ($chgnac) {
    global $wpdb;
    if (count($all_files) == 0) {
      @session_start();
    }
    if ($form->submit_text_type != 4) {
      $_SESSION['massage_after_submit'] = addslashes(addslashes(__('Nothing was submitted.', 'form_maker')));
    }
    $_SESSION['error_or_no'] = 1;
    $_SESSION['form_submit_type'] = $form->submit_text_type . "," . $form->id;
    wp_redirect($_SERVER["REQUEST_URI"]);
    exit;
  }
  return array($all_files, $str);
}

function gen_mail($counter, $all_files, $id, $str) {
  @session_start();
  global $wpdb;
  $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id=%d", $id));
  if (!$row->form_front) {
    $id = '';
  }
  $label_order_original = array();
  $label_order_ids = array();
  $label_label = array();
  $label_type = array();
  $cc = array();
  $row_mail_one_time = 1;
  $label_all = explode('#****#', $row->label_order_current);
  $label_all = array_slice($label_all, 0, count($label_all) - 1);
  foreach ($label_all as $key => $label_each) {
    $label_id_each = explode('#**id**#', $label_each);
    $label_id = $label_id_each[0];
    array_push($label_order_ids, $label_id);
    $label_order_each = explode('#**label**#', $label_id_each[1]);
    $label_order_original[$label_id] = $label_order_each[0];
    $label_type[$label_id] = $label_order_each[1];
    array_push($label_label, $label_order_each[0]);
    array_push($label_type, $label_order_each[1]);
  }
  $list = '<table border="1" cellpadding="3" cellspacing="0" style="width:600px;">';
  foreach ($label_order_ids as $key => $label_order_id) {
    $i = $label_order_id;
    $type = $_POST[$i . "_type" . $id];
    if (isset($_POST[$i . "_type" . $id]))
      if ($type != "type_map" and  $type != "type_submit_reset" and  $type != "type_editor" and  $type != "type_captcha" and  $type != "type_recaptcha" and  $type != "type_button") {
        $element_label = $label_order_original[$i];
        switch ($type) {
          case 'type_text':
          case 'type_password':
          case 'type_textarea':
          case "type_date":
          case "type_own_select":
          case "type_country":
          case "type_number":
            {
            $element = $_POST[$i . "_element" . $id];
            if (isset($_POST[$i . "_element" . $id])) {
              $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">' . $element . '</pre></td></tr>';
            }
            break;
            }
          case "type_hidden": {
            $element = $_POST[$element_label];
            if (isset($element)) {
              $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">' . $element . '</pre></td></tr>';
            }
            break;
          }
          case "type_submitter_mail":
            {
            $element = $_POST[$i . "_element" . $id];
            if (isset($_POST[$i . "_element" . $id])) {
              $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">' . $element . '</pre></td></tr>';
              if ($_POST[$i . "_send" . $id] == "yes")
                array_push($cc, $element);
            }
            break;
            }
          case "type_time":
            {
            $hh = $_POST[$i . "_hh" . $id];
            if (isset($_POST[$i . "_hh" . $id])) {
              $ss = $_POST[$i . "_ss" . $id];
              if (isset($_POST[$i . "_ss" . $id]))
                $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >' . $_POST[$i . "_hh" . $id] . ':' . $_POST[$i . "_mm" . $id] . ':' . $_POST[$i . "_ss" . $id];
              else
                $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >' . $_POST[$i . "_hh" . $id] . ':' . $_POST[$i . "_mm" . $id];
              $am_pm = $_POST[$i . "_am_pm" . $id];
              if (isset($_POST[$i . "_am_pm" . $id]))
                $list = $list . ' ' . $_POST[$i . "_am_pm" . $id] . '</td></tr>';
              else
                $list = $list . '</td></tr>';
            }
            break;
            }
          case "type_phone":
            {
            $element_first = $_POST[$i . "_element_first" . $id];
            if (isset($_POST[$i . "_element_first" . $id])) {
              $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >' . $_POST[$i . "_element_first" . $id] . ' ' . $_POST[$i . "_element_last" . $id] . '</td></tr>';
            }
            break;
            }
          case "type_name":
            {
            $element_first = $_POST[$i . "_element_first" . $id];
            if (isset($_POST[$i . "_element_first" . $id])) {
              $element_title = $_POST[$i . "_element_title" . $id];
              if (isset($_POST[$i . "_element_title" . $id]))
                $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >' . $_POST[$i . "_element_title" . $id] . ' ' . $_POST[$i . "_element_first" . $id] . ' ' . $_POST[$i . "_element_last" . $id] . ' ' . $_POST[$i . "_element_middle" . $id] . '</td></tr>';
              else
                $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >' . $_POST[$i . "_element_first" . $id] . ' ' . $_POST[$i . "_element_last" . $id] . '</td></tr>';
            }
            break;
            }
          case "type_mark_map":
            {
            if (isset($_POST[$i . "_long" . $id])) {
              $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >Longitude:' . $_POST[$i . "_long" . $id] . '<br/>Latitude:' . $_POST[$i . "_lat" . $id] . '</td></tr>';
            }
            break;
            }
          case "type_address":
            {
            if (isset($_POST[$i . "_street1" . $id]))
              $list = $list . '<tr valign="top"><td >' . $label_order_original[$i] . '</td><td >' . $_POST[$i . "_street1" . $id] . '</td></tr>';
            $i++;
            if (isset($_POST[$i."_street2".$id]))
              $list = $list . '<tr valign="top"><td >' . $label_order_original[$i] . '</td><td >' . $_POST[$i . "_street2" . $id] . '</td></tr>';
            $i++;
            if (isset($_POST[$i."_city".$id]))
              $list = $list . '<tr valign="top"><td >' . $label_order_original[$i] . '</td><td >' . $_POST[$i . "_city" . $id] . '</td></tr>';
            $i++;
            if (isset($_POST[$i."_state".$id]))
              $list = $list . '<tr valign="top"><td >' . $label_order_original[$i] . '</td><td >' . $_POST[$i . "_state" . $id] . '</td></tr>';
            $i++;
            if (isset($_POST[$i."_postal".$id]))
              $list = $list . '<tr valign="top"><td >' . $label_order_original[$i] . '</td><td >' . $_POST[$i . "_postal" . $id] . '</td></tr>';
            $i++;
            if (isset($_POST[$i."_country".$id]))
              $list = $list . '<tr valign="top"><td >' . $label_order_original[$i] . '</td><td >' . $_POST[$i . "_country" . $id] . '</td></tr>';
            $i++;
            break;
          }
          case "type_date_fields":
            {
            $day = $_POST[$i . "_day" . $id];
            if (isset($_POST[$i . "_day" . $id])) {
              $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >' . $_POST[$i . "_day" . $id] . '-' . $_POST[$i . "_month" . $id] . '-' . $_POST[$i . "_year" . $id] . '</td></tr>';
            }
            break;
            }
          case "type_radio":
            {
            $element = $_POST[$i . "_other_input" . $id];
            if (isset($_POST[$i . "_other_input" . $id])) {
              $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >' . $_POST[$i . "_other_input" . $id] . '</td></tr>';
              break;
            }
            $element = $_POST[$i . "_element" . $id];
            if (isset($_POST[$i . "_element" . $id])) {
              $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">' . $element . '</pre></td></tr>';
            }
            break;
            }
          case "type_checkbox":
            {
            $list = $list . '<tr valign="top"><td >' . $element_label . '</td><td >';
            $start = -1;
            for ($j = 0; $j < 100; $j++) {
              if (isset($_POST[$i . "_element" . $id . $j])) {
                $start = $j;
                break;
              }
            }
            $other_element_id = -1;
            $is_other = $_POST[$i . "_allow_other" . $id];
            if ($is_other == "yes") {
              $other_element_id = $_POST[$i . "_allow_other_num" . $id];
            }
            if ($start != -1) {
              for ($j = $start; $j < 100; $j++) {
                $element = $_POST[$i . "_element" . $id . $j];
                if (isset($_POST[$i . "_element" . $id . $j]))
                  if ($j == $other_element_id) {
                    $list = $list . $_POST[$i . "_other_input" . $id] . '<br>';
                  }
                  else

                    $list = $list . $_POST[$i . "_element" . $id . $j] . '<br>';
              }
              $list = $list . '</td></tr>';
            }
            break;
          }
          case "type_star_rating": {
            $selected = (isset($_POST[$i."_selected_star_amount".$id]) ? $_POST[$i."_selected_star_amount".$id] : 0);
            if (isset($_POST[$i."_star_amount".$id])) {
              $list = $list.'<tr valign="top"><td >'.$element_label.'</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">'.$selected.'/'.$_POST[$i."_star_amount".$id].'</pre></td></tr>';
            }
            break;
          }
          case "type_scale_rating": {
						$selected = (isset($_POST[$i."_scale_radio".$id]) ? $_POST[$i."_scale_radio".$id] : 0);
            if (isset($_POST[$i."_scale_amount".$id])) {
              $list = $list.'<tr valign="top"><td >'.$element_label.'</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">'.$selected.'/'.$_POST[$i."_scale_radio".$id].'</pre></td></tr>';
						}
            break;
          }
          case "type_spinner": {
            if (isset($_POST[$i."_element".$id])) {
              $list=$list.'<tr valign="top"><td >'.$element_label.'</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">'.$_POST[$i."_element".$id].'</pre></td></tr>';					
            }
            break;
          }
          case "type_slider": {
            if (isset($_POST[$i."_slider_value".$id])) {
              $list=$list.'<tr valign="top"><td >'.$element_label.'</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">'.$_POST[$i."_slider_value".$id].'</pre></td></tr>';					
						}
            break;
          }
          case "type_range": {
            if(isset($_POST[$i."_element".$id.'0']) || isset($_POST[$i."_element".$id.'1'])) {
              $list = $list.'<tr valign="top"><td >'.$element_label.'</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">From:'.$_POST[$i."_element".$id.'0'].'<span style="margin-left:6px">To</span>:'.$_POST[$i."_element".$id.'1'].'</pre></td></tr>';
            }
            break;
          }
          case "type_grading": {
            if (isset($_POST[$i."_hidden_item".$id])) {
							$element = $_POST[$i."_hidden_item".$id];
							$grading = explode(":", $element);
							$items_count = sizeof($grading) - 1;
							$total = "";
							for ($k = 0; $k < $items_count; $k++) {
                if (isset($_POST[$i."_element".$id.$k])) {
                  $element .= $grading[$k].":".$_POST[$i."_element".$id.$k]." ";
                  $total += $_POST[$i."_element".$id.$k];
                }
							}
							$element .= "Total:".$total;
              $list = $list.'<tr valign="top"><td >'.$element_label.'</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">'.$element.'</pre></td></tr>';
						}
            break;
          }
          case "type_matrix": {
            $input_type=$_POST[$i."_input_type".$id]; 
                        
            $mat_rows = $_POST[$i."_hidden_row".$id];
            $mat_rows = explode('***', $mat_rows);
            $mat_rows = array_slice($mat_rows,0, count($mat_rows)-1);
            $mat_columns = $_POST[$i."_hidden_column".$id];
            $mat_columns = explode('***', $mat_columns);
            $mat_columns = array_slice($mat_columns,0, count($mat_columns)-1);
            $row_ids=explode(",",substr($_POST[$i."_row_ids".$id], 0, -1));
            $column_ids=explode(",",substr($_POST[$i."_column_ids".$id], 0, -1));
            $matrix = "<table>";
            $matrix .= '<tr><td></td>';
            for ($k = 0; $k < count($mat_columns); $k++) {
              $matrix .='<td style="background-color:#BBBBBB; padding:5px; ">'.$mat_columns[$k].'</td>';
            }
            $matrix .= '</tr>';
            $aaa = Array();
            $k = 0;
            foreach ($row_ids as $row_id) {
              $matrix .= '<tr><td style="background-color:#BBBBBB; padding:5px;">'.$mat_rows[$k].'</td>';
              if ($input_type=="radio") {
                $mat_radio = (isset($_POST[$i."_input_element".$id.$row_id]) ? $_POST[$i."_input_element".$id.$row_id] : 0);											
                if ($mat_radio == 0) {
                  $checked = "";
                  $aaa[1] = "";
                }
                else {
                  $aaa = explode("_", $mat_radio);
                }
                foreach ($column_ids as $column_id) {
                  if ($aaa[1] == $column_id) {
                    $checked = "checked";
                  }
                  else {
                    $checked = "";
                  }
                  $matrix .= '<td style="text-align:center"><input  type="radio" '.$checked.' disabled /></td>';
                }
              }
              else {
                if ($input_type=="checkbox") {
                  foreach($column_ids as $column_id) {
                    $checked = $_POST[$i."_input_element".$id.$row_id.'_'.$column_id];                     
                    if ($checked == 1) {			
                      $checked = "checked";
                    }
                    else {		
                      $checked = "";
                    }
                    $matrix .= '<td style="text-align:center"><input  type="checkbox" '.$checked.' disabled /></td>';
                  } 
                }
                else {
                  if ($input_type=="text") {
                    foreach ($column_ids as $column_id) {
                      $checked = $_POST[$i."_input_element".$id.$row_id.'_'.$column_id];
                      $matrix .='<td style="text-align:center"><input  type="text" value="'.$checked.'" disabled /></td>';
                    }
                  }
                  else {
                    foreach ($column_ids as $column_id) {
                      $checked = $_POST[$i."_select_yes_no".$id.$row_id.'_'.$column_id];
                      $matrix .='<td style="text-align:center">'.$checked.'</td>';
                    }
                  }
                }
              }
              $matrix .= '</tr>';
              $k++;
            }
            $matrix .= '</table>';
            if (isset($matrix)) {
              $list = $list.'<tr valign="top"><td >'.$element_label.'</td><td ><pre style="font-family:inherit; margin:0px; padding:0px">'.$matrix.'</pre></td></tr>';
            }
            break;
          }
          default:
            break;
        }
      }
  }
  $list = $list . '</table>';
  $list = wordwrap($list, 70, "\n", TRUE);
  // add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
  if ($row->from_mail != '') {
    if ($row->from_name != '') {
      $from_mail = "From: " . $row->from_name . " <" . $row->from_mail . ">" . "\r\n";
    }
    else {
      $from_mail = "From: " . $row->from_mail . " <" . $row->from_mail . ">" . "\r\n";
    }
  }
  else {
    $from_mail = '';
  }
  $headers = "MIME-Version: 1.0\n" . $from_mail . " Content-Type: text/html; charset=\"" . get_option('blog_charset') . "\"\n";
  for ($k = 0; $k < count($all_files); $k++) {
    // $attachment[$k] = dirname(__FILE__) . '/uploads/' . $all_files[$k]['name'];
    $attachment[$k]= $all_files[$k]['name'];
  }
  if (isset($cc[0])) {
    foreach ($cc as $c) {
      if ($c) {
        $recipient = $c;
        $subject = $row->title;
        $new_script = wpautop($row->script_mail_user);
        foreach ($label_order_original as $key => $label_each) {
          if (strpos($row->script_mail_user, "%" . $label_each . "%") !== FALSE) {
            $type = $label_type[$key];
            if ($type != "type_submit_reset" or $type != "type_map" or $type != "type_editor" or  $type != "type_captcha" or  $type != "type_recaptcha" or  $type != "type_button") {
              $new_value = "";
              switch ($type) {
                case 'type_text':
                case 'type_password':
                case 'type_textarea':
                case "type_date":
                case "type_own_select":					
                case "type_country":				
                case "type_number":	 {
                  $element = $_POST[$key."_element".$id];
                  if (isset($element)) {
                    $new_value = $element;					
                  }
                  break;
                }
                case "type_hidden": {
                  $element = $_POST[$element_label];
                  if (isset($element)) {
                    $new_value = $element;	
                  }
                  break;
                }                
                case "type_mark_map": {
                  $element = $_POST[$key."_long".$id];
                  if (isset($element)) {
                    $new_value = 'Longitude:'.$_POST[$key."_long".$id].'<br/>Latitude:' . $_POST[$key."_lat".$id];
                  }
                  break;
                }
                case "type_submitter_mail": {
                  $element = $_POST[$key."_element".$id];
                  if (isset($element)) {
                    $new_value = $element;					
                  }
                  break;
                }
                case "type_time": {
                  $hh = $_POST[$key."_hh".$id];
                  if (isset($hh)) {
                    $ss = $_POST[$key."_ss".$id];
                    if (isset($ss)) {
                      $new_value = $_POST[$key."_hh".$id].':'.$_POST[$key."_mm".$id].':'.$_POST[$key."_ss".$id];
                    }
                    else {
                      $new_value = $_POST[$key."_hh".$id].':'.$_POST[$key."_mm".$id];
                    }
                    $am_pm = $_POST[$key."_am_pm".$id];
                    if (isset($am_pm)) {
                      $new_value = $new_value.' '.$_POST[$key."_am_pm".$id];
                    }
                  }
                  break;
                }
                case "type_phone": {
                  $element_first = $_POST[$key."_element_first".$id];
                  if (isset($element_first)) {
                    $new_value = $_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id];
                  }	
                  break;
                }
                case "type_name": {
                  $element_first = $_POST[$key."_element_first".$id];
                  if (isset($element_first)) {
                    $element_title = $_POST[$key."_element_title".$id];
                    if (isset($element_title)) {
                      $new_value = $_POST[$key."_element_title".$id].' '.$_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id].' '.$_POST[$key."_element_middle".$id];
                    }
                    else {
                      $new_value = $_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id];
                    }
                  }	   
                  break;		
                }
                case "type_address": {
                  if (isset($_POST[$key."_street1".$id])) {
                    $new_value = $new_value.$_POST[$key."_street1".$id];
                    break;
                  }
                  if (isset($_POST[$key."_street2".$id])) {
                    $new_value = $new_value.$_POST[$key."_street2".$id];
                    break;
                  }
                  if (isset($_POST[$key."_city".$id])) {
                    $new_value = $new_value.$_POST[$key."_city".$id];
                    break;
                  }
                  if (isset($_POST[$key."_state".$id])) {
                    $new_value = $new_value.$_POST[$key."_state".$id];
                    break;
                  }
                  if (isset($_POST[$key."_postal".$id])) {
                    $new_value = $new_value.$_POST[$key."_postal".$id];
                    break;
                  }
                  if (isset($_POST[$key."_country".$id])) {
                    $new_value = $new_value.$_POST[$key."_country".$id];
                    break;
                  }
                }
                case "type_date_fields": {
                  $day = $_POST[$key."_day".$id];
                  if (isset($day)) {
                    $new_value = $_POST[$key."_day".$id].'-'.$_POST[$key."_month".$id].'-'.$_POST[$key."_year".$id];
                  }
                  break;
                }
                case "type_radio": {
                  $element = $_POST[$key."_other_input".$id];
                  if (isset($element)) {
                    $new_value = $_POST[$key."_other_input".$id];
                    break;
                  }
                  $element = $_POST[$key."_element".$id];
                  if (isset($element)) {
                    $new_value = $element;					
                  }
                  break;	
                }
                case "type_checkbox": {
                  $start = -1;
                  for ($j = 0; $j < 100; $j++) {
                    $element = $_POST[$key."_element".$id.$j];
                    if (isset($element)) {
                      $start = $j;
                      break;
                    }
                  }
                  $other_element_id = -1;
                  $is_other = $_POST[$key."_allow_other".$id];
                  if ($is_other == "yes") {
                    $other_element_id = $_POST[$key."_allow_other_num".$id];
                  }
                  if ($start != -1) {
                    for ($j = $start; $j < 100; $j++) {
                      $element = $_POST[$key."_element".$id.$j];
                      if (isset($element)) {
                        if ($j == $other_element_id) {
                          $new_value = $new_value.$_POST[$key."_other_input".$id].'<br>';
                        }
                        else {
                          $new_value = $new_value.$_POST[$key."_element".$id.$j].'<br>';
                        }
                      }
                    }
                  }
                  break;
                }
                case "type_star_rating":
															{
																$element=$_POST[$key."_star_amount".$id];
																$selected=(isset($_POST[$key."_selected_star_amount".$id]) ? $_POST[$key."_selected_star_amount".$id] : 0);
																
																
																if(isset($element))
																{
																	$new_value=$new_value.$selected.'/'.$element;					
																}
																break;
															}
															

															case "type_scale_rating":
															{
															$element=$_POST[$key."_scale_amount".$id];
															$selected=(isset($_POST[$key."_scale_radio".$id]) ? $_POST[$key."_scale_radio".$id] : 0);
															
																
																if(isset($element))
																{
																	$new_value=$new_value.$selected.'/'.$element;					
																}
																break;
															}
															
															case "type_spinner":
															{

																if (isset($_POST[$key."_element".$id])) {
																	$new_value = $new_value . $_POST[$key."_element".$id];					
																}
																break;
															}
															
															case "type_slider":
															{

																$element=$_POST[$key."_slider_value".$id];
																if(isset($element))
																{
																	$new_value=$new_value.$element;					
																}
																break;
															}
															case "type_range":
															{

																$element0=$_POST[$key."_element".$id.'0'];
																$element1=$_POST[$key."_element".$id.'1'];
																if(isset($element0) || isset($element1))
																{
																	$new_value=$new_value.$element0.'-'.$element1;					
																}
																break;
															}
															
															case "type_grading":
															{
																$element=$_POST[$key."_hidden_item".$id];
																$grading = explode(":",$element);
																$items_count = sizeof($grading)-1;
																
																$element = "";
																$total = "";
																
																for($k=0;$k<$items_count;$k++)

																{
																	$element .= $grading[$k].":".$_POST[$key."_element".$id.$k]." ";
															$total += $_POST[$key."_element".$id.$k];
														}

														$element .="Total:".$total;

																											
														if(isset($element))
														{
															$new_value=$new_value.$element;					
														}
														break;
													}
													
														case "type_matrix":
													{
													
														
														$input_type=$_POST[$key."_input_type".$id]; 
																				
														$mat_rows = $_POST[$key."_hidden_row".$id];
														$mat_rows = explode('***', $mat_rows);
														$mat_rows = array_slice($mat_rows,0, count($mat_rows)-1);
														
														$mat_columns = $_POST[$key."_hidden_column".$id];
														$mat_columns = explode('***', $mat_columns);
														$mat_columns = array_slice($mat_columns,0, count($mat_columns)-1);
												  
														$row_ids=explode(",",substr($_POST[$key."_row_ids".$id], 0, -1));
														$column_ids=explode(",",substr($_POST[$key."_column_ids".$id], 0, -1)); 
								
																	
														$matrix="<table>";
																	
															$matrix .='<tr><td></td>';
														
														for( $k=0;$k< count($mat_columns) ;$k++)
															$matrix .='<td style="background-color:#BBBBBB; padding:5px; ">'.$mat_columns[$k].'</td>';
															$matrix .='</tr>';
														
														$aaa=Array();
														   $k=0;
														foreach( $row_ids as $row_id){
														$matrix .='<tr><td style="background-color:#BBBBBB; padding:5px;">'.$mat_rows[$k].'</td>';
														
														  if($input_type=="radio"){
														 
														$mat_radio = (isset($_POST[$key."_input_element".$id.$row_id]) ? $_POST[$key."_input_element".$id.$row_id] : 0);											
														  if($mat_radio==0){
																$checked="";
																$aaa[1]="";
																}
																else{
																$aaa=explode("_",$mat_radio);
																}
																
																foreach( $column_ids as $column_id){
																	if($aaa[1]==$column_id)
																	$checked="checked";
																	else
																	$checked="";
																$matrix .='<td style="text-align:center"><input  type="radio" '.$checked.' disabled /></td>';
																
																}
																
															} 
															else{
															if($input_type=="checkbox")
															{                
																foreach( $column_ids as $column_id){
																 $checked = $_POST[$key."_input_element".$id.$row_id.'_'.$column_id];                              
																 if($checked==1)							
																 $checked = "checked";						
																 else									 
																 $checked = "";

																$matrix .='<td style="text-align:center"><input  type="checkbox" '.$checked.' disabled /></td>';
															
															}
															
															}
															else
															{
															if($input_type=="text")
															{
																					  
																foreach( $column_ids as $column_id){
																 $checked = $_POST[$key."_input_element".$id.$row_id.'_'.$column_id];
																	
																$matrix .='<td style="text-align:center"><input  type="text" value="'.$checked.'" disabled /></td>';
													
															}
															
															}
															else{
																foreach( $column_ids as $column_id){
																 $checked = $_POST[$key."_select_yes_no".$id.$row_id.'_'.$column_id];
																	 $matrix .='<td style="text-align:center">'.$checked.'</td>';
																
												
															
																}
															}
															
															}
															
															}
															$matrix .='</tr>';
															$k++;
														}
														 $matrix .='</table>';

									
									
									
																										
														if(isset($matrix))
														{
															$new_value=$new_value.$matrix;					
														}
													
														break;
													}
                default: break;
              }
              $new_script = str_replace("%".$label_each."%", $new_value, $new_script);	
            }
          }
        }       
        if (strpos($new_script, "%all%") !== FALSE) {
          $new_script = str_replace("%all%", $list, $new_script);
        }
        $body = $new_script;
        $send = wp_mail(str_replace(' ', '', $recipient), $subject, stripslashes($body), $headers, $attachment);
      }
      if ($row->mail) {
        if ($c) {
          // $headers_form_mail = "From: " . $c . " <" . $c . ">" . "\r\n";
          $headers = "MIME-Version: 1.0\n" . "From: " . $c . " <" . $c . ">" . "\r\n" . "Content-Type: text/html; charset=\"" . get_option('blog_charset') . "\"\n";
        }
        // else {
          // $headers_form_mail = "";
        // }
        if ($row_mail_one_time) {
          $recipient = $row->mail;
          $subject = $row->title;
          $new_script = wpautop($row->script_mail);
          foreach($label_order_original as $key => $label_each) {	
            if (strpos($row->script_mail, "%" . $label_each . "%") !== FALSE) {
              $type = $label_type[$key];
              if ($type != "type_submit_reset" or $type!="type_map" or $type!="type_editor" or  $type!="type_captcha" or  $type!="type_recaptcha" or  $type!="type_button") {
                $new_value ="";
                switch ($type) {
                  case 'type_text':
                  case 'type_password':
                  case 'type_textarea':
                  case "type_date":
                  case "type_own_select":					
                  case "type_country":				
                  case "type_number":	 {
                    $element = $_POST[$key."_element".$id];
                    if (isset($element)) {
                      $new_value = $element;					
                    }
                    break;
                  }
                  case "type_hidden": {
                    $element = $_POST[$element_label];
                    if(isset($element))
                    {
                      $new_value = $element;	
                    }
                    break;
                  }
                  case "type_mark_map": {
                    $element = $_POST[$key."_long".$id];
                    if (isset($element)) {
                      $new_value = 'Longitude:'.$_POST[$key."_long".$id].'<br/>Latitude:'.$_POST[$key."_lat".$id];
                    }
                    break;		
                  }
                  case "type_submitter_mail": {
                    $element = $_POST[$key."_element".$id];
                    if (isset($element)) {
                      $new_value = $element;					
                    }
                    break;
                  }
                  case "type_time": {
                    $hh = $_POST[$key."_hh".$id];
                    if (isset($hh)) {
                      $ss = $_POST[$key."_ss".$id];
                      if (isset($ss)) {
                        $new_value = $_POST[$key."_hh".$id].':'.$_POST[$key."_mm".$id].':'.$_POST[$key."_ss".$id];
                      }
                      else {
                        $new_value = $_POST[$key."_hh".$id].':'.$_POST[$key."_mm".$id];
                      }
                      $am_pm = $_POST[$key."_am_pm".$id];
                      if (isset($am_pm)) {
                        $new_value = $new_value.' '.$_POST[$key."_am_pm".$id];
                      }
                    }
                    break;
                  }
                  case "type_phone": {
                    $element_first = $_POST[$key."_element_first".$id];
                    if (isset($element_first)) {
                      $new_value = $_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id];
                    }	
                    break;
                  }
                  case "type_name": {
                    $element_first = $_POST[$key."_element_first".$id];
                    if (isset($element_first)) {
                      $element_title = $_POST[$key."_element_title".$id];
                      if (isset($element_title)) {
                        $new_value = $_POST[$key."_element_title".$id].' '.$_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id].' '.$_POST[$key."_element_middle".$id];
                      }
                      else {
                        $new_value = $_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id];
                      }
                    }	   
                    break;		
                  }
                  case "type_address": {
                    $street1 = $_POST[$key."_street1".$id];
                    if (isset($_POST[$key."_street1".$id])) {
                      $new_value = $new_value.$_POST[$key."_street1".$id];
                      break;
                    }
                    if (isset($_POST[$key."_street2".$id])) {
                      $new_value=$new_value.$_POST[$key."_street2".$id];
                      break;
                    }
                    if (isset($_POST[$key."_city".$id])) {
                      $new_value=$new_value.$_POST[$key."_city".$id];
                      break;
                    }
                    if (isset($_POST[$key."_state".$id])) {
                      $new_value=$new_value.$_POST[$key."_state".$id];
                      break;
                    }
                    if (isset($_POST[$key."_postal".$id])) {
                      $new_value=$new_value.$_POST[$key."_postal".$id];
                      break;
                    }
                    if (isset($_POST[$key."_country".$id])) {
                      $new_value=$new_value.$_POST[$key."_country".$id];
                      break;
                    }
                  }
                  case "type_date_fields": {
                    $day = $_POST[$key."_day".$id];
                    if (isset($day)) {
                      $new_value = $_POST[$key."_day".$id].'-'.$_POST[$key."_month".$id].'-'.$_POST[$key."_year".$id];
                    }
                    break;
                  }
                  case "type_radio": {
                    $element = $_POST[$key."_other_input".$id];
                    if (isset($element)) {
                      $new_value = $_POST[$key."_other_input".$id];
                      break;
                    }
                    $element = $_POST[$key."_element".$id];
                    if (isset($element)) {
                      $new_value = $element;					
                    }
                    break;
                  }
                  case "type_checkbox": {
                    $start = -1;
                    for ($j=0; $j<100; $j++) {
                      $element = $_POST[$key."_element".$id.$j];
                      if (isset($element)) {
                        $start = $j;
                        break;
                      }
                    }	
                    $other_element_id=-1;
                    $is_other = $_POST[$key."_allow_other".$id];
                    if ($is_other == "yes") {
                      $other_element_id = $_POST[$key."_allow_other_num".$id];
                    }
                    if ($start != -1) {
                      for ($j = $start; $j < 100; $j++) {
                        $element = $_POST[$key."_element".$id.$j];
                        if (isset($element)) {
                          if ($j == $other_element_id) {
                            $new_value = $new_value.$_POST[$key."_other_input".$id].'<br>';
                          }
                          else {
                            $new_value = $new_value.$_POST[$key."_element".$id.$j].'<br>';
                          }
                        }
                      }
                    }
                    break;
                  }
                  case "type_star_rating": {
                    if (isset($_POST[$key."_star_amount".$id])) {
                      $selected = (isset($_POST[$key."_selected_star_amount".$id]) ? $_POST[$key."_selected_star_amount".$id] : 0);
                      $new_value = $new_value.$selected.'/'.$_POST[$key."_star_amount".$id];					
                    }
                    break;
                  }
                  case "type_scale_rating": {
                    if (isset($_POST[$key."_scale_amount".$id])) {
                      $selected = (isset($_POST[$key."_scale_radio".$id]) ? $_POST[$key."_scale_radio".$id] : 0);
                      $new_value=$new_value.$selected.'/'.$_POST[$key."_scale_amount".$id];					
                    }
                    break;
                  }
                  case "type_spinner": {
                    if(isset($_POST[$key."_element".$id])) {
                      $new_value = $new_value.$_POST[$key."_element".$id];					
                    }
                    break;
                  }
                  case "type_slider": {
                    if (isset($_POST[$key."_slider_value".$id])) {
                      $new_value = $new_value.$_POST[$key."_slider_value".$id];
                    }
                    break;
                  }
                  case "type_range": {
                    if (isset($_POST[$key."_element".$id.'0']) || isset($_POST[$key."_element".$id.'1'])) {
                      $new_value=$new_value.$_POST[$key."_element".$id.'0'].'-'.$_POST[$key."_element".$id.'1'];
                    }
                    break;
                  }
															
															case "type_grading":
															{
																$element=$_POST[$key."_hidden_item".$id];
																$grading = explode(":",$element);
																$items_count = sizeof($grading)-1;
																
																$element = "";
																$total = "";
																
																for($k=0;$k<$items_count;$k++) {
																	$element .= $grading[$k].":".$_POST[$key."_element".$id.$k]." ";
															$total += $_POST[$key."_element".$id.$k];
														}

														$element .="Total:".$total;

																											
														if(isset($element))
														{
															$new_value=$new_value.$element;					
														}
														break;
													}
													
														case "type_matrix":
													{
													
														
														$input_type=$_POST[$key."_input_type".$id]; 
																				
														$mat_rows = $_POST[$key."_hidden_row".$id];
														$mat_rows = explode('***', $mat_rows);
														$mat_rows = array_slice($mat_rows,0, count($mat_rows)-1);
														
														$mat_columns = $_POST[$key."_hidden_column".$id];
														$mat_columns = explode('***', $mat_columns);
														$mat_columns = array_slice($mat_columns,0, count($mat_columns)-1);
												  
														$row_ids=explode(",",substr($_POST[$key."_row_ids".$id], 0, -1));
														$column_ids=explode(",",substr($_POST[$key."_column_ids".$id], 0, -1)); 
														$matrix="<table>";
																	
														$matrix .='<tr><td></td>';
														
														for( $k=0;$k< count($mat_columns) ;$k++)
															$matrix .='<td style="background-color:#BBBBBB; padding:5px; ">'.$mat_columns[$k].'</td>';
															$matrix .='</tr>';
														
														$aaa=Array();
														   $k=0;
														foreach( $row_ids as $row_id){
														$matrix .='<tr><td style="background-color:#BBBBBB; padding:5px;">'.$mat_rows[$k].'</td>';
														
														  if($input_type=="radio"){
														 
														$mat_radio = (isset($_POST[$key."_input_element".$id.$row_id]) ? $_POST[$key."_input_element".$id.$row_id] : 0);											
														  if($mat_radio==0){
																$checked="";
																$aaa[1]="";
																}
																else{
																$aaa=explode("_",$mat_radio);
																}
																
																foreach( $column_ids as $column_id){
																	if($aaa[1]==$column_id)
																	$checked="checked";
																	else
																	$checked="";
																$matrix .='<td style="text-align:center"><input  type="radio" '.$checked.' disabled /></td>';
																
																}
																
															} 
															else{
															if($input_type=="checkbox")
															{                
																foreach( $column_ids as $column_id){
																 $checked = $_POST[$key."_input_element".$id.$row_id.'_'.$column_id];                              
																 if($checked==1)							
																 $checked = "checked";						
																 else									 
																 $checked = "";

																$matrix .='<td style="text-align:center"><input  type="checkbox" '.$checked.' disabled /></td>';
															
															}
															
															}
															else
															{
															if($input_type=="text")
															{
																					  
																foreach( $column_ids as $column_id){
																 $checked = $_POST[$key."_input_element".$id.$row_id.'_'.$column_id];
																	
																$matrix .='<td style="text-align:center"><input  type="text" value="'.$checked.'" disabled /></td>';
													
															}
															
															}
															else{
																foreach( $column_ids as $column_id){
																 $checked = $_POST[$key."_select_yes_no".$id.$row_id.'_'.$column_id];
																	 $matrix .='<td style="text-align:center">'.$checked.'</td>';
																
												
															
															}
															}
															
															}
															
															}
															$matrix .='</tr>';
															$k++;
														}
														 $matrix .='</table>';

									
									
									
																										
														if(isset($matrix))
														{
															$new_value=$new_value.$matrix;					
														}
													
														break;
													}
                  default: break;
                }
                $new_script = str_replace("%".$label_each."%", $new_value, $new_script);	
              }
            }
          }
          if (strpos($new_script, "%all%") !== FALSE) {
            $new_script = str_replace("%all%", $list, $new_script);
          }
          $body = $new_script;
          $mode = 1;
          $send = wp_mail(str_replace(' ', '', $recipient), $subject, stripslashes($body), $headers, $attachment);
          $row_mail_one_time = 0;
        }
      }
    }
  }
  else {
    if ($row->mail) {
      $recipient = $row->mail;
      $subject = $row->title;
      $new_script = wpautop($row->script_mail);
      foreach($label_order_original as $key => $label_each) {
        if (strpos($row->script_mail, "%" . $label_each . "%") !== FALSE) {
          $type = $label_type[$key];
          if ($type != "type_submit_reset" or $type != "type_map" or $type != "type_editor" or  $type!="type_captcha" or  $type!="type_recaptcha" or  $type!="type_button") {
            $new_value = "";
            switch ($type) {
              case 'type_text':
              case 'type_password':
              case 'type_textarea':
              case "type_date":
              case "type_own_select":					
              case "type_country":				
              case "type_number":	{
                $element = $_POST[$key."_element".$id];
                if (isset($element)) {
                  $new_value = $element;					
                }
                break;
              }
              case "type_hidden": {
                $element = $_POST[$element_label];
                if (isset($element)) {
                  $new_value = $element;	
                }
                break;
              }
              case "type_mark_map": {
                $element = $_POST[$key."_long".$id];
                if (isset($element)) {
                  $new_value = 'Longitude:'.$_POST[$key."_long".$id].'<br/>Latitude:'.$_POST[$key."_lat".$id];
                }
                break;
              }
              case "type_submitter_mail": {
                $element = $_POST[$key."_element".$id];
                if (isset($element)) {
                  $new_value = $element;					
                }
                break;		
              }
              case "type_time": {
                $hh = $_POST[$key."_hh".$id];
                if (isset($hh)) {
                  $ss = $_POST[$key."_ss".$id];
                  if (isset($ss)) {
                    $new_value = $_POST[$key."_hh".$id].':'.$_POST[$key."_mm".$id].':'.$_POST[$key."_ss".$id];
                  }
                  else {
                    $new_value = $_POST[$key."_hh".$id].':'.$_POST[$key."_mm".$id];
                  }
                  $am_pm = $_POST[$key."_am_pm".$id];
                  if (isset($am_pm)) {
                    $new_value = $new_value.' '.$_POST[$key."_am_pm".$id];
                  }
                }
                break;
              }
              case "type_phone": {
                $element_first = $_POST[$key."_element_first".$id];
                if (isset($element_first)) {
                  $new_value = $_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id];
                }
                break;
              }
              case "type_name": {
                $element_first = $_POST[$key."_element_first".$id];
                if (isset($element_first)) {
                  $element_title = $_POST[$key."_element_title".$id];
                  if (isset($element_title)) {
                    $new_value = $_POST[$key."_element_title".$id].' '.$_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id].' '.$_POST[$key."_element_middle".$id];
                  }
                  else {
                    $new_value = $_POST[$key."_element_first".$id].' '.$_POST[$key."_element_last".$id];
                  }
                }	   
                break;
              }
              case "type_address": {
                if (isset($_POST[$key."_street1".$id])) {
                  $new_value = $new_value.$_POST[$key."_street1".$id];
                  break;
                }
                if (isset($_POST[$key."_street2".$id])) {
                  $new_value = $new_value.$_POST[$key."_street2".$id];
                  break;
                }
                if (isset($_POST[$key."_city".$id])) {
                  $new_value = $new_value.$_POST[$key."_city".$id];
                  break;
                }
                if (isset($_POST[$key."_state".$id])) {
                  $new_value = $new_value.$_POST[$key."_state".$id];
                  break;
                }
                if (isset($_POST[$key."_postal".$id])) {
                  $new_value = $new_value.$_POST[$key."_postal".$id];
                  break;
                }
                if (isset($_POST[$key."_country".$id])) {
                  $new_value = $new_value.$_POST[$key."_country".$id];
                  break;
                }
              }
              case "type_date_fields": {
                $day = $_POST[$key."_day".$id];
                if (isset($day)) {
                  $new_value = $_POST[$key."_day".$id].'-'.$_POST[$key."_month".$id].'-'.$_POST[$key."_year".$id];
                }
                break;
              }
              case "type_radio": {
                $element = $_POST[$key."_other_input".$id];
                if (isset($element)) {
                  $new_value = $_POST[$key."_other_input".$id];
                  break;
                }
                $element = $_POST[$key."_element".$id];
                if (isset($element)) {
                  $new_value = $element;
                }
                break;
              }
              case "type_checkbox": {
                $start = -1;
                for ($j = 0; $j < 100; $j++) {
                  $element = $_POST[$key."_element".$id.$j];
                  if (isset($element)) {
                    $start = $j;
                    break;
                  }
                }
                $other_element_id = -1;
                $is_other = $_POST[$key."_allow_other".$id];
                if ($is_other == "yes") {
                  $other_element_id = $_POST[$key."_allow_other_num".$id];
                }
                if ($start != -1) {
                  for ($j = $start; $j < 100; $j++) {
                    $element = $_POST[$key."_element".$id.$j];
                    if (isset($element)) {
                      if ($j == $other_element_id) {
                        $new_value = $new_value.$_POST[$key."_other_input".$id].'<br>';
                      }
                      else {
                        $new_value = $new_value.$_POST[$key."_element".$id.$j].'<br>';
                      }
                    }
                  }
                }
                break;
              }
              case "type_star_rating":
															{
																$element=$_POST[$key."_star_amount".$id];
																$selected=(isset($_POST[$key."_selected_star_amount".$id]) ? $_POST[$key."_selected_star_amount".$id] : 0);
																if(isset($element))
																{
																	$new_value=$new_value.$selected.'/'.$element;					
																}
																break;
															}
															

															case "type_scale_rating":
															{
															$element=$_POST[$key."_scale_amount".$id];
															$selected=(isset($_POST[$key."_scale_radio".$id]) ? $_POST[$key."_scale_radio".$id] : 0);
															
																
																if(isset($element))
																{
																	$new_value=$new_value.$selected.'/'.$element;					
																}
																break;
															}
															
															case "type_spinner":
															{

																if(isset($_POST[$key."_element".$id]))
																{
																	$new_value=$new_value.$_POST[$key."_element".$id];					
																}
																break;
															}
															
															case "type_slider":
															{

																$element=$_POST[$key."_slider_value".$id];
																if(isset($element))
																{
																	$new_value=$new_value.$element;					
																}
																break;
															}
															case "type_range":
															{

																$element0=$_POST[$key."_element".$id.'0'];
																$element1=$_POST[$key."_element".$id.'1'];
																if(isset($element0) || isset($element1))
																{
																	$new_value=$new_value.$element0.'-'.$element1;					
																}
																break;
															}
															
															case "type_grading":
															{
																$element=$_POST[$key."_hidden_item".$id];
																$grading = explode(":",$element);
																$items_count = sizeof($grading)-1;
																
																$element = "";
																$total = "";
																
																for($k=0;$k<$items_count;$k++)

																{
																	$element .= $grading[$k].":".$_POST[$key."_element".$id.$k]." ";
															$total += $_POST[$key."_element".$id.$k];
														}

														$element .="Total:".$total;

																											
														if(isset($element))
														{
															$new_value=$new_value.$element;					
														}
														break;
													}
													
														case "type_matrix":
													{
													
														
														$input_type=$_POST[$key."_input_type".$id]; 
																				
														$mat_rows = $_POST[$key."_hidden_row".$id];
														$mat_rows = explode('***', $mat_rows);
														$mat_rows = array_slice($mat_rows,0, count($mat_rows)-1);
														
														$mat_columns = $_POST[$key."_hidden_column".$id];
														$mat_columns = explode('***', $mat_columns);
														$mat_columns = array_slice($mat_columns,0, count($mat_columns)-1);
												  
														$row_ids=explode(",",substr($_POST[$key."_row_ids".$id], 0, -1));
														$column_ids=explode(",",substr($_POST[$key."_column_ids".$id], 0, -1)); 
																				  
																	
														$matrix="<table>";
																	
															$matrix .='<tr><td></td>';
														
														for( $k=0;$k< count($mat_columns) ;$k++)
															$matrix .='<td style="background-color:#BBBBBB; padding:5px; ">'.$mat_columns[$k].'</td>';
															$matrix .='</tr>';
														
														$aaa=Array();
														   $k=0;
														foreach($row_ids as $row_id)
														{
														$matrix .='<tr><td style="background-color:#BBBBBB; padding:5px;">'.$mat_rows[$k].'</td>';
														
														  if($input_type=="radio"){
														 
														$mat_radio = (isset($_POST[$key."_input_element".$id.$row_id]) ? $_POST[$key."_input_element".$id.$row_id] : 0);											
														  if($mat_radio==0){
																$checked="";
																$aaa[1]="";
																}
																else{
																$aaa=explode("_",$mat_radio);
																}
																
																foreach($column_ids as $column_id){
																	if($aaa[1]==$column_id)
																	$checked="checked";
																	else
																	$checked="";
																$matrix .='<td style="text-align:center"><input  type="radio" '.$checked.' disabled /></td>';
																
																}
																
															} 
															else{
															if($input_type=="checkbox")
															{                
																foreach($column_ids as $column_id){
																 $checked = $_POST[$key."_input_element".$id.$row_id.'_'.$column_id];                              
																 if($checked==1)							
																 $checked = "checked";						
																 else									 
																 $checked = "";

																$matrix .='<td style="text-align:center"><input  type="checkbox" '.$checked.' disabled /></td>';
															
															}
															
															}
															else
															{
															if($input_type=="text")
															{
																					  
																foreach($column_ids as $column_id){
																 $checked = $_POST[$key."_input_element".$id.$row_id.'_'.$column_id];
																	
																$matrix .='<td style="text-align:center"><input  type="text" value="'.$checked.'" disabled /></td>';
													
															}
															
															}
															else{
																foreach($column_ids as $column_id){
																 $checked = $_POST[$i."_select_yes_no".$id.$row_id.'_'.$column_id];
																	 $matrix .='<td style="text-align:center">'.$checked.'</td>';
																
												
															
																}
															}
															
															}
															
															}
															$matrix .='</tr>';
															$k++;
														}
														 $matrix .='</table>';

									
									
									
																										
														if(isset($matrix))
														{
															$new_value=$new_value.$matrix;					
														}
													
														break;
													}
              default: break;
            }
            $new_script = str_replace("%".$label_each."%", $new_value, $new_script);
          }
        }
      }
      if (strpos($new_script, "%all%") !== FALSE) {
        $new_script = str_replace("%all%", $list, $new_script);
      }
      $body = $new_script;
      $send = wp_mail(str_replace(' ', '', $recipient), $subject, stripslashes($body), $headers, $attachment);
    }
  }
  if ($row->mail) {
    if ($send != TRUE) {
      @session_start();
      $_SESSION['error_or_no'] = 1;
      $msg = addslashes(__('Error, email was not sent.', 'form_maker'));
    }
    else {
      @session_start();
      $_SESSION['error_or_no'] = 0;
      $msg = addslashes(__('Your form was successfully submitted.', 'form_maker'));
    }
  }
  else {
    @session_start();
    $_SESSION['error_or_no'] = 0;
    $msg = addslashes(__('Your form was successfully submitted.', 'form_maker'));
  }
  switch ($row->submit_text_type) {
    case "2":
    case "5":
      {
      @session_start();
      if ($row->submit_text_type != 4)
        $_SESSION['massage_after_submit'] = $msg;
      $_SESSION['form_submit_type'] = $row->submit_text_type . "," . $row->id;
      if ($row->article_id) {
        $redirect_url = $row->article_id;
      }
      else {
        $redirect_url = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      }
      break;
      }
    case "3":
      {
      @session_start();
      if ($row->submit_text_type != 4) {
        $_SESSION['massage_after_submit'] = $msg;
      }
      $_SESSION['form_submit_type'] = $row->submit_text_type . "," . $row->id;
      $redirect_url = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      break;
      }
    case "4":
      {
      @session_start();
      if ($row->submit_text_type != 4) {
        $_SESSION['massage_after_submit'] = $msg;
      }
      $_SESSION['form_submit_type'] = $row->submit_text_type . "," . $row->id;
      $redirect_url = $row->url;
      break;
      }
    default:
      {
      @session_start();
      if ($row->submit_text_type != 4) {
        $_SESSION['massage_after_submit'] = $msg;
      }
      $_SESSION['form_submit_type'] = $row->submit_text_type . "," . $row->id;
      $redirect_url = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      break;
      }
  }
  if (!$str) {
    wp_redirect($redirect_url);
    exit;
  }
  else {
    $str .= "&return=" . urlencode($redirect_url);
    wp_redirect($str);
    exit;
  }
}

function remove($group_id) {
  global $wpdb;
  $wpdb->query($wpdb->prepare('DELETE FROM ' . $wpdb->prefix . 'formmaker_submits WHERE group_id= %d', $group_id));
}

// Form maker frontend.
function form_maker_front_end($id) {
  $form_maker_front_end = "";
  $result = showform($id);
  if (!$result) {
    return;
  }
  $ok = savedata($result[0], $id);
  if (is_numeric($ok)) {
    remove($ok);
  }
  @session_start();
  global $wpdb;
  $row = $result[0];
  $label_id = $result[2];
  $label_type = $result[3];
  $form_theme = $result[4];
  if (isset($_SESSION['show_submit_text' . $id])) {
    if ($_SESSION['show_submit_text' . $id] == 1) {
      $_SESSION['show_submit_text' . $id] = 0;
      $form_maker_front_end .= $row->submit_text;
      return;
    }
  }
  $vives_form = $wpdb->get_var($wpdb->prepare("SELECT views FROM " . $wpdb->prefix . "formmaker_views WHERE form_id=%d", $id));
  $vives_form = $vives_form + 1;
  $wpdb->update($wpdb->prefix . "formmaker_views", array(
      'views' => $vives_form,
    ), array('form_id' => $id), array(
      '%d',
    ), array('%d'));
  $article = $row->article_id;
  if ($row->form_front) {
    /////////if form is new version
    $form_maker_front_end .= '<div><script type="text/javascript">' . $row->javascript . '</script>';
    $new_form_theme = explode('{', $form_theme);
    $count_after_explod_theme = count($new_form_theme);
    for ($i = 0; $i < $count_after_explod_theme; $i++) {
      $body_or_classes[$i] = explode('}', $new_form_theme[$i]);
    }
    for ($i = 0; $i < $count_after_explod_theme; $i++) {
      if ($i == 0)
        $body_or_classes[$i][0] = "#form" . $id . ' ' . str_replace(',', ", #form" . $id, $body_or_classes[$i][0]);
      else
        $body_or_classes[$i][1] = "#form" . $id . ' ' . str_replace(',', ", #form" . $id, $body_or_classes[$i][1]);
    }
    for ($i = 0; $i < $count_after_explod_theme; $i++) {
      $body_or_classes_implode[$i] = implode('}', $body_or_classes[$i]);
    }
    $form_theme = implode('{', $body_or_classes_implode);
    $form_maker_front_end .= '<style>' . str_replace('[SITE_ROOT]', plugins_url("", __FILE__), $form_theme) . '</style>';
    $form_maker_front_end .= '<form name="form' . $id . '" action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="form' . $id . '" enctype="multipart/form-data"  onsubmit="check_required(\'submit\', \'' . $id . '\'); return false;">
		<div id="' . $id . 'pages" class="wdform_page_navigation" show_title="' . $row->show_title . '" show_numbers="' . $row->show_numbers . '" type="' . $row->pagination . '"></div>
		<input type="hidden" id="counter' . $id . '" value="' . $row->counter . '" name="counter' . $id . '" />';
    //inch@ petq chi raplace minchev form@ tpi			
    $captcha_url = 'components/com_formmaker/wd_captcha.php?digit=';
    $captcha_rep_url = 'components/com_formmaker/wd_captcha.php?r2=' . mt_rand(0, 1000) . '&digit=';
    $rep1 = array(
      "<!--repstart-->Title<!--repend-->",
      "<!--repstart-->First<!--repend-->",
      "<!--repstart-->Last<!--repend-->",
      "<!--repstart-->Middle<!--repend-->",
      "<!--repstart-->January<!--repend-->",
      "<!--repstart-->February<!--repend-->",
      "<!--repstart-->March<!--repend-->",
      "<!--repstart-->April<!--repend-->",
      "<!--repstart-->May<!--repend-->",
      "<!--repstart-->June<!--repend-->",
      "<!--repstart-->July<!--repend-->",
      "<!--repstart-->August<!--repend-->",
      "<!--repstart-->September<!--repend-->",
      "<!--repstart-->October<!--repend-->",
      "<!--repstart-->November<!--repend-->",
      "<!--repstart-->December<!--repend-->",
      "<!--repstart-->Street Address<!--repend-->",
      "<!--repstart-->Street Address Line 2<!--repend-->",
      "<!--repstart-->City<!--repend-->",
      "<!--repstart-->State / Province / Region<!--repend-->",
      "<!--repstart-->Postal / Zip Code<!--repend-->",
      "<!--repstart-->Country<!--repend-->",
      "<!--repstart-->Area Code<!--repend-->",
      "<!--repstart-->Phone Number<!--repend-->",
      "<!--repstart-->From<!--repend-->",				
			"<!--repstart-->To<!--repend-->",
      "<!--repstart-->$300<!--repend-->",
			"<!--repstart-->product 1 $100<!--repend-->",
			"<!--repstart-->product 2 $200<!--repend-->",
      $captcha_url,
      'class="captcha_img"',
      plugins_url("images/refresh.png", __FILE__),
      'form_id_temp',
      'style="padding-right:170px"'
    );
    $rep2 = array(
      addslashes(__("Title", 'form_maker')),
      addslashes(__("First", 'form_maker')),
      addslashes(__("Last", 'form_maker')),
      addslashes(__("Middle", 'form_maker')),
      addslashes(__("January", 'form_maker')),
      addslashes(__("February", 'form_maker')),
      addslashes(__("March", 'form_maker')),
      addslashes(__("April", 'form_maker')),
      addslashes(__("May", 'form_maker')),
      addslashes(__("June", 'form_maker')),
      addslashes(__("July", 'form_maker')),
      addslashes(__("August", 'form_maker')),
      addslashes(__("September", 'form_maker')),
      addslashes(__("October", 'form_maker')),
      addslashes(__("November", 'form_maker')),
      addslashes(__("December", 'form_maker')),
      addslashes(__("Street Address", 'form_maker')),
      addslashes(__("Street Address Line 2", 'form_maker')),
      addslashes(__("City", 'form_maker')),
      addslashes(__("State / Province / Region", 'form_maker')),
      addslashes(__("Postal / Zip Code", 'form_maker')),
      addslashes(__("Country", 'form_maker')),
      addslashes(__("Area Code", 'form_maker')),
      addslashes(__("Phone Number", 'form_maker')),
      addslashes(__("From", 'form_maker')),
      addslashes(__("To", 'form_maker')),
      '',
			'',
			'',
      $captcha_rep_url,
      'class="captcha_img" style="display:none"',
      plugins_url("images/refresh.png", __FILE__),
      $id,
      ''
    );
    $untilupload = str_replace($rep1, $rep2, $row->form_front);
    while (strpos($untilupload, "***destinationskizb") > 0) {
      $pos1 = strpos($untilupload, "***destinationskizb");
      $pos2 = strpos($untilupload, "***destinationverj");
      $untilupload = str_replace(substr($untilupload, $pos1, $pos2 - $pos1 + 22), "", $untilupload);
    }
    $form_maker_front_end .= $untilupload;
    $is_recaptcha = FALSE;
    $form_maker_front_end .= '<script type="text/javascript">';
    $form_maker_front_end .= 'WDF_FILE_TYPE_ERROR = \'' . addslashes(__("Sorry, you are not allowed to upload this type of file.", 'form_maker')) . '\';';
    $form_maker_front_end .= 'WDF_GRADING_TEXT = \'' . addslashes(__("Your score should be less than", 'form_maker')) . '\';';
    $form_maker_front_end .= 'WDF_INVALID_GRADING 	= \'' . addslashes(sprintf(__("Your score should be less than", 'form_maker'), '`grading_label`', '`grading_total`')) . '\';';
    $form_maker_front_end .= 'WDF_INVALID_EMAIL = \'' . addslashes(__("This is not a valid email address.", 'form_maker')) . '\';';
    $form_maker_front_end .= 'REQUEST_URI	= "' . $_SERVER['REQUEST_URI'] . '";';
    $form_maker_front_end .= 'ReqFieldMsg	=\'`FIELDNAME` ' . addslashes(__('field is required.', 'form_maker')) . '\';';
    $form_maker_front_end .= 'FormCurrency = "";';
    $form_maker_front_end .= 'FormPaypalTax = "";';
    $form_maker_front_end .= 'function formOnload' . $id . '()
{
';
    //enable maps and refresh captcha
    foreach ($label_type as $key => $type) {
      switch ($type) {
        case 'type_map':
          $form_maker_front_end .= 'if(document.getElementById("' . $label_id[$key] . '_element' . $id . '"))
		{
			if_gmap_init(' . $label_id[$key] . ',' . $id . ');
			for(q=0; q<20; q++)
				if(document.getElementById(' . $label_id[$key] . '+"_element"+' . $id . ').getAttribute("long"+q))
				{
				
					w_long=parseFloat(document.getElementById(' . $label_id[$key] . '+"_element"+' . $id . ').getAttribute("long"+q));
					w_lat=parseFloat(document.getElementById(' . $label_id[$key] . '+"_element"+' . $id . ').getAttribute("lat"+q));
					w_info=parseFloat(document.getElementById(' . $label_id[$key] . '+"_element"+' . $id . ').getAttribute("info"+q));
					add_marker_on_map(' . $label_id[$key] . ',q, w_long, w_lat, w_info,' . $id . ',false);
				}
		}';
          break;
        case 'type_mark_map':
          $form_maker_front_end .= 'if(document.getElementById("' . $label_id[$key] . '_element' . $id . '"))
	if(!document.getElementById("' . $label_id[$key] . '_long' . $id . '"))	
	{      	
	
		var longit = document.createElement(\'input\');
         	longit.setAttribute("type", \'hidden\');
         	longit.setAttribute("id", \'' . $label_id[$key] . '_long' . $id . '\');
         	longit.setAttribute("name", \'' . $label_id[$key] . '_long' . $id . '\');

		var latit = document.createElement(\'input\');
         	latit.setAttribute("type", \'hidden\');
         	latit.setAttribute("id", \'' . $label_id[$key] . '_lat' . $id . '\');
         	latit.setAttribute("name", \'' . $label_id[$key] . '_lat' . $id . '\');

		document.getElementById("' . $label_id[$key] . '_element_section' . $id . '").appendChild(longit);
		document.getElementById("' . $label_id[$key] . '_element_section' . $id . '").appendChild(latit);
	
		if_gmap_init(' . $label_id[$key] . ', ' . $id . ');
		
		w_long=parseFloat(document.getElementById(' . $label_id[$key] . '+"_element"+' . $id . ').getAttribute("long0"));
		w_lat=parseFloat(document.getElementById(' . $label_id[$key] . '+"_element"+' . $id . ').getAttribute("lat0"));
		w_info=parseFloat(document.getElementById(' . $label_id[$key] . '+"_element"+' . $id . ').getAttribute("info0"));
		
		
		longit.value=w_long;
		latit.value=w_lat;
		add_marker_on_map(' . $label_id[$key] . ',0, w_long, w_lat, w_info, ' . $id . ', true);		
	}';
          break;
        case 'type_captcha':
          $form_maker_front_end .= 'if(document.getElementById(\'_wd_captcha' . $id . '\'))
		captcha_refresh(\'_wd_captcha\', \'' . $id . '\');';
          break;
        case 'type_recaptcha':
          $is_recaptcha = TRUE;
          break;
        case 'type_radio':
        case 'type_checkbox':
          $form_maker_front_end .= 'if(document.getElementById(\'' . $label_id[$key] . '_randomize' . $id . '\'))
		if (document.getElementById(\'' . $label_id[$key] . '_randomize' . $id . '\').value == "yes") {
			choises_randomize(\'' . $label_id[$key] . '\', \'' . $id . '\');}';
          break;
        case 'type_spinner':
          $form_maker_front_end .= '
    if (document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\')) {
      var spinner_value = document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\').getAttribute(\'aria-valuenow\');
    }
    if (document.getElementById(\'' . $label_id[$key] . '_min_value' . $id . '\'))
      var spinner_min_value = document.getElementById(\'' . $label_id[$key] . '_min_value' . $id . '\').value;
    if (document.getElementById(\'' . $label_id[$key] . '_max_value' . $id . '\'))
      var spinner_max_value = document.getElementById(\'' . $label_id[$key] . '_max_value' . $id . '\').value;
    if (document.getElementById(\'' . $label_id[$key] . '_step' . $id . '\'))
      var spinner_step = document.getElementById(\'' . $label_id[$key] . '_step' . $id . '\').value;
    jQuery( \'' . $label_id[$key] . '_element' . $id . '\' ).removeClass( \'ui-spinner-input\')
    .prop( \'disabled\', false )
    .removeAttr( \'autocomplete\' )
    .removeAttr( \'role\' )
    .removeAttr( \'aria-valuemin\' )
    .removeAttr( \'aria-valuemax\' )
    .removeAttr( \'aria-valuenow\' );
    if (document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\')) {
      span_ui= document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\').parentNode;
      span_ui.parentNode.appendChild(document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\'));
      span_ui.parentNode.removeChild(span_ui);
      jQuery(\'#' . $label_id[$key] . '_element' . $id . '\')[0].spin = null;
    }
    spinner = jQuery( \'#' . $label_id[$key] . '_element' . $id . '\' ).spinner();
    spinner.spinner( \'value\', spinner_value );
		jQuery( \'#' . $label_id[$key] . '_element' . $id . '\' ).spinner({ min: spinner_min_value});
		jQuery( \'#' . $label_id[$key] . '_element' . $id . '\' ).spinner({ max: spinner_max_value});
		jQuery( \'#' . $label_id[$key] . '_element' . $id . '\' ).spinner({ step: spinner_step});';
          break;
        case 'type_slider':
          $form_maker_front_end .= '
    if (document.getElementById(\'' . $label_id[$key] . '_slider_value' . $id . '\'))
      var slider_value = document.getElementById(\'' . $label_id[$key] . '_slider_value' . $id . '\').value;
    if (document.getElementById(\'' . $label_id[$key] . '_slider_min_value' . $id . '\'))
      var slider_min_value = document.getElementById(\'' . $label_id[$key] . '_slider_min_value' . $id . '\').value;
    if (document.getElementById(\'' . $label_id[$key] . '_slider_max_value' . $id . '\'))
      var slider_max_value = document.getElementById(\'' . $label_id[$key] . '_slider_max_value' . $id . '\').value;
    if (document.getElementById(\'' . $label_id[$key] . '_element_value' . $id . '\'))
      var slider_element_value = document.getElementById(\'' . $label_id[$key] . '_element_value' . $id . '\' );
    if (document.getElementById(\'' . $label_id[$key] . '_slider_value' . $id . '\'))
      var slider_value_save = document.getElementById( \'' . $label_id[$key] . '_slider_value' . $id . '\' );
    if (document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\')) {
      document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\').innerHTML = \'\';
      document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\').removeAttribute( \'class\' );
      document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\').removeAttribute( \'aria-disabled\' );
    }
    if (document.getElementById(\'' . $label_id[$key] . '_element' . $id . '\'))
      jQuery(\'#' . $label_id[$key] . '_element' . $id . '\')[0].slide = null;
    jQuery( \'#' . $label_id[$key] . '_element' . $id . '\').slider({
      range: \'min\',
      value: eval(slider_value),
      min: eval(slider_min_value),
      max: eval(slider_max_value),	
      slide: function( event, ui ) {
        slider_element_value.innerHTML = \'\' + ui.value;
        slider_value_save.value = \'\' + ui.value;
      }
    });';
          break;			
        case 'type_range':
          $form_maker_front_end .= '
    if (document.getElementById(\'' . $label_id[$key] . '_element' . $id . '0\'))
      var spinner_value0 = document.getElementById(\'' . $label_id[$key] . '_element' . $id . '0\').getAttribute( \'aria-valuenow\' );
    if (document.getElementById(\'' . $label_id[$key] . '_element' . $id . '1\'))
      var spinner_value1 = document.getElementById(\'' . $label_id[$key] . '_element' . $id . '1\').getAttribute( \'aria-valuenow\' );
    if (document.getElementById(\'' . $label_id[$key] . '_range_step' . $id . '\'))
      var spinner_step = document.getElementById(\'' . $label_id[$key] . '_range_step' . $id . '\').value;
    jQuery( \'#' . $label_id[$key] . '_element' . $id . '0\' ).removeClass( \'ui-spinner-input\' )
    .prop( \'disabled\', false )	
    .removeAttr( \'autocomplete\' )		
    .removeAttr( \'role\' )			
    .removeAttr( \'aria-valuenow\' );		
    if (document.getElementById(\'' . $label_id[$key] . '_element' . $id . '0\')) {
      span_ui= document.getElementById(\'' . $label_id[$key] . '_element' . $id . '0\').parentNode;
      span_ui.parentNode.appendChild(document.getElementById(\'' . $label_id[$key] . '_element' . $id . '0\'));
      span_ui.parentNode.removeChild(span_ui);
      jQuery(\'#' . $label_id[$key] . '_element' . $id . '0\')[0].spin = null;
    }
		spinner0 = jQuery( \'#' . $label_id[$key] . '_element' . $id . '0\' ).spinner();
		spinner0.spinner( \'value\', spinner_value0 );
    jQuery( \'#' . $label_id[$key] . '_element' . $id . '0\' ).spinner({ step: spinner_step});
    jQuery( \'#' . $label_id[$key] . '_element' . $id . '1\' ).removeClass( \'ui-spinner-input\' )
    .prop( \'disabled\', false )
    .removeAttr( \'autocomplete\' )
    .removeAttr( \'role\' )
    .removeAttr( \'aria-valuenow\' );
    if (document.getElementById(\'' . $label_id[$key] . '_element' . $id . '1\')) {
      span_ui1= document.getElementById(\'' . $label_id[$key] . '_element' . $id . '1\').parentNode;
      span_ui1.parentNode.appendChild(document.getElementById(\'' . $label_id[$key] . '_element' . $id . '1\'));
      span_ui1.parentNode.removeChild(span_ui1);
      jQuery(\'#' . $label_id[$key] . '_element' . $id . '1\')[0].spin = null;
    }
		spinner1 = jQuery( \'#' . $label_id[$key] . '_element' . $id . '1\' ).spinner();
		spinner1.spinner( \'value\', spinner_value1 );
		jQuery( \'#' . $label_id[$key] . '_element' . $id . '1\').spinner({ step: spinner_step});';
          break;
        case 'type_paypal_total':
          $form_maker_front_end .= '
    set_total_value(' . $label_id[$key] . ', ' . $id . ');';
          break;
        default:
          break;
      }
    }
    $form_maker_front_end .= '
     if (window.before_load) {
      before_load();
     }
  }';
    $form_maker_front_end .= '
      function formAddToOnload' . $id . '() {
        if (formOldFunctionOnLoad' . $id . ') {
          formOldFunctionOnLoad' . $id . '();
        }
        formOnload' . $id . '();
      }
      function formLoadBody' . $id . '() {
        formOldFunctionOnLoad' . $id . ' = window.onload;
        window.onload = formAddToOnload' . $id . ';
      }
      var formOldFunctionOnLoad' . $id . ' = null;
      formLoadBody' . $id . '();';
    if (isset($_POST["counter" . $id])) {
      $counter = esc_html($_POST["counter" . $id]);
    }
    $old_key = -1;
    if (isset($counter)) {
      foreach ($label_type as $key => $type) {
        switch ($type) {
          case "type_text":
          case "type_number":
          case "type_submitter_mail":
            {
            $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_element" . $id . "'))
		if(document.getElementById('" . $label_id[$key] . "_element" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element" . $id . "').className='input_active';
		}
	";
            break;
            }
          case "type_textarea":
            {
            $order = array(
              "\r\n",
              "\n",
              "\r"
            );
            $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_element" . $id . "'))
		if(document.getElementById('" . $label_id[$key] . "_element" . $id . "').title!='" . str_replace($order, '\n', addslashes($_POST[$label_id[$key] . "_element" . $id])) . "')
		{	document.getElementById('" . $label_id[$key] . "_element" . $id . "').innerHTML='" . str_replace($order, '\n', addslashes($_POST[$label_id[$key] . "_element" . $id])) . "';
			document.getElementById('" . $label_id[$key] . "_element" . $id . "').className='input_active';
		}
	";
            break;
            }
          case "type_name":
            {
            $element_title = $_POST[$label_id[$key] . "_element_title" . $id];
            if (isset($_POST[$label_id[$key] . "_element_title" . $id])) {
              $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_element_first" . $id . "'))
	{
		if(document.getElementById('" . $label_id[$key] . "_element_title" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element_title" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element_title" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element_title" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element_title" . $id . "').className='input_active';
		}
		
		if(document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element_first" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element_first" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').className='input_active';
		}
		
		if(document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element_last" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element_last" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').className='input_active';
		}
		
		if(document.getElementById('" . $label_id[$key] . "_element_middle" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element_middle" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element_middle" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element_middle" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element_middle" . $id . "').className='input_active';
		}
		
	}";
            }
            else {
              $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_element_first" . $id . "'))
	{
		
		if(document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element_first" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element_first" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').className='input_active';
		}
		
		if(document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element_last" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element_last" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').className='input_active';
		}
		
	}";
            }
            break;
            }
          case "type_phone":
            {
            $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_element_first" . $id . "'))
	{
		if(document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element_first" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element_first" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element_first" . $id . "').className='input_active';
		}
		
		if(document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').title!='" . addslashes($_POST[$label_id[$key] . "_element_last" . $id]) . "')
		{	document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element_last" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_element_last" . $id . "').className='input_active';
		}
	}";
            break;
            }
          case "type_star_rating": {
						$form_maker_front_end .=
					"if(document.getElementById('".$label_id[$key]."_element".$id."')) {
						document.getElementById('".$label_id[$key]."_selected_star_amount".$id."').value='".addslashes($_POST[$label_id[$key]."_selected_star_amount".$id])."';	
            if (document.getElementById('".$label_id[$key]."_selected_star_amount".$id."').value)	
              select_star_rating((document.getElementById('".$label_id[$key]."_selected_star_amount".$id."').value-1),".$label_id[$key].",".$id.");	
					}";
            break;
          
					}

				case "type_scale_rating": {
          $form_maker_front_end .=
					"for (k=0; k<100; k++) {
						if (document.getElementById('".$label_id[$key]."_scale_radio".$id."_'+k)) {
							document.getElementById('".$label_id[$key]."_scale_radio".$id."_'+k).removeAttribute('checked');
							if (document.getElementById('".$label_id[$key]."_scale_radio".$id."_'+k).value=='".$_POST[$label_id[$key]."_scale_radio".$id]."')
								document.getElementById('".$label_id[$key]."_scale_radio".$id."_'+k).setAttribute('checked', 'checked');
						}
					}";
					break;

				}
				case "type_spinner": {
          $form_maker_front_end .=
					"if (document.getElementById('".$label_id[$key]."_element".$id."')) {
            document.getElementById('".$label_id[$key]."_element".$id."').setAttribute('aria-valuenow','".$_POST[$label_id[$key]."_element".$id]."');
          }";
					break;

				}
				case "type_slider": {
          $form_maker_front_end .=
					"if (document.getElementById('".$label_id[$key]."_element".$id."'))
            document.getElementById('".$label_id[$key]."_element".$id."').setAttribute('aria-valuenow','".$_POST[$label_id[$key]."_slider_value".$id]."');
					if (document.getElementById('".$label_id[$key]."_slider_value".$id."'))
            document.getElementById('".$label_id[$key]."_slider_value".$id."').value='".$_POST[$label_id[$key]."_slider_value".$id]."';
					if (document.getElementById('".$label_id[$key]."_element_value".$id."'))
            document.getElementById('".$label_id[$key]."_element_value".$id."').innerHTML='".$_POST[$label_id[$key]."_slider_value".$id]."';";
					break;

				}
				case "type_range": {
          $form_maker_front_end .=
						"if (document.getElementById('".$label_id[$key]."_element".$id."0'))
              document.getElementById('".$label_id[$key]."_element".$id."0').setAttribute('aria-valuenow','".$_POST[$label_id[$key]."_element".$id."0"]."');
						if (document.getElementById('".$label_id[$key]."_element".$id."1'))
              document.getElementById('".$label_id[$key]."_element".$id."1').setAttribute('aria-valuenow','".$_POST[$label_id[$key]."_element".$id."1"]."');";
					break;

				}
				case "type_grading": {
					for ($k = 0; $k < 100; $k++) {
						$form_maker_front_end .= "if (document.getElementById('".$label_id[$key]."_element".$id.$k."')) {		
              document.getElementById('".$label_id[$key]."_element".$id.$k."').value='".$_POST[$label_id[$key]."_element".$id.$k]."';}";
					}
					$form_maker_front_end .= "sum_grading_values(".$label_id[$key].",".$id.");";
					break;

				}
				case "type_matrix": {
					$form_maker_front_end .= 
					"if (document.getElementById('".$label_id[$key]."_input_type".$id."').value == 'radio') {";	
						for ($k = 1; $k < 40; $k++) {
							for ($l = 1; $l < 40; $l++) {
								$form_maker_front_end .= 
									"if (document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."')) {
										document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."').removeAttribute('checked');
                    if (document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."').value=='".$_POST[$label_id[$key]."_input_element".$id.$k]."')
                      document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."').setAttribute('checked', 'checked');
									}";
							}
						}
						$form_maker_front_end .= 
					"}	
					else	
            if (document.getElementById('".$label_id[$key]."_input_type".$id."').value == 'checkbox') {";
						for ($k = 1; $k < 40; $k++) {
							for ($l = 1; $l < 40; $l++) {
								$form_maker_front_end .= 
								"if (document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."')) {
									document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."').removeAttribute('checked');
									if (document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."').value=='".$_POST[$label_id[$key]."_input_element".$id.$k."_".$l]."')		
                    document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."').setAttribute('checked', 'checked');
								}";	
							}
						}
						$form_maker_front_end .= 
					"}	
					else	
            if (document.getElementById('".$label_id[$key]."_input_type".$id."').value == 'text') {";
						for ($k = 1; $k < 40; $k++) {
							for ($l = 1; $l < 40; $l++) {
								$form_maker_front_end .= 
								"if (document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."'))
                  document.getElementById('".$label_id[$key]."_input_element".$id.$k."_".$l."').value='".$_POST[$label_id[$key]."_input_element".$id.$k."_".$l]."';";
							}
						}
						$form_maker_front_end .= "
					}
					else
						if (document.getElementById('".$label_id[$key]."_input_type".$id."').value == 'select') {";
							for ($k = 1; $k < 40; $k++) {
								for ($l = 1; $l < 40; $l++) {
									$form_maker_front_end .= 
									"if (document.getElementById('".$label_id[$key]."_select_yes_no".$id.$k."_".$l."'))
                    document.getElementById('".$label_id[$key]."_select_yes_no".$id.$k."_".$l."').value='".$_POST[$label_id[$key]."_select_yes_no".$id.$k."_".$l]."';";
								}
							}
						$form_maker_front_end .= 
						"}";	
            break;

          }
          case "type_address":
            {
            if ($key > $old_key) {
              $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_street1" . $id . "'))
	{
			document.getElementById('" . $label_id[$key] . "_street1" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_street1" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_street2" . $id . "').value='" . addslashes($_POST[$label_id[$key + 1] . "_street2" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_city" . $id . "').value='" . addslashes($_POST[$label_id[$key + 2] . "_city" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_state" . $id . "').value='" . addslashes($_POST[$label_id[$key + 3] . "_state" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_postal" . $id . "').value='" . addslashes($_POST[$label_id[$key + 4] . "_postal" . $id]) . "';
			document.getElementById('" . $label_id[$key] . "_country" . $id . "').value='" . addslashes($_POST[$label_id[$key + 5] . "_country" . $id]) . "';
		
	}";
              $old_key = $key + 5;
            }
            break;
            }
          case "type_checkbox":
            {
            $is_other = FALSE;
            if ($_POST[$label_id[$key] . "_allow_other" . $id] == "yes") {
              $other_element = $_POST[$label_id[$key] . "_other_input" . $id];
              $other_element_id = $_POST[$label_id[$key] . "_allow_other_num" . $id];
              if (isset($_POST[$label_id[$key] . "_allow_other_num" . $id]))
                $is_other = TRUE;
            }
            $form_maker_front_end .= "
	if(document.getElementById('" . $label_id[$key] . "_other_input" . $id . "'))
	{
	document.getElementById('" . $label_id[$key] . "_other_input" . $id . "').parentNode.removeChild(document.getElementById('" . $label_id[$key] . "_other_br" . $id . "'));
	document.getElementById('" . $label_id[$key] . "_other_input" . $id . "').parentNode.removeChild(document.getElementById('" . $label_id[$key] . "_other_input" . $id . "'));
	}
	for(k=0; k<30; k++)
		if(document.getElementById('" . $label_id[$key] . "_element" . $id . "'+k))
			document.getElementById('" . $label_id[$key] . "_element" . $id . "'+k).removeAttribute('checked');
		else break;
	";
            for ($j = 0; $j < 100; $j++) {
              $element = $_POST[$label_id[$key] . "_element" . $id . $j];
              if (isset($_POST[$label_id[$key] . "_element" . $id . $j])) {
                $form_maker_front_end .= "document.getElementById('" . $label_id[$key] . "_element" . $id . $j . "').setAttribute('checked', 'checked');
	";
              }
            }
            if ($is_other)
              $form_maker_front_end .= "
		show_other_input('" . $label_id[$key] . "','" . $id . "');
		document.getElementById('" . $label_id[$key] . "_other_input" . $id . "').value='" . $_POST[$label_id[$key] . "_other_input" . $id] . "';
	";
            break;
            }
          case "type_radio":
            {
            $is_other = FALSE;
            if ($_POST[$label_id[$key] . "_allow_other" . $id] == "yes") {
              $other_element = $_POST[$label_id[$key] . "_other_input" . $id];
              if (isset($_POST[$label_id[$key] . "_other_input" . $id]))
                $is_other = TRUE;
            }
            $form_maker_front_end .= "
	if(document.getElementById('" . $label_id[$key] . "_other_input" . $id . "'))
	{
	document.getElementById('" . $label_id[$key] . "_other_input" . $id . "').parentNode.removeChild(document.getElementById('" . $label_id[$key] . "_other_br" . $id . "'));
	document.getElementById('" . $label_id[$key] . "_other_input" . $id . "').parentNode.removeChild(document.getElementById('" . $label_id[$key] . "_other_input" . $id . "'));
	}
	
	for(k=0; k<50; k++)
		if(document.getElementById('" . $label_id[$key] . "_element" . $id . "'+k))
		{
			document.getElementById('" . $label_id[$key] . "_element" . $id . "'+k).removeAttribute('checked');
			if(document.getElementById('" . $label_id[$key] . "_element" . $id . "'+k).value=='" . addslashes($_POST[$label_id[$key] . "_element" . $id]) . "')
			{
				document.getElementById('" . $label_id[$key] . "_element" . $id . "'+k).setAttribute('checked', 'checked');
								
			}
		}
		else break;
	";
            if ($is_other)
              $form_maker_front_end .= "
		show_other_input('" . $label_id[$key] . "','" . $id . "');
		document.getElementById('" . $label_id[$key] . "_other_input" . $id . "').value='" . $_POST[$label_id[$key] . "_other_input" . $id] . "';
	";
            break;
            }
          case "type_time":
            {
            $ss = $_POST[$label_id[$key] . "_ss" . $id];
            if (isset($_POST[$label_id[$key] . "_ss" . $id])) {
              $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_hh" . $id . "'))
	{
		document.getElementById('" . $label_id[$key] . "_hh" . $id . "').value='" . $_POST[$label_id[$key] . "_hh" . $id] . "';
		document.getElementById('" . $label_id[$key] . "_mm" . $id . "').value='" . $_POST[$label_id[$key] . "_mm" . $id] . "';
		document.getElementById('" . $label_id[$key] . "_ss" . $id . "').value='" . $_POST[$label_id[$key] . "_ss" . $id] . "';
	}";
            }
            else {
              $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_hh" . $id . "'))
	{
		document.getElementById('" . $label_id[$key] . "_hh" . $id . "').value='" . $_POST[$label_id[$key] . "_hh" . $id] . "';
		document.getElementById('" . $label_id[$key] . "_mm" . $id . "').value='" . $_POST[$label_id[$key] . "_mm" . $id] . "';
	}";
            }
            $am_pm = $_POST[$label_id[$key] . "_am_pm" . $id];
            if (isset($am_pm))
              $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_am_pm" . $id . "'))
		document.getElementById('" . $label_id[$key] . "_am_pm" . $id . "').value='" . $_POST[$label_id[$key] . "_am_pm" . $id] . "';
	";
            break;
            }
          case "type_date_fields":
            {
            // $date_fields = explode('-', $_POST[$label_id[$key] . "_element" . $id]);
            $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_day" . $id . "'))
	{
		document.getElementById('" . $label_id[$key] . "_day" . $id . "').value='" . $_POST[$label_id[$key] . "_day" . $id] . "';
		document.getElementById('" . $label_id[$key] . "_month" . $id . "').value='" . $_POST[$label_id[$key] . "_month" . $id] . "';
		document.getElementById('" . $label_id[$key] . "_year" . $id . "').value='" . $_POST[$label_id[$key] . "_year" . $id] . "';
	}";
            break;
            }
          case "type_date":
          case "type_own_select":
          case "type_country":
            {
            $form_maker_front_end .= "if(document.getElementById('" . $label_id[$key] . "_element" . $id . "'))
		document.getElementById('" . $label_id[$key] . "_element" . $id . "').value='" . addslashes($_POST[$label_id[$key] . "_element" . $id]) . "';
	";
            break;
            }
          default:
            {
            break;
            }
        }
      }
    }
    $form_maker_front_end .= '	form_view_count' . $id . '=0;
	for(i=1; i<=30; i++)
	{
		if(document.getElementById(\'' . $id . 'form_view\'+i))
		{
			form_view_count' . $id . '++;
			form_view_max' . $id . '=i;
			document.getElementById(\'' . $id . 'form_view\'+i).parentNode.removeAttribute(\'style\');
		}
	}	
	if(form_view_count' . $id . '>1)
	{
		for(i=1; i<=form_view_max' . $id . '; i++)
		{
			if(document.getElementById(\'' . $id . 'form_view\'+i))
			{
				first_form_view' . $id . '=i;
				break;
			}
		}		
		generate_page_nav(first_form_view' . $id . ', \'' . $id . '\', form_view_count' . $id . ', form_view_max' . $id . ');
	}
	var RecaptchaOptions = {
theme: "' . $row->recaptcha_theme . '"
};
</script>
</form></div>';
    if ($is_recaptcha) {
      $form_maker_front_end .= '<div id="main_recaptcha" style="display:none;">';
      // Get a key from https://www.google.com/recaptcha/admin/create
      if ($row->public_key)
        $publickey = $row->public_key;
      else
        $publickey = '0';
      $error = NULL;
      $form_maker_front_end .= recaptcha_get_html($publickey, $error);
      $form_maker_front_end .= '</div>
    <script>
	recaptcha_html = document.getElementById(\'main_recaptcha\').innerHTML.replace(\'Recaptcha.widget = Recaptcha.$("recaptcha_widget_div"); Recaptcha.challenge_callback();\',"");
	document.getElementById(\'main_recaptcha\').innerHTML="";
	if (document.getElementById(\'wd_recaptcha' . $id . '\')) {
    document.getElementById(\'wd_recaptcha' . $id . '\').innerHTML=recaptcha_html;
    Recaptcha.widget = Recaptcha.$("recaptcha_widget_div");
    Recaptcha.challenge_callback();
  }
    </script>';
    }
  }
  else {
    $form_maker_front_end .= '<div><script type="text/javascript">' . str_replace("
", " ", $row->javascript) . '</script>';
    $form_maker_front_end .= '<style>' . str_replace('[SITE_ROOT]', plugins_url("", __FILE__), str_replace('.wdform_table1', '.form_view', str_replace("
", " ", $form_theme))) . '</style>';
    $form_maker_front_end .= "<form name=\"form\" action=\"" . $_SERVER['REQUEST_URI'] . "\" method=\"post\" id=\"form\" enctype=\"multipart/form-data\">
									<input type=\"hidden\" id=\"counter\" value=\"" . $row->counter . "\" name=\"counter\" />";
    $captcha_url = plugins_url("wd_captcha.php", __FILE__) . '?digit=';
    $captcha_rep_url = plugins_url("wd_captcha.php", __FILE__) . '?r2=' . mt_rand(0, 1000) . '&digit=';
    $rep1 = array(
      "<!--repstart-->Title<!--repend-->",
      "<!--repstart-->First<!--repend-->",
      "<!--repstart-->Last<!--repend-->",
      "<!--repstart-->Middle<!--repend-->",
      "<!--repstart-->January<!--repend-->",
      "<!--repstart-->February<!--repend-->",
      "<!--repstart-->March<!--repend-->",
      "<!--repstart-->April<!--repend-->",
      "<!--repstart-->May<!--repend-->",
      "<!--repstart-->June<!--repend-->",
      "<!--repstart-->July<!--repend-->",
      "<!--repstart-->August<!--repend-->",
      "<!--repstart-->September<!--repend-->",
      "<!--repstart-->October<!--repend-->",
      "<!--repstart-->November<!--repend-->",
      "<!--repstart-->December<!--repend-->",
      $captcha_url,
      'class="captcha_img"',
      plugins_url('images/refresh.png', __FILE__),
      plugins_url('images/delete_el.png', __FILE__),
      plugins_url('images/up.png', __FILE__),
      plugins_url('images/down.png', __FILE__),
      plugins_url('images/left.png', __FILE__),
      plugins_url('images/right.png', __FILE__),
      plugins_url('images/edit.png', __FILE__)
    );
    $rep2 = array(
      addslashes(__("Title", "form_maker")),
      addslashes(__("First", "form_maker")),
      addslashes(__("Last", "form_maker")),
      addslashes(__("Middle", "form_maker")),
      addslashes(__("January", "form_maker")),
      addslashes(__("February", "form_maker")),
      addslashes(__("March", "form_maker")),
      addslashes(__("April", "form_maker")),
      addslashes(__("May", "form_maker")),
      addslashes(__("June", "form_maker")),
      addslashes(__("July", "form_maker")),
      addslashes(__("August", "form_maker")),
      addslashes(__("September", "form_maker")),
      addslashes(__("October", "form_maker")),
      addslashes(__("November", "form_maker")),
      addslashes(__("December", "form_maker")),
      $captcha_rep_url,
      'class="captcha_img" style="display:none"',
      plugins_url('images/refresh.png', __FILE__),
      '',
      '',
      '',
      '',
      '',
      ''
    );
    $untilupload = str_replace($rep1, $rep2, $row->form);
    while (strpos($untilupload, "***destinationskizb") > 0) {
      $pos1 = strpos($untilupload, "***destinationskizb");
      $pos2 = strpos($untilupload, "***destinationverj");
      $untilupload = str_replace(substr($untilupload, $pos1, $pos2 - $pos1 + 22), "", $untilupload);
    }
    $form_maker_front_end .= $untilupload;
    $form_maker_front_end .= "<script type=\"text/javascript\">
							function formOnload()
							{
								if(document.getElementById(\"wd_captcha_input\"))
									captcha_refresh('wd_captcha');
					for(t=0; t<" . $row->counter . "; t++)
						if(document.getElementById(t+\"_type\"))
							if(document.getElementById(t+\"_type\").value==\"type_map\")
								if_gmap_init(t+\"_element\", false);
							}							
							function formAddToOnload()
							{ 
								if(formOldFunctionOnLoad){ 
                formOldFunctionOnLoad();
                }
								formOnload();
							}							
							function formLoadBody()
							{
								formOldFunctionOnLoad = window.onload;
								window.onload = formAddToOnload;
							}							
							var formOldFunctionOnLoad = null;
							formLoadBody();
							";
    if (isset($_POST["counter"])) {
      $counter = esc_html($_POST["counter"]);
    }
    if (isset($counter))
      if (isset($_POST["captcha_input"]) or is_numeric($ok)) {
        $captcha_input = esc_html($_POST["captcha_input"]);
        $session_wd_captcha_code = isset($_SESSION['wd_captcha_code']) ? $_SESSION['wd_captcha_code'] : '-';
        if ($captcha_input != $session_wd_captcha_code or is_numeric($ok)) {
          for ($i = 0; $i < $counter; $i++) {
            if (isset($_POST[$i . "_type"])) {
              $type = $_POST[$i . "_type"];
            }
            if (isset($_POST[$i . "_type"])) {
              switch ($type) {
                case "type_text":
                case "type_submitter_mail":
                  {
                  $form_maker_front_end .= "if(document.getElementById('" . $i . "_element" . "').title!='" . addslashes($_POST[$i . "_element"]) . "')
				{	document.getElementById('" . $i . "_element" . "').value='" . addslashes($_POST[$i . "_element"]) . "';
					document.getElementById('" . $i . "_element" . "').style.color='#000000';
					document.getElementById('" . $i . "_element" . "').style.fontStyle='normal !important';
				}
				";
                  break;
                  }
                case "type_textarea":
                  {
                  $form_maker_front_end .= "if(document.getElementById('" . $i . "_element" . "').title!='" . addslashes($_POST[$i . "_element"]) . "')
				{	document.getElementById('" . $i . "_element" . "').innerHTML='" . addslashes($_POST[$i . "_element"]) . "';
					document.getElementById('" . $i . "_element" . "').style.color='#000000';
					document.getElementById('" . $i . "_element" . "').style.fontStyle='normal';
				}
				";
                  break;
                  }
                case "type_password":
                  {
                  $form_maker_front_end .= "document.getElementById('" . $i . "_element" . "').value='';
				";
                  break;
                  }
                case "type_name":
                  {
                  if (isset($_POST[$i . "_element_title"])) {
                    $form_maker_front_end .= "document.getElementById('" . $i . "_element_title" . "').value='" . addslashes($_POST[$i . "_element_title"]) . "';
				document.getElementById('" . $i . "_element_first" . "').value='" . addslashes($_POST[$i . "_element_first"]) . "';
				document.getElementById('" . $i . "_element_last" . "').value='" . addslashes($_POST[$i . "_element_last"]) . "';
				document.getElementById('" . $i . "_element_middle" . "').value='" . addslashes($_POST[$i . "_element_middle"]) . "';
				";
                  }
                  else {
                    $form_maker_front_end .= "document.getElementById('" . $i . "_element_first" . "').value='" . addslashes($_POST[$i . "_element_first"]) . "';
				document.getElementById('" . $i . "_element_last" . "').value='" . addslashes($_POST[$i . "_element_last"]) . "';
				";
                  }
                  break;
                  }
                case "type_checkbox":
                  {
                  $form_maker_front_end .= "for(k=0; k<20; k++)
					if(document.getElementById('" . $i . "_element'+k))
						document.getElementById('" . $i . "_element'+k).removeAttribute('checked');
					else break;	";
                  for ($j = 0; $j < 100; $j++) {
                    if (isset($_POST[$i . "_element" . $j])) {
                      $form_maker_front_end .= "document.getElementById('" . $i . "_element" . $j . "').setAttribute('checked', 'checked');
				";
                    }
                  }
                  break;
                  }
                case "type_radio":
                  {
                  $form_maker_front_end .= "for(k=0; k<100; k++)
					if(document.getElementById('" . $i . "_element'+k))
					{
						document.getElementById('" . $i . "_element'+k).removeAttribute('checked');
						if(document.getElementById('" . $i . "_element'+k).value=='" . addslashes($_POST[$i . "_element"]) . "')
							document.getElementById('" . $i . "_element'+k).setAttribute('checked', 'checked');
					}
					else break;
				";
                  break;
                  }
                case "type_time":
                  {
                  if (isset($_POST[$i . "_ss"])) {
                    $form_maker_front_end .= "document.getElementById('" . $i . "_hh" . "').value='" . $_POST[$i . "_hh"] . "';
				document.getElementById('" . $i . "_mm" . "').value='" . $_POST[$i . "_mm"] . "';
				document.getElementById('" . $i . "_ss" . "').value='" . $_POST[$i . "_ss"] . "';
				";
                  }
                  else {
                    $form_maker_front_end .= "document.getElementById('" . $i . "_hh" . "').value='" . $_POST[$i . "_hh"] . "';
				document.getElementById('" . $i . "_mm" . "').value='" . $_POST[$i . "_mm"] . "';
				";
                  }
                  if (isset($_POST[$i . "_am_pm"]))
                    $form_maker_front_end .= "document.getElementById('" . $i . "_am_pm').value='" . $_POST[$i . "_am_pm"] . "';
				";
                  break;
                  }
                case "type_date":
                  {
                  $form_maker_front_end .= "document.getElementById('" . $i . "_element" . "').value='" . $_POST[$i . "_element"] . "';
				";
                  break;
                  }
                case "type_date_fields":
                  {
                  $date_fields = explode('-', $_POST[$i . "_element"]);
                  $form_maker_front_end .= "document.getElementById('" . $i . "_day" . "').value='" . $date_fields[0] . "';
				document.getElementById('" . $i . "_month" . "').value='" . $date_fields[1] . "';
				document.getElementById('" . $i . "_year" . "').value='" . $date_fields[2] . "';
				";
                  break;
                  }
                case "type_country":
                  {
                  $form_maker_front_end .= "document.getElementById('" . $i . "_element').value='" . addslashes($_POST[$i . "_element"]) . "';
				";
                  break;
                  }
                case "type_own_select":
                  {
                  $form_maker_front_end .= "document.getElementById('" . $i . "_element').value='" . addslashes($_POST[$i . "_element"]) . "';
				";
                  break;
                  }
                case "type_file":
                  {
                  break;
                  }
              }
            }
          }
        }
      }
    $form_maker_front_end .= "n=" . $row->counter . ";
	for(i=0; i<n; i++)
	{
		if(document.getElementById(i))
		{	
			for(z=0; z<document.getElementById(i).childNodes.length; z++)
				if(document.getElementById(i).childNodes[z].nodeType==3)
					document.getElementById(i).removeChild(document.getElementById(i).childNodes[z]);		
			if(document.getElementById(i).childNodes[7])
			{			
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[2]);
			}
			else
			{
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
				document.getElementById(i).removeChild(document.getElementById(i).childNodes[1]);
			}
		}
	}	
	for(i=0; i<=n; i++)
	{	
		if(document.getElementById(i))
		{
			type=document.getElementById(i).getAttribute(\"type\");
				switch(type)
				{	case \"type_text\":
					case \"type_password\":
					case \"type_submitter_mail\":
					case \"type_own_select\":
					case \"type_country\":
					case \"type_hidden\":
					case \"type_map\":
					{
						remove_add_(i+\"_element\");
						break;
					}					
					case \"type_submit_reset\":
					{
						remove_add_(i+\"_element_submit\");
						if(document.getElementById(i+\"_element_reset\"))
							remove_add_(i+\"_element_reset\");
						break;
					}					
					case \"type_captcha\":
					{	remove_add_(\"wd_captcha\");
						remove_add_(\"element_refresh\");
						remove_add_(\"wd_captcha_input\");
						break;
					}						
					case \"type_file_upload\":
						{	remove_add_(i+\"_element\");
							if(document.getElementById(i+\"_element\").value==\"\")
							{	
								seted=false;
								break;
							}
							ext_available=getfileextension(i);
							if(!ext_available)
								seted=false;										
								break;
						}						
					case \"type_textarea\":
						{
						remove_add_(i+\"_element\");							if(document.getElementById(i+\"_element\").innerHTML==document.getElementById(i+\"_element\").title || document.getElementById(i+\"_element\").innerHTML==\"\")
								seted=false;
								break;
						}						
					case \"type_name\":
						{						
						if(document.getElementById(i+\"_element_title\"))
							{
							remove_add_(i+\"_element_title\");
							remove_add_(i+\"_element_first\");
							remove_add_(i+\"_element_last\");
							remove_add_(i+\"_element_middle\");
								if(document.getElementById(i+\"_element_title\").value==\"\" || document.getElementById(i+\"_element_first\").value==\"\" || document.getElementById(i+\"_element_last\").value==\"\" || document.getElementById(i+\"_element_middle\").value==\"\")
									seted=false;
							}
							else
							{
							remove_add_(i+\"_element_first\");
							remove_add_(i+\"_element_last\");
								if(document.getElementById(i+\"_element_first\").value==\"\" || document.getElementById(i+\"_element_last\").value==\"\")
									seted=false;
							}
							break;
						}						
					case \"type_checkbox\":
					case \"type_radio\":
						{	is=true;
							for(j=0; j<100; j++)
								if(document.getElementById(i+\"_element\"+j))
								{
							remove_add_(i+\"_element\"+j);
									if(document.getElementById(i+\"_element\"+j).checked)
									{
										is=false;										
										break;
									}
								}
							if(is)
							seted=false;
							break;
						}						
					case \"type_button\":
						{
							for(j=0; j<100; j++)
								if(document.getElementById(i+\"_element\"+j))
								{
									remove_add_(i+\"_element\"+j);
								}
							break;
						}						
					case \"type_time\":
						{	
						if(document.getElementById(i+\"_ss\"))
							{
							remove_add_(i+\"_ss\");
							remove_add_(i+\"_mm\");
							remove_add_(i+\"_hh\");
								if(document.getElementById(i+\"_ss\").value==\"\" || document.getElementById(i+\"_mm\").value==\"\" || document.getElementById(i+\"_hh\").value==\"\")
									seted=false;
							}
							else
							{
							remove_add_(i+\"_mm\");
							remove_add_(i+\"_hh\");
								if(document.getElementById(i+\"_mm\").value==\"\" || document.getElementById(i+\"_hh\").value==\"\")
									seted=false;
							}
							break;
						}						
					case \"type_date\":
						{	
						remove_add_(i+\"_element\");
						remove_add_(i+\"_button\");						
							if(document.getElementById(i+\"_element\").value==\"\")
								seted=false;
							break;
						}
					case \"type_date_fields\":
						{	
						remove_add_(i+\"_day\");
						remove_add_(i+\"_month\");
						remove_add_(i+\"_year\");
						if(document.getElementById(i+\"_day\").value==\"\" || document.getElementById(i+\"_month\").value==\"\" || document.getElementById(i+\"_year\").value==\"\")
							seted=false;
								break;
					}
				}						
		}
	}	
function check_year2(id)
{
	year=document.getElementById(id).value;	
	from=parseFloat(document.getElementById(id).getAttribute('from'));	
	year=parseFloat(year);	
	if(year<from)
	{
		document.getElementById(id).value='';
		alert('" . addslashes(__('The value of year is not valid', 'form_maker')) . "');
	}
}	
function remove_add_(id)
{
attr_name= new Array();
attr_value= new Array();
var input = document.getElementById(id); 
atr=input.attributes;
for(v=0;v<30;v++)
	if(atr[v] )
	{
		if(atr[v].name.indexOf(\"add_\")==0)
		{
			attr_name.push(atr[v].name.replace('add_',''));
			attr_value.push(atr[v].value);
			input.removeAttribute(atr[v].name);
			v--;
		}
	}
for(v=0;v<attr_name.length; v++)
{
	input.setAttribute(attr_name[v],attr_value[v])
}
}	
function getfileextension(id) 
{ 
 var fileinput = document.getElementById(id+\"_element\"); 
 var filename = fileinput.value; 
 if( filename.length == 0 ) 
 return true; 
 var dot = filename.lastIndexOf(\".\"); 
 var extension = filename.substr(dot+1,filename.length); 
 var exten = document.getElementById(id+\"_extension\").value.replace(\"***extensionverj\"+id+\"***\", \"\").replace(\"***extensionskizb\"+id+\"***\", \"\");
 exten=exten.split(','); 
 for(x=0 ; x<exten.length; x++)
 {
  exten[x]=exten[x].replace(/\./g,'');
  exten[x]=exten[x].replace(/ /g,'');
  if(extension.toLowerCase()==exten[x].toLowerCase())
  	return true;
 }
 return false; 
} 
function check_required(but_type)
{
	if(but_type=='reset')
	{
	window.location.reload( true );
	return;
	}	
	n=" . $row->counter . ";
	ext_available=true;
	seted=true;
	for(i=0; i<=n; i++)
	{	
		if(seted)
		{		
			if(document.getElementById(i))
			    if(document.getElementById(i+\"_required\"))
				if(document.getElementById(i+\"_required\").value==\"yes\")
				{
					type=document.getElementById(i).getAttribute(\"type\");
					switch(type)
					{
						case \"type_text\":
						case \"type_password\":
						case \"type_submitter_mail\":
						case \"type_own_select\":
						case \"type_country\":
							{
								if(document.getElementById(i+\"_element\").value==document.getElementById(i+\"_element\").title || document.getElementById(i+\"_element\").value==\"\")
									seted=false;
									break;
							}							
						case \"type_file_upload\":
							{
								if(document.getElementById(i+\"_element\").value==\"\")
								{	
									seted=false;
									break;
								}
								ext_available=getfileextension(i);
								if(!ext_available)
									seted=false;											
									break;
							}							
						case \"type_textarea\":
							{
								if(document.getElementById(i+\"_element\").innerHTML==document.getElementById(i+\"_element\").title || document.getElementById(i+\"_element\").innerHTML==\"\")
									seted=false;
									break;
							}							
						case \"type_name\":
							{	
							if(document.getElementById(i+\"_element_title\"))
								{
									if(document.getElementById(i+\"_element_title\").value==\"\" || document.getElementById(i+\"_element_first\").value==\"\" || document.getElementById(i+\"_element_last\").value==\"\" || document.getElementById(i+\"_element_middle\").value==\"\")
										seted=false;
								}
								else
								{
									if(document.getElementById(i+\"_element_first\").value==\"\" || document.getElementById(i+\"_element_last\").value==\"\")
										seted=false;
								}
								break;	
							}							
						case \"type_checkbox\":
						case \"type_radio\":
							{
								is=true;
								for(j=0; j<100; j++)
									if(document.getElementById(i+\"_element\"+j))
										if(document.getElementById(i+\"_element\"+j).checked)
										{
											is=false;										
											break;
										}
								if(is)
								seted=false;
								break;
							}					
						case \"type_time\":
							{	
							if(document.getElementById(i+\"_ss\"))
								{
									if(document.getElementById(i+\"_ss\").value==\"\" || document.getElementById(i+\"_mm\").value==\"\" || document.getElementById(i+\"_hh\").value==\"\")
										seted=false;
								}
								else
								{
									if(document.getElementById(i+\"_mm\").value==\"\" || document.getElementById(i+\"_hh\").value==\"\")
										seted=false;
								}
								break;	
							}							
						case \"type_date\":
							{	
								if(document.getElementById(i+\"_element\").value==\"\")
									seted=false;
								break;
							}
						case \"type_date_fields\":
							{	
								if(document.getElementById(i+\"_day\").value==\"\" || document.getElementById(i+\"_month\").value==\"\" || document.getElementById(i+\"_year\").value==\"\")
									seted=false;
								break;
							}
							}						
				}
				else
				{	
					type=document.getElementById(i).getAttribute(\"type\");
					if(type==\"type_file_upload\")
						ext_available=getfileextension(i);
							if(!ext_available)
							seted=false;											
				}
		}
		else
		{		
			if(!ext_available)
				{alert('" . addslashes(__('Sorry, you are not allowed to upload this type of file', 'form_maker')) . "');
				break;}			
			x=document.getElementById(i-1+'_element_label');
			while(x.firstChild)
			{
				x=x.firstChild;
			}
			alert(x.nodeValue+' " . addslashes(__('field is required', 'form_maker')) . "');
			break;
		}		
	}
	if(seted)
	for(i=0; i<=n; i++)
	{	
		if(document.getElementById(i))
			if(document.getElementById(i).getAttribute(\"type\")==\"type_submitter_mail\")
				if (document.getElementById(i+\"_element\").value!='')	if(document.getElementById(i+\"_element\").value.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1)
				{		alert( \"" . addslashes(__('This is not a valid email address', 'form_maker')) . "\" );	
							return;
				}	
	}
	if(seted)
		create_headers();
}	
function create_headers()
{	form_=document.getElementById('form');
	n=" . $row->counter . ";
	for(i=0; i<n; i++)
	{	if(document.getElementById(i))
		{if(document.getElementById(i).getAttribute(\"type\")!=\"type_map\")
		if(document.getElementById(i).getAttribute(\"type\")!=\"type_captcha\")
		if(document.getElementById(i).getAttribute(\"type\")!=\"type_submit_reset\")
		if(document.getElementById(i).getAttribute(\"type\")!=\"type_button\")
			if(document.getElementById(i+'_element_label'))
			{	var input = document.createElement('input');
				input.setAttribute(\"type\", 'hidden');
				input.setAttribute(\"name\", i+'_element_label');
				input.value=i;
				form_.appendChild(input);
				if(document.getElementById(i).getAttribute(\"type\")==\"type_date_fields\")
				{		var input = document.createElement('input');
						input.setAttribute(\"type\", 'hidden');
						input.setAttribute(\"name\", i+'_element');					input.value=document.getElementById(i+'_day').value+'-'+document.getElementById(i+'_month').value+'-'+document.getElementById(i+'_year').value;
					form_.appendChild(input);
				}
			}
		}
	}
form_.submit();
}	
</script>
</form></div>";
  }
  return $form_maker_front_end;
}
