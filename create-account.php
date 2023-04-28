<?php
session_start();
require_once('php/constants.php');

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/modal-init.php');

require_once('php/util/methods.php');

// echo $dataDescuentoGeneral;
// echo '<br>';
// echo $dataArraySliders;

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

    <?php require_once('php/components/header.php'); ?>

    <!-- ########################################################################################################## -->
    <!-- Mobile section -->
    <?php require_once('php/components/header-mobile.php'); ?>
    <!-- ########################################################################################################## -->

    <main class="main pages">
        <!-- <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div> -->
        <!-- <div class="page-content pt-150 pb-150"> -->
        <div class="page-content pt-50 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                            <div class="col-lg-7 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Crear cuenta</h1>
                                            <p class="mb-30">¿Ya tienes una cuenta? <a href="login"> <strong>Login</strong></a></p>
                                        </div>

                                        <!-- Login con redes sociales -->
                                        <!-- <div class="card-login mt-20">
                                            <a href="#" class="social-login facebook-login">
                                                <img src="assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                                <span>Continue with Facebook</span>
                                            </a>
                                            <a href="#" class="social-login google-login">
                                                <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                                                <span>Continue with Google</span>
                                            </a>
                                            <h6>Sino puedes completar tus datos</h6>
                                            <a href="#" class="social-login apple-login">
                                                <img src="assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                                <span>Continue with Apple</span>
                                            </a>
                                        </div> -->

                                        <form id="id-form-register-user">
                                            <div class="form-group">
                                                <label for="id-in-name">Nombre y apellido</label>
                                                <input id="id-in-name" type="text" class="form-control" required="" name="username" placeholder="Ingrese aquí nombre y apellido" />
                                            </div>
                                            <!-- <div class="form-group">
                                                <input type="text" required="" name="userlastname" placeholder="Apellido" />
                                            </div> -->
                                            <div class="form-group">
                                            <label for="id-in-email">Email</label>
                                                <input id="id-in-email" type="email" class="form-control" required="" name="email" placeholder="Ingrese aquí email" />
                                            </div>
                                            <div class="form-group">
                                            <label for="id-in-dnicuit">DNI/CUIT</label>
                                                <input id="id-in-dnicuit" required="" type="number" name="dnicuit" pattern=".{8,11}" placeholder="Ingrese aquí Dni/Cuit" />
                                                <h6 style="font-size: 14px;" class="text-warning">Ejemplos del formato: DNI 33312639 - CUIT 20333126391</h6>
                                            </div>
                                            <div class="form-group">
                                            <label for="id-in-tel">Teléfono</label>
                                                <input id="id-in-tel" required="" type="number" name="telef" placeholder="Ingrese aquí teléfono | Ej. 0351152274469" />
                                                <h6 style="font-size: 14px;" class="text-warning">Ejemplos del formato: 0351152274469</h6>
                                            </div>
                                            <div class="form-group">
                                            <label for="id-in-pass">Contraseña</label>
                                                <input id="id-in-pass" required="" type="password" name="password" minlength="6" placeholder="Ingrese aquí la contraseña" />
                                                <h6 style="font-size: 14px;" class="text-warning">Contener al menos: Una mayúscula, minúscula y número. Mínimo de 6 caracteres.</h6>
                                            </div>
                                            <div class="form-group">
                                            <label for="id-in-retypepass">Volver a ingresar la contraseña</label>
                                                <input id="id-in-retypepass" required="" type="password" name="password" minlength="6" placeholder="Reingrese aquí la contraseña" />
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

                                            <!-- <div class="payment_option mb-50">
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="" />
                                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">I am a customer</label>
                                                </div>
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="" />
                                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">I am a vendor</label>
                                                </div>
                                            </div> -->

                                            <!-- <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div> -->

                                            <div class="form-group mb-30">
                                                <button type="submit" style="width: 100%;" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Enviar &amp; Registrarse</button>
                                            </div>
                                            <p class="font-xs text-muted">
                                                <strong>Nota:</strong>
                                                Sus datos personales se utilizarán para respaldar su experiencia en este sitio web y para administrar
                                                el acceso a su cuenta. Por cualquier duda puedes consultarnos en nuestra sección de contacto. Estamos a tu disposición.
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 col-md-4 d-lg-block"> -->
                            <!-- <div class="col-lg-6 col-md-6 d-lg-block">
                                <div class="card-login mt-20">
                                    <a href="#" class="social-login facebook-login">
                                        <img src="assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                        <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                                        <span>Continue with Google</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                        <img src="assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                        <span>Continue with Apple</span>
                                    </a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once 'php/components/wp-floating.php'; ?>
    </main>

    <?php require_once('php/components/footer.php'); ?>

    <!-- Preloader Start -->
    <!-- <?php //require_once('php/components/preloader-start.php'); ?> -->

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
    <script src="js/view/register-user.js"></script>
</body>

</html>