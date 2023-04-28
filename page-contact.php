<?php
session_start();
require_once('php/constants.php');
require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');

require_once('php/util/methods.php');

?>

<!DOCTYPE html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8" />

    <?php require_once('php/components/tittle-icon-page.php'); ?>

    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <!-- ############################################################# -->
    <!-- Para evitar que archivos css/js/imagenes se guarden en caché -->
    <!-- <?php //require_once('php/components/meta-head.php'); 
            ?> -->
    <!-- ############################################################# -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/main.css?v=4.0" />
    <!--leaflet map-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <!-- Styles Prop. -->
    <link rel="stylesheet" href="assets/css/modules/styles-maxi.css">
    <link rel="stylesheet" href="css/libs/sweetAlert.css">
    <link rel="stylesheet" href="css/disable-input-arrows.css">

    <style>
        .map-responsive {

            overflow: hidden;

            padding-bottom: 56.25%;

            position: relative;

            height: 0;

        }

        .map-responsive iframe {

            left: 0;

            top: 0;

            height: 100%;

            width: 100%;

            position: absolute;

        }
    </style>
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

    <main class="main pages">
        <!-- <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Contact
                </div>
            </div>
        </div> -->
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="row align-items-end mb-50">
                            <div class="col-lg-4 mb-lg-0 mb-md-5 mb-sm-5">
                                <h4 class="mb-20 text-brand">¿Cómo podemos ayudarte?</h4>
                                <h1 class="mb-30">Escribenos con tus sugerencias o dudas</h1>
                                <p class="mb-20"><?php echo getOneValueOfJsonData($dataArrayEmpres, 'descrip') ?></p>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <h5 class="mb-20">01. ¿Quiénes somos?</h5>
                                        <p><?php echo getOneValueOfJsonData($dataArrayEmpres, 'somos') ?></p>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <h5 class="mb-20">02. Nuestros inicios</h5>
                                        <p><?php echo getOneValueOfJsonData($dataArrayEmpres, 'inicios') ?></p>
                                    </div>
                                    <div class="col-lg-6 mb-lg-0 mb-4">
                                        <h5 class="mb-20 text-brand">03. Nuestra misión</h5>
                                        <p><?php echo getOneValueOfJsonData($dataArrayEmpres, 'mision') ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5 class="mb-20 text-brand">04. Nuestra visión</h5>
                                        <p><?php echo getOneValueOfJsonData($dataArrayEmpres, 'vision') ?></p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="contact-from-area padding-20-row-col">
                                        <!-- <h5 class="text-brand mb-10">Formulario de contacto</h5> -->
                                        <h2 class="mb-10">Nuestras sucursales</h2>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            <div class="row mb-60">
                                <?php
                                if ($dataArrayBranchesOffices != '' && str_contains($dataArrayBranchesOffices, 'ERROR_CODE')) {
                                    return;
                                } else {
                                    foreach (json_decode($dataArrayBranchesOffices, true) as $dato) {
                                ?>
                                        <div class="col-md-4 mb-4 mb-md-0">
                                            <h4 class="mb-15 text-brand"><?php echo 'Oficina: ' . $dato['nombre']; ?></h4>
                                            <?php echo 'Localidad: ' . $dato['localidad']; ?><br />
                                            <?php echo 'Domicilio: ' . $dato['domicilio']; ?><br />
                                            <abbr title="Número de teléfono">Tel.:</abbr> <?php echo $dato['tel']; ?><br />
                                            <abbr title="Número de whatsapp">Whatsapp:</abbr> <?php echo $dato['nro_whatsapp']; ?><br />
                                            <abbr title="Email de la empresa">Email: </abbr><?php echo $dato['email']; ?><br />
                                            <abbr title="Horario en que se encuentra abeirta la oficina">Horario: </abbr><?php echo $dato['horario']; ?><br />
                                            <a class="btn btn-sm font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up" href="<?php echo $dato['url_google_maps']; ?>" target="_blak"><i class="fi-rs-marker mr-5"></i>Ver mapa</a>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <!-- <div class="col-md-4 mb-4 mb-md-0">
                                            <h4 class="mb-15 text-brand">Office</h4>
                                                        205 North Michigan Avenue, Suite 810<br />
                                                        Chicago, 60601, USA<br />
                                                        <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                                                        <abbr title="Email">Email: </abbr>contact@Evara.com<br />
                                                        <a class="btn btn-sm font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i class="fi-rs-marker mr-5"></i>View map</a>
                                                    </div> -->
                                <!-- <div class="col-md-4 mb-4 mb-md-0">
                                                <h4 class="mb-15 text-brand">Studio</h4>
                                                205 North Michigan Avenue, Suite 810<br />
                                                Chicago, 60601, USA<br />
                                                <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                                                <abbr title="Email">Email: </abbr>contact@Evara.com<br />
                                                <a class="btn btn-sm font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i class="fi-rs-marker mr-5"></i>View map</a>
                                            </div>
                                            <div class="col-md-4">
                                                <h4 class="mb-15 text-brand">Shop</h4>
                                                205 North Michigan Avenue, Suite 810<br />
                                                Chicago, 60601, USA<br />
                                                <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                                                <abbr title="Email">Email: </abbr>contact@Evara.com<br />
                                                <a class="btn btn-sm font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i class="fi-rs-marker mr-5"></i>View map</a>
                                            </div> -->
                            </div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="contact-from-area padding-20-row-col">
                                        <h5 class="text-brand mb-10">Formulario de contacto</h5>
                                        <h2 class="mb-10">Envíanos tu consulta u opinión</h2>
                                        <p class="text-muted mb-30 font-sm">Su dirección de correo electrónico no será publicada. Los campos obligatorios están marcados *</p>

                                        <!-- <form class="contact-form-style mt-30" id="contact-form" action="#" method="post"> -->
                                        <form class="contact-form-style mt-30" id="contact-form">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="name" placeholder="Nombre y apellido" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="email" placeholder="Email" type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="telephone" placeholder="Teléfono de contacto" type="tel" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="subject" placeholder="Asunto" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="textarea-style mb-30">
                                                        <textarea name="message" placeholder="Mensaje"></textarea>
                                                    </div>
                                                    <button class="submit submit-auto-width" type="submit">Enviar</button>
                                                </div>
                                            </div>
                                        </form>

                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                                <div class="col-lg-4 pl-50 d-lg-block d-none">
                                    <img class="border-radius-15 mt-50" src="src/img/contact-2.png" alt="" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="assets/js/plugins/leaflet.js"></script>
    <!-- Template  JS -->
    <script src="./assets/js/main.js?v=4.0"></script>
    <script src="./assets/js/shop.js?v=4.0"></script>

    <!-- JS Propios -->
    <script src="js/constants.js"></script>
    <script src="js/middleware/sucursales.js"></script>
    <script src="js/view/index.js"></script>

    <?php require_once('php/libs/sweet-alert.php'); ?>
    <script src="js/middleware/footer.js"></script>
    <script src="js/components/header.js"></script>
</body>

</html>