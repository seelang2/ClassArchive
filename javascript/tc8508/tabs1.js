/* tabs.js */


// use object as simple namespace
var App = {};
App.data = {}; // simple data registry

App.start = function() {
	
	// hijack all nav links
	App.data.pageLinks = 
	$('.tab a')
		.removeClass('active')
		.each(App.hijackLinks);
	
	// update hash location to default page location
	App.data.defaultPageName = $('[data-role~="default"]').attr('data-name');
	history.pushState({}, '', '#!' + App.data.defaultPageName);
	App.updatePage(App.data.defaultPageName);
	
	// listen for window history changes
	$(window).on('popstate', App.changePage);
	
}; // App.start

App.hijackLinks = function(index, linkElem) {
	
	var href = $(linkElem).attr('href');
	
	$(linkElem).attr('href','#!' + href);
	
}; // App.hijackLinks

App.changePage = function(e) {
	
	console.log(e.state,window.location);
	
	var pageName = window.location.hash;
	// remove #! from name
	pageName = pageName.replace('#!','');
	
	if (pageName == '') {
		pageName = App.data.defaultPageName;
		history.pushState({}, '', '#!' + App.data.defaultPageName);
	}
	
	App.updatePage(pageName);
	
}; // App.changePage

App.updatePage = function(pageName) {
	
	// 
	$('[data-role~="view"]')
		.not('[data-name="'+ pageName +'"]')
			.hide()
			.end()
		.filter('[data-name="'+ pageName +'"]')
			.show();
	
	App.data.pageLinks
		.parent()
			.removeClass('active')
			.end()
		.filter('[href="#!'+ pageName +'"]')
			.parent()
			.addClass('active');
			
}; // App.updatePage

$(document).ready(App.start); // launches App.start() on DOM ready

