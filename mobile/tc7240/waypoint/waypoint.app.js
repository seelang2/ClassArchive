/*****
  waypoint.app.js
  
  Data structure: (stored locally in localStorage.AppData)
  
  {
	waypoints: [
		{ timestamp, latitude, longitude, accuracy, name, note }
	]
  }
  
  
  
 **/

// create a protected namespace using an IIFE
(function(App) {

var tmpData = null;

// private variable to store localStorage data object
var AppData = {};

App.dumpData = function() {
	return AppData;
};

// Initial App startup
App.init = function() {
	console.log('App.init');
	
	// check localStorage for data structure and initialize if undefined
	if (typeof localStorage.AppData == "undefined") {
		//console.log('Initializing localStorage.AppData');
		
		AppData = { waypoints: [] }; // init AppData object
		
		//console.log('AppData contents:',localStorage.AppData);
	} else {
		//console.log('localStorage.AppData exists');
		// deserialize data
		AppData = JSON.parse(localStorage.AppData);
	}
	
	// handler for TAG page
	$( document ).on( "pagecreate", "#tag", App.initPageTag);
		
	// handler for VIEWLIST page
	$( document ).on( "pagebeforecreate", "#viewlist", App.initPageViewlist);
		
	// handler for VIEWITEM page
	$( document ).on( "pagecontainerbeforeshow", App.initPageViewitem);
		
}; // App.init

// TAG page init
App.initPageTag = function( event ) {
	
	$('#savetag').on('click', App.doSaveTagBtn);
	
	// get geo location and add to form fields
	if (navigator.geolocation) {
		navigator
			.geolocation
			.getCurrentPosition(function(position) {
				
				$('#tagform')
					.find('#timestamp')
					.val(position.timestamp)
					.end()
					.find('#latitude')
					.val(position.coords.latitude)
					.end()
					.find('#longitude')
					.val(position.coords.longitude)
					.end()
					.find('#accuracy')
					.val(position.coords.accuracy)
					.end();
					
					
				console.log(position);
			}, // process callback
			function(e) { 
				console.log('Error calling getCurrentPosition');
				console.log(e);
			}, // error callback
			{
				enableHighAccuracy: true
			} // options
			);
	} else {
		$('#tagform')
			.parent()
			.html("<p>Geolocation is not supported by this browser.</p>");
	}		
	
}; // App.initPageTag

App.doSaveTagBtn = function(e) {
	App.saveTagData(); // save data
	
	//window.history.back(); // go back to previous page
	$.mobile.back(); // go back to previous page
}; // App.doSaveTagBtn

App.saveTagData = function() {
	
	var data = {};
	
	$('#tagform')
		.find(':input')
		.each(function(index, field) {
			// derive field name
			var fieldName = $(field).attr('name'); 
			// save all the fields for the record
			data[fieldName] = $(field).val();
			
		 });
		
	//console.log(data);
	
	// now save the new row into the storage object
	AppData.waypoints.push(data); // add to data object
	localStorage.AppData = JSON.stringify(AppData);
	
	//console.log(localStorage.AppData);
	
}; // App.saveTagData


App.initPageViewlist = function() {
	console.log('in initPageViewlist');
	
	// build listview of waypoints and add to page
	
	var $listUL = 
	$('<ul />')
		.attr('data-role','listview');
	
	// loop through waypoints and create LIs
	$.each(
		AppData.waypoints,
		function(index, record) {
			
			$('<li>')
				.attr('data-app-index', index)
				.append('<a href="#viewitem">' + record.name + '</a>')
				.appendTo($listUL);
			
		}
	); // each
	
	//console.log($listUL);
	
	$listUL.appendTo('#viewlist [role=main]');
	
	
	$('#viewlist').on('tap','li',function(e) {
		console.log('setting tmpData to',$(this).index());
		
		tmpData = $(this).index();
	});
	
	
	
}; // App.initPageView


App.initPageViewitem = function(e,u) {
	console.log('in initPageViewitem');

	console.log('tmpData',tmpData,u);
	
	if (u.toPage[0].id != 'viewitem') return; // bail if the message isn't for #viewitem

	$('#viewitem .ui-content').html('<p>' + tmpData + '</p>');
}


})(window.App = window.App || {});


// initialize app on first load
// can't use document.ready on jqm page loads
$(document).ready(App.init);
