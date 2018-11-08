/**
 * 
 */
function bar() {
	return 'cool stuff';
}

function bar2(text) {
	return '<p>' + text + '</p>';
}

function getOrdinal(num) {
	var lastDigit = num % 10;
	var last2Digits = num % 100;

	switch(true) {
		case lastDigit == 1 && last2Digits != 11:
			var ordinal = 'st';
		break;
		case lastDigit == 2 && last2Digits != 12:
			var ordinal = 'nd';
		break;
		case lastDigit == 3 && last2Digits != 13:
			var ordinal = 'rd';
		break;
		default:
			var ordinal = 'th';
		break;
	}

	return ordinal; // return ordinal suffix
} // getOrdinal
