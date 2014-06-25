<?php
/*
Plugin Name: Form Maker
Plugin URI: http://web-dorado.com/products/form-maker-wordpress.html
Description: This plugin is a modern and advanced tool for easy and fast creating of a WordPress Form. The backend interface is intuitive and user friendly which allows users far from scripting and programming to create WordPress Forms.
Version: 1.6.7
Author: http://web-dorado.com/
License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/


function form_maker_sesseion_path() {
  @session_start();
  session_save_path(ABSPATH . 'wp-content/plugins/form-maker/session');
}
add_action('init', 'form_maker_sesseion_path');

// Css.
$first_css = ".wdform_table1
{
font-size:14px;
font-weight:normal;
color:#000000;
width:100% ;
}

.wdform_tbody1
{
float:left;
}
.wdform_table2
{
padding-right:50px !important;
float:left;
border-spacing: 0px;
border-collapse:separate !important;
}
#edit_main_table label
{
	line-height: 19px;
}
#edit_main_table td
{
padding-right: 5px;
}
.time_box
{
border-width:1px;
margin: 0px;
padding: 0px;
text-align:right;
width:30px;
vertical-align:middle
}

.mini_label
{
font-size:10px;
font-family: 'Lucida Grande', Tahoma, Arial, Verdana, sans-serif;
}

.ch_rad_label
{
display:inline;
margin-left:5px;
margin-right:15px;
float:none;
}

.label
{
border:none;
}


.td_am_pm_select
{
padding-left:5;
}

.am_pm_select
{
height: 16px;
margin:0;
padding:0
}

.input_deactive
{
color:#999999;
font-style:italic;
border-width:1px;
margin: 0px;
padding: 0px
}

.input_active
{
color:#000000;
font-style:normal;
border-width:1px;
margin: 0px;
padding: 0px
}

.required
{
border:none;
color:red
}

.captcha_img
{
border-width:0px;
margin: 0px;
padding: 0px;
cursor:pointer;


}

.captcha_refresh
{
width:30px;
height:30px;
border-width:0px;
margin: 0px;
padding: 0px;
vertical-align:middle;
cursor:pointer;
background-image: url(" . plugins_url('images/refresh_black.png', __FILE__) . ");
}

.captcha_input
{
height:20px;
border-width:1px;
margin: 0px;
padding: 0px;
vertical-align:middle;
}

.file_upload
{
border-width:1px;
margin: 0px;
padding: 0px
}    

.page_deactive
{
border:1px solid black;
padding:4px 7px 4px 7px;
margin:4px;
cursor:pointer;
background-color:#DBDBDB;
}

.page_active
{
border:1px solid black;
padding:4px 7px 4px 7px;
margin:4px;
cursor:pointer;
background-color:#878787;
}

.page_percentage_active
{
padding:0px;
margin:0px;
border-spacing: 0px;
height:30px;
line-height:30px;
background-color:yellow;
border-radius:30px;
font-size:15px;
float:left;
text-align: right !important; 
}


.page_percentage_deactive
{
height:30px;
line-height:30px;
padding:5px;
border:1px solid black;
width:100%;
background-color:white;
border-radius:30px;
text-align: left !important; 
}

.page_numbers
{
font-size:11px;
}

.phone_area_code
{
width:50px;
}

.phone_number
{
width:100px;
}";
//////////////////////////////////////////////////////////////////
require_once("front_end_form_maker.php");
require_once("form_maker_widget.php");
require_once('recaptchalib.php');

function form_maker_language_load() {
  load_plugin_textdomain('form_maker', FALSE, basename(dirname(__FILE__)) . '/languages');
}
add_action('init', 'form_maker_language_load');

function do_output_buffer() {
  ob_start();
}
add_action('init', 'do_output_buffer');

for ($ii = 0; $ii < 100; $ii++) {
  remove_filter('the_content', 'do_shortcode', $ii);
  remove_filter('the_content', 'wpautop', $ii);
}
add_filter('the_content', 'wpautop', 10);
add_filter('the_content', 'do_shortcode', 11);

function Form_maker_fornt_end_main($content) {
  $pattern = '[\[Form id="([0-9]*)"\]]';
  $count_forms_in_post = preg_match_all($pattern, $content, $matches_form);
  for ($jj = 0; $jj < $count_forms_in_post; $jj++) {
    $padron = $matches_form[0][$jj];
    $replacment = form_maker_front_end($matches_form[1][$jj]);
    $content = str_replace($padron, $replacment, $content);
  }
  return $content;
}
add_filter('the_content', 'Form_maker_fornt_end_main', 5000);

function form_maker_scripts_method() {
  wp_enqueue_style("gmap_styles_", plugins_url("css/style_for_map.css", __FILE__), FALSE);
  wp_enqueue_script("main_g_js", plugins_url("js/main_front_end.js", __FILE__), array(), '', FALSE);
  wp_enqueue_script("Calendar", plugins_url("js/calendar.js", __FILE__), FALSE);
  wp_enqueue_script("calendar-setup", plugins_url("js/calendar-setup.js", __FILE__), FALSE);
  wp_enqueue_script("calendar_function", plugins_url("js/calendar_function.js", __FILE__), FALSE);
  wp_enqueue_style("Css", plugins_url("js/calendar-jos.css", __FILE__), FALSE);
  wp_enqueue_script("jquery", plugins_url("js/jquery-1.9.1.js", __FILE__), array(), '1.9.1');
  wp_deregister_script('jquery-ui');
  wp_enqueue_script("jquery-ui", plugins_url("js/jquery-ui.js", __FILE__));
  wp_enqueue_script("jquery.ui.slider", plugins_url("js/jquery.ui.slider.js", __FILE__));
  wp_enqueue_style("jquery-ui-spinner", plugins_url("css/jquery-ui-spinner.css", __FILE__), FALSE);
}
add_action('wp_enqueue_scripts', 'form_maker_scripts_method');

// Add form maker plugin ur to head.
function form_maker_plugin_url() {
  echo "<input type='hidden' value='" . plugins_url("", __FILE__) . "' id='form_plugins_url' />";
  echo '<script type="text/javascript">
          if (document.getElementById("form_plugins_url")) {
            var plugin_url = document.getElementById("form_plugins_url").value;
          }
          else {
            var plugin_url = "";
          }
        </script>';
}
add_action('wp_head', 'form_maker_plugin_url');

// Frontend messages.
$check_seo = 0;
function print_massage($content) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if (is_plugin_active('wordpress-seo/wp-seo.php') && $_SESSION['form_submit_type']) {
    global $check_seo;
    if ($check_seo++ != 1) {
      // return;
    }
  }
  $mh_after_head = did_action('wp_enqueue_scripts');
  if ($mh_after_head == 1) {
    global $wpdb;
    @session_start();
    if (isset($_SESSION['form_submit_type']) && $_SESSION['form_submit_type']) {
      $type_and_id = $_SESSION['form_submit_type'];
      $type_and_id = explode(',', $type_and_id);
      $form_get_type = $type_and_id[0];
      $form_get_id = $type_and_id[1];
      $_SESSION['form_submit_type'] = 0;
      if ($form_get_type == 3) {
        $_SESSION['massage_after_submit'] = "";
        $row = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "formmaker WHERE id='" . $form_get_id . "'");
        return wpautop($row->submit_text);
      }
    }
    if (isset($_SESSION['massage_after_submit'])) {
      if ($_SESSION['massage_after_submit'] != "") {
        $message = $_SESSION['massage_after_submit'];
        $_SESSION['massage_after_submit'] = "";
        $returned_content = "<style>
.updated,.error{
border-width:1px !important;
border-style:solid !important;
padding:0 .6em !important;
margin:5px 15px 2px !important;
-moz-border-radius:3px !important;
-khtml-border-radius:3px !important;
-webkit-border-radius:3px !important;
border-radius:3px !important;
}
.updated p, .error p
{
font-size: 12px !important;
margin:.5em 0 !important;
line-height:1 !important;
padding:2px !important;
}
 .updated, .error
{
	margin:5px 0 15px !important;
}
.updated{
	background-color:#ffffe0 !important;
	border-color:#e6db55 !important;
}
.error
{
	background-color:#ffebe8 !important;
	border-color:#c00 !important;
}
error a
{
	color:#c00 !important;
}
.error
{
	line-height:22px !important;
	margin:0 15px !important;
	padding:3px 5px !important;
}
.error-div
{
	display:block !important;
	line-height:36px !important;
	float:right !important;
	margin-right:20px !important;
}
</style>";
        if ($_SESSION['error_or_no']) {
          $error = 'error';
        }
        else {
          $error = 'updated';
        }
        $returned_content .= "<div class=\"" . $error . "\" ><p><strong>" . $message . "</strong></p></div>" . $content; // modified content
        return $returned_content;
      }
      else {
        return $content;
      }
    }
    else {
      return $content;
    }
  }
  else {
    return $content;
  }
}

add_filter('the_content', 'print_massage');
///////////////////////////// FORNT END FUNCTION  
//// add front end
//// add editor new mce button
add_filter('mce_external_plugins', "Form_Maker_register");
add_filter('mce_buttons', 'Form_Maker_add_button', 0);

/// function for add new button
function Form_Maker_add_button($buttons) {
  array_push($buttons, "Form_Maker_mce");
  return $buttons;
}

/// function for registr new button
function Form_Maker_register($plugin_array) {
  $url = plugins_url('js/editor_plugin.js', __FILE__);
  $plugin_array["Form_Maker_mce"] = $url;
  return $plugin_array;
}

// Add ajax for form maker.
require_once("form_ajax_functions.php");
add_action('wp_ajax_formmakergeneretexml', 'form_maker_generete_xml'); // Export xml.
add_action('wp_ajax_nopriv_formmakergeneretexml', 'form_maker_generete_xml'); // Export xml for all users.
add_action('wp_ajax_formmakergeneretecsv', 'form_maker_generete_csv'); // Export csv.
add_action('wp_ajax_nopriv_formmakergeneretecsv', 'form_maker_generete_csv'); // Export csv for all users.
add_action('wp_ajax_formmakerwdcaptcha', 'form_maker_wd_captcha'); // Generete captcha image and save it code in session.
add_action('wp_ajax_nopriv_formmakerwdcaptcha', 'form_maker_wd_captcha'); // Generete captcha image and save it code in session for all users.
add_action('wp_ajax_formmakerwindow', 'form_maker_window_php'); // Open window in post or page for editor.
add_action('wp_ajax_nopriv_formmakerwindow', 'form_maker_window_php'); // Open window in post or page for editor for all users.
add_action('wp_ajax_fromeditcountryinpopup', 'spider_form_country_edit'); // Open country list.
add_action('wp_ajax_form_preview_product_option', 'form_maker_form_preview_product_option');

function spider_form_country_edit() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  if (isset($_GET['field_id'])) {
    $id = (int)$_GET['field_id'];
  }
  else {
    echo "<h2>error cannot get fild id</h2>";
    return;
  }
  html_spider_form_country_edit($id);
}

function html_spider_form_country_edit($id) {
  wp_print_scripts('jquery');
  wp_print_scripts('jquery-ui-core');
  wp_print_scripts('jquery-ui-widget');
  wp_print_scripts('jquery-ui-mouse');
  wp_print_scripts('jquery-ui-slider');
  wp_print_scripts('jquery-ui-sortable');


  ?>

<span style=" position: absolute;right: 29px;">
<img alt="ADD" title="add" style="cursor:pointer; vertical-align:middle; margin:5px; "
     src="<?php echo  plugins_url('images/save.png', __FILE__); ?>" onclick="save_list()">
<img alt="CANCEL" title="cancel" style=" cursor:pointer; vertical-align:middle; margin:5px; "
     src="<?php echo  plugins_url('images/cancel_but.png', __FILE__); ?>" onclick="window.parent.tb_remove();">
</span>
<button onclick="select_all()">Select all</button>
<button onclick="remove_all()">Remove all</button>
<ul id="countries_list" style="list-style:none; padding:0px">
</ul>

<script>


  selec_coutries = [];

  coutries = ["", "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Central African Republic", "Chad", "Chile", "China", "Colombi", "Comoros", "Congo (Brazzaville)", "Congo", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor (Timor Timur)", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia, The", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepa", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia and Montenegro", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"];

  select_ = window.parent.document.getElementById('<?php echo $id ?>_elementform_id_temp');
  n = select_.childNodes.length;
  for (i = 0; i < n; i++) {

    selec_coutries.push(select_.childNodes[i].value);
    var ch = document.createElement('input');
    ch.setAttribute("type", "checkbox");
    ch.setAttribute("checked", "checked");
    ch.value = select_.childNodes[i].value;
    ch.id = i + "ch";
    //ch.setAttribute("id",i);


    var p = document.createElement('span');
    p.style.cssText = "color:#000000; font-size: 13px; cursor:move";
    p.innerHTML = select_.childNodes[i].value;

    var li = document.createElement('li');
    li.style.cssText = "margin:3px; vertical-align:middle";
    li.id = i;

    li.appendChild(ch);
    li.appendChild(p);

    document.getElementById('countries_list').appendChild(li);
  }
  cur = i;
  m = coutries.length;
  for (i = 0; i < m; i++) {
    isin = isValueInArray(selec_coutries, coutries[i]);

    if (!isin) {
      var ch = document.createElement('input');
      ch.setAttribute("type", "checkbox");
      ch.value = coutries[i];
      ch.id = cur + "ch";


      var p = document.createElement('span');
      p.style.cssText = "color:#000000; font-size: 13px; cursor:move";
      p.innerHTML = coutries[i];

      var li = document.createElement('li');
      li.style.cssText = "margin:3px; vertical-align:middle";
      li.id = cur;

      li.appendChild(ch);
      li.appendChild(p);

      document.getElementById('countries_list').appendChild(li);
      cur++;
    }
  }
  jQuery(function () {
    jQuery("#countries_list").sortable();
    jQuery("#countries_list").disableSelection();
  });

  function isValueInArray(arr, val) {
    inArray = false;
    for (x = 0; x < arr.length; x++)
      if (val == arr[x])
        inArray = true;
    return inArray;
  }
  function save_list() {
    select_.innerHTML = ""
    ul = document.getElementById('countries_list');
    n = ul.childNodes.length;
    for (i = 0; i < n; i++) {
      if (ul.childNodes[i].tagName == "LI") {
        id = ul.childNodes[i].id;
        if (document.getElementById(id + 'ch').checked) {
          var option_ = document.createElement('option');
          option_.setAttribute("value", document.getElementById(id + 'ch').value);
          option_.innerHTML = document.getElementById(id + 'ch').value;

          select_.appendChild(option_);
        }

      }


    }
    window.parent.tb_remove();


  }

  function select_all() {
    for (i = 0; i < 194; i++) {
      document.getElementById(i + 'ch').checked = true;
      ;
    }
  }

  function remove_all() {
    for (i = 0; i < 194; i++) {
      document.getElementById(i + 'ch').checked = false;
      ;
    }
  }
</script>




<?php
}

function add_button_style1() {
  echo '<style type="text/css">
.wp_themeSkin span.mce_Form_Maker_mce {background:url(' . plugins_url('images/formmakerLogo.png', __FILE__) . ') no-repeat !important;}
.wp_themeSkin .mceButtonEnabled:hover span.mce_Form_Maker_mce,.wp_themeSkin .mceButtonActive span.mce_Form_Maker_mce
{background:url(' . plugins_url('images/formmakerLogoHover.png', __FILE__) . ') no-repeat !important;}
</style>';
}

add_action('admin_head', 'add_button_style1');
add_action('admin_menu', 'Form_maker_options_panel');
function Form_maker_options_panel() {
  $icon_url = plugins_url('images/FormMakerLogo-16.png', __FILE__);
  add_menu_page('Theme page title', 'Form Maker', 'manage_options', 'Form_maker', 'Manage_Form_maker', $icon_url);
  $page_form = add_submenu_page('Form_maker', 'Form Maker Manager', 'Manager', 'manage_options', 'Form_maker', 'Manage_Form_maker');
  $page_submits = add_submenu_page('Form_maker', 'Form Maker  submissions', 'Submissions', 'manage_options', 'Form_maker_Submits', 'Form_maker_Submits');
  add_submenu_page('Form_maker', 'Form Maker  Themes', 'Themes', 'manage_options', 'Form_maker_Themes', 'Form_maker_Themes');
  add_submenu_page('Form_maker', 'Licensing/Donation', 'Licensing/Donation', 'manage_options', 'form_maker_Licensing', 'form_maker_Licensing');
  $Featured_Plugins = add_submenu_page('Form_maker', 'Featured Plugins', 'Featured Plugins', 'manage_options', 'form_maker_Featured_Plugins', 'form_maker_Featured_Plugins');
  add_submenu_page('Form_maker', 'Uninstall Form Maker ', 'Uninstall Form Maker', 'manage_options', 'Uninstall_Form_Maker', 'Uninstall_Form_Maker');
  add_action('admin_print_styles-' . $Featured_Plugins, 'form_maker_Featured_Plugins_styles');
  add_action('admin_print_styles-' . $page_form, 'form_maker_admin_styles_scripts');
  add_action('admin_print_styles-' . $page_submits, 'form_maker_submits_styles_scripts');
}

function form_maker_Featured_Plugins_styles() {
  wp_enqueue_style("Featured_Plugins", plugins_url("css/featured_plugins.css", __FILE__));
}
function form_maker_Featured_Plugins() {
  ?>
	<div id="main_featured_plugins_page">
		<table align="center" width="90%" style="margin-top: 0px;border-bottom: rgb(111, 111, 111) solid 2px;">
			<tr>
				<td colspan="2" style="height: 70px;"><h3 style="margin: 0px;font-family:Segoe UI;padding-bottom: 15px;color: rgb(111, 111, 111); font-size:18pt;">Featured Plugins</h3></td>
				<td  align="right" style="font-size:16px;">
                           <a href="http://web-dorado.com/files/fromFormMaker.php" target="_blank" style="color:red; text-decoration:none;">
                              <img src="<?php echo plugins_url('images/header.png', __FILE__); ?>" border="0" alt="www.web-dorado.com" width="215"><br>
                                 Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
                           </a>
                </td>
			</tr>
		</table>
		<form method="post">
			<ul id="featured-plugins-list">
				<li class="spider-calendar">
					<div class="product">
						<div class="title">
							<strong class="heading">Spider Calendar</strong>
							<p>WordPress event calendar plugin</p>
						</div>
					</div>
					<div class="description">
							<p>Spider Event Calendar is a highly configurable product which allows you to have multiple organized events.</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-calendar.html" class="download">Download</a>
					</div>
				</li>
        <li class="catalog">
					<div class="product">
						<div class="title">
							<strong class="heading">Spider Catalog</strong>
							<p>WordPress product catalog plugin</p>
						</div>
					</div>
					<div class="description">
							<p>Spider Catalog for WordPress is a convenient tool for organizing the products represented on your website into catalogs.</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-catalog.html" class="download">Download</a>
					</div>
				</li>
        <li class="player">
					<div class="product">
						<div class="title">
							<strong class="heading">Video Player</strong>
							<p>WordPress Video player plugin</p>
						</div>
					</div>
					<div class="description">
							<p>Spider Video Player for WordPress is a Flash & HTML5 video player plugin that allows you to easily add videos to your website with the possibility</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-player.html" class="download">Download</a>
					</div>
				</li>
        <li class="contacts">
					<div class="product">
						<div class="title">
							<strong class="heading">Spider Contacts</strong>
							<p>Wordpress staff list plugin</p>
						</div>
					</div>
					<div class="description">
							<p>Spider Contacts helps you to display information about the group of people more intelligible, effective and convenient.</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-contacts-plugin.html" class="download">Download</a>
					</div>
				</li>
        <li class="facebook">
					<div class="product">
						<div class="title">
							<strong class="heading">Spider Facebook</strong>
							<p>WordPress Facebook plugin</p>
						</div>
					</div>
					<div class="description">
							<p>Spider Facebook is a WordPress integration tool for Facebook.It includes all the available Facebook social plugins and widgets to be added to your web</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-facebook.html" class="download">Download</a>
					</div>
				</li>
                <li class="faq">
					<div class="product">
						<div class="title">
							<strong class="heading">Spider FAQ</strong>
							<p>WordPress FAQ Plugin</p>
						</div>
					</div>
					<div class="description">
							<p>The Spider FAQ WordPress plugin is for creating an FAQ (Frequently Asked Questions) section for your website.</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-faq-plugin.html" class="download">Download</a>
					</div>
				</li>
                <li class="zoom">
					<div class="product">
						<div class="title">
							<strong class="heading">Zoom</strong>
							<p>WordPress text zoom plugin</p>
						</div>
					</div>
					<div class="description">
							<p>Zoom enables site users to resize the predefined areas of the web site.</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-zoom.html" class="download">Download</a>
					</div>
				</li>
				<li class="flash-calendar">
					<div class="product">
						<div class="title">
							<strong class="heading">Flash Calendar</strong>
							<p>WordPress flash calendar plugin</p>
						</div>
					</div>
					<div class="description">
							<p>Spider Flash Calendar is a highly configurable Flash calendar plugin which allows you to have multiple organized events.</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-events-calendar.html" class="download">Download</a>
					</div>
				</li>
				<li class="contact-maker">
					<div class="product">
						<div class="title">
							<strong class="heading">Contact Form Maker</strong>
							<p>WordPress contact form builder plugin</p>
						</div>
					</div>
					<div class="description">
							<p>WordPress Contact Form Maker is an advanced and easy-to-use tool for creating forms.</p>
							<a target="_blank" href="http://web-dorado.com/products/wordpress-contact-form-maker-plugin.html" class="download">Download</a>
					</div>
				</li>
			</ul>
		</form>
	</div >
  <?php
}

function form_maker_Licensing() {
  ?>
<div style="width:95%">
  <p>This plugin is the non-commercial version of the Form Maker. Use of this plugin is free. You can add not more than 7 fields. The limitation is on the some types of the fields (File Upload, Map and Paypal). If you want to use those fields, you are required to purchase a license. </p>
  <br/>
  <a href="http://web-dorado.com/files/fromFormMaker.php" class="button-primary" target="_blank">Purchase a License</a>
  <br/><br/>
  <p>After the purchasing the commercial version follow this steps:</p>
  <ol>
    <li>Deactivate Form Maker Plugin</li>
    <li>Delete Form Maker Plugin</li>
    <li>Install the downloaded commercial version of the plugin</li>
  </ol>
  <br/>
  <p>If you enjoy using Form Maker and find it useful, please consider making a donation. Your donation will help encourage and support the plugin's continued development and better user support.</p>
  <br/>
  <a href="http://web-dorado.com/files/donate_redirect.php" target="_blank"><img src="<?php echo plugins_url('images/btn_donateCC_LG.gif', __FILE__); ?>" /></a>
</div>
<?php
}

function form_maker_submits_styles_scripts() {
  wp_enqueue_script('word-count');
  wp_enqueue_script('post');
  wp_enqueue_script('editor');
  wp_enqueue_script('media-upload');
  wp_admin_css('thickbox');
  wp_print_scripts('media-upload');
  do_action('admin_print_styles');
  wp_enqueue_script('common');
  wp_enqueue_script('jquery-color');
  wp_enqueue_script('utils');
  wp_enqueue_script("main", plugins_url("js/main.js", __FILE__));
  wp_enqueue_script("mootools", plugins_url("js/mootools.js", __FILE__));
  wp_enqueue_script("f_calendar", plugins_url("js/calendar.js", __FILE__));
  wp_enqueue_script("f_calendar_functions", plugins_url("js/calendar_function.js", __FILE__));
  wp_enqueue_script("f_calendar_setup", plugins_url("js/calendar-setup.js", __FILE__));
  wp_enqueue_style("calendar-jos", plugins_url("js/calendar-jos.css", __FILE__));
  wp_enqueue_script("jquery", plugins_url("js/jquery-1.9.1.js", __FILE__), array(), '1.9.1');
  wp_deregister_script('jquery-ui');
  wp_enqueue_script("jquery-ui", plugins_url("js/jquery-ui.js", __FILE__));
  wp_enqueue_style("jquery-ui-spinner", plugins_url("css/jquery-ui-spinner.css", __FILE__), FALSE);
  wp_enqueue_script("jquery.ui.slider", plugins_url("js/jquery.ui.slider.js", __FILE__));
  
}

function form_maker_admin_styles_scripts() {
  if (isset($_GET['task'])) {
    if (esc_html($_GET['task']) == "update" || esc_html($_GET['task']) == "save_update" || esc_html($_GET['task']) == "gotoedit" || esc_html($_GET['task']) == "add_form" || esc_html($_GET['task']) == "edit_form" || esc_html($_GET['task']) == "form_options") {
      wp_enqueue_script('word-count');
      wp_enqueue_script('post');
      wp_enqueue_script('editor');
      wp_enqueue_script('media-upload');
      wp_admin_css('thickbox');
      wp_print_scripts('media-upload');
      do_action('admin_print_styles');
      wp_enqueue_script('common');
      wp_enqueue_script('jquery-color');
      if (get_bloginfo('version') < '3.3') {
        if (function_exists('add_thickbox'))
          add_thickbox();
        if (function_exists('wp_tiny_mce'))
          wp_tiny_mce();
      }
      wp_enqueue_script('utils');
      wp_enqueue_script("main", plugins_url("js/main.js", __FILE__));
      wp_enqueue_script("form_main_js", plugins_url("js/formmaker_free.js", __FILE__));
      wp_enqueue_script("gmap_form_api", 'http://maps.google.com/maps/api/js?sensor=false');
      wp_enqueue_style("styles_form", plugins_url("css/style.css", __FILE__));
      wp_enqueue_script("mootools", plugins_url("js/mootools.js", __FILE__));
      wp_enqueue_script("f_calendar", plugins_url("js/calendar.js", __FILE__));
      wp_enqueue_script("f_calendar_functions", plugins_url("js/calendar_function.js", __FILE__));
      wp_enqueue_script("f_calendar_setup", plugins_url("js/calendar-setup.js", __FILE__));
      wp_enqueue_style("calendar-jos", plugins_url("js/calendar-jos.css", __FILE__));
      wp_enqueue_script("jquery", plugins_url("js/jquery-1.9.1.js", __FILE__), array(), '1.9.1');
      wp_deregister_script('jquery-ui');
      wp_enqueue_script("jquery-ui", plugins_url("js/jquery-ui.js", __FILE__));
      wp_enqueue_script("jquery.ui.slider", plugins_url("js/jquery.ui.slider.js", __FILE__));
      wp_enqueue_style("jquery-ui-spinner", plugins_url("css/jquery-ui-spinner.css", __FILE__), FALSE);
    }
  }
}

function Manage_Form_maker() {
  require_once("form_maker_functions.php");
  require_once("form_maker_functions.html.php");
  if (!function_exists('print_html_nav')) {
    require_once("nav_function/nav_html_func.php");
  }
  global $wpdb;
  if (isset($_GET["task"])) {
    $task = esc_html($_GET["task"]);
  }
  else {
    $task = "show";
  }
  if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
  }
  else {
    $id = 0;
  }
  switch ($task) {
    case 'update':
      update_form_maker();
      break;
    case 'save_update':
      save_update_form_maker();
      break;
    case 'update_complite':
      update_complete();
      display_form_lists();
      break;
    case "add_form" :
      add_form();
      break;
    case "edit_form" :
      edit_form_maker($id);
      break;
    case "Save" :
      if ($id) {
        apply_form($id);
      }
      else {
        save_form();
      }
      display_form_lists();
      break;
    case "Apply" :
      if ($id) {
        apply_form($id);
      }
      else {
        save_form();
        $id = $wpdb->get_var("SELECT MAX(id) FROM " . $wpdb->prefix . "formmaker");
      }
      forchrome($id);
      break;
    case "gotoedit" :
      gotoedit();
      edit_form_maker($id);
      break;
    case "remove_form" :
      remove_form($id);
      display_form_lists();
      break;
    // Form options.
    case "form_options" :
      if ($id) {
        apply_form($id);
      }
      else {
        save_form();
        $id = $wpdb->get_var("SELECT MAX(id) FROM " . $wpdb->prefix . "formmaker");
      }
      wd_form_options($id);
      break;
    case "Save_form_options" :
      Apply_form_options($id);
      forchrome($id);
      break;
    case "Apply_form_options" :
      Apply_form_options($id);
      wd_form_options($id);
      break;
    case "save_as_copy":
      save_as_copy();
      display_form_lists();
      break;
    default:
      display_form_lists();
  }
}

// Open map in submissions.
add_action('wp_ajax_frommapeditinpopup', 'spider_form_map_edit');
function spider_form_map_edit() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  if (isset($_GET['long']) && isset($_GET['lat'])) {
    $long = esc_html($_GET['long']);
    $lat = esc_html($_GET['lat']);
    ?>
  <script src="<?php echo plugins_url("js/if_gmap_back_end.js", __FILE__); ?>"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <table style="margin:0px; padding:0px">
    <tr>
      <td><b>Address:</b></td>
      <td><input type="text" id="addrval0" style="border:0px; background:none" size="80" readonly/></td>
    </tr>
    <tr>
      <td><b>Longitude:</b></td>
      <td><input type="text" id="longval0" style="border:0px; background:none" size="80" readonly/></td>
    </tr>
    <tr>
      <td><b>Latitude:</b></td>
      <td><input type="text" id="latval0" style="border:0px; background:none" size="80" readonly/></td>
    </tr>
  </table>

  <div id="0_elementform_id_temp" long="<?php echo $long ?>" center_x="<?php echo $long ?>" center_y="<?php echo $lat ?>" lat="<?php echo $lat ?>" zoom="8" info="" style="width:600px; height:500px; "></div>
  <script>
    if_gmap_init("0");
    add_marker_on_map(0, 0, "<?php echo $long ?>", "<?php echo $lat ?>", '');
  </script>
  <?php
    die();
  }
  else {
    return 0;
  }
}

// Open map in submissions.
add_action('wp_ajax_show_matrix', 'spider_form_show_matrix');
function spider_form_show_matrix() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  if (isset($_GET['matrix_params'])) {
    $matrix_params = esc_html($_GET['matrix_params']);
    $new_filename = str_replace("***matrix***", '', $matrix_params);
    $new_filename = explode('***', $matrix_params);
    $mat_params = array_slice($new_filename, 0, count($new_filename) - 1);
    $mat_rows = $mat_params[0];
    $mat_columns = $mat_params[$mat_rows + 1];
    $matrix = '<table>';
    $matrix .= '<tr><td></td>';
    for ($k = 1; $k <= $mat_columns; $k++) {
      $matrix .= '<td style="background-color:#BBBBBB; padding:5px;">' . $mat_params[$mat_rows + 1 + $k] . '</td>';
    }
    $matrix .= '</tr>';
    $aaa = Array();
    $var_checkbox = 1;
    for ($k = 1; $k <= $mat_rows; $k++) {
      $matrix .='<tr><td style="background-color:#BBBBBB; padding:5px; ">'.$mat_params[$k].'</td>';
      if ($mat_params[$mat_rows + $mat_columns + 2] == "radio") {
        if ($mat_params[$mat_rows + $mat_columns + 2 + $k] == 0) {
          $checked = 0;
          $aaa[1] = "";
        }
        else {
          $aaa = explode("_", $mat_params[$mat_rows + $mat_columns + 2 + $k]);
        }
        for ($l = 1; $l <= $mat_columns; $l++) {
          if ($aaa[1] == $l) {
            $checked = "checked";
          }
          else {
            $checked = "";
          }
          $matrix .= '<td style="text-align:center"><input type="radio" ' . $checked . ' disabled /></td>';
        }
      }
      else {
        if ($mat_params[$mat_rows + $mat_columns + 2] == "checkbox") {
          for ($l = 1; $l <= $mat_columns; $l++) {
            if ($mat_params[$mat_rows+$mat_columns + 2 + $var_checkbox] == "1") {
              $checked = "checked";
            }
            else {
              $checked = "";
            }
            $matrix .= '<td style="text-align:center"><input type="checkbox" ' . $checked . ' disabled /></td>';
            $var_checkbox++;
          }
        }
        else {
          if ($mat_params[$mat_rows + $mat_columns + 2] == "text") {
            for ($l = 1; $l <= $mat_columns; $l++) {
              $checked = $mat_params[$mat_rows + $mat_columns + 2 + $var_checkbox];
              $matrix .= '<td style="text-align:center"><input type="text" value="' . $checked . '" disabled /></td>';
              $var_checkbox++;
            }
          }
          else {
            for ($l = 1; $l <= $mat_columns; $l++) {
              $checked = $mat_params[$mat_rows + $mat_columns + 2 + $var_checkbox];
              $matrix .= '<td style="text-align:center">' . $checked . '</td>';
              $var_checkbox++;
            }
          }
        }
      }
      $matrix .= '</tr>';
    }
    $matrix .= '</table>';
		echo $matrix;
    die();
  }
  else {
    return 0;
  }
}

// Form preview.
add_action('wp_ajax_frommakerpreview', 'preview_formmaker');
function html_preview_formmaker($css) {
  echo "<input type='hidden' value='" . plugins_url("", __FILE__) . "' id='form_plugins_url' />";
  echo '<script type="text/javascript">
          if (document.getElementById("form_plugins_url")) {
            var plugin_url = document.getElementById("form_plugins_url").value;
          }
          else {
            var plugin_url = "";
          }
        </script>';
  $cmpnt_js_path = plugins_url('js', __FILE__);
  $id = 'form_id_temp';
  ?>
<script src="<?php echo $cmpnt_js_path . "/if_gmap_back_end.js"; ?>"></script>
<script src="<?php echo $cmpnt_js_path . "/main.js"; ?>"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo $cmpnt_js_path . "/jquery-1.9.1.js"; ?>"></script>
<script src="<?php echo $cmpnt_js_path . "/jquery-ui.js"; ?>"></script>
<script src="<?php echo $cmpnt_js_path . "/jquery.ui.slider.js"; ?>"></script>
<script src="<?php echo $cmpnt_js_path . "/main_front_end.js"; ?>"></script>
<link media="all" type="text/css" href="<?php echo plugins_url('', __FILE__) . "/css/jquery-ui-spinner.css"; ?>" rel="stylesheet">
<style>
    <?php
    $cmpnt_js_path = plugins_url('', __FILE__);
    echo str_replace('[SITE_ROOT]', $cmpnt_js_path, $css);
    ?>
</style>
<div id="form_id_temppages" class="wdform_page_navigation" show_title="" show_numbers="" type=""></div>

<form id="form_preview"></form>
<input type="hidden" id="counter<?php echo $id ?>" value="" name="counter<?php echo $id ?>"/>

<script>
JURI_ROOT = '<?php echo $cmpnt_js_path ?>';

document.getElementById('form_preview').innerHTML = window.parent.document.getElementById('take').innerHTML;
document.getElementById('form_id_temppages').setAttribute('show_title', window.parent.document.getElementById('pages').getAttribute('show_title'));
document.getElementById('form_id_temppages').setAttribute('show_numbers', window.parent.document.getElementById('pages').getAttribute('show_numbers'));
document.getElementById('form_id_temppages').setAttribute('type', window.parent.document.getElementById('pages').getAttribute('type'));
document.getElementById('counterform_id_temp').value = window.parent.gen;
form_view_count<?php echo $id ?>= 0;
for (i = 1; i <= 30; i++) {
  if (document.getElementById('<?php echo $id ?>form_view' + i)) {
    form_view_count<?php echo $id ?>++;
    form_view_max<?php echo $id ?>= i;
    document.getElementById('<?php echo $id ?>form_view' + i).parentNode.removeAttribute('style');
  }
}

refresh_first();


if (form_view_count<?php echo $id ?>> 1) {
  for (i = 1; i <= form_view_max<?php echo $id ?>; i++) {
    if (document.getElementById('<?php echo $id ?>form_view' + i)) {
      first_form_view<?php echo $id ?>= i;
      break;
    }
  }

  generate_page_nav(first_form_view<?php echo $id ?>, '<?php echo $id ?>', form_view_count<?php echo $id ?>, form_view_max<?php echo $id ?>);
}


function remove_add_(id) {
  attr_name = new Array();
  attr_value = new Array();
  var input = document.getElementById(id);
  atr = input.attributes;
  for (v = 0; v < 30; v++)
    if (atr[v]) {
      if (atr[v].name.indexOf("add_") == 0) {
        attr_name.push(atr[v].name.replace('add_', ''));
        attr_value.push(atr[v].value);
        input.removeAttribute(atr[v].name);
        v--;
      }
    }
  for (v = 0; v < attr_name.length; v++) {
    input.setAttribute(attr_name[v], attr_value[v])
  }
}

function refresh_first() {
  n = window.parent.gen;
  for (i = 0; i < n; i++) {
    if (document.getElementById(i)) {
      for (z = 0; z < document.getElementById(i).childNodes.length; z++)
        if (document.getElementById(i).childNodes[z].nodeType == 3)
          document.getElementById(i).removeChild(document.getElementById(i).childNodes[z]);

      if (document.getElementById(i).getAttribute('type') == "type_map") {
        if_gmap_init(i);
        for (q = 0; q < 20; q++)
          if (document.getElementById(i + "_elementform_id_temp").getAttribute("long" + q)) {

            w_long = parseFloat(document.getElementById(i + "_elementform_id_temp").getAttribute("long" + q));
            w_lat = parseFloat(document.getElementById(i + "_elementform_id_temp").getAttribute("lat" + q));
            w_info = parseFloat(document.getElementById(i + "_elementform_id_temp").getAttribute("info" + q));
            add_marker_on_map(i, q, w_long, w_lat, w_info, false);
          }
      }

      if (document.getElementById(i).getAttribute('type') == "type_mark_map") {
        if_gmap_init(i);
        w_long = parseFloat(document.getElementById(i + "_elementform_id_temp").getAttribute("long" + 0));
        w_lat = parseFloat(document.getElementById(i + "_elementform_id_temp").getAttribute("lat" + 0));
        w_info = parseFloat(document.getElementById(i + "_elementform_id_temp").getAttribute("info" + 0));
        add_marker_on_map(i, 0, w_long, w_lat, w_info, true);
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
          if(document.getElementById(i+"_disable_fieldsform_id_temp").getAttribute('street1')=='no')
            remove_add_(i+"_street1form_id_temp");
          if(document.getElementById(i+"_disable_fieldsform_id_temp").getAttribute('street2')=='no')	
            remove_add_(i+"_street2form_id_temp");
          if(document.getElementById(i+"_disable_fieldsform_id_temp").getAttribute('city')=='no')
            remove_add_(i+"_cityform_id_temp");
          if(document.getElementById(i+"_disable_fieldsform_id_temp").getAttribute('state')=='no')
            remove_add_(i+"_stateform_id_temp");
          if(document.getElementById(i+"_disable_fieldsform_id_temp").getAttribute('postal')=='no')
            remove_add_(i+"_postalform_id_temp");
          if(document.getElementById(i+"_disable_fieldsform_id_temp").getAttribute('country')=='no')
            remove_add_(i+"_countryform_id_temp");

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
							
							var spinner_value = document.getElementById(i+"_elementform_id_temp").getAttribute( "aria-valuenow" );
							var spinner_min_value = document.getElementById(i+"_min_valueform_id_temp").value;
							var spinner_max_value = document.getElementById(i+"_max_valueform_id_temp").value;
							var spinner_step = document.getElementById(i+"_stepform_id_temp").value;
								  
									 jQuery( "#"+i+"_elementform_id_temp" ).removeClass( "ui-spinner-input" )
							.prop( "disabled", false )
							.removeAttr( "autocomplete" )
							.removeAttr( "role" )
							.removeAttr( "aria-valuemin" )
							.removeAttr( "aria-valuemax" )
							.removeAttr( "aria-valuenow" );
				
							span_ui= document.getElementById(i+"_elementform_id_temp").parentNode;
								span_ui.parentNode.appendChild(document.getElementById(i+"_elementform_id_temp"));
								span_ui.parentNode.removeChild(span_ui);
								
								jQuery("#"+i+"_elementform_id_temp")[0].spin = null;
								
								spinner = jQuery( "#"+i+"_elementform_id_temp" ).spinner();
								spinner.spinner( "value", spinner_value );
								jQuery( "#"+i+"_elementform_id_temp" ).spinner({ min: spinner_min_value});    
								jQuery( "#"+i+"_elementform_id_temp" ).spinner({ max: spinner_max_value});
								jQuery( "#"+i+"_elementform_id_temp" ).spinner({ step: spinner_step});
									break;
						}
						
								case "type_slider":
						{	
								remove_add_(i+"_elementform_id_temp");	
								
							var slider_value = document.getElementById(i+"_slider_valueform_id_temp").value;
							var slider_min_value = document.getElementById(i+"_slider_min_valueform_id_temp").value;
							var slider_max_value = document.getElementById(i+"_slider_max_valueform_id_temp").value;
							
							var slider_element_value = document.getElementById( i+"_element_valueform_id_temp" );
							var slider_value_save = document.getElementById( i+"_slider_valueform_id_temp" );
					
							document.getElementById(i+"_elementform_id_temp").innerHTML = "";
							document.getElementById(i+"_elementform_id_temp").removeAttribute( "class" );
							document.getElementById(i+"_elementform_id_temp").removeAttribute( "aria-disabled" );
							jQuery("#"+i+"_elementform_id_temp")[0].slide = null;	
							
							
							jQuery( "#"+i+"_elementform_id_temp").slider({
								range: "min",
								value: eval(slider_value),
								min: eval(slider_min_value),
								max: eval(slider_max_value),
								slide: function( event, ui ) {	
									slider_element_value.innerHTML = "" + ui.value ;
									slider_value_save.value = "" + ui.value; 

								}
							});
                         break;
						}
								case "type_range":
						{	
							remove_add_(i+"_elementform_id_temp0");
							remove_add_(i+"_elementform_id_temp1");
						
							var spinner_value0 = document.getElementById(i+"_elementform_id_temp0").getAttribute( "aria-valuenow" );
							var spinner_step = document.getElementById(i+"_range_stepform_id_temp").value;
								  
									 jQuery( "#"+i+"_elementform_id_temp0" ).removeClass( "ui-spinner-input" )
							.prop( "disabled", false )
							.removeAttr( "autocomplete" )
							.removeAttr( "role" )
							.removeAttr( "aria-valuenow" );
							
							span_ui= document.getElementById(i+"_elementform_id_temp0").parentNode;
								span_ui.parentNode.appendChild(document.getElementById(i+"_elementform_id_temp0"));
								span_ui.parentNode.removeChild(span_ui);
							
							jQuery("#"+i+"_elementform_id_temp0")[0].spin = null;
							jQuery("#"+i+"_elementform_id_temp1")[0].spin = null;
							
							
							spinner0 = jQuery( "#"+i+"_elementform_id_temp0" ).spinner();
							spinner0.spinner( "value", spinner_value0 );
							jQuery( "#"+i+"_elementform_id_temp0" ).spinner({ step: spinner_step});
							var spinner_value1 = document.getElementById(i+"_elementform_id_temp1").getAttribute( "aria-valuenow" );
              jQuery( "#"+i+"_elementform_id_temp1" ).removeClass( "ui-spinner-input" )
							.prop( "disabled", false )
							.removeAttr( "autocomplete" )
							.removeAttr( "role" )
							.removeAttr( "aria-valuenow" );
							
							span_ui1= document.getElementById(i+"_elementform_id_temp1").parentNode;
							span_ui1.parentNode.appendChild(document.getElementById(i+"_elementform_id_temp1"));
							span_ui1.parentNode.removeChild(span_ui1);
							
							spinner1 = jQuery( "#"+i+"_elementform_id_temp1" ).spinner();
							spinner1.spinner( "value", spinner_value1 );
							jQuery( "#"+i+"_elementform_id_temp1" ).spinner({ step: spinner_step});
				
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
      }
    }
  }


  for (t = 1; t <= form_view_max<?php echo $id ?>; t++) {
    if (document.getElementById('form_id_tempform_view' + t)) {
      form_view_element = document.getElementById('form_id_tempform_view' + t);
      xy = form_view_element.childNodes.length - 2;
      for (z = 0; z <= xy; z++) {
        if (form_view_element.childNodes[z])
          if (form_view_element.childNodes[z].nodeType != 3)
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


  for (i = 1; i <= window.parent.form_view_max; i++)
    if (document.getElementById('form_id_tempform_view' + i)) {
      document.getElementById('form_id_tempform_view' + i).parentNode.removeChild(document.getElementById('form_id_tempform_view_img' + i));
      document.getElementById('form_id_tempform_view' + i).removeAttribute('style');
    }

}


</script>
<?php
  die();
}

function preview_formmaker() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  global $wpdb;
  if (isset($_GET['id']))
    $getparams = (int) $_GET['id'];
  $query = "SELECT css FROM " . $wpdb->prefix . "formmaker_themes WHERE id=" . $getparams;
  $css = $wpdb->get_var($query);
  html_preview_formmaker($css);
}

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function Form_maker_Submits() {
  require_once("Submissions.html.php");
  require_once("Submissions.php");
  if (!function_exists('print_html_nav'))
    require_once("nav_function/nav_html_func.php");
  global $wpdb;
  if (isset($_GET["task"])) {
    $task = esc_html($_GET["task"]);
  }
  else {
    $task = "show";
  }
  if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
  }
  else {
    $id = 0;
  }
  switch ($task) {
    case "submits" :
      show_submits();
      break;
    case "edit_submit" :
      editSubmit($id);
      break;
    case "remove_submit" :
      remov_submit($id);
      show_submits();
      break;
    case "remov_cheched" :
      remov_cheched_submission();
      show_submits();
      break;
    case "appply_submit" :
      save_submit($id);
      editSubmit($id);
      break;
    case "save_submit" :
      save_submit($id);
      show_submits();
      break;
    case "cancel" :
      show_submits();
      break;
    default:
      show_submits();
  }
}

function Form_maker_Themes() {
  require_once("Theme_functions.php");
  require_once("Themes_function.html.php");
  if (!function_exists('print_html_nav')) {
    require_once("nav_function/nav_html_func.php");
  }
  global $wpdb;
  if (isset($_GET["task"])) {
    $task = esc_html($_GET["task"]);
  }
  else {
    $task = "";
  }
  if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
  }
  else {
    $id = 0;
  }
  switch ($task) {
    case 'theme':
      show_theme();
      break;
    case 'default':
      default_theme($id);
      show_theme();
      break;
    case 'add_theme':
      add_theme();
      break;
    case 'Save':
      if ($id) {
        apply_theme($id);
      }
      else {
        save_theme();
      }
      show_theme();
      break;
    case 'Apply':
      if ($id) {
        apply_theme($id);
      }
      else {
        save_theme();
        $id = $wpdb->get_var("SELECT MAX(id) FROM " . $wpdb->prefix . "formmaker_themes");
      }
      edit_theme($id);
      break;
    case 'edit_theme':
      edit_theme($id);
      break;
    case 'remove_theme':
      remove_theme($id);
      show_theme();
      break;
    default:
      show_theme();
  }
}

function Uninstall_Form_Maker() {
  global $wpdb;
  $base_name = plugin_basename('Form_maker');
  $base_page = 'admin.php?page=' . $base_name;
  if (isset($_GET['mode'])) {
    $mode = trim(esc_html($_GET['mode']));
  }
  if (!empty($_POST['do'])) {
    if (esc_html($_POST['do']) == "UNINSTALL Form Maker") {
      check_admin_referer('Form Maker_uninstall');
      if (trim(esc_html($_POST['uninstall_Form_yes'])) == 'yes') {
        if ((get_option('contact_form_forms', FALSE) || get_option('contact_form_forms', FALSE) != '') && get_option('contact_form_themes', FALSE) || get_option('contact_form_themes', FALSE) != '') {
          echo '<div id="message" class="updated fade">';
          echo '<p>';
          echo "Table 'formmaker' has been deleted.";
          $wpdb->query("DELETE FROM " . $wpdb->prefix . "formmaker WHERE `id` NOT IN (" . get_option('contact_form_forms') . ")");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '<p>';
          echo "Table 'formmaker_submits' has been deleted.";
          $wpdb->query("DELETE FROM " . $wpdb->prefix . "formmaker_submits WHERE `form_id` NOT IN (" . get_option('contact_form_forms') . ")");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '<p>';
          echo "Table 'formmaker_views' has been deleted.";
          $wpdb->query("DELETE FROM " . $wpdb->prefix . "formmaker_views WHERE `form_id` NOT IN (" . get_option('contact_form_forms') . ")");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '<p>';
          echo "Table 'formmaker_themes' has been deleted.";
          $wpdb->query("DELETE FROM " . $wpdb->prefix . "formmaker_themes WHERE `id` NOT IN (" . get_option('contact_form_themes') . ")");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '</div>';
        }
        else {
          echo '<div id="message" class="updated fade">';
          echo '<p>';
          echo "Table 'formmaker' has been deleted.";
          $wpdb->query("DROP TABLE " . $wpdb->prefix . "formmaker");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '<p>';
          echo "Table 'formmaker_submits' has been deleted.";
          $wpdb->query("DROP TABLE " . $wpdb->prefix . "formmaker_submits");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '<p>';
          echo "Table 'formmaker_views' has been deleted.";
          $wpdb->query("DROP TABLE " . $wpdb->prefix . "formmaker_views");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '<p>';
          echo "Table 'formmaker_themes' has been deleted.";
          $wpdb->query("DROP TABLE " . $wpdb->prefix . "formmaker_themes");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '<p>';
          echo "Table 'formmaker_sessions' has been deleted.";
          $wpdb->query("DROP TABLE " . $wpdb->prefix . "formmaker_sessions");
          echo '<font style="color:#000;">';
          echo '</font><br />';
          echo '</p>';
          echo '</div>';
        }
        $mode = 'end-UNINSTALL';
      }
    }
  }
  if (!isset($mode))
    $mode = '';
  switch ($mode) {
    case 'end-UNINSTALL':
      $deactivate_url = wp_nonce_url('plugins.php?action=deactivate&amp;plugin=' . plugin_basename(__FILE__), 'deactivate-plugin_' . plugin_basename(__FILE__)) . '&form_maker_uninstall=1';
      echo '<div class="wrap">';
      echo '<div id="icon-Form_maker" class="icon32"><br /></div>';
      echo '<h2>Uninstall Form Maker</h2>';
      echo '<p><strong>' . sprintf('<a href="%s">Click Here</a> To Finish The Uninstallation And Form Maker Will Be Deactivated Automatically.', $deactivate_url) . '</strong></p>';
      echo '</div>';
      break;
    // Main Page
    default:
      ?>
      <form method="post" action="<?php echo admin_url('admin.php?page=Uninstall_Form_Maker'); ?>">
        <?php wp_nonce_field('Form Maker_uninstall'); ?>
        <div class="wrap">
          <div id="icon-Form_maker" class="icon32"><br/></div>
          <h2><?php echo 'Uninstall Form Maker'; ?></h2>
          <p>
            <?php echo 'Deactivating Form Maker plugin does not remove any data that may have been created, such as the Forms and the Submissions. To completely remove this plugin, you can uninstall it here.'; ?>
          </p>
          <p style="color: red">
            <strong><?php echo'WARNING:'; ?></strong><br/>
            <?php echo 'Once uninstalled, this cannot be undone. You should use a Database Backup plugin of WordPress to back up all the data first.'; ?>
          </p>
          <p style="color: red">
            <strong><?php echo 'The following WordPress Options/Tables will be DELETED:'; ?></strong><br/>
          </p>
          <table class="widefat">
            <thead>
            <tr>
              <th><?php echo 'WordPress Tables'; ?></th>
            </tr>
            </thead>
            <tr>
              <td valign="top">
                <ol>
                  <?php
                  echo '<li>formmaker</li>' . "\n";
                  echo '<li>formmaker_submits</li>' . "\n";
                  echo '<li>formmaker_views</li>' . "\n";
                  echo '<li>formmaker_themes</li>' . "\n";
                  echo '<li>formmaker_sessions</li>' . "\n";
                  ?>
                </ol>
              </td>
            </tr>
          </table>
          <p style="text-align: center;">
              <?php echo 'Do you really want to uninstall Form Maker?'; ?><br/><br/>
            <input type="checkbox" name="uninstall_Form_yes" value="yes"/>&nbsp;<?php echo 'Yes'; ?><br/><br/>
            <input type="submit" name="do" value="<?php echo 'UNINSTALL Form Maker'; ?>" class="button-primary"
                   onclick="return confirm('<?php echo 'You Are About To Uninstall Form Maker From WordPress.\nThis Action Is Not Reversible.\n\n Choose [Cancel] To Stop, [OK] To Uninstall.'; ?>')"/>
          </p>
        </div>
      </form>
      <?php
  }
}


function formmaker_activate() {
  include 'setup_sql.php';
  set_form_maker_sql();
  require_once("update_sql.php");
  formmaker_chech_update();
}
register_activation_hook(__FILE__, 'formmaker_activate');

function sp_form_deactiv() {
  echo esc_html($_GET['form_maker_uninstall']);
  if (isset($_GET['form_maker_uninstall'])) {
    if ($_GET['form_maker_uninstall'] == 1) {
      delete_option('formmaker_cureent_version');
    }
  }
}

register_deactivation_hook(__FILE__, 'sp_form_deactiv');