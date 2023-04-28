<?php
session_start();
require_once('php/constants.php');

if (!isset($_SESSION["SD_CLIENTE_WEB_LOGUEADO"]) || $_SESSION["SD_CLIENTE_WEB_LOGUEADO"] == 'es_1') {
    unset($_SESSION["SD_CLIENTE_WEB_LOGUEADO"]);
    header('Location: ' . URL_APP) . 'login';
    die();
    return;
}

require_once('php/middleware/empres-config.php');
require_once('php/middleware/pedidos.php');
require_once('php/util/methods.php');

if (!isset($_GET['cp'])) {
    // cp --> Código de pedido - nrocomp
    unset($_SESSION["SD_CLIENTE_WEB_LOGUEADO"]);
    header('Location: ' . URL_APP) . 'login';
    die();
    return;
}

$nrocomp = trim($_GET['cp']);

$costoEnvio = 0;
if (floatval(trim($_GET['ce'])) > 0) {
    $costoEnvio = floatval(trim($_GET['ce']));
}

$porcdesc = trim($_GET['pd']);
$nombreForpag = trim($_GET['fp']);
$fechaPedido = trim($_GET['fe']);
$comentario = trim($_GET['co']);
$nombreCli = trim($_GET['nc']);
$emailCli = trim($_GET['ec']);
$telCli = trim($_GET['tc']);
$de = trim($_GET['de']); // debe. Monto total del pedido

/*
cp=<?php echo $dato['nrocomp'];?>&
ce=<?php echo $dato['costo_envio'];?>&
pd=<?php echo $dato['porcdesc'];?>&
fp=<?php echo $dato['nombre_for_pag'];?>&
fe=<?php echo $dato['fecha'];?>&
co=<?php echo $dato['comentario'];?>
*/

$dataArrayIteremProductsPedidoSeleccionado = getAllProductsOfSaleCod($nrocomp);
$dataArrayIteremCombosPedidoSeleccionado = getAllCombosOfSaleCod($nrocomp);

$orderComments = json_decode(getAllOrderComments($nrocomp), true);

?>
<!DOCTYPE html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8" />
    <?php require_once('php/components/tittle-icon-page.php'); ?>
    <!-- <title>Detalle de pedido</title> -->
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <!-- ############################################################# -->
    <!-- Para evitar que archivos css/js/imagenes se guarden en caché -->
    <?php require_once('php/components/meta-head.php'); ?>
    <!-- ############################################################# -->

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.svg" /> -->
    <link rel="stylesheet" href="assets/css/main.css?v=4.0" />

    <link rel="stylesheet" href="css/disable-input-arrows.css">
    <link rel="stylesheet" href="assets/css/modules/styles-maxi.css">

</head>

<body>
    <div class="invoice invoice-content invoice-6">
        <!-- <div class="back-top-home hover-up mt-30 ml-30">
                <a class="hover-up" href="index.html"><i class="fi-rs-home mr-5"></i> Homepage</a>
            </div> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner">
                        <div class="invoice-info" id="invoice_wrapper">
                            <div class="invoice-header">
                                <div class="invoice-icon">
                                    <img src="assets/imgs/theme/icons/icon-invoice.svg" class="img-fluid" alt="">
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="logo">
                                            <a href="index" class="mr-20"><img src="src/img/empresa/LogoEmpresaRectangular.jpg" alt="logo" /></a>
                                            <!-- <a href="index"><img src="src/img/empresa/LogoEmpresaRectangular.jpg" alt="logo" /></a> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <h2 class="mb-0">PEDIDO # <?php echo trim($nrocomp); ?></h2>
                                    </div>
                                </div>
                                <div class="row align-items-center">

                                    <?php
                                    if ($amountOfBranchesOffices != 0 && !str_contains($dataArrayBranchesOffices, 'ERROR_CODE')) {
                                        foreach (json_decode($dataArrayBranchesOffices, true) as $dato) {
                                    ?>
                                            <div class="col-md-3">
                                                <div class="text">
                                                    <strong><?php echo $dato['nombre']; ?></strong><br />
                                                    <abbr title="Teléfono">Tel.:</abbr> <?php echo $dato['tel']; ?><br />
                                                    <abbr title="Domicilio">Dom.:</abbr> <?php echo $dato['domicilio']; ?><br />
                                                    <abbr title="Email">Email:</abbr> <?php echo $dato['email']; ?><br />
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <div class="col-md-6 text-end">
                                        <strong class="text-brand"><?php echo trim($nombreCli); ?></strong> <br />
                                        <!-- Madalinskiego 871-101 Szczecin, Poland<br> -->
                                        <abbr title="Email">Email: </abbr><?php echo trim($emailCli); ?><br>
                                        <abbr title="Teléfono">Tel.: </abbr><?php echo trim($telCli); ?>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <div class="hr mb-10"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <strong class="text-brand"> Pedido Nro:</strong> #<?php echo trim($nrocomp); ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <strong class="text-brand"> Fecha de pedido:</strong> <?php echo date_format(date_create(trim($fechaPedido)), 'd/m/Y'); ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <strong class="text-brand"> Forma de pago:</strong> <?php echo trim($nombreForpag); ?>
                                    </div>
                                    <div class="col-12">
                                        <div class="hr mt-10"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-10"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <strong class="text-danger-pastel"> Estado del pedido:</strong> <?php echo trim($orderComments[0]['comentario']) ?? 'Sin comentarios.'; ?>
                                    </div>
                                    <div class="col-12">
                                        <div class="hr mt-10"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr>
                                                <th>Producto</th>
                                                <th class="text-center">Precio Unit.</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-right">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- SECCIÓN DE ITEREM PRODUCTOS -->
                                            <?php
                                            $montoTotalDelPedidoSinDescuentoGral = 0;
                                            $contador = 0;
                                            $acumulador = 0;
                                            if ($dataArrayIteremProductsPedidoSeleccionado != 'null') {
                                                $amount = count(json_decode($dataArrayIteremProductsPedidoSeleccionado, true));
                                                if ($amount > 0) {

                                                    foreach (json_decode($dataArrayIteremProductsPedidoSeleccionado, true) as $datoItemProd) {

                                                        $acumulador += (floatval(trim($datoItemProd['precio'])) * floatval(trim($datoItemProd['piezas'])));
                                                        // setMessageInfoText('error', $acumulador);

                                                        $urlImage = '../assets/imgs/shop/product-1-1.jpg';
                                                        // if (file_exists('../src/img/productos/' . $datoItemProd['url'])) {
                                                        // 	$urlImage = '../src/img/productos/' . $datoItemProd['url'];
                                                        // } else {
                                                        // 	$urlImage = '../assets/imgs/shop/product-1-1.jpg';
                                                        // }
                                                        if ($datoItemProd['tipo'] != 'e') {
                                                            // Es iterem que no corresponde a costo de envio
                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="item-desc-1">
                                                                        <span><?php echo trim($datoItemProd['denom']); ?></span>
                                                                        <div class="d-flex justify-content-between">
                                                                            <small>COD.: <?php echo trim($datoItemProd['cod']); ?></small>
                                                                            <?php
                                                                            if($datoItemProd['pesopres'] != 0){?>
                                                                                <small>PRES.: <?php echo trim($datoItemProd['pesopres']); ?> Kg.</small>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">$<?php echo number_format(trim($datoItemProd['precio']), 2); ?></td>
                                                                <td class="text-center"><?php echo trim($datoItemProd['piezas']); ?></td>
                                                                <td class="text-right">$<?php echo number_format(trim($datoItemProd['importe']), 2); ?></td>
                                                            </tr>

                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            if ($dataArrayIteremCombosPedidoSeleccionado != 'null') {
                                                $amount = count(json_decode($dataArrayIteremCombosPedidoSeleccionado, true));
                                                if ($amount > 0) {
                                                    foreach (json_decode($dataArrayIteremCombosPedidoSeleccionado, true) as $datoItemComb) {

                                                        $acumulador += (floatval(trim($datoItemComb['precio'])) * floatval(trim($datoItemComb['piezas'])));
                                                        // setMessageInfoText('error', $acumulador);

                                                        // $urlImage = '../src/img/combos/defaul.jpg';
                                                        // if (file_exists('../src/img/combos/' . $datoItemComb['cod'] . '_1.png')) {
                                                        //     $urlImage = '../src/img/combos/' . $datoItemComb['cod'] . '_1.png';
                                                        // } else {
                                                        //     $urlImage = '../src/img/combos/defaul.jpg';
                                                        // }
                                                        if ($datoItemComb['tipo'] != 'e') {
                                                            // Es iterem que no corresponde a costo de envio
                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="item-desc-1">
                                                                        <span><?php echo trim($datoItemComb['denom_combo']); ?></span>
                                                                        <small>COD.: <?php echo trim($datoItemComb['cod']); ?></small>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">$<?php echo number_format(trim($datoItemComb['precio']), 2); ?></td>
                                                                <td class="text-center"><?php echo trim($datoItemComb['piezas']); ?></td>
                                                                <td class="text-right">$<?php echo number_format(trim($datoItemComb['importe']), 2); ?></td>
                                                            </tr>

                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>

                                            <!-- <tr>
                                                <td>
                                                    <div class="item-desc-1">
                                                        <span>Blue Diamond Almonds Lightly Salted</span>
                                                        <small>SKU: FWM15VKT</small>
                                                    </div>
                                                </td>
                                                <td class="text-center">$20.00</td>
                                                <td class="text-center">3</td>
                                                <td class="text-right">$60.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="item-desc-1">
                                                        <span>Fresh Organic Mustard Leaves Bell Pepper</span>
                                                        <small>SKU: KVM15VK</small>
                                                    </div>
                                                </td>
                                                <td class="text-center">$640.00</td>
                                                <td class="text-center">1</td>
                                                <td class="text-right">$640.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="item-desc-1">
                                                        <span>All Natural Italian-Style Chicken Meatballs</span>
                                                        <small>SKU: 98HFG</small>
                                                    </div>
                                                </td>
                                                <td class="text-center">$240.00</td>
                                                <td class="text-center">1</td>
                                                <td class="text-right">$240.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">SubTotal</td>
                                                <td class="text-right">$1710.99</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Tax</td>
                                                <td class="text-right">$85.99</td>
                                            </tr> -->
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Subtotal</td>
                                                <td class="text-right f-w-600">$<?php echo number_format(trim($acumulador - $costoEnvio), 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Descuento <?php echo number_format(trim($porcdesc), 2); ?>%</td>
                                                <td class="text-right f-w-600">
                                                    <?php
                                                    $acumulador = $acumulador - $costoEnvio;
                                                    $totalConDescuento = $acumulador - $acumulador * (floatval(trim($porcdesc)) / 100);
                                                    echo '$' . number_format(trim($totalConDescuento), 2);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Costo de envío</td>
                                                <td class="text-right f-w-600">$<?php echo number_format(trim($costoEnvio), 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Total</td>
                                                <td class="text-right f-w-600">$<?php echo trim($de); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-bottom pb-80">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <h6 class="mb-15">Invoice Infor</h6>
                                        <p class="font-sm">
                                            <strong>Issue date:</strong> 20 march, 2022<br />
                                            <strong>Invoice To:</strong> Mart Inc<br />
                                            <strong>Swift Code:</strong> BFTV VNVXS
                                        </p> -->
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <h6 class="mb-15">TOTAL</h6>
                                        <h3 class="mt-0 mb-0 text-brand">$<?php echo trim($de); ?></h3>
                                        <!-- <p class="mb-0 text-muted">Taxes Included</p> -->
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-12">
                                        <div class="hr mt-30 mb-30"></div>
                                        <p class="mb-0 text-muted"><strong>Nota:</strong> Este es un comprobante generado por computadora y no requiere firma física.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a href="javascript:window.print()" class="btn btn-lg btn-custom btn-print hover-up"> <img src="assets/imgs/theme/icons/icon-print.svg" alt="" /> Imprimir </a>
                            <a id="invoice_download_btn" class="btn btn-lg btn-custom btn-download hover-up"> <img src="assets/imgs/theme/icons/icon-download.svg" alt="" /> Descargar </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>

    <!-- Invoice JS -->
    <script src="assets/js/invoice/jspdf.min.js"></script>
    <script src="assets/js/invoice/invoice.js"></script>
</body>

</html>