<?php
/*
Plugin Name: Test1
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



add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Test 1 Menu Page', 'Test 1 Menu', 'edit_posts', 'test1/page_slug_name.php', 'test1_admin_page', 'dashicons-tickets', 6  );
}

function test1_admin_page() {

	global $current_user, $wp_roles;
	echo '<pre>'.print_r($current_user,true).'</pre>';

	global $wp_roles;
	$roles = $wp_roles->get_names();

	// Below code will print the all list of roles.
	echo '<pre>'.print_r($roles,true).'</pre>';


	$args = array(
		'type'                     => '',
		'child_of'                 => 0,
		'parent'                   => '',
		'hide_empty'               => 0,
		'taxonomy'                 => array('category','wpdmcategory'),
		'pad_counts'               => false 
	);
	
	$cats = get_categories($args);
	
	echo '<pre>'.print_r($cats,true).'</pre>';
	
	
	if (in_array('depta', $current_user->roles)) {
		echo '<p>You are a member of Department A and may continue.</p>';
	}

	?>
	<div class="wrap">

		<h1>Test1 Admin Page</h1>
		<p>Foo.</p>

	</div>
	<?php
	}



?>