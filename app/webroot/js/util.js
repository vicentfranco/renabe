String.format = function () {
    // The string containing the format items (e.g. "{0}")
    // will and always has to be the first argument.
    var theString = arguments[0];

    // start with the second argument (i = 1)
    for (var i = 1; i < arguments.length; i++) {
        // "gm" = RegEx options for Global search (more than one instance)
        // and for Multiline search
        var regEx = new RegExp("\\{" + (i - 1) + "\\}", "gm");
        theString = theString.replace(regEx, arguments[i]);
    }

    return theString;
}


function getFocus(element) {
        $(element).focus();
}

function addMessageError(element, message) {
        $(element + " strong").remove();
        $(element).append("<strong>" + message + "</strong>");
}

/**
 * Deshabilita todos los input que estan dentro del element pasado como parametro
 * @param {type} parent element contenedor de inputs
 * @param {type} bool true o false
 */
function disabledInputElement(parent, bool) {
    $(parent).find('input').prop('disabled', bool);
}