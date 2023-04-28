<?php
session_start();
require_once('php/constants.php');

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/modal-init.php');

require_once('php/util/methods.php');
require_once('php/middleware/productos.php');
require_once('php/middleware/combo-producto.php');

// echo json_encode($_SESSION['SD_CART']); // ===> [{"type":"combo","numero":"2222","denom":"Super","stopro":"10.000","stoact":"1.000","idestado":-1,"prefin":"5689.25","preciofinal":"4999.00","bonfija":"690.25","idpresentacion":0,"pesopres":0,"cantidad":"3"},{"type":"producto","numero":"2585","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS24 BLANCO","stopro":"C","stoact":"2.000","idestado":"1","prefin":"3358.68","preciofinal":"3358.68","bonfija":"0","tipobonifi":"P","idpresentacion":"0","pesopres":"0","cantidad":"2"}]

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
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a onclick="goToHome(); return false;" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                    <span></span> Shop
                    <span></span> Cart
                </div>
            </div>
        </div>

        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Tu carrito</h1>
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
                        <h6 class="text-body"><a onclick="confirmCleanCart(); return false;" class="text-muted"><i class="fi-rs-trash mr-5"></i>Vaciar carrito</a></h6>
                    </div>
                    <?php
                    if (isset($_SESSION['SD_CLIENTE_WEB_LOGUEADO'])) {
                    ?>
                        <div class="toggle_info" style="background-color: LightGoldenrodYellow; margin-top: 25px; display: flex; justify-content: center;">
                            <span>
                                <i class="fi-rs-user mr-10"></i>
                                <span class="text-muted font-lg">¡Tu pedido está listo para ser confirmado!</span>
                            </span>
                        </div>
                    <?php
                    } else {
                    ?>
                        <!-- PapayaWhip - Tomato -->
                        <div class="toggle_info" style="background-color: PapayaWhip; margin-top: 25px; display: flex; justify-content: center;">
                            <span>
                                <i class="fi-rs-user mr-10"></i>
                                <span class="text-muted font-lg">Si ya tienes una cuenta</span>
                                <a onclick="goToLogin(); return false;" data-bs-toggle="collapse" class="collapsed font-lg" aria-expanded="false"><strong>inicia sesión aquí!</strong></a>
                                <span class="text-muted font-lg">. Sino</span>
                                <a onclick="goToCreateAccount(); return false;" data-bs-toggle="collapse" class="collapsed font-lg" aria-expanded="false"> <strong>crea tu cuenta</strong> </a>
                                <span class="text-muted font-lg">para continuar con la compra...</span>
                            </span>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>

            <div class="row">

                <!-- Tabla del carrito -->
                <div class="col-lg-9">
                    <div class="table-responsive shopping-summery">

                        <?php
                        if (isset($_SESSION['SD_CART'])) {
                            // echo json_encode($_SESSION['SD_CART']);
                        ?>
                            <!-- Table ==> Productos que se encuentran en el carrito -->
                            <table class="table table-wishlist">
                                <thead>
                                    <tr class="main-heading">
                                        <th class="custome-checkbox start pl-30">
                                            <!-- <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                        <label class="form-check-label" for="exampleCheckbox11"></label> -->
                                        </th>
                                        <th scope="col" colspan="2">Producto</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col" class="end">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $dataArrayCombo = '';
                                    if (isset($_SESSION['SD_CART'])) {
                                        // echo json_encode($_SESSION['SD_CART'], true);
                                        foreach ($_SESSION['SD_CART'] as $dato) {
                                            // echo json_encode($dato);

                                            $dataArrayImgsProducto = '';
                                            $dataArrayImgsCombo = '';

                                            if (trim($dato['type']) == 'combo') {
                                                // $dataArrayImgsProducto = getAllImgsOfOneCombo(intval(trim($dato['numero'])));
                                                $dataArrayCombo = getOneComboOfCod(intval(trim($dato['numero'])));
                                                $dataArrayCombo = str_replace('[', '', $dataArrayCombo);
                                                $dataArrayCombo = str_replace(']', '', $dataArrayCombo);
                                                // echo getOneValueOfJsonData($dataArrayCombo, 'pretot');
                                                // foreach (json_decode($dataArrayCombo, true) as $dataCombo) {
                                            } else {
                                                // $dataArrayImgsProducto = getAllImgsOfOneProduct(intval(trim($dato['numero'])));
                                                $dataArrayImgsProducto = getFirstImgProductOfCod(intval(trim($dato['numero'])));
                                            }
                                    ?>

                                            <tr class="pt-30">
                                                <td class="custome-checkbox pl-30">
                                                    <!-- <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"></label> -->
                                                </td>
                                                <?php
                                                $urlImg = 'src/img/productos/default.jpg';

                                                # Region get first combo img
                                                if ($dataArrayCombo != '') {
                                                    $urlImgCombo = 'src/img/combos/';
                                                    for ($i = 0; $i < 10; $i++) {
                                                        if (file_exists($urlImgCombo . $dato['numero'] . '_' . $i . '.png')) {
                                                            $urlImg = $urlImgCombo . $dato['numero'] . '_' . $i . '.png';
                                                            break;
                                                        }
                                                    }
                                                }
                                                if ($dataArrayImgsProducto != '') {
                                                    // echo $dataArrayImgsProducto;
                                                    if (is_array(json_decode($dataArrayImgsProducto, true)) || is_object(json_decode($dataArrayImgsProducto, true))) {
                                                        foreach (json_decode($dataArrayImgsProducto, true) as $datoImg) {
                                                            // echo $dataArrayImgsProducto;
                                                            $urlLocal = 'src/img/productos/' . getOneValueOfJsonData($dataArrayImgsProducto, 'url');
                                                            if (!file_exists($urlLocal)) {
                                                                $urlImg = 'src/img/productos/default.jpg';
                                                            } else {
                                                                $urlImg = $urlLocal;
                                                            } // 'src/img/productos/' . trim($datoImg['url']);
                                                            break;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <td class="image product-thumbnail pt-40"><img src="<?php echo $urlImg; ?>" alt="#"></td>
                                                <td class="product-des product-name px-4">
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
                                                            <h6> Presentación: <span class="badge bg-primary"><?php echo trim($dato['pesopres']) . ' kg' ?></span></h6>
                                                        <?php
                                                        }
                                                        ?>
                                                        <a class="product-category" href="product-detail?td=p&c=<?php echo trim($dato['numero']); ?>">
                                                            <strong>
                                                                <?php echo 'Cod. ' . trim($dato['numero']); ?>
                                                            </strong>
                                                        </a>

                                                        <?php
                                                        $cantidadSolicitada = intval($dato['stoact']) - intval($dato['cantidad']);
                                                        if ($cantidadSolicitada < 0) {
                                                        ?>
                                                            <h6><span class="badge bg-warning">Stock insuficiente. Te contactaremos al confirmar el pedido.</span></h6>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <h6> Stock: <span class="badge bg-primary">Disponible</span></h6>
                                                        <?php
                                                        }
                                                        ?>

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
                                                                        echo number_format(trim(getOneValueOfJsonData($dataArrayCombo, 'bonifi'))) . ' %';
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

                                                <td class="price" data-title="Precio">
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
                                                                    if($dato['pesopres'] != 0){
                                                                        echo number_format(floatval(trim($dato['prefin'])) * floatval($dato['pesopres']), 2);
                                                                    }else{
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
                                                    <h4 class="text-brand">$<?php echo number_format(floatval(trim($dato['preciofinal'])), 2); ?></h4>
                                                </td>
                                                <td class="text-center detail-info" data-title="Cantidad">
                                                    <div class="detail-extralink mr-15">
                                                        <div class="detail-qty border radius">
                                                            <a onclick="lessCountProductInCart('<?php echo trim($dato['type']); ?>', <?php echo trim($dato['numero']); ?>, <?php echo trim($dato['idpresentacion']); ?>, <?php echo trim($dato['cantidad']); ?>); return false" class="qty-down">
                                                                <i class="fi-rs-angle-small-down"></i>
                                                            </a>
                                                            <span class="qty-val"><?php echo trim($dato['cantidad']); ?></span>
                                                            <a onclick="addCountProductInCart('<?php echo trim($dato['type']); ?>', <?php echo trim($dato['numero']); ?>, <?php echo trim($dato['idpresentacion']); ?>); return false" class="qty-up">
                                                                <i class="fi-rs-angle-small-up"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="price" data-title="Subtotal">
                                                    <h4 class="text-brand" style="text-align: center;">$<?php echo number_format(trim(floatval($dato['preciofinal']) * floatval($dato['cantidad'])), 2); ?></h4>
                                                </td>
                                                <td class="action text-center" data-title="Eliminar">
                                                    <a onclick="deleteOneProductInCart('<?php echo trim($dato['type']); ?>', <?php echo trim($dato['numero']); ?>, <?php echo trim($dato['idpresentacion']); ?>); return false;" class="text-body">
                                                        <i class="fi-rs-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                    <?php
                                        }
                                    }
                                    ?>

                                    <!-- <tr>
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                        <label class="form-check-label" for="exampleCheckbox2"></label>
                                    </td>
                                    <td class="image product-thumbnail"><img src="assets/imgs/shop/product-2-1.jpg" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">Blue Diamond Almonds Lightly Salted</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body">$3.2 </h4>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">1</span>
                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand">$3.2 </h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove"><a href="#" class="text-body"><i class="fi-rs-trash"></i></a></td>
                                </tr>

                                <tr>
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                        <label class="form-check-label" for="exampleCheckbox3"></label>
                                    </td>
                                    <td class="image product-thumbnail"><img src="assets/imgs/shop/product-3-1.jpg" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">Fresh Organic Mustard Leaves Bell Pepper</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body">$2.43 </h4>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">1</span>
                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand">$2.43 </h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove"><a href="#" class="text-body"><i class="fi-rs-trash"></i></a></td>
                                </tr> -->

                                </tbody>
                            </table>
                        <?php
                        } else {
                        ?>
                            <div class="toggle_info" style="background-color: LightCyan; margin-top: 25px; display: flex; justify-content: center;">
                                <span>
                                    <i class="fi-rs-info mr-10"></i>
                                    <span class="text-muted font-lg"><strong>No hay productos en el carrito...</strong></span>
                                    <a onclick="goToHome(); return false;" data-bs-toggle="collapse" class="collapsed font-lg" aria-expanded="false"><strong>Regresar al inicio!</strong></a>
                                    <!-- <span class="text-muted font-lg">. Sino</span>
                                    <a href="#loginform" data-bs-toggle="collapse" class="collapsed font-lg" aria-expanded="false"> <strong>crea tu cuenta</strong> </a>
                                    <span class="text-muted font-lg">para continuar con la compra...</span> -->

                                </span>
                            </div>
                        <?php
                        }
                        echo '<br>';
                        ?>

                    </div>
                    <div class="divider-2 mb-30"></div>

                    <!-- Cálculo de costo de envío y código de cupón de descuento-->
                    <!-- <div class="row mt-50">
                        <div class="col-lg-7">
                            <div class="calculate-shiping p-40 border-radius-15 border">
                                <h4 class="mb-10">Calculate Shipping</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Flat rate:</span><strong class="text-brand">5%</strong></p>
                                <form class="field_form shipping_calculator">
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="custom_select">
                                                <select class="form-control select-active w-100">
                                                    <option value="">United Kingdom</option>
                                                    <option value="AX">Aland Islands</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AQ">Antarctica</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="PW">Belau</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia</option>
                                                    <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BV">Bouvet Island</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="VG">British Virgin Islands</option>
                                                    <option value="BN">Brunei</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CG">Congo (Brazzaville)</option>
                                                    <option value="CD">Congo (Kinshasa)</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CW">CuraÇao</option>
                                                    <option value="CY">Cyprus</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands</option>
                                                    <option value="FO">Faroe Islands</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="GF">French Guiana</option>
                                                    <option value="PF">French Polynesia</option>
                                                    <option value="TF">French Southern Territories</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GP">Guadeloupe</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="GY">Guyana</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="HM">Heard Island and McDonald Islands</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="CI">Ivory Coast</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Laos</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macao S.A.R., China</option>
                                                    <option value="MK">Macedonia</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="YT">Mayotte</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia</option>
                                                    <option value="MD">Moldova</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="AN">Netherlands Antilles</option>
                                                    <option value="NC">New Caledonia</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="KP">North Korea</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PS">Palestinian Territory</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PN">Pitcairn</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="IE">Republic of Ireland</option>
                                                    <option value="RE">Reunion</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russia</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="ST">São Tomé and Príncipe</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="SH">Saint Helena</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="SX">Saint Martin (Dutch part)</option>
                                                    <option value="MF">Saint Martin (French part)</option>
                                                    <option value="PM">Saint Pierre and Miquelon</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="GS">South Georgia/Sandwich Islands</option>
                                                    <option value="KR">South Korea</option>
                                                    <option value="SS">South Sudan</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syria</option>
                                                    <option value="TW">Taiwan</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TL">Timor-Leste</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option value="GB">United Kingdom (UK)</option>
                                                    <option value="US">USA (US)</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VA">Vatican</option>
                                                    <option value="VE">Venezuela</option>
                                                    <option value="VN">Vietnam</option>
                                                    <option value="WF">Wallis and Futuna</option>
                                                    <option value="EH">Western Sahara</option>
                                                    <option value="WS">Western Samoa</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="State / Country" name="name" type="text">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="PostCode / ZIP" name="name" type="text">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="p-40">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                                <form action="#">
                                    <div class="d-flex justify-content-between">
                                        <input class="font-medium mr-15 coupon" name="Coupon" placeholder="Enter Your Coupon">
                                        <button class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div> -->

                </div>

                <!-- Resumen de costos del carrito -->
                <div class="col-lg-3">
                    <!-- <div class="border p-md-4 cart-totals ml-30"> -->
                    <div class="border p-md-4 cart-totals">
                        <div class="table-responsive">
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
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Descuento
                                                <h4 style="display: inline;"><span id="id-cart-porcentaje-descuento" class="badge bg-primary"></span></h4>
                                            </h6>
                                            <!-- <h4>Example heading <span class="badge bg-secondary">New</span></h4> -->

                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 id="id-cart-resumen-descuento" class="text-brand text-end text-info">$</h4>
                                        </td>
                                    </tr>

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

                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">TOTAL</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h3 id="id-cart-resumen-total" class="text-brand text-end">$</h3>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-action d-flex justify-content-center" style="padding-bottom: 20px;">
                            <a class="btn w-100" onclick="goToHome(); return false;"><i class="fi-rs-arrow-left mr-10"></i>Continuar Comprando</a>
                            <!-- <a class="btn  mr-10 mb-sm-15"><i class="fi-rs-refresh mr-10"></i>Update Cart</a> -->
                        </div>

                        <a onclick="goToCheckout(); return false;" class="btn mb-20 w-100">Confirmar Pedido<i class="fi-rs-sign-out ml-15"></i></a>
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
    <script src="js/view/cart.js"></script>

</body>

</html>