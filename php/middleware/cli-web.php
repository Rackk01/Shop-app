<?php
// LRUBRO

if (file_exists('php/services/service.php')) {
    require_once('php/services/service.php');
    require_once('php/helper/error.php');
    require_once('php/util/methods.php');
} else {
    require_once('../php/services/service.php');
    require_once('../php/helper/error.php');
    require_once('../php/util/methods.php');
}

// setMessageInfoText('getAllCategories | $array', $array);

// =====================================================================================================================================
// VARIABLES DE LAS CATEGORÍAS ASOCIADAS A LAS VISTAS

// =====================================================================================================================================

// =====================================================================================================================================

// =====================================================================================================================================
// FUNCIONES

function getAllCliWeb()
{
    $funcion = codificarData('getAllClientWeb');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    // $dataArray = array(
    //     'idCategoria' => $idCategoria,
    //     'orderBy' => $orderBy
    // );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    // $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequest('cliente-web.php', $funcion, $bd));
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

    return $responseQuery;
}