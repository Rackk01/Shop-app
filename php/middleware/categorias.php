<?php
// LRUBRO

require_once('php/services/service.php');
require_once('php/helper/error.php');
require_once('php/util/methods.php');

// setMessageInfoText('getAllCategories | $array', $array);

// =====================================================================================================================================
// VARIABLES DE LAS CATEGORÍAS ASOCIADAS A LAS VISTAS

$dataArrayCategories =  getAllCategories(); // '[{"rubro":"1","concepto":"IMPRESION","urlimg":"printer.png","activoweb":"","cantidad":"233"},{"rubro":"2","concepto":"EQUIPAMIENTO","urlimg":"notebook.png","activoweb":"","cantidad":"50"},{"rubro":"5","concepto":"ACCESORIOS                    ","urlimg":"accesorio.png","activoweb":"","cantidad":"239"},{"rubro":"6","concepto":"PAPEL","urlimg":"papel.png","activoweb":"","cantidad":"41"},{"rubro":"10","concepto":"ALMACENAMIENTO","urlimg":"ssd.png","activoweb":"","cantidad":"26"},{"rubro":"11","concepto":"AUDIO Y VIDEO","urlimg":"auriculares.png","activoweb":"","cantidad":"107"}]'; //
// setMessageInfoText('dataArrayCategories', $dataArrayCategories);
$amountOfCategories = count(json_decode($dataArrayCategories, true));
$halfAmountOfCategories = $amountOfCategories / 2;
$isIntegerAmountOfCategories = false;
$amountFirstColumn;
$amountSecondColumn;

if (is_int($halfAmountOfCategories)) {
    $isIntegerAmountOfCategories = true;
    $amountFirstColumn = $amountSecondColumn = $halfAmountOfCategories;
} else {
    $isIntegerAmountOfCategories = false;
    $halfAmountOfCategories = $halfAmountOfCategories + 0.1; // 3.6
    $amountFirstColumn = round($halfAmountOfCategories);
    $amountSecondColumn = $amountFirstColumn - 1;
}

$dataArrayCategoriesFirsColumn = array_slice(json_decode($dataArrayCategories, true), 0, $amountFirstColumn);
$dataArrayCategoriesSecondColumn = array_slice(json_decode($dataArrayCategories, true), $amountFirstColumn);

// =====================================================================================================================================

// =====================================================================================================================================

// =====================================================================================================================================
// FUNCIONES

function getAllCategories()
{
    $funcion = codificarData('getAllCategories');
    $bd = codificarData(DB_APP);                                            // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('lrubro.php', $funcion, $bd));
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

    return $responseQuery;
}

// =====================================================================================================================================