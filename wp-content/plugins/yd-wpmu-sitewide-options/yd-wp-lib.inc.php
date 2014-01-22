<?php
// ============================ Generic YD WP functions ==============================

if( !function_exists( 'yd_update_options' ) ) {
	function yd_update_options( $option_key, $number, $to_update, $fields, $prefix ) {
		$options = $newoptions = get_option( $option_key );
		foreach( $to_update as $key ) {
			$newoptions[$number][$key] = strip_tags( stripslashes( $fields[$prefix . $key . '-' . $number] ) );
			//echo $key . " = " . $prefix . $key . '-' . $number . " = " . $newoptions[$number][$key] . "<br/>";
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option( $option_key, $options );
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

if( !function_exists( 'yd_clean_cut' ) ) {
	function yd_clean_cut( $string, $cutlength ) {
		$string = substr( strip_tags( $string ), 0, $cutlength );
		if( strlen( $string ) == $cutlength ) {
			$last_blank = strrpos( $string, " " );
			if( $last_blank !== false ) $string = substr( $string, 0, $last_blank );
		}
		return $string;
	}
}

?>