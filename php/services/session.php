<?php

require_once('../middleware/error.php');
require_once('../helper/error.php');
require_once('../helper/success.php');
require_once('../util/methods.php');
require_once('service.php');

if (!isset($_POST['funcion']) || $_POST['funcion'] == '') {
    // echo sendErrorMessage(1) . ' || ' . basename($_SERVER['PHP_SELF']);
    echo 'e1 - session.php';
    die;
    return;
}

session_start();

#region LISTADO DE VARIABLES DE SESIÓN -- SD (SessionData)
// $_SESSION['SD_BRANCHE_OFFICE_SELECTED'] -- SD_BRANCHE_OFFICE_SELECTED      --> Datos de la sucursal seleccionada por el usuario
// $_SESSION['SD_CART'] -- SD_CART      --> Datos de todos los productos que se agregaron al carrito --> [{"type":"producto","numero":"2389","denom":"ADAPTADOR 1PLUG H \/ 2PLUG M 15CM NETMAK C50","stopro":"C","stoact":"5.000","idestado":"4","prefin":"340.69","preciofinal":"340.69","bonfija":"0","idpresentacion":"0","pesopres":"0","cantidad":"1"},{"type":"producto","numero":"2550","denom":"ADAPTADOR BT P\/NB\/PC 4.0 TP-LINK UB400","stopro":"C","stoact":"3.000","idestado":"4","prefin":"1249.19","preciofinal":"1186.730500000000000000000000","bonfija":"0.00","tipobonifi":"P","idpresentacion":"6","pesopres":"0.95","cantidad":2},{"type":"combo","numero":"2222","denom":"Super","stopro":"10.000","stoact":"7.000","idestado":-1,"prefin":"5689.25","preciofinal":"4999.00","bonfija":"690.25","tipobonifi":"F","idpresentacion":0,"pesopres":0,"cantidad":2}]
// $_SESSION['SD_GENERAL_DISCOUNT']

// $_SESSION['SD_CLIENTE_WEB_LOGUEADO'] --> Array de datos del cliente web logueado || 
// Estructura --> {"id_cliente":"1","nombre":"Admin","email":"carritobrinco@hls.com.ar","tipo_usuario":"1","ctel1":"0351152274431","cdni":"33312635","ccui":"20333126371"}

// $_SESSION['SD_ORDER_PRODUCTS_BY'] --> Order By SHOP!
// $_SESSION['SD_LOCATION'] --> Pagina a la que se debe redireccionar!

// $_SESSION['SD_COSTO_ENVIO_PEDIDO'] --> Monto/ costo de envío en caso que se seleccione envío a domicilio.
// $_SESSION['SD_TOPE_ENVIO_GRATIS_PEDIDO'] --> Tope inicial para que el costo de envío sea cero. Si está en cero no aplica.
// $_SESSION['SD_MONTO_TOTAL_FINAL_PEDIDO'] --> Es el total final del pedido.
// $_SESSION['SD_PEDIDO_ACTUAL_CONFIRMADO'] --> Son los datos del pedido que se confirmó. --> {"valueForenv":"2","valueForpag":"4","infoAdic":" | RETIRO EN SUCURSAL VILLA MAR\u00cdA | FORMA DE PAGO: TARJETA D\u00c9BITO | PAGO PENDIENTE DE VERIFICACI\u00d3N","montoTotalFinalPedido":12076.54345,"montoFinalEnvio":0,"montoTotalSinDescuentoNiEnvio":12712.151,"dataArrayCart":[{"type":"producto","numero":"2389","denom":"ADAPTADOR 1PLUG H \/ 2PLUG M 15CM NETMAK C50","stopro":"C","stoact":"5.000","idestado":"4","prefin":"340.69","preciofinal":"340.69","bonfija":"0","idpresentacion":"0","pesopres":"0","cantidad":"1"},{"type":"producto","numero":"2550","denom":"ADAPTADOR BT P\/NB\/PC 4.0 TP-LINK UB400","stopro":"C","stoact":"3.000","idestado":"4","prefin":"1249.19","preciofinal":"1186.730500000000000000000000","bonfija":"0.00","tipobonifi":"P","idpresentacion":"6","pesopres":"0.95","cantidad":2},{"type":"combo","numero":"2222","denom":"Super","stopro":"10.000","stoact":"7.000","idestado":-1,"prefin":"5689.25","preciofinal":"4999.00","bonfija":"690.25","tipobonifi":"F","idpresentacion":0,"pesopres":0,"cantidad":2}],"idClienteWeb":"1","descuentoGral":5}
// $_SESSION['SD_EMAIL_VENTAS'] --> Email al que deben llegar los correos de los pedidos. empres_config --> email-ventas
// $_SESSION['SD_CBU']
// $_SESSION['SD_ALIAS']

// $_SESSION['SD_EMPRES'] --> Datos completo de la tabla empres
// $_SESSION['rectangularLogo'] --> Contiene la url del logo recatangular
// $_SESSION['squareLogo'] --> Contiene la url del logo Cuadrado

// $_SESSION['SD_MONTO_PORCENTAJE_INCREMENTO'] --> Es el monto según el porcentaje de incremento que se le debe agregar al monto final del pedido.
// $_SESSION['SD_PORCENTAJE_INCREMENTO'] --> Es el porcentaje de aumento que se le debe sumar al total del pedido. Varía de acuerdo al recargo de cada foram de pago.

// $_SESSION['SD_DESCRIPCION_FORENV_SELECCCIONADA'] --> 
// $_SESSION['SD_DESCRIPCION_FORPAG_SELECCCIONADA'] --> 

// $_SESSION['SD_ID_FORPAG_SELECCCIONADA'] -->

// $_SESSION['SD_PASSWORD_RECOVERER'] --> Es la password recuperada desde la base de datos para enviarle al email que desea recuperar.

// $_SESSION["SD_USUARIO_ADMIN"] --> Guardo los datos del usuario administrador logueado

#endregion

$funcion = $_POST['funcion'];

switch ($funcion) {

        // ================================================================================================

        #region setSDBrancheOfficeSelected
    case 'setSDBrancheOfficeSelected':

        if (
            !isset($_POST['id']) || trim($_POST['id']) == ''
            || !isset($_POST['branche']) || $_POST['branche'] == ''
        ) {
            // echo sendErrorMessage(2) . ' || ' . ' Función: ' . $funcion; // . ' ' . basename($_SERVER['PHP_SELF']);
            echo 'e2 - setSDBrancheOfficeSelected';
            logError(
                'e2 - setSDBrancheOfficeSelected || No se reciben el id o la sucursal por post para que se puedan setear los datos',
                'session.php',
                'setSDBrancheOfficeSelected'
            );
            die;
            return;
        }

        $idBranche = trim($_POST['id']);
        $nameBranche = trim($_POST['branche']);

        $array = array(
            'id' => decodificarData($idBranche),
            'branche' => $nameBranche
        );

        $_SESSION["SD_BRANCHE_OFFICE_SELECTED"] = json_encode($array);

        if (isset($_SESSION["SD_BRANCHE_OFFICE_SELECTED"]) && $_SESSION["SD_BRANCHE_OFFICE_SELECTED"] != '') {
            // echo sendSuccessMessage(1) . ' || ' . ' Función: ' . $funcion; // . ' ' . basename($_SERVER['PHP_SELF']);
            echo 's1'; // success 1
        } else {
            echo 'e3 - setSDBrancheOfficeSelected';
        }

        break;
        die();
        #endregion

        // ================================================================================================

        #region getInitialSDBrancheOfficeSelected
    case 'getInitialSDBrancheOfficeSelected':

        if (isset($_SESSION["SD_BRANCHE_OFFICE_SELECTED"]) && $_SESSION["SD_BRANCHE_OFFICE_SELECTED"] != '') {
            // echo sendSuccessMessage(1) . ' || ' . ' Función: ' . $funcion; // . ' ' . basename($_SERVER['PHP_SELF']);
            echo $_SESSION['SD_BRANCHE_OFFICE_SELECTED']; // 's1'; // success 1
        } else {
            $array = array(
                'id' => 0,
                'branche' => 0
            );
            //echo ''; // 'e1 - getInitialSDBrancheOfficeSelected';
            echo json_encode($array);
        }

        break;
        die();
        #endregion

        // ================================================================================================

        #region getSDError
    case 'getSDError':
        echo trim($_SESSION["SD_ERROR"]);
        break;
        die();
        #endregion

        // ================================================================================================

        #region setSDError
    case 'setSDError':
        $tit = trim($_POST['tit']);
        $msj = trim($_POST['msj']);

        $array = array(
            'tit' => $tit,
            'msj' => $msj
        );

        $_SESSION["SD_ERROR"] = json_encode($array);
        die;
        break;
        #endregion

        // ================================================================================================

        #region addSDNewProductToCart
    case 'addSDNewProductToCart':
        $contador = 0;
        $acumuladorTotal = 0;

        // unset($_SESSION['SD_CART']);
        // return;

        $type = trim($_POST['type']);
        $numero = trim($_POST['idProducto']);
        $cantidad = trim($_POST['cantidad']);
        $idpresentacion = trim($_POST['idPresentacion']);

        if (isset($_POST['denom'])) {
            $denom = trim($_POST['denom']);
            $stopro = trim($_POST['stopro']);
            $stoact = trim($_POST['stoact']);
            $idestado = trim($_POST['idestado']);
            $prefin = trim($_POST['prefin']);
            $preciofinal = trim($_POST['preciofinal']);
            $bonfija = trim($_POST['bonfija']);
            $tipobonifi = trim($_POST['tipobonifi']);
            $pesopres = trim($_POST['pesopres']);

            $newProductArray = array(
                'type' => $type,
                'numero' => $numero,
                'denom' => $denom,
                'stopro' => $stopro,
                'stoact' => $stoact,
                'idestado' => $idestado,
                'prefin' => $prefin,
                'preciofinal' => $preciofinal,
                'bonfija' => $bonfija,
                'tipobonifi' => $tipobonifi,
                'idpresentacion' => $idpresentacion,
                'pesopres' => $pesopres,
                'cantidad' => $cantidad
            );
        }

        /*
        Si ya hay productos en el carrito debo controlar si el producto que se quiere agregar existe dentro del carrito o no
        */
        if (isset($_SESSION['SD_CART'])) {

            $arraySessionDataCart = $_SESSION['SD_CART'];
            $ifExistProduct = false;
            $amountInArray = count($arraySessionDataCart);

            for ($i = 0; $i < $amountInArray; $i++) {
                if (
                    $arraySessionDataCart[$i]['numero'] == $numero &&
                    $arraySessionDataCart[$i]['idpresentacion'] == $idpresentacion &&
                    $arraySessionDataCart[$i]['type'] == $type
                ) {
                    $ifExistProduct = true;
                    $arraySessionDataCart[$i]['cantidad'] += $cantidad;
                    $_SESSION['SD_CART'] = $arraySessionDataCart;
                }
                $contador++;
                $acumuladorTotal +=
                    floatval($arraySessionDataCart[$i]['preciofinal']) * intval($arraySessionDataCart[$i]['cantidad']);
            }

            /*
            En caso de que el producto no se encuentre en el carrito
            */
            if (!$ifExistProduct) {
                array_push($arraySessionDataCart, $newProductArray);
                $_SESSION['SD_CART'] = $arraySessionDataCart;
                $contador++;
                $acumuladorTotal +=
                    floatval($preciofinal) * intval($cantidad);
            }
        } else {

            $row[] = array(
                'type' => $type,
                'numero' => $numero,
                'denom' => $denom,
                'stopro' => $stopro,
                'stoact' => $stoact,
                'idestado' => $idestado,
                'prefin' => $prefin,
                'preciofinal' => $preciofinal,
                'bonfija' => $bonfija,
                'tipobonifi' => $tipobonifi,
                'idpresentacion' => $idpresentacion,
                'pesopres' => $pesopres,
                'cantidad' => $cantidad
            );

            $_SESSION['SD_CART'] = $row;
            $contador++;
            $acumuladorTotal +=
                floatval($preciofinal) * intval($cantidad);
        }


        getDescuentoGeneralEmpresConfig(); // Busco por si hubo actualización de monto de descuento gral.

        if ($_SESSION['SD_GENERAL_DISCOUNT'] > 0) {
            $acumuladorTotal = $acumuladorTotal - $acumuladorTotal * ($_SESSION['SD_GENERAL_DISCOUNT'] / 100);
        }

        $dataArray = array(
            'cantidadProdutos' => $contador,
            'acumuladorTotal' => number_format($acumuladorTotal, 2)
        );

        // echo json_encode($_SESSION['SD_CART'], true);
        echo json_encode($dataArray, true);

        die;
        break;
        #endregion

        // ================================================================================================

        #region addSDNewComboToCart
    case 'addSDNewComboToCart':
        $contador = 0;
        $acumuladorTotal = 0;

        // unset($_SESSION['SD_CART']);
        // return;

        $type = trim($_POST['type']); // combo
        $numero = trim($_POST['idCombo']);
        $cantidad = trim($_POST['cantidad']);
        $idpresentacion = 0; // trim($_POST['idPresentacion']); // 0

        if (isset($_POST['denom'])) {
            $denom = trim($_POST['denom']);
            $stopro = trim($_POST['stoini']);
            $stoact = trim($_POST['stoact']);
            $idestado = -1; //trim($_POST['idestado']);
            $prefin = trim($_POST['pretot']);
            $preciofinal = trim($_POST['prefin']);
            $bonifi = trim($_POST['bonifi']);
            $tipobonifi = trim($_POST['tipobonifi']);
            $pesopres = 0; // trim($_POST['pesopres']);

            $newProductArray = array(
                'type' => $type,
                'numero' => $numero,
                'denom' => $denom,
                'stopro' => $stopro,
                'stoact' => $stoact,
                'idestado' => $idestado,
                'prefin' => $prefin,
                'preciofinal' => $preciofinal,
                'bonfija' => $bonifi,
                'tipobonifi' => $tipobonifi,
                'idpresentacion' => $idpresentacion,
                'pesopres' => $pesopres,
                'cantidad' => $cantidad
            );
        }

        /*
        Si ya hay productos en el carrito debo controlar si el producto que se quiere agregar 
        existe dentro del carrito o no
        */
        if (isset($_SESSION['SD_CART'])) {

            $arraySessionDataCart = $_SESSION['SD_CART'];
            $ifExistProduct = false;
            $amountInArray = count($arraySessionDataCart);

            for ($i = 0; $i < $amountInArray; $i++) {
                if (
                    $arraySessionDataCart[$i]['numero'] == $numero &&
                    $arraySessionDataCart[$i]['idpresentacion'] == $idpresentacion &&
                    $arraySessionDataCart[$i]['type'] == $type
                ) {
                    $ifExistProduct = true;
                    $arraySessionDataCart[$i]['cantidad'] += $cantidad;
                    $_SESSION['SD_CART'] = $arraySessionDataCart;
                }
                $contador++;
                $acumuladorTotal +=
                    floatval($arraySessionDataCart[$i]['preciofinal']) * intval($arraySessionDataCart[$i]['cantidad']);
            }

            /*
            En caso de que el producto no se encuentre en el carrito
            */
            if (!$ifExistProduct) {
                array_push($arraySessionDataCart, $newProductArray);
                $_SESSION['SD_CART'] = $arraySessionDataCart;
                $contador++;
                $acumuladorTotal +=
                    floatval($preciofinal) * intval($cantidad);
            }
        } else {

            $row[] = array(
                'type' => $type,
                'numero' => $numero,
                'denom' => $denom,
                'stopro' => $stopro,
                'stoact' => $stoact,
                'idestado' => $idestado,
                'prefin' => $prefin,
                'preciofinal' => $preciofinal,
                'bonfija' => $bonifi,
                'idpresentacion' => $idpresentacion,
                'pesopres' => $pesopres,
                'cantidad' => $cantidad
            );

            $_SESSION['SD_CART'] = $row;
            $contador++;
            $acumuladorTotal +=
                floatval($preciofinal) * intval($cantidad);
        }


        getDescuentoGeneralEmpresConfig(); // Busco por si hubo actualización de monto de descuento gral.

        if ($_SESSION['SD_GENERAL_DISCOUNT'] > 0) {
            $acumuladorTotal = $acumuladorTotal - $acumuladorTotal * ($_SESSION['SD_GENERAL_DISCOUNT'] / 100);
        }

        $dataArray = array(
            'cantidadProdutos' => $contador,
            'acumuladorTotal' => number_format($acumuladorTotal, 2)
        );

        // echo json_encode($_SESSION['SD_CART'], true);
        echo json_encode($dataArray, true);

        die;
        break;
        #endregion
        // ================================================================================================

        #region addCountProductInCart
        // case 'addCountProductInCart':

        //     // unset($_SESSION['SD_CART']);

        //     $numero = trim($_POST['numero']);

        //     if (isset($_SESSION['SD_CART'])) {
        //         $arraySessionDataCart = $_SESSION['SD_CART'];
        //         $amountInArray = count($arraySessionDataCart);

        //         for ($i = 0; $i < $amountInArray; $i++) {
        //             if ($arraySessionDataCart[$i]['numero'] == $numero) {
        //                 $arraySessionDataCart[$i]['cantidad']++;
        //                 $_SESSION['SD_CART'] = $arraySessionDataCart;
        //             }else{
        //                 $newArrayProducts[] = array(
        //                     'numero' => $arraySessionDataCart[$i]['numero'],
        //                     'denom' => $arraySessionDataCart[$i]['denom'],
        //                     'stopro' => $arraySessionDataCart[$i]['stopro'],
        //                     'stoact' => $arraySessionDataCart[$i]['stoact'],
        //                     'idestado' => $arraySessionDataCart[$i]['idestado'],
        //                     'prefin' => $arraySessionDataCart[$i]['prefin'],
        //                     'preciofinal' => $arraySessionDataCart[$i]['preciofinal'],
        //                     'bonfija' => $arraySessionDataCart[$i]['bonfija'],
        //                     'idpresentacion' => $arraySessionDataCart[$i]['idpresentacion'],
        //                     'pesopres' => $arraySessionDataCart[$i]['pesopres'],
        //                     'cantidad' => $arraySessionDataCart[$i]['cantidad']
        //                 );
        //             }
        //         }
        //     }

        //     die();
        //     break;
        #endregion

        // ================================================================================================

        #region getDataCart
    case 'getDataCart':
        $contador = 0;
        $acumuladorTotal = 0;

        // unset($_SESSION['SD_CART']);

        /*
        Devuelve un arrray con la cantidad de productos que tiene el carritoa ctualmente y el monto acumulado.
        */

        if (isset($_SESSION['SD_CART'])) {
            $arraySessionDataCart = $_SESSION['SD_CART'];
            $amountInArray = count($arraySessionDataCart);

            for ($i = 0; $i < $amountInArray; $i++) {
                $contador++;
                $acumuladorTotal += floatval(
                    $arraySessionDataCart[$i]['preciofinal'] * intval($arraySessionDataCart[$i]['cantidad'])
                );
            }
        }

        $porcentajeDescuentoGral = 0;
        $acumuladorTotalConDescuentoGral = $acumuladorTotal;
        if (isset($_SESSION['SD_GENERAL_DISCOUNT']) && intval($_SESSION['SD_GENERAL_DISCOUNT']) > 0) {
            $acumuladorTotalConDescuentoGral = floatval($acumuladorTotal - $acumuladorTotal * ($_SESSION['SD_GENERAL_DISCOUNT'] / 100));
            $porcentajeDescuentoGral = trim($_SESSION['SD_GENERAL_DISCOUNT']);
        }

        $montoDescuento = floatval($acumuladorTotal - $acumuladorTotalConDescuentoGral);

        $dataArray = array(
            'cantidadProdutos' => $contador,
            'acumuladorTotal' => number_format($acumuladorTotal, 2),
            'acumuladorTotalConDescuentoGral' => number_format($acumuladorTotalConDescuentoGral, 2),
            'porcentajeDescuentoGral' => number_format($porcentajeDescuentoGral),
            'montoDescuento' => number_format($montoDescuento, 2)
        );

        // echo json_encode($_SESSION['SD_CART'], true);
        echo json_encode($dataArray, true);

        die;
        break;
        #endregion

        // ================================================================================================

        #region getDataTotalesCheckout
    case 'getDataTotalesCheckout':
        $contador = 0;
        $acumuladorTotal = 0;

        $forenv = $_POST['forenv']; // domicilio | retiro
        $porcentajeIncremento = $_POST['porcentajeIncremento']; // Es el porcentaje de incremento en caso que la forma de pago seleccionada tenga recargo
        // $forpag = $_POST['forpag']; // efectivo | tarjeta

        // $_SESSION['SD_COSTO_ENVIO_PEDIDO']
        // $_SESSION['SD_TOPE_ENVIO_GRATIS_PEDIDO']

        /*
        Devuelve un arrray con la cantidad de productos que tiene el carritoa ctualmente y el monto acumulado.
        */

        if ($_POST['descriForenv'] != null && $_POST['descriForenv'] != '') {
            $_SESSION['SD_DESCRIPCION_FORENV_SELECCCIONADA'] = $_POST['descriForenv'];
        } else {
            $_SESSION['SD_DESCRIPCION_FORENV_SELECCCIONADA'] = '';
        }

        if ($_POST['descriForpag'] != null && $_POST['descriForpag'] != '') {
            $_SESSION['SD_DESCRIPCION_FORPAG_SELECCCIONADA'] = $_POST['descriForpag'];
        } else {
            // $_SESSION['SD_DESCRIPCION_FORPAG_SELECCCIONADA'] = '';
        }

        if (isset($_SESSION['SD_CART'])) {
            $arraySessionDataCart = $_SESSION['SD_CART'];
            $amountInArray = count($arraySessionDataCart);

            for ($i = 0; $i < $amountInArray; $i++) {
                $contador++;
                $acumuladorTotal += floatval(
                    $arraySessionDataCart[$i]['preciofinal'] * intval($arraySessionDataCart[$i]['cantidad'])
                );
            }
        }

        $porcentajeDescuentoGral = 0;
        $acumuladorTotalConDescuentoGral = $acumuladorTotal;
        if (isset($_SESSION['SD_GENERAL_DISCOUNT']) && intval($_SESSION['SD_GENERAL_DISCOUNT']) > 0) {
            $acumuladorTotalConDescuentoGral = floatval($acumuladorTotal - $acumuladorTotal * ($_SESSION['SD_GENERAL_DISCOUNT'] / 100));
            $porcentajeDescuentoGral = trim($_SESSION['SD_GENERAL_DISCOUNT']);
        }

        $montoDescuento = floatval($acumuladorTotal - $acumuladorTotalConDescuentoGral);

        $costoRealDeEnvio = 0; // Es el costo de envío actualizado. En caso de que deba ser envío gratis, es 00.00.
        if ($forenv == 'domicilio') {
            $costoEnvioLocal = floatval($_SESSION['SD_COSTO_ENVIO_PEDIDO']);
            // setMessageInfoText('costoEnvioLocal', $costoEnvioLocal);
            $topeEnvioGratisLocal = intval($_SESSION['SD_TOPE_ENVIO_GRATIS_PEDIDO']);

            if ($costoEnvioLocal > 0) {
                if ($topeEnvioGratisLocal > 0) {
                    if (floatval($acumuladorTotal) > floatval($topeEnvioGratisLocal)) {
                        // Envío gratis
                        // setMessageInfoText('costoEnvioLocal', $costoEnvioLocal);
                        // setMessageInfoText('acumuladorTotal', $acumuladorTotal);
                        // setMessageInfoText('topeEnvioGratisLocal', $topeEnvioGratisLocal);
                        $costoRealDeEnvio = 0;
                    } else {
                        $costoRealDeEnvio = $costoEnvioLocal;
                    }
                } else {
                    $costoRealDeEnvio = $costoEnvioLocal;
                }
            }
            $acumuladorTotalConDescuentoGral += $costoRealDeEnvio;
        }

        $montoPorcentajeIncremento = 0;
        if (floatval($porcentajeIncremento) != null && floatval($porcentajeIncremento) > 0) {
            $montoPorcentajeIncremento = $acumuladorTotalConDescuentoGral;
            $acumuladorTotalConDescuentoGral = $acumuladorTotalConDescuentoGral + $acumuladorTotalConDescuentoGral * (floatval($porcentajeIncremento) / 100);
            $montoPorcentajeIncremento = $acumuladorTotalConDescuentoGral - $montoPorcentajeIncremento;
        } else {
            $porcentajeIncremento = 0;
        }

        $_SESSION['SD_MONTO_TOTAL_FINAL_PEDIDO'] = $acumuladorTotalConDescuentoGral;
        $_SESSION['SD_MONTO_FINAL_ENVIO'] = $costoRealDeEnvio;
        $_SESSION['SD_MONTO_TOTAL_SIN_DESCUENTO_NI_ENVIO'] = $acumuladorTotal;
        $_SESSION['SD_MONTO_PORCENTAJE_INCREMENTO'] = $montoPorcentajeIncremento;
        $_SESSION['SD_PORCENTAJE_INCREMENTO'] = $porcentajeIncremento;

        $dataArray = array(
            'cantidadProdutos' => $contador,
            'acumuladorTotal' => number_format($acumuladorTotal, 2),
            'acumuladorTotalConDescuentoGral' => number_format($acumuladorTotalConDescuentoGral, 2),
            'porcentajeDescuentoGral' => number_format($porcentajeDescuentoGral),
            'montoDescuento' => number_format($montoDescuento, 2),
            'costoRealDeEnvio' => $costoRealDeEnvio,
            'porcentajeIncremento' => number_format($porcentajeIncremento, 2),
            'montoPorcentajeIncremento' => number_format($montoPorcentajeIncremento, 2)
        );

        // echo json_encode($_SESSION['SD_CART'], true);
        echo json_encode($dataArray, true);

        die;
        break;
        #endregion

        // ================================================================================================

        #region getAllProductsOfCart
    case 'getAllProductsOfCart':

        // unset($_SESSION['SD_CART']);

        /*
        
        */
        $response = '';
        if (isset($_SESSION['SD_CART'])) {
            $response = json_encode($_SESSION['SD_CART'], true);
            // $arraySessionDataCart = $_SESSION['SD_CART'];
            // $amountInArray = count($arraySessionDataCart);

            // for ($i = 0; $i < $amountInArray; $i++) {
            //     $contador++;
            //     $acumuladorTotal +=
            //         floatval($arraySessionDataCart[$i]['preciofinal']) * intval($arraySessionDataCart[$i]['cantidad']);
            // }
        }

        // $dataArray = array(
        //     'cantidadProdutos' => $contador,
        //     'acumuladorTotal' => number_format($acumuladorTotal, 2)
        // );

        // echo json_encode($_SESSION['SD_CART'], true);
        echo $response; //json_encode($dataArray, true);

        die;
        break;
        #endregion

        // ================================================================================================

        #region deleteOneProductInCart
    case 'deleteOneProductInCart':

        $numero = intval($_POST['numero']);
        $type = $_POST['type'];
        $idpresentacion = intval($_POST['idPresentacion']);
        $newArrayProducts = null;

        if (isset($_SESSION['SD_CART'])) {

            $arraySessionDataCart = $_SESSION['SD_CART'];
            $amountInArray = count($arraySessionDataCart);

            // echo json_encode($arraySessionDataCart); // $amountInArray;
            // return;

            for ($i = 0; $i < $amountInArray; $i++) {

                $idPresProducto = intval($arraySessionDataCart[$i]['idpresentacion']);
                $numeroProducto = intval($arraySessionDataCart[$i]['numero']);

                if ($numeroProducto == $numero && $idPresProducto == $idpresentacion) {
                    // echo 'num igual y pres igual';
                } else {
                    $newArrayProducts[] = array(
                        'numero' => $arraySessionDataCart[$i]['numero'],
                        'type' => $arraySessionDataCart[$i]['type'],
                        'denom' => $arraySessionDataCart[$i]['denom'],
                        'stopro' => $arraySessionDataCart[$i]['stopro'],
                        'stoact' => $arraySessionDataCart[$i]['stoact'],
                        'idestado' => $arraySessionDataCart[$i]['idestado'],
                        'prefin' => $arraySessionDataCart[$i]['prefin'],
                        'preciofinal' => $arraySessionDataCart[$i]['preciofinal'],
                        'bonfija' => $arraySessionDataCart[$i]['bonfija'],
                        'idpresentacion' => $arraySessionDataCart[$i]['idpresentacion'],
                        'pesopres' => $arraySessionDataCart[$i]['pesopres'],
                        'cantidad' => $arraySessionDataCart[$i]['cantidad']
                    );
                }
            }

            // echo json_encode($newArrayProducts);

            if (isset($newArrayProducts)) {
                $_SESSION['SD_CART'] = $newArrayProducts;
                echo 1; // Carrito actualizado
                return;
                die();
            } else {
                //Elimino la variable de sesión del carrito
                unset($_SESSION['SD_CART']);
                echo 'e_1'; // No hay productos en carrito
                return;
                die();
            }
        } else {
            unset($_SESSION['SD_CART']);
            echo 0; // No hay productos en carrito
            return;
            die();
        }

        die;
        break;
        #endregion

        // ================================================================================================

        #region getEmailLoggedClient
    case 'getEmailLoggedClient':
        if (!isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
            echo 0;
        } else {
            echo getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'email');
        }
        break;
        die();
        #endregion

        #region getNameLoggedClient
    case 'getNameLoggedClient':
        if (!isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
            echo 0;
        } else {
            echo getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'nombre');
        }
        break;
        die();
        #endregion

        #region validateCanCheckout
    case 'validateCanCheckout':
        if (!isset($_SESSION['SD_CART'])) {
            echo 'e0';
            break;
            die();
        }

        $arraySessionDataCart = $_SESSION['SD_CART'];
        $amountInArray = count($arraySessionDataCart);

        if ($amountInArray < 1) {
            echo 'e0';
            break;
            die();
        }

        if (!isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
            echo 'e1';
            break;
            die();
        }

        echo 's1';
        break;
        die();
        #endregion

        // ================================================================================================

        #region getDomicilio
    case 'getDomicilio':
        if (!isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
            echo 0;
        } else {
            echo getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'domicilio');
        }
        break;
        die();
        #endregion

        // ================================================================================================

        #region getLocalidad
    case 'getLocalidad':
        if (!isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
            echo 0;
        } else {
            echo getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'localidad');
        }
        break;
        die();
        #endregion

        // ================================================================================================

        #region getCodPost
    case 'getCodPost':
        if (!isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
            echo 0;
        } else {
            echo getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'codpost');
        }
        break;
        die();
        #endregion

        // ================================================================================================

        #region getProvincia
    case 'getProvincia':
        if (!isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
            echo 0;
        } else {
            echo getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'provincia');
        }
        break;
        die();
        #endregion

        // ================================================================================================

        #region cleanCart
    case 'cleanCart':
        unset($_SESSION['SD_CART']);
        die();
        break;
        #endregion

        // ================================================================================================

        #region closeSession
    case 'closeSession':
        unset($_SESSION['SD_CLIENTE_WEB_LOGUEADO']);
        echo '1';
        die();
        break;
        #endregion

        // ================================================================================================

        #region closeSessionAdmin
    case 'closeSessionAdmin':
        unset($_SESSION['SD_USUARIO_ADMIN']);
        echo '1';
        die();
        break;
        #endregion

        // ================================================================================================

        #region orderShopBy
    case 'orderShopBy':
        $typeOrder = $_POST['typeOrder'];
        if ($typeOrder == 'nameDes') {
            $_SESSION['SD_ORDER_PRODUCTS_BY'] = 'denom DESC';
            echo 'sf';
        } else if ($typeOrder == 'nameAsc') {
            $_SESSION['SD_ORDER_PRODUCTS_BY'] = 'denom';
            echo 'sf';
        } else if ($typeOrder == 'priceLowFirst') {
            $_SESSION['SD_ORDER_PRODUCTS_BY'] = 'prefin';
            echo 'sf';
        } else if ($typeOrder == 'priceHigFirst') {
            $_SESSION['SD_ORDER_PRODUCTS_BY'] = 'prefin DESC';
            echo 'sf';
        } else {
            echo 'ef';
        }
        die;
        break;
        #endregion

        // ================================================================================================

        #region setPageProductsIndex
    case 'setPageProductsIndex':
        $numPage = intval($_POST['numPage']);

        if ($numPage < 1) {
            unset($_SESSION['SD_ORDER_PRODUCTS_BY']);
            $_SESSION['SD_NUM_PAGE_INDEX'] = 1;
            $numPage = 1;
        }
        $_SESSION['SD_NUM_PAGE_INDEX'] = $numPage;
        // echo $numPage;
        echo 'sf'; // Success front
        die;
        break;
        #endregion

        // ================================================================================================

        #region 7
    case 'getDatosClienteWeb':
        if (!isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
            echo 0;
        } else {
            echo trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']);
        }
        die;
        break;
        #endregion

        // ================================================================================================

        #region 8
    case '8':
        // session_unset();
        // session_destroy();
        die;
        break;
        #endregion

        // ================================================================================================

        #region Empty
    case '':
        // $ci = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30);
        // $cf = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 40);

        pg_close($conexion);
        echo sendErrorMessage(1000) . ' || ' . ' Función: ' . $funcion; // . ' ' . basename($_SERVER['PHP_SELF']);
        break;
        #endregion

        // ================================================================================================

        #region default
    default:
        // $ci = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30);
        // $cf = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 40);

        // pg_close($conexion);
        // echo sendErrorMessage(1001) . ' || ' . ' Función: ' . $funcion; // . ' ' . basename($_SERVER['PHP_SELF']);
        break;
        #endregion
        // ================================================================================================
}

// ====================================================================================================================
// FUNCIONES

function setHoraModalInit()
{
    // Setea la hora en la que se abrió el modal
    $horaActual = date('h:i:s A');
    $_SESSION["SD_HORA_MODAL_INIT"] = $horaActual; // json_encode($array);
}

function getHoraModalInit()
{
    echo $_SESSION["SD_HORA_MODAL_INIT"];
}

function getDescuentoGeneralEmpresConfig()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getDescuentoGeneralEmpresConfig');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery | getBranchesOffices()', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    // session_start();
    $_SESSION['SD_GENERAL_DISCOUNT'] = reemplazarPorAcentos($responseQuery);
    return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}
// =====================================================================================================================================
