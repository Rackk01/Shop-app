
<?php
if (file_exists('php/services/service.php')) {
    require_once('php/services/service.php');
    require_once('php/helper/error.php');
    require_once('php/util/methods.php');
} else {
    require_once('../php/services/service.php');
    require_once('../php/helper/error.php');
    require_once('../php/util/methods.php');
}

// =====================================================================================================================================
// VARIABLES ASOCIADAS A LAS VISTAS

// =====================================================================================================================================
// =====================================================================================================================================
// =====================================================================================================================================
// FUNCIONES

function getAllActiveCombos()
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getAllActiveCombos');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('combo.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            if (decodificarData($value) == '0') {
                return 0;
                break;
            }
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    return reemplazarPorAcentos($responseQuery); // [{"id":"1","denom":"Super combo de alimentos orgánicos, frescos y listos para el consumo!","fecvenci":"2022-09-10","tipobonifi":"F","bonifi":"690.25","pretot":"5689.25","prefin":"4999.00","stoact":"7.000","stoini":"10.000","porven":"70"}]
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getAllCombos()
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getAllCombos');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('combo.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            if (decodificarData($value) == '0') {
                return 0;
                break;
            }
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    return reemplazarPorAcentos($responseQuery); // [{"id":"1","denom":"Super combo de alimentos orgánicos, frescos y listos para el consumo!","fecvenci":"2022-09-10","tipobonifi":"F","bonifi":"690.25","pretot":"5689.25","prefin":"4999.00","stoact":"7.000","stoini":"10.000","porven":"70"}]
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getAllProductsOfCombo($idCombo)
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getAllProductsOfCombo');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'idCombo' => $idCombo
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('combo.php', $funcion, $bd, $jsonDataArray));
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

function getOneComboOfCod($id)
{
    $funcion = codificarData('getOneComboOfCod');
    $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'id' => $id
    );

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('combo.php', $funcion, $bd, $jsonDataArray));
    $array = json_decode($response, true);

    // setMessageInfoText('$response', $response);

    $responseQuery = '';
    foreach ($array as $key => $value) {
        if ($key == 'data') {
            if (decodificarData($value) == '0') {
                return 0;
                break;
            }
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue);
        }
    }

    $responseQuery = reemplazarPorAcentos(str_replace('\/', '/', $responseQuery));
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    return $responseQuery;
}

function getAllImgsOfOneCombo($numero)
{

    $arrayUrlImageCombo = [];
    for ($i = 1; $i < 10; $i++) {
        if (file_exists(__DIR__ . "/../../src/img/combos/{$numero}_{$i}.png")) {
            array_push($arrayUrlImageCombo, URL_APP . "src/img/combos/{$numero}_{$i}.png");
        }else{
            break;
        }
    }
    if(count($arrayUrlImageCombo) < 1){
        array_push($arrayUrlImageCombo, URL_APP . "src/img/combos/default.jpg");
    }
    return $arrayUrlImageCombo;
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