/*
	Javascript library functions
*/

function getTracker(totalTasks, nextFunction) {
	var tasksCompleted = 0;
	
	// create a deferred object to serve as a tracker
	var tracker = $.Deferred();

	tracker
		.progress(function() {
			tasksCompleted++;
			console.log(tasksCompleted + ' tasks completed.');

			if (tasksCompleted == totalTasks) {
				tracker.resolve(); // work is done so complete tracker
			}
		})
		.done(function() {
			nextFunction(); // proceed to the app next step
		})

	return tracker;
} // getTracker
