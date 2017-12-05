/*
viewmanager.js - view management
*/
(function(App) {

var data = {}; // private data

var changeView = function(viewName) {

	data.views
		.detach()						// detach any attached views from DOM
		.filter('#' + viewName)			// find the view we want
		.appendTo(data.viewWrapper);	// reattach view

}; // changeView

App.initViews = function(params) {

	data.viewWrapper = $('#' + params.viewWrapperID);
	data.views = $('[data-role="view"]');
	data.views
		.detach()
		.show();		// display items hidden via stylesheet				
	
	// get default page id
	data.defaultPage = 
	data.views
		.filter('.defaultpage')
		.attr('id');

	// add default page hashbang to URI
	history.pushState({}, '', '#!' + data.defaultPage)
	changeView(data.defaultPage);
	
	// show default page
	data.views
		.filter('#' + data.defaultPage)
		.appendTo(data.innerWrapper);	// display correct view

	$(window).on('popstate', function(e) {
		//console.log(e.state, history.state, location.hash);
		
		// prevent us from erroring out when the hash is empty
		if (location.hash.length == 0) {
			// add default page hashbang to URI
			history.pushState({}, '', '#!' + data.defaultPage)
			var viewName = data.defaultPage;
		}
		
		// extract new page from location hash
		var viewName = location.hash.replace('#!','');
		// change the page
		changeView(viewName);
		
	});
	
}; // App.initViews

})(window.App = window.App || {});