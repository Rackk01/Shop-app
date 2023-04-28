<?php
// ERRORBRI

require_once('../constants.php');
require_once('../services/service.php');
require_once('../helper/error.php');
require_once('../util/methods.php');

function logError($mensaje, $file, $function)
{
    // Registra el error en la tabla errorbri
    $funcion = codificarData('logError');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $dataArray = array(
        'mensaje' => $mensaje,
        'file' => $file,
        'function' => $function,
        'layer' => 'frontend'
    );

    // setMessageInfoText('errorbri | dataArray', json_encode($dataArray));

    $jsonDataArray = codificarData(json_encode($dataArray));

    $response = decodificarData(SendRequestOneParam('error.php', $funcion, $bd, $jsonDataArray));
    // $array = json_decode($response, true);

    // setMessageInfoText('errorbri | response', $response);
    // setMessageInfoText('errorbri | array', $array);

    // $responseQuery = '';
    // foreach ($array as $key => $value) {
    //     if ($key == 'data') {
    //         $arrayValue = json_decode(decodificarData($value), true);
    //         $responseQuery = json_encode($arrayValue);
    //     }
    // }

    // $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // return $responseQuery;
}
