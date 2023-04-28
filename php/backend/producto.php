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

        #region getOneProductOfCod
    case 'getOneProductOfCod':

        $funcion = codificarData('getOneProductOfCod');
        $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $dataArray = array(
            'num' => intval($_POST['numero'])
        );

        $jsonDataArray = codificarData(json_encode($dataArray));

        $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
        $array = json_decode($response, true);

        setMessageInfoText('$response', $response);

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

        echo $responseQuery;
        break;
        #endregion

        // =================================================================================================================
        // =================================================================================================================

        #region getAllPresOfProduct
    case 'getAllPresOfProduct':

        $funcion = codificarData('getAllPresOfProduct');
        $bd = codificarData(DB_APP);    // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

        $dataArray = array(
            'idProduct' => intval($_POST['numero'])
        );

        $jsonDataArray = codificarData(json_encode($dataArray));

        $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
        $array = json_decode($response, true);

        setMessageInfoText('$response', $response);

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

        echo $responseQuery;
        break;
        #endregion

        // =================================================================================================================
        // =================================================================================================================

        #region insertImgProducto
    case 'insertImgProducto':

        $dataArray = array(
            'numero' => $_POST['numero'],
            'denom' => $_POST['denom'],
            'nameImg' => $_POST['nameImg'],
            'tipo' => $_POST['tipo']
        );

        $funcion = codificarData('insertImgProducto');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
        // echo $response; // 'Img insertada correctamente!'; //Pedido registrado. $response;

        // setMessageInfoText('insertImgProducto ---> idImgProducto insertada', getOneValueOfJsonData($response,'idImgProducto'));

        echo getOneValueOfJsonData($response, 'idImgProducto');

        // $array = json_decode($response, true);
        // $responseQuery = '';
        // foreach ($array as $key => $value) {
        //     if ($key == 'ss1') {
        //         // $arrayValue = json_decode(decodificarData($value), true);
        //         $arrayValue = json_decode(($value), true);
        //         $responseQuery = json_encode($arrayValue);
        //     }
        // }
        // setMessageInfoText('insertImgProducto ---> responseQuery', $responseQuery);

        #endregion
        break;

        // =================================================================================================================
        // =================================================================================================================

        #region updateImgProducto
    case 'updateImgProducto':

        $dataArray = array(
            'numero' => $_POST['numero'],
            'denom' => $_POST['denom'],
            'nameImg' => $_POST['nameImg'],
            'tipo' => $_POST['tipo'],
            'idImgProducto' => $_POST['idImgProducto']
        );

        $funcion = codificarData('updateImgProducto');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
        echo $response; // 'Img insertada correctamente!'; //Pedido registrado. $response;
        #endregion
        break;

        // =================================================================================================================
        // =================================================================================================================

        #region updateDataProduct
    case 'updateDataProduct':

        $dataArray = array(
            'numero' => $_POST['numero'],
            'denom' => $_POST['denom'],
            'descrip' => $_POST['descrip'],
            'idEstadoProducto' => $_POST['idEstadoProducto'],
            'typeDiscountSelected' => $_POST['typeDiscountSelected'],
            'bonfija' => $_POST['bonfija'],
            'precioFinal' => $_POST['precioFinal'],
            'pres1' => $_POST['pres1'],
            'pres2' => $_POST['pres2'],
            'pres3' => $_POST['pres3'],
            'pres4' => $_POST['pres4'],
            'stoweb' => $_POST['stoweb']
        );

        $funcion = codificarData('updateDataProduct');
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = (SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
        echo $response; // 'Img insertada correctamente!'; //Pedido registrado. $response;
        #endregion
        break;

        // =================================================================================================================

        #region getAllProducts
    case 'getAllProducts':

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

        echo $responseQuery;
        break;
        #endregion
        // =================================================================================================================

        #region getAllStatesOfProducts
    case 'getAllStatesOfProducts':

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
    
        echo $responseQuery;
        break;
        #endregion

        // =================================================================================================================

        #region addOrUpdateProductState
    case 'addOrUpdateProductState':

        $dataArray = array(
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'color' => $_POST['color']
        );

        if($_POST['type'] == 'updateProductState'){
            $dataArray['id'] = $_POST['id'];
        }

        $funcion = codificarData($_POST['type']);
        $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));
        $jsonDataArray = codificarData(json_encode($dataArray));

        // $response = decodificarData(SendRequestOneParam('cliente-web.php', $funcion, $bd, $jsonDataArray));
        $response = decodificarData(SendRequestOneParam('producto.php', $funcion, $bd, $jsonDataArray));
        // setMessageInfoText('response', $response);

        echo $response; // 'Img insertada correctamente!'; //Pedido registrado. $response;
        #endregion
        break;

        // =================================================================================================================

}
