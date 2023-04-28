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
        // =================================================================================================================

        #region registrarPedido
    case 'registrarPedido':

        // $valueForenv = $_POST['valueForenv'];
        // $valueForpag = $_POST['valueForpag'];
        // $infoAdic = $_POST['infoAdic'];

        // echo $_SESSION['SD_MONTO_FINAL_ENVIO'];
        // return;

        $dataArray = array(
            'valueForenv' => $_POST['valueForenv'],
            'valueForpag' => $_POST['valueForpag'],
            'infoAdic' => $_POST['infoAdic'],
            'montoTotalFinalPedido' => $_SESSION['SD_MONTO_TOTAL_FINAL_PEDIDO'],
            'montoFinalEnvio' => $_SESSION['SD_MONTO_FINAL_ENVIO'],
            'montoTotalSinDescuentoNiEnvio' => $_SESSION['SD_MONTO_TOTAL_SIN_DESCUENTO_NI_ENVIO'],
            'dataArrayCart' => $_SESSION['SD_CART'],
            'idClienteWeb' => getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'id_cliente'),
            'descuentoGral' => (int)$_SESSION['SD_GENERAL_DISCOUNT']
        );

        $_SESSION['SD_PEDIDO_ACTUAL_CONFIRMADO'] = $dataArray;

        // echo '1';
        // return;
        // break;

        $funcion = codificarData('registrarPedido');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('pedido.php', $funcion, $bd, $jsonDataArray));
        echo '1'; //Pedido registrado. $response;
        #endregion
        break;

        // =================================================================================================================

        #region updateOrderState
    case 'updateOrderState':

        // $valueForenv = $_POST['valueForenv'];
        // $valueForpag = $_POST['valueForpag'];
        // $infoAdic = $_POST['infoAdic'];

        // echo $_SESSION['SD_MONTO_FINAL_ENVIO'];
        // return;

        $dataArray = array(
            'nrocomp' => $_POST['nrocomp'],
            'id_estado' => $_POST['id_estado']
        );

        $funcion = codificarData('updateOrderState');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = decodificarData(SendRequestOneParam('pedido.php', $funcion, $bd, $jsonDataArray));
        // setMessageInfoText('res', $response);

        $status = getOneValueOfJsonData($response, 'status');

        if($status != 201){
            echo 'se1';
        }else{
            echo 'ss1';
        }

        #endregion
        break;

        // =================================================================================================================

        #region insertComment
    case 'insertComment':

        // $valueForenv = $_POST['valueForenv'];
        // $valueForpag = $_POST['valueForpag'];
        // $infoAdic = $_POST['infoAdic'];

        // echo $_SESSION['SD_MONTO_FINAL_ENVIO'];
        // return;

        $dataArray = array(
            'nrocomp' => $_POST['nrocomp'],
            'comment' => $_POST['comment']
        );

        $funcion = codificarData('insertComment');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = decodificarData(SendRequestOneParam('pedido.php', $funcion, $bd, $jsonDataArray));
        setMessageInfoText('res', $response);

        $status = getOneValueOfJsonData($response, 'status');

        if($status != 201){
            echo 'se1';
        }else{
            echo decodificarData(getOneValueOfJsonData($response, 'data'));
        }

        #endregion
        break;

        // =================================================================================================================



        // =================================================================================================================



        // =================================================================================================================

}
