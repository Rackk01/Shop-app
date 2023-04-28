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
        //================================================================================================================
        #region
    case 'getTittlePest':

        $funcion = codificarData('getTittlePest');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $arrayValue = json_decode(decodificarData($value), true);
                $responseQuery = json_encode($arrayValue, true);
            }
        }

        $responseQuery = str_replace('\/', '/', $responseQuery);
        $responseQuery = str_replace('[', '', $responseQuery);
        $responseQuery = str_replace(']', '', $responseQuery);

        echo getOneValueOfJsonData($responseQuery, 'valor');
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        //================================================================================================================
        #region
    case 'getNameEmpres':

        $funcion = codificarData('getNameEmpres');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $arrayValue = json_decode(decodificarData($value), true);
                $responseQuery = json_encode($arrayValue, true);
            }
        }

        $responseQuery = str_replace('\/', '/', $responseQuery);
        $responseQuery = str_replace('[', '', $responseQuery);
        $responseQuery = str_replace(']', '', $responseQuery);

        echo getOneValueOfJsonData($responseQuery, 'valor');
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        //================================================================================================================
        #region
    case 'getDescEmpres':

        $funcion = codificarData('getDescEmpres');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $arrayValue = json_decode(decodificarData($value), true);
                $responseQuery = json_encode($arrayValue, true);
            }
        }

        $responseQuery = str_replace('\/', '/', $responseQuery);
        $responseQuery = str_replace('[', '', $responseQuery);
        $responseQuery = str_replace(']', '', $responseQuery);

        echo getOneValueOfJsonData($responseQuery, 'valor');
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        //================================================================================================================
        #region
    case 'getRazonSocial':

        $funcion = codificarData('getRazonSocial');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $arrayValue = json_decode(decodificarData($value), true);
                $responseQuery = json_encode($arrayValue, true);
            }
        }

        $responseQuery = str_replace('\/', '/', $responseQuery);
        $responseQuery = str_replace('[', '', $responseQuery);
        $responseQuery = str_replace(']', '', $responseQuery);

        echo getOneValueOfJsonData($responseQuery, 'valor');
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        //================================================================================================================
        #region
    case 'getUrlFace':

        $funcion = codificarData('getUrlFace');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);


        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        //================================================================================================================
        #region
    case 'getUrlInsta':

        $funcion = codificarData('getUrlInsta');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        //================================================================================================================
        #region
    case 'getUrlTwi':

        $funcion = codificarData('getUrlTwi');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        //================================================================================================================
        #region
    case 'getUrlYout':

        $funcion = codificarData('getUrlYout');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;
        #endregion
        //================================================================================================================
        #region
    case 'getCostoEnvio':

        $funcion = codificarData('getCostoEnvio');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getTopeEnvio':

        $funcion = codificarData('getTopeEnvioGratis');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getDescuentoGeneral':

        $funcion = codificarData('getDescuentoGeneralEmpresConfig');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getFlagContarEspeciales':

        $funcion = codificarData('getFlagCountProductSpecials');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getFlagCalendarioEnvio':

        $funcion = codificarData('getFlagCalendarioEnvio');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getAccessTokenMP':

        $funcion = codificarData('getMercadoPagoAccessToken');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getPublicKeyMP':

        $funcion = codificarData('getMercadoPagoPublicKey');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getRecargoMP':

        $funcion = codificarData('getRecargoPedidoMP');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getTrasnferenciaCBU':

        $funcion = codificarData('getCBU');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region
    case 'getTrasnferenciaALIAS':

        $funcion = codificarData('getAlias');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
        $array = json_decode($response, true);

        $responseQuery = '';

        foreach ($array as $key => $value) {
            if ($key == 'data') {
                // echo decodificarData($value);
                $responseQuery = decodificarData($value);
            }
        }

        echo $responseQuery;
        break;
        // return str_replace('\/', '/', ($responseQuery));
        // return $responseQuery;

        #endregion
        //================================================================================================================
        #region setEmpresConfig
    case 'updateEmpresConfig':

        if (
            $_POST['validate'] == 1 &&
            !validateNotQuery($_POST['value'])
        ) {
            echo 'ef_1'; // Error del front 1
            die();
            break;
        }

        $object = [
            'c' => $_POST['key'],
            'v' => $_POST['value']
        ];

        $funcion = codificarData('updateEmpresConfig');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($object));

        setMessageInfoText('error', json_encode($object));
        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('empres_config.php', $funcion, $bd, $jsonDataArray));

        echo $response;
        #endregion
        break;
        //================================================================================================================
}
