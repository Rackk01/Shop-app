<?php 
getRectangularUrlLogo();
?>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">

        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index" onclick="return false;"><img src="<?php echo $_SESSION['rectangularLogo'];?>" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>

        <div class="mobile-header-content-area">
            <h5 id="id-email-account-header-mobile" class="d-flex justify-content-center"></h5>
        </div>

        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <!-- <form action="#"> -->
                <form>
                    <input id="id-input-text-search-mobile" type="text" placeholder="Buscar producto…" />
                    <button id='id-btn-search-mobile'><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">

                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="">
                            <a href="index">Home</a>
                            <!-- <ul class="dropdown">
                                    <li><a href="index.html">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-3.html">Home 3</a></li>
                                    <li><a href="index-4.html">Home 4</a></li>
                                    <li><a href="index-5.html">Home 5</a></li>
                                    <li><a href="index-6.html">Home 6</a></li>
                                </ul> -->
                        </li>

                        <?php if (isset($amountOfStatesOfProducts) && $amountOfStatesOfProducts > 0) {
                            $flagCountProductSpecials = getFlagCountProductSpecials();
                        ?>
                            <li class="menu-item-has-children">
                                <a href="">Especiales</a>
                                <ul class="dropdown">
                                    <?php
                                    foreach (json_decode($dataArrayStatesOfProducts, true) as $datoState) {
                                        if ($datoState['id_estado'] != 1 && $datoState['cantidad'] != 0) {
                                    ?>
                                            <li>
                                                <a href="shop-specials?si=<?php echo $datoState['id_estado']; ?>&spde= <?php echo trim($datoState['descripcion']); ?>">
                                                    <?php
                                                    echo $datoState['descripcion'];
                                                    if ($flagCountProductSpecials == 'true') {
                                                        echo ' (' . $datoState['cantidad'] . ')';
                                                    }
                                                    ?>
                                                </a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <!-- <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                        <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                        <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                        <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                        <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Single Product</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Product – Right Sidebar</a></li>
                                                <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                                <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                                <li><a href="shop-product-vendor.html">Product – Vendor Infor</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="shop-filter.html">Shop – Filter</a></li>
                                        <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                        <li><a href="shop-cart.html">Shop – Cart</a></li>
                                        <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                        <li><a href="shop-compare.html">Shop – Compare</a></li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Shop Invoice</a>
                                            <ul class="dropdown">
                                                <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                                <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                                <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                                <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                                <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                                <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                            </ul>
                                        </li> -->
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <li>
                            <a href="#" onclick="return false;">Contacto</a>
                        </li>

                        <!-- <li class="menu-item-has-children">
                                <a href="#">Vendors</a>
                                <ul class="dropdown">
                                    <li><a href="vendors-grid.html">Vendors Grid</a></li>
                                    <li><a href="vendors-list.html">Vendors List</a></li>
                                    <li><a href="vendor-details-1.html">Vendor Details 01</a></li>
                                    <li><a href="vendor-details-2.html">Vendor Details 02</a></li>
                                    <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                    <li><a href="vendor-guide.html">Vendor Guide</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Mega menu</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children">
                                        <a href="#">Women's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Dresses</a></li>
                                            <li><a href="#">Blouses & Shirts</a></li>
                                            <li><a href="#">Hoodies & Sweatshirts</a></li>
                                            <li><a href="#">Women's Sets</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Men's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Jackets</a></li>
                                            <li><a href="#">Casual Faux Leather</a></li>
                                            <li><a href="#">Genuine Leather</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Technology</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Gaming Laptops</a></li>
                                            <li><a href="#">Ultraslim Laptops</a></li>
                                            <li><a href="#">Tablets</a></li>
                                            <li><a href="#">Laptop Accessories</a></li>
                                            <li><a href="#">Tablet Accessories</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="blog-category-fullwidth.html">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                    <li><a href="blog-category-list.html">Blog Category List</a></li>
                                    <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                    <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product Layout</a>
                                        <ul class="dropdown">
                                            <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                            <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                            <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="page-about.html">About Us</a></li>
                                    <li><a href="page-contact.html">Contact</a></li>
                                    <li><a href="page-account.html">My Account</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                    <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="page-terms.html">Terms of Service</a></li>
                                    <li><a href="page-404.html">404 Page</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </li> -->
                    </ul>
                </nav>
            </div>

            <?php
            if ($amountOfBranchesOffices != 0 && !str_contains($dataArrayBranchesOffices, 'ERROR_CODE')) {
                foreach (json_decode($dataArrayBranchesOffices, true) as $dato) {
            ?>
                    <!-- <div class="logo mb-30">
                            <a href="index" class="mb-15"><img src="src/img/empresa/logoRectangularBrinco.png" alt="logo" /></a>
                            <p class="font-lg text-heading text-brand"><strong><?php echo 'Sucursal ' . strtoupper($dato['nombre']); ?></strong></p>
                        </div> -->

                    <div class="mobile-header-info-wrap">
                        <p class="font-lg text-heading text-brand"><strong><?php echo 'Sucursal ' . strtoupper($dato['nombre']); ?></strong></p>

                        <div class="single-mobile-header-info">
                            <a href="https://api.whatsapp.com/send?phone='.<?php echo ($dato['nro_whatsapp']); ?>.'" target="_blank"><i class="fi-rs-marker"></i>
                                <strong></strong><span><?php echo $dato['domicilio']; ?></span>
                            </a>
                        </div>

                        <!-- <div class="single-mobile-header-info">
                                <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                            </div> -->

                        <div class="single-mobile-header-info">
                            <a onclick="return null;"><i class="fi-rs-user"></i>
                                <strong></strong><span><?php echo $dato['email']; ?></span>
                            </a>
                        </div>

                        <div class="single-mobile-header-info">
                            <a onclick="return null;"><i class="fi-rs-headphones"></i><?php echo $dato['tel']; ?></a>
                        </div>

                    </div>
            <?php
                }
            }
            ?>

            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Siguenos</h6>
                <!-- <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a> -->

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
            </div>
            <!-- <p class="font-sm">Hasta un 15% de descuento en tu primera suscripción</p> -->
            <!-- <p class="font-sm">Síguenos para enterarte de todas nuestras promociones</p> -->
        </div>

        <div class="site-copyright">&copy; 2022 <strong class="text-brand">HUELLAS</strong> | Ecommerce App | All rights reserved</div>
        <!-- <p class="font-sm mb-0"></p> -->
    </div>
</div>