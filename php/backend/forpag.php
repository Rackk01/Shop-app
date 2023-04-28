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
        // =================================================================================================================
        #region getRecargoForpag
    case 'getRecargoForpag':
        $funcion = codificarData('getRecargoForpag');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $_SESSION['SD_DESCRIPCION_FORPAG_SELECCCIONADA'] = $_POST['descriForpag'];
        $_SESSION['SD_ID_FORPAG_SELECCCIONADA'] = $_POST['idForpag'];

        $dataArray = array(
            'idForpag' => $_POST['idForpag']
        );

        $jsonDataArray = codificarData(json_encode($dataArray));

        $response = decodificarData(SendRequestOneParam('forpag.php', $funcion, $bd, $jsonDataArray));
        // $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));

        $array = json_decode($response, true);

        // setMessageInfoText('$response', $response);
        // setMessageInfoText('$array', $array);

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);

                $arrayValue = json_decode(decodificarData($value), true);

                // $i = 1;
                // foreach ($arrayValue as &$a) {
                //     if ($a['cnro'] == $i) {
                //         $a['cnro'] = codificarTokenId($a['cnro']);
                //         $i++;
                //     }
                // }
                // $arrayValue = str_replace('[', '', $arrayValue);
                // $arrayValue = str_replace(']', '', $arrayValue);
                echo json_encode($arrayValue);
                // setMessageInfoText('json_encode($arrayValue)', json_encode($arrayValue));
            }
        }
        #endregion
        break;

        // =================================================================================================================

        #region getRecargoForpag
    case 'getRecargo':
        $funcion = codificarData('getRecargo');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $dataArray = array(
            'id' => $_POST['id']
        );

        $jsonDataArray = codificarData(json_encode($dataArray));

        $response = decodificarData(SendRequestOneParam('forpag.php', $funcion, $bd, $jsonDataArray));
        // $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));

        $array = json_decode($response, true);

        // setMessageInfoText('$response', $response);
        // setMessageInfoText('$array', $array);

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);

                $arrayValue = decodificarData($value);

                // $i = 1;
                // foreach ($arrayValue as &$a) {
                //     if ($a['cnro'] == $i) {
                //         $a['cnro'] = codificarTokenId($a['cnro']);
                //         $i++;
                //     }
                // }
                $arrayValue = str_replace('[', '', $arrayValue);
                $arrayValue = str_replace(']', '', $arrayValue);
                echo getOneValueOfJsonData($arrayValue, 'recargo');
                // setMessageInfoText('json_encode($arrayValue)', json_encode($arrayValue));
            }
        }
        #endregion
        break;
        // =================================================================================================================

    case 'updateRecargo':

        $object = [
            'c' => $_POST['id'],
            'v' => $_POST['value']
        ];

        $funcion = codificarData('updateRecargo');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($object));

        setMessageInfoText('error', json_encode($object));
        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('forpag.php', $funcion, $bd, $jsonDataArray));

        echo $response;
        #endregion
        break;

        // =================================================================================================================

}
