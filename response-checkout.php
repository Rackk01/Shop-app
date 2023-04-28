<?php
session_start();
require_once('php/constants.php');

if (!isset($_SESSION["SD_CLIENTE_WEB_LOGUEADO"])) {
    header('Location: ' . URL_APP . 'login');
    $_SESSION['SD_LOCATION'] = 'index';
    die();
    return;
} else if (!isset($_SESSION["SD_PEDIDO_ACTUAL_CONFIRMADO"])) {
    header('Location: ' . URL_APP . 'index');
    die();
    return;
}

unset($_SESSION['SD_CART']);
unset($_SESSION['SD_COSTO_ENVIO_PEDIDO']);
unset($_SESSION['SD_MONTO_TOTAL_FINAL_PEDIDO']);
unset($_SESSION['SD_MONTO_PORCENTAJE_INCREMENTO']);
unset($_SESSION['SD_PORCENTAJE_INCREMENTO']);
unset($_SESSION['SD_DESCRIPCION_FORENV_SELECCCIONADA']);
unset($_SESSION['SD_DESCRIPCION_FORPAG_SELECCCIONADA']);

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/modal-init.php');

require_once('php/util/methods.php');

require_once('php/middleware/productos.php');
require_once('php/middleware/combo-producto.php');

$mpPublicKey = getMercadoPagoPublicKey();
$mpAccessToken = getMercadoPagoAccessToken();
// echo '<br>';
// echo '<br>';
// echo getMercadoPagoAccessToken();
// return;
#region MERCADO PAGO ========================================================================================================================
// MERCADO PAGO
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken($mpAccessToken);

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    "success" => URL_APP . "response-checkout.php?response=success",
    "failure" => URL_APP . "response-checkout.php?response=failure",
    "pending" => URL_APP . "response-checkout.php?response=pending"
);
$preference->auto_return = "approved";

$preference->payment_methods = array(
    "excluded_payment_types" => array(
        array("id" => "ticket") //Excluye Payments Type Id 'ticket' --> https://www.mercadopago.com.ar/developers/es/guides/resources/localization/payment-methods#bookmark_medios_de_pago_por_pa%C3%ADs
    )
);

$montoTotalDelPedido = floatval(getOneValueOfJsonData(json_encode($_SESSION["SD_PEDIDO_ACTUAL_CONFIRMADO"]), 'montoTotalFinalPedido'));
// return;
// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Pedido';
$item->quantity = 1;
$item->unit_price = $montoTotalDelPedido;
$preference->items = array($item);
$preference->save();

$forpagSelected = intval($_SESSION['SD_ID_FORPAG_SELECCCIONADA']); // intval(getOneValueOfJsonData(json_encode($_SESSION["SD_PEDIDO_ACTUAL_CONFIRMADO"]), 'valueForpag'));

$isForpagMercadoPago = false;
if ($forpagSelected < 4) {
    $isForpagMercadoPago = true;
}

$isResponseMercadoPago = false;
if ($forpagSelected < 4 && isset($_GET['response'])) {
    // response=success&
    // collection_id=25589250440&collection_status=approved&
    // payment_id=25589250440&
    // status=approved&
    // external_reference=null&
    // payment_type=credit_card&
    // merchant_order_id=5753765798&
    // preference_id=1105343941-6514f457-d267-4d8c-9d4b-4207a19f681e&
    // site_id=MLA&
    // processing_mode=aggregator&
    // merchant_account_id=null
    $isResponseMercadoPago = true;
}

// return;
#endregion MERCADO PAGO
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
    <!-- <?php //require_once('php/components/meta-head.php'); ?> -->
    <!-- ############################################################# -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/main.css?v=4.0">

    <!-- Styles Prop. -->
    <link rel="stylesheet" href="assets/css/modules/styles-maxi.css">
    <link rel="stylesheet" href="css/libs/sweetAlert.css">
    <link rel="stylesheet" href="css/disable-input-arrows.css">

</head>

<body>
    <!-- Preloader Start -->
    <!-- <?php //require_once('php/components/preloader-start.php'); ?> -->

    <?php require_once('php/components/header.php'); ?>

    <main class="main">
        <!-- <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Checkout
                    <span></span> Respuesta
                </div>
            </div>
        </div> -->

        <div class="site-section" style="margin-bottom: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">

                        <span class="icon-check_circle display-3 text-success"></span>
                        <h2 class="display-3 text-black">Excelente!</h2>
                        <p class="lead mb-5">Tu orden se registró correctamente. Nos pondremos en contacto contigo a la brevedad!</p>
                        <p class="lead mb-5">Te enviamos un correo con los datos del pedido.</p>
                        <p><a href="index" class="btn btn-primary" style="margin-top: 40px;">REGRESAR AL INICIO</a></p>

                        <?php
                        if ($isForpagMercadoPago == true && $isResponseMercadoPago == false) {
                        ?>
                            <div class="toggle_info" style="background-color: PapayaWhip; margin-top: 25px; display: flex; justify-content: center;">
                                <span>
                                    <span class="text-danger font-lg"><strong>TU SELECCIÓN DE FORMA DE PAGO FUE MERCADO PAGO</strong></span>
                                    <br>
                                    <span class="text-danger font-lg">Aún no se registró tu pago mediante la plataforma.</span>
                                    <span class="text-danger font-lg"></span>
                                </span>
                            </div>
                            <a id="idHrefMP" href="<?php echo $preference->init_point; ?>" class="btn btn-primary btn-lg py-3 btn-block" style="background: #007bff;  margin-top: 20px;">PAGAR CON MERCADO PAGO</a>

                            <?php
                        }
                        if (isset($_GET['response'])) {
                            if ($_GET['response'] == 'failure') {
                            ?>
                                <div class="toggle_info" style="background-color: PapayaWhip; margin-top: 25px; display: flex; justify-content: center;">
                                    <span>
                                        <span class="text-danger font-lg"><strong>TU SELECCIÓN DE FORMA DE PAGO FUE MERCADO PAGO</strong></span>
                                        <br>
                                        <span class="text-danger font-lg">Aún no se registró tu pago mediante la plataforma.</span>
                                        <span class="text-danger font-lg"></span>
                                    </span>
                                </div>
                                <a id="idHrefMP" href="<?php echo $preference->init_point; ?>" class="btn btn-primary btn-lg py-3 btn-block" style="background: #007bff; margin-top: 20px;">PAGAR CON MERCADO PAGO</a>

                            <?php
                            } else if ($_GET['response'] == 'success') {
                            ?>
                                <div class="toggle_info" style="background-color: PapayaWhip; margin-top: 25px; display: flex; justify-content: center;">
                                    <span>
                                        <span class="text-brand font-lg" style="font-size: 23px;"><strong>¡GENIAL!</strong></span>
                                        <br>
                                        <span class="text-brand font-lg"> <strong></strong>El pago se registró con éxito en la plataforma de Mercado Pago.</span>
                                        <span class="text-brand font-lg"></span>
                                    </span>
                                </div>
                            <?php
                            } else if ($_GET['response'] == 'pending') {
                            ?>
                                <div class="toggle_info" style="background-color: PapayaWhip; margin-top: 25px; display: flex; justify-content: center;">
                                    <span>
                                        <span class="text-brand font-lg" style="font-size: 23px;"><strong>¡GENIAL!</strong></span>
                                        <br>
                                        <span class="text-brand font-lg"> <strong></strong>El pago se registró con éxito, aunque se encuentra pendiente de acreditación. Esto se debe a los tiempos de Mercado Pago para realizar el pago.</span>
                                        <span class="text-brand font-lg"></span>
                                    </span>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

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
    <script src="js/middleware/footer.js"></script>
    <script src="js/components/header.js"></script>
    <!-- <script src="js/view/checkout.js"></script> -->

    <!-- SDK MercadoPago.js V2 -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        // $isForpagMercadoPago && !$isResponseMercadoPago
        if ('<?php echo $isForpagMercadoPago; ?>' == true && '<?php echo $isResponseMercadoPago; ?>' == false) {
            console.log('INGRESÓ JS')
            console.log('<?php echo $isForpagMercadoPago; ?>')
            console.log('<?php echo $isResponseMercadoPago; ?>')
            // Agrega credenciales de SDK
            const mp = new MercadoPago('<?php echo $mpPublicKey; ?>', {
                locale: 'es-AR'
            });

            // Inicializa el checkout
            mp.checkout({
                preference: {
                    id: '<?php echo $preference->id; ?>'
                },
                autoOpen: true
                // render: {
                //   container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                //   label: 'Confirmación', // Cambia el texto del botón de pago (opcional)
                // }
            });
        } else {
            // Agrega credenciales de SDK
            const mp = new MercadoPago('<?php echo $mpPublicKey; ?>', {
                locale: 'es-AR'
            });

            // Inicializa el checkout
            mp.checkout({
                preference: {
                    id: '<?php echo $preference->id; ?>'
                },
                // autoOpen: true
                // render: {
                //   container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                //   label: 'Confirmación', // Cambia el texto del botón de pago (opcional)
                // }
            });
        }
    </script>
</body>

</html>