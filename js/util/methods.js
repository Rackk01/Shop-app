function round(num, decimales) {
    var signo = (num >= 0 ? 1 : -1);
    num = num * signo;
    if (decimales === 0) //con 0 decimales
        return signo * Math.round(num);
    // round(x * 10 ^ decimales)
    num = num.toString().split('e');
    num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
    // x * 10 ^ (-decimales)
    num = num.toString().split('e');
    return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
}

function getParameterByName(name) {
    // Obtiene y devuelve el valor de una variable enviada/recibida por GET en la URL de la app. Busca por el nombre de la variable.
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function setFormatoMoneda(monto) {
    let deccant = parseInt(2);
    return Intl.NumberFormat("de-DE").format(truncarDecimales(monto, deccant));
}

function truncarDecimales(num, digits) {
    var numS = num.toString(),
        decPos = numS.indexOf('.'),
        substrLength = decPos == -1 ? numS.length : 1 + decPos + digits,
        trimmedResult = numS.substr(0, substrLength),
        finalResult = isNaN(trimmedResult) ? 0 : trimmedResult;

    return parseFloat(finalResult);
}

/**
 * 
 * @param {String} value Importe en formato monerda (Con '.' para miles y ',' para decimales)
 * @returns float number
 */
function monedaToFloat(value) {
    return parseFloat(value.toString().replaceAll('.', '').replaceAll(',', '.'));
}

/**
 * 
 * @param {String} url Url absoluta
 * @returns Retorna si existe o no el archivo
 */
async function file_exists(url) {
    const formData = new FormData();
    formData.append('funcion', 'file_exists');
    formData.append('url', url);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'functions.php', {
            method: 'POST',
            body: formData
        });
        return !!parseInt(await res.text());
    } catch (error) {
        console.log(error);
    }
}

/**
 * 
 * @param {string} fecha Formato de fecha yyyy-mm-dd
 * @returns fecha dd/mm/yyyy
 */
function setDateFormat(fecha) {
    const [año, mes, dia] = fecha.split('-');

    const result = [dia.toString().padStart(2, '0'), mes.toString().padStart(2, '0'), año].join('/');

    return result;
}

/**
 * 
 * @param {string} fecha Formato de fecha dd/mm/yyyy
 * @returns fecha yyyy-mm-dd
 */
function setDateFormatIso(fecha) {
    const [dia, mes, año] = fecha.split('/');

    const result = [año, mes.toString().padStart(2, '0'), dia.toString().padStart(2, '0')].join('-');

    return result;
}

/**
 * Recibe el formato timestamp with timezone de Postgresql (yyyy-mm-dd hh:mm:ss-tz)
 * Retorna un objeto con day (yyyy-mm-dd) y hour (hh:mm:ss)
 */
function separateDayHour(date)
{
    [day, hour] = date.split(' ');

    hour = hour.split('-')[0];

    return {'day': day, 'hour': hour};
}