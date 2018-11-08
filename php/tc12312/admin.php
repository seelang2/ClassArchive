<?php
/**
 *
 */
require_once('init.php');

/**
 * Login/Authorization process
 */
// test for logout first
if (isset($_GET['logout'])) {
	// delete session
	$_SESSION = []; // set session to empty array
	session_destroy();
	session_regenerate_id();
	// redirect to login page
	redirect('admin-login.php','from=admin.php');
}

// is user logged in?
if (empty($_SESSION['userdata'])) {
	// is login data present?
	if (empty($_POST['username']) && empty($_POST['password'])) {
		redirect('admin-login.php','from=admin.php');
	}
	// is login data valid?
	// TODO: remember to hash the password with salt when implemented
	$username = $db->real_escape_string($_POST['username']);
	$password = $db->real_escape_string($_POST['password']);

	$query = "SELECT id, username, permissions FROM staff WHERE username = '".$username."' and password = '".$password."'";

	$result = $db->query($query);
	if (!$result) {
		// query error - redirect to error page
		// also write to system log
		redirect('general_error.html');
	}
	// was the user found?
	if ($result->num_rows != 1) {
		// user was not found
		redirect('admin-login.php','from=admin.php&error=1');
	}
	// store user credentials
	$_SESSION['userdata'] = $result->fetch_assoc();

} else {
	// does user have permission to access page?
	// in this app all users have access to the page itself; we simply
	// check permissions to see which functions of the page they have
	// access to
} // if logged in

include('admin_inc_header.php');
?>

		<!-- tabs -->
		<div id="tabcontainer">
			<div class="tab" id="clienttab">Manage Clients</div>
			<div class="tab" id="fundtab">Manage Funds</div>
		</div><!-- #tabcontainer -->
		<div id="tabdatacontainer">
			<div class="tabdata" id="welcomepanel">
				<p>Please click a tab to get started.</p>
			</div>
			<div class="tabdata" data-tabname="clienttab">
				<h2>Manage Clients</h2>
			</div>
			<div class="tabdata" data-tabname="fundtab">
				<h2>Manage Funds</h2>
				<p><a href="admin_mod_pricingupdate.php">Update Fund Pricing</a></p>
				<p><button id="btnAddFund">Add New Fund</button>
				<div id="fundlist"></div>
			</div>
		</div><!-- #contentcontainer -->

<?php include('admin_inc_footer_top.php'); ?>

<script type="text/javascript">
<?php echo 'var userData = '.json_encode($_SESSION['userdata']); ?>
</script>
<script type="text/javascript">

// defer execution until DOM is ready
$(document).ready(function() {
// define an app container object to hold methods
var App = {};
App.data = {}; // bucket to hold data

App.clienttab = function() {
	console.log('Launching Client Tab');
}; // App.clienttab()

App.fundtab = function() {
	console.log('Launching Fund Tab');

	$fundListElem.empty();

	// initialize fund table
	App.data.fundTbodyElem = 
	$('<table />')
		.append('<thead />')
		.children('thead')
			.append('<tr />')
			.children('tr')
				.append('<th>Fund ID</th>')
				.append('<th>Fund Name</th>')
				.append('<th>Fee</th>')
				.end()
			.end()
		.append('<tbody />')
		.appendTo($fundListElem)
		.children('tbody');

	// get fund data
	App.getFundData();
}; // App.fundtab()

App.getFundData = function() {
	// do XHR request to get data
	$.ajax({
		url: 				'backend.php?module=fund&action=view&nopricing=1',
		method: 		'get',
		dataType: 	'json',
		cache: 			false,
		success: 		App.updateFundTable
	});

}; // App.getFundData()

App.updateFundTable = function(fundData) {
	// check backend response status
	if (fundData.status != 'Ok') {
		// error
		alert('A backend error has occurred.');
		return; // bail out of function
	}

	// update table
	App.data.fundTbodyElem.empty();

	// loop through fund data and create table rows
	$.each(fundData.data, function(index, row) {
		// create new row
		$('<tr />')
			.attr('data-id', row.id) 			// attach id as attribute
			.append('<td>'+ row.fundid +'</td>')
			.append('<td>'+ row.name +'</td>')
			.append('<td>'+ row.fee +'</td>')
			.appendTo(App.data.fundTbodyElem);

	}); // $.each()

}; // App.updateFundTable

/**
 * Add new fund
 */
App.fundAdd = function() {
	// load the form template into a div and add to DOM
	App.data.fundAddformDiv = 
	$('<div />')
		.insertBefore($fundListElem)
		.on('submit', 'form', App.fundSaveData)
		.load('tpl_fund_addform.html');

}; // App.fundAdd

App.fundSaveData = function(evt) {
	evt.preventDefault(); // prevent form default behavior
	// validate form data
	var formIsValid = true;

	// check that field is not empty
	var $field = $(this).find('[name="fundid"]')
	var fundid = $field.val();
	if (fundid.length < 1) {
		formIsValid = false; // invalidate form data
		// now display feedback
		$field
			.after('<span class="error">Field is required</span>');
	}

	$field = $(this).find('[name="name"]');
	var fundname = $field.val();
	if (fundname.length < 1) {
		formIsValid = false; // invalidate form data
		// now display feedback
		$field
			.after('<span class="error">Field is required</span>');
	}

	if (!formIsValid) {
		return; // bail before saving
	}

	// save data
	$.ajax({
		url: 			'backend.php?module=fund&action=save',
		method: 	'post',
		dataType: 'json',
		data: 		$(this).serialize(),
		success: 	function(response) {
			if (response.status != 'Ok') {
				alert('There was an error saving the form data.');
				return;
			}

			alert('The record was saved.');
			App.data.fundAddformDiv.remove(); // detach div deom DOM
			App.data.fundAddformDiv = null; // clear element from memory
			App.getFundData(); // update fund table

		}
	})

}; // App.fundSaveData

// App startup stuff

$('#welcomepanel')
	.prepend('<p>You are logged in as '+ userData.username +'.</p>');

// control what tabs are shown based on user's permissions
var clientMask = 1; // bit 1
var fundMask = 2; // bit 2

if (!(userData.permissions & clientMask)) {
	$('#clienttab').hide();
}

if (!(userData.permissions & fundMask)) {
	$('#fundtab').hide();
}

// global app setup
$('#btnAddFund').on('click', App.fundAdd);
var $fundListElem = $('#fundlist');

// tab control
// when user clicks on a tab:
$('.tab').on('click', function(evt) {
	// mark that tab active
	// 'this' points to clicked tab
	$(this).addClass('active');
	// mark other tabs inactive
	$('.tab')
		.not(this)
		.removeClass('active');
	// display the tab's content panel
	var tabID = $(this).attr('id'); 					// get the current tab ID
	$('.tabdata')															// find all tab panels
		.filter('[data-tabname='+ tabID +']') 	// select the matching panel
			.show()																// and display it
			.end()																// revert to all panels
		.not('[data-tabname='+ tabID +']')			// select nonmatching panels
			.hide();															// and hide them
	// launch tab's init function
	App[tabID]();
}); // .tab.on()


}); // document.ready

</script>
<?php include('admin_inc_footer_bottom.php'); ?>