<?php
// LRUBRO

if (file_exists('php/services/service.php')) {
    require_once('php/services/service.php');
    require_once('php/helper/error.php');
    require_once('php/util/methods.php');
    require_once('php/constants.php');
} else {
    require_once('../php/services/service.php');
    require_once('../php/helper/error.php');
    require_once('../php/util/methods.php');
    require_once('../php/constants.php');
}

// setMessageInfoText('getAllCategories | $array', $array);

// =====================================================================================================================================
// VARIABLES DE LAS CATEGORÍAS ASOCIADAS A LAS VISTAS

$dataArrayStatesOfProducts = getAllStatesOfProducts();
$amountOfStatesOfProducts = count(json_decode($dataArrayStatesOfProducts, true));

// =====================================================================================================================================

// =====================================================================================================================================

// =====================================================================================================================================
// FUNCIONES

function getAllProductsOfCategory($idCategoria, $orderBy)
{
    $funcion = codificarData('getAllProductsOfCategory');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'idCategoria' => $idCategoria,
        'orderBy' => $orderBy
    );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('RESPONSE getAllProductsOfCategory -->  ', $array);

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

function getAllProductsOfCategoryForAnSpecialState($idCategoria, $idState, $orderBy)
{
    /* Busca todos los productos de una categoría que correspondan a un estado (pr.id_estado) correspondiente */
    $funcion = codificarData('getAllProductsOfCategoryForAnSpecialState'); // getAllProductsOfCategory
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'idCategoria' => $idCategoria,
        'idState' => $idState,
        'orderBy' => $orderBy
    );

    // setMessageInfoText('dataArray', json_encode($dataArray));
    // return;
    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    // $response = (SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('RESPONSE response getAllProductsOfCategory -->  ', $response);

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

function getAllProducts()
{
    $funcion = codificarData('getAllProducts');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    // $dataArray = array(
    //     'idCategoria' => $idCategoria,
    //     'orderBy' => $orderBy
    // );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    // $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequest('producto.php', $funcion, $bd));
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

function getAllProductsSpecials()
{
    $funcion = codificarData('getAllProductsSpecials');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('producto.php', $funcion, $bd));
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

function getAllProductsSpecialsForIdState($idStateSpecial, $orderBy)
{
    // $idStateSpecial ===>> Si es 9999 equivale a todos los estados (sin incluír el 4 que es sin estado)

    $funcion = codificarData('getAllProductsSpecialsForIdState');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'idStateSpecial' => $idStateSpecial,
        'orderBy' => $orderBy
    );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    // $response = decodificarData(SendRequest('producto.php', $funcion, $bd));

    setMessageInfoText('response', $response);

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

function getAmountOfCategoriesForStateId($idStateSpecial)
{
    $funcion = codificarData('getAmountOfCategoriesForStateId');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'idStateSpecial' => $idStateSpecial
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    $responseQuery = '';
    foreach ($array as $key => $value) {
        if ($key == 'data') {
            if ($value == '0' || $value == 0) {
                $responseQuery = 0; // json_encode($arrayValue);
            } else {
                $arrayValue = json_decode(decodificarData($value), true);
                $responseQuery = json_encode($arrayValue);
            }
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    return $responseQuery;
}

function getAllPresOfProduct($idProduct)
{
    $funcion = codificarData('getAllPresOfProduct');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'idProduct' => $idProduct
    );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('response', $response);

    if (trim($response) == '') return 0;

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

function getOneProductOfCod($id)
{
    $funcion = codificarData('getOneProductOfCod');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'num' => $id
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
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

    setMessageInfoText('respnse limpio', $responseQuery);
    setMessageInfoText('respnse limpio utf8_decode', utf8_decode($responseQuery));
    setMessageInfoText('respnse limpio utf8_encode', utf8_encode($responseQuery));

    $responseQuery = reemplazarPorAcentos($responseQuery); // return $responseQuery;
    // $responseQuery = properText($responseQuery);
    setMessageInfoText('respnse reemplazarPorAcentos', $responseQuery);
    setMessageInfoText('respnse reemplazarPorAcentos utf8_decode', utf8_decode($responseQuery));
    setMessageInfoText('respnse reemplazarPorAcentos utf8_encode', utf8_encode($responseQuery));
    return $responseQuery;
}

function getFirstImgProductOfCod($id)
{
    $funcion = codificarData('getFirstImgProductOfCod');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'num' => $id
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
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
    $responseQuery = str_replace('[', '', $responseQuery);
    $responseQuery = str_replace(']', '', $responseQuery);

    $responseQuery = reemplazarPorAcentos($responseQuery); // return $responseQuery;
    // $responseQuery = properText($responseQuery);
    return $responseQuery;
}

function getAllProductsWithTxt($txt, $orderBy)
{
    $funcion = codificarData('getAllProductsWithTxt');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $text = trim($txt);

    $dataArray = array(
        'txt' => $text,
        'orderBy' => $orderBy
    );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    $responseQuery = '';
    foreach ($array as $key => $value) {
        if ($key == 'data') {
            if ($value == '0' || $value == 0) {
                $responseQuery = 0; // json_encode($arrayValue);
            } else {
                $arrayValue = json_decode(decodificarData($value), true);
                $responseQuery = json_encode($arrayValue);
            }
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('responseQuery', $responseQuery);
    return $responseQuery;
}

function getAmountOfCategories($txt)
{
    $funcion = codificarData('getAmountOfCategoriesWithTxt');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $text = trim($txt);

    $dataArray = array(
        'txt' => $text
    );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    $responseQuery = '';
    foreach ($array as $key => $value) {
        if ($key == 'data') {
            if ($value == '0' || $value == 0) {
                $responseQuery = 0; // json_encode($arrayValue);
            } else {
                $arrayValue = json_decode(decodificarData($value), true);
                $responseQuery = json_encode($arrayValue);
            }
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    return $responseQuery;
}

function getAllProductsOfCategoryWithText($numRubro, $txt, $orderBy)
{
    $funcion = codificarData('getAllProductsOfCategoryWithText');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $text = trim($txt);

    $dataArray = array(
        'txt' => $text,
        'numRubro' => $numRubro,
        'orderBy' => $orderBy
    );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));
    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
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

function getAllImgsOfOneProduct($numero)
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getAllImgsOfOneProduct');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'numero' => $numero
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery | getBranchesOffices()', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getAllStatesOfProducts()
{
    $funcion = codificarData('getAllStatesOfProducts');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('producto.php', $funcion, $bd));
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

function getAllEditableStatesOfProducts()
{
    $funcion = codificarData('getAllEditableStatesOfProducts');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('producto.php', $funcion, $bd));
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

function getAllImgsOfOneProductSecondOption($numero)
{

    $arrayUrlImageProducto = [];
    for ($i = 1; $i < 10; $i++) {
        if (file_exists(__DIR__ . "/../../src/img/productos/{$numero}_{$i}.png")) {
            array_push($arrayUrlImageProducto, URL_APP . "src/img/productos/{$numero}_{$i}.png");
        }
    }
    if(count($arrayUrlImageProducto) < 1){
        array_push($arrayUrlImageProducto, URL_APP . "src/img/productos/default.jpg");
    }
    return $arrayUrlImageProducto;
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    // $funcion = codificarData('getAllImgsOfOneCombo');
    // $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    // $dataArray = array(
    //     'numero' => $numero
    // );

    // $jsonDataArray = codificarData(json_encode($dataArray));

    // $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
    // $array = json_decode($response, true);

    // $responseQuery = '';

    // // setMessageInfoText('empres-config.php', $response);

    // foreach ($array as $key => $value) {
    //     if ($key == 'data') {
    //         // echo decodificarData($value);
    //         $arrayValue = json_decode(decodificarData($value), true);
    //         $responseQuery = json_encode($arrayValue, true);
    //     }
    // }

    // $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery | getBranchesOffices()', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    // return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}
// =====================================================================================================================================
// =====================================================================================================================================