<?php
/*
Plugin Name: Test4
Description: This is just a test plugin. It does very little. Enjoy.
Author: Chris Langtiw
Version: 0.1
Author URI: http://www.sitebabble.com
*/
/*
ref:


*/


add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    echo '<!-- MENU ITEMS TEST4: '.$items.' -->';
	
	if (is_user_logged_in() && $args->theme_location == 'primary') {
	$items .= '<li><a href="http://outlook.office365.com/drake.edu" target="_blank">Email</a></li>';
	$items .= '<li><a href="#">Test Item</a><ul><li><a href="#">Sub Item</a></li></ul></li>';
    $items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
//	$items .= $custom.$items;
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'primary') {
//        $items .= '<li><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
    }
    return $items;

}




?>