<?php
session_start();
require_once('php/constants.php');

if (!isset($_SESSION["SD_CLIENTE_WEB_LOGUEADO"])) {
    header('Location: ' . URL_APP . 'login');
    $_SESSION['SD_LOCATION'] = 'checkout';
    die();
    return;
}

$_SESSION['SD_ID_FORPAG_SELECCCIONADA'] = 5;

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/modal-init.php');

require_once('php/util/methods.php');

require_once('php/middleware/productos.php');
require_once('php/middleware/pedidos.php');
require_once('php/middleware/combo-producto.php');

// echo json_encode($_SESSION['SD_PEDIDO_ACTUAL_CONFIRMADO']);
// echo '<br>';
// echo '<br>';
// echo json_encode($_SESSION['SD_CART']);
// return;

// echo getCBU();
// echo getAlias();
// return;
?>

<!DOCTYPE html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">

    <?php require_once('php/components/tittle-icon-page.php'); ?>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- ############################################################# -->
    <!-- Para evitar que archivos css/js/imagenes se guarden en caché -->
    <!-- <?php //require_once('php/components/meta-head.php'); 
            ?> -->
    <!-- ############################################################# -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/main.css?v=4.0">

    <!-- Styles Prop. -->
    <link rel="stylesheet" href="assets/css/modules/styles-maxi.css">
    <link rel="stylesheet" href="css/libs/sweetAlert.css">
    <link rel="stylesheet" href="css/disable-input-arrows.css">

    <!-- Implementación DateTimePickr 2 -->
    <link rel="stylesheet" href="modules/dateTimeFlatpickr/css/flatpickr.min.css"><!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->
    <link rel="stylesheet" type="text/css" href="modules/dateTimeFlatpickr/css/material_blue.css"><!-- <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css"> -->
    <script src="modules/dateTimeFlatpickr/js/flatpickr.js"></script><!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->

</head>

<body>
    <!-- Preloader Start -->
    <!-- <?php //require_once('php/components/preloader-start.php'); 
            ?> -->

    <?php require_once('php/components/header.php'); ?>

    <!-- ########################################################################################################## -->
    <!-- Mobile section -->
    <?php require_once('php/components/header-mobile.php'); ?>
    <!-- ########################################################################################################## -->

    <main class="main">
        <!-- <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div> -->
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Finalizando compra</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">Hay
                            <span class="text-brand" style="font-size: 20px;">
                                <?php
                                if (isset($_SESSION['SD_CART'])) {
                                    echo count($_SESSION['SD_CART']);
                                } else {
                                    echo 0;
                                }
                                ?>
                            </span>
                            productos en tu carrito
                        </h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $subTotalPedido = 0;
                    if (isset($_SESSION['SD_CART'])) {
                        // echo json_encode($_SESSION['SD_CART']);
                    ?>
                        <!-- Table ==> Productos que se encuentran en el carrito -->
                        <table class="table table-wishlist table-hover" style="background: AliceBlue;">
                            <thead>
                                <tr class="main-heading">
                                    <!-- <th class="custome-checkbox start pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                        <label class="form-check-label" for="exampleCheckbox11"></label>
                                    </th> -->
                                    <th scope="col">ARTÍCULOS</th>
                                    <th scope="col">PRECIO</th>
                                    <th scope="col">CANTIDAD</th>
                                    <th scope="col">SUBTOTAL</th>
                                    <!-- <th scope="col" class="end">Eliminar</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $dataArrayCombo = '';
                                if (isset($_SESSION['SD_CART'])) {
                                    // echo json_encode($_SESSION['SD_CART'], true);
                                    foreach ($_SESSION['SD_CART'] as $dato) {
                                        // echo $dato['numero'];

                                        if (trim($dato['type']) == 'combo') {
                                            $dataArrayCombo = getOneComboOfCod(intval(trim($dato['numero'])));
                                            $dataArrayCombo = str_replace('[', '', $dataArrayCombo);
                                            $dataArrayCombo = str_replace(']', '', $dataArrayCombo);
                                            // echo getOneValueOfJsonData($dataArrayCombo, 'pretot');
                                            // foreach (json_decode($dataArrayCombo, true) as $dataCombo) {
                                        }
                                ?>

                                        <tr class="pt-30">
                                            <!-- <td class="custome-checkbox pl-30">
                                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                <label class="form-check-label" for="exampleCheckbox1"></label>
                                            </td> -->
                                            <!-- <td class="image product-thumbnail pt-40"><img src="assets/imgs/shop/product-1-1.jpg" alt="#"></td> -->
                                            <td class="product-des product-name">
                                                <h6 class="mb-5">
                                                    <a class="product-name mb-10 text-heading" href="product-detail?td=p&c=<?php echo trim($dato['numero']); ?>">
                                                        <?php
                                                        if (trim($dato['type']) == 'combo') {
                                                            echo getOneValueOfJsonData($dataArrayCombo, 'denom');
                                                        } else {
                                                            echo trim($dato['denom']);
                                                        }
                                                        ?>
                                                    </a>
                                                </h6>
                                                <div class="product-rate-cover">
                                                    <!-- <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div> -->
                                                    <!-- <span class="font-small ml-5 text-muted"> (4.0)</span> -->
                                                    <?php
                                                    if (intval(trim($dato['idpresentacion'])) > 0) {
                                                    ?>
                                                        <h6>
                                                            Presentación:
                                                            <span class="badge bg-primary">
                                                                <?php echo trim($dato['pesopres']) . ' kg' ?>
                                                            </span>
                                                        </h6>
                                                    <?php
                                                    }
                                                    ?>
                                                    <a class="product-category" href="product-detail?td=p&c=<?php echo trim($dato['numero']); ?>">
                                                        <strong>
                                                            <?php echo 'Cod. ' . trim($dato['numero']); ?>
                                                        </strong>
                                                    </a>
                                                </div>

                                                <?php
                                                // Valido si el producto tiene bonfija para mostrarlo correctamente
                                                if ($dato['bonfija'] > 0) {
                                                ?>
                                                    <h6 class="mb-5">
                                                        <span class="stock-status in-stock">
                                                            <?php
                                                            // echo $dataArrayCombo;
                                                            if (trim($dato['type']) == 'combo') {
                                                                if (strtoupper(getOneValueOfJsonData($dataArrayCombo, 'tipobonifi')) == 'F') {
                                                                    echo '$ ' . number_format(trim(getOneValueOfJsonData($dataArrayCombo, 'bonifi')), 2);
                                                                } else {
                                                                    echo number_format(trim(getOneValueOfJsonData($dataArrayCombo, 'bonifi'))) . ' % ';
                                                                }
                                                            } else {
                                                                if ($dato['tipobonifi'] == 'f') {
                                                                    echo '$ ' . number_format(trim($dato['bonfija']));
                                                                } else {
                                                                    echo number_format(trim($dato['bonfija'])) . ' %';
                                                                }
                                                            }
                                                            // echo number_format(trim($dato['bonfija']));
                                                            ?>
                                                            Off!
                                                        </span>
                                                    </h6>
                                                <?php
                                                }
                                                ?>

                                            </td>
                                            <td class="price" data-title="Price">

                                                <?php
                                                // Valido si el producto tiene bonfija para mostrarlo correctamente
                                                if ($dato['bonfija'] > 0) {
                                                ?>
                                                    <h6 class="text-body">
                                                        <strike>
                                                            $
                                                            <?php
                                                            if (trim($dato['type']) == 'combo') {
                                                                echo number_format(trim(getOneValueOfJsonData($dataArrayCombo, 'pretot')), 2);
                                                            } else {
                                                                if ($dato['pesopres'] != 0) {
                                                                    echo number_format(floatval(trim($dato['prefin'])) * floatval($dato['pesopres']), 2);
                                                                } else {
                                                                    echo number_format(floatval(trim($dato['prefin'])), 2);
                                                                }
                                                            }
                                                            ?>
                                                        </strike>
                                                        <?php //echo trim($dato['pesopres']); 
                                                        ?>
                                                        <span class="badge bg-info">Off</span>
                                                    </h6>
                                                <?php
                                                }
                                                ?>
                                                <!-- <h4 class="text-body text-brand">$254.36</h4> -->
                                                <h4 class="text-brand">
                                                    $
                                                    <?php
                                                    echo number_format(floatval(trim($dato['preciofinal'])), 2);
                                                    ?>
                                                </h4>
                                            </td>

                                            <!-- <td class="text-center detail-info" data-title="Stock">
                                                <div class="detail-extralink mr-15">
                                                    <div class="detail-qty border radius">
                                                        <a onclick="lessCountProductInCart('<?php echo trim($dato['type']); ?>', <?php echo trim($dato['numero']); ?>, <?php echo trim($dato['idpresentacion']); ?>); return false" class="qty-down">
                                                            <i class="fi-rs-angle-small-down"></i>
                                                        </a>
                                                        <span class="qty-val"><?php echo trim($dato['cantidad']); ?></span>
                                                        <a onclick="addCountProductInCart('<?php echo trim($dato['type']); ?>', <?php echo trim($dato['numero']); ?>, <?php echo trim($dato['idpresentacion']); ?>); return false" class="qty-up">
                                                            <i class="fi-rs-angle-small-up"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td> -->

                                            <td class="text-center detail-info" data-title="Stock">
                                                <h4 class="text-brand" style="text-align: center;"><?php echo number_format(trim($dato['cantidad'])); ?></h4>
                                            </td>

                                            <td class="price" data-title="Price">
                                                <h4 class="text-brand" style="text-align: center;">
                                                    $
                                                    <?php
                                                    echo number_format(trim($dato['preciofinal'] * $dato['cantidad']), 2);
                                                    $subTotalPedido = $subTotalPedido + trim($dato['preciofinal'] * $dato['cantidad']);
                                                    ?>
                                                </h4>
                                            </td>

                                            <!-- <td class="action text-center" data-title="Remove">
                                                <a onclick="deleteOneProductInCart('<?php echo trim($dato['type']); ?>', <?php echo trim($dato['numero']); ?>, <?php echo trim($dato['idpresentacion']); ?>); return false;" class="text-body">
                                                    <i class="fi-rs-trash"></i>
                                                </a>
                                            </td> -->
                                        </tr>

                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="row d-flex justify-content-evenly" style="margin-top: 20px;">
                <div class="card text-center col-md-4" style="width: 28rem; background: AliceBlue">
                    <div class="row">
                        <h4 class="mb-30">Información adicional</h4>
                        <form>
                            <div class="form-group mb-30">
                                <textarea id="id-info-adic" rows="5" placeholder="Ingresa aquí tus observaciones, sugerencias o información adicional relacionada al pedido. En caso de que aún no hayas registrado tu domicilio en la sección MI CUENTA, debes ingresar tu domicilio aquí.."></textarea>
                            </div>
                        </form>
                        <p id="id-txt-help-forenv" style="color: SteelBlue;">
                            Te sugerimos que cualquier comentario, sugerencia y/o aclaración nos lo hagas saber en este apartado.
                        </p>
                    </div>
                </div>

                <div class="card text-center col-md-4" style="width: 28rem; background: AliceBlue">
                    <div class="payment">
                        <h4 class="mb-30">Forma de envío</h4>
                        <div class="payment_option">
                            <!-- <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="id-radio-envio" checked="true">
                                <label class="form-check-label" for="id-radio-envio" data-bs-toggle="collapse" data-target="#envio" aria-controls="envio">
                                    Envío a domicilio
                                </label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="id-radio-retiro" checked="">
                                <label class="form-check-label" for="id-radio-retiro" data-bs-toggle="collapse" data-target="#retiro" aria-controls="retiro">
                                    Retiro en sucursal
                                </label>
                            </div> -->

                            <h1 id="id-help-cantidad-sucursales" style="display: none;"><?php echo $amountOfBranchesOffices; ?></h1>

                            <!-- <?php $valueOfSelectForenv = 1; ?> -->
                            <select id="id-select-forenv" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="text-align-last:center;">
                                <!-- <option value="<?php echo $valueOfSelectForenv; ?>" selected>Envío a domicilio</option>
                                <?php
                                if ($amountOfBranchesOffices != 0 && !str_contains($dataArrayBranchesOffices, 'ERROR_CODE')) {
                                    foreach (json_decode($dataArrayBranchesOffices, true) as $dato) {
                                        $valueOfSelectForenv++;
                                ?>
                                        <option value="<?php echo $valueOfSelectForenv; ?>">
                                            Retiro en sucursal <?php echo $dato['nombre']; ?>
                                        </option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="2">
                                        Retiro en sucursal
                                    </option>
                                <?php
                                }
                                ?> -->
                                <?php
                                $shippingMethods = json_decode(getAllShippingMethods(), true);
                                // echo var_dump($shippingMethods);

                                foreach ($shippingMethods as $shipping) {
                                    if ($shipping['codigo'] == $pedidoSeleccionado['forenv']) { ?>
                                        <option value="<?php echo $shipping['codigo'] ?>" selected><?php echo $shipping['nombre'] . ' : ' . $shipping['detalle'] ?></option>

                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $shipping['codigo'] ?>"><?php echo $shipping['nombre'] . ' : ' . $shipping['detalle'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                            <?php
                            if (
                                getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'domicilio') != ''
                                && getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'domicilio') != null
                            ) {
                            ?>
                                <p id="id-txt-help-forenv" style="color: SteelBlue;">
                                    Para envíos a domicilio ya tienes una dirección registrada:
                                    <br>
                                    <strong>
                                        <?php echo getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'domicilio') . '|' . getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'localidad') . '|' . getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'provincia') . '|' . getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'codpost') ?>
                                    </strong>
                                    <br>
                                    Puedes cambiarla en la sección
                                    <a class="product-category" href="data-account">
                                        <strong>
                                            MI CUENTA
                                        </strong>
                                    </a>.
                                    <br>
                                </p>
                            <?php
                            } else {
                            ?>
                                <p id="id-txt-help-forenv">
                                    Para envíos a domicilio es importante que ingreses la dirección a la que quieres recibir el pedido en info. adicional (a la izquierda).
                                </p>
                                <a class="product-category" href="data-account">
                                    <strong>
                                        ¡REGISTRAR Y ASOCIAR DOMICILIO A MI CUENTA!
                                    </strong>
                                </a>
                            <?php
                            }
                            ?>

                            <!-- <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                            </div> -->

                            <hr>

                            <p id="id-p-date-forenv" style="color: SteelBlue; display: none;">
                                Selecciona el día en que quieres recibir tu pedido Las entregas a domicilio son de lun. a vier. de 9hs a 20hs.
                                <!-- <input id="id-input-date" style="max-width: 200px;" type="date" name="begin" placeholder="dd-mm-yyyy" value="" min="1997-01-01" max="2030-12-31"> -->
                                <label>
                                    <!-- <div>Date 1</div> -->
                                    <input id="id-input-date" placeholder="..Seleccionar aquí.." class="date" />
                                </label>
                            </p>
                        </div>
                        <!-- <div class="payment-logo d-flex">
                            <img class="mr-15" src="assets/imgs/theme/icons/payment-paypal.svg" alt="">
                            <img class="mr-15" src="assets/imgs/theme/icons/payment-visa.svg" alt="">
                            <img class="mr-15" src="assets/imgs/theme/icons/payment-master.svg" alt="">
                            <img src="assets/imgs/theme/icons/payment-zapper.svg" alt="">
                        </div> -->
                        <!-- <a href="#" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></a> -->
                    </div>
                </div>

                <div class="card text-center col-md-4" style="width: 28rem; background: AliceBlue">
                    <div class="payment">
                        <h4 class="mb-30">Forma de pago</h4>
                        <!-- <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Efectivo</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Transferencia Bancaria</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Mercado Pago</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Tarjeta Débito</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Tarjeta Crédito</label>
                            </div>
                        </div> -->

                        <select id="id-select-forpag" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="text-align-last:center;">
                            <option value="5" selected>Efectivo</option>
                            <option value="4">Transferencia Bancaria</option>
                            <option value="3">Mercado Pago</option>
                            <option value="2">Tarjeta Débito</option>
                            <option value="1">Tarjeta Crédito</option>
                        </select>

                        <p id="id-txt-help-forpag" style="color: SteelBlue;">
                            Abonarás el pedido en efectivo al momento de la entrega
                        </p>

                        <p id="id-txt-help-forpag-recargo" style="color: SteelBlue; font-weight: bold;"></p>

                        <!-- <div class="payment-logo d-flex">
                            <img class="mr-15" src="assets/imgs/theme/icons/payment-paypal.svg" alt="">
                            <img class="mr-15" src="assets/imgs/theme/icons/payment-visa.svg" alt="">
                            <img class="mr-15" src="assets/imgs/theme/icons/payment-master.svg" alt="">
                            <img src="assets/imgs/theme/icons/payment-zapper.svg" alt="">
                        </div> -->
                        <!-- <a href="" class="btn btn-fill-out btn-block mt-30">CONFIRMAR<i class="fi-rs-sign-out ml-15"></i></a> -->
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-lg-12">
                    <!-- ##################################################################################################################################################### -->

                    <!-- TOTALES -->

                    <div class="col-lg-12">
                        <div class="border p-md-4 cart-totals" style="max-width:750px; margin: 0 auto;">
                            <div class="table-responsive table-hover">
                                <table class="table no-border">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Subtotal</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="id-cart-resumen-subtotal" class="text-brand text-end">$</h4>
                                            </td>
                                        </tr>

                                        <!-- <tr>
                                            <td scope="col" colspan="2">
                                                <div class="divider-2 mt-10 mb-10"></div>
                                            </td>
                                        </tr> -->

                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Descuento
                                                    <p style="display: inline; font-size: 18px;"><span id="id-cart-porcentaje-descuento" class="badge bg-info"></span></p>
                                                </h6>
                                                <!-- <h4>Example heading <span class="badge bg-secondary">New</span></h4> -->

                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="id-cart-resumen-descuento" class="text-brand text-end text-info">$</h4>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Subtotal con descuento</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="id-cart-resumen-subtotal-con-descuento" class="text-brand text-end">$</h4>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Costo de envío
                                                    <?php
                                                    $costoEnvioLocal = 00.00;
                                                    if (floatval($costoEnvio) > 0) {
                                                        $costoEnvioLocal = floatval($costoEnvio);
                                                    }
                                                    if (floatval($costoEnvio) > 0 && floatval($topeEnvioGratis) > 0) {
                                                    ?>
                                                        <p style="display: inline; font-size: 18px;">
                                                            <span id="id-costo-envio" class="badge bg-info">
                                                                Envío gratis en pedido sup. a $ <?php echo number_format(floatval($topeEnvioGratis), 2); ?>
                                                            </span>
                                                        </p>
                                                    <?php
                                                    }
                                                    ?>
                                                </h6>
                                                <!-- <h4>Example heading <span class="badge bg-secondary">New</span></h4> -->
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="id-costo-envio-checkout" class="text-brand text-end text-info">
                                                    $
                                                    <?php
                                                    if ($costoEnvioLocal > 0) {
                                                        if ($topeEnvioGratis > 0) {
                                                            if ($subTotalPedido > $topeEnvioGratis) {
                                                                echo '00.00';
                                                            } else {
                                                                $subTotalPedido += $costoEnvioLocal;
                                                                echo number_format($costoEnvioLocal, 2);
                                                            }
                                                        } else {
                                                            echo number_format($costoEnvioLocal, 2);
                                                            $subTotalPedido += $costoEnvioLocal;
                                                        }
                                                    } else {
                                                        echo '00.00';
                                                    }
                                                    ?>
                                                </h4>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Recargo por forma de pago seleccionada
                                                    <p style="display: inline; font-size: 18px;">
                                                        <span id="id-costo-recargo" class="badge bg-info"></span>
                                                    </p>
                                                </h6>
                                                <!-- <h4>Example heading <span class="badge bg-secondary">New</span></h4> -->
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="id-costo-recargo-checkout" class="text-brand text-end text-info">
                                                    $
                                                </h4>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Recargo
                                                    <?php
                                                    $recargo = 00.00;
                                                    if (floatval($costoEnvio) > 0) {
                                                        $costoEnvioLocal = number_format(floatval($costoEnvio), 2);
                                                    }
                                                    if (floatval($costoEnvio) > 0 && floatval($topeEnvioGratis) > 0) {
                                                    ?>
                                                        <p style="font-size: 18px;">
                                                            <span id="id-recargo-pedido" class="badge bg-info">
                                                                Corresponde a:
                                                            </span>
                                                        </p>
                                                    <?php
                                                    }
                                                    ?>
                                                </h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 id="id-costo-envio-checkout" class="text-brand text-end text-info">
                                                    $
                                                    <?php
                                                    if ($costoEnvioLocal > 0) {
                                                        if ($topeEnvioGratis > 0) {
                                                            if ($subTotalPedido > $topeEnvioGratis) {
                                                                echo '00.00';
                                                            } else {
                                                                echo number_format($costoEnvioLocal, 2);
                                                                $subTotalPedido += $costoEnvioLocal;
                                                            }
                                                        } else {
                                                            echo number_format($costoEnvioLocal, 2);
                                                            $subTotalPedido += $costoEnvioLocal;
                                                        }
                                                    } else {
                                                        echo '00.00';
                                                    }
                                                    ?>
                                                </h4>
                                            </td>
                                        </tr> -->

                                        <!-- <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Shipping</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">Free</h4< /td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Estimate for</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">United Kingdom</h4< /td>
                                    </tr> -->

                                        <!-- <tr> -->
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">TOTAL</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h3 id="id-checkout-total" class="text-brand text-end">
                                                    <!-- $ -->
                                                    <?php
                                                    // if ($_SESSION['SD_GENERAL_DISCOUNT'] > 0) {
                                                    //     $subTotalPedido = $subTotalPedido - $subTotalPedido * ($_SESSION['SD_GENERAL_DISCOUNT'] / 100);
                                                    // }
                                                    // echo number_format($subTotalPedido, 2);
                                                    ?>
                                                </h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a onclick="registrarPedido(); return false;" class="btn mb-20 w-100" style="font-size: 25px;">CONFIRMAR<i class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <tr>
                <td scope="col" colspan="2">
                    <div class="divider-2 mt-10 mb-10"></div>
                </td>
            </tr>

            <?php require_once 'php/components/wp-floating.php'; ?>

    </main>

    <?php require_once('php/components/footer.php'); ?>

    <!-- Vendor JS-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/slick.js"></script>
    <script src="assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="assets/js/plugins/wow.js"></script>
    <script src="assets/js/plugins/jquery-ui.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="assets/js/plugins/magnific-popup.js"></script>
    <script src="assets/js/plugins/select2.min.js"></script>
    <script src="assets/js/plugins/waypoints.js"></script>
    <script src="assets/js/plugins/counterup.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/images-loaded.js"></script>
    <script src="assets/js/plugins/isotope.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="assets/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="./assets/js/main.js?v=4.0"></script>
    <script src="./assets/js/shop.js?v=4.0"></script>

    <!-- JS Propios -->
    <script src="js/constants.js"></script>
    <script src="js/view/index.js"></script>

    <!-- Deben llamarse después del index.js -->
    <script src="js/middleware/sucursales.js"></script>

    <?php require_once('php/libs/sweet-alert.php'); ?>
    <script src="js/util/methods.js"></script>
    <script src="js/middleware/footer.js"></script>
    <script src="js/components/header.js"></script>
    <script src="js/view/checkout.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>

    <script>
        // ========================================================================================
        // DOCUMENTACIÓN:
        // 1. https://flatpickr.js.org/examples/#datetimepicker-with-limited-time-range
        // 2. https://github.com/flatpickr/flatpickr

        let startDate = new Date();
        startDate.setDate(startDate.getDate() + 1);

        let endDate = new Date();
        endDate.setDate(endDate.getDate() + 15);

        flatpickr(".date", {
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "d-m-Y",
            minDate: startDate, // "today",
            maxDate: endDate, // "15.12.2017",
            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);

                }
            ],
            "locale": {
                "firstDayOfWeek": 0, // start week on Sunday/Domingo
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                },
            }
        });

        const elementDate = document.getElementById('id-input-date');

        elementDate.addEventListener('change', (event) => {
            console.log(elementDate.value);
            // console.log(dateFormat(elementDate.value, 'dd-MM-yyyy'));
        });

        function dateFormat(inputDate, format) {
            // dateFormat('2021-12-10', 'MM-dd-yyyy')

            // parse the input date
            const date = new Date(inputDate);

            //extract the parts of the date
            const day = date.getDate() + 1;
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            //replace the month
            format = format.replace("MM", month.toString().padStart(2, "0"));

            //replace the year
            if (format.indexOf("yyyy") > -1) {
                format = format.replace("yyyy", year.toString());
            } else if (format.indexOf("yy") > -1) {
                format = format.replace("yy", year.toString().substr(2, 2));
            }

            //replace the day
            format = format.replace("dd", day.toString().padStart(2, "0"));

            return format;
        }
    </script>
</body>

</html>