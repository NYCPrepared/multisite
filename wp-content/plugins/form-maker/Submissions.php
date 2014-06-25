<?php
if (!current_user_can('manage_options')) {
  die('Access Denied');
}
function show_submits() {
  global $wpdb;
  $sort["sortid_by"] = '';
  $sort["custom_style"] = '';
  $sort["1_or_2"] = '';
  $order = '';
  // Page navigation.
  $exists = 0;
  $sort["default_style"] = "manage-column column-autor sortable desc";
  if (isset($_POST['page_number'])) {
    if ($_POST['asc_or_desc']) {
      $sort["sortid_by"] = $wpdb->escape($_POST['order_by']);
      if ($_POST['asc_or_desc'] == 1) {
        $sort["custom_style"] = "manage-column column-title sorted asc";
        $sort["1_or_2"] = "2";
        $order = "ORDER BY " . $sort["sortid_by"] . " ASC";
      }
      else {
        $sort["custom_style"] = "manage-column column-title sorted desc";
        $sort["1_or_2"] = "1";
        $order = "ORDER BY " . $sort["sortid_by"] . " DESC";
      }
    }
    if ($_POST['page_number']) {
      $limit = ((int) $_POST['page_number'] - 1) * 20;
    }
    else {
      $limit = 0;
    }
  }
  else {
    $limit = 0;
  }
  //End page navigation.
  $query = "SELECT id, title FROM " . $wpdb->prefix . "formmaker order by title";
  $forms = $wpdb->get_results($query);
  if (isset($_POST['form_id'])) {
    $form_id = (int) $_POST['form_id'];
  }
  else {
    $form_id = 0;
  }
  if ($form_id) {
    $query = "SELECT id FROM " . $wpdb->prefix . "formmaker where id=" . $form_id;
    $exists = $wpdb->get_var($query);
  }
  if (!$exists) {
    $form_id = 0;
  }
  if (isset($_POST['order_by']) && $_POST['order_by'] != "") {
    $filter_order = esc_html($_POST['order_by']);
  }
  else {
    $filter_order = 'id';
  }
  if (isset($_POST['asc_or_desc']) && $_POST['asc_or_desc'] == 1) {
    $filter_order_Dir = " ASC";
  }
  else {
    $filter_order_Dir = " DESC";
  }
  if (isset($_POST['search_submits'])) {
    $search_submits = esc_html($_POST['search_submits']);
  }
  else {
    $search_submits = '';
  }
  $search_submits = strtolower($search_submits);
  if (isset($_POST['ip_search'])) {
    $ip_search = esc_html($_POST['ip_search']);
  }
  else {
    $ip_search = '';
  }
  $ip_search = strtolower($ip_search);
  $where = array();
  $where_choices = array();
  if (isset($_POST['startdate'])) {
    $lists['startdate'] = $_POST['startdate'];
  }
  else {
    $lists['startdate'] = "";
  }
  if (isset($_POST['enddate'])) {
    $lists['enddate'] = $_POST['enddate'];
  }
  else {
    $lists['enddate'] = "";
  }
  if (isset($_POST['hide_label_list'])) {
    $lists['hide_label_list'] = $_POST['hide_label_list'];
  }
  else {
    $lists['hide_label_list'] = "";
  }
  if ($search_submits) {
    $where[] = 'element_label LIKE "%' . $search_submits . '%"';
  }
  if ($ip_search) {
    $where[] = 'ip LIKE "%' . $ip_search . '%"';
  }
  if ($lists['startdate'] != '') {
    $where[] = "  `date`>='" . $lists['startdate'] . " 00:00:00' ";
  }
  if ($lists['enddate'] != '') {
    $where[] = "  `date`<='" . $lists['enddate'] . " 23:59:59' ";
  }
  /*if ($form_id=="")
    if($forms)
    $form_id=$forms[0]->id;*/
  $where[] = 'form_id="' . $form_id . '"';
  $where = (count($where) ? ' WHERE ' . implode(' AND ', $where) : '');
  $orderby = ' ';
  if ($filter_order == 'id' or $filter_order == 'title' or $filter_order == 'mail') {
    $orderby = ' ORDER BY `date` desc';
  }
  elseif (!strpos($filter_order, "_field")) {
    $orderby = ' ORDER BY ' . $filter_order . ' ' . $filter_order_Dir . '';
  }
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_submits" . $where;
  $rows = $wpdb->get_results($query);
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_submits WHERE form_id='" . $form_id . "'";
  $rowsc = $wpdb->get_results($query);
  //$orderby=$order;
  $where_labels = array();
  $n = count($rowsc);
  $labels = array();
  for ($i = 0; $i < $n; $i++) {
    $row = $rowsc[$i];
    if (!in_array($row->element_label, $labels)) {
      array_push($labels, $row->element_label);
    }
  }
  // $query = "SELECT id FROM " . $wpdb->prefix . "formmaker_submits WHERE form_id='".$form_id."' and element_label=0";
	// $ispaypal = $wpdb->get_row($query);
	// if (!$ispaypal) {
    // return false;
  // }
  $sorted_labels_type = array();
  $sorted_labels_id = array();
  $sorted_labels = array();
  $label_titles = array();
  if ($labels) {
    $label_id = array();
    $label_order = array();
    $label_order_original = array();
    $label_type = array();
    $this_form = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id='" . $form_id . "'");
    $label_all = explode('#****#', $this_form->label_order);
    $label_all = array_slice($label_all, 0, count($label_all) - 1);
    foreach ($label_all as $key => $label_each) {
      $label_id_each = explode('#**id**#', $label_each);
      array_push($label_id, $label_id_each[0]);
      $label_order_each = explode('#**label**#', $label_id_each[1]);
      array_push($label_order_original, $label_order_each[0]);
      $ptn = "/[^a-zA-Z0-9_]/";
      $rpltxt = "";
      $label_temp = preg_replace($ptn, $rpltxt, $label_order_each[0]);
      array_push($label_order, $label_temp);
      array_push($label_type, $label_order_each[1]);
    }
    foreach ($label_id as $key => $label) {
      if (in_array($label, $labels)) {
        array_push($sorted_labels_type, $label_type[$key]);
        array_push($sorted_labels, $label_order[$key]);
        array_push($sorted_labels_id, $label);
        array_push($label_titles, $label_order_original[$key]);
        if (isset($_POST[$form_id . '_' . $label . '_search'])) {
          $search_temp = $_POST[$form_id . '_' . $label . '_search'];
        }
        else {
          $search_temp = '';
        }
        $search_temp = strtolower($search_temp);
        $lists[$form_id . '_' . $label . '_search'] = $search_temp;
        if ($search_temp) {
          $where_labels[] = '(group_id in (SELECT group_id FROM ' . $wpdb->prefix . 'formmaker_submits WHERE element_label="' . $label . '" AND element_value LIKE "%' . $search_temp . '%"))';
        }
      }
    }
  }
  $where_labels = (count($where_labels) ? ' ' . implode(' AND ', $where_labels) : '');
  if ($where_labels) {
    $where = $where . ' AND ' . $where_labels;
  }
  $rows_ord = array();
  if (strpos($filter_order, "_field")) {
    $query = "insert into " . $wpdb->prefix . "formmaker_submits (form_id,	element_label, element_value, group_id,`date`,ip) select $form_id,'" . str_replace("_field", "", $filter_order) . "', '', group_id,`date`,ip from  " . $wpdb->prefix . "formmaker_submits where `form_id`=$form_id and group_id not in (select group_id from " . $wpdb->prefix . "formmaker_submits where `form_id`=$form_id and element_label='" . str_replace("_field", "", $filter_order) . "' group by  group_id) group by group_id";
    if ($wpdb->query($query)) {
      echo "database error";
    }
    $query = "SELECT group_id, date, ip FROM " . $wpdb->prefix . "formmaker_submits " . $where . " and element_label='" . str_replace("_field", "", $filter_order) . "' order by element_value " . $filter_order_Dir;
    $rows_ord = $wpdb->get_results($query);
  }
  $query = 'SELECT group_id, date, ip FROM ' . $wpdb->prefix . 'formmaker_submits' . $where . ' group by group_id ' . $orderby;
  $group_ids = $wpdb->get_results($query);
  $total = count($group_ids);
  $query = 'SELECT count(distinct group_id) FROM ' . $wpdb->prefix . 'formmaker_submits where form_id ="' . $form_id . '"';
  $total_entries = $wpdb->get_var($query);
  if (count($rows_ord) != 0) {
    $group_ids = $rows_ord;
    $total = count($rows_ord);
    $query = "SELECT group_id, date, ip FROM " . $wpdb->prefix . "formmaker_submits " . $where . " and element_label='" . str_replace("_field", "", $filter_order) . "' order by element_value " . $filter_order_Dir . " limit " . $limit . ", 20 ";
    $rows_ord = $wpdb->get_results($query);
  }
  $where2 = array();
  $where_choices = $where;
  for ($i = $limit; $i < $limit + 20; $i++) {
    if ($i < $total) {
      $where2 [] = "group_id='" . $group_ids[$i]->group_id . "'";
    }
  }
  $where2 = (count($where2) ? ' AND ( ' . implode(' OR ', $where2) . ' )' : '');
  $where = $where . $where2;
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_submits " . $where . " " . $orderby . '';
  $rows = $wpdb->get_results($query);
  $pageNav['total'] = $total;
  $pageNav['limit'] = $limit / 20 + 1;
  $query = 'SELECT `views` FROM ' . $wpdb->prefix . 'formmaker_views WHERE form_id="' . $form_id . '"';
  $total_views = $wpdb->get_var($query);
  $lists['order_Dir'] = $filter_order_Dir;
  $lists['order'] = $filter_order;
  // Search filter.
  $lists['search_submits'] = $search_submits;
  $lists['ip_search'] = $ip_search;
  if (count($rows_ord) == 0) {
    $rows_ord = $rows;
  }
  // Display function.
  html_show_submits($rows, $forms, $lists, $pageNav, $sorted_labels, $label_titles, $rows_ord, $filter_order_Dir, $form_id, $sorted_labels_id, $sorted_labels_type, $total_entries, $total_views, $where, $where_choices, $sort);
}

function remov_submit($id) {
  global $wpdb;
  $query = "DELETE FROM " . $wpdb->prefix . "formmaker_submits WHERE group_id='" . $id . "'";
  if ($wpdb->query($query)) {
    ?>
  <div class="updated"><p><strong>Item Deleted.</strong></p></div>
  <?php
  }
  else {
    ?>
  <div id="message" class="error"><p>Form Maker Submission Not Deleted</p></div>
  <?php
  }
}

function remov_cheched_submission() {
  global $wpdb;
  $cid = $_POST['post'];
  if (count($cid)) {
    $cids = implode(',', $cid);
    // Create sql statement.
    $query = 'DELETE FROM ' . $wpdb->prefix . 'formmaker_submits' . ' WHERE group_id IN ( ' . $cids . ' )';
    if ($wpdb->query($query)) {
      ?>
    <div class="updated"><p><strong>Items Deleted.</strong></p></div>
    <?php
    }
    else {
      ?>
    <div id="message" class="error"><p>Form Maker Submissions Not Deleted</p></div>
    <?php
    }
  }
  else {
    ?>
  <div id="message" class="error"><p>Submissions Not Selected</p></div>
  <?php
  }
}

function editSubmit($id) {
  global $wpdb;
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_submits WHERE group_id=" . $id;
  $rows = $wpdb->get_results($query);
  $form = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id=" . $rows[0]->form_id);
  $label_id = array();
  $label_order_original = array();
  $label_type = array();
  $label_all = explode('#****#', $form->label_order);
  $label_all = array_slice($label_all, 0, count($label_all) - 1);
  foreach ($label_all as $key => $label_each) {
    $label_id_each = explode('#**id**#', $label_each);
    array_push($label_id, $label_id_each[0]);
    $label_oder_each = explode('#**label**#', $label_id_each[1]);
    array_push($label_order_original, $label_oder_each[0]);
    array_push($label_type, $label_oder_each[1]);
  }
  // Display function.
  html_editSubmit($rows, $label_id, $label_order_original, $label_type);
}

function save_submit($id) {
  global $wpdb;
  $id = (int) $_POST['id'];
  $date = esc_html($_POST['date']);
  $ip = esc_html($_POST['ip']);
  $form_id = $wpdb->get_var("SELECT form_id FROM " . $wpdb->prefix . "formmaker_submits WHERE group_id='" . $id . "'");
  $form = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id='" . $form_id . "'");
  $label_id = array();
  $label_order_original = array();
  $label_type = array();
  $label_all = explode('#****#', $form->label_order);
  $label_all = array_slice($label_all, 0, count($label_all) - 1);
  foreach ($label_all as $key => $label_each) {
    $label_id_each = explode('#**id**#', $label_each);
    array_push($label_id, $label_id_each[0]);
    $label_oder_each = explode('#**label**#', $label_id_each[1]);
    array_push($label_order_original, $label_oder_each[0]);
    array_push($label_type, $label_oder_each[1]);
  }
  foreach ($label_id as $key => $label_id_1) {
    $element_value = $_POST["submission_" . $label_id_1];
    if (isset($_POST["submission_" . $label_id_1])) {
      $query = "SELECT id FROM " . $wpdb->prefix . "formmaker_submits WHERE group_id='" . $id . "' AND element_label='" . $label_id_1 . "'";
      $result = $wpdb->get_var($query);
      if ($label_type[$key] == 'type_file_upload')
        if ($element_value)
          $element_value = $element_value . "*@@url@@*";
      if ($result) {
        $wpdb->update($wpdb->prefix . "formmaker_submits", array(
            'element_value' => stripslashes($element_value),
          ), array(
            'group_id' => $id,
            'element_label' => $label_id_1
          ), array(
            '%s',
          ), array(
            '%d',
            '%s'
          ));
      }
      else {
        $wpdb->insert($wpdb->prefix . "formmaker_submits", array(
            'form_id' => $form_id,
            'element_label' => $label_id_1,
            'element_value' => stripslashes($element_value),
            'group_id' => $id,
            'date' => $date,
            'ip' => $ip
          ), array(
            '%d',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s'
          ));
      }
    }
    else {
      $element_value_ch = $_POST["submission_" . $label_id_1 . '_0'];
      if (isset($_POST["submission_" . $label_id_1 . '_0'])) {
        for ($z = 0; $z < 21; $z++) {
          $element_value_ch = $_POST["submission_" . $label_id_1 . '_' . $z];
          if (isset($element_value_ch))
            $element_value = $element_value . $element_value_ch . '***br***';
          else
            break;
        }
        $query = "SELECT id FROM " . $wpdb->prefix . "formmaker_submits WHERE group_id='" . $id . "' AND element_label='" . $label_id_1 . "'";
        $result = $wpdb->get_var($query);
        if ($result) {
          $query = "UPDATE " . $wpdb->prefix . "formmaker_submits SET `element_value`='" . stripslashes($element_value) . "' WHERE group_id='" . $id . "' AND element_label='" . $label_id_1 . "'";
          $wpdb->update($wpdb->prefix . "formmaker_submits", array(
              'element_value' => stripslashes($element_value),
            ), array(
              'group_id' => $id,
              'element_label' => $label_id_1
            ), array(
              '%s',
            ), array(
              '%d',
              '%s'
            ));
        }
        else {
          $query = "INSERT INTO " . $wpdb->prefix . "formmaker_submits (form_id, element_label, element_value, group_id, date, ip) VALUES('" . $form_id . "', '" . $label_id_1 . "', '" . stripslashes($element_value) . "','" . $id . "', '" . $date . "', '" . $ip . "')";
          $wpdb->insert($wpdb->prefix . "formmaker_submits", array(
              'form_id' => $form_id,
              'element_label' => $label_id_1,
              'element_value' => stripslashes($element_value),
              'group_id' => $id,
              'date' => $date,
              'ip' => $ip
            ), array(
              '%d',
              '%s',
              '%s',
              '%d',
              '%s',
              '%s'
            ));
        }
      }
    }
  }
}

?>