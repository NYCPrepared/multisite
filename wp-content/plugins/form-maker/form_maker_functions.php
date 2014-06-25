<?php

if (!current_user_can('manage_options')) {
  die('Access Denied');
}
function update_form_maker() {
  global $wpdb;
  $query = "SELECT id, form FROM " . $wpdb->prefix . "formmaker WHERE `id` NOT IN(" . get_option('contact_form_forms', 0) . ")";
  $forms = $wpdb->get_results($query);
  $id = 0;
  $old_version = FALSE;
  foreach ($forms as $form) {
    if (strpos($form->form, "wdform_table1") === FALSE) {
      $id = $form->id;
      $old_version = TRUE;
      break;
    }
  }
  if (!$old_version) {
    ?>
  <script type="text/javascript">
    window.onload = val;
    function val() {
      var form = document.adminForm;
      submitform();
    }
    function submitform(pressbutton) {
      document.getElementById('adminForm').action = document.getElementById('adminForm').action + "&task=update_complite";
      document.getElementById('adminForm').submit();
    }
  </script>
  <form action="admin.php?page=Form_maker" method="post" id="adminForm" name="adminForm"></form>
  <?php
    die();
  }
  $row = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id=" . $id);
  $labels = array();
  $label_id = array();
  $label_order_original = array();
  $label_type = array();
  $label_all = explode('#****#', $row->label_order);
  $label_all = array_slice($label_all, 0, count($label_all) - 1);
  foreach ($label_all as $key => $label_each) {
    $label_id_each = explode('#**id**#', $label_each);
    array_push($label_id, $label_id_each[0]);
    $label_oder_each = explode('#**label**#', $label_id_each[1]);
    array_push($label_order_original, addslashes($label_oder_each[0]));
    array_push($label_type, $label_oder_each[1]);
  }
  $labels['id'] = '"' . implode('","', $label_id) . '"';
  $labels['label'] = '"' . implode('","', $label_order_original) . '"';
  $labels['type'] = '"' . implode('","', $label_type) . '"';
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_themes WHERE `id` NOT IN(" . get_option('contact_form_forms', 0) . ") ORDER BY title";
  $themes = $wpdb->get_results($query);
  @session_start();
  $_SESSION['current_updates'] = $_SESSION['current_updates'] + 1;
  html_update_form_maker($row, $labels, $themes);
}

function save_update_form_maker() {
  global $wpdb;
  $id = (int) $_GET['id'];
  $no_slash_form = stripslashes($_POST['form']);
  $no_slash_form_front = stripslashes($_POST['form_front']);
  $savedd = $wpdb->update($wpdb->prefix . "formmaker", array(
    'title' => $_POST["title"],
    'mail' => $_POST["mail"],
    'form' => $no_slash_form,
    'form_front' => $no_slash_form_front,
    'theme' => $_POST["theme"],
    'counter' => $_POST["counter"],
    'label_order' => $_POST["label_order"],
    'label_order_current' => $_POST["label_order_current"],
    'pagination' => $_POST["pagination"],
    'show_title' => $_POST["show_title"],
    'show_numbers' => $_POST["show_numbers"],
    'public_key' => $_POST["public_key"],
    'private_key' => $_POST["private_key"],
    'recaptcha_theme' => $_POST["recaptcha_theme"],
  ), array('id' => $id), array(
    '%s',
    '%s',
    '%s',
    '%s',
    '%d',
    '%d',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s'
  ));
  html_forchrome_update();
}

function display_form_lists() {
  global $wpdb;
  $where = '';
  $sort["custom_style"] = "";
  $sort["1_or_2"] = "";
  $order = "";
  $sort["default_style"] = "";
  $sort["sortid_by"] = '';
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
    $where .= " AND `id` NOT IN(" . get_option('contact_form_forms', 0) . ")";
  }
  else {
    $where = " WHERE `id` NOT IN(" . get_option('contact_form_forms', 0) . ")";
  }
  // Get the total number of records.
  $query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "formmaker" . $where;
  $total = $wpdb->get_var($query);
  $pageNav['total'] = $total;
  $pageNav['limit'] = $limit / 20 + 1;
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker" . $where . " " . $order . " " . " LIMIT " . $limit . ",20";
  $rows = $wpdb->get_results($query);
  $old_version = FALSE;
  foreach ($rows as $row) {
    if (strpos($row->form, "wdform_table1") === FALSE) {
      $old_version = TRUE;
      break;
    }
  }
  $can_update_form = TRUE;
  if ($old_version) {
    $old_n = 0;
    foreach ($rows as $row) {
      $count_words_in_form = count(explode("_element_section", $row->form)) - count(explode("and_element_section", $row->form));
      if (!(strpos($row->form, "type_map") === FALSE)) {
        $can_update_form = FALSE;
        break;
      }
      if (!(strpos($row->form, "type_file") === FALSE)) {
        $can_update_form = FALSE;
        break;
      }
      if ($count_words_in_form > 5) {
        $can_update_form = FALSE;
        break;
      }
      if (strpos($row->form, "wdform_table1") === FALSE) {
        $old_n++;
      }
    }
    @session_start();
    $_SESSION['all_updates'] = $old_n;
    $_SESSION['current_updates'] = 0;
  }
  html_display_form_lists($rows, $pageNav, $sort, $old_version, $can_update_form);
}

// Add a form.
function add_form() {
  global $wpdb;
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_themes WHERE `id` NOT IN(" . get_option('contact_form_themes', 0) . ") ORDER BY title";
  $themes = $wpdb->get_results($query);
  html_add_form($themes);
}

// Edit the form.
function edit_form_maker($id) {
  global $wpdb;
  // Load the row from the DB table.
  if (get_option('contact_form_forms', FALSE)) {
    $row = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id='" . $id . "' AND `id` NOT IN(" . get_option('contact_form_forms') . ")");
  }
  else {
    $row = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id='" . $id . "'");
  }
  $labels = array();
  $label_id = array();
  $label_order_original = array();
  $label_type = array();
  $label_all = explode('#****#', $row->label_order);
  $label_all = array_slice($label_all, 0, count($label_all) - 1);
  foreach ($label_all as $key => $label_each) {
    $label_id_each = explode('#**id**#', $label_each);
    array_push($label_id, $label_id_each[0]);
    $label_oder_each = explode('#**label**#', $label_id_each[1]);
    array_push($label_order_original, addslashes($label_oder_each[0]));
    array_push($label_type, $label_oder_each[1]);
  }
  $labels['id'] = '"' . implode('","', $label_id) . '"';
  $labels['label'] = '"' . implode('","', $label_order_original) . '"';
  $labels['type'] = '"' . implode('","', $label_type) . '"';
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_themes WHERE `id` NOT IN(" . get_option('contact_form_themes', 0) . ") ORDER BY title";
  $themes = $wpdb->get_results($query);
  html_edit_form_maker($row, $labels, $themes);
}

function save_form() {
  $count_words_in_form = count(explode("_element_section", $_POST["form"])) - count(explode("and_element_section", $_POST["form"])) + count(explode("wdform_table1", $_POST["form"]));
  if ($count_words_in_form > 9) {
    ?>
  <div class="updated"><p><strong>The free version is limited up to 5 fields to add. If you need this functionality, you
    need to buy the commercial version.</strong></p></div>
  <?php
    return FALSE;
  }
  global $wpdb;
  if ($_POST["title"] != '') {
    if (isset($_POST["label_order"]) && isset($_POST["title"]) && isset($_POST["form"])) {
      $no_slash_form = stripslashes($_POST['form']);
      $no_slash_form_front = stripslashes($_POST['form_front']);
      $javascript = "// before form is load
function before_load()
{	
}	
// before form submit
function before_submit()
{
}	
// before form reset
function before_reset()
{	
}";
      $save_or_no = $wpdb->insert($wpdb->prefix . 'formmaker', array(
          'id' => NULL,
          'title' => $_POST["title"],
          'mail' => '',
          'form' => $no_slash_form,
          'form_front' => $no_slash_form_front,
          'theme' => 1,
          'counter' => $_POST["counter"],
          'label_order' => $_POST["label_order"],
          'pagination' => $_POST["pagination"],
          'show_title' => $_POST["show_title"],
          'show_numbers' => $_POST["show_numbers"],
          'public_key' => $_POST["public_key"],
          'private_key' => $_POST["private_key"],
          'recaptcha_theme' => $_POST["recaptcha_theme"],
          'javascript' => $javascript,
          'script1' => '',
          'script2' => '',
          'script_user1' => '',
          'script_user2' => '',
          'submit_text' => '',
          'url' => '',
          'article_id' => 0,
          'submit_text_type' => 0,
          'script_mail' => '%all%',
          'script_mail_user' => '%all%',
          'label_order_current' => $_POST["label_order"],
          'tax' => 0,
          'payment_currency' => '',
          'paypal_email' => '',
          'checkout_mode' => 'testmode',
          'paypal_mode' => 0,
          'from_mail' => '',
          'from_name' => '',
        ), array(
          '%d',
          '%s',
          '%s',
          '%s',
          '%s',
          '%d',
          '%d',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%s',
          '%d',
          '%s',
          '%s',
          '%s',
          '%d',
          '%s',
          '%s',
          '%s',
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
      $id = $wpdb->get_var("SELECT MAX(id) FROM " . $wpdb->prefix . "formmaker");
      $save_or_no = $wpdb->insert($wpdb->prefix . 'formmaker_views', array(
        'form_id' => $id
        ), array(
          '%d'
        ));
      ?>
      <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
      <?php
      return TRUE;
    }
    else {
      ?>
      <h1>Error</h1>
      <?php
      exit;
    }
  }
  else {
    ?>
    <div class="updated"><p><strong><?php _e('could not save form '); ?></strong></p></div>
    <?php
  }
}

function save_as_copy() {
  global $wpdb;
  if (isset($_POST["label_order"]) && isset($_POST["title"]) && isset($_POST["form"]) && isset($_GET['id'])) {
    $no_slash_form = stripslashes($_POST['form']);
    $no_slash_form_front = stripslashes($_POST['form_front']);
    $form_id = (int) $_GET['id'];
    $row_for_sav_as_copy = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id=" . $form_id);
    $javascript = $row_for_sav_as_copy->javascript;
    $save_or_no = $wpdb->insert($wpdb->prefix . 'formmaker', array(
      'id' => NULL,
      'title' => $_POST["title"],
      'mail' => $row_for_sav_as_copy->mail,
      'form' => $no_slash_form,
      'form_front' => $no_slash_form_front,
      'theme' => $row_for_sav_as_copy->theme,
      'counter' => $_POST["counter"],
      'label_order' => $_POST["label_order"],
      'pagination' => $_POST["pagination"],
      'show_title' => $_POST["show_title"],
      'show_numbers' => $_POST["show_numbers"],
      'public_key' => $_POST["public_key"],
      'private_key' => $_POST["private_key"],
      'recaptcha_theme' => $_POST["recaptcha_theme"],
      'javascript' => $javascript,
      'script1' => $row_for_sav_as_copy->script1,
      'script2' => $row_for_sav_as_copy->script2,
      'script_user1' => $row_for_sav_as_copy->script_user1,
      'script_user2' => $row_for_sav_as_copy->script_user2,
      'submit_text' => $row_for_sav_as_copy->submit_text,
      'url' => $row_for_sav_as_copy->url,
      'article_id' => $row_for_sav_as_copy->article_id,
      'submit_text_type' => $row_for_sav_as_copy->submit_text_type,
      'script_mail' => $row_for_sav_as_copy->script_mail,
      'script_mail_user' => $row_for_sav_as_copy->script_mail_user,
      'paypal_mode' => $row_for_sav_as_copy->paypal_mode,
      'checkout_mode' => $row_for_sav_as_copy->checkout_mode,
      'paypal_email' => $row_for_sav_as_copy->paypal_email,
      'payment_currency' => $row_for_sav_as_copy->payment_currency,
      'tax' => $row_for_sav_as_copy->tax,
      'label_order_current' => $row_for_sav_as_copy->label_order_current,
      'from_mail' => $row_for_sav_as_copy->from_mail,
      'from_name' => $row_for_sav_as_copy->from_name
      ), array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%d',
        '%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%d',
        '%s',
        '%s',
        '%d',
        '%s',
        '%s',
        '%s',
        '%d',
        '%s',
        '%s',
        '%s'
      ));
    if (!$save_or_no) {
      ?>
    <div class="updated"><p><strong><?php _e('Error. Please install plugin again'); ?></strong></p></div>
    <?php
      return FALSE;
    }
    $id = $wpdb->get_var("SELECT MAX(id) FROM " . $wpdb->prefix . "formmaker");
    $save_or_no = $wpdb->insert($wpdb->prefix . 'formmaker_views', array(
        'form_id' => $id
      ), array(
        '%d'
      ));
    ?>

  <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
  <?php

    return TRUE;
  }
  else {
    ?>
  <h1>Error</h1>
  <
  <?php
    exit;
  }
}

function apply_form($id) {
  global $wpdb;
  $count_words_in_form = count(explode("_element_section", $_POST["form"])) - count(explode("and_element_section", $_POST["form"])) + count(explode("wdform_table1", $_POST["form"]));
  if ($count_words_in_form > 9) {
    ?>
  <div class="updated"><p><strong>The free version is limited up to 5 fields to add. If you need this functionality, you
    need to buy the commercial version.</strong></p></div>
  <?php
    return FALSE;
  }
  $no_slash_form = stripslashes($_POST['form']);
  $no_slash_form_front = stripslashes($_POST['form_front']);
  if ($_POST["title"] != '') {
    $savedd = $wpdb->update($wpdb->prefix . "formmaker", array(
      'title' => $_POST["title"],
      'form' => $no_slash_form,
      'form_front' => $no_slash_form_front,
      'counter' => $_POST["counter"],
      'label_order' => $_POST["label_order"],
      'label_order_current' => $_POST["label_order_current"],
      'pagination' => $_POST["pagination"],
      'show_title' => $_POST["show_title"],
      'show_numbers' => $_POST["show_numbers"],
      'public_key' => $_POST["public_key"],
      'private_key' => $_POST["private_key"],
      'recaptcha_theme' => $_POST["recaptcha_theme"],
      ), array('id' => $id), array(
        '%s',
        '%s',
        '%s',
        '%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s'
      ), array('%d'));
    ?>
    <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
    <?php
  }
  else {
    ?>
    <div class="updated"><p><strong><?php _e('could not save form'); ?></strong></p></div>
    <?php
  }
}

function remove_form($id) {
  global $wpdb;
  // If any item selected
  // Prepare sql statement, if cid array more than one,
  // will be "cid1, cid2, ..."
  // Create sql statement
  $sql_remov_form = "DELETE FROM " . $wpdb->prefix . "formmaker WHERE id='" . $id . "'";
  if (!$wpdb->query($sql_remov_form)) {
    ?>
    <div id="message" class="error"><p>Form Not Deleted</p></div>
    <?php
    return FALSE;
  }
  if ($wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker_views WHERE form_id='" . $id . "'")) {
    $sql_remov_form = "DELETE FROM " . $wpdb->prefix . "formmaker_views WHERE form_id='" . $id . "'";
    if (!$wpdb->query($sql_remov_form)) {
      ?>
      <div id="message" class="error"><p>Form views Not Deleted</p></div>
      <?php
      return FALSE;
    }
  }
  if ($wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker_submits WHERE form_id='" . $id . "'")) {
    $sql_remov_form = "DELETE FROM " . $wpdb->prefix . "formmaker_submits WHERE form_id='" . $id . "'";
    if (!$wpdb->query($sql_remov_form)) {
      ?>
      <div id="message" class="error"><p>Form submitions Not Deleted</p></div>
      <?php
      return FALSE;
    }
  }
  ?>
  <div class="updated"><p><strong><?php _e('Form Deleted.'); ?></strong></p></div>
  <?php
}

function forchrome($id) {
  ?>
  <script type="text/javascript">
    window.onload = val;
    function val() {
      document.getElementById('adminForm').action = "admin.php?page=Form_maker&task=gotoedit&id=<?php echo $id;?>";
      document.getElementById('adminForm').submit();
    }
  </script>
  <form method="post" name="adminForm" id="adminForm"></form>
  <?php
}

function gotoedit() {
  ?>
  <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
  <?php
}

// Form options.
function wd_form_options($id) {
  global $wpdb;
  $row = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id='" . $id . "'");
  $query = "SELECT * FROM " . $wpdb->prefix . "formmaker_themes ORDER BY title";
  $themes = $wpdb->get_results($query);
  html_form_options($row, $themes);
}

// Apply form options.
function Apply_form_options($id) {
  global $wpdb;
  if ($_POST["submit_text_type"] == 5) {
    $sub_te_type = $_POST["page_name"];
  }
  else {
    $sub_te_type = $_POST["post_name"];
  }
  $savedd = $wpdb->update($wpdb->prefix . "formmaker", array(
    'mail' => $_POST["mail"],
    'theme' => $_POST["theme"],
    'javascript' => stripslashes($_POST["javascript"]),
    'submit_text' => stripslashes($_POST["content"]),
    'url' => $_POST["url"],
    'submit_text_type' => $_POST["submit_text_type"],
    'script_mail' => stripslashes($_POST["script_mail"]),
    'script_mail_user' => stripslashes($_POST["script_mail_user"]),
    'article_id' => $sub_te_type,
    'paypal_mode' => 0,
    'checkout_mode' => 'testmode',
    'paypal_email' => '',
    'payment_currency' => 'USD',
    'tax' => 0,
    'from_mail' => $_POST["from_mail"],
    'from_name' => $_POST["from_name"],
  ), array('id' => $id), array(
    '%s',
    '%d',
    '%s',
    '%s',
    '%s',
    '%d',
    '%s',
    '%s',
    '%s',
    '%d',
    '%s',
    '%s',
    '%s',
    '%d',
    '%s',
    '%s',
  ), array('%d'));
  ?>
  <div class="updated"><p><strong><?php _e('Changes successfully saved'); ?></strong></p></div>
  <?php
}