/**
 * Helper function to sort on object properties
 * Passed to array.sort() when sorting an array of objects
 */
var sortBy = function(property, direction) {
	direction = direction || 'ASC';
	var sortOrder = direction.toUpperCase() == 'ASC' ? 1: -1;
	return function(a, b) {
		if (a[property] > b[property]) return sortOrder;
		if (a[property] == b[property]) return 0;
		if (a[property] < b[property]) return -1 * (sortOrder);
	};
};
