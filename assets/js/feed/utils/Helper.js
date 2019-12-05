/**
 * Toggles a specific value in and out of an array
 *
 * @param {array} arr - The array to toggle from
 * @param val - The value to toggle
 */
function toggleInArray(arr, val) {
  let x = [...arr];

  if (x.includes(val)) {
    x.splice(x.indexOf(val), 1);
  } else {
    x.push(val);
  }

  return x;
}

/**
 * Gets a specific parameter from a hash string
 *
 * @param {string} params - Hash string containing all the parameters
 * @param {string} selected - Selected key you want to get
 * @param {string} format - The return format
 *
 * @return {string|number|boolean|array} - Param value in chosen format
 */
function getParam(params, selected, format = 'string') {
  if (!params || params === null || !selected) return false;

  const data = [];
  const str =
    params.substring(0, 2) === '#/' ? params.substring(2) : params.substring(1);
  const pairs = str.split('&');

  pairs.forEach((pair) => {
    const keyvalue = pair.split('=');

    data[keyvalue[0]] = keyvalue[1];
  });

  if (!data[selected] || (format === 'array' && !data[selected].length)) {
    return false;
  }

  switch (format) {
    case 'number': {
      return parseFloat(data[selected]);
    }
    case 'boolean': {
      return data[selected] === 'true';
    }
    case 'array': {
      return data[selected].split(',');
    }
    case 'numberArray': {
      return data[selected].split(',').map((item) => parseFloat(item));
    }
    default: {
      return data[selected];
    }
  }
}

/**
 * Gets the name values of all the taxonomies in an array.
 *
 * @param {array} arr - Contains all the taxonomies
 *
 * @return {array} - Array containing the name values
 */
function getTaxonomyNames(arr) {
  return arr.map((taxonomy) => {
    return taxonomy.name;
  });
}

/**
 * Generates a hash string from an object containing key value pairs.
 *
 * @param {obj} params - Key value pairs to generate hash params from
 *
 * @return {string} - Hash string
 */
function generateHashString(params) {
  let str = '';

  Object.keys(params).forEach((key) => {
    if (params[key]) {
      str += `&${key}=${params[key]}`;
    }
  });

  return str.slice(1, str.length);
}

/**
 * Checks if the key pressed is the Enter key
 *
 * @param {object} event - The event object
 * @param {funcion} callback - Callback function to call if enter
 */
function isEnterKey(event, callback) {
  if (event.keyCode === 13 || event.charCode === 13) {
    callback();
  }
}

/**
 * Checks if the key pressed is the Escape key
 *
 * @param {object} event - The event object
 * @param {funcion} callback - Callback function to call if escape
 */
function isEscapeKey(event, callback) {
  if (event.keyCode === 27 || event.charCode === 27) {
    callback();
  }
}

export const helper = {
  toggleInArray,
  getParam,
  getTaxonomyNames,
  generateHashString,
  isEnterKey,
  isEscapeKey,
};
