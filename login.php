<?php
session_start();
require_once('php/constants.php');

if (isset($_SESSION["SD_CLIENTE_WEB_LOGUEADO"])) {
    header('Location: ' . URL_APP . 'data-account');
    die();
    return;
}

require_once('php/constants.php');

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/modal-init.php');

require_once('php/util/methods.php');

// echo getAllCategories();
// return;
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
    <!--End header-->

    <main class="main pages">
        <!-- <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Login
                    <span></span> Login
                </div>
            </div>
        </div> -->

        <div class="page-content pt-50 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                            <!-- <div class="col-lg-6 pr-30 d-none d-lg-block">
                                    <img class="border-radius-15" src="assets/imgs/page/login-1.png" alt="" />
                                </div> -->
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Iniciar sesión</h1>
                                            <p class="mb-30">Todavía no tenés una cuenta? <a href="create-account"><strong>Creala aquí</strong></a></p>
                                        </div>
                                        <form id="id-form-login" method="post">
                                            <div class="form-group">
                                            <label for="id-input-email">Email</label>
                                                <input type="email" required="" id="id-input-email" name="email" placeholder="Ingrse aquí su email *" />
                                            </div>
                                            <div class="form-group">
                                            <label for="id-input-password">Cotraseña</label>
                                                <input required="" id="id-input-password" type="password" name="password" placeholder="Ingrse aquí su contraseña *" />
                                            </div>
                                            <!-- <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <input type="text" required="" name="email" placeholder="Security code *" />
                                                </div>
                                                <span class="security-code">
                                                    <b class="text-new">8</b>
                                                    <b class="text-hot">6</b>
                                                    <b class="text-sale">7</b>
                                                    <b class="text-best">5</b>
                                                </span>
                                            </div> -->
                                            <div class="login_footer form-group mb-50">
                                                <!-- <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Recordar cuenta en esta pc</span></label>
                                                    </div>
                                                </div> -->
                                                <a class="" href="recover-password" style="color: DarkSalmon;"><strong>¿Olvidaste tu contraseña?</strong></a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login" style="width: 100%;">Iniciar sesión</button>

                                                <!-- Login with Google -->
                                                <!-- <div class="col s12 m6 offset-m3 center-align" style="padding-top: 10px;">
                                                    <a class="oauth-container btn darken-4 white black-text" href="/users/google-oauth/" style="text-transform:none; width: 100%;">
                                                        <div class="left">
                                                            <img width="20px" style="margin-top:7px; margin-right:8px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                                                        </div>
                                                        Iniciar sesión con Google
                                                    </a>
                                                </div> -->

                                                <!-- <div class="card-login mt-20">
                                                    <a href="#" class="social-login google-login">
                                                        <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                                                        <span>Continue with Google</span>
                                                    </a>
                                                </div> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="js/view/login.js"></script>
</body>

</html>