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

/**
 * 
 */
add_action( 'admin_menu', 'test3_menu' );

// adds admin page menu item as a submenu under Users
function test3_menu() {
	// get the hook for our admin page and use it to conditionally queue the 
	// css and js for the page.
	// ref: http://wordpress.stackexchange.com/questions/41207/how-do-i-enqueue-styles-scripts-on-certain-wp-admin-pages
	$page_hook = add_users_page( 'Role/Category Access Page', 'Role/Category Access', 'edit_posts', 'test3/page_slug_name.php', 'test3_admin_page', 'dashicons-tickets', 6  );
	
	 add_action( 'load-' . $page_hook, 'test3_queue_scripts' );
	
}

/**
 * 
 */
function test3_queue_scripts() {
	// ideally only queue scripts and css when we load the specific admin page
	add_action( 'admin_enqueue_scripts', 'test3_scripts' );
}

/**
 * 
 */
function test3_admin_page() {
	
	// import global user and role vars
	global $current_user, $wp_roles;
	
	// get all roles
	$roles = $wp_roles->get_names();
	
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
	
	// pass category data into javascript
	$tmp = array();
	foreach ($cats as $cat) {
		$tmp[$cat->term_id] = array(
			'term_id' => $cat->term_id,
			'name' => $cat->name
		);
	}
	echo '<script type="text/javascript">var catData = '.json_encode($tmp).'</script>';
	
	// check to see if the rc data has been posted to the page from the save button
	// on the previous request. If it's there, use that as the rc data, otherwise
	// load the data from the options db
	if (!empty($_POST)) {
		$rcData = json_decode(stripslashes($_POST['ttp-data']));
		// save in options db
		update_option('ttp_roles_categories', serialize($rcData));
	} else {
		// load data from WP options db
		$rcData = unserialize(get_option('ttp_roles_categories'));
	}
	
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
	wp_register_style( 'test3-styles',  plugin_dir_url( __FILE__ ) . 'test3.css' );
    wp_enqueue_style( 'test3-styles' );
	wp_enqueue_script(
		'test3script',
		plugins_url( '/test3.js' , __FILE__ ),
		array( 'jquery' )
	);
}


/**
 * Check the current user's roles against role/category data and apply filter
 * Note that pre_get_posts is fired in both the front end and admin sections,
 * and since this function is intended only to filter the admin section we put
 * an is_admin() at the top of the function as a basic gatekeeper.
 */
function ttp_filter( $query ) {
	// only run if this is the WP admin section
	if ( !is_admin() ) return;
	// right now we only want this to run in the Downloads Manager section,
	// so we bail if we aren't there
	
	// ref: http://codex.wordpress.org/Function_Reference/get_current_screen
	$current_screen = get_current_screen();
	if ($current_screen->id != 'edit-wpdmpro') return;
	
	global $current_user; // get current user data

	// load role/cat data from WP options db
	$rcData = unserialize(get_option('ttp_roles_categories'));
	
	$terms = array();
	
	// check user's roles against rcData to find cat info
	foreach ($current_user->roles as $userRole) {
		if (!empty($rcData->$userRole)) {
			// user matches a role with assigned categories
			// loop through role and get cat term IDs
			foreach ($rcData->$userRole as $cat => $termID) {
				$terms[] = $termID;
			}
		}
	}
	
	// is_admin() is used to only affect the admin section, not the front end
	// (moved the is_admin() check to the top of the function so no longer needed
	// here
	if ( $query->is_main_query() ) {
		$args = array(
			array(
				'taxonomy' => 'wpdmcategory',
				'field'    => 'term_id',
				'terms'    => $terms
			)
		);
		$query->set('order', 'ASC');
		$query->set('tax_query', $args);
    }

}

add_action( 'pre_get_posts', 'ttp_filter' );




?>