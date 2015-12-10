<?php
/*
Plugin Name: Test1_1
Description: This is just a test plugin. It does very little. Enjoy.
Author: Chris Langtiw
Version: 0.1
Author URI: http://www.sitebabble.com
*/
/*
ref:
http://codex.wordpress.org/Writing_a_Plugin
http://codex.wordpress.org/Plugin_API
https://premium.wpmudev.org/blog/creating-wordpress-admin-pages/
http://codex.wordpress.org/Administration_Screens

https://developer.wordpress.org/reference/functions/add_menu_page/

*/

/*
We need to accomplish three types of tasks:
Add new admin page (plus menu) to admin interface
Add extra field to existing admin page
Perform some kind of data manipulation (front end)
*/

/* Some utility functions */

// ref: https://wordpress.org/support/topic/how-to-get-the-current-logged-in-users-role
/*
function get_user_role($uid) {
	global $wpdb;
	$role = $wpdb->get_var("SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'wp_capabilities' AND user_id = {$uid}");
	  if(!$role) return 'non-user';
	$rarr = unserialize($role);
	$roles = is_array($rarr) ? array_keys($rarr) : array('non-user');
	return $roles[0];
}
*/

/**
* Dynamically Populating User Role
* http://gravitywiz.com/2012/04/30/dynamically-populating-user-role/
*/
/*
add_filter('gform_field_value_user_role', 'gform_populate_user_role');
function gform_populate_user_role($value){
    $user = wp_get_current_user();
    $role = $user->roles;
    return reset($role);
}
*/




add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Test 1 Menu Page', 'Test 1 Menu', 'edit_posts', 'test1/page_slug_name.php', 'test1_admin_page', 'dashicons-tickets', 6  );
}

function test1_admin_page() {

global $current_user, $wp_roles;

echo '<pre>'.print_r($current_user,true).'</pre>';

/*
foreach($wp_roles->role_names as $role => $Role) {
	if (array_key_exists($role, $current_user->caps))
		break;
}
*/


?>
<div class="wrap">

	<h1>Test1 Admin Page</h1>
	<p>Foo.</p>

</div>
<?php
}



?>