/* tabs.js */
// use IIFE namespace strategy

(function(App) {

// because data is declared inside of the IIFE it's private
// and can't be accessed from outside the IIFE scope
var data = {}; // simple data registry

// set default page
data.defaultPageName = 'newtabs_content1.html';

App.start = function() {
	
	// hijack all nav links
	data.pageLinks = 
	$('.tab a')
		.removeClass('active')
		.each(App.hijackLinks);
	
	// update hash location to default page location
	history.pushState({}, '', '#!' + data.defaultPageName);
	App.updatePage(data.defaultPageName);
	
	// listen for window history changes
	$(window).on('popstate', App.changePage);
	
}; // App.start

App.hijackLinks = function(index, linkElem) {
	
	var href = $(linkElem).attr('href');
	
	$(linkElem).attr('href','#!' + href);
	
}; // App.hijackLinks

App.changePage = function(e) {
	
	//console.log(e.state,window.location);
	
	var pageName = window.location.hash;
	// remove #! from name
	pageName = pageName.replace('#!','');
	
	if (pageName == '') {
		pageName = data.defaultPageName;
		history.pushState({}, '', '#!' + data.defaultPageName);
	}
	
	App.updatePage(pageName);
	
}; // App.changePage

App.updatePage = function(pageName) {
	
	/*
	Note that the following code will not work because the ajax call
	is asynchronous and likely will not have completed by the time
	the .children() method is called.
	
	// load new view template
	$('<div />')
		.load(pageName)
		.children()
		.appendTo('#wrapper');
	*/
	
	$.ajax({
		url:		pageName,
		type:		'get',
		dataType:	'html',
		success:	function(content) {
			// remove current view
			$('#pagecontent')
				.empty()
				.append(content);
		}
	});
	
	data.pageLinks
		.parent()
			.removeClass('active')
			.end()
		.filter('[href="#!'+ pageName +'"]')
			.parent()
			.addClass('active');
			
}; // App.updatePage


})(window.App = window.App || {});

$(document).ready(App.start); // launches App.start() on DOM ready

