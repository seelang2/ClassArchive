/***********************
 *	Filename: collapsible.js
 *	Version: 1.0 
 *	Auth: Chris Langtiw chris@sitebabble.com http://www.sitebabble.com
 *	License: Creative Commons Attribution 3.0 Unported License
 *	License URL: http://creativecommons.org/licenses/by/3.0/deed.en_US
 *	
 *	Description:
 *	This script will take an unordered list with the class 'collapsible' attached to it
 *	and make any unordered lists nested within it collapsible. It uses the following 
 *	classes for presentation support:
 *
 *		.collapsible	- Flags any descendant ULs to show/hide when clicked
 *		.pointer		- used to indicate the item is clickable (change cursor to pointer)
 *		.open			- indicates open sublist
 *		.closed			- indicates closed sublist
 *
 *	IMPORTANT NOTE: 
 *	When creating a nested list, make sure to place the sublist text label inside an element
 *	such as a SPAN so that the list structure can be traversed properly!
 *
 *	A demo can be found at list4.html.
 *
 ***/

$(document).ready(function() {
	// hide sublists
	$('.collapsible li ul')			// select all sublist ULs
		.hide()						// ... and hide them
		.prev()						// then traverse to the SPANs
		.addClass('closed')			// set the default class to closed
		.hover(
			function() {
				$(this).toggleClass('pointer');
			}
		 )
		.click(						// When the SPAN is clicked...
			function(e) {
				$(this)				// for this SPAN
					.toggleClass('closed open')
					.next()			// traverse to the sublist UL
					.toggle();		// ... and toggle it
			}
		 );
		
}); // document.ready


