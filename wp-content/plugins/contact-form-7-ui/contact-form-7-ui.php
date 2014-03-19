<?php
/*
  Plugin Name: Contact Form 7 UI
  Plugin URI: http://club.orbisius.com/products/wordpress-plugins/contact-form-7-ui/?utm_source=contact-form-7-ui&utm_medium=plugin-info&utm_campaign=product
  Description: Adds a button in the rich text editor which help you generates the required shortcode for the Contact Form 7 plugin. To support the plugin development please <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7APYDVPBCSY9A" target="_blank">Donate</a>
  Version: 1.0.0
  Author: Svetoslav Marinov (Slavi) | http://orbisius.com
  Author URI: http://orbisius.com/?utm_source=contact-form-7-ui&utm_medium=plugin-info&utm_campaign=product
  License: GPL v2
 */

/*
  Copyright 2011-2020 Svetoslav Marinov (slavi@orbisius.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; version 2 of the License.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

define('ORBISIUS_UI_CONTACT_FORM7_BASE_DIR', dirname(__FILE__)); // e.g. // htdocs/wordpress/wp-content/plugins/wp-command-center/
define('ORBISIUS_UI_CONTACT_FORM7_DIR_NAME', basename(ORBISIUS_UI_CONTACT_FORM7_BASE_DIR)); // e.g. wp-command-center
// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
    exit;
}

$webweb_ms_obj = new Orbisius_UI_ContactForm7();
add_action('init', array($webweb_ms_obj, 'init'), 50);

class Orbisius_UI_ContactForm7 {

    private $plugin_tinymce_name = 'contact_form7_ui'; // if you change it update the tinymce/editor.js;
    private $plugin_id_str = 'contact_form7_ui'; //
    private $site_url = null; // filled in later
    private $plugin_url = null; // filled in later
    private $plugin_dir_name = null; // filled in later
    private $plugin_data_dir = null; // plugin data directory. for reports and data storing. filled in later
    private $plugin_name = 'Contact Form 7 UI'; //
    private $plugin_business_sandbox = false; // sandbox or live ???
    private $plugin_business_email_sandbox = 'seller_1264288169_biz@slavi.biz'; // used for paypal payments
    private $plugin_business_email = 'billing@orbisius.com'; // used for paypal payments
    private $plugin_business_ipn = 'http://orbisius.com/wp/hosted/payment/ipn.php'; // used for paypal IPN payments
    //private $plugin_business_status_url = 'http://localhost/wp/hosted/payment/status.php'; // used after paypal TXN to to avoid warning of non-ssl return urls
    private $plugin_business_status_url = 'https://ssl.orbisius.com/webweb.ca/wp/hosted/payment/status.php'; // used after paypal TXN to to avoid warning of non-ssl return urls
    private $plugin_support_email = 'help@orbisius.com'; //
    private $plugin_support_link = 'http://miniads.ca/widgets/contact/profile/like-gate?height=200&width=500&description=Please enter your enquiry below.'; //
    private $plugin_admin_url_prefix = null; // filled in later
    private $plugin_home_page = 'http://club.orbisius.com/products/wordpress-plugins/contact-form-7-ui/';

    function __construct() {
        $site_url = site_url();

        add_action('plugins_loaded', array($this, 'init'), 100);

        $this->site_url = $site_url;
        $this->plugin_url = plugins_url(__FILE__);
        $this->plugin_dir_name = basename(dirname(__FILE__)); // e.g. wp-command-center; this can change e.g. a 123 can be appended if such folder exist
        $this->plugin_data_dir = dirname(__FILE__) . '/data';
        $this->plugin_url = $site_url . '/wp-content/plugins/' . $this->plugin_dir_name . '/';
        $this->plugin_support_link .= '&css_file=' . urlencode(get_bloginfo('stylesheet_url'));
        $this->plugin_admin_url_prefix = $site_url . '/wp-admin/admin.php?page=' . $this->plugin_dir_name;
        $this->plugin_admin_settings_url = $site_url . '/wp-admin/options-general.php?page=' . plugin_basename(__FILE__);
        $this->plugin_settings_key = $this->plugin_id_str . '_settings';
    }

    /**
     * Allows access to some private vars
     * @param str $var
     */
    public function get($var) {
        if (isset($this->$var) /* && (strpos($var, 'plugin') !== false) */) {
            return $this->$var;
        }
    }

    /**
     * handles the init
     */
    function init() {
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));

        if (is_admin()) {
            // Administration menus
            add_action('admin_menu', array($this, 'administration_menu'));
            add_action('admin_init', array($this, 'add_buttons'));
            add_action('admin_init', array($this, 'register_settings'));
            add_action('admin_notices', array($this, 'notices'));
        } else {
            // Do nothing on public side
        }
    }

    /**
     * Sets the setting variables
     */
    function register_settings() { // whitelist options
        register_setting($this->plugin_dir_name, $this->plugin_settings_key);
    }

    /**
     * Sets the setting variables
     */
    function load_assets() { // whitelist options
        wp_enqueue_script('jquery');
    }

    /**
     * Checks if contactform7 plugin is installed and active.
     */
    function notices() {
        if (!empty($_REQUEST['dismiss_warning'])) {
            return;
        }

        global $pagenow;

        // the link does the search and shows results
        $cf7_wp_install_link = admin_url('plugin-install.php?tab=dashboard&s=contact+form+7&plugin-search-input=dummy_text&tab=search');

        $dismiss = <<<DISMISS_EOF
<p><a href="{$this->plugin_admin_settings_url}&dismiss_warning=1">Dismiss (I have installed Contact Form 7 and it's working just fine)</a>.</p>
DISMISS_EOF;

        if ( !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
            $opts = get_option($this->plugin_settings_key);

            // the users hasn't dismissed the message yet.
            if (empty($opts['dismiss_warning']) && $pagenow != 'plugin-install.php') {
                echo "<div id='contact_form7_ui-warning' class='error fade'><p><strong>"
                . sprintf(__("Contact Form 7 UI: Contact Form 7 plugin doesn't seem to be installed and/or activated." . "</strong>")
                        . __("<br/>If you have already installed Contact Form 7 plugin activate it now.")
                        . __("<br/><br/><a href='$cf7_wp_install_link' class='button button-primary'>Search for Contact Form 7</a>")
                        . __(" or from <a href='http://wordpress.org/plugins/contact-form-7/' target='_blank'>http://wordpress.org/plugins/contact-form-7/</a>.")
                        , "plugins.php?page=$this->plugin_admin_settings_url") . "</p>$dismiss</div>";
            }
        }
    }

    /**
     * Adds the settings in the admin menu
     */
    public function administration_menu() {
        //$main_page = '/menu/dashboard.php';
        //add_menu_page(__('Member Status', 'webweb_member_status'), __('Member Status', 'webweb_member_status'), 'manage_options', ORBISIUS_UI_CONTACT_FORM7_DIR_NAME . '/menu/dashboard.php', null, null);

        add_options_page(__("Contact Form 7 UI", "contact_form7_ui"), __("Contact Form 7 UI", "contact_form7_ui"), 'manage_options', __FILE__, array($this, 'options'));

        // when plugins are show add a settings link near my plugin for a quick access to the settings page.
        add_filter('plugin_action_links', array($this, 'add_plugin_settings_link'), 10, 2);
    }

    /**
     * Outputs some options info. No save for now.
     */
    function options() {
        $buffer = '';

        if (!empty($_REQUEST['dismiss_warning'])) {
            $opts['dismiss_warning'] = 1;
            update_option($this->plugin_settings_key, $opts);

            // can't redirect headers are already sent

            $buffer = <<<EOF
            <p>The notice has been dismissed.</p>
            <p>Please <a href="{$this->plugin_admin_settings_url}">Continue</a></p>
EOF;
        } else {
            $support_url = "http://miniads.ca/widgets/contact/profile/{$this->plugin_id_str}?font=Arial,Sans-Serif&font_size=12&height=200&width=500&description=Please enter your enquiry below."
                    . '&css_file=' . urlencode(get_bloginfo('stylesheet_url'));

            $ext_content = orbsius_ui_contact_form7_ext_content(0);

            $buffer .= <<<OPTIONS_EOF

<link rel='stylesheet' href='{$this->plugin_url}/css/main.css' type='text/css' media='all' />

<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2>Contact Form 7 UI Options</h2>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">
						<h3><span>Instructions</span></h3>
						<div class="inside">
                            The plugin adds a new button in the RichText editor that way you can quickly insert forms created by 
                                          the <a href="http://contactform7.com" target="_blank">Contact Form 7</a> (plugin created by Takayuki Miyoshi).
                                <br/>
                                The UI plugin doesn't require any configuration at the moment however you'll have to configure Contact Form 7 plugin though.
						</div> <!-- .inside -->
					</div> <!-- .postbox -->
            
					<div class="postbox">
						<h3><span>Usage</span></h3>
						<div class="inside">
                            When you create a new or edit page/post and click on <img src="{$this->plugin_url}tinymce/icon.png" alt="icon"/>.

                            You should see the following new icon (if you use the rich text editor)

                            <p>
                            <a href="{$this->plugin_url}screenshot-1.png" target="_blank" title="Click for a bigger image"><img src="{$this->plugin_url}screenshot-1.png" alt="UI" width="50%" /></a>
                            </p>

                            <p>
                            <a href="{$this->plugin_url}screenshot-2.png" target="_blank" title="Click for a bigger image"><img src="{$this->plugin_url}screenshot-2.png" alt="UI" width="50%" /></a>
                            </p>
						</div> <!-- .inside -->
					</div> <!-- .postbox -->

					<div class="postbox">
						<h3><span>Support</span></h3>
						<div class="inside">
                            {$this->generate_contact_box()}

                            <p style="border:1px dashed red; padding:5px; __float:right;background:#FFFF99;">
                                We have launched <a href="http://club.orbisius.com/products/?utm_source=contact-form-7-ui&utm_medium=settings-top-bar&utm_campaign=plugin-update"
                                    target="_blank" title="[new window]">Club Orbisius</a>.
                                There you will be able to get support for the UI plugin and well as a list of all of our free and premium plugins.
                            </p>
						</div> <!-- .inside -->
					</div> <!-- .postbox -->

				</div> <!-- .meta-box-sortables .ui-sortable -->

			</div> <!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">
                    <div class="postbox">
						<h3><span>Want to see more cool plugins?</span></h3>
						<div class="inside">
                            You can find all of our WordPress plugins (30+ Free and Premium) on
                                <a href='http://club.orbisius.com/products/wordpress-plugins/?utm_source=contact-form-7-ui&utm_medium=plugin-settings-about&utm_campaign=plugin-update' target="_blank">Club Orbisius</a> (club.orbisius.com)
						</div> <!-- .inside -->
					</div> <!-- .postbox -->

					<div class="postbox">
						<h3><span>Newsletter</span></h3>
						<div class="inside">
                            {$this->generate_newsletter_box()}
						</div> <!-- .inside -->
					</div> <!-- .postbox -->

					<div class="postbox">
						<h3><span>Donation</span></h3>
						<div class="inside">
                            {$this->generate_donate_box()}
						</div> <!-- .inside -->
					</div> <!-- .postbox -->

                    {$ext_content}

					<div class="postbox">
						<h3><span>About</span></h3>
						<div class="inside">
                            <p>This plugin was created by Svetoslav Marinov (Slavi) - <a href="http://slavi.biz/?utm_source=contact-form-7-ui&utm_medium=plugin-settings-about&utm_campaign=plugin-update" target="_blank">slavi.biz</a>
                            |  <a href="http://club.orbisius.com/products/?utm_source=contact-form-7-ui&utm_medium=plugin-settings-about&utm_campaign=plugin-update" target="_blank">orbisius.com</a>
                                </p>
						</div> <!-- .inside -->
					</div> <!-- .postbox -->

				</div> <!-- .meta-box-sortables -->

			</div> <!-- #postbox-container-1 .postbox-container -->

		</div> <!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div> <!-- #poststuff -->

</div> <!-- .wrap -->
OPTIONS_EOF;
        }

        echo $buffer;
    }

    // Add the ? settings link in Plugins page very good
    function add_plugin_settings_link($links, $file) {
        if ($file == plugin_basename(__FILE__)) {
            $settings_link = '<a href="options-general.php?page=' . dirname(plugin_basename(__FILE__)) . '/' . basename(__FILE__) . '">' . (__("Settings", "contact_form7_ui")) . '</a>';
            array_unshift($links, $settings_link);
        }

        return $links;
    }

    /**
     * Adds buttons only for RichText mode
     * @return void
     */
    function add_buttons() {
        // Don't bother doing this stuff if the current user lacks permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }

        // Add only in Rich Editor mode
        if (get_user_option('rich_editing') == 'true') {
            // add the button for wp2.5 in a new way
            add_filter("mce_external_plugins", array(&$this, "add_tinymce_plugin"), 5);
            add_filter('mce_buttons', array(&$this, 'register_button'), 5);

            // Required by TinyMCE button
            add_action('wp_ajax_orbsius_ui_contact_form7_ajax_render_popup_content', 'orbsius_ui_contact_form7_ajax_render_popup_content');
            add_action('wp_ajax_orbsius_ui_contact_form7_ajax_render_popup_content', 'orbsius_ui_contact_form7_ajax_render_popup_content');
        }
    }

    // used to insert button in wordpress 2.5x editor
    function register_button($buttons) {
        array_push($buttons, "separator", $this->plugin_tinymce_name);

        return $buttons;
    }

    // Load the TinyMCE plugin : editor_plugin.js (wp2.5)
    function add_tinymce_plugin($plugin_array) {
        $dev = empty($_SERVER['DEV_ENV']) ? 0 : 1;
        $suffix = $dev ? '' : '.min';
        $suffix .= '.js';

        $plugin_array[$this->plugin_tinymce_name] = $this->plugin_url . 'tinymce/editor_plugin' . $suffix;

        return $plugin_array;
    }

    /**
     * Allows access to some private vars
     * @param str $var
     */
    public function generate_newsletter_box() {
        $file = ORBISIUS_UI_CONTACT_FORM7_BASE_DIR . '/zzz_newsletter_box.html';

        $buffer = Orbisius_UI_ContactForm7Util::read($file);

        wp_get_current_user();
        global $current_user;
        $user_email = $current_user->user_email;

        $replace_vars = array(
            '%%PLUGIN_URL%%' => $this->get('plugin_url'),
            '%%USER_EMAIL%%' => $user_email,
        );

        $buffer = str_replace(array_keys($replace_vars), array_values($replace_vars), $buffer);

        return $buffer;
    }

    /**
     * Loads contact tpl. It needs access to $webweb_ms_obj (global var)
     * @param void
     */
    public function generate_contact_box() {
        $webweb_ms_obj = $this;
        $file = ORBISIUS_UI_CONTACT_FORM7_BASE_DIR . '/zzz_contact_form.php';

        ob_start();
        include($file);
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

    /**
     * Allows access to some private vars
     * @param str $var
     */
    public function generate_donate_box() {
        $msg = '';
        $file = ORBISIUS_UI_CONTACT_FORM7_BASE_DIR . '/zzz_donate_box.html';

        if (!empty($_REQUEST['error'])) {
            $msg = $this->message('There was a problem with the payment.');
        }

        if (!empty($_REQUEST['ok'])) {
            $msg = $this->message('Thank you so much!', 1);
        }

        $return_url = Orbisius_UI_ContactForm7Util::add_url_params($this->get('plugin_business_status_url'), array(
                    'r' => $this->get('plugin_admin_settings_url') . '&ok=1', // paypal de/escapes
                    'status' => 1,
        ));

        $cancel_url = Orbisius_UI_ContactForm7Util::add_url_params($this->get('plugin_business_status_url'), array(
                    'r' => $this->get('plugin_admin_settings_url') . '&error=1', //
                    'status' => 0,
        ));

        $replace_vars = array(
            '%%MSG%%' => $msg,
            '%%AMOUNT%%' => '9.99',
            '%%BUSINESS_EMAIL%%' => $this->plugin_business_email,
            '%%ITEM_NAME%%' => $this->plugin_name . ' Donation',
            '%%ITEM_NAME_REGULARLY%%' => $this->plugin_name . ' Donation (regularly)',
            '%%PLUGIN_URL%%' => $this->get('plugin_url'),
            '%%CUSTOM%%' => http_build_query(array('site_url' => $this->site_url, 'product_name' => $this->plugin_id_str, 'category' => 'wp')),
            '%%NOTIFY_URL%%' => $this->get('plugin_business_ipn'),
            '%%RETURN_URL%%' => $return_url,
            '%%CANCEL_URL%%' => $cancel_url,
        );

        // Let's switch the Sandbox settings.
        if ($this->plugin_business_sandbox) {
            $replace_vars['paypal.com'] = 'sandbox.paypal.com';
            $replace_vars['%%BUSINESS_EMAIL%%'] = $this->plugin_business_email_sandbox;
        }

        $buffer = Orbisius_UI_ContactForm7Util::read($file);
        $buffer = str_replace(array_keys($replace_vars), array_values($replace_vars), $buffer);

        return $buffer;
    }

    /**
     * Outputs a message (adds some paragraphs)
     */
    function message($msg, $status = 0) {
        $id = $this->plugin_id_str;
        $cls = empty($status) ? 'app_error fade' : 'app_success';

        $str = <<<MSG_EOF
<div id='$id-notice' class='app_message_box $cls'><p><strong>$msg</strong></p></div>
MSG_EOF;
        return $str;
    }

    /**
     * a simple status message, no formatting except color
     */
    function msg($msg, $status = 0) {
        $id = $this->plugin_id_str;
        $cls = empty($status) ? 'app_error' : 'app_success';

        $str = <<<MSG_EOF
<div id='$id-notice' class='$cls'><strong>$msg</strong></div>
MSG_EOF;
        return $str;
    }

    /**
     * a simple status message, no formatting except color, simpler than its brothers
     */
    function m($msg, $status = 0) {
        $cls = empty($status) ? 'app_error' : 'app_success';

        $str = <<<MSG_EOF
<span class='$cls'>$msg</span>
MSG_EOF;
        return $str;
    }

}

class Orbisius_UI_ContactForm7Util {
    // options for read/write methods.

    const FILE_APPEND = 1;
    const UNSERIALIZE_DATA = 2;
    const SERIALIZE_DATA = 3;

    /**
     * Gets the content from the body, removes the comments, scripts
     * Credits: http://php.net/manual/en/function.strip-tags.phpm /  http://networking.ringofsaturn.com/Web/removetags.php
     * @param string $buffer
     * @string string $buffer
     */
    public static function html2text($buffer = '') {
        // we care only about the body so it must be beautiful.
        $buffer = preg_replace('#.*<body[^>]*>(.*?)</body>.*#si', '\\1', $buffer);
        $buffer = preg_replace('#<script[^>]*>.*?</script>#si', '', $buffer);
        $buffer = preg_replace('#<style[^>]*>.*?</style>#siU', '', $buffer);
//        $buffer = preg_replace('@<style[^>]*>.*?</style>@siU', '', $buffer); // Strip style tags properly
        $buffer = preg_replace('#<[a-zA-Z\/][^>]*>#si', ' ', $buffer); // Strip out HTML tags  OR '@<[\/\!]*?[^<>]*\>@si',
        $buffer = preg_replace('@<![\s\S]*?--[ \t\n\r]*>@', '', $buffer); // Strip multi-line comments including CDATA
        $buffer = preg_replace('#[\t\ ]+#si', ' ', $buffer); // replace just one space
        $buffer = preg_replace('#[\n\r]+#si', "\n", $buffer); // replace just one space
        //$buffer = preg_replace('#(\s)+#si', '\\1', $buffer); // replace just one space
        $buffer = preg_replace('#^\s*|\s*$#si', '', $buffer);

        return $buffer;
    }

    /**
     * Gets the content from the body, removes the comments, scripts
     *
     * @param string $buffer
     * @param array $keywords
     * @return array - for now it returns hits; there could be some more complicated results in the future so it's better as an array
     */
    public static function match($buffer = '', $keywords = array()) {
        $status_arr['hits'] = 0;

        foreach ($keywords as $keyword) {
            $cnt = preg_match('#\b' . preg_quote($keyword) . '\b#si', $buffer);

            if ($cnt) {
                $status_arr['hits']++; // total hits
                $status_arr['matches'][$keyword] = array('keyword' => $keyword, 'hits' => $cnt,); // kwd hits
            }
        }

        return $status_arr;
    }

    /**
     * @desc write function using flock
     *
     * @param string $vars
     * @param string $buffer
     * @param int $append
     * @return bool
     */
    public static function write($file, $buffer = '', $option = null) {
        $buff = false;
        $tries = 0;
        $handle = '';

        $write_mod = 'wb';

        if ($option == self::SERIALIZE_DATA) {
            $buffer = serialize($buffer);
        } elseif ($option == self::FILE_APPEND) {
            $write_mod = 'ab';
        }

        if (($handle = @fopen($file, $write_mod)) && flock($handle, LOCK_EX)) {
            // lock obtained
            if (fwrite($handle, $buffer) !== false) {
                @fclose($handle);
                return true;
            }
        }

        return false;
    }

    /**
     * @desc read function using flock
     *
     * @param string $vars
     * @param string $buffer
     * @param int $option whether to unserialize the data
     * @return mixed : string/data struct
     */
    public static function read($file, $option = null) {
        $buff = false;
        $read_mod = "rb";
        $tries = 0;
        $handle = false;

        if (($handle = @fopen($file, $read_mod)) && (flock($handle, LOCK_EX))) { //  | LOCK_NB - let's block; we want everything saved
            $buff = @fread($handle, filesize($file));
            @fclose($handle);
        }

        if ($option == self::UNSERIALIZE_DATA) {
            $buff = unserialize($buff);
        }

        return $buff;
    }

    /**
     *
     * Appends a parameter to an url; uses '?' or '&'
     * It's the reverse of parse_str().
     *
     * @param string $url
     * @param array $params
     * @return string
     */
    public static function add_url_params($url, $params = array()) {
        $str = '';

        $params = (array) $params;

        if (empty($params)) {
            return $url;
        }

        $query_start = (strpos($url, '?') === false) ? '?' : '&';

        foreach ($params as $key => $value) {
            $str .= ( strlen($str) < 1) ? $query_start : '&';
            $str .= rawurlencode($key) . '=' . rawurlencode($value);
        }

        $str = $url . $str;

        return $str;
    }

    // generates HTML select
    public static function html_select($name = '', $options = array(), $sel = null, $attr = '') {
        $dropdown_name = $name;
        $dropdown_name = preg_replace('#[^\w]#si', '_', $dropdown_name);
        $dropdown_name = trim($dropdown_name, '_');
        $dropdown_name = strtolower($dropdown_name);
        
        $html = "\n<select id='$dropdown_name' name='$dropdown_name' $attr>\n";

        foreach ($options as $key => $label) {
            $selected = $sel == $key ? ' selected="selected"' : '';
            $html .= "\t<option value='$key' $selected>$label</option>\n";
        }

        $html .= '</select>';
        $html .= "\n";

        return $html;
    }

    // generates status msg
    public static function msg($msg = '', $status = 0) {
        $cls = empty($status) ? 'error' : 'success';
        $cls = $status == 2 ? 'notice' : $cls;

        $msg = "<p class='status_wrapper'><div class=\"status_msg $cls\">$msg</div></p>";

        return $msg;
    }

    /**
     * Adds missing namespaces because the like will not show up in IE 6,7,8 if they are not set
     * @param string $matched_str
     * @return string
     */
    public static function add_missing_namespaces($matched_str) {
        $og = 'xmlns:og="http://opengraphprotocol.org/schema/"';
        $fb = 'xmlns:fb="http://www.facebook.com/2008/fbml"';

        if (stripos($matched_str, 'xmlns:og') === false) {
            $matched_str .= ' ' . $og;
        }

        if (stripos($matched_str, 'xmlns:fb') === false) {
            $matched_str .= ' ' . $fb;
        }

        $matched_str = '<html' . stripslashes($matched_str) . '>';

        return $matched_str;
    }

    /**
     * Returns all the contact forms created by CF7.
     * It is an array of custom post types.
     */
    public static function get_contact_forms() {
        // arguments for get_posts
        $attachment_args = array(
            'post_type' => 'wpcf7_contact_form',
            'post_status' => 'publish',
        );

        $items = get_posts($attachment_args, ARRAY_A);

        return $items;
    }
}

/**
 * This is triggered by editor_plugin.min.js and WP proxies the ajax calls to this action.
 *
 * @return void
 */
function orbsius_ui_contact_form7_ajax_render_popup_content() {
    // check for rights
    if (!is_user_logged_in()) {
        wp_die(__("You must be logged in order to use this plugin."));
    }

    $site_url = site_url();

    $contact_forms_arr = array('' => '');

    $contact_forms_raw_arr = Orbisius_UI_ContactForm7Util::get_contact_forms();

    foreach ($contact_forms_raw_arr as $obj) {
        $contact_forms_arr[$obj->ID] = $obj->post_title;
    }

    ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <title>UI for Contact Form 7</title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <script language="javascript" type="text/javascript" src="<?php echo $site_url; ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo $site_url; ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo $site_url; ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>

            <script language="javascript" type="text/javascript">
                // This is used to return
                var contact_forms_json = <?php echo json_encode($contact_forms_arr, true); ?>;
                
                function init() {
                    tinyMCEPopup.resizeToInnerSize();
                }

                function insertLinkWWUISPSC() {
                    var title = '';
                    var content = '';
                    var template = '<br/><p>[contact-form-7 id="%%ID%%" title="%%TITLE%%"]</p><br/>';

                    var contact_form7_ui = document.getElementById('contact_form7_ui_panel');
                    var contact_form_id = document.getElementById('contact_form_id').value;

                    // who is active ?
                    if (contact_form7_ui.className.indexOf('current') != -1) {
                        contact_form_id = contact_form_id.replace(/</g, '').replace(/\n/g, '').replace(/^\s*/g, '').replace(/\s*$/g, '').replace(/:+/g, '-');

                        // Validations
                        if (contact_form_id == '') {
                            alert('Please select a contact form.');
                            document.getElementById('contact_form7_ui_contact_form_id').focus();
                            return false;
                        }

                        title = contact_forms_json[contact_form_id];

                        content = template;
                        content = content.replace(/%%ID%%/ig, contact_form_id);
                        content = content.replace(/%%TITLE%%/ig, title);
                    }

                    if (window.tinyMCE) {
                        window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, content);
                        //Peforms a clean up of the current editor HTML.
                        //tinyMCEPopup.editor.execCommand('mceCleanup');
                        //Repaints the editor. Sometimes the browser has graphic glitches.
                        tinyMCEPopup.editor.execCommand('mceRepaint');
                        tinyMCEPopup.close();
                    }

                    return;
                }
            </script>
            <style>
                body {
                    font-size: 12px;
                }

                .orbsius_ui_contact_form7_plugin .app_positive_button {
                    background:#99CC66 !important;
                }

                .orbsius_ui_contact_form7_plugin .app_negative_button {
                    background:#F19C96 !important;
                }

                .orbsius_ui_contact_form7_plugin .app_max_width {
                    width: 100%;
                }

                .orbsius_ui_contact_form7_plugin .app_text_field {
                    border: 1px solid #888888;
                    padding: 3px;
                }
            </style>
            <base target="_self" />
        </head>
        <body id="orbsius_ui_contact_form7_plugin" class="orbsius_ui_contact_form7_plugin"
              onload="tinyMCEPopup.executeOnLoad('init();');
                    document.body.style.display = '';"
              style="display: none">
            <form name="contact_form7_ui_form" action="#">
                <div class="tabs">
                    <ul>
                        <li id="contact_form7_ui_tab" class="current"><span><a href="javascript:mcTabs.displayTab('contact_form7_ui_tab','contact_form7_ui_panel');" onmousedown="return false;"><?php _e("Contact Form 7 UI", 'contact_form7_ui'); ?></a></span></li>
                    </ul>
                </div>

                <div class="panel_wrapper">
                    <!-- panel -->
                    <div id="contact_form7_ui_panel" class="panel current">
                        <br />
                        <div>
                            Please select a form that you would like to insert into your post/page.
                        </div>
                        <br/>
                        <table border="0" cellpadding="4" cellspacing="0">
                            <tr>
                                <td nowrap="nowrap">
                                    <label for="contact_form7_ui_product_name"><?php _e("Contact Form", 'contact_form7_ui'); ?></label>
                                </td>
                                <td>
                                    <?php echo Orbisius_UI_ContactForm7Util::html_select('contact_form_id', $contact_forms_arr); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- end panel -->
                </div>

                <div class="mceActionPanel">
                    <div style="float: left">
                        <input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'contact_form7_ui'); ?>"
                               class='app_positive_button'
                               onclick="insertLinkWWUISPSC();
                    return false;" />
                    </div>

                    <div style="float: right">
                        <input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'contact_form7_ui'); ?>"
                               class='app_negative_button'
                               onclick="tinyMCEPopup.close();" />
                    </div>
                </div>
            </form>
        </body>
    </html>
    <?php
    die(); // This is required to return a proper result
}

/**
 * Outputs or returns the HTML content for IFRAME promo content.
 */
function orbsius_ui_contact_form7_ext_content($echo = 1) {
    $plugin_slug = basename(__FILE__);
    $plugin_slug = str_replace('.php', '', $plugin_slug);
    $plugin_slug = strtolower($plugin_slug); // jic

    $domain = !empty($_SERVER['DEV_ENV'])
                ? 'http://orbclub.com.clients.com'
                : 'http://club.orbisius.com';

    $url = $domain . '/wpu/content/wp/' . $plugin_slug . '/';

    $buff = <<<BUFF_EOF
    <iframe style="width:100%;min-height:300px;height: auto;" width="100%" height="480"
            src="$url" frameborder="0" allowfullscreen></iframe>

BUFF_EOF;

    if ($echo) {
        echo $buff;
    } else {
        return $buff;
    }
}
