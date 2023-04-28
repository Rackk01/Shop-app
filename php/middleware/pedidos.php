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
// VARIABLES

// =====================================================================================================================================

// =====================================================================================================================================

// =====================================================================================================================================
// FUNCIONES


function getAllSales()
{
    $funcion = codificarData('getAllSales');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    // $dataArray = array(
    //     'idCategoria' => $idCategoria,
    //     'orderBy' => $orderBy
    // );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    // $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequest('pedido.php', $funcion, $bd));
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

// =====================================================================================================================================

function getOneSaleOfCod($nrocomp)
{
    $funcion = codificarData('getOneSaleOfCod');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'nrocomp' => $nrocomp
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('pedido.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('$response', $response);

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

    $responseQuery = reemplazarPorAcentos($responseQuery); // return $responseQuery;
    // $responseQuery = properText($responseQuery);
    return $responseQuery;
}

// =====================================================================================================================================

function getAllProductsOfSaleCod($nrocomp)
{
    $funcion = codificarData('getAllProductsOfSaleCod');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'nrocomp' => $nrocomp
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('pedido.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('$response', $response);

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

    $responseQuery = reemplazarPorAcentos($responseQuery); // return $responseQuery;
    // $responseQuery = properText($responseQuery);
    return $responseQuery;
}

// =====================================================================================================================================

function getAllCombosOfSaleCod($nrocomp)
{
    $funcion = codificarData('getAllCombosOfSaleCod');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'nrocomp' => $nrocomp
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('pedido.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('$response', $response);

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

    $responseQuery = reemplazarPorAcentos($responseQuery); // return $responseQuery;
    // $responseQuery = properText($responseQuery);
    return $responseQuery;
}

// =====================================================================================================================================

function getAllOrdersFromACustomer($idCustomer)
{
    // Obtiene todos los pedidos de un cliente. Realiza la búsqueda por código de cliente
    $funcion = codificarData('getAllOrdersFromACustomer');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'idCustomer' => $idCustomer
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('pedido.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('$response', $response);

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

    $responseQuery = reemplazarPorAcentos($responseQuery); // return $responseQuery;
    // $responseQuery = properText($responseQuery);
    return $responseQuery;
}

// =====================================================================================================================================

function getAllPaymentMethods()
{
    $funcion = codificarData('getAllPaymentMethods');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    // $dataArray = array(
    //     'idCategoria' => $idCategoria,
    //     'orderBy' => $orderBy
    // );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    // $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequest('pedido.php', $funcion, $bd));
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

// =====================================================================================================================================

function getAllShippingMethods()
{
    $funcion = codificarData('getAllShippingMethods');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    // $dataArray = array(
    //     'idCategoria' => $idCategoria,
    //     'orderBy' => $orderBy
    // );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    // $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequest('pedido.php', $funcion, $bd));
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

// =====================================================================================================================================

function getAllOrderStates()
{
    $funcion = codificarData('getAllOrderStates');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    // $dataArray = array(
    //     'idCategoria' => $idCategoria,
    //     'orderBy' => $orderBy
    // );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    // $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequest('pedido.php', $funcion, $bd));
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

// =====================================================================================================================================

function getAllOrderComments($orderId)
{
    $funcion = codificarData('getAllOrderComments');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'id' => $orderId
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('pedido.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('$response', $response);

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

    $responseQuery = reemplazarPorAcentos($responseQuery); // return $responseQuery;
    // $responseQuery = properText($responseQuery);
    return $responseQuery;
}

// =====================================================================================================================================
