<?php
session_start();
require_once('php/constants.php');
require_once('php/util/methods.php');

if ($_SESSION["SD_ERROR"] == '') {
    header('Location: ' . URL_APP);
    die();
    return;
}

// echo $_SESSION["SD_ERROR"];
// return;

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/modal-init.php');

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
	<!-- <?php //require_once('php/components/meta-head.php'); ?> -->
	<!-- ############################################################# -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/main.css?v=4.0" />

    <!-- Styles Prop. -->
    <link rel="stylesheet" href="assets/css/modules/styles-maxi.css">
    <link rel="stylesheet" href="css/libs/sweetAlert.css">
    <link rel="stylesheet" href="css/disable-input-arrows.css">

</head>

<body>
    <!-- Preloader Start -->
    <!-- <?php //require_once('php/components/preloader-start.php'); ?> -->

    <?php require_once('php/components/header.php'); ?>

    <!-- ########################################################################################################## -->
    <!-- Mobile section -->
    <?php require_once('php/components/header-mobile.php'); ?>
    <!-- ########################################################################################################## -->

    <main class="main page-404">
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">
                        <p class="mb-20"><img src="assets/imgs/page/page-404.png" alt="" class="hover-up" /></p>
                        <h1 class="display-2 mb-30"><?php echo getOneValueOfJsonData($_SESSION["SD_ERROR"], 'tit'); ?></h1>
                        <p class="font-lg text-grey-700 mb-30">
                            <?php echo getOneValueOfJsonData($_SESSION["SD_ERROR"], 'msj'); ?>.<br />
                            <!-- Link <a href="index.html"> <span> HOME</span></a> -->
                            <!-- or <a href="page-contact.html"><span>Contact us</span></a> about the problem -->
                        </p>
                        <!-- <div class="search-form">
                            <form action="#">
                                <input type="text" placeholder="Search…" />
                                <button type="submit"><i class="fi-rs-search"></i></button>
                            </form>
                        </div> -->
                        <a class="btn btn-default submit-auto-width font-xs hover-up mt-30" href="<?php echo URL_APP; ?>"><i class="fi-rs-home mr-5"></i> Página de inicio</a>
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
</body>

</html>