<?php
require_once('../../constants.php');
require_once('function_compresion.php');

$funcion = $_POST['funcion'];

switch ($funcion) {
        // ***************************************************************************
        // ***************************************************************************
        #region addOrUpdateImgProducto
    case 'addOrUpdateImgProducto':
        $file_data = $_FILES['file_data'];
        $numero = $_POST['numero'];
        $denom = $_POST['denom'];
        $orderImg = $_POST['orderImg'];

        $nameImg = $numero . '-' . $orderImg;
        // $urlSave = '../../../src/img/imagenes-prueba';
        $urlSave = '../../../src/img/productos';

        $result = comprimirImagen($file_data, $nameImg, 750, 750, 40, $urlSave, 56320);
        echo $result;
        break;
        #endregion
        // ***************************************************************************
        // ***************************************************************************
        #region ''
    default:
        echo 'default';
        break;
        #endregion
        // ***************************************************************************
        // ***************************************************************************

}

// ================================================================================================================================
