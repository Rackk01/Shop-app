<?php 
$newsletter = getNewsletterImg();
?>
<footer class="main">
    <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <div class="position-relative newsletter-inner" style="background: url(src/img/banner/banner-bg-newsletter.png) no-repeat center;"> -->
                    <div class="position-relative newsletter-inner" style="background: center / cover no-repeat url(<?php echo $newsletter;?>);">
                        <div class="newsletter-content">
                            <h2 class="mb-20">
                                Quedate en casa <br />
                                y obtené lo que necesitás
                            </h2>
                            <p class="mb-45">Comenzá tu día con
                                <span class="text-brand">
                                    <strong><?php echo getOneValueOfJsonData($dataArrayEmpres, 'nombre') ?>
                                    </strong>
                                </span>
                            </p>
                            <form id="id-form-newsletter" class="form-subcriber d-flex">
                                <input id="id-email-newsletter" type="email" placeholder="Tu email" />
                                <button id="idBtnNewsletter" class="btn">Subscribete</button>
                            </form>
                        </div>
                        <!-- <img src="src/img/banner/banner-img-right-newsletter.png" alt="newsletter" /> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured section-padding">
        <div class="container">
            <div class="row d-flex justify-content-between">

                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0" style="height: 140px;">
                        <div class="banner-icon">
                            <img src="assets/imgs/theme/icons/icon-1.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Los mejores precios</h3>
                            <p>Ofertas semanales</p>
                        </div>
                    </div>
                </div>

                <?php
                if (number_format($_SESSION['SD_COSTO_ENVIO_PEDIDO']) > 0) {
                ?>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s" style="height: 140px;">
                            <div class="banner-icon">
                                <img src="assets/imgs/theme/icons/icon-2.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Envío gratis en</h3>
                                <p>compras > $ <?php echo number_format($_SESSION['SD_COSTO_ENVIO_PEDIDO']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s" style="height: 140px;">
                        <div class="banner-icon">
                            <img src="assets/imgs/theme/icons/icon-3.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Combos especiales</h3>
                            <p>Todas las semanas</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s" style="height: 140px;">
                        <div class="banner-icon">
                            <img src="assets/imgs/theme/icons/icon-4.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Asesoramiento</h3>
                            <p>Preguntá tus dudas</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s" style="height: 140px;">
                        <div class="banner-icon">
                            <img src="assets/imgs/theme/icons/icon-6.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Envío seguro</h3>
                            <p>Envaces de calidad</p>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                            <div class="banner-icon">
                                <img src="assets/imgs/theme/icons/icon-6.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Safe delivery</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div> -->
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">

                <?php
                $telefonoEmpresPrincipal = 0;
                $primerRegistroEmpres = true;
                if ($amountOfBranchesOffices != 0 && !str_contains($dataArrayBranchesOffices, 'ERROR_CODE')) {
                    foreach (json_decode($dataArrayBranchesOffices, true) as $dato) {
                ?>
                        <div class="col">
                            <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                                <div class="logo mb-30">
                                    <a href="index" class="mb-15"><img src="src/img/empresa/logoRectangularBrinco.png" alt="logo" /></a>
                                    <p class="font-lg text-heading text-brand"><strong><?php echo 'Sucursal ' . strtoupper($dato['nombre']); ?></strong></p>
                                    <!-- <span class="text-brand"> Mart</span> -->
                                </div>
                                <ul class="contact-infor">
                                    <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" />
                                        <strong>Dirección: </strong><span><?php echo $dato['domicilio']; ?></span>
                                    </li>
                                    <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" />
                                        <strong>Llamanos: </strong><span>
                                            <?php
                                            if ($primerRegistroEmpres) {
                                                $primerRegistroEmpres = false;
                                                $telefonoEmpresPrincipal = trim($dato['tel']);
                                            }
                                            echo $dato['tel'];
                                            ?>
                                        </span>
                                    </li>
                                    <li><img src="assets/imgs/theme/icons/icon-email-2.svg" alt="" />
                                        <strong>Email: </strong><span><?php echo $dato['email']; ?></span>
                                    </li>

                                    <li><img src="assets/imgs/theme/icons/icon-clock.svg" alt="" />
                                        <strong>Horario: </strong><span><?php echo $dato['horario']; ?></span>
                                    </li>

                                    <!-- <li><img src="assets/imgs/theme/icons/icon-whatsapp.svg" alt="" />
                                            <strong>WhatsApp: </strong><span><?php echo $dato['nro_whatsapp']; ?></span>
                                        </li> -->

                                    <li>
                                        <a href="https://api.whatsapp.com/send?phone='.<?php echo ($dato['nro_whatsapp']); ?>.'" target="_blank" style="text-decoration:none; font-weight: bold;">
                                            <!-- <i class="fab fa-whatsapp" aria-hidden="true"></i> -->
                                            WhatsApp
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo ($dato['url_google_maps']); ?>" target="_blank" style="text-decoration:none; font-weight: bold;"><i class="fas fa-map-marked-alt"></i> Google Maps</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <!-- <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s>
                        <h4 class=" widget-title">Company</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Support Center</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div> -->

                <!-- ACCOUNT AND CORPORATE -->
                <!-- <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">Sign In</a></li>
                        <li><a href="#">View Cart</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Track My Order</a></li>
                        <li><a href="#">Help Ticket</a></li>
                        <li><a href="#">Shipping Details</a></li>
                        <li><a href="#">Compare products</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <h4 class="widget-title">Corporate</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">Become a Vendor</a></li>
                        <li><a href="#">Affiliate Program</a></li>
                        <li><a href="#">Farm Business</a></li>
                        <li><a href="#">Farm Careers</a></li>
                        <li><a href="#">Our Suppliers</a></li>
                        <li><a href="#">Accessibility</a></li>
                        <li><a href="#">Promotions</a></li>
                    </ul>
                </div> -->

                <!-- <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <h4 class="widget-title">Popular</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Milk & Flavoured Milk</a></li>
                            <li><a href="#">Butter and Margarine</a></li>
                            <li><a href="#">Eggs Substitutes</a></li>
                            <li><a href="#">Marmalades</a></li>
                            <li><a href="#">Sour Cream and Dips</a></li>
                            <li><a href="#">Tea & Kombucha</a></li>
                            <li><a href="#">Cheese</a></li>
                        </ul>
                    </div> -->

                <div class="footer-link-widget widget-install-app col wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                    <!-- <h4 class="widget-title">Install App</h4>
                    <p class="">From App Store or Google Play</p>
                    <div class="download-app">
                        <a href="#" class="hover-up mb-sm-2 mb-lg-0"><img class="active" src="assets/imgs/theme/app-store.jpg" alt="" /></a>
                        <a href="#" class="hover-up mb-sm-2"><img src="assets/imgs/theme/google-play.jpg" alt="" /></a>
                    </div> -->
                    <p class="mb-20">Realizá tus pagos de forma segura</p>
                    <img class="" src="assets/imgs/theme/payment-method2.png" alt="" />
                </div>
            </div>
    </section>

    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; 2022, <strong class="text-brand">Huellas</strong> - Ecommerce App <br />All rights reserved</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                <div class="hotline d-lg-inline-flex mr-30">
                    <img src="assets/imgs/theme/icons/phone-call.svg" alt="hotline" />
                    <p><?php echo $telefonoEmpresPrincipal; ?><span>8:00 - 13:00 | 16:00 - 20:00</span></p>
                </div>
                <!-- <div class="hotline d-lg-inline-flex">
                        <img src="assets/imgs/theme/icons/phone-call.svg" alt="hotline" />
                        <p>1900 - 8888<span>24/7 Support Center</span></p>
                    </div> -->
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Siguenos</h6>

                    <?php
                    $urlFacebookLoc = (getUrlFace());
                    $urlTwitterLoc = (getUrlTwi());
                    $urlInstagramLoc = (getUrlInsta());
                    $urlYoutubeLoc = (getUrlYout());

                    echo $urlYoutubeLoc;

                    if (trim($urlFacebookLoc) != '') {
                    ?>
                        <a href="<?php echo $urlFacebookLoc; ?>" target="_blank"><img src="assets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                    <?php
                    }

                    if (trim($urlTwitterLoc) != '') {
                    ?>
                        <a href="<?php echo $urlTwitterLoc; ?>" target="_blank"><img src="assets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                    <?php
                    }

                    if (trim($urlInstagramLoc) != '') {
                    ?>
                        <a href="<?php echo $urlInstagramLoc; ?>" target="_blank"><img src="assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                    <?php
                    }

                    if (trim($urlYoutubeLoc) != '') {
                    ?>
                        <a href="<?php echo $urlYoutubeLoc; ?>" target="_blank"><img src="assets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
                    <?php
                    }
                    ?>
                    <!-- <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a> -->
                    <!-- <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a> -->
                    <!-- <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a> -->
                    <!-- <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a> -->
                </div>
                <!-- <p class="font-sm">Hasta un 15% de descuento en tu primera suscripción</p> -->
                <p class="font-sm">Síguenos para enterarte de todas nuestras promociones</p>
            </div>
        </div>
    </div>


    <?php
    if ($dataDescuentoGeneral == '' || str_contains($dataDescuentoGeneral, 'ERROR_CODE') || intval($dataDescuentoGeneral) < 1) {
        return;
    } else {
        require_once('php/components/discount-floating.php');
    }
    ?>
</footer>