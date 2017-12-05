$(document).ready(function() {

var stubName = 'event-app-page';


// set up button handler

$('#content')
	.on('click','button, input[type="button"]', function(e) {
		
		var $this = $(this);
		
		switch(true) {
			case $this.hasClass('btnAdd'):
				// redirect to add action
				window.location.href = stubName + '/?view=manage&action=add';
			break; // btnAdd
			
			case $this.hasClass('btnView'):
				var id = $this.attr('data-id'); // get row id from button
			
				// redirect to edit action
				window.location.href = stubName + '/?view=manage&action=edit&id='+id;
			break; // btnView
			
		}; // switch
		
	 }); 

	 
// date helper
var $eventDate = $('[name="event_date"]');

if ($eventDate.val() == '' || typeof $eventDate.val() == 'undefined') {
	$eventDate
		.data('value', { datey:'', 
						 datem:'', 
						 dated:'', 
						 timehr:'', 
						 timemin:'' });	 

} else {
	// parse and store existing event_date value
	edData = $eventDate.val().split(' ');
	edData0 = edData[0].split('-');
	edData1 = edData[1].split(':');
	
	$eventDate
		.data('value', { datey:edData0[0], 
						 datem:edData0[1], 
						 dated:edData0[2], 
						 timehr:edData1[0], 
						 timemin:edData1[1] });	 
}


$('#eventdate').on('change','.datecomponent', function(e) {
	var dcName = $(this).attr('name');
	var val = $(this).val();
	if (val == '') return; // do nothing if the value is empty
	
	var $data = $eventDate.data('value');
	$data[dcName] = val;
	$eventDate.data('value', $data);
	$eventDate.val($data.datey +'-'+
				   $data.datem +'-'+
				   $data.dated +' '+
				   $data.timehr +':'+
				   $data.timemin +':00');
	
 }); 

}); // document.ready
