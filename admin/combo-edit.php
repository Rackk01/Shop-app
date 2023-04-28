<?php
session_start();

require_once('../php/constants.php');

require_once('../php/middleware/empres-config.php');
require_once('../php/middleware/productos.php');
require_once('../php/middleware/combo-producto.php');

if (!isset($_SESSION["SD_USUARIO_ADMIN"])) {
    header('Location: ' . URL_APP . 'admin/login');
    die();
    return;
}

$title = 'Nuevo combo';
if (isset($_GET['num'])) {
    $title = 'Editar combo: Código ' . $_GET['num'];
}

?>

<!DOCTYPE html>

<html lang="es">
<!--begin::Head-->

<head>
    <!-- <base href="../../../"> -->
    <?php require_once('../php/components/tittle-icon-page.php'); ?>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content=", Bootstrap, Bootstrap 5, Angular, VueJs, React, Asp.Net Core, Blazor, Django, Flask &amp; Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="es_AR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content=" - Bootstrap 5 HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content=" | " />

    <!-- ############################################################# -->
    <!-- Para evitar que archivos css/js/imagenes se guarden en caché -->
    <?php require_once('../php/components/meta-head.php'); ?>
    <!-- ############################################################# -->

    <link rel="canonical" href=".com/8" />
    <!--begin::Fonts-->
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used by this page)-->
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="../assets\css\plugins\jquery-ui.css" /> <!-- Autocomplet Jquery Stylesheet-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.css?v=4.0" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!-- Styles Prop. -->
    <link rel="stylesheet" href="../assets/css/modules/styles-maxi.css">
    <link rel="stylesheet" href="../css/libs/sweetAlert.css">
    <link rel="stylesheet" href="../css/disable-input-arrows.css">
</head>
<!--end::Head-->
<!--begin::Body-->

<body data-kt-name="" id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <!-- <script>
		if (document.documentElement) {
			const defaultThemeMode = "system";
			const name = document.body.getAttribute("data-kt-name");
			let themeMode = localStorage.getItem("kt_" + (name !== null ? name + "_" : "") + "theme_mode_value");
			if (themeMode === null) {
				if (defaultThemeMode === "system") {
					themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
				} else {
					themeMode = defaultThemeMode;
				}
			}
			document.documentElement.setAttribute("data-theme", themeMode);
		}
	</script> -->
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header">
                <!--begin::Header container-->
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between">
                    <!-- HEADER INICIO -->
                    <?php require_once('php/components/header.php'); ?>
                    <!-- END HEADER -->
                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::sidebar-->
                <!-- SIDEBAR MENU -->
                <?php require_once('php/components/side-bar-menu.php'); ?>
                <!-- END SIDEBAR MENU -->
                <!--end::sidebar-->

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        <?php echo $title; ?>
                                    </h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Inicio</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">eCommerce</li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Catálogo</li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Combos</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                            </div>
                        </div>

                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!--begin::Form-->
                                <form id="form-combo" class="form d-flex flex-column flex-lg-row">
                                    <!--begin::Aside column-->
                                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                                        <!--begin::Pricing-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Descuento del combo</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Precio base</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="input-precio-base" type="text" name="precioBase" class="form-control mb-2" placeholder="Precio base del combo" readonly />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Suma de los precios de los productos incluidos en el combo.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2">Tipo de descuento
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Seleccione el tipo de descuento que debe llevar el producto."></i>
                                                    </label>
                                                    <!--End::Label-->
                                                    <!--begin::Row-->
                                                    <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                                        <!--begin::Col-->
                                                        <div class="col">
                                                            <!--begin::Option-->
                                                            <label id="id-select-discount-porcentaje" class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                                                <!--begin::Radio-->
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input id="kt_ecommerce_add_product_discount_percentage1" class="form-check-input" type="radio" name="discount_option" value="2" checked />
                                                                </span>
                                                                <!--end::Radio-->
                                                                <!--begin::Info-->
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Procentaje %</span>
                                                                </span>
                                                                <!--end::Info-->
                                                            </label>
                                                            <!--end::Option-->
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="col">
                                                            <!--begin::Option-->
                                                            <label id="id-select-discount-fijo" class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                                <!--begin::Radio-->
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input id="kt_ecommerce_add_product_discount_fixed1" class="form-check-input" type="radio" name="discount_option" value="3" />
                                                                </span>
                                                                <!--end::Radio-->
                                                                <!--begin::Info-->
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Fijo $</span>
                                                                </span>
                                                                <!--end::Info-->
                                                            </label>
                                                            <!--end::Option-->
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Row-->
                                                </div>

                                                <!-- Slider Porcentaje de descuento -->
                                                <div class="mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                                                    <!-- <div class="mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed"> -->
                                                    <label class="form-label">Setea el porcentaje de descuento %</label>
                                                    <div class="d-flex flex-column text-center mb-5">
                                                        <div class="d-flex align-items-start justify-content-center mb-7">
                                                            <span class="fw-bold fs-3x" id="kt_ecommerce_add_product_discount_label">0</span>
                                                            <span class="fw-bold fs-4 mt-1 ms-2">%</span>
                                                        </div>
                                                        <div id="kt_ecommerce_add_product_discount_slider" class="noUi-sm"></div>
                                                        <!-- <input type="number" name="dicsounted_price" class="form-control mb-2" placeholder="Monto descuento fijo" value="$ 00.00" /> -->
                                                    </div>
                                                    <div class="text-muted fs-7">Establecer el porcentaje de descuento que se aplicará sobre el precio base del combo.</div>
                                                </div>

                                                <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed">
                                                    <div class="d-flex flex-column">
                                                        <label class="form-label">Setea el monto de descuento fijo </label>
                                                        <h5 class="my-2 d-inline"><span id="badge-monto-fijo" class="badge badge-primary fs-5">$ 0</span></h5>
                                                    </div>
                                                    <input id="input-fijo" type="number" step="0.01" name="dicsounted_price" class="form-control mb-2" placeholder="Monto descuento fijo" value="$ 00.00" />
                                                    <div class="text-muted fs-7">Establecer el monto de descuento fijo del combo. Al precio base del combo se le restará este monto fijo determinado.</div>
                                                    <!-- <div id="id-help-txt-monto-fijo" class="text-muted fs-7" style="color: IndianRed;"></div> -->
                                                    <!--end::Description-->
                                                </div>
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Precio final</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="input-precio-final" type="text" name="price" class="form-control mb-2" placeholder="Precio final del combo" value="" readonly />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Precio final del combo con la bonificación calculada. Se calcula automáticamente.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                        </div>



                                    </div>
                                    <!--end::Aside column-->

                                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                                            <li class="nav-item">
                                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" id="tab-general" href="#kt_ecommerce_add_product_general">General</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" id="tab-detalle" href="#kt_ecommerce_add_product_detail">Detalle</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" id="tab-imagenes" href="#kt_ecommerce_add_product_image">Imágenes</a>
                                            </li>
                                            <!-- Reviews | Revisiones | Comentarios enviados por los clientes -->
                                            <!-- <li class="nav-item">
												<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_reviews">Revisiones</a>
											</li> -->
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                <div class="d-flex flex-column gap-7 gap-lg-10">

                                                    <!-- GENERAL -->
                                                    <div class="card card-flush py-4">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>General</h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <!--begin::Input group-->
                                                            <!-- <div class="mb-10 fv-row">
                                                                <label class="form-label">Código del combo
                                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="El código del combo es único y autogenerado por el sistema."></i>
                                                                </label>
                                                                <input id="input-codigo-combo" type="number" name="codigo-combo" class="form-control mb-2" readonly />
                                                                <div class="text-muted fs-7"></div>
                                                            </div> -->
                                                            <div class="mb-10 fv-row">
                                                                <label class="form-label">Nombre del combo
                                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="El nombre del combo es obligatorio, debe ser único y lo más descriptivo posible. Máximo permitido 100 caractéres."></i>
                                                                </label>
                                                                <input id="input-nombre-combo" maxlength="100" type="text" name="product_name" class="form-control mb-2" placeholder="Ingrese aquí el nombre del producto..." value="" />
                                                                <div class="text-muted fs-7">El nombre del producto es requerido y debe ser único.</div>
                                                            </div>
                                                            <div class="mb-10 fv-row">
                                                                <label class="form-label">Descripción
                                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="La descripción es obligatoria y debe describir al combo lo mejor posible. Mientras más información tenga, más confianza generará en sus clientes."></i>
                                                                </label>
                                                                <textarea id="textarea-descripcion-combo" class="form-control" data-kt-autosize="false" style="min-height: 120px; resize: none;"></textarea>

                                                                <!-- <textarea id="id-input-product-denom" maxlength="50" type="text" name="product_name" class="form-control mb-2" placeholder="Ingrese aquí el nombre del producto..." value="" /> -->
                                                                <div class="text-muted fs-7">Setea la descripción del producto para una mejor visibildiad y experiencia de usuario.</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card card-flush py-2">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>Vencimiento
                                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Es el estado del producto: Sin estado, el producto se mostrará en el carrito sin ningúna distinción especial."></i>
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <!--end::Select2-->
                                                            <!--begin::Datepicker-->
                                                            <div>
                                                                <label for="input-vencimiento" class="form-label">Ingrese la fecha de vencimiento del combo</label>
                                                                <input class="form-control" type="date" id="kt_ecommerce_add_product_status_datepicker" />
                                                            </div>
                                                            <!--end::Datepicker-->
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <div class="card card-flush py-2">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>Stock</h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Ingrese el stock disponible del combo.</label>
                                                                    <input class="form-control" type="number" id="input-stock-combo" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Stock actualizado</label>
                                                                    <input class="form-control" type="number" id="input-stock-combo-act" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>

                                                </div>
                                            </div>
                                            <!--end::Tab pane-->

                                            <div class="tab-pane fade" id="kt_ecommerce_add_product_detail" role="tab-panel">

                                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                                    <div class="card card-flush py-4">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>Productos</h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class="mb-5 row">
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Producto
                                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Búsqueda por código del producto o denominación."></i>

                                                                    </label>
                                                                    <input id="input-producto" type="text" class="form-control mb-2" placeholder="Ingrese y seleccione" />
                                                                    <div class="text-muted fs-7">Búsqueda de producto para agregar al combo.</div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-5 row">
                                                                <div class="col-md-8">
                                                                    <label class="form-label">Presentación</label>
                                                                    <select class="form-control mb-2" name="presentacion" id="select-presentacion">

                                                                    </select>
                                                                    <div class="text-muted fs-7">Búsqueda de producto para agregar al combo.</div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Cantidad</label>
                                                                    <input id="input-cantidad" type="number" class="form-control mb-2" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-5 d-flex justify-content-end">
                                                                <span id="button-add-product" class="btn btn-primary">
                                                                    Agregar <i class="fa fa-plus"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="contenedor-productos" class="d-flex flex-wrap">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Tab pane-->

                                            <div class="tab-pane fade" id="kt_ecommerce_add_product_image" role="tab-panel">

                                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                                    <div class="card card-flush py-4">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>Imágen principal</h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body text-center pt-0">
                                                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                                <div id="div-img-principal" class="image-input-wrapper w-150px h-150px" style="background-size: contain; background-position: center;"></div>

                                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imágen">
                                                                    <i class="bi bi-pencil-fill fs-7" style="position: inherit; right: 5px;"></i>
                                                                    <input id="id-image-principal" data-idimage="0" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="avatar_remove" />
                                                                </label>
                                                                <span class="btn btn-icon btn-circle btn-active-color-danger w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Eliminar imágen">
                                                                    <i class="bi bi-x fs-2"></i>
                                                                </span>
                                                            </div>
                                                            <div class="text-muted fs-7">Formatos aceptados: *.png, *.jpg, *.jpeg. Es la img más importante y descriptiva de tu producto.</div>
                                                        </div>
                                                    </div>

                                                    <div class="card card-flush py-4">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>Imágen 2</h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body text-center pt-0">
                                                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                                <div id="div-img-2" class="image-input-wrapper w-150px h-150px" style="background-size: contain; background-position: center;"></div>
                                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imágen">
                                                                    <i class="bi bi-pencil-fill fs-7" style="position: inherit; right: 5px;"></i>
                                                                    <input id="id-image-2" data-idimage="0" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="avatar_remove" />
                                                                </label>
                                                                <span class="btn btn-icon btn-circle btn-active-color-danger w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                                    <i class="bi bi-x fs-2"></i>
                                                                </span>
                                                            </div>
                                                            <div class="text-muted fs-7">Formatos aceptados: *.png, *.jpg, *.jpeg.</div>
                                                        </div>
                                                    </div>

                                                    <div class="card card-flush py-4">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>Imágen 3</h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-body text-center pt-0">
                                                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                                <div id="div-img-3" class="image-input-wrapper w-150px h-150px" style="background-size: contain; background-position: center;"></div>
                                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imágen">
                                                                    <i class="bi bi-pencil-fill fs-7" style="position: inherit; right: 5px;"></i>
                                                                    <input id="id-image-3" data-idimage="0" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="avatar_remove" />
                                                                </label>
                                                                <span class="btn btn-icon btn-circle btn-active-color-danger w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                                    <i class="bi bi-x fs-2"></i>
                                                                </span>
                                                            </div>
                                                            <div class="text-muted fs-7">Formatos aceptados: *.png, *.jpg, *.jpeg.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Tab pane-->
                                        </div>
                                        <!--end::Tab content-->
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Button-->
                                            <!-- <a href="product-list" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a> -->
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                                <span class="indicator-label">Guardar cambios</span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                    </div>
                                    <!--end::Main column-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->

                    <!--begin::Media-->
                    <!-- Card con dropzone en display none para arreglar error de plugins -->
                    <div class="card card-flush py-4" style="display: none;">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Imágenes del producto</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="fv-row mb-2">
                                <div class="dropzone" id="kt_ecommerce_add_product_media">
                                    <div class="dz-message needsclick">
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">Arrastra las imáenes aquí o clickea para seleccionar.</h3>
                                            <span class="fs-7 fw-semibold text-gray-400">Máximo 4 img. Formatos de img aceptados: *.png, *.jpg and *.jpeg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-muted fs-7">Setea las imágenes restantes del producto.</div>
                        </div>
                    </div>
                    <!--end::Media-->

                    <!--begin::Footer-->
                    <?php require_once('php/components/footer.php'); ?>
                    <!--end::Footer-->

                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Javascript-->
    <script>
        // var hostUrl = "assets/";
    </script>
    <!-- JS Propios -->
    <script src="../js/constants.js"></script>

    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used by this page)-->
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
    <script src="../assets\js\plugins\jquery-ui.js"></script> <!-- Autocomplete Jquery Widget-->
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used by this page)-->
    <script src="assets/js/custom/apps/ecommerce/catalog/save-product.js"></script>
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

    <!-- JS Propios -->
    <?php require_once('../php/libs/sweet-alert.php'); ?>
    <script src="../js/util/methods.js"></script>
    <script src="js/view/combo-edit.js"></script>

    <!-- <script src="../js/constants.js"></script> -->
    <script src="js/components/close-session.js"></script>
</body>
<!--end::Body-->