<?php

/*
 * Name: wp-plugin-base
 *
 * Description: Base class for developing WordPress plugins; contains helper functions to
 * add WordPress hooks consistently and sanitise hook method names.
 *
 * Acknowledgements: Based on WPS_Plugin_Base_v1 by Travis Smith (http://wpsmith.net)
 */

if (!class_exists ('WP_PluginBase')) {
	class WP_PluginBase {
		function hook ($hook) {
			$priority = 10;
			$method = $this->sanitise_method ($hook);
			$args = func_get_args ();
			unset ($args[0]);
			foreach ((array)$args as $arg) {
				if (is_int ($arg)) {
					$priority = $arg;
				}
				else {
					$method = $arg;
				}
			}	// end-foreach
			return add_action ($hook, array ($this, $method), $priority, 999);
		}
		
		private function sanitise_method ($method) {
			return str_replace (array ('.', '-'), array ('_DOT_', '_DASH'), $method);
		}
	}	// end-class WP_PluginBase
}

?>