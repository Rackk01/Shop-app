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
        #region getInfoModalInit
    case 'getInfoModalInit':
        $funcion = codificarData('getInfoModalInit');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));

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
                echo json_encode($arrayValue);
                // setMessageInfoText('json_encode($arrayValue)', json_encode($arrayValue));
            }
        }
        #endregion
        break;

        // =================================================================================================================



        // =================================================================================================================



        // =================================================================================================================

}
