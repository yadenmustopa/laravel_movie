"use strict";

/**
 *
 * @param { Number } start
 * @param { Number } number_of
 * @returns
 */
 function arrayOfStepNumber( start, number_of ){
	if ( number_of <= 0 ){
		return [];
	}

	let result = [];

	for( let i = start ; i <= number_of ; i++ ){
		result.push(i);
	}

	return result;
}


export { arrayOfStepNumber }
