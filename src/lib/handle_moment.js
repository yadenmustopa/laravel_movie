import moment from 'moment';

/**
 *
 * @param { String } date_time
 */
function fromNow( date_time ){
    return moment( date_time ).fromNow();
}

/**
 *
 * @param { String } date_time
 * @param { String } format
 */
function changeFormat( date_time, format = "YYYY-MMM-DD" ){
    return moment( date_time ).utc().format( format );
}

export { fromNow, changeFormat };

