<?php

require_once('../CF7DBPlugin.php');

/**
 * Mock WP get_options
 * @param $optionName
 * @return null
 */
function get_option($optionName) {
    $optionName = substr($optionName, strlen('CF7DBPlugin_'));
    $plugin = new CF7DBPlugin();
    $options = $plugin->getOptionMetaData();
    if (isset($options[$optionName])) {
        if (strpos($optionName, 'Can') === 0) {
            return "Anyone";
        }

        switch ($optionName) {
            case 'SubmitDateTimeFormat':
                return 'F j, Y g:i a';

            case 'date_format':
                return 'F j, Y';

            case 'time_format':
                return 'g:i a';
        }


        $count = count($options[$optionName]);
        if ($count == 1) {
            return null;
        }
        return $options[$optionName][1];
    }
    return null;
}


function __($text, $domain = 'default') {
    return $text;
}

function _e($text, $domain = 'default') {
    echo $text;
}

function is_user_logged_in() {
    return true;
}

class Mock_WP_User {
    var $ID = 1;
    var $id = 1;
    var $first_name = 'Michael';
    var $last_name = 'Simpson';
    var $user_login = 'msimpson';
    var $user_nicename = 'Michael Simpson';
    var $user_email = 'info@cfdbplugin.com';
    var $user_firstname = 'Michael';
    var $user_lastname = 'Simpson';

}

function wp_get_current_user() {
    return new Mock_WP_User();
}

function do_shortcode($content) {
    return $content;
}