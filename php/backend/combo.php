<?php

session_start();

require_once('../constants.php');
require_once('../helper/error.php');
require_once('../services/service.php');
require_once('../util/methods.php');
require_once('../util/validator.php');

if (!isset($_POST['funcion']) || trim($_POST['funcion'] == '')) {
    $errorMessage = sendErrorMessage(410);

    $array = array(
        'status' => 410,
        'result' => $errorMessage
    );

    echo json_encode($array);
    return;
    die;
}

$funcion = $_POST['funcion'];

switch ($funcion) {
        // =====================================================================================================================================
        #region
    case 'getOneComboOfCod':
        $funcion = codificarData('getOneComboOfCod');
        $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $dataArray = array(
            'id' => intval($_POST['id'])
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

        echo $responseQuery;
        break;
        #endregion
        // =====================================================================================================================================
        #region
    case 'getAllProductsOfCombo':
        $funcion = codificarData('getAllProductsOfCombo');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $dataArray = array(
            'idCombo' => intval($_POST['id'])
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
        echo reemplazarPorAcentos($responseQuery);
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        // =====================================================================================================================================
        #region
    case 'getAllImgsOfOneCombo':

        $funcion = codificarData('getAllImgsOfOneCombo');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $dataArray = array(
            'numero' => $_POST['numero']
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
        echo reemplazarPorAcentos($responseQuery);
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        break;
        #endregion
        // =====================================================================================================================================
        #region newOrUpdateCombo
    case 'newUpdateCombo':

        $dataArray = array(
            // 'numero' => $_POST['numero'],
            'denom' => $_POST['denom'],
            'descrip' => $_POST['descrip'],
            'vencimiento' => $_POST['vencimiento'],
            'stock' => $_POST['stock'],
            'stockAct' => $_POST['stockAct'],
            'pBase' => $_POST['pBase'],
            'pFinal' => $_POST['pFinal'],
            'bonificacion' => $_POST['bonificacion'],
            'tipoBonificacion' => $_POST['tipoBonificacion'],
            'productos' => $_POST['productos']
        );

        if ($_POST['numero'] != '') {
            $dataArray['numero'] = $_POST['numero'];
            $funcion = codificarData('updateCombo');
        } else {
            $funcion = codificarData('newCombo');
        }
        // setMessageInfoText('data', json_encode($dataArray));
        // return;
        // setMessageInfoText('data', decodificarData($funcion));
        // setMessageInfoText('data', json_encode($_FILES['principal']));
        // setMessageInfoText('data', json_encode($_FILES['secundaria']));
        // setMessageInfoText('data', json_encode($_FILES['terciaria']));

        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = json_decode(SendRequestOneParam('combo.php', $funcion, $bd, $jsonDataArray), true);

        // setMessageInfoText('rta', json_encode($response));

        if ($response['status'] == 'ss1') {

            require_once('../libs/img-upload/function_compresion.php');

            $urlSave = '../../src/img/combos';

            if (isset($_FILES['file_principal'])) {
                $img1 = $_FILES['file_principal'];
                comprimirImagen($img1, $response['id'] . '_1', 750, 750, 40, $urlSave, 56320);
                // addOrUpdateImgCombo($response['id'], $_POST['denom'], $response['id'] . '_1.png');
            }
            if (isset($_FILES['file_secundaria'])) {
                $img2 = $_FILES['file_secundaria'];
                comprimirImagen($img2, $response['id'] . '_2', 750, 750, 40, $urlSave, 56320);
                // addOrUpdateImgCombo($response['id'], $_POST['denom'], $response['id'] . '_2.png');
            }
            if (isset($_FILES['file_terciaria'])) {
                $img3 = $_FILES['file_terciaria'];
                comprimirImagen($img3, $response['id'] . '_3', 750, 750, 40, $urlSave, 56320);
                // addOrUpdateImgCombo($response['id'], $_POST['denom'], $response['id'] . '_2.png');
            }

            echo getOneValueOfJsonData(json_encode($response), 'status');
        }
        // echo $response; // 'Img insertada correctamente!'; //Pedido registrado. $response;
        #endregion
        break;
        // ===============================================================================================================
        #region changeActive
    case 'changeActive':

        $dataArray = array(
            // 'numero' => $_POST['numero'],
            'active' => $_POST['active'],
            'id' => $_POST['id']
        );

        $funcion = codificarData('changeActive');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = json_decode(SendRequestOneParam('combo.php', $funcion, $bd, $jsonDataArray), true);

        // setMessageInfoText('rta', ($response));

        if ($response['status'] == 'ss1') {

            echo json_encode($response);
        }
        // echo $response; // 'Img insertada correctamente!'; //Pedido registrado. $response;
        #endregion
        break;
        // =====================================================================================================================================
}

// function addOrUpdateImgCombo($numero, $denom, $url){
//     $dataArray = array(
//         'numero' => $numero,
//         'denom' => $denom,
//         'url' => $url
//     );

//     $funcion = codificarData('addOrUpdateImgCombo');

//     $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
//     $jsonDataArray = codificarData(json_encode($dataArray));

//     // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
//     $response = json_decode(SendRequestOneParam('combo.php', $funcion, $bd, $jsonDataArray), true);

//     return $response;
// }