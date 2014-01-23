<?php
/*
* EM Integration Stuff
* We'll start moving stuff away here for now to decouple it completely from the plugin
*/
define('WPFC_EM_MIN_VERSION', 5.5); //minimum version for integration

if( defined('EM_VERSION') && WPFC_EM_MIN_VERSION > EM_VERSION ){
	//check that EM is up to date
	add_action('admin_notices','wpfc_em_version_warning');
	add_action('network_admin_notices','wpfc_em_version_warning');
}

function wpfc_em_version_warning(){
	?>
	<div class="error"><p>Please make sure you have the <a href="http://wordpress.org/extend/plugins/events-manager/">latest version</a> of Events Manager installed, as earlier versions may produce errors when integrating with WP FullCalendar. <em>Only admins see this message.</em></p></div>
	<?php
}