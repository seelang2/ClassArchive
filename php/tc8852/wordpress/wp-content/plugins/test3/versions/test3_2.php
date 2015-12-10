<?php
/*
Plugin Name: Test3
Description: Prototype plugin for Role Access Management.
Author: Chris Langtiw
Version: 0.1
Author URI: http://www.sitebabble.com
*/
/*
ref:
https://premium.wpmudev.org/blog/creating-wordpress-admin-pages/
https://codex.wordpress.org/Function_Reference/add_option
https://codex.wordpress.org/Options_API
http://wordpress.stackexchange.com/questions/83767/performance-with-autoload-and-the-options-table

https://codex.wordpress.org/Function_Reference/plugin_dir_url
https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts

*/

add_action( 'admin_menu', 'test3_menu' );

// adds admin page menu item as a submenu under Users
function test3_menu() {
	add_users_page( 'Test 3 Menu Page', 'Test 3 Menu', 'edit_posts', 'test3/page_slug_name.php', 'test3_admin_page', 'dashicons-tickets', 6  );
}

function test3_admin_page() {
	// import global user and role vars
	global $current_user, $wp_roles;
	
	// get all roles
	$roles = $wp_roles->get_names();
	
	//echo '<pre>'.print_r(get_option('wp_user_roles'),true).'</pre>';
	
	// get all categories
	$args = array(
		'type'                     => '',
		'child_of'                 => 0,
		'parent'                   => '',
		'hide_empty'               => 0,
		'taxonomy'                 => array('category','wpdmcategory'),
		'pad_counts'               => false 
	);
	$cats = get_categories($args);
	//echo '<pre>'.print_r($cats,true).'</pre>';
	
	// pass category data into javascript
	$tmp = array();
	foreach ($cats as $cat) {
		$tmp[$cat->term_id] = array(
			'term_id' => $cat->term_id,
			'name' => $cat->name
		);
	}
	//echo '<pre>'.print_r($tmp,true).'</pre>';
	echo '<script type="text/javascript">var catData = '.json_encode($tmp).'</script>';
	
	// check to see if the rc data has been posted to the page from the save button
	// on the previous request. If it's there, use that as the rc data, otherwise
	// load the data from the options db
	if (!empty($_POST)) {
		//echo '<p>posted form data: '. stripslashes($_POST['ttp-data']) . '</p>';
		$rcData = json_decode(stripslashes($_POST['ttp-data']));
		// save in options db
		update_option('ttp_roles_categories', serialize($rcData));
	} else {
		// load data from WP options db
		$rcData = unserialize(get_option('ttp_roles_categories'));
	}
	
	echo '<pre>'.print_r($_POST,true).'</pre>';
	echo '<pre>'.print_r($rcData,true).'</pre>';
	
	// initialize data if the option doesn't exist
	if ($rcData === false) {
		$rcData = array();
		// define empty data in javascript as well
		echo '<script type="text/javascript">var rcData = {};</script>';
	} else {
		// pass the data into javascript as well
		echo '<script type="text/javascript">var rcData = '.json_encode($rcData).'</script>';
	}
	
	?>
	<div id="ttp-page" class="wrap">

		<h1>Role/Category Access Options</h1>
		<p>This section allows you to assign post categories to roles. Users with the assigned roles will be unable to access posts that do not have the categories attached to that role.</p>
		<p><strong>This only affects the Administrative interface and not the front end site.</strong></p>
		
		<div class="ttp-row">
			<div class="ttp-col">
				<p>Select a role to view/modify:</p>
				<select id="ttp-role">
				<?php
					foreach($roles as $key => $value) {
						echo '<option value="'.$key.'">'.$value.'</option>';
					}
				?>
				</select>
				<div id="ttp-rolecats"></div>
			</div>
			<div class="ttp-col">
				<p>Select categories to add to role:</p>
				<select id="ttp-categories" multiple>
				<?php
					foreach($cats as $cat) {
						echo '<option value="'.$cat->term_id.'">'.$cat->name.'</option>';
					}
				?>
				</select>
				<button id="ttp-setcats">Assign categories to role</button>
			</div>
		</div>
		<div>
			<form id="saveform" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
				<input type="hidden" name="ttp-data" value="" />
				<button id="ttp-save">Save Changes</button>
			</form>
		</div>
	</div>
	
	<?php
	}

// set up scripts and stylesheets
function test3_scripts() {
    echo 'we have run';
	wp_register_style( 'test3-styles',  plugin_dir_url( __FILE__ ) . 'test3.css' );
    wp_enqueue_style( 'test3-styles' );
	wp_enqueue_script(
		'test3script',
		plugins_url( '/test3.js' , __FILE__ ),
		array( 'jquery' )
	);
}

add_action( 'admin_enqueue_scripts', 'test3_scripts' );

?>