$(document).ready(function() {
    // initialize accordions
    $(document.body).initAccordion();

    // set up report archive link updater
    $('.monthlyolder').on('change', function(evt) {
    	var selectElem = $(this);
    	var url = selectElem.val();
    	
    	var year =
    	selectElem
    		.children('[value="'+ url +'"]')
    		.attr('data-year');

    	selectElem
    		.closest('.monthlyoldercontainer')
    		.find('.monthlyolderdownload')
    		.each(function(i,elem) {
    			var href = $(elem).attr('href'); // get base url in href
    			href = href + year + '/' + url;
    			$(elem).attr('href', href);
    		});
     });

    $('.quarterlyolder').on('change', function(evt) {
    	var selectElem = $(this);
    	var url = selectElem.val();
    	
    	var year =
    	selectElem
    		.children('[value="'+ url +'"]')
    		.attr('data-year');

    	selectElem
    		.closest('.quarterlyoldercontainer')
    		.find('.quarterlyolderdownload')
    		.each(function(i,elem) {
    			var href = $(elem).attr('href'); // get base url in href
    			href = href + year + '/' + url;
    			$(elem).attr('href', href);
    		});
     });

})
