/* Testing Application */

// test data/parameters
testData = [
	{
		fieldName: 'field1',
		validFieldData: 'Some data',
		invalidFieldData: '',
		validationMessage: 'Field cannot be empty'
	},
	{
		fieldName: 'field2',
		validFieldData: 'More data',
		invalidFieldData: 'x',
		validationMessage: 'Field must be between 4 and 10 characters'
	},
	{
		fieldName: 'field3',
		validFieldData: 7,
		invalidFieldData: 'sdfgsdfg',
		validationMessage: 'Field must be numeric'
	}
];



var submitTrigger = new Event('submit');
var formElem = document.getElementById('theform');


for (var c = 0; c < testData.length; c++) {
	// TEST 1: Positive Response
	console.log('#' + (c+1) + ': Field ' + 
				testData[c].fieldName +  
				' TEST 1: valid data using data ' + testData[c].validFieldData);

	var fieldElem = document.getElementsByName(testData[c].fieldName)[0];
	fieldElem.value = testData[c].validFieldData; // populate field
	formElem.dispatchEvent(submitTrigger); // trigger form submit event handlers
	if (fieldElem.nextElementSibling.innerHTML == '') {
		console.log('Affirmative - field valid; No error message displayed');
	} else {
		console.log('Negative - field valid; Error message displayed');
	}

	// TEST 2: Negative Response
	console.log('#' + (c+1) + ': Field ' + 
				testData[c].fieldName +  
				' TEST 2: invalid data using data ' + testData[c].invalidFieldData);

	var fieldElem = document.getElementsByName(testData[c].fieldName)[0];
	fieldElem.value = testData[c].invalidFieldData; // populate field
	formElem.dispatchEvent(submitTrigger); // trigger form submit event handlers
	if (fieldElem.nextElementSibling.innerHTML == '') {
		console.log('Negative - field invalid; No error message displayed');
	}

	if (fieldElem.nextElementSibling.innerHTML == testData[c].validationMessage) {
		console.log('Affirmative - field invalid; Correct error message displayed');
	} else {
		console.log('Negative - field invalid; Incorrect error message displayed');
	}

} // for testData


