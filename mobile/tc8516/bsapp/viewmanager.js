/*
viewmanager.js - view management
*/
(function(App) {

var data = {}; // private data

var changeView = function(viewName) {
	// notify any handlers listening on view change
	// allows handlers to modify view before render
	$(App).trigger('viewchange', { viewName: viewName, view: data.views.filter('#' + viewName) });
	//$(App).trigger('viewchange.' + viewName, data.views.filter('#' + viewName));
	
	console.log('returned to changeview after handler');
	
	data.views
		.detach();						// detach any attached views from DOM
		
	if (data.preventRender == true) {
		data.preventRender = false; 	// reset preventRender flag for next use
		return;							// bail out of changeView
	}
	App.renderView(viewName);			// attach the view to the DOM
		
		
}; // changeView

// separate the part where we attach the view to the DOM so this may be 
// called separately
App.renderView = function(viewName) {

	data.views
		.filter('#' + viewName)			// find the view we want
		.appendTo(data.viewWrapper);	// reattach view

}; // attachView

App.preventViewRender = function() {
	data.preventRender = true;
}; // App.preventViewRender

App.initViews = function(params) {
	
	data.preventRender = false; // flag to stop the next render operation
	data.viewWrapper = $('[data-role="viewwrapper"]');
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
	// show default page
	changeView(data.defaultPage);
	
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