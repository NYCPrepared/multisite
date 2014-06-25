<?php
if (!current_user_can('manage_options')) {
  die('Access Denied');
}
function html_add_theme($def_theme) {
  ?>
<script>

  function submitbutton(pressbutton) {

    var form = document.adminForm;
    if (form.title.value == "") {
      alert('Set Theme title');
      return;
    }

    submitform(pressbutton);
  }
  function submitform(pressbutton) {
    document.getElementById("adminForm").action = document.getElementById("adminForm").action + "&task=" + pressbutton;
    document.getElementById("adminForm").submit();
  }

</script>
<div style="font-size:14px; font-weight:bold">
  <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a>
  <br />
  This section allows you to edit form themes.
  <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">More...</a>
</div>
<table width="90%">
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
    <td width="100%"><h2>Adding New Theme</h2></td>
    <td align="right"><input type="button" onclick="submitbutton('Save')" value="Save" class="button-secondary action">
    </td>
    <td align="right"><input type="button" onclick="submitbutton('Apply')" value="Apply"
                             class="button-secondary action"></td>
    <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Form_maker_Themes'"
                             value="Cancel" class="button-secondary action"></td>
  </tr>
</table>
<form action="admin.php?page=Form_maker_Themes" method="post" id="adminForm" name="adminForm">
  <table class="admintable">


    <tr>
      <td class="key">
        <label for="title">
          Title of theme:
        </label>
      </td>
      <td>
        <input type="text" name="title" id="title" size="80"/>
      </td>
    </tr>
    <tr>
      <td class="key">
        <label for="title">
          Css:
        </label>
      </td>
      <td>
        <textarea name="css" id="css" rows=30 cols=100><?php echo $def_theme->css ?></textarea>
      </td>
    </tr>
  </table>
  <input type="hidden" name="option" value="com_formmaker"/>
  <input type="hidden" name="task" value=""/>
</form>





<?php
}

function html_show_theme($rows, $pageNav, $sort) {
  global $wpdb;
  ?>
<script language="javascript">
  function ordering(name, as_or_desc) {
    document.getElementById('asc_or_desc').value = as_or_desc;
    document.getElementById('order_by').value = name;
    document.getElementById('admin_form').submit();
  }
  function doNothing() {
    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if (keyCode == 13) {


      if (!e) var e = window.event;

      e.cancelBubble = true;
      e.returnValue = false;

      if (e.stopPropagation) {
        e.stopPropagation();
        e.preventDefault();
      }
    }
  }
</script>
<div style="font-size:14px; font-weight:bold">
  <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a>
  <br />
  This section allows you to edit form themes.
  <a href="http://web-dorado.com/wordpress-form-maker-guide-2.html" target="_blank" style="color:blue; text-decoration:none;">More...</a>
</div>
<form method="post" onkeypress="doNothing()" action="admin.php?page=Form_maker_Themes" id="admin_form"
      name="admin_form">
  <table cellspacing="10" width="100%">
    <tr>
      <td style="width:80px">
        <?php echo "<h2>" . 'Themes' . "</h2>"; ?>
      </td>
      <td style="width:90px; text-align:right;"><p class="submit" style="padding:0px; text-align:left"><input
        type="button" value="Add a Theme" name="custom_parametrs"
        onclick="window.location.href='admin.php?page=Form_maker_Themes&task=add_theme'"/></p></td>
      <td style="text-align:right;font-size:16px;padding:20px; padding-right:50px"></td>
      <td colspan="11">
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
  $serch_value = '';
  if (isset($_POST['serch_or_not'])) {
    if (esc_html($_POST['serch_or_not']) == "search") {
      $serch_value = esc_html($_POST['search_events_by_title']);
    }
    else {
      $serch_value = "";
    }
  }
  $serch_fields = '<div class="alignleft actions" style="width:180px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="' . $serch_value . '" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=Form_maker_Themes\'" class="button-secondary action">
    </div>';
  print_html_nav($pageNav['total'], $pageNav['limit'], $serch_fields);

  ?>
  <table class="wp-list-table widefat fixed pages" style="width:95%">
    <thead>
    <TR>
      <th scope="col" id="id" class="<?php if ($sort["sortid_by"] == "id")
        echo $sort["custom_style"];
      else echo $sort["default_style"]; ?>" style=" width:120px"><a
        href="javascript:ordering('id',<?php if ($sort["sortid_by"] == "id")
          echo $sort["1_or_2"];
        else echo "1"; ?>)"><span>ID</span><span class="sorting-indicator"></span></a></th>
      <th scope="col" id="title" class="<?php if ($sort["sortid_by"] == "title")
        echo $sort["custom_style"];
      else echo $sort["default_style"]; ?>" style=""><a
        href="javascript:ordering('title',<?php if ($sort["sortid_by"] == "title")
          echo $sort["1_or_2"];
        else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>
      <th>Default</th>
      <th style="width:80px">Edit</th>
      <th style="width:80px">Delete</th>
    </TR>
    </thead>
    <tbody>
      <?php for ($i = 0; $i < count($rows); $i++) { ?>
    <tr>
      <td><?php echo $rows[$i]->id; ?></td>
      <td><a
        href="admin.php?page=Form_maker_Themes&task=edit_theme&id=<?php echo $rows[$i]->id?>"><?php echo $rows[$i]->title; ?></a>
      </td>
      <td><a <?php if (!$rows[$i]->default)
        echo 'style="color:#C00"';  ?>
        href="admin.php?page=Form_maker_Themes&task=default&id=<?php echo $rows[$i]->id?>"><?php if ($rows[$i]->default)
        echo "Default";
      else echo "Not Default";  ?></a></td>
      <td><a href="admin.php?page=Form_maker_Themes&task=edit_theme&id=<?php echo $rows[$i]->id?>">Edit</a></td>
      <td><a href="admin.php?page=Form_maker_Themes&task=remove_theme&id=<?php echo $rows[$i]->id?>">Delete</a></td>
    </tr>
      <?php } ?>
    </tbody>
  </table>
  <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if (isset($_POST['asc_or_desc']))
    echo esc_html($_POST['asc_or_desc']);?>"/>
  <input type="hidden" name="order_by" id="order_by" value="<?php if (isset($_POST['order_by']))
    echo esc_html($_POST['order_by']);?>"/>

  <?php
  ?>


</form>
<?php
}

function html_edit_theme($row, $id) {
  ?>


<script>

  function submitbutton(pressbutton) {

    var form = document.adminForm;

    if (pressbutton == 'cancel_themes') {
      submitform(pressbutton);
      return;
    }
    if (form.title.value == "") {
      alert('Set Theme title');
      return;
    }

    submitform(pressbutton);
  }
  function submitform(pressbutton) {
    document.getElementById("adminForm").action = document.getElementById("adminForm").action + "&task=" + pressbutton;
    document.getElementById("adminForm").submit();
  }

</script>
<table width="90%">
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
    <td width="100%"><h2>Theme <?php echo htmlspecialchars($row->title)?></h2></td>
    <td align="right"><input type="button" onclick="submitbutton('Save')" value="Save" class="button-secondary action">
    </td>
    <td align="right"><input type="button" onclick="submitbutton('Apply')" value="Apply"
                             class="button-secondary action"></td>
    <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Form_maker_Themes'"
                             value="Cancel" class="button-secondary action"></td>
  </tr>
</table>
<form action="admin.php?page=Form_maker_Themes&id=<?php echo $id; ?>" method="post" id="adminForm" name="adminForm">
  <table class="admintable">


    <tr>
      <td class="key">
        <label for="title">
          Title of theme:
        </label>
      </td>
      <td>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row->title) ?>" size="80"/>
      </td>
    </tr>
    <tr>
      <td class="key">
        <label for="title">
          Css:
        </label>
      </td>
      <td>
        <textarea name="css" id="css" rows=30 cols=100><?php echo htmlspecialchars($row->css) ?></textarea>
      </td>
    </tr>
  </table>
  <input type="hidden" name="option" value="com_formmaker"/>
  <input type="hidden" name="id" value="<?php echo $row->id?>"/>
  <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>"/>
  <input type="hidden" name="task" value=""/>
</form>


<?php
}

function cheched($row, $y) {
  if ($row == $y) {
    echo'checked="checked"';
  }
}

?>