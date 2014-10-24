<?php
/*
Plugin Name: Which Template File
Description: Show which php file of your theme is used to display the current page in your front office.
Version: 2.1
Author: Gilles Dumas
Author URI: http://gillesdumas.com
*/




add_filter('template_include', 'my_template_include', 999);
function my_template_include($template) {

    if (is_admin()) return;
    
    global $user_ID;
    
    if ($user_ID == 0) {
        return $template;
    }

    $userdatas = get_userdata($user_ID);
    if (isset($userdatas->roles) && (is_array($userdatas->roles)) ) {
        if (in_array('administrator', $userdatas->roles)) {
            define('_GWP_MY_TEMPLATE_FILE', ltrim(strrchr($template, '/'), '/'));
            add_filter('admin_bar_menu', 'my_admin_bar_menu', 999);            
        }
    }
    
    return $template;
}


function my_admin_bar_menu($template) {
    if (is_admin()) return;
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(
        array(
            'id'      => '_gwp_my_template_file',
            'title'   => '<span style="color:gold !important;">Template file : '._GWP_MY_TEMPLATE_FILE.'</span>',
        )
    );
}



 