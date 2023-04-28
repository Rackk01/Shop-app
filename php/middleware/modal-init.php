<?php
// LRUBRO

require_once('php/services/service.php');
require_once('php/helper/error.php');
require_once('php/util/methods.php');

// setMessageInfoText('getAllCategories | $array', $array);

// =====================================================================================================================================
// VARIABLES DE LAS CATEGORÍAS ASOCIADAS A LAS VISTAS

/* 
$dataArrayModalInit = getInfoModalInit();
Por defecto desde el backend si la consulta no encuentra dato $dataArrayModalInit es igual a cero
De lo contrario contiene los datos del registro en formato json
[{"id":"1","isactive":"t","numprod":"17","precprod":"1500.00","titletop":"¡Oferta del día!","tipdesc":"P","descuento":"20.00","dateend":"2022-08-14"}]
*/
$dataArrayModalInit = getInfoModalInit();
// setMessageInfoText('dataArrayModalInit', ($dataArrayModalInit));
// if ($dataArrayModalInit != 0) {
//     // setMessageInfoText('$dataArrayModalInit != 0' , json_decode($dataArrayBranchesOffices, true));

// }

// =====================================================================================================================================

// =====================================================================================================================================

// =====================================================================================================================================
// FUNCIONES

function getInfoModalInit()
{
    /*
    Si hay dato: Devuelve 0 (cero) si la consulta correspondiente del backend no encuentra dato.
    Si no hay dato: Devuelve [{"id":"1","isactive":"t","numprod":"17","precprod":"1500.00","titletop":"¡Oferta del día!","tipdesc":"P","descuento":"20.00","dateend":"2022-08-14"}]
    */
    $funcion = codificarData('getInfoModalInit');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';
    foreach ($array as $key => $value) {
        if ($key == 'data') {
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    return reemplazarPorAcentos($responseQuery);
}

// =====================================================================================================================================