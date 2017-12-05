var PostApp = {};

PostApp.post = function(data) {

		$.ajax({
			url:		'http://10.6.10.123/tc7224/userdata.php?action=saveuser',
			type:		'post',
			dataType:	'json',
			data:		data,
			success:	function(response) {
				if (response.status == 0) {
					// error occurred - no soup for you! *snap*
					alert('There was an error saving the record.');
				} else {
					// All kosher
					alert('The record has been saved.');
				}
			}
		});
		
}; // PostApp.post

