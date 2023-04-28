<?php
session_start();

require_once('php/constants.php');

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/modal-init.php');

require_once('php/util/methods.php');

require_once('php/middleware/productos.php');
require_once('php/middleware/combo-producto.php');

#region Datos paginación ####################################################################################################
$limitProductoForPage = 10;
$pagActual = 1;
if (isset($_SESSION['SD_NUM_PAGE_INDEX'])) {
    $pagActual = intval($_SESSION['SD_NUM_PAGE_INDEX']);
    $_SESSION['SD_NUM_PAGE_INDEX'] = 1;
}
#endregion ####################################################################################################

$amountTotalPages = 0;
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
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css?v=4.0" />

    <!-- Styles Prop. -->
    <link rel="stylesheet" href="assets/css/modules/styles-maxi.css">
    <link rel="stylesheet" href="css/libs/sweetAlert.css">
    <link rel="stylesheet" href="css/disable-input-arrows.css">
</head>

<body>

    <!-- Preloader Start -->
    <!-- <?php //require_once('php/components/preloader-start.php'); 
            ?> -->

    <!-- Initial Modal -->
    <?php require_once('php/components/index/modal-init.php'); ?>

    <!-- Quick view -->
    <!-- <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="assets/imgs/shop/product-16-2.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="assets/imgs/shop/product-16-1.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="assets/imgs/shop/product-16-3.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="assets/imgs/shop/product-16-4.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="assets/imgs/shop/product-16-5.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="assets/imgs/shop/product-16-6.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="assets/imgs/shop/product-16-7.jpg" alt="product image" />
                                    </figure>
                                </div>
                                <div class="slider-nav-thumbnails">
                                    <div><img src="assets/imgs/shop/thumbnail-3.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-4.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-5.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-6.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-7.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-8.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-9.jpg" alt="product image" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <span class="stock-status out-stock"> Sale Off </span>
                                <h3 class="title-detail"><a href="#" class="text-heading">Seeds of Change Organic Quinoa, Brown</a></h3>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">$38</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">26% Off</span>
                                            <span class="old-price font-md ml-15">$52</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <span class="qty-val">1</span>
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                                <div class="font-xs">
                                    <ul>
                                        <li class="mb-5">Vendor: <span class="text-brand"></span></li>
                                        <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2021</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <?php require_once('php/components/header.php'); ?>

    <!-- ########################################################################################################## -->
    <!-- Mobile section -->
    <?php require_once('php/components/header-mobile.php'); ?>
    <!-- ########################################################################################################## -->

    <main class="main">

        <!-- #################################################################################################### -->
        <!-- Sliders -->
        <section class="home-slider position-relative mb-30">
            <!-- <div class="container" style="max-width: 100%;"> -->
            <div class="" style="max-width: 100%;">
                <div class="home-slide-cover mt-30">
                    <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                        <?php
                        if ($dataArraySliders != '' && str_contains($dataArraySliders, 'ERROR_CODE')) {
                            return;
                        } else {
                            foreach (json_decode($dataArraySliders, true) as $dato) {
                        ?>

                                <div class="single-hero-slider single-animation-wrap" id="id-single-hero-slider" style="background-image: url(<?php echo trim($dato['url_img']); ?>); background-repeat: no-repeat; background-size: contain;">
                                    <div class="slider-content">
                                        <h1 class="display-2 mb-40">
                                            <?php
                                            echo cortarPorCantidadDePalaras(trim($dato['titulo']), 4)[0];
                                            echo '<br>';
                                            echo cortarPorCantidadDePalaras(trim($dato['titulo']), 4)[1];
                                            ?>
                                        </h1>
                                        <p class="mb-65"><?php echo trim($dato['subtitulo']); ?></p>
                                        <form class="d-flex">
                                            <!-- <input type="email" placeholder="Your emaill address" />
                                            <button class="btn hover-up">VER PRODUCTO <i class="fi-rs-arrow-right"></i></button> -->
                                            <?php
                                            if (trim($dato['linkprod']) != '') {
                                            ?>
                                                <a href="<?php echo trim($dato['linkprod']); ?>" class="btn hover-up">VER AHORA <i class="fi-rs-arrow-right"></i></a>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>

                        <!-- <div class="single-hero-slider single-animation-wrap" style="background-image: url(assets/imgs/slider/slider-2.png)">
                            <div class="slider-content">
                                <h1 class="display-2 mb-40">
                                    Fresh Vegetables<br />
                                    Big discount
                                </h1>
                                <p class="mb-65">Save up to 50% off on your first order</p>
                                <form class="form-subcriber d-flex">
                                    <input type="email" placeholder="Your emaill address" />
                                    <button class="btn" type="submit">Subscribe</button>
                                </form>
                            </div>
                        </div> -->

                    </div>
                    <div class="slider-arrow hero-slider-1-arrow"></div>
                </div>
            </div>
        </section>
        <!--End hero slider-->

        <!-- Sliders 2 -->
        <!-- <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">

                <?php
                // $contadorLocal = 0;
                // if ($dataArraySliders != '' && str_contains($dataArraySliders, 'ERROR_CODE')) {
                //     return;
                // } else {
                //     foreach (json_decode($dataArraySliders, true) as $dato) {
                //         if ($contadorLocal == 0) {
                // 
                ?>
                //             <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $contadorLocal; ?>" class="active" aria-current="true" aria-label="Slide <?php echo $contadorLocal; ?>"></button>
                //         <?php
                            //         } else {
                            //         
                            ?>
                //             <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $contadorLocal; ?>" aria-label="Slide <?php echo $contadorLocal; ?>"></button>
                // <?php
                    //         }
                    //         $contadorLocal++;
                    //     }
                    // }
                    ?>

            </div>
            <div class="carousel-inner">

                <?php
                // if ($dataArraySliders != '' && str_contains($dataArraySliders, 'ERROR_CODE')) {
                //     return;
                // } else {
                //     foreach (json_decode($dataArraySliders, true) as $dato) {
                // 
                ?>
                //         <div class="carousel-item active">
                //             <img src="<?php echo trim($dato['url_img']); ?>" class="d-block w-100" alt="...">
                //             <div class="carousel-caption d-none d-md-block">
                //             </div>
                //         </div>
                // <?php
                    //     }
                    // }
                    ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> -->
        <!-- End Slider 2 -->
        <!-- #################################################################################################### -->

        <section class="popular-categories section-padding">
            <div class="container wow animate__animated animate__fadeIn">
                <div class="section-title">
                    <div class="title">
                        <!-- <h3>Featured Categories</h3> -->
                        <h3>Categorías</h3>
                        <!-- <ul class="list-inline nav nav-tabs links">
                            <li class="list-inline-item nav-item"><a class="nav-link" href="shop-grid-right.html">Cake & Milk</a></li>
                            <li class="list-inline-item nav-item"><a class="nav-link" href="shop-grid-right.html">Coffes & Teas</a></li>
                            <li class="list-inline-item nav-item"><a class="nav-link active" href="shop-grid-right.html">Pet Foods</a></li>
                            <li class="list-inline-item nav-item"><a class="nav-link" href="shop-grid-right.html">Vegetables</a></li>
                        </ul> -->
                    </div>
                    <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
                </div>
                <div class="carausel-10-columns-cover position-relative">
                    <div class="carausel-10-columns" id="carausel-10-columns">

                        <?php
                        if ($dataArrayCategories != '' && !str_contains($dataArrayCategories, 'ERROR_CODE')) {
                            foreach (json_decode($dataArrayCategories, true) as $dato) {
                        ?>
                                <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s" style="min-width: 115px;">
                                    <figure class="img-hover-scale overflow-hidden">
                                        <a href="shop?ci=<?php echo $dato['rubro']; ?>&cc=<?php echo trim($dato['concepto']); ?>">
                                            <img src="assets/imgs/theme/icons/<?php echo $dato['urlimg']; ?>" alt="" />
                                        </a>
                                    </figure>
                                    <h6 style="font-size: 13px;">
                                        <a href="shop?ci=<?php echo $dato['rubro']; ?>&cc=<?php echo  trim($dato['concepto']); ?>">
                                            <?php echo ucfirst(strtolower(trim($dato['concepto']))); ?>
                                        </a>
                                    </h6>
                                    <span>
                                        <?php echo $dato['cantidad']; ?> items
                                    </span>
                                </div>

                                <!-- <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                    <figure class="img-hover-scale overflow-hidden">
                                        <a href="shop?ci=<?php //echo $dato['rubro']; 
                                                            ?>&cc=<?php //echo trim($dato['concepto']); 
                                                                    ?>">
                                            <img src="src/img/category/<?php echo $dato['urlimg']; ?>" alt="" />
                                        </a>
                                    </figure>
                                    <h6 style="font-size: 13px;">
                                        <a href="shop?ci=<?php //echo $dato['rubro']; 
                                                            ?>&cc=<?php //echo  trim($dato['concepto']); 
                                                                    ?>">
                                            <?php //echo ucfirst(strtolower(trim($dato['concepto']))); 
                                            ?>
                                        </a>
                                    </h6>
                                    <span>
                                        <?php //echo $dato['cantidad']; 
                                        ?> items
                                    </span>
                                </div>  -->
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>
        <!--End category slider-->

        <!-- Section banners productos promocionados de manera especial -->
        <!-- <section class="banners mb-25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <img src="assets/imgs/banner/banner-1.png" alt="" />
                            <div class="banner-text">
                                <h4>
                                    Everyday Fresh & <br />Clean with Our<br />
                                    Products
                                </h4>
                                <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                            <img src="assets/imgs/banner/banner-2.png" alt="" />
                            <div class="banner-text">
                                <h4>
                                    Make your Breakfast<br />
                                    Healthy and Easy
                                </h4>
                                <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                            <img src="assets/imgs/banner/banner-3.png" alt="" />
                            <div class="banner-text">
                                <h4>The best Organic <br />Products Online</h4>
                                <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!--End banners-->

        <!-- Productos paginados -->
        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>Productos</h3>
                </div>

                <div class="container mb-30">
                    <div class="row">
                        <div class="col-12">

                            <!-- Filtro y Orden de productos -->
                            <div class="shop-product-fillter" style="padding-top: 3px; padding-bottom: 3px;">
                                <!-- <div class="totall-product">
                                    <p>We found <strong class="text-brand">29</strong> items for you!</p>
                                </div> -->

                                <!-- Orden -->
                                <!-- <div class="sort-by-product-area">
                                    <div class="sort-by-cover mr-10">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps"></i>Show:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li><a class="active" href="#">50</a></li>
                                                <li><a href="#">100</a></li>
                                                <li><a href="#">150</a></li>
                                                <li><a href="#">200</a></li>
                                                <li><a href="#">All</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="sort-by-cover">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li><a class="active" href="#">Featured</a></li>
                                                <li><a href="#">Price: Low to High</a></li>
                                                <li><a href="#">Price: High to Low</a></li>
                                                <li><a href="#">Release Date</a></li>
                                                <li><a href="#">Avg. Rating</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>  -->
                            </div>

                            <!-- Inicialización de datos -->
                            <?php
                            $dataArrayAllProductos = getAllProducts(); // '[{"numero":"6448","denom":"ADAPTADOR 1PLUG H / 2PLUG M S/CABLE NISUTA T2ST32","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"4.000","id_estado":"4","activoweb":"","tipboni":"p","prefin":"429.72","precio_final":"348.0732000000000000000000","bonfija":"19.00","url":"6448-1.png","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"SIN ESTADO","pesopres":"0.9"},{"numero":"6370","denom":"ADAPTADOR BT P/AURICULAR NISUTA SD MIC NS COSTBLA ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"2240.24","precio_final":"2240.24","bonfija":"0","url":"6370.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"SIN ESTADO","pesopres":""},{"numero":"1171","denom":"ADAPTADOR BT P/AURICULAR PLUG NISUTA COUSBLP      ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"2015.70","precio_final":"2015.70","bonfija":"0","url":"1171.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"SIN ESTADO","pesopres":""},{"numero":"2550","denom":"ADAPTADOR BT P/NB/PC 4.0 TP-LINK UB400            ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"996.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"1249.19","precio_final":"1249.1900000000000000000000","bonfija":"0.00","url":"2550.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"SIN ESTADO","pesopres":"0.250"},{"numero":"3021","denom":"ADAPTADOR BT P/NB/PC NISUTA COUSBL2               ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"1277.57","precio_final":"1277.57","bonfija":"0","url":"3021.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"SIN ESTADO","pesopres":""},{"numero":"6806","denom":"ADAPTADOR BT P/PARLANTE/AUTO NISUTA COSTBL PLUG3.5","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"1367.89","precio_final":"1367.89","bonfija":"0","url":"6806.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"SIN ESTADO","pesopres":""},{"numero":"6611","denom":"ADAPTADOR BT P/PARLANTE NETMAK BT22 PLUG 3.0      ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"725.24","precio_final":"725.24","bonfija":"0","url":"6611.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"SIN ESTADO","pesopres":""},{"numero":"2252","denom":"ADAPTADOR DB9 (H) DB25 (M)                        ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"647.81","precio_final":"647.81","bonfija":"0","url":"2252.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"SIN ESTADO","pesopres":""},{"numero":"6056","denom":"ADAPTADOR DVI-D M (24+1) A VGA H C/AUDIO NISUTA   ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"1535.56","precio_final":"1535.56","bonfija":"0","url":"6056.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"SIN ESTADO","pesopres":""},{"numero":"6040","denom":"ADAPTADOR HDMI H / HDMI M 360\u00ba NISUTA ADHD360     ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"4","activoweb":"","tipboni":"s","prefin":"1343.38","precio_final":"1343.38","bonfija":"0","url":"6040.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"SIN ESTADO","pesopres":""}]'; //
                            // setMessageInfoText('dataArrayAllProductos', $dataArrayAllProductos);
                            // return;
                            $amount = count(json_decode($dataArrayAllProductos, true));
                            ?>

                            <!-- #################################################################################################### -->
                            <!-- Paginación Top-->
                            <!-- <div class="pagination-area mt-20 mb-20"> -->
                            <div class="pagination-area mt-3 mb-3">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <!-- justify-content-start -->
                                        <?php
                                        $amountTotalPages = $amount / $limitProductoForPage;
                                        if (isDecimal($amountTotalPages)) { // echo 'DECIMAL';
                                            $amountTotalPages = intval($amountTotalPages) + 1;
                                        }

                                        $countPageInitial = 0;
                                        $countPageFinish = 0;
                                        if ($pagActual > 1) {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" onclick="setPageProductsIndex(<?php echo intval($pagActual) - 1; ?>); return false;">
                                                    <i class="fi-rs-arrow-small-left"></i>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        $countTotalRepeat = 0;
                                        if ($pagActual > 3) {
                                        ?>
                                            <li class="page-item"><a class="page-link dot" onclick="setPageProductsIndex(<?php echo intval($pagActual) - 3; ?>); return false;">...</a></li>
                                            <?php
                                        }
                                        for ($i = 1; $i <= $amountTotalPages; $i++) {
                                            $countTotalRepeat++;
                                            if ($pagActual == $i) {
                                            ?>
                                                <li class="page-item active">
                                                    <a class="page-link" onclick="setPageProductsIndex(<?php echo $i; ?>); return false;">
                                                        <?php echo $i; ?>
                                                    </a>
                                                </li>
                                            <?php
                                            } else if ($i <= ($pagActual + 3) && $i >= ($pagActual - 3)) {
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link" onclick="setPageProductsIndex(<?php echo $i; ?>); return false;">
                                                        <?php echo $i; ?>
                                                    </a>
                                                </li>
                                            <?php
                                            }
                                        }
                                        if ($countTotalRepeat < $amountTotalPages) {
                                            ?>
                                            <li class="page-item"><a class="page-link dot" onclick="setPageProductsIndex(<?php echo intval($pagActual) + 3; ?>); return false;">...</a></li>
                                        <?php
                                        }
                                        if ($pagActual < $amountTotalPages) {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" onclick="setPageProductsIndex(<?php echo intval($pagActual) + 1; ?>); return false;">
                                                    <i class="fi-rs-arrow-small-right"></i>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                            <!-- End Paginación Top-->
                            <!-- #################################################################################################### -->

                            <!-- Product Grid -->
                            <div class="row product-grid">

                                <!-- #################################################################################################### -->
                                <!-- Product Card -->
                                <?php
                                if ($amount > 0) {
                                    $amountRepeat = 0;

                                    $qwert = intval($pagActual) * intval($limitProductoForPage);

                                    foreach (json_decode($dataArrayAllProductos, true) as $dato) {
                                        if ($amountRepeat <= ($qwert + $limitProductoForPage) && $amountRepeat >= ($qwert - $limitProductoForPage)) {

                                ?>
                                            <!-- Product card -->
                                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap mb-30">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom" style="display: flex; justify-content: center; align-items: center;">
                                                            <a href="product-detail?td=p&c=<?php echo trim($dato['numero']) ?>">
                                                                <?php
                                                                $urlImage = 'assets/imgs/shop/product-1-1.jpg';
                                                                if (file_exists('src/img/productos/' . $dato['url'])) {
                                                                    $urlImage = 'src/img/productos/' . $dato['url'];
                                                                } else {
                                                                    $urlImage = 'assets/imgs/shop/product-1-1.jpg';
                                                                }
                                                                ?>
                                                                <!-- <img class="default-img" src="assets/imgs/shop/product-1-1.jpg" alt="" />
                                                                <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt="" /> -->
                                                                <img class="default-img" src="<?php echo $urlImage; ?>" alt="" />
                                                                <img class="hover-img" src="<?php echo $urlImage; ?>" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- <div class="product-action-1">
                                                            <a aria-label="Agregar a favoritos" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                            <a aria-label="Vista rápida" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                                        </div> -->
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <?php
                                                            if ($dato['id_estado'] > 1) { ?>
                                                                <span class="badge-<?php echo $dato['class_color']; ?>"><?php echo $dato['descripcion']; ?></span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">

                                                        <!-- Nombre de la categoría a la que pertenece -->
                                                        <div class="product-category d-flex justify-content-between">
                                                            <a href="#"><?php echo trim($dato['concepto']); ?></a>
                                                            <a href="#"><?php echo 'Cod. ' . trim($dato['numero']); ?></a>
                                                        </div>

                                                        <!-- Denom -->
                                                        <h2 style="min-height: 60px;">
                                                            <a href="product-detail?td=p&c=<?php echo trim($dato['numero']) ?>">
                                                                <?php echo trim($dato['denom']); ?>
                                                            </a>
                                                        </h2>

                                                        <!-- Presentaciones del producto -->
                                                        <?php
                                                        $codpres = 0;
                                                        $pesopres = 0;
                                                        // $dataArrayPresProductos = getAllPresOfProduct(trim($dato['numero']));
                                                        $dataArrayPresProductos = [];
                                                        $preciofinalpresentconbonifi = 0;
                                                        $preciofinalpresentsinbonifi = 0;
                                                        // echo $dataArrayPresProductos;
                                                        for ($i = 1; $i < 6; $i++) {
                                                            if ($dato['peso_pres' . $i] != '') {
                                                                array_push(
                                                                    $dataArrayPresProductos,
                                                                    [
                                                                        'codpres' => $dato['cod_pres' . $i],
                                                                        'pesopres' => $dato['peso_pres' . $i],
                                                                        'precio_final_por_presentacion_con_bonifi' => $dato['precio_con_bonifi_pres' . $i],
                                                                        'precio_final_por_presentacion_sin_bonifi' => $dato['precio_sin_bonifi_pres' . $i]
                                                                    ]
                                                                );
                                                            } else {
                                                                break;
                                                            }
                                                        }
                                                        if (count($dataArrayPresProductos) > 0) {
                                                            // $amountPresentations = count(json_decode($dataArrayPresProductos, true));
                                                        ?>
                                                            <!-- <div class="attr-detail attr-size mb-30"> -->
                                                            <div class="attr-detail attr-size d-flex justify-content-center">
                                                                <ul class="list-filter size-filter font-small d-flex justify-content-center">
                                                                    <!-- <strong class="mr-10">Size / Weight: </strong> -->
                                                                    <strong class="mr-2"></strong>
                                                                    <?php
                                                                    $isSelected = true;

                                                                    $amountOfPresProd = (int)count($dataArrayPresProductos);
                                                                    $countRepeat = 0;

                                                                    // echo '$amountOfPresProd ==> ' . $amountOfPresProd;
                                                                    foreach ($dataArrayPresProductos as $datoPresentation) {
                                                                        $countRepeat++;
                                                                        if ($isSelected) {
                                                                            $codpres = trim($datoPresentation['codpres']);
                                                                            $pesopres = trim($datoPresentation['pesopres']);
                                                                            $isSelected = false;
                                                                            $preciofinalpresentconbonifi = 0;
                                                                            $preciofinalpresentsinbonifi = 0;
                                                                            $preciofinalpresentconbonifi = trim($datoPresentation['precio_final_por_presentacion_con_bonifi']);
                                                                            $preciofinalpresentsinbonifi = trim($datoPresentation['precio_final_por_presentacion_sin_bonifi']);
                                                                    ?>
                                                                            <li class="active">
                                                                                <a onclick="setPresSelectedToProductData(this); return false;" data-codpres="<?php echo trim($datoPresentation['codpres']); ?>" data-numero="<?php echo trim($dato['numero']); ?>" data-pesopres="<?php echo trim($datoPresentation['pesopres']); ?>" data-preciofinalpresentsinbonifi="<?php echo trim($datoPresentation['precio_final_por_presentacion_sin_bonifi']); ?>" data-preciofinalpresentconbonifi="<?php echo trim($datoPresentation['precio_final_por_presentacion_con_bonifi']); ?>" data-bonfija="<?php echo trim($dato['bonfija']); ?>">
                                                                                    <?php echo trim($datoPresentation['pesopres']) . ' '; ?> kg
                                                                                </a>
                                                                            </li>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <li>
                                                                                <a onclick="setPresSelectedToProductData(this); return false;" data-codpres="<?php echo trim($datoPresentation['codpres']); ?>" data-numero="<?php echo trim($dato['numero']); ?>" data-pesopres="<?php echo trim($datoPresentation['pesopres']); ?>" data-preciofinalpresentsinbonifi="<?php echo trim($datoPresentation['precio_final_por_presentacion_sin_bonifi']); ?>" data-preciofinalpresentconbonifi="<?php echo trim($datoPresentation['precio_final_por_presentacion_con_bonifi']); ?>" data-bonfija="<?php echo trim($dato['bonfija']); ?>">
                                                                                    <?php echo trim($datoPresentation['pesopres']) . ' '; ?> Kg
                                                                                </a>
                                                                            </li>
                                                                            <!-- <li><a href="#">50g</a></li> -->
                                                                            <!-- <li class="active"><a href="#">60g</a></li> -->
                                                                            <!-- <li><a href="#">80g</a></li> -->
                                                                            <!-- <li><a href="#">100g</a></li> -->
                                                                            <!-- <li><a href="#">150g</a></li> -->
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="attr-detail attr-size d-flex justify-content-center">
                                                                <ul class="list-filter size-filter font-small d-flex justify-content-center">
                                                                    <li class="active"><a href="#">Unidades</a></li>
                                                                </ul>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                        <div class="product-card-bottom dflex justify-content-around">
                                                            <div class="product-price">
                                                                <span style="font-size: 25px;" id="id-span-precio-present-con-bonifi-card-<?php echo trim($dato['numero']); ?>">
                                                                    $
                                                                    <?php
                                                                    if ($preciofinalpresentconbonifi != 0) {
                                                                        echo number_format(trim($preciofinalpresentconbonifi), 2);
                                                                    } else {
                                                                        echo number_format(trim($dato['precio_final']), 2);
                                                                    }

                                                                    ?>
                                                                </span>
                                                                <?php
                                                                // Si el producto tiene bonificación
                                                                if ($dato['bonfija'] > 0) {
                                                                ?>
                                                                    <span style="font-size: 20px;" id="id-span-precio-present-sin-bonifi-card-<?php echo trim($dato['numero']); ?>" class="old-price">
                                                                        $
                                                                        <?php
                                                                        if ($preciofinalpresentsinbonifi != 0) {
                                                                            echo number_format(trim($preciofinalpresentsinbonifi), 2);
                                                                        } else {
                                                                            echo number_format(trim($dato['prefin']), 2);
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>

                                                        <div class="product-card-bottom">
                                                            <div class="detail-qty border radius" style="max-width: 80px; padding: 0;">
                                                                <!-- <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                                <span id="id-span-cantidad-<?php //echo trim($dato['numero']); 
                                                                                            ?>" class="qty-val">1</span>
                                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a> -->
                                                                <a onclick="qtyDown(<?php echo trim($dato['numero']); ?>); return false;" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                                <input type="number" id="id-span-cantidad-<?php echo trim($dato['numero']); ?>" class="qty-val class-qty-val" style="width:74px; height:100%; border:0; color:#7E7E7E; padding-left: 0px; text-align: center;" value="1" min="1">
                                                                <a onclick="qtyUp(<?php echo trim($dato['numero']); ?>); return false;" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                            </div>
                                                            <div class="add-cart" style="height: 48px;">
                                                                <a id="id-href-addproductcart-<?php echo trim($dato['numero']); ?>" class="add" style="height: 48px; display: flex; align-items: center;" onclick="addProductToCart(this); return false;" data-num=<?php echo trim($dato['numero']); ?> data-denom="<?php echo trim($dato['denom']); ?>" data-stopro=<?php echo trim($dato['stopro']); ?> data-stoact=<?php echo trim($dato['stoact']); ?> data-idestado=<?php echo trim($dato['id_estado']); ?> data-prefin=<?php echo trim($dato['prefin']); ?> data-preciofinal=<?php echo trim($dato['precio_final']); ?> data-bonfija=<?php echo trim($dato['bonfija']); ?> data-tipbonifi=<?php echo trim($dato['tipboni']); ?> data-idpresentacion=<?php echo $codpres; ?> data-pesopres=<?php echo $pesopres; ?> data-preciofinalpresentconbonifi=<?php echo $preciofinalpresentconbonifi; ?>>
                                                                    <i class="fi-rs-shopping-cart mr-5"></i>
                                                                    Agregar
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--end product card-->
                                    <?php
                                        }
                                        $amountRepeat++;
                                        if ($amountRepeat >= $qwert) { // $limitProductoForPage) {
                                            // Corto ejecución del for
                                            break;
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="toggle_info" style="background-color: PapayaWhip; margin-top: 25px; display: flex; justify-content: center;">
                                        <span>
                                            <span class="text-muted font-lg">No se encontraron productos relacionados.. Puedes</span>
                                            <a onclick="goToHome(); return false;" data-bs-toggle="collapse" class="collapsed font-lg" aria-expanded="false"><strong>regresar al inicio </strong></a>
                                            <span class="text-muted font-lg">y volver a intentarlo</span>
                                        </span>
                                    </div>
                                <?php
                                }
                                ?>
                                <!--end product card-->
                                <!-- #################################################################################################### -->

                            </div>
                            <!--product grid-->

                            <!-- #################################################################################################### -->
                            <!-- Paginación Bot-->
                            <div class="pagination-area mt-20 mb-20">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <!-- justify-content-start -->
                                        <?php
                                        // $amountTotalPages = $amount / $limitProductoForPage;
                                        if (isDecimal(1)) { // echo 'DECIMAL';
                                            $amountTotalPages = intval($amountTotalPages) + 1;
                                        }

                                        $countPageInitial = 0;
                                        $countPageFinish = 0;
                                        if ($pagActual > 1) {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" onclick="setPageProductsIndex(<?php echo intval($pagActual) - 1; ?>); return false;">
                                                    <i class="fi-rs-arrow-small-left"></i>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        $countTotalRepeat = 0;
                                        if ($pagActual > 3) {
                                        ?>
                                            <li class="page-item"><a class="page-link dot" onclick="setPageProductsIndex(<?php echo intval($pagActual) - 3; ?>); return false;">...</a></li>
                                            <?php
                                        }
                                        for ($i = 1; $i <= $amountTotalPages; $i++) {
                                            $countTotalRepeat++;
                                            if ($pagActual == $i) {
                                            ?>
                                                <li class="page-item active">
                                                    <a class="page-link" onclick="setPageProductsIndex(<?php echo $i; ?>); return false;">
                                                        <?php echo $i; ?>
                                                    </a>
                                                </li>
                                            <?php
                                            } else if ($i <= ($pagActual + 3) && $i >= ($pagActual - 3)) {
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link" onclick="setPageProductsIndex(<?php echo $i; ?>); return false;">
                                                        <?php echo $i; ?>
                                                    </a>
                                                </li>
                                            <?php
                                            }
                                        }
                                        if ($countTotalRepeat < $amountTotalPages) {
                                            ?>
                                            <li class="page-item"><a class="page-link dot" onclick="setPageProductsIndex(<?php echo intval($pagActual) + 3; ?>); return false;">...</a></li>
                                        <?php
                                        }
                                        if ($pagActual < $amountTotalPages) {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" onclick="setPageProductsIndex(<?php echo intval($pagActual) + 1; ?>); return false;">
                                                    <i class="fi-rs-arrow-small-right"></i>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                            <!-- End Paginación Bot-->
                            <!-- #################################################################################################### -->


                            <!-- INICIO Combos y ofertas especiales -->
                            <?php
                            $flagAux = true;
                            if ($flagAux == true) {
                                $dataArrayAllCombos =  getAllActiveCombos(); // '[{"id":"2222","denom":"Super combo de alimentos orgánicos, frescos y listos para el consumo!","fecvenci":"2022-11-29","tipobonifi":"F","bonifi":"690.25","pretot":"5689.25","prefin":"4999.00","stoact":"1.000","stoini":"10.000","isactive":"t","denom1":"Super combo de alimentos orgánicos, frescos y listos para el consumo! Super combo de alimentos orgánicos, frescos y listos para el consumo!","porven":"10"}]'; //
                                // setMessageInfoText('dataArrayAllCombos',$dataArrayAllCombos);
                                if ($dataArrayAllCombos != 0) {
                                    // echo $dataArrayAllCombos;
                                    // return;
                                    $amountCombos = count(json_decode($dataArrayAllCombos, true));
                                    if ($amountCombos > 0) {
                            ?>
                                        <section class="section-padding pb-5">
                                            <div class="section-title">
                                                <h3 class="">
                                                    <?php
                                                    echo getTittleSectionCombo();
                                                    ?>
                                                </h3>
                                                <!-- <a class="#" href="shop-grid-right.html">
                                                    Ver todos
                                                    <i class="fi-rs-angle-right"></i>
                                                </a> -->
                                            </div>
                                            <div class="row">

                                                <?php
                                                // echo $dataArrayAllCombos;
                                                foreach (json_decode($dataArrayAllCombos, true) as $datoCombo) {
                                                    $imgCombo = getAllImgsOfOneCombo($datoCombo['id']);
                                                ?>

                                                    <div class="col-xl-3 col-lg-4 col-md-6" style="min-width: 340px;">
                                                        <div class="product-cart-wrap style-2">
                                                            <div class="product-img-action-wrap">
                                                                <div class="product-img">
                                                                    <a href="product-detail?td=c&c=<?php echo $datoCombo['id']; ?>">
                                                                        <!-- <img src="assets/imgs/banner/banner-5.png" alt="" /> -->
                                                                        <img src="<?php echo $imgCombo[0]; ?>" alt="" />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="product-content-wrap">
                                                                <div class="deals-countdown-wrap">
                                                                    <div class="deals-countdown" data-countdown="<?php echo str_replace('-', '/', $datoCombo['fecvenci']); ?> 00:00:00"></div>
                                                                </div>
                                                                <div class="deals-content" style="min-height: 198px;">
                                                                    <h2><a href="product-detail?td=c&c=<?php echo $datoCombo['id']; ?>"><?php echo $datoCombo['denom']; ?></a></h2>

                                                                    <!-- Rate of the product -->
                                                                    <!-- <div class="product-rate-cover">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width: 90%"></div>
                                                                </div>
                                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                            </div> -->

                                                                    <div>
                                                                        <span class="font-small text-muted">Productos del combo:</span>
                                                                        <?php
                                                                        $dataArrayAllProductsOfComb = getAllProductsOfCombo(intval($datoCombo['id']));
                                                                        $amountProductsOfCombo = count(json_decode($dataArrayAllProductsOfComb, true));
                                                                        if ($amountProductsOfCombo > 0) {
                                                                            $contadorProd = 1;
                                                                            foreach (json_decode($dataArrayAllProductsOfComb, true) as $datoProductInCombo) {
                                                                        ?>
                                                                                <h6 class="font-small text-muted" style="font-size: 13px;">
                                                                                    <a href="product-detail?td=p&c=<?php echo $datoProductInCombo['numero'] ?>">
                                                                                        <?php
                                                                                        echo '#' . $contadorProd . ' ' . cortarPorCantidadDePalaras($datoProductInCombo['denom'], 4)[0] . '...';
                                                                                        ?>
                                                                                    </a>
                                                                                </h6>
                                                                        <?php
                                                                                $contadorProd++;
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="product-card-bottom">
                                                                        <div class="product-price">
                                                                            <span>
                                                                                $
                                                                                <?php
                                                                                echo number_format($datoCombo['prefin'], 2);
                                                                                ?>
                                                                            </span>
                                                                            <span class="old-price">
                                                                                $
                                                                                <?php
                                                                                echo number_format($datoCombo['pretot'], 2);
                                                                                ?>
                                                                            </span>
                                                                        </div>
                                                                        <!-- <div class="add-cart">
                                                                    <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Agregar </a>
                                                                </div> -->
                                                                    </div>

                                                                    <div class="sold mt-15 mb-15">
                                                                        <div class="progress mb-5">
                                                                            <div class="progress-bar" role="progressbar" style="width: <?php echo trim($datoCombo['porven']); ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <span class="font-xs text-heading"> Quedan sólo:
                                                                            <?php echo number_format(trim($datoCombo['stoact'])); ?>
                                                                            /
                                                                            <?php echo number_format(trim($datoCombo['stoini'])); ?>
                                                                        </span>
                                                                    </div>

                                                                    <!-- <div class="product-card-bottom justify-content-center"> -->
                                                                    <div class="product-card-bottom justify-content">
                                                                        <div class="detail-qty border radius" style="max-width: 120px;">
                                                                            <!-- <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                                            <span id="id-span-cantidad-<?php //echo trim($datoCombo['id']); 
                                                                                                        ?>" class="qty-val">1</span>
                                                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a> -->
                                                                            <a onclick="qtyDown(<?php echo trim($datoCombo['id']); ?>); return false;" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                                            <input value="1" type="number" id="id-span-cantidad-<?php echo trim($datoCombo['id']); ?>" class="qty-val" style="width:75px; height:100%; border:0; color:#7E7E7E;">
                                                                            </input>
                                                                            <a onclick="qtyUp(<?php echo trim($datoCombo['id']); ?>); return false;" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                                        </div>

                                                                        <div class="add-cart d-flex">
                                                                            <a class="add" style="height: 48px; display: flex; align-items: center;" onclick="addComboToCart(this); return false;" data-id=<?php echo trim($datoCombo['id']); ?> data-denom=<?php echo trim($datoCombo['denom']); ?> data-fecvenci="<?php echo trim($datoCombo['fecvenci']); ?>" data-tipobonifi="<?php echo trim($datoCombo['tipobonifi']); ?>" data-bonifi="<?php echo trim($datoCombo['bonifi']); ?>" data-pretot="<?php echo trim($datoCombo['pretot']); ?>" data-prefin="<?php echo trim($datoCombo['prefin']); ?>" data-stoact="<?php echo trim($datoCombo['stoact']); ?>" data-stoini="<?php echo trim($datoCombo['stoini']); ?>">
                                                                                <i class="fi-rs-shopping-cart mr-5"></i>
                                                                                Agregar
                                                                            </a>
                                                                            <!-- <a class="add" style="height: 48px; display: flex; align-items: center;" onclick="addProductToCart(this); return false;" data-num=<?php //echo trim($dato['numero']); 
                                                                                                                                                                                                                    ?> data-denom="<?php //echo trim($dato['denom']); 
                                                                                                                                                                                                                                    ?>" data-stopro=<?php //echo trim($dato['stopro']); 
                                                                                                                                                                                                                                                    ?> data-stoact=<?php //echo trim($dato['stoact']); 
                                                                                                                                                                                                                                                                    ?> data-idestado=<?php // echo trim($dato['id_estado']); 
                                                                                                                                                                                                                                                                                        ?> data-prefin=<?php //echo trim($dato['prefin']); 
                                                                                                                                                                                                                                                                                                        ?> data-preciofinal=<?php //echo trim($dato['precio_final']); 
                                                                                                                                                                                                                                                                                                                            ?> data-bonfija=<?php //echo trim($dato['bonfija']); 
                                                                                                                                                                                                                                                                                                                                            ?> data-idpresentacion=<?php //echo $codpres; 
                                                                                                                                                                                                                                                                                                                                                                                                        ?> data-pesopres=<?php //echo $pesopres; 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?> data-preciofinalpresentconbonifi=<?php //echo $preciofinalpresentconbonifi; 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ?>>
                                                                        <i class="fi-rs-shopping-cart mr-5"></i>
                                                                        Agregar
                                                                    </a> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php
                                                }
                                                ?>

                                                <!--                                                 <!~~ <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="product-cart-wrap style-2">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img">
                                                    <a href="#">
                                                        <img src="assets/imgs/banner/banner-6.png" alt="" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="deals-countdown-wrap">
                                                    <div class="deals-countdown" data-countdown="2026/04/25 00:00:00"></div>
                                                </div>
                                                <div class="deals-content" style="min-height: 198px;">
                                                    <h2><a href="#">Perdue Simply Smart Organics
                                                            Gluten</a></h2>
                                                    <div class="product-rate-cover">
                                                        <div class="product-rate d-inline-block">
                                                            <div class="product-rating" style="width: 90%"></div>
                                                        </div>
                                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                    </div>
                                                    <div>
                                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Old El Paso</a></span>
                                                    </div>
                                                    <div class="product-card-bottom">
                                                        <div class="product-price">
                                                            <span>$24.85</span>
                                                            <span class="old-price">$26.8</span>
                                                        </div>
                                                        <div class="add-cart">
                                                            <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="product-cart-wrap style-2">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img">
                                                        <a href="#">
                                                            <img src="assets/imgs/banner/banner-5.png" alt="" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <div class="deals-countdown-wrap">
                                                        <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                                                    </div>
                                                    <div class="deals-content" style="min-height: 198px;">
                                                        <h2><a href="#">Seeds of Change Organic Quinoa,
                                                                Brown</a></h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 90%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                        </div>
                                                        <div>
                                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Food</a></span>
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                <span>$32.85</span>
                                                                <span class="old-price">$33.8</span>
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="product-cart-wrap style-2">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img">
                                                        <a href="#">
                                                            <img src="assets/imgs/banner/banner-6.png" alt="" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <div class="deals-countdown-wrap">
                                                        <div class="deals-countdown" data-countdown="2026/04/25 00:00:00"></div>
                                                    </div>
                                                    <div class="deals-content" style="min-height: 198px;">
                                                        <h2><a href="#">Perdue Simply Smart Organics
                                                                Gluten</a></h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 90%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                        </div>
                                                        <div>
                                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Old El Paso</a></span>
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                <span>$24.85</span>
                                                                <span class="old-price">$26.8</span>
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="product-cart-wrap style-2">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img">
                                                        <a href="#">
                                                            <img src="assets/imgs/banner/banner-5.png" alt="" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <div class="deals-countdown-wrap">
                                                        <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                                                    </div>
                                                    <div class="deals-content" style="min-height: 198px;">
                                                        <h2><a href="#">Seeds of Change Organic Quinoa,
                                                                Brown</a></h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 90%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                        </div>
                                                        <div>
                                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Food</a></span>
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                <span>$32.85</span>
                                                                <span class="old-price">$33.8</span>
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="product-cart-wrap style-2">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img">
                                                        <a href="#">
                                                            <img src="assets/imgs/banner/banner-6.png" alt="" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <div class="deals-countdown-wrap">
                                                        <div class="deals-countdown" data-countdown="2026/04/25 00:00:00"></div>
                                                    </div>
                                                    <div class="deals-content" style="min-height: 198px;">
                                                        <h2><a href="#">Perdue Simply Smart Organics
                                                                Gluten</a></h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 90%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                        </div>
                                                        <div>
                                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Old El Paso</a></span>
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                <span>$24.85</span>
                                                                <span class="old-price">$26.8</span>
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6 d-none d-lg-block">
                                            <div class="product-cart-wrap style-2">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img">
                                                        <a href="#">
                                                            <img src="assets/imgs/banner/banner-7.png" alt="" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <div class="deals-countdown-wrap">
                                                        <div class="deals-countdown" data-countdown="2027/03/25 00:00:00"></div>
                                                    </div>
                                                    <div class="deals-content" style="min-height: 198px;">
                                                        <h2><a href="#">Signature Wood-Fired Mushroom</a></h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 80%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                                        </div>
                                                        <div>
                                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Progresso</a></span>
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                <span>$12.85</span>
                                                                <span class="old-price">$13.8</span>
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-6 d-none d-xl-block">
                                            <div class="product-cart-wrap style-2">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img">
                                                        <a href="#">
                                                            <img src="assets/imgs/banner/banner-8.png" alt="" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <div class="deals-countdown-wrap">
                                                        <div class="deals-countdown" data-countdown="2025/02/25 00:00:00"></div>
                                                    </div>
                                                    <div class="deals-content" style="min-height: 198px;">
                                                        <h2><a href="#">Simply Lemonade with Raspberry
                                                                Juice</a></h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 80%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                                        </div>
                                                        <div>
                                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Yoplait</a></span>
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                <span>$15.85</span>
                                                                <span class="old-price">$16.8</span>
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> ~~> -->
                                            </div>
                                        </section>
                                        <!--End Deals-->
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Products Tabs-->

        <!-- ######################################################################################################################################################## -->
        <!--         <!~~ Destacados ~~>
        <!~~ <section class="section-padding pb-5">
            <div class="container">
                <div class="section-title wow animate__animated animate__fadeIn">
                    <h3 class="">Destacados</h3>
                </div>

                <div class="row">
                    <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                        <div class="banner-img style-2">
                            <div class="banner-text">
                                <h2 class="mb-100">Llená tu hogar de excelentes productos tecnológicos</h2>
                                <a href="#" class="btn btn-xs">Ver todos <i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                        <div class="tab-content" id="myTabContent-1">
                            <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">

                                        <?php
                                        // $dataArrayAllProductosEspeciales =  getAllProductsSpecials(); // '[{"numero":"2585","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS24 BLANCO       ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"3358.68","precio_final":"3358.68","bonfija":"0","url":"2585.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"2244","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS25 AMARILLO     ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"2763.54","precio_final":"2763.54","bonfija":"0","url":"2244.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"2970","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS25 CELESTE      ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"2763.54","precio_final":"2763.54","bonfija":"0","url":"2970.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"2700","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS25 ROSA         ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"2763.54","precio_final":"2763.54","bonfija":"0","url":"2700.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"3914","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS25 VERDE        ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"2763.54","precio_final":"2763.54","bonfija":"0","url":"3914.png","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"99","denom":"AURI IN EAR BT ESTUCHE NOGA RGB EARBUDS BTWINS L  ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"3229.04","precio_final":"3229.04","bonfija":"0","url":"99.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"5048","denom":"AURI IN EAR BT ESTUCHE PCBOX SHAKE IT E100 BLANCO ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"3.000","id_estado":"1","activoweb":"","prefin":"1742.13","precio_final":"1742.13","bonfija":"0","url":"5048.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"6012","denom":"AURI IN EAR PLUG MOTOROLA EARBUDS 2 BLANCO        ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"1019.47","precio_final":"1019.47","bonfija":"0","url":"6012.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"6168","denom":"AURI IN EAR PLUG MOTOROLA EARBUDS 2 NEGRO         ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1019.47","precio_final":"1019.47","bonfija":"0","url":"6168.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"1948","denom":"AURI VINCHA WIRE/PLUG ETHEOS MIC NEGRO            ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"17.000","id_estado":"2","activoweb":"","prefin":"2955.17","precio_final":"2955.17","bonfija":"0","url":"1948.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"OFERTA","pesopres":""},{"numero":"6506","denom":"BOT. ALT. EPSON T504 AMARILLO EVERTEC 70ML P/4    ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"966.000","id_estado":"2","activoweb":"","prefin":"480.06","precio_final":"384.0480000000000000000000","bonfija":"20.00","url":"6506.jpg","concepto":"IMPRESION","rubro":"1","descripcion":"OFERTA","pesopres":"0.9"},{"numero":"1670","denom":"CAR. EPSON T117120 A NEGRO T23 TX105              ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1225.62","precio_final":"1225.62","bonfija":"0","url":"1670.jpg","concepto":"IMPRESION","rubro":"1","descripcion":"NUEVO","pesopres":""},{"numero":"3647","denom":"CARGADOR CELU ETHEOS 2USB S/CABLE 2.4A            ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"194.000","id_estado":"1","activoweb":"","prefin":"471.02","precio_final":"471.02","bonfija":"0","url":"3647.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"NUEVO","pesopres":""},{"numero":"2018","denom":"CARRY DISK EXT USB 2.5\u00a8 3.0 NOGA CD1 3.0          ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1331.69","precio_final":"1331.69","bonfija":"0","url":"2018.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"NUEVO","pesopres":""},{"numero":"5986","denom":"CARRY DISK EXT XPG EX500 SATA 3,5\" USB 3.0        ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1780.69","precio_final":"1780.69","bonfija":"0","url":"5986.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"NUEVO","pesopres":""},{"numero":"6241","denom":"CELULAR TCL L10 LITE NEGRO 6.22\"/OCTACORE/32GB    ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"25419.58","precio_final":"25419.58","bonfija":"0","url":"6241.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"NUEVO","pesopres":""},{"numero":"4847","denom":"DESTRUCTORA FELLOWES DS 500 C                     ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"5","activoweb":"","prefin":"9427.86","precio_final":"9427.86","bonfija":"0","url":"4847.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"OUTLET","pesopres":""},{"numero":"3295","denom":"DESTRUCTOR HOME H-6C                              ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"2","activoweb":"","prefin":"4124.69","precio_final":"4124.69","bonfija":"0","url":"3295.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"OFERTA","pesopres":""},{"numero":"6938","denom":"MOUSE USB GENIUS MICROTRAVELER RETRA. MINI ROJO   ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"919.22","precio_final":"919.22","bonfija":"0","url":"6938.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"NUEVO","pesopres":""},{"numero":"2011","denom":"MOUSE USB VERBATIM 99741 SILVER                   ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"10.000","id_estado":"1","activoweb":"","prefin":"553.89","precio_final":"553.89","bonfija":"0","url":"2011.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"NUEVO","pesopres":""},{"numero":"2507","denom":"PARLANTE USB GENIUS SOUND BAR 100                 ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1520.25","precio_final":"1520.25","bonfija":"0","url":"2507.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"6940","denom":"PARLANTE USB GENIUS SP-HF180 NEGRO                ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"1484.04","precio_final":"1484.04","bonfija":"0","url":"6940.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"5079","denom":"PENDRIVE 32GB VERBATIM TOUGH MAX 99849 RESIST AGUA","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"3.000","id_estado":"1","activoweb":"","prefin":"1378.83","precio_final":"1378.83","bonfija":"0","url":"5079.jpg","concepto":"ALMACENAMIENTO","rubro":"10","descripcion":"NUEVO","pesopres":""},{"numero":"5528","denom":"SOPORTE LCD/LED 14\" A 42\" FIJO NOGA NGT-LT20      ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"735.57","precio_final":"735.57","bonfija":"0","url":"5528.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"NUEVO","pesopres":""},{"numero":"6575","denom":"TABLET 7\" AMAZON FIRE QCORE 16GB SD               ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"10506.17","precio_final":"10506.17","bonfija":"0","url":"6575.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"NUEVO","pesopres":""}]'; //
                                        // // $amountEspeciales = count(json_decode($dataArrayAllProductosEspeciales, true));
                                        // if ($amountEspeciales > 0) {
                                        //     foreach (json_decode($dataArrayAllProductosEspeciales, true) as $dato) {
                                        ?>

                                                <div class="product-cart-wrap" style="min-width: 350px;">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="#">
                                                                <?php
                                                                // $urlImage = 'assets/imgs/shop/product-1-1.jpg';
                                                                // if (file_exists('src/img/productos/' . $dato['url'])) {
                                                                //     $urlImage = 'src/img/productos/' . $dato['url'];
                                                                // } else {
                                                                //     $urlImage = 'assets/imgs/shop/product-1-1.jpg';
                                                                // }
                                                                ?>

                                                                <img class="default-img" src="<?php //echo $urlImage; 
                                                                                                ?>" alt="" />
                                                                <img class="hover-img" src="<?php //echo $urlImage; 
                                                                                            ?>" alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <?php
                                                            // $class = '';
                                                            // $name = ' ';
                                                            // if (trim($dato['id_estado']) == 1) {
                                                            //     $class = 'new';
                                                            //     $name = '¡Nuevo!';
                                                            // } else if (trim($dato['id_estado']) == 2 && intval(trim($dato['bonfija'])) > 0) {
                                                            //     $class = 'hot';
                                                            //     $name = number_format(trim($dato['bonfija'])) . ' % Off!';
                                                            // } else if (trim($dato['id_estado']) == 3) {
                                                            //     $class = 'llega-pronto';
                                                            //     $name = '¡Pronto!';
                                                            // } else if (trim($dato['id_estado']) == 5) {
                                                            //     $class = 'best';
                                                            //     $name = '¡Outlet!';
                                                            // }
                                                            ?>
                                                            <span class="<?php //echo $class; 
                                                                            ?>"><?php //echo $name; 
                                                                                ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-category">
                                                            <div class="product-category d-flex justify-content-between">
                                                                <a href="#"><?php //echo trim($dato['concepto']); 
                                                                            ?></a>
                                                                <a href="#"><?php //echo 'Cod. ' . trim($dato['numero']); 
                                                                            ?></a>
                                                            </div>
                                                        </div>

                                                        <h2 style="min-height: 70px;"><a href="#"><?php //echo $dato['denom']; 
                                                                                                    ?></a></h2>

                                                        <?php
                                                        // $codpres = 0;
                                                        // $pesopres = 0;
                                                        // $dataArrayPresProductos = getAllPresOfProduct(trim($dato['numero']));
                                                        // $preciofinalpresentconbonifi = 0;
                                                        // $preciofinalpresentsinbonifi = 0;
                                                        // if ($dataArrayPresProductos != 0) {
                                                        ?>
                                                            <div class="attr-detail attr-size d-flex justify-content-center">
                                                                <ul class="list-filter size-filter font-small">
                                                                    <strong class="mr-2"></strong>
                                                                    <?php
                                                                    // $isSelected = true;

                                                                    // foreach (json_decode($dataArrayPresProductos, true) as $datoPresentation) {
                                                                    //     if ($isSelected) {
                                                                    //         $codpres = trim($datoPresentation['codpres']);
                                                                    //         $pesopres = trim($datoPresentation['pesopres']);
                                                                    //         $isSelected = false;
                                                                    //         $preciofinalpresentconbonifi = 0;
                                                                    //         $preciofinalpresentsinbonifi = 0;
                                                                    //         $preciofinalpresentconbonifi = trim($datoPresentation['precio_final_por_presentacion_con_bonifi']);
                                                                    //         $preciofinalpresentsinbonifi = trim($datoPresentation['precio_final_por_presentacion_sin_bonifi']);
                                                                    ?>
                                                                            <li class="active">
                                                                                <a onclick="setPresSelectedToProductData(this); return false;" data-codpres="<?php echo trim($datoPresentation['codpres']); ?>" data-numero="<?php echo trim($dato['numero']); ?>" data-pesopres="<?php echo trim($datoPresentation['pesopres']); ?>" data-preciofinalpresentsinbonifi="<?php echo trim($datoPresentation['precio_final_por_presentacion_sin_bonifi']); ?>" data-preciofinalpresentconbonifi="<?php echo trim($datoPresentation['precio_final_por_presentacion_con_bonifi']); ?>" data-bonfija="<?php echo trim($dato['bonfija']); ?>">
                                                                                    <?php //echo trim($datoPresentation['pesopres']) . ' '; 
                                                                                    ?> g
                                                                                </a>
                                                                            </li>
                                                                        <?php
                                                                        // } else {
                                                                        ?>
                                                                            <li>
                                                                                <a onclick="setPresSelectedToProductData(this); return false;" data-codpres="<?php echo trim($datoPresentation['codpres']); ?>" data-numero="<?php echo trim($dato['numero']); ?>" data-pesopres="<?php echo trim($datoPresentation['pesopres']); ?>" data-preciofinalpresentsinbonifi="<?php echo trim($datoPresentation['precio_final_por_presentacion_sin_bonifi']); ?>" data-preciofinalpresentconbonifi="<?php echo trim($datoPresentation['precio_final_por_presentacion_con_bonifi']); ?>" data-bonfija="<?php echo trim($dato['bonfija']); ?>">
                                                                                    <?php //echo trim($datoPresentation['pesopres']) . ' ' . trim($datoPresentation['denom']); 
                                                                                    ?>
                                                                                </a>
                                                                            </li>
                                                                    <?php
                                                                    //     }
                                                                    // }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        <?php
                                                        // } else {
                                                        ?>
                                                            <ul style="visibility: hidden;" class="list-filter size-filter font-small d-flex justify-content-center">
                                                                <li class="active"><a href="#">Unidades</a></li>
                                                            </ul>
                                                        <?php
                                                        // }
                                                        ?>
                                                        <div class="product-card-bottom dflex justify-content-around">
                                                            <div class="product-price">
                                                                <span id="id-span-precio-present-con-bonifi-card-<?php //echo trim($dato['numero']); 
                                                                                                                    ?>" style="font-size: 24px;">
                                                                    $
                                                                    <?php
                                                                    // if ($preciofinalpresentconbonifi != 0) {
                                                                    //     echo number_format(trim($preciofinalpresentconbonifi), 2);
                                                                    // } else {
                                                                    //     echo number_format(trim($dato['precio_final']), 2);
                                                                    // }

                                                                    ?>
                                                                </span>
                                                                <?php
                                                                // if ($dato['bonfija'] > 0) {
                                                                ?>
                                                                    <span id="id-span-precio-present-sin-bonifi-card-<?php //echo trim($dato['numero']); 
                                                                                                                        ?>" class="old-price">
                                                                        $
                                                                        <?php
                                                                        // if ($preciofinalpresentsinbonifi != 0) {
                                                                        //     echo number_format(trim($preciofinalpresentsinbonifi), 2);
                                                                        // } else {
                                                                        //     echo number_format(trim($dato['prefin']), 2);
                                                                        // }
                                                                        ?>
                                                                    </span>
                                                                <?php
                                                                // }
                                                                ?>
                                                            </div>
                                                        </div>

                                                        <div class="product-card-bottom">
                                                            <div class="detail-qty border radius">
                                                                <a onclick="qtyDown(<?php //echo trim($dato['numero']); 
                                                                                    ?>); return false;" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                                <span id="id-span-cantidad-<?php //echo trim($dato['numero']); 
                                                                                            ?>" class="qty-val">1</span>
                                                                <a onclick="qtyUp(<?php //echo trim($dato['numero']); 
                                                                                    ?>); return false;" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                            </div>
                                                            <div class="add-cart" style="height: 48px;">
                                                                <a id="id-href-addproductcart-<?php //echo trim($dato['numero']); 
                                                                                                ?>" class="add" style="height: 48px; display: flex; align-items: center;" onclick="addProductToCart(this); return false;" data-num=<?php echo trim($dato['numero']); ?> data-denom="<?php echo trim($dato['denom']); ?>" data-stopro=<?php echo trim($dato['stopro']); ?> data-stoact=<?php echo trim($dato['stoact']); ?> data-idestado=<?php echo trim($dato['id_estado']); ?> data-prefin=<?php echo trim($dato['prefin']); ?> data-preciofinal=<?php echo trim($dato['precio_final']); ?> data-bonfija=<?php echo trim($dato['bonfija']); ?> data-idpresentacion=<?php echo $codpres; ?> data-pesopres=<?php echo $pesopres; ?> data-preciofinalpresentconbonifi=<?php echo $preciofinalpresentconbonifi; ?>>
                                                                    <i class="fi-rs-shopping-cart mr-5"></i>
                                                                    Agregar
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php
                                        // }
                                        // }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section> ~~> -->

        <!-- ######################################################################################################################################################## -->

        <!-- ######################################################################################################################################################## -->

        <!--Products Tabs-->

        <!--End Best Sales-->
        <section class="section-padding pb-5">
            <div class="container">
                <div class="section-title wow animate__animated animate__fadeIn">
                    <h3 class="">Destacados!</h3>
                    <!-- <ul class="nav nav-tabs links" id="myTab-2" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab" data-bs-target="#tab-one-1" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab" data-bs-target="#tab-two-1" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Popular</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab" data-bs-target="#tab-three-1" type="button" role="tab" aria-controls="tab-three" aria-selected="false">New added</button>
                        </li>
                    </ul> -->
                </div>
                <div class="row">
                    <!-- <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                        <div class="banner-img style-2">
                            <div class="banner-text">
                                <h2 class="mb-100">Bring nature into your home</h2>
                                <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-lg-12 col-md-12 col-xs-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                        <div class="tab-content" id="myTabContent-1">
                            <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                        <?php
                                        $dataArrayAllProductosEspeciales =  getAllProductsSpecials(); // '[{"numero":"2585","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS24 BLANCO       ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"3358.68","precio_final":"3358.68","bonfija":"0","url":"2585.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"2244","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS25 AMARILLO     ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"2763.54","precio_final":"2763.54","bonfija":"0","url":"2244.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"2970","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS25 CELESTE      ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"2763.54","precio_final":"2763.54","bonfija":"0","url":"2970.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"2700","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS25 ROSA         ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"2763.54","precio_final":"2763.54","bonfija":"0","url":"2700.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"3914","denom":"AURI IN EAR BT ESTUCHE NOGA BTWINS25 VERDE        ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"2763.54","precio_final":"2763.54","bonfija":"0","url":"3914.png","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"99","denom":"AURI IN EAR BT ESTUCHE NOGA RGB EARBUDS BTWINS L  ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"3229.04","precio_final":"3229.04","bonfija":"0","url":"99.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"5048","denom":"AURI IN EAR BT ESTUCHE PCBOX SHAKE IT E100 BLANCO ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"3.000","id_estado":"1","activoweb":"","prefin":"1742.13","precio_final":"1742.13","bonfija":"0","url":"5048.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"6012","denom":"AURI IN EAR PLUG MOTOROLA EARBUDS 2 BLANCO        ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"1019.47","precio_final":"1019.47","bonfija":"0","url":"6012.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"6168","denom":"AURI IN EAR PLUG MOTOROLA EARBUDS 2 NEGRO         ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1019.47","precio_final":"1019.47","bonfija":"0","url":"6168.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"1948","denom":"AURI VINCHA WIRE/PLUG ETHEOS MIC NEGRO            ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"17.000","id_estado":"2","activoweb":"","prefin":"2955.17","precio_final":"2955.17","bonfija":"0","url":"1948.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"OFERTA","pesopres":""},{"numero":"6506","denom":"BOT. ALT. EPSON T504 AMARILLO EVERTEC 70ML P/4    ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"966.000","id_estado":"2","activoweb":"","prefin":"480.06","precio_final":"384.0480000000000000000000","bonfija":"20.00","url":"6506.jpg","concepto":"IMPRESION","rubro":"1","descripcion":"OFERTA","pesopres":"0.9"},{"numero":"1670","denom":"CAR. EPSON T117120 A NEGRO T23 TX105              ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1225.62","precio_final":"1225.62","bonfija":"0","url":"1670.jpg","concepto":"IMPRESION","rubro":"1","descripcion":"NUEVO","pesopres":""},{"numero":"3647","denom":"CARGADOR CELU ETHEOS 2USB S/CABLE 2.4A            ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"194.000","id_estado":"1","activoweb":"","prefin":"471.02","precio_final":"471.02","bonfija":"0","url":"3647.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"NUEVO","pesopres":""},{"numero":"2018","denom":"CARRY DISK EXT USB 2.5\u00a8 3.0 NOGA CD1 3.0          ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1331.69","precio_final":"1331.69","bonfija":"0","url":"2018.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"NUEVO","pesopres":""},{"numero":"5986","denom":"CARRY DISK EXT XPG EX500 SATA 3,5\" USB 3.0        ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1780.69","precio_final":"1780.69","bonfija":"0","url":"5986.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"NUEVO","pesopres":""},{"numero":"6241","denom":"CELULAR TCL L10 LITE NEGRO 6.22\"/OCTACORE/32GB    ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"25419.58","precio_final":"25419.58","bonfija":"0","url":"6241.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"NUEVO","pesopres":""},{"numero":"4847","denom":"DESTRUCTORA FELLOWES DS 500 C                     ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"5","activoweb":"","prefin":"9427.86","precio_final":"9427.86","bonfija":"0","url":"4847.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"OUTLET","pesopres":""},{"numero":"3295","denom":"DESTRUCTOR HOME H-6C                              ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"2","activoweb":"","prefin":"4124.69","precio_final":"4124.69","bonfija":"0","url":"3295.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"OFERTA","pesopres":""},{"numero":"6938","denom":"MOUSE USB GENIUS MICROTRAVELER RETRA. MINI ROJO   ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"919.22","precio_final":"919.22","bonfija":"0","url":"6938.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"NUEVO","pesopres":""},{"numero":"2011","denom":"MOUSE USB VERBATIM 99741 SILVER                   ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"10.000","id_estado":"1","activoweb":"","prefin":"553.89","precio_final":"553.89","bonfija":"0","url":"2011.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"NUEVO","pesopres":""},{"numero":"2507","denom":"PARLANTE USB GENIUS SOUND BAR 100                 ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"1520.25","precio_final":"1520.25","bonfija":"0","url":"2507.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"6940","denom":"PARLANTE USB GENIUS SP-HF180 NEGRO                ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"1484.04","precio_final":"1484.04","bonfija":"0","url":"6940.jpg","concepto":"AUDIO Y VIDEO","rubro":"11","descripcion":"NUEVO","pesopres":""},{"numero":"5079","denom":"PENDRIVE 32GB VERBATIM TOUGH MAX 99849 RESIST AGUA","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"3.000","id_estado":"1","activoweb":"","prefin":"1378.83","precio_final":"1378.83","bonfija":"0","url":"5079.jpg","concepto":"ALMACENAMIENTO","rubro":"10","descripcion":"NUEVO","pesopres":""},{"numero":"5528","denom":"SOPORTE LCD/LED 14\" A 42\" FIJO NOGA NGT-LT20      ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"1.000","id_estado":"1","activoweb":"","prefin":"735.57","precio_final":"735.57","bonfija":"0","url":"5528.jpg","concepto":"ACCESORIOS                    ","rubro":"5","descripcion":"NUEVO","pesopres":""},{"numero":"6575","denom":"TABLET 7\" AMAZON FIRE QCORE 16GB SD               ","denom1":"CABLE ADAPTADOR DE AUDIO PLUG MACHO A 2 PLUG HEMBRA 3.5MM. Ideal para compartir tu m\u00c3\u00basica. El divisor de audio permite conectar dos auriculares o altavoces a un solo dispositivo. Compacto. Port\u00c3\u00a1til. Resistente. Buena calidad de sonido. Aprox: 15cm","facpro":"C","kilosxpiez":"0.000","stopro":"C","stoact":"2.000","id_estado":"1","activoweb":"","prefin":"10506.17","precio_final":"10506.17","bonfija":"0","url":"6575.jpg","concepto":"EQUIPAMIENTO","rubro":"2","descripcion":"NUEVO","pesopres":""}]'; //
                                        $amountEspeciales = count(json_decode($dataArrayAllProductosEspeciales, true));
                                        if ($amountEspeciales > 0) {
                                            foreach (json_decode($dataArrayAllProductosEspeciales, true) as $dato) {
                                        ?>
                                                <div class="product-cart-wrap" style="height: 540px;">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom" style="height: 90%;">
                                                            <a href="product-detail?td=p&c=<?php echo trim($dato['numero']); ?>">
                                                                <?php
                                                                $url = 'src/img/productos/' . trim($dato['url']);
                                                                if (!file_exists($url)) {
                                                                ?>
                                                                    <img class="default-img" src="assets/imgs/shop/product-1-1.jpg" alt="" />
                                                                    <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt="" />
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img class="default-img" src="src/img/productos/<?php echo $dato['url']; ?>" alt="" />
                                                                    <img class="hover-img" src="src/img/productos/<?php echo $dato['url']; ?>" alt="" />
                                                                <?php
                                                                }
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="product-badges product-badges-position product-badges-mrg" style="height: 10%;">
                                                            <?php
                                                            if ($dato['id_estado'] > 1) { ?>
                                                                <span class="badge-<?php echo $dato['class_color']; ?>"><?php echo $dato['descripcion']; ?></span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-category d-flex justify-content-between">
                                                            <a href="#" class="overflow-hidden" style="max-width: 60%; white-space: nowrap; text-overflow: ellipsis;">
                                                                <strong><?php echo $dato['concepto']; ?></strong>
                                                            </a>
                                                            <a href="#">
                                                                <strong>Cod. <?php echo $dato['numero']; ?></strong>
                                                            </a>
                                                        </div>
                                                        <h2 style="min-height: 70px; max-height: 80px"><a href="product-detail?td=p&c=<?php echo trim($dato['numero']); ?>">
                                                                <?php echo $dato['denom']; ?>
                                                            </a></h2>
                                                        <div class="product-price mt-10" style="height: 40px;">
                                                            <span style="font-size: 25px;">$ <?php echo number_format($dato['precio_final'], 2); ?> </span>
                                                            <?php
                                                            if ($dato['bonfija'] > 0) {
                                                            ?>
                                                                <span style="font-size: 18px;" class="old-price">$ <?php echo number_format($dato['prefin'], 2); ?></span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <a href="product-detail?td=p&c=<?php echo trim($dato['numero']) ?>" class="btn w-100 hover-up" style="margin-top: 30px;"><i class="fi-rs-shopping-cart mr-5"></i>Ver producto</a>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <!--End product Wrap-->
                                    </div>
                                </div>
                            </div>
                            <!-- 
                            <div class="tab-pane fade" id="tab-two-1" role="tabpanel" aria-labelledby="tab-two-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-2-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-2">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-three-1" role="tabpanel" aria-labelledby="tab-three-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-3-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-3">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <!--End tab-content-->
                    </div>
                    <!--End Col-lg-9-->
                </div>
            </div>
        </section>

        <!--End Best Sales-->

        <!-- Más vendidos -->
        <!-- <section class="section-padding mb-30">
            <div class="container">
                <div class="row d-flex justify-content-evenly">

                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <h4 class="section-title style-1 mb-30 animated animated">Más vendidos</h4>
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-1.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">le Original Coffee-Mate Coffee Creamer</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-2.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">le Original Coffee-Mate Coffee Creamer</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-3.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">le Original Coffee-Mate Coffee Creamer</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <h4 class="section-title style-1 mb-30 animated animated">Más vistos</h4>
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-4.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">Organic Cage-Free Grade A Large Brown Eggs</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-5.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">Seeds of Change Organic Quinoa, Brown, & Red Rice</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-6.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">Naturally Flavored Cinnamon Vanilla Light Roast Coffee</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <h4 class="section-title style-1 mb-30 animated animated">Nuevos</h4>
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-7.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">Pepperidge Farm Farmhouse Hearty White Bread</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-8.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">Organic Frozen Triple Berry Blend</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-9.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">Oroweat Country Buttermilk Bread</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <h4 class="section-title style-1 mb-30 animated animated">Mejor puntuados</h4>
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-10.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">Foster Farms Takeout Crispy Classic Buffalo Wings</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-11.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">Angie’s Boomchickapop Sweet & Salty Kettle Corn</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="#"><img src="assets/imgs/shop/thumbnail-12.jpg" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="#">All Natural Italian-Style Chicken Meatballs</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        <span>$32.85</span>
                                        <span class="old-price">$33.8</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!--End 4 columns-->

        <?php require_once 'php/components/wp-floating.php'; ?>
        <?php require_once('php/components/footer.php'); ?>

    </main>


    <!-- Vendor JS-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>

    <!-- <script src="assets/js/vendor/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="assets/js/plugins/slick.js"></script>
    <script src="assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="assets/js/plugins/waypoints.js"></script>
    <script src="assets/js/plugins/wow.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="assets/js/plugins/magnific-popup.js"></script>
    <script src="assets/js/plugins/select2.min.js"></script>
    <script src="assets/js/plugins/counterup.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/images-loaded.js"></script>
    <script src="assets/js/plugins/isotope.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="assets/js/plugins/jquery.elevatezoom.js"></script>

    <script src="js/aos.js"></script>

    <!-- Template  JS -->
    <script src="assets/js/main.js?v=4.0"></script>
    <script src="assets/js/shop.js?v=4.0"></script>

    <!-- JS Propios -->
    <script src="js/constants.js"></script>
    <script src="js/view/index.js"></script>

    <!-- Deben llamarse después del index.js -->
    <script src="js/middleware/sucursales.js"></script>

    <?php require_once('php/libs/sweet-alert.php'); ?>
    <script src="js/middleware/footer.js"></script>
    <script src="js/components/header.js"></script>

    <script src="js/components/add-products-pres-cart.js"></script>

</body>

</html>