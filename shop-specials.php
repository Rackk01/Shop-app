<?php
session_start();
// unset($_SESSION['SD_CART']);
// echo json_encode($_SESSION['SD_CART'], true);
// return;

$orderBy = 'denom';
if (isset($_SESSION['SD_ORDER_PRODUCTS_BY'])) {
    $orderBy = $_SESSION['SD_ORDER_PRODUCTS_BY']; // 1 denom desc | 2 denom asc | 3 price low first | 4 price hight first
}
// unset($_SESSION['SD_ORDER_PRODUCTS_BY']);

require_once('php/constants.php');

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/productos.php');

#region Datos paginación ####################################################################################################
$limitProductoForPage = 10;
$pagActual = 1;
if (isset($_SESSION['SD_NUM_PAGE_INDEX'])) {
    $pagActual = intval($_SESSION['SD_NUM_PAGE_INDEX']);
    // $_SESSION['SD_NUM_PAGE_INDEX'] = 1;
}
#endregion ####################################################################################################

require_once('php/util/methods.php');

#region Validación de datos que se deben recibir por GET ==========================================================================
// if (!isset($_GET['si'])) {
//     /*
//     ci --> Special Id
//     */
//     $tit = 'Ooops!';
//     $msj = 'El enlace en el que intenta acceder no se encuentra disponible.
//         Visite la página de inicio y contáctenos sobre cualquier duda!';
//     $array = array(
//         'tit' => $tit,
//         'msj' => $msj
//     );

//     $_SESSION["SD_ERROR"] = json_encode($array);

//     header('Location: ' . URL_APP . 'page-error-404.php');
//     die();
// }
#endregion ==========================================================================

$dataArrayProductos = '';
$dataArrayAmountForCategories = '';
$amount = 0;
$amountOfCategories = 0;

$totalAmountOfPorductsCategories = 0;

$idSpecialProduct = 0;
if (!isset($_GET['si'])) {
    /* Si no viene seteado el state id (id del estado del producto), entonces corresponde que se 
    búsquen todos los productos especiales, exceptuando siempre los id_estado = 4 ya que estos corresponden
    a los productos que no tienen estado aseginado (sin estado)
    */
    $idSpecialProduct = 9999;
} else {
    $idSpecialProduct = intval(trim($_GET['si']));
}

// echo $idSpecialProduct;
// return;

$dataArrayProductos = getAllProductsSpecialsForIdState($idSpecialProduct, $orderBy);
$amount = count(json_decode($dataArrayProductos, true));

$dataArrayAmountForCategories = getAmountOfCategoriesForStateId($idSpecialProduct);
// echo json_encode($dataArrayAmountForCategories);
// return;

if ($dataArrayAmountForCategories == '0' || $dataArrayAmountForCategories == 0) {
    $amountOfCategories = 0; // count(json_decode($dataArrayAmountForCategories, true));
} else {
    $amountOfCategories = count(json_decode($dataArrayAmountForCategories, true));
}

if ($amountOfCategories > 0) {
    foreach (json_decode($dataArrayAmountForCategories, true) as $dato) {
        $amountOfCategories += intval($dato['count']);
    }
}

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

    <!-- Styles Prop. -->
    <link rel="stylesheet" href="assets/css/modules/styles-maxi.css">
    <link rel="stylesheet" href="css/libs/sweetAlert.css">
    <link rel="stylesheet" href="css/disable-input-arrows.css">

</head>

<body>

    <!-- Preloader Start -->
    <!-- <?php //require_once('php/components/preloader-start.php'); 
            ?> -->

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
                                <h3 class="title-detail"><a href="shop-product-right.html" class="text-heading">Seeds of Change Organic Quinoa, Brown</a></h3>
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

        <!-- Cabecera de búsqueda -->
        <div class="page-header mt-10 mb-10">
            <div class="container">
                <!-- <div class="archive-header" style="background: url(src/img/blog/header-bg.png) no-repeat center center;"> -->
                <div class="archive-header" style="background: url(src/img/blog/banner-tech-1.1.jpg) no-repeat center center; max-height: 110px;">
                    <div class="row align-items-center">
                        <div class="col-xl-5">
                            <h4 class="mb-5">
                                Especiales
                                <?php
                                if (isset($_GET['spde']))
                                    echo ': ' . $_GET['spde'];
                                ?>
                            </h4>
                            <!-- <div class="breadcrumb">
                                <a href="index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> Shop
                                <span></span> Especiales
                                <span></span>
                            </div> -->
                        </div>
                        <!-- <div class="col-xl-9 text-end d-none d-xl-block">
                            <ul class="tags-list">
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Cabbage</a>
                                </li>
                                <li class="hover-up active">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Broccoli</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Artichoke</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Celery</a>
                                </li>
                                <li class="hover-up mr-0">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Spinach</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-30">
            <div class="row">
                <div class="col-12">

                    <div class="page-header breadcrumb-wrap">
                        <div class="container">
                            <div class="breadcrumb">
                                <a href="index" rel="nofollow">HOME</a>

                                <?php
                                if ($amountOfCategories > 0) {
                                    // echo $dataArrayProductos;
                                    foreach (json_decode($dataArrayAmountForCategories, true) as $dato) {
                                ?>
                                        <span></span>
                                        <a href="shop?is=<?php echo $idSpecialProduct; ?>&ci=<?php echo $dato['rubro']; ?>&cc=<?php echo $dato['concepto']; ?>">
                                            <?php
                                            echo $dato['concepto'] . ' (' . $dato['count'] . ')'
                                            ?>
                                        </a>
                                    <?php
                                    }
                                } else {
                                    if (isset($_GET['cc'])) {
                                    ?>
                                        <span></span>
                                <?php
                                        echo trim($_GET['cc']) . ' (' . $amount . ')';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Hemos encontrado .... -->
                    <!-- <div class="shop-product-fillter" style="padding-top: 20px;"> -->
                    <div class="shop-product-fillter" style="padding-top: 3px; padding-bottom: 3px;">
                        <div class="totall-product">
                            <p>
                                Encontramos
                                <strong class="text-brand">
                                    <?php
                                    // if ($amountOfCategories > 0) {
                                    //     echo $amountOfCategories;
                                    // } else {
                                    //     echo $amount;
                                    // }
                                    echo count(json_decode($dataArrayProductos, true));
                                    ?>
                                </strong>
                                productos!
                            </p>
                        </div>

                        <!-- #################################################################################################### -->
                        <!-- Paginación Top-->
                        <!-- <div class="pagination-area mt-20 mb-20"> -->
                        <?php
                        if ($amount > 0) {
                        ?>
                            <div class="pagination-area" style="padding-top: 3px; padding-bottom: 3px;">
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
                        <?php
                        }
                        ?>
                        <!-- End Paginación Top-->
                        <!-- #################################################################################################### -->

                        <!-- Búsqueda y Orden -->
                        <?php
                        if ($amountOfCategories > 0 || $amount > 0) {
                        ?>
                            <div class="sort-by-product-area">

                                <!-- <div class="sort-by-cover mr-10">
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
                            </div> -->

                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Orden:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <?php
                                            if ($orderBy == 'denom') {
                                            ?>
                                                <span> A => Z <i class="fi-rs-angle-small-down"></i></span>
                                            <?php
                                            } else if ($orderBy == 'denom DESC') {
                                            ?>
                                                <span> Z => A <i class="fi-rs-angle-small-down"></i></span>
                                            <?php
                                            } else if ($orderBy == 'prefin') {
                                            ?>
                                                <span> Menor precio <i class="fi-rs-angle-small-down"></i></span>
                                            <?php
                                            } else if ($orderBy == 'prefin DESC') {
                                            ?>
                                                <span> Mayor precio <i class="fi-rs-angle-small-down"></i></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <?php
                                            if ($orderBy == 'denom') {
                                            ?>
                                                <li><a class="active" onclick="orderShopBy('nameAsc'); return false;">A => Z</a></li>
                                                <li><a onclick="orderShopBy('nameDes'); return false;">Z => A</a></li>
                                                <li><a onclick="orderShopBy('priceLowFirst'); return false;">Precio: Menores primero</a></li>
                                                <li><a onclick="orderShopBy('priceHigFirst'); return false;">Precio: Mayores primero</a></li>
                                            <?php
                                            } else if ($orderBy == 'denom DESC') {
                                            ?>
                                                <li><a onclick="orderShopBy('nameDes'); return false;">A => Z</a></li>
                                                <li><a class="active" onclick="orderShopBy('nameAsc'); return false;">Z => A</a></li>
                                                <li><a onclick="orderShopBy('priceLowFirst'); return false;">Precio: Menores primero</a></li>
                                                <li><a onclick="orderShopBy('priceHigFirst'); return false;">Precio: Mayores primero</a></li>
                                            <?php
                                            } else if ($orderBy == 'prefin') {
                                            ?>
                                                <li><a onclick="orderShopBy('nameDes'); return false;">A => Z</a></li>
                                                <li><a onclick="orderShopBy('nameAsc'); return false;">Z => A</a></li>
                                                <li><a class="active" onclick="orderShopBy('priceLowFirst'); return false;">Precio: Menores primero</a></li>
                                                <li><a onclick="orderShopBy('priceHigFirst'); return false;">Precio: Mayores primero</a></li>
                                            <?php
                                            } else if ($orderBy == 'prefin DESC') {
                                            ?>
                                                <li><a onclick="orderShopBy('nameDes'); return false;">A => Z</a></li>
                                                <li><a onclick="orderShopBy('nameAsc'); return false;">Z => A</a></li>
                                                <li><a onclick="orderShopBy('priceLowFirst'); return false;">Precio: Menores primero</a></li>
                                                <li><a class="active" onclick="orderShopBy('priceHigFirst'); return false;">Precio: Mayores primero</a></li>
                                            <?php
                                            }
                                            ?>
                                            <!-- <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li> -->
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- Grid de productos -->
                    <div class="row product-grid">

                        <?php
                        if ($amount > 0) {

                            $amountRepeat = 0;
                            $qwert = intval($pagActual) * intval($limitProductoForPage);

                            foreach (json_decode($dataArrayProductos, true) as $dato) {
                                if ($amountRepeat <= ($qwert + $limitProductoForPage) && $amountRepeat >= ($qwert - $limitProductoForPage)) {
                        ?>
                                    <!-- Product card -->
                                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="product-detail?td=p&c=<?php echo trim($dato['numero']); ?>">
                                                        <!-- <img class="default-img" src="assets/imgs/shop/product-1-1.jpg" alt="" />
                                                    <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt="" /> -->
                                                        <?php
                                                        $urlImage = 'assets/imgs/shop/product-1-1.jpg';
                                                        if (file_exists('src/img/productos/' . $dato['url'])) {
                                                            $urlImage = 'src/img/productos/' . $dato['url'];
                                                        } else {
                                                            $urlImage = 'assets/imgs/shop/product-1-1.jpg';
                                                        }
                                                        ?>

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
                                                    <a href="product-detail?td=p&c=<?php echo trim($dato['numero']); ?>">
                                                        <?php echo trim($dato['denom']); ?>
                                                    </a>
                                                </h2>

                                                <!-- Puntuación Rate -->
                                                <!-- <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div> -->

                                                <!-- <div>
                                                <span class="font-small text-muted">By <a href="vendor-details-1.html">Food</a></span>
                                            </div> -->

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
                                                        <span id="id-span-precio-present-con-bonifi-card-<?php echo trim($dato['numero']); ?>" style="font-size: 24px;">
                                                            $
                                                            <?php
                                                            // echo number_format($preciofinalpresentconbonifi,2);
                                                            // echo '<br>';
                                                            // echo number_format($dato['precio_final'],2);
                                                            // echo '<br>';

                                                            // echo '----------------------';
                                                            // echo '<br>';

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
                                                            <span id="id-span-precio-present-sin-bonifi-card-<?php echo trim($dato['numero']); ?>" class="old-price">
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
                                                    <!-- <div class="add-cart">
                                                    <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                </div> -->
                                                </div>

                                                <div class="product-card-bottom">
                                                    <div class="detail-qty border radius" style="max-width: 80px; padding: 0;">
                                                        <!-- <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                    <span id="id-span-cantidad-<?php echo trim($dato['numero']); ?>" class="qty-val">1</span>
                                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a> -->
                                                        <a onclick="qtyDown(<?php echo trim($dato['numero']); ?>); return false;" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                        <!-- <span id="id-span-cantidad-<?php echo trim($dato['numero']); ?>" class="qty-val">1</span> -->
                                                        <input type="number" id="id-span-cantidad-<?php echo trim($dato['numero']); ?>" class="qty-val class-qty-val" style="width:74px; height:100%; border:0; color:#7E7E7E; padding-left: 0px; text-align: center;" value="1" min="1">
                                                        <a onclick="qtyUp(<?php echo trim($dato['numero']); ?>); return false;" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                    </div>
                                                    <div class="add-cart" style="height: 48px;">
                                                        <a id="id-href-addproductcart-<?php echo trim($dato['numero']); ?>" class="add" style="height: 48px; display: flex; align-items: center;" onclick="addProductToCart(this); return false;" data-num=<?php echo trim($dato['numero']); ?> data-denom="<?php echo trim($dato['denom']); ?>" data-stopro=<?php echo trim($dato['stopro']); ?> data-stoact=<?php echo trim($dato['stoact']); ?> data-idestado=<?php echo trim($dato['id_estado']); ?> data-prefin=<?php echo trim($dato['prefin']); ?> data-preciofinal=<?php echo trim($dato['precio_final']); ?> data-bonfija=<?php echo trim($dato['bonfija']); ?> data-idpresentacion=<?php echo $codpres; ?> data-pesopres=<?php echo $pesopres; ?> data-preciofinalpresentconbonifi=<?php echo $preciofinalpresentconbonifi; ?>>
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
                    </div>

                    <!-- #################################################################################################### -->
                    <!-- Paginación Bot-->
                    <?php
                    if ($amount > 0) {
                    ?>
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
                    <?php
                    }
                    ?>
                    <!-- End Paginación Bot-->
                    <!-- #################################################################################################### -->
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
    <!-- <script src="js/view/index.js"></script> -->

    <?php require_once('php/libs/sweet-alert.php'); ?>
    <script src="js/middleware/footer.js"></script>


    <!-- Deben llamarse después del index.js -->
    <script src="js/view/shop.js"></script>
    <script src="js/components/add-products-pres-cart.js"></script>

    <script src="js/components/header.js"></script>

    <script src="js/middleware/sucursales.js"></script>

    <script src="js/util/pagination-ordering.js"></script>

</body>

</html>