<?php
/**
 * @package Form Maker
 * @author Web-Dorado
 * @copyright (C) 2011 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

// Direct access must be allowed.
// Generete CSV.
function form_maker_generete_csv() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  if (isset($_GET['action']) && esc_html($_GET['action']) == 'formmakergeneretecsv') {
    global $wpdb;
    $form_id = $_REQUEST['form_id'];
    $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "formmaker_submits where form_id= %d ORDER BY date ASC", $form_id);
    $rows = $wpdb->get_results($query);
    $n = count($rows);
    $labels = array();
    for ($i = 0; $i < $n; $i++) {
      $row = &$rows[$i];
      if (!in_array($row->element_label, $labels)) {
        array_push($labels, $row->element_label);
      }
    }
    $label_titles = array();
    $sorted_labels = array();
    $query_lable = $wpdb->prepare("SELECT label_order,title FROM " . $wpdb->prefix . "formmaker where id= %d", $form_id);
    $rows_lable = $wpdb->get_results($query_lable);
    $ptn = "/[^a-zA-Z0-9_]/";
    $rpltxt = "";
    $title = preg_replace($ptn, $rpltxt, $rows_lable[0]->title);
    $sorted_labels_id = array();
    $sorted_labels = array();
    $label_titles = array();
    if ($labels) {
      $label_id = array();
      $label_order = array();
      $label_order_original = array();
      $label_type = array();
      $label_all = explode('#****#', $rows_lable[0]->label_order);
      $label_all = array_slice($label_all, 0, count($label_all) - 1);
      foreach ($label_all as $key => $label_each) {
        $label_id_each = explode('#**id**#', $label_each);
        array_push($label_id, $label_id_each[0]);
        $label_oder_each = explode('#**label**#', $label_id_each[1]);
        array_push($label_order_original, $label_oder_each[0]);
        $ptn = "/[^a-zA-Z0-9_]/";
        $rpltxt = "";
        $label_temp = preg_replace($ptn, $rpltxt, $label_oder_each[0]);
        array_push($label_order, $label_temp);
        array_push($label_type, $label_oder_each[1]);
      }
      foreach ($label_id as $key => $label) {
        if (in_array($label, $labels)) {
          array_push($sorted_labels, $label_order[$key]);
          array_push($sorted_labels_id, $label);
          array_push($label_titles, $label_order_original[$key]);
        }
      }
    }
    $m = count($sorted_labels);
    $group_id_s = array();
    $l = 0;
    if (count($rows) > 0 and $m)
      for ($i = 0; $i < count($rows); $i++) {
        $row = &$rows[$i];
        if (!in_array($row->group_id, $group_id_s)) {
          array_push($group_id_s, $row->group_id);
        }
      }
    $data = array();
    $temp_all = array();
    for ($j = 0; $j < $n; $j++) {
      $row = &$rows[$j];
      $key = $row->group_id;
      if (!isset($temp_all[$key])) {
        $temp_all[$key] = array();
      }
      array_push($temp_all[$key], $row);
    }
    for ($www = 0; $www < count($group_id_s); $www++) {
      $i = $group_id_s[$www];
      $temp = array();
      $temp = $temp_all[$i];
      $f = $temp[0];
      $date = $f->date;
      $ip = $f->ip;
      $data_temp['Submit date'] = $date;
      $data_temp['Ip'] = $ip;
      $ttt = count($temp);
      for ($h = 0; $h < $m; $h++) {
        $data_temp[$label_titles[$h]] = '';
        for ($g = 0; $g < $ttt; $g++) {
          $t = $temp[$g];
          if ($t->element_label == $sorted_labels_id[$h]) {
            if (strpos($t->element_value, "*@@url@@*")) {
              $new_file = str_replace("*@@url@@*", '', $t->element_value);
              $new_filename = explode('/', $new_file);
              $data_temp[$label_titles[$h]] = $new_file;
            }
            elseif (strpos($t->element_value, "***br***")) {
              $data_temp[$label_titles[$h]] = substr(str_replace("***br***", ', ', $t->element_value), 0, -2);
            }
            elseif (strpos($t->element_value, "***map***")) {
              $data_temp[$label_titles[$h]] = 'Longitude:' . substr(str_replace("***map***", ', Latitude:', $t->element_value), 0, -2);
            }
            elseif (strpos($t->element_value,"***star_rating***")) {
              $element = str_replace("***star_rating***", '', $t->element_value);
							$element = explode("***", $element);
							$data_temp[stripslashes($label_titles[$h])] = ' ' . $element[1] . '/' . $element[0];
						}
            elseif (strpos($t->element_value, "***grading***")) {
              $element = str_replace("***grading***", '', $t->element_value);
              $grading = explode(":", $element);
							$items_count = sizeof($grading) - 1;
							$items = "";
							$total = "";
              for ($k = 0; $k < $items_count / 2; $k++) {
                $items .= $grading[$items_count / 2 + $k] . ": " . $grading[$k] . ", ";
                $total += $grading[$k];
              }
              $items .= "Total: " . $total;
							$data_temp[$label_titles[$h]] = $items;
						}
            elseif (strpos($t->element_value, "***matrix***")) {
              $element = str_replace("***matrix***", '', $t->element_value);
              $matrix_value = explode('***', $element);
              $matrix_value = array_slice($matrix_value, 0, count($matrix_value) - 1);
							$mat_rows = $matrix_value[0];
							$mat_columns = $matrix_value[$mat_rows + 1];
							$matrix = "";
							$aaa = Array();
              $var_checkbox = 1;
							$selected_value = "";
              $selected_value_yes = "";
              $selected_value_no = "";
							for ($k = 1; $k <= $mat_rows; $k++) {
							  if ($matrix_value[$mat_rows + $mat_columns + 2] == "radio") {
                  if ($matrix_value[$mat_rows + $mat_columns + 2 + $k] == 0) {
                    $checked = "0";
                    $aaa[1] = "";
									}
                  else {
                    $aaa = explode("_", $matrix_value[$mat_rows + $mat_columns + 2 + $k]);
                  }
                  for ($l = 1; $l <= $mat_columns; $l++) {
										if ($aaa[1] == $l) {
									    $checked = '1';
                    }
                    else {
									    $checked = '0';
                    }
						        $matrix .= '['.$matrix_value[$k].','.$matrix_value[$mat_rows+1+$l].']='.$checked."; ";
					        }
						    }
								else {
                  if ($matrix_value[$mat_rows+$mat_columns + 2] == "checkbox") {
                    for ($l = 1; $l <= $mat_columns; $l++) {
                      if ($matrix_value[$mat_rows+$mat_columns + 2 + $var_checkbox] == 1) {
                        $checked = '1';
                      }
                      else {
                        $checked = '0';
                      }
							        $matrix .= '['.$matrix_value[$k].','.$matrix_value[$mat_rows+1+$l].']='.$checked."; ";
                      $var_checkbox++;
                    }
                  }
                  else {
                    if ($matrix_value[$mat_rows+$mat_columns + 2] == "text") {
							        for ($l = 1; $l <= $mat_columns; $l++) {
                        $text_value = $matrix_value[$mat_rows+$mat_columns+2+$var_checkbox];
                        $matrix .='['.$matrix_value[$k].','.$matrix_value[$mat_rows+1+$l].']='.$text_value."; ";
                        $var_checkbox++;
                      }
                    }
                    else {
                      for ($l = 1; $l <= $mat_columns; $l++) {
                        $selected_text = $matrix_value[$mat_rows+$mat_columns + 2 + $var_checkbox];
                        $matrix .= '['.$matrix_value[$k].','.$matrix_value[$mat_rows + 1 + $l].']='.$selected_text."; ";
                        $var_checkbox++;
                      }
                    }
                  }
								}
							}
							$data_temp[stripslashes($label_titles[$h])] = $matrix;
						}
            else {
              $val = htmlspecialchars_decode($t->element_value);
              $val = stripslashes(str_replace('&#039;', "'", $val));
              $data_temp[stripslashes($label_titles[$h])] = ($t->element_value ? $val : '');
            }
          }
        }
      }
      $data[] = $data_temp;
    }
    function cleanData(&$str) {
      $str = preg_replace("/\t/", "\\t", $str);
      $str = preg_replace("/\r?\n/", "\\n", $str);
      if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
    }
    // File name for download.
    $filename = $title . "_" . date('Ymd') . ".csv";
    header('Content-Encoding: Windows-1252');
    header('Content-type: text/csv; charset=Windows-1252');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $flag = FALSE;
    foreach ($data as $row) {
      if (!$flag) {
        # display field/column names as first row
        echo "sep=,\r\n";
        echo '"' . implode('","', array_keys($row));
        if ($is_paypal_info) {
          echo '","Currency","Last modified","Status","Full Name","Fax","Mobile phone","Email","Phone","Address","Paypal info","IPN","Tax","Shipping';
        }  
        echo "\"\r\n";
        $flag = TRUE;
      }
      array_walk($row, 'cleanData');
      echo '"' . implode('","', array_values($row)) . "\"\r\n";
    }
    die('');
  }
}

// Generete XML.
function form_maker_generete_xml() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  if (isset($_GET['action']) && esc_html($_GET['action']) == 'formmakergeneretexml') {
    global $wpdb;
    $form_id = $_REQUEST['form_id'];
    $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "formmaker_submits where form_id= %d ORDER BY date ASC", $form_id);
    $rows = $wpdb->get_results($query);
    $n = count($rows);
    $labels = array();
    for ($i = 0; $i < $n; $i++) {
      $row = &$rows[$i];
      if (!in_array($row->element_label, $labels)) {
        array_push($labels, $row->element_label);
      }
    }
    $label_titles = array();
    $sorted_labels = array();
    $query_lable = "SELECT label_order,title FROM " . $wpdb->prefix . "formmaker where id=$form_id ";
    $rows_lable = $wpdb->get_results($query_lable);
    $ptn = "/[^a-zA-Z0-9_]/";
    $rpltxt = "";
    $title = preg_replace($ptn, $rpltxt, $rows_lable[0]->title);
    $sorted_labels_id = array();
    $sorted_labels = array();
    $label_titles = array();
    if ($labels) {
      $label_id = array();
      $label_order = array();
      $label_order_original = array();
      $label_type = array();
      $label_all = explode('#****#', $rows_lable[0]->label_order);
      $label_all = array_slice($label_all, 0, count($label_all) - 1);
      foreach ($label_all as $key => $label_each) {
        $label_id_each = explode('#**id**#', $label_each);
        array_push($label_id, $label_id_each[0]);
        $label_oder_each = explode('#**label**#', $label_id_each[1]);
        array_push($label_order_original, $label_oder_each[0]);
        $ptn = "/[^a-zA-Z0-9_]/";
        $rpltxt = "";
        $label_temp = preg_replace($ptn, $rpltxt, $label_oder_each[0]);
        array_push($label_order, $label_temp);
        array_push($label_type, $label_oder_each[1]);
      }
      foreach ($label_id as $key => $label) {
        if (in_array($label, $labels)) {
          array_push($sorted_labels, $label_order[$key]);
          array_push($sorted_labels_id, $label);
          array_push($label_titles, $label_order_original[$key]);
        }
      }
    }
    $m = count($sorted_labels);
    $group_id_s = array();
    $l = 0;
    if (count($rows) > 0 and $m) {
      for ($i = 0; $i < count($rows); $i++) {
        $row = &$rows[$i];
        if (!in_array($row->group_id, $group_id_s)) {
          array_push($group_id_s, $row->group_id);
        }
      }
    }
    $data = array();
    $temp_all = array();
    for ($j = 0; $j < $n; $j++) {
      $row = &$rows[$j];
      $key = $row->group_id;
      if (!isset($temp_all[$key])) {
        $temp_all[$key] = array();
      }
      array_push($temp_all[$key], $row);
    }
    for ($www = 0; $www < count($group_id_s); $www++) {
      $i = $group_id_s[$www];
      $temp = array();
      $temp = $temp_all[$i];
      $f = $temp[0];
      $date = $f->date;
      $ip = $f->ip;
      $data_temp['Submit date'] = $date;
      $data_temp['Ip'] = $ip;
      $ttt = count($temp);
      for ($h = 0; $h < $m; $h++) {
        for ($g = 0; $g < $ttt; $g++) {
          $t = $temp[$g];
          if ($t->element_label == $sorted_labels_id[$h]) {
            if (strpos($t->element_value, "*@@url@@*")) {
              $new_file = str_replace("*@@url@@*", '', $t->element_value);
              $new_filename = explode('/', $new_file);
              $data_temp[$label_titles[$h]] = $new_file;
            }
            elseif (strpos($t->element_value, "***br***")) {
              $data_temp[$label_titles[$h]] = substr(str_replace("***br***", ', ', $t->element_value), 0, -2);
            }
            elseif (strpos($t->element_value, "***map***")) {
              $data_temp[$label_titles[$h]] = 'Longitude:' . substr(str_replace("***map***", ', Latitude:', $t->element_value), 0, -2);
            }
            elseif (strpos($t->element_value,"***star_rating***")) {
              $element = str_replace("***star_rating***", '', $t->element_value);
							$element = explode("***", $element);
							$data_temp[stripslashes($label_titles[$h])] = ' ' . $element[1] . '/' . $element[0];
						}
            elseif (strpos($t->element_value, "***grading***")) {
              $element = str_replace("***grading***", '', $t->element_value);
              $grading = explode(":", $element);
							$items_count = sizeof($grading) - 1;
							$items = "";
							$total = "";
              for ($k = 0; $k < $items_count / 2; $k++) {
                $items .= $grading[$items_count / 2 + $k] . ": " . $grading[$k] . ", ";
                $total += $grading[$k];
              }
              $items .= "Total: " . $total;
							$data_temp[$label_titles[$h]] = $items;
						}
            elseif (strpos($t->element_value, "***matrix***")) {
              $element = str_replace("***matrix***", '', $t->element_value);
              $matrix_value = explode('***', $element);
              $matrix_value = array_slice($matrix_value, 0, count($matrix_value) - 1);
							$mat_rows = $matrix_value[0];
							$mat_columns = $matrix_value[$mat_rows + 1];
							$matrix = "";
							$aaa = Array();
              $var_checkbox = 1;
							$selected_value = "";
              $selected_value_yes = "";
              $selected_value_no = "";
							for ($k = 1; $k <= $mat_rows; $k++) {
							  if ($matrix_value[$mat_rows + $mat_columns + 2] == "radio") {
                  if ($matrix_value[$mat_rows + $mat_columns + 2 + $k] == 0) {
                    $checked = "0";
                    $aaa[1] = "";
									}
                  else {
                    $aaa = explode("_", $matrix_value[$mat_rows + $mat_columns + 2 + $k]);
                  }
                  for ($l = 1; $l <= $mat_columns; $l++) {
										if ($aaa[1] == $l) {
									    $checked = '1';
                    }
                    else {
									    $checked = '0';
                    }
						        $matrix .= '['.$matrix_value[$k].','.$matrix_value[$mat_rows+1+$l].']='.$checked."; ";
					        }
						    }
								else {
                  if ($matrix_value[$mat_rows+$mat_columns + 2] == "checkbox") {
                    for ($l = 1; $l <= $mat_columns; $l++) {
                      if ($matrix_value[$mat_rows+$mat_columns + 2 + $var_checkbox] == 1) {
                        $checked = '1';
                      }
                      else {
                        $checked = '0';
                      }
							        $matrix .= '['.$matrix_value[$k].','.$matrix_value[$mat_rows+1+$l].']='.$checked."; ";
                      $var_checkbox++;
                    }
                  }
                  else {
                    if ($matrix_value[$mat_rows+$mat_columns + 2] == "text") {
							        for ($l = 1; $l <= $mat_columns; $l++) {
                        $text_value = $matrix_value[$mat_rows+$mat_columns+2+$var_checkbox];
                        $matrix .='['.$matrix_value[$k].','.$matrix_value[$mat_rows+1+$l].']='.$text_value."; ";
                        $var_checkbox++;
                      }
                    }
                    else {
                      for ($l = 1; $l <= $mat_columns; $l++) {
                        $selected_text = $matrix_value[$mat_rows+$mat_columns + 2 + $var_checkbox];
                        $matrix .= '['.$matrix_value[$k].','.$matrix_value[$mat_rows + 1 + $l].']='.$selected_text."; ";
                        $var_checkbox++;
                      }
                    }
                  }
								}
							}
							$data_temp[stripslashes($label_titles[$h])] = $matrix;
						}
            else {
              $val = str_replace('&amp;', "&", $t->element_value);
              $val = stripslashes(str_replace('&#039;', "'", $t->element_value));
              $data_temp[stripslashes($label_titles[$h])] = ($t->element_value ? $val : '');
            }
          }
        }
      }
      $data[] = $data_temp;
    }
    function cleanData(&$str) {
      $str = preg_replace("/\t/", "\\t", $str);
      $str = preg_replace("/\r?\n/", "\\n", $str);
      if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
    }

    $filename = $title . "_" . date('Ymd') . ".xml";
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type:text/xml,  charset=utf-8");
    $flag = FALSE;
    echo '<?xml version="1.0" encoding="utf-8" ?> 
  <form title="' . $title . '">';
    foreach ($data as $key1 => $value1) {
      echo  '<submission>';
      foreach ($value1 as $key => $value) {
        echo  '<field title="' . $key . '">';
        echo   '<![CDATA[' . $value . "]]>";
        echo  '</field>';
      }
      echo  '</submission>';
    }
    echo ' </form>';
    die('');
  }
}

// Captcha.
function form_maker_wd_captcha() {
  if (isset($_GET['action']) && esc_html($_GET['action']) == 'formmakerwdcaptcha') {
    if (isset($_GET["i"])) {
      $i = (int) $_GET["i"];
    }
    else {
      $i = '';
    }
    if (isset($_GET['r2'])) {
      $r2 = (int) $_GET['r2'];
    }
    else {
      $r2 = 0;
    }
    if (isset($_GET['r'])) {
      $rrr = (int) $_GET['r'];
    }
    else {
      $rrr = 0;
    }
    $randNum = 0 + $r2 + $rrr;
    if (isset($_GET["digit"])) {
      $digit = (int) $_GET["digit"];
    }
    else {
      $digit = 6;
    }
    $cap_width = $digit * 10 + 15;
    $cap_height = 30;
    $cap_quality = 100;
    $cap_length_min = $digit;
    $cap_length_max = $digit;
    $cap_digital = 1;
    $cap_latin_char = 1;
    function code_generic($_length, $_digital = 1, $_latin_char = 1) {
      $dig = array(
        0,
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9
      );
      $lat = array(
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z'
      );
      $main = array();
      if ($_digital) {
        $main = array_merge($main, $dig);
      }
      if ($_latin_char) {
        $main = array_merge($main, $lat);
      }
      shuffle($main);
      $pass = substr(implode('', $main), 0, $_length);
      return $pass;
    }
    $l = rand($cap_length_min, $cap_length_max);
    $code = code_generic($l, $cap_digital, $cap_latin_char);
    @session_start();
    $_SESSION[$i . '_wd_captcha_code'] = $code;
    $canvas = imagecreatetruecolor($cap_width, $cap_height);
    $c = imagecolorallocate($canvas, rand(150, 255), rand(150, 255), rand(150, 255));
    imagefilledrectangle($canvas, 0, 0, $cap_width, $cap_height, $c);
    $count = strlen($code);
    $color_text = imagecolorallocate($canvas, 0, 0, 0);
    for ($it = 0; $it < $count; $it++) {
      $letter = $code[$it];
      imagestring($canvas, 6, (10 * $it + 10), $cap_height / 4, $letter, $color_text);
    }
    for ($c = 0; $c < 150; $c++) {
      $x = rand(0, $cap_width - 1);
      $y = rand(0, 29);
      $col = '0x' . rand(0, 9) . '0' . rand(0, 9) . '0' . rand(0, 9) . '0';
      imagesetpixel($canvas, $x, $y, $col);
    }
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');
    header('Content-Type: image/jpeg');
    imagejpeg($canvas, NULL, $cap_quality);
    die('');
  }
}

// Function post or page window php.
function form_maker_window_php() {
  if (isset($_GET['action']) && esc_html($_GET['action']) == 'formmakerwindow') {
    global $wpdb;
    ?>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Form Maker</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script language="javascript" type="text/javascript"
            src="<?php echo get_option("siteurl"); ?>/wp-includes/js/jquery/jquery.js"></script>
    <script language="javascript" type="text/javascript"
            src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
    <link rel="stylesheet"
          href="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css?ver=342-20110630100">
    <script language="javascript" type="text/javascript"
            src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
    <script language="javascript" type="text/javascript"
            src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
    <base target="_self">
  </head>
  <body id="link" style="" dir="ltr" class="forceColors">
  <div class="tabs" role="tablist" tabindex="-1">
    <ul>
      <li id="form_maker_tab" class="current" role="tab" tabindex="0"><span><a
        href="javascript:mcTabs.displayTab('Single_product_tab','Single_product_panel');" onMouseDown="return false;"
        tabindex="-1">Form Maker</a></span></li>
    </ul>
  </div>
  <style>
    .panel_wrapper {
      height: 170px !important;
    }
  </style>
  <div class="panel_wrapper">
    <div id="Single_product_panel" class="panel current">
      <table>
        <tr>
          <td style="height:100px; width:100px; vertical-align:top;">
            Select a Form
          </td>
          <td style="vertical-align:top">
            <select name="Form_Makername" id="Form_Makername" style="width:250px; text-align:center">
              <option style="text-align:center" value="- Select Form -" selected="selected">- Select a Form -</option>
              <?php $ids_Form_Maker = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE `id` NOT IN(" . get_option('contact_form_forms', 0) . ") order by `id` DESC", 0);
              foreach ($ids_Form_Maker as $arr_Form_Maker) {
                ?>
                <option value="<?php echo $arr_Form_Maker->id; ?>"><?php echo $arr_Form_Maker->title; ?></option>
                <?php }?>
            </select>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="mceActionPanel">
    <div style="float: left">
      <input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"/>
    </div>

    <div style="float: right">
      <input type="submit" id="insert" name="insert" value="Insert" onClick="insert_Form_Maker();"/>
    </div>
  </div>
  <script type="text/javascript">
    function insert_Form_Maker() {
      if (document.getElementById('Form_Makername').value == '- Select Form -') {
        tinyMCEPopup.close();
      }
      else {
        var tagtext;
        tagtext = '[Form id="' + document.getElementById('Form_Makername').value + '"]';
        window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
        tinyMCEPopup.editor.execCommand('mceRepaint');
        tinyMCEPopup.close();
      }

    }

  </script>
  </body>
  </html>
  <?php
    die('');
  }
}

// Form preview from product options page.
function form_maker_form_preview_product_option() {
  global $wpdb;
  if (isset($_GET['id'])) {
    $getparams = (int) $_GET['id'];
  }
  if (isset($_GET['form_id'])) {
    $form_id = (int) $_GET['form_id'];
  }
  $query = "SELECT css FROM " . $wpdb->prefix . "formmaker_themes WHERE id=" . $getparams;
  $css = $wpdb->get_var($query);
  $query = "SELECT form_front FROM " . $wpdb->prefix . "formmaker WHERE id=" . $form_id;
  $form = $wpdb->get_var($query);
  html_form_maker_form_preview_product_option($css, $form);
}

function html_form_maker_form_preview_product_option($css, $form) {
  $cmpnt_js_path = plugins_url('js', __FILE__);
  $id = 'form_id_temp';
  echo "<input type='hidden' value='" . plugins_url("", __FILE__) . "' id='form_plugins_url' />";
  echo '<script type="text/javascript">
          if (document.getElementById("form_plugins_url")) {
            var plugin_url = document.getElementById("form_plugins_url").value;
          }
          else {
            var plugin_url = "";
          }
        </script>';
  ?>
  <script src="<?php echo $cmpnt_js_path . "/if_gmap_back_end.js"; ?>"></script>
  <script src="<?php echo $cmpnt_js_path . "/main.js"; ?>"></script>
  <script src="<?php echo $cmpnt_js_path . "/jquery-1.9.1.js"; ?>"></script>
  <script src="<?php echo $cmpnt_js_path . "/jquery-ui.js"; ?>"></script>
  <script src="<?php echo $cmpnt_js_path . "/jquery.ui.slider.js"; ?>"></script>
  <script src="<?php echo $cmpnt_js_path . "/main_front_end.js"; ?>"></script>
  <link media="all" type="text/css" href="<?php echo plugins_url('', __FILE__) . "/css/jquery-ui-spinner.css"; ?>" rel="stylesheet">
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <style>
      <?php
      $cmpnt_js_path = plugins_url('', __FILE__);
      echo str_replace('[SITE_ROOT]', $cmpnt_js_path, $css);
      ?>
  </style>
  <form id="form_preview"><?php echo $form; ?></form>
  <?php
  die();
}
