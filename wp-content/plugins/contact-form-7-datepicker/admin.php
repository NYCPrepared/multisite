<?php

class ContactForm7Datepicker_Admin {

	function __construct() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
		add_action('wpcf7_admin_after_general_settings', array($this, 'add_meta_box'));
		add_action('admin_footer', array($this, 'theme_js'));
		add_action('wp_ajax_cf7dp_save_settings', array($this, 'ajax_save_settings'));
	}

	function enqueue_assets() {
		if (is_admin() && ! self::is_wpcf7_page())
			return;

		wp_enqueue_script('jquery-ui-datepicker');

		ContactForm7Datepicker::enqueue_js();
		ContactForm7Datepicker::enqueue_css();
	}

	function add_meta_box() {
		if (! current_user_can('publish_pages'))
			return;

		add_meta_box(
			'datepickerthemediv',
			__('Datepicker Theme'),
			array(__CLASS__, 'theme_metabox'),
			'cfseven',
			'datepicker-theme',
			'core'
		);

		do_meta_boxes('cfseven', 'datepicker-theme', array());
	}

	public static function theme_metabox() {
		?>

		<div id="preview" style="float: left; margin: 0 10px 0 0"></div>
			<form action="">
				<label for="jquery-ui-theme"><?php _e('Theme'); ?></label><br />
				<?php self::themes_dropdown(); ?>
				<input type="submit" id="save-ui-theme" value="<?php _e('Save'); ?>" class="button" />
			</form>
		<div class="clear"></div>

		<?php
		$dp = new CF7_DateTimePicker('datetime', '#preview');
		echo '<script>jQuery(function($){ ' . $dp->generate_code(true) . ' });</script>';
	}

	function theme_js() {
		if (! self::is_wpcf7_page())
			return;
	?>
		<script>
		jQuery(function($){
			var $spinner = $(new Image()).attr('src', '<?php echo admin_url('images/wpspin_light.gif'); ?>');
			var old_href = '';

			$('#jquery-ui-theme').change(function(){
				var style = $(this).val();

				var $link = $('#jquery-ui-theme-css');
				var href = $link.attr('href');

				if (style == 'disabled') {
					old_href = href;
					$link.attr('href', '');

					return;
				} else if (href === '') {
					href = old_href;
				}

				href = href.replace(/\/themes\/[-a-z]+\//g, '/themes/' + style + '/');
				$link.attr('href', href);
			});

			$('#save-ui-theme').click(function(){
				var data = {
					action: 'cf7dp_save_settings',
					ui_theme: $('#jquery-ui-theme').val()
				};

				var $this_spinner = $spinner.clone();

				$(this).after($this_spinner.show());

				$.post(ajaxurl, data, function(response) {
					var $prev = $( '.wrap > .updated, .wrap > .error' );
					var $msg = $(response).hide().insertAfter($('.wrap h2'));
					if ($prev.length > 0)
						$prev.fadeOut('slow', function(){
							$msg.fadeIn('slow');
						});
					else
						$msg.fadeIn('slow');

					$this_spinner.hide();
				});

				return false;
			});
		});
		</script>
	<?php
	}

	function ajax_save_settings() {
		$successmsg = '<div id="message" class="updated fade"><p><strong>' . __('Options saved.') . '</strong></p></div>';
		$errormsg = '<div id="message" class="error fade"><p><strong>' . __('Options could not be saved.') . '</strong></p></div>';

		if (! isset($_POST['ui_theme']))
			die($errormsg);

		if (! is_admin())
			die($errormsg);

		$theme = trim($_POST['ui_theme']);

		if (! preg_match('%[-a-z]+%i', $theme))
			die($errormsg);

		if (get_option('cf7dp_ui_theme') !== $theme)
			if (! update_option('cf7dp_ui_theme', $theme))
				die($errormsg);

		die($successmsg);
	}

	private static function themes_dropdown() {
		$themes = array(
			'disabled' => __('Disabled'),
			'smoothness' => 'Smoothness',
			'black-tie' => 'Black Tie',
			'blitzer' => 'Blitzer',
			'cupertino' => 'Cupertino',
			'dark-hive' => 'Dark Hive',
			'dot-luv' => 'Dot Luv',
			'eggplant' => 'Eggplant',
			'excite-bike' => 'Excite Bike',
			'flick' => 'Flick',
			'hot-sneaks' => 'Hot Sneaks',
			'humanity' => 'Humanity',
			'le-frog' => 'Le frog',
			'mint-choc' => 'Mint Choc',
			'overcast' => 'Overcast',
			'pepper-grinder' => 'Pepper Grinder',
			'redmond' => 'Redmond',
			'south-street' => 'South Street',
			'start' => 'Start',
			'sunny' => 'Sunny',
			'swanky-purse' => 'Swanky Purse',
			'trontastic' => 'Trontastic',
			'ui-darkness' => 'UI Darkness',
			'ui-lightness' => 'UI Lightness',
			'vader' => 'Vader'
		);

		$themes = apply_filters('cf7dp_ui_themes', $themes);

		$html = "<select id=\"jquery-ui-theme\">\n";
		foreach ($themes as $key => $val) {
			$is_selected = ($key == get_option('cf7dp_ui_theme')) ? ' selected="selected"' : '';
			$html .= "\t<option value=\"{$key}\"{$is_selected}>{$val}</option>\n";
		}

		$html .= "</select>\n";

		echo $html;
	}

	private static function is_wpcf7_page() {
		global $current_screen, $pagenow;

		if (is_object($current_screen) && strpos($current_screen->id, 'page_wpcf7'))
			return true;

		return false;
	}
}

new ContactForm7Datepicker_Admin;
