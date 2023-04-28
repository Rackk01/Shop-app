<?php
session_start();
require_once('../php/constants.php');

if (!isset($_SESSION["SD_USUARIO_ADMIN"])) {
    header('Location: ' . URL_APP . 'admin/login');
    die();
    return;
}

require_once('../php/middleware/empres-config.php');
require_once('../php/middleware/productos.php');
require_once('../php/middleware/pedidos.php');
require_once('../php/middleware/cli-web.php');
require_once('../php/util/methods.php');


?>

<!DOCTYPE html>
<html lang="es">

<!--begin::Head-->

<head>
    <!-- <base href="../../../"> -->
    <?php require_once('../php/components/tittle-icon-page.php') ?>

    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content=", Bootstrap, Bootstrap 5, Angular, VueJs, React, Asp.Net Core, Blazor, Django, Flask &amp; Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used by this page)-->
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
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
                    <!--begin::sidebar mobile toggle-->

                    <!-- HEADER INICIO -->
                    <?php require_once('php/components/header.php'); ?>
                    <!-- END HEADER -->

                    <!--end::sidebar mobile toggle-->
                    <!--begin::Mobile logo-->
                    <!-- <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
						<a href="../../demo1/dist/index.html" class="d-lg-none">
							<img alt="Logo" src="assets/media/logos/default-small.svg" class="h-30px" />
						</a>
					</div> -->
                    <!--end::Mobile logo-->

                    <!--begin::Header wrapper-->

                    <!--end::Header wrapper-->
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Listado de clientes</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
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
                                        <li class="breadcrumb-item text-muted">Configuración</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->

                                <!-- <div class="d-flex align-items-center gap-2 gap-lg-3">
									<div class="m-0">
										<a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
											<span class="svg-icon svg-icon-6 svg-icon-muted me-1">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
												</svg>
											</span>
											Filter
										</a>
										<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62cfa7b57e592">
											<div class="px-7 py-5">
												<div class="fs-5 text-dark fw-bold">Filter Options</div>
											</div>
											<div class="separator border-gray-200"></div>
											<div class="px-7 py-5">
												<div class="mb-10">
													<label class="form-label fw-semibold">Status:</label>
													<div>
														<select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62cfa7b57e592" data-allow-clear="true">
															<option></option>
															<option value="1">Approved</option>
															<option value="2">Pending</option>
															<option value="2">In Process</option>
															<option value="2">Rejected</option>
														</select>
													</div>
												</div>
												<div class="mb-10">
													<label class="form-label fw-semibold">Member Type:</label>
													<div class="d-flex">
														<label class="form-check form-check-sm form-check-custom form-check-solid me-5">
															<input class="form-check-input" type="checkbox" value="1" />
															<span class="form-check-label">Author</span>
														</label>
														<label class="form-check form-check-sm form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="2" checked="checked" />
															<span class="form-check-label">Customer</span>
														</label>
													</div>
												</div>
												<div class="mb-10">
													<label class="form-label fw-semibold">Notifications:</label>
													<div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
														<input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
														<label class="form-check-label">Enabled</label>
													</div>
												</div>
												<div class="d-flex justify-content-end">
													<button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
													<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
												</div>
											</div>
										</div>
									</div>
									<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
								</div> -->

                            </div>
                        </div>

                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!--begin::Card-->
                                <div class="card card-flush">
                                    <!--begin::Card body-->
                                    <div class="card-body">
                                        <!--begin:::Tabs-->
                                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
                                            <!--begin:::Tab item-->
                                            <li class="nav-item">
                                                <a id="settings_general_button-tab" class="nav-link text-active-primary pb-5 active" data-bs-toggle="tab" href="#kt_ecommerce_settings_general">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen001.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->General</a>
                                            </li>
                                            <!--end:::Tab item-->
                                            <!--begin:::Tab item-->
                                            <li class="nav-item">
                                                <a id="settings_store_button-tab" class="nav-link text-active-primary pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_store">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm004.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor" />
                                                            <path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Tienda</a>
                                            </li>
                                            <!--end:::Tab item-->
                                            <!--begin:::Tab item-->
                                            <li class="nav-item">
                                                <a id="settings_cobros_button-tab" class="nav-link text-active-primary pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_cobros">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm004.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg fill="none" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve" stroke="#ffffff">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path opacity="0.3" fill="currentColor" d="M256,0C114.609,0,0,114.609,0,256s114.609,256,256,256s256-114.609,256-256S397.391,0,256,0z M256,472 c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z"></path>
                                                                <path opacity="0.3" fill="currentColor" d="M267.922,351.734V384h-25.719v-30.406c-19.516-0.609-39.047-6.25-50.203-13.469l8.375-29.766 c12.406,7.531,29.438,13.781,48.344,13.781c19.812,0,33.141-9.703,33.141-24.438c0-14.391-10.828-23.156-34.078-31.641 c-32.219-11.906-53.609-27.25-53.609-56.094c0-26.938,18.609-47.938,49.891-53.562V128h25.406v28.828 c19.516,0.625,32.859,5.641,42.781,10.656l-8.375,28.828c-7.438-3.75-21.078-10.969-42.141-10.969 c-21.703,0-29.453,11.281-29.453,21.938c0,12.844,11.156,20.359,37.812,30.719C304.797,251.156,320,268.062,320,296.281 C320,322.922,301.703,346.094,267.922,351.734z"></path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Cobros</a>
                                            </li>
                                            <!--end:::Tab item-->
                                            <!--begin:::Tab item-->
                                            <li class="nav-item">
                                                <a id="settings_cobros_button-tab" class="nav-link text-active-primary pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_products">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm004.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <title>product</title>
                                                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <g id="icon" fill="none" transform="translate(64.000000, 34.346667)">
                                                                        <path opacity="0.3" fill="currentColor" d="M192,7.10542736e-15 L384,110.851252 L384,332.553755 L192,443.405007 L1.42108547e-14,332.553755 L1.42108547e-14,110.851252 L192,7.10542736e-15 Z M127.999,206.918 L128,357.189 L170.666667,381.824 L170.666667,231.552 L127.999,206.918 Z M42.6666667,157.653333 L42.6666667,307.920144 L85.333,332.555 L85.333,182.286 L42.6666667,157.653333 Z M275.991,97.759 L150.413,170.595 L192,194.605531 L317.866667,121.936377 L275.991,97.759 Z M192,49.267223 L66.1333333,121.936377 L107.795,145.989 L233.374,73.154 L192,49.267223 Z" id="Combined-Shape"> </path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Productos</a>
                                            </li>
                                            <!--end:::Tab item-->
                                        </ul>
                                        <!--end:::Tabs-->
                                        <!--begin:::Tab content-->
                                        <div class="tab-content" id="myTabContent">
                                            <!--begin:::Tab pane-->
                                            <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">
                                                <!--begin::Form-->
                                                <form id="settings_general_form" class="form">
                                                    <!--begin::Heading-->
                                                    <div class="row mb-7">
                                                        <div class="col-md-9 offset-md-3">
                                                            <h2>Configuración general</h2>
                                                        </div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Título de la pestaña</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Título que se muestra en la pestaña del navegador."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputTittlePest" type="text" class="form-control form-control-solid" name="title_pest" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Nombre de la empresa</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Nombre de la empresa."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputNameEmpres" type="text" class="form-control form-control-solid" name="name_empres" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Descripción</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Descripción de la empresa."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <textarea id="idTextAreaDescEmpres" class="form-control form-control-solid" name="desc_empres" maxlength="800" style="resize: none;"></textarea>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Razón social</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Razón social de la empresa."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputRazonEmpres" type="text" class="form-control form-control-solid" name="razon_empres" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Heading-->
                                                    <div class="row mb-7">
                                                        <div class="col-md-9 offset-md-3">
                                                            <h2>Contacto</h2>
                                                        </div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Link Facebook</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Url al perfil de Facebook."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputUrlFacebook" type="url" class="form-control form-control-solid" name="url_facebook" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Link Instagram</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Url al perfil de Instagram."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputUrlInstagram" type="url" class="form-control form-control-solid" name="url_instagram" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Link Twitter</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Url al perfil de Twitter."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputUrlTwitter" type="url" class="form-control form-control-solid" name="url_twitter" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Link Youtube</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Url al perfil de Youtube."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputUrlYoutube" type="url" class="form-control form-control-solid" name="url_youtube" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Action buttons-->
                                                    <div class="row py-5">
                                                        <div class="col-md-9 offset-md-3">
                                                            <div class="d-flex">
                                                                <!--begin::Button-->
                                                                <button type="button" class="btn btn-light me-3">Salir</button>
                                                                <!--end::Button-->
                                                                <!--begin::Button-->
                                                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                                    <span class="indicator-label">Guardar cambios</span>
                                                                </button>
                                                                <!--end::Button-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Action buttons-->
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end:::Tab pane-->
                                            <!--begin:::Tab pane-->
                                            <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                                                <!--begin::Form-->
                                                <form id="settings_store_form" class="form">
                                                    <!--begin::Heading-->
                                                    <div class="row mb-7">
                                                        <div class="col-md-9 offset-md-3">
                                                            <h2>Configuración de la tienda</h2>
                                                        </div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Costo de envío</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Costo de envío en caso de compra a domicilio."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9 d-flex">
                                                            <!--begin::Input-->
                                                            <input id="idInputCostoEnvio" type="number" step="0.01" class="form-control form-control-solid" name="costo_envio" value="" />
                                                            <span id="idBadgeCostoEnvio" class="mx-2 badge badge-light-primary col-md-3 text-center">$ 0</span>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Tope envío gratis</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Tope a alcanzar para que el pedido sea gratis. Colocar en 0 para deshabilitar envío gratis."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9 d-flex">
                                                            <!--begin::Input-->
                                                            <input id="idInputTopeEnvio" type="number" step="0.01" class="form-control form-control-solid" name="tope_envio" value="" />
                                                            <span id="idBadgeTopeEnvio" class="mx-2 badge badge-light-primary col-md-3 text-center">$ 0</span>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Descuento general</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Descuento que se aplica al total del pedido"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9 d-flex">
                                                            <!--begin::Input-->
                                                            <input id="idInputDescuentoGeneral" type="number" step="0.01" class="form-control form-control-solid" name="descuento_general" value="" />
                                                            <span id="idBadgeDescuentoGeneral" class="mx-2 badge badge-light-primary col-md-3 text-center">0 %</span>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Calendario de envío</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Si desea trabajar con calendario de envío para los pedidos"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <select id="idSelectCalendarioEnvio" class="form-control form-control-solid" name="calendario_envio">
                                                                <option value="1">Si</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Contar especiales</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Si desea mostrar entre () la cantidad de artículos especiales"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <select id="idSelectContarEspeciales" class="form-control form-control-solid" name="contar_especiales">
                                                                <option value="1">Si</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Action buttons-->
                                                    <div class="row py-5">
                                                        <div class="col-md-9 offset-md-3">
                                                            <div class="d-flex">
                                                                <!--begin::Button-->
                                                                <button type="button" class="btn btn-light me-3">Salir</button>
                                                                <!--end::Button-->
                                                                <!--begin::Button-->
                                                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                                    <span class="indicator-label">Guardar cambios</span>
                                                                </button>
                                                                <!--end::Button-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Action buttons-->
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end:::Tab pane-->
                                            <!--begin:::Tab pane-->
                                            <div class="tab-pane fade" id="kt_ecommerce_settings_cobros" role="tabpanel">
                                                <!--begin::Form-->
                                                <form id="settings_cobros_form" class="form">
                                                    <!--begin::Heading-->
                                                    <div class="row mb-7">
                                                        <div class="col-md-9 offset-md-3">
                                                            <h2>Mercado Pago</h2>
                                                        </div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Token de acceso</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Token de acceso de Mercado Pago"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputTokenMp" type="text" class="form-control form-control-solid" name="toke_mp" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Clave pública</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Clave pública de Mercado Pago"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputKeyMp" type="text" class="form-control form-control-solid" name="key_mp" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Recargo Mercado Pago</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Recargo que se aplica por pagar con Mercado Pago."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9 d-flex">
                                                            <!--begin::Input-->
                                                            <input id="idInputRecargoMp" type="number" step="0.01" class="form-control form-control-solid" name="recargo_mp" value="" />
                                                            <span id="idBadgeRecargoMp" class="mx-2 badge badge-light-primary col-md-3 text-center">0 %</span>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Heading-->
                                                    <div class="row mb-7">
                                                        <div class="col-md-9 offset-md-3">
                                                            <h2>Transferencias</h2>
                                                        </div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>CBU</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="CBU de la cuenta a la que se harán los pagos de las ventas con transferencia."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputTransferenciaCbu" type="text" class="form-control form-control-solid" name="transferencia_cbu" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-end">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Alias</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Alias de la cuenta a la que se harán los pagos de las ventas con transferencia"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--begin::Input-->
                                                            <input id="idInputTransferenciaAlias" type="text" class="form-control form-control-solid" name="transferencia_alias" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Action buttons-->
                                                    <div class="row py-5">
                                                        <div class="col-md-9 offset-md-3">
                                                            <div class="d-flex">
                                                                <!--begin::Button-->
                                                                <button type="button" class="btn btn-light me-3">Salir</button>
                                                                <!--end::Button-->
                                                                <!--begin::Button-->
                                                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                                    <span class="indicator-label">Guardar cambios</span>
                                                                </button>
                                                                <!--end::Button-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Action buttons-->
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end:::Tab pane-->
                                            <!--begin:::Tab pane-->
                                            <div class="tab-pane fade" id="kt_ecommerce_settings_products" role="tabpanel">
                                                <!--begin::Form-->
                                                <form id="settings_products_form" class="form">
                                                    <!--begin::Heading-->
                                                    <div class="row mb-7">
                                                        <div class="col-md-9 offset-md-3">
                                                            <h2>Estado de productos</h2>
                                                        </div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-7">
                                                        <!-- <div class="col-md-3 text-md-end"> -->
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Detalle del estado</span>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Ingrese los datos del nuevo estado del producto."></i>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!-- </div> -->
                                                        <div class="col-md-5">
                                                            <!--begin::Input-->
                                                            <input id="input_nombre_estado" type="text" class="form-control form-control-solid" placeholder="Nombre del estado. Ej: Nuevo" name="" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <div class="col-md-5">
                                                            <!--begin::Input-->
                                                            <select name="" id="select_color_estado" class="form-control form-control-solid">
                                                                <option value="salmon">Salmón</option>
                                                                <option value="darkred">Rojo Oscuro</option>
                                                                <option value="coral">Coral</option>
                                                                <option value="orange">Naranja</option>
                                                                <option value="orchid">Orquídea</option>
                                                                <option value="mediumpurple">Morado</option>
                                                                <option value="limegreen">Verde Lima</option>
                                                                <option value="green">Verde</option>
                                                                <option value="turquoise">Turquesa</option>
                                                                <option value="gray">Gris</option>
                                                            </select>
                                                            <!--end::Input-->
                                                        </div>
                                                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                                                            <span id="badge_color" class="text-white p-2 badge badge-salmon"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-12">
                                                            <!--begin::Input-->
                                                            <textarea id="textarea_descripcion_estado" placeholder="Descripción sobre a qué hace referencia ese estado." maxlength="150" class="form-control form-control-solid resize-none"></textarea>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Action buttons-->
                                                    <div class="row py-5">
                                                        <div class="col-md-9 offset-md-3">
                                                            <div class="d-flex justify-content-end">
                                                                <!--begin::Button-->
                                                                <!-- <button type="button" class="btn btn-light me-3">Salir</button> -->
                                                                <!--end::Button-->
                                                                <!--begin::Button-->
                                                                <span data-type="insert" id="btn_add_state" class="btn btn-primary">
                                                                    <i class="fa fa-plus"></i> Agregar
                                                                </span>
                                                                <!--end::Button-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Action buttons-->
                                                </form>
                                                <!--end::Form-->
                                                <div>
                                                    <!-- begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="states_table">
                                                        <thead>
                                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                                <th class="min-w-50px">Nombre</th>
                                                                <th class="min-w-150px">Descripción</th>
                                                                <th class="min-w-60px text-center">Vista Cliente</th>
                                                                <th class="min-w-60px text-center">Vista Admin</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="fw-semibold text-gray-600">
                                                            <?php
                                                            $productStates = json_decode(getAllEditableStatesOfProducts(), true);
                                                            foreach ($productStates as $state) { ?>
                                                                <tr class="text-gray-400 fw-bold gs-0">
                                                                    <td data-id="<?php echo $state['id_estado'] ?>" data-color="<?php echo $state['class_color'] ?>"><?php echo $state['descripcion'] ?></td>
                                                                    <td class="px-2"><?php echo $state['descrip'] ?></td>
                                                                    <td class="text-center">
                                                                        <span class="text-white badge badge-<?php echo $state['class_color'] ?>"><?php echo $state['descripcion'] ?></span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="badge badge-light-<?php echo $state['class_color'] ?>"><?php echo $state['descripcion'] ?></span>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <!--end::Table -->
                                                </div>
                                            </div>
                                            <!--end:::Tab pane-->
                                        </div>
                                        <!--end:::Tab content-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <!--begin::Footer-->
                    <?php require_once('php/components/footer.php'); ?>
                    <!--end::Footer-->
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
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used by this page)-->
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used by this page)-->
    <script src="assets/js/custom/apps/ecommerce/sales/listing.js"></script>
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/apps/chat/chat.js"></script>
    <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>

    <script src="../js/constants.js"></script>
    <script src="../js/util/methods.js"></script>
    <script src="js/components/close-session.js"></script>
    <script src="js/view/settings.js"></script>
    <script src="js/setData.js"></script>
    <?php require_once('../php/libs/sweet-alert.php'); ?>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>