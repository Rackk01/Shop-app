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

        #region login
    case 'login':
        // Función para el inicio de sesión del cliente web
        if (
            !isset($_POST['email']) || trim($_POST['email']) == '' || !isset($_POST['password']) || trim($_POST['password']) == ''
        ) {
            echo 'ef_1'; // Error del front 1
            die();
            break;
        }

        if (!validateEmailPregMatch($_POST['email'])) {
            echo 'ef_2'; // Error del front 3 - Email no válido
            die();
            break;
        }

        // echo ($_POST['email']);
        // echo validateEmailPregMatch($_POST['email']);
        // return;

        $dataArray = array(
            'email' => $_POST['email'],
            'password' => $_POST['password']
        );

        // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));

        $funcion = codificarData('loginClientWeb');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));

        // setMessageInfoText('response', json_encode($response));
        // $responseQuery = str_replace('\/', '/', $response);
        // setMessageInfoText('responseQuery', json_encode($responseQuery));

        $_SESSION["SD_CLIENTE_WEB_LOGUEADO"] = $response;

        if (isset($_SESSION['SD_LOCATION'])) {
            echo $_SESSION['SD_LOCATION'];
            unset($_SESSION['SD_LOCATION']);
        } else {
            echo $response;
        }
        #endregion
        break;

        // =================================================================================================================

        #region loginAdmin
    case 'loginAdmin':
        // Función para el inicio de sesión del cliente web administrador
        if (
            !isset($_POST['email']) || trim($_POST['email']) == '' || !isset($_POST['password']) || trim($_POST['password']) == ''
        ) {
            echo 'ef_1'; // Error del front 1
            die();
            break;
        }

        if (!validateEmailPregMatch($_POST['email'])) {
            echo 'ef_2'; // Error del front 3 - Email no válido
            die();
            break;
        }

        $dataArray = array(
            'email' => $_POST['email'],
            'password' => $_POST['password']
        );

        // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));

        $funcion = codificarData('loginClientWebAdmin');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));

        // setMessageInfoText('response', json_encode($response));
        // $responseQuery = str_replace('\/', '/', $response);
        // setMessageInfoText('responseQuery', json_encode($responseQuery));

        $_SESSION["SD_USUARIO_ADMIN"] = $response;

        echo $response;

        // if (isset($_SESSION['SD_LOCATION'])) {
        //     echo $_SESSION['SD_LOCATION'];
        //     unset($_SESSION['SD_LOCATION']);
        // } else {
        //     echo $response;
        // }
        #endregion
        break;

        // =================================================================================================================

        #region registerClient
    case 'registerClient':

        if (
            !isset($_POST['nombre']) || !isset($_POST['email']) ||
            !isset($_POST['dnicuit']) || !isset($_POST['tel']) ||
            !isset($_POST['pass']) || !isset($_POST['retypepass'])
        ) {
            echo 'ef_1'; // Error del front 1
            die();
            break;
        }

        // setMessageInfoText('dnicuit', $_POST['dnicuit']);
        // setMessageInfoText('VALIDA', validateDni($_POST['dnicuit']) . ' | ' . validateNumCuitPregMatch($_POST['dnicuit']));
        if (trim($_POST['pass']) != trim($_POST['retypepass'])) {
            echo 'ef_2'; // Error del front 2
            die();
            break;
        }

        if (validateDni($_POST['dnicuit']) != 1 && validateNumCuitPregMatch($_POST['dnicuit']) != 1) {
            echo 'ef_3'; // Error del front 3 - Nro dno/cuit inválido
            die();
            break;
        }

        $dataArray = array(
            'nombre' => $_POST['nombre'],
            'email' => $_POST['email'],
            'dnicuit' => $_POST['dnicuit'],
            'tel' => $_POST['tel'],
            'pass' => $_POST['pass']
        );

        // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));

        $funcion = codificarData('registerClient');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        setMessageInfoText('REGISTRO DEL CLIENTE WEB', json_encode($response));

        if ($response == 'ss1') {
            loginNewUser(trim($_POST['email']), trim($_POST['pass']));
        } else {
            echo $response;
        }
        #endregion
        break;

        // =================================================================================================================

        #region updateDomicilio
    case 'updateDomicilio':

        if (
            !isset($_POST['domicilio']) || !isset($_POST['localidad']) ||
            !isset($_POST['codPost']) || !isset($_POST['provin'])
        ) {
            echo 'ef_1'; // Error del front 1
            die();
            break;
        }

        $idCliente = getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'id_cliente');

        $dataArray = array(
            'idCliente' => $idCliente,
            'domicilio' => $_POST['domicilio'],
            'localidad' => $_POST['localidad'],
            'codPost' => $_POST['codPost'],
            'provin' => $_POST['provin']
        );

        $funcion = codificarData('updateDomiCliWeb');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $_SESSION["SD_CLIENTE_WEB_LOGUEADO"] = $response;
        echo $response;
        #endregion
        break;

        // =================================================================================================================

        #region recoverPaswword
    case 'recoverPaswword':

        if (!isset($_POST['email'])) {
            echo 'ef_1'; // Error del front 1
            die();
            break;
        }

        $dataArray = array(
            'email' => $_POST['email'],
        );

        $funcion = codificarData('recovPassw');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));

        if ($response == 'se_1') {
            // se_1 - Server Error 1 - No se encuentra el email registrado en la base de datos
            $_SESSION['SD_PASSWORD_RECOVERER'] = '';
            unset($_SESSION['SD_PASSWORD_RECOVERER']);
            echo $response;
        } else {
            // ss_1 - Server success 1 - Se encontró el email y se obtuvo la contraseña
            $_SESSION['SD_PASSWORD_RECOVERER'] = $response;
            echo 'ss_1';
        }

        #endregion
        break;

        // =================================================================================================================

        #region updateDatosCuenta
    case 'updateDatosCuenta':

        // setMessageInfoText('json', json_encode($_POST));

        if (
            !isset($_POST['nombre']) || !isset($_POST['email'])
        ) {
            echo 'ef_1'; // Error del front 1
            die();
            break;
        }

        if ($_POST['newPassword'] != $_POST['confirmPassword']) {
            echo 'ef_2'; // Error del front 2
            die();
            break;
        }

        $idCliente = getOneValueOfJsonData($_SESSION['SD_CLIENTE_WEB_LOGUEADO'], 'id_cliente');

        $dataArray = array(
            'idCliente' => $idCliente,
            'nombre' => $_POST['nombre'],
            'email' => $_POST['email'],
            'currentPassword' => $_POST['currentPassword'],
            'newPassword' => $_POST['newPassword']
        );

        $funcion = codificarData('updateDatosCuenta');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        if($response != 'es_1' && $response != 'es_2' && $response != 'es_3'){
            $_SESSION["SD_CLIENTE_WEB_LOGUEADO"] = $response;
        }
        echo $response;
        #endregion
        break;

        // =================================================================================================================



        // =================================================================================================================

}

function loginNewUser($email, $password)
{
    $dataArray = array(
        'email' => $email,
        'password' => $password
    );

    $funcion = codificarData('loginClientWeb');
    $bd = codificarData(DB_APP);
    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = (SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));

    $_SESSION["SD_CLIENTE_WEB_LOGUEADO"] = $response;

    if (isset($_SESSION['SD_LOCATION'])) {
        echo $_SESSION['SD_LOCATION'];
        unset($_SESSION['SD_LOCATION']);
    } else {
        echo $response;
    }
}
