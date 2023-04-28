<?php
// require_once('php/services/service.php');
// require_once('php/helper/error.php');
// require_once('php/util/methods.php');

require_once('../constants.php');
require_once('../services/service.php');
require_once('../helper/error.php');
require_once('../util/methods.php');

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
        // ==========================================================================================================

        #region registerSuscribe
    case 'registerSuscribe':

        $emailSuscriptor = $_POST['emailSuscribe'];
        registerSuscribe($emailSuscriptor);
        #endregion

        // ==========================================================================================================
}

function registerSuscribe($emailSuscriptor)
{
    /*
    Suscripción del footer. Registra el email en la base de datos.
    */

    $funcion = codificarData('registerSuscribe');
    $bd = codificarData(DB_APP);

    $dataArray = array(
        'emailSuscriptor' => $emailSuscriptor
    );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = (SendRequestOneParam('suscribe.php', $funcion, $bd, $jsonDataArray));

    // setMessageInfoText('registerSuscribe', $response);
    echo $response;
}
