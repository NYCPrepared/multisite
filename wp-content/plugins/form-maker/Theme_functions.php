<?php
if (!current_user_can('manage_options')) {
  die('Access Denied');
}
function add_theme() {
  global $wpdb;
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_themes where `default`=1  AND `id` NOT IN(" . get_option('contact_form_themes', 0) . ") ";
  $def_theme = $wpdb->get_row($query);
  html_add_theme($def_theme);
}

function show_theme() {
  global $wpdb;
  $order = "";
  $where = '';
  $sort["sortid_by"] = '';
  $order = '';
  $sort["custom_style"] = '';
  $sort["1_or_2"] = '';
  $search_tag = '';
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
  if (isset($_POST['search_events_by_title'])) {
    $search_tag = esc_html($_POST['search_events_by_title']);
  }
  else {
    $search_tag = "";
  }
  if ($search_tag) {
    $where = ' WHERE title LIKE "%' . $search_tag . '%"';
    $where .= " AND `id` NOT IN (" . get_option('contact_form_themes', 0) . ")";
  }
  else {
    $where = " WHERE `id` NOT IN (" . get_option('contact_form_themes', 0) . ")";
  }
  if ($order == "")
    $order = "ORDER BY `title` ASC";
  // get the total number of records
  $query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "formmaker_themes" . $where;
  $total = $wpdb->get_var($query);
  $pageNav['total'] = $total;
  $pageNav['limit'] = $limit / 20 + 1;
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_themes" . $where . " " . $order . " " . " LIMIT " . $limit . ",20";
  $rows = $wpdb->get_results($query);
  html_show_theme($rows, $pageNav, $sort);
}

function save_theme() {
  global $wpdb;
  $save_or_no = $wpdb->insert($wpdb->prefix . 'formmaker_themes', array(
      'id' => NULL,
      'title' => $_POST["title"],
      'css' => stripslashes(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $_POST["css"])),
    ), array(
      '%d',
      '%s',
      '%s'
    ));
  if (!$save_or_no) {
    ?>
  <div class="updated"><p><strong><?php _e('Error. Please install plugin again'); ?></strong></p></div>
  <?php
    return FALSE;
  }
  ?>
<div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
<?php

  return TRUE;
}

function apply_theme($id) {
  global $wpdb;
  $save_or_no = $wpdb->update($wpdb->prefix . 'formmaker_themes', array(
      'title' => $_POST["title"],
      'css' => stripslashes(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $_POST["css"])),
    ), array('id' => $id), array(
      '%s',
      '%s'
    ));
  ?>
<div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
<?php

  return TRUE;
}

function edit_theme($id) {
  global $wpdb;
  $row = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker_themes WHERE id='" . $id . "'");
  html_edit_theme($row, $id);
}

function remove_theme($id) {
  global $wpdb;
  if ($wpdb->get_var("SELECT `default` FROM " . $wpdb->prefix . "formmaker_themes WHERE id='" . $id . "'")) {
    ?>
  <div class="updated"><p><strong><?php _e("You can't delete default theme"); ?></strong></p></div>
  <?php
    return;
  }
  $sql_remov_tag = "DELETE FROM " . $wpdb->prefix . "formmaker_themes WHERE id='" . $id . "'";
  if (!$wpdb->query($sql_remov_tag)) {
    ?>
  <div id="message" class="error"><p>Spider Video Player Theme Not Deleted</p></div>
  <?php
  }
  else {
    ?>
  <div class="updated"><p><strong><?php _e('Item Deleted.'); ?></strong></p></div>
  <?php
  }
}

function default_theme($id) {
  global $wpdb;
  $ids_for = $wpdb->get_col("SELECT id FROM " . $wpdb->prefix . "formmaker_themes WHERE `default`=1 AND `id` NOT IN(" . get_option('contact_form_themes', 0) . ")");
  for ($i = 0; $i < count($ids_for); $i++) {
    $savedd = $wpdb->update($wpdb->prefix . 'formmaker_themes', array(
        'default' => 0,
      ), array('id' => $ids_for[$i]), array('%d'));
  }
  $savedd = $wpdb->update($wpdb->prefix . 'formmaker_themes', array(
      'default' => 1,
    ), array('id' => $id), array('%d'));
}

?>