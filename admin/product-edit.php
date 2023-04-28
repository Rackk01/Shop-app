<?php
session_start();

require_once('../php/constants.php');

if (!isset($_SESSION["SD_USUARIO_ADMIN"])) {
	header('Location: ' . URL_APP . 'admin/login');
	die();
	return;
}

if (!isset($_GET['num']) || trim($_GET['num']) == '') {
	header('Location: ' . URL_APP . 'admin/product-list');
	die;
	return;
}

require_once('../php/middleware/empres-config.php');
require_once('../php/middleware/productos.php');

$dataArrayStatesOfProducts = getAllStatesOfProducts();
$dataArrayProductSelected = getOneProductOfCod(intval(trim($_GET['num'])));

// echo $dataArrayProductSelected;
// return;

$arrayProductSelected = str_replace('[', '', $dataArrayProductSelected);
$arrayProductSelected = str_replace(']', '', $arrayProductSelected);
$idStateProductSelected = getOneValueOfJsonData($arrayProductSelected, 'id_estado');
$denomProductSelected = getOneValueOfJsonData($arrayProductSelected, 'denom');

$dataArrayImgsProducto = getAllImgsOfOneProduct(intval(trim($_GET['num'])));
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
										Editar Producto: Cod. <?php echo trim($_GET['num']) . ' | ' . trim($denomProductSelected); ?>
									</h1>
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
										<li class="breadcrumb-item text-muted">Catalog</li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->
								<!--begin::Actions-->
								<div class="d-flex align-items-center gap-2 gap-lg-3">

									<!--begin::Filter menu-->
									<!-- <div class="m-0">
										<a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
											<span class="svg-icon svg-icon-6 svg-icon-muted me-1">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
												</svg>
											</span>
											Filter
										</a>
										<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62cfa7b12c757">
											<div class="px-7 py-5">
												<div class="fs-5 text-dark fw-bold">Filter Options</div>
											</div>
											<div class="separator border-gray-200"></div>
											<div class="px-7 py-5">
												<div class="mb-10">
													<label class="form-label fw-semibold">Estado del producto:</label>
													<div>
														<select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62cfa7b12c757" data-allow-clear="true">
															<?php
															foreach (json_decode($dataArrayStatesOfProducts, true) as $datoState) {
															?>
																<option value="<?php echo trim($datoState['id_estado']); ?>"><?php echo trim($datoState['descripcion']); ?></option>
															<?php
															}
															?>
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
									<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a> -->
								</div>
							</div>
						</div>

						<div id="kt_app_content" class="app-content flex-column-fluid">
							<div id="kt_app_content_container" class="app-container container-xxl">
								<!--begin::Form-->
								<form id="form-producto" class="form d-flex flex-column flex-lg-row" >
									<!--begin::Aside column-->
									<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

										<div class="card card-flush py-4">
											<div class="card-header">
												<div class="card-title">
													<h2>Imágen principal</h2>
												</div>
											</div>
											<div class="card-body text-center pt-0">
												<div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
													<?php
													$urlImg1 = 'assets/imgs/shop/product-1-1.jpg';
													$urlImg2 = 'assets/imgs/shop/product-1-1.jpg';
													$urlImg3 = 'assets/imgs/shop/product-1-1.jpg';
													$urlImg4 = 'assets/imgs/shop/product-1-1.jpg';

													$dataIdImage1 = '0';
													$dataIdImage2 = '0';
													$dataIdImage3 = '0';
													$dataIdImage4 = '0';

													$contador = 1;
													if ($dataArrayImgsProducto != '') {
														foreach (json_decode($dataArrayImgsProducto, true) as $datoImg) {
															if ($contador == 1) {
																if (file_exists('../src/img/productos/' . $datoImg['url'])) {
																	$urlImg1 = 'src/img/productos/' . $datoImg['url'];
																}
																$dataIdImage1 = intval($datoImg['id']);
															} else if ($contador == 2) {
																if (file_exists('../src/img/productos/' . $datoImg['url'])) {
																	$urlImg2 = 'src/img/productos/' . $datoImg['url'];
																}
																$dataIdImage2 = intval($datoImg['id']);
															} else if ($contador == 3) {
																if (file_exists('../src/img/productos/' . $datoImg['url'])) {
																	$urlImg3 = 'src/img/productos/' . $datoImg['url'];
																}
																$dataIdImage3 = intval($datoImg['id']);
															} else if ($contador == 4) {
																if (file_exists('../src/img/productos/' . $datoImg['url'])) {
																	$urlImg4 = 'src/img/productos/' . $datoImg['url'];
																}
																$dataIdImage4 = intval($datoImg['id']);
															} else {
																break;
															}

															$contador++;
														}
													}
													?>
													<div class="image-input-wrapper w-150px h-150px" style="background-size: contain; background-position: center; background-image: url('<?php echo URL_APP . $urlImg1; ?>'); width:100%;"></div>

													<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imágen">
														<i class="bi bi-pencil-fill fs-7"></i>
														<input id="id-image-principal" data-idimage="<?php echo $dataIdImage1; ?>" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
														<input type="hidden" name="avatar_remove" />
													</label>
													<!-- <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Eliminar imágen">
														<i class="bi bi-x fs-2"></i>
													</span> -->
													<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
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
													<div class="image-input-wrapper w-150px h-150px" style="background-size: contain; background-position: center; background-image: url('<?php echo URL_APP . $urlImg2; ?>')"></div>
													<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imágen">
														<i class="bi bi-pencil-fill fs-7"></i>
														<input id="id-image-2" data-idimage="<?php echo $dataIdImage2; ?>" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
														<input type="hidden" name="avatar_remove" />
													</label>
													<!-- <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Eliminar imágen">
														<i class="bi bi-x fs-2"></i>
													</span> -->
													<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
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
													<div class="image-input-wrapper w-150px h-150px" style="background-size: contain; background-position: center; background-image: url('<?php echo URL_APP . $urlImg3; ?>')"></div>
													<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imágen">
														<i class="bi bi-pencil-fill fs-7"></i>
														<input id="id-image-3" data-idimage="<?php echo $dataIdImage3; ?>" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
														<input type="hidden" name="avatar_remove" />
													</label>
													<!-- <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Eliminar imágen">
														<i class="bi bi-x fs-2"></i>
													</span> -->
													<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
														<i class="bi bi-x fs-2"></i>
													</span>
												</div>
												<div class="text-muted fs-7">Formatos aceptados: *.png, *.jpg, *.jpeg.</div>
											</div>
										</div>

										<div class="card card-flush py-4">
											<div class="card-header">
												<div class="card-title">
													<h2>Imágen 4</h2>
												</div>
											</div>
											<div class="card-body text-center pt-0">
												<div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
													<div class="image-input-wrapper w-150px h-150px" style="background-size: contain; background-position: center; background-image: url('<?php echo URL_APP . $urlImg4; ?>')"></div>
													<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imágen">
														<i class="bi bi-pencil-fill fs-7"></i>
														<input id="id-image-4" data-idimage="<?php echo $dataIdImage4; ?>" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
														<input type="hidden" name="avatar_remove" />
													</label>
													<!-- <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Eliminar imágen">
														<i class="bi bi-x fs-2"></i>
													</span> -->
													<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
														<i class="bi bi-x fs-2"></i>
													</span>
												</div>
												<div class="text-muted fs-7">Formatos aceptados: *.png, *.jpg, *.jpeg.</div>
											</div>
										</div>

										<!--begin::Category & tags-->
										<!-- <div class="card card-flush py-4">
											<div class="card-header">
												<div class="card-title">
													<h2>Product Details</h2>
												</div>
											</div>
											<div class="card-body pt-0">
												<label class="form-label">Categories</label>
												<select class="form-select mb-2" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple">
													<option></option>
													<option value="Computers">Computers</option>
													<option value="Watches">Watches</option>
													<option value="Headphones">Headphones</option>
													<option value="Footwear">Footwear</option>
													<option value="Cameras">Cameras</option>
													<option value="Shirts">Shirts</option>
													<option value="Household">Household</option>
													<option value="Handbags">Handbags</option>
													<option value="Wines">Wines</option>
													<option value="Sandals">Sandals</option>
												</select>
												<div class="text-muted fs-7 mb-7">Add product to a category.</div>
												<a href="../../demo1/dist/apps/ecommerce/catalog/add-category.html" class="btn btn-light-primary btn-sm mb-10">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
															<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
														</svg>
													</span>
													Create new category
												</a>
												<label class="form-label d-block">Tags</label>
												<input id="kt_ecommerce_add_product_tags" name="kt_ecommerce_add_product_tags" class="form-control mb-2" value="new, trending, sale" />
												<div class="text-muted fs-7">Add tags to a product.</div>
											</div>
										</div> -->

										<!-- <div class="card card-flush">
											<div class="card-header pt-5">
												<div class="card-title d-flex flex-column">
													<div class="d-flex align-items-center">
														<span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
														<span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">2,420</span>
														<span class="badge badge-light-success fs-base">
															<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
																	<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
																</svg>
															</span>
															2.6%
														</span>
													</div>
													<span class="text-gray-400 pt-1 fw-semibold fs-6">Average Daily Sales</span>
												</div>
											</div>
											<div class="card-body d-flex align-items-end px-0 pb-0">
												<div id="kt_card_widget_6_chart" class="w-100" style="height: 80px"></div>
											</div>
										</div> -->

										<!-- TEMPLATE DEL PRODUCTO -->
										<!-- <div class="card card-flush py-4">
											<div class="card-header">
												<div class="card-title">
													<h2>Product Template</h2>
												</div>
											</div>
											<div class="card-body pt-0">
												<label for="kt_ecommerce_add_product_store_template" class="form-label">Select a product template</label>
												<select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">
													<option></option>
													<option value="default" selected="selected">Default template</option>
													<option value="electronics">Electronics</option>
													<option value="office">Office stationary</option>
													<option value="fashion">Fashion</option>
												</select>
												<div class="text-muted fs-7">Assign a template from your current theme to define how a single product is displayed.</div>
											</div>
										</div> -->

									</div>
									<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
										<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
											<li class="nav-item">
												<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">General</a>
											</li>
											<li class="nav-item">
												<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Avanzado</a>
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
															<div class="mb-10 fv-row">
																<label class="form-label">Código del producto
																	<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="El código de producto es único y autogenerado por el sistema."></i>
																</label>
																<input id="id-input-product-cod" type="number" name="product_name" class="form-control mb-2" placeholder="" value="" readonly />
																<div class="text-muted fs-7"></div>
															</div>
															<div class="mb-10 fv-row">
																<label class="form-label">Nombre del Producto
																	<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="El nombre de producto es obligatorio, debe ser único y lo más descriptivo posible. Máximo permitido 50 caractéres."></i>
																</label>
																<input id="id-input-product-name" maxlength="50" type="text" name="product_name" class="form-control mb-2" placeholder="Ingrese aquí el nombre del producto..." value="" />
																<div class="text-muted fs-7">El nombre del producto es requerido y debe ser único.</div>
															</div>
															<div class="mb-10 fv-row">
																<label class="form-label">Descripción
																	<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="La descripción es obligatoria y debe describir al producto lo mejor posible. Mientras más información tenga, más confianza generará en sus clientes."></i>
																</label>
																<textarea id="id-input-product-denom" class="form-control" data-kt-autosize="false" style="min-height: 170px;"></textarea>

																<!-- <textarea id="id-input-product-denom" maxlength="50" type="text" name="product_name" class="form-control mb-2" placeholder="Ingrese aquí el nombre del producto..." value="" /> -->
																<div class="text-muted fs-7">Setea la descripción del producto para una mejor visibildiad y experiencia de usuario.</div>
															</div>
															<div style="display: none;">
																<!--begin::Label-->
																<label class="form-label">Descripción
																	<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="La descripción es obligatoria y debe describir al producto lo mejor posible. Mientras más información tenga, más confianza generará en sus clientes."></i>
																</label>
																<div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description" class="min-h-200px mb-2"></div>
																<div class="text-muted fs-7">Setea la descripción del producto para una mejor visibildiad y experiencia de usuario.</div>
															</div>
														</div>
													</div>

													<div class="card card-flush py-4">
														<div class="card-header">
															<div class="card-title">
																<h2>Estado
																	<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Es el estado del producto: Sin estado, el producto se mostrará en el carrito sin ningúna distinción especial."></i>
																</h2>
															</div>
															<div class="card-toolbar">
																<!-- <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div> -->
															</div>
														</div>
														<div class="card-body pt-0">
															<select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
																<?php
																foreach (json_decode($dataArrayStatesOfProducts, true) as $datoState) {
																	if (trim($datoState['id_estado']) == trim($idStateProductSelected)) {
																?>
																		<option value="<?php echo trim($datoState['id_estado']); ?>" selected="selected"><?php echo trim($datoState['descripcion']); ?></option>
																	<?php
																	} else {
																	?>
																		<option value="<?php echo trim($datoState['id_estado']); ?>"><?php echo trim($datoState['descripcion']); ?></option>
																<?php
																	}
																}
																?>
																<!-- <option value="draft">Draft</option>
													<option value="scheduled">Scheduled</option>
													<option value="inactive">Inactive</option> -->
															</select>
															<!--end::Select2-->
															<!--begin::Description-->
															<div class="text-muted fs-7">Setea el estado del producto</div>
															<!--end::Description-->
															<!--begin::Datepicker-->
															<div class="d-none mt-10">
																<label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select publishing date and time</label>
																<input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date &amp; time" />
															</div>
															<!--end::Datepicker-->
														</div>
														<!--end::Card body-->
													</div>

													<!--begin::Media-->
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

													<!--begin::Pricing-->
													<div class="card card-flush py-4">
														<!--begin::Card header-->
														<div class="card-header">
															<div class="card-title">
																<h2>Precio</h2>
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
																<input id="id-input-product-precio-base" type="text" name="price" class="form-control mb-2" placeholder="Precio del producto" value="" readonly />
																<!--end::Input-->
																<!--begin::Description-->
																<div class="text-muted fs-7">Setea el precio base del producto.</div>
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
																<div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
																	<!--begin::Col-->
																	<div class="col">
																		<!--begin::Option-->
																		<label id="id-seelct-discount-sindescuento" onclick="formDiscountSelected('s');" class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
																			<!--begin::Radio-->
																			<span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
																				<input id="id-check-descuento-sin" class="form-check-input" type="radio" name="discount_option" value="1" />
																			</span>
																			<!--end::Radio-->
																			<!--begin::Info-->
																			<span class="ms-5">
																				<span class="fs-4 fw-bold text-gray-800 d-block">Sin Descuento</span>
																			</span>
																			<!--end::Info-->
																		</label>
																		<!--end::Option-->
																	</div>
																	<!--end::Col-->
																	<!--begin::Col-->
																	<div class="col">
																		<!--begin::Option-->
																		<label id="id-seelct-discount-porcentaje" onclick="formDiscountSelected('p');" class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
																			<!--begin::Radio-->
																			<span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
																				<input id="id-check-descuento-porcentaje" class="form-check-input" type="radio" name="discount_option" value="2" checked="checked" />
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
																		<label id="id-seelct-discount-fijo" onclick="formDiscountSelected('f');" class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
																			<!--begin::Radio-->
																			<span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
																				<input id="id-check-descuento-fijo" class="form-check-input" type="radio" name="discount_option" value="3" />
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
																<div class="text-muted fs-7">Establecer el porcentaje de descuento que se aplicará sobre el precio base del producto.</div>
															</div>

															<div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed">
																<label class="form-label">Setea el monto de descuento fijo </label>
																<span id="idMontoFormatoMoneda" class="badge badge-primary">$ 0</span>
																<span id="id-help-txt-monto-fijo" class="badge badge-danger" style="display: none;"></span>
																<input id="id-input-descuento-monto-fijo" type="number" name="dicsounted_price" class="form-control mb-2" placeholder="Monto descuento fijo" value="$ 00.00" />
																<div class="text-muted fs-7">Establecer el monto de descuento fijo del producto. Al precio base del producto se le restará este monto fijo determinado.</div>
																<!-- <div id="id-help-txt-monto-fijo" class="text-muted fs-7" style="color: IndianRed;"></div> -->
																<!--end::Description-->
															</div>
															<div class="mb-10 fv-row">
																<!--begin::Label-->
																<label class="required form-label">Precio final</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input id="id-input-product-precio-final" type="text" name="price" class="form-control mb-2" placeholder="Product price" value="" readonly />
																<!--end::Input-->
																<!--begin::Description-->
																<div class="text-muted fs-7">Precio final del producto con la bonificación calculada. Se calcula automáticamente.</div>
																<!--end::Description-->
															</div>
															<!--end::Input group-->
															<!--begin::Tax-->
															<!-- <div class="d-flex flex-wrap gap-5">
																<div class="fv-row w-100 flex-md-root">
																	<label class="required form-label">Tax Class</label>
																	<select class="form-select mb-2" name="tax" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
																		<option></option>
																		<option value="0">Tax Free</option>
																		<option value="1" selected="selected">Taxable Goods</option>
																		<option value="2">Downloadable Product</option>
																	</select>
																	<div class="text-muted fs-7">Set the product tax class.</div>
																</div>
																<div class="fv-row w-100 flex-md-root">
																	<label class="form-label">VAT Amount (%)</label>
																	<input type="text" class="form-control mb-2" value="35" />
																	<div class="text-muted fs-7">Set the product VAT about.</div>
																</div>
															</div> -->
														</div>
													</div>
												</div>
											</div>

											<div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
												<div class="d-flex flex-column gap-7 gap-lg-10">
													<div class="card card-flush py-4">
														<div class="card-header">
															<div class="card-title">
																<h2>Inventario</h2>
															</div>
														</div>
														<div class="card-body pt-0">
															<!-- <div class="mb-10 fv-row">
																<label class="required form-label">SKU</label>
																<input type="text" name="sku" class="form-control mb-2" placeholder="SKU Number" value="011985001" />
																<div class="text-muted fs-7">Enter the product SKU.</div>
															</div> -->
															<div class="mb-10 fv-row">
																<label class="form-label">Código de barras</label>
																<input id="id-input-codbarras" type="text" name="sku" class="form-control mb-2" placeholder="Código de barras" value="45874521458" readonly />
																<div class="text-muted fs-7">Setea el código de barras correspondiente al producto.</div>
															</div>
															<div class="mb-10 fv-row">
																<label class="form-label">Stock actual del producto</label>
																<div class="d-flex gap-3">
																	<input id="id-input-stoact" type="number" name="shelf" class="form-control mb-2" placeholder="Stock actual del producto" value="" readonly />
																	<!-- <input type="number" name="warehouse" class="form-control mb-2" placeholder="In warehouse" /> -->
																</div>
																<div class="text-muted fs-7">Disponibilidad del producto.</div>
															</div>
															<div class="mb-10 fv-row">
																<label class="form-label">Stock web del producto</label>
																<div class="d-flex gap-3">
																	<input id="id-input-stoweb" type="number" name="shelf" class="form-control mb-2" placeholder="Stock actual del producto" value="" />
																	<!-- <input type="number" name="warehouse" class="form-control mb-2" placeholder="In warehouse" /> -->
																</div>
																<div class="text-muted fs-7">Disponibilidad del producto.</div>
															</div>
															<div class="alert alert-primary d-flex align-items-center p-5">
																<span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
																<div class="d-flex flex-column">
																	<h4 class="mb-1 text-dark">¡ATENCIÓN!</h4>
																	<span>¡Solo se muestra el producto en el CARRITO WEB si el STOCK ACTUAL es MAYOR o IGUAL al STOCK WEB!</span>
																</div>
															</div>
															<!--end::Alert-->
															<!-- <div class="fv-row">
																<label class="form-label">Allow Backorders</label>
																<div class="form-check form-check-custom form-check-solid mb-2">
																	<input class="form-check-input" type="checkbox" value="" />
																	<label class="form-check-label">Yes</label>
																</div>
																<div class="text-muted fs-7">Allow customers to purchase products that are out of stock.</div>
															</div> -->
														</div>
													</div>

													<div class="card card-flush py-4">
														<div class="card-header">
															<div class="card-title">
																<h2>Presentaciones</h2>
															</div>
														</div>
														<div class="card-body pt-0">
															<div class="" data-kt-ecommerce-catalog-add-product="auto-options">
																<label class="form-label">Agregar presentación del producto
																	<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Si el tipo de presentación es kilogramos seben separarse los decimales con punto (.). Ejemplo 900 gramos se debe ingresar 0.9. Puede ingresar un máximo de 4 presentaciones"></i>
																</label>
																<div id="kt_ecommerce_add_product_options">
																	<div class="form-group">
																		<div id="id-div-father-content-presentations" data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">
																			<div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
																				<div class="w-100 w-md-200px">
																					<select class="form-select" name="product_option" data-placeholder="seleccione tipo" data-kt-ecommerce-catalog-add-product="product_option">
																						<option value="1">Kilogramos</option>
																					</select>
																				</div>
																				<input type="number" step=".01" class="form-control mw-100 w-200px" name="product_option_value" placeholder="Presentación" />
																				<button onclick="controlAmountOfPresentations();" type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
																					<span class="svg-icon svg-icon-1">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
																							<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
																						</svg>
																					</span>
																				</button>
																			</div>
																		</div>
																	</div>

																	<div class="form-group mt-5">
																		<button id="id-btn-add-presentations" onclick="addPresentationBtn(this);" type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
																			<!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
																			<span class="svg-icon svg-icon-2">
																				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																					<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																					<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																				</svg>
																			</span>
																			Agregar nueva presentación
																		</button>
																	</div>

																	<br>

																	<div class="alert alert-primary d-flex align-items-center p-5">
																		<span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
																		<div class="d-flex flex-column">
																			<h4 class="mb-1 text-dark">¡ATENCIÓN!</h4>
																			<span>En caso de que el producto trabaje con presentaciones en KILOGRAMOS, al eliminar todas las presentaciones vigentes, automáticamente el producto y su stock pasa a trabjar por unidades.</span>
																		</div>
																	</div>

																	<div class="alert alert-primary d-flex align-items-center p-5">
																		<span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
																		<div class="d-flex flex-column">
																			<h4 class="mb-1 text-dark">¡ATENCIÓN!</h4>
																			<span>En caso de que el producto trabaje con presentaciones en KILOGRAMOS, el precio final del producto (por cada presentación) será el resultado de la multiplicación del precio por el peso. <br>
																				Ejemplo: Si es precio de un producto es de $2000 y la presentación es de 0.9kg, el precio de esa presentación es de $1800.</span>
																		</div>
																	</div>

																</div>
															</div>
														</div>
													</div>

													<!-- <div class="card card-flush py-4">
														<div class="card-header">
															<div class="card-title">
																<h2>Shipping</h2>
															</div>
														</div>
														<div class="card-body pt-0">
															<div class="fv-row">
																<div class="form-check form-check-custom form-check-solid mb-2">
																	<input class="form-check-input" type="checkbox" id="kt_ecommerce_add_product_shipping_checkbox" value="1" checked="checked" />
																	<label class="form-check-label">This is a physical product</label>
																</div>
																<div class="text-muted fs-7">Set if the product is a physical or digital item. Physical products may require shipping.</div>
															</div>
															<div id="kt_ecommerce_add_product_shipping" class="mt-10">
																<div class="mb-10 fv-row">
																	<label class="form-label">Weight</label>
																	<input type="text" name="weight" class="form-control mb-2" placeholder="Product weight" value="4.3" />
																	<div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
																</div>
																<div class="fv-row">
																	<label class="form-label">Dimension</label>
																	<div class="d-flex flex-wrap flex-sm-nowrap gap-3">
																		<input type="number" name="width" class="form-control mb-2" placeholder="Width (w)" value="12" />
																		<input type="number" name="height" class="form-control mb-2" placeholder="Height (h)" value="4" />
																		<input type="number" name="length" class="form-control mb-2" placeholder="Lengtn (l)" value="8.5" />
																	</div>
																	<div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).</div>
																</div>
															</div>
														</div>
													</div> -->

													<!-- <div class="card card-flush py-4">
														<div class="card-header">
															<div class="card-title">
																<h2>Meta Options</h2>
															</div>
														</div>
														<div class="card-body pt-0">
															<div class="mb-10">
																<label class="form-label">Meta Tag Title</label>
																<input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" />
																<div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
															</div>
															<div class="mb-10">
																<label class="form-label">Meta Tag Description</label>
																<div id="kt_ecommerce_add_product_meta_description" name="kt_ecommerce_add_product_meta_description" class="min-h-100px mb-2"></div>
																<div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>
															</div>
															<div>
																<label class="form-label">Meta Tag Keywords</label>
																<input id="kt_ecommerce_add_product_meta_keywords" name="kt_ecommerce_add_product_meta_keywords" class="form-control mb-2" />
																<div class="text-muted fs-7">Set a list of keywords that the product is related to. Separate the keywords by adding a comma
																	<code>,</code>between each keyword.
																</div>
															</div>
														</div>
													</div> -->
												</div>
											</div>
											<!--end::Tab pane-->
											<!--begin::Tab pane-->
											<!-- <div class="tab-pane fade" id="kt_ecommerce_add_product_reviews" role="tab-panel">
												<div class="d-flex flex-column gap-7 gap-lg-10">
													<!~~begin::Reviews~~>
													<div class="card card-flush py-4">
														<!~~begin::Card header~~>
														<div class="card-header">
															<!~~begin::Card title~~>
															<div class="card-title">
																<h2>Customer Reviews</h2>
															</div>
															<!~~end::Card title~~>
															<!~~begin::Card toolbar~~>
															<div class="card-toolbar">
																<!~~begin::Rating label~~>
																<span class="fw-bold me-5">Overall Rating:</span>
																<!~~end::Rating label~~>
																<!~~begin::Overall rating~~>
																<div class="rating">
																	<div class="rating-label checked">
																		<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																		<!~~end::Svg Icon~~>
																	</div>
																	<div class="rating-label checked">
																		<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																		<!~~end::Svg Icon~~>
																	</div>
																	<div class="rating-label checked">
																		<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																		<!~~end::Svg Icon~~>
																	</div>
																	<div class="rating-label checked">
																		<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																		<!~~end::Svg Icon~~>
																	</div>
																	<div class="rating-label">
																		<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																		<!~~end::Svg Icon~~>
																	</div>
																</div>
																<!~~end::Overall rating~~>
															</div>
															<!~~end::Card toolbar~~>
														</div>
														<!~~end::Card header~~>
														<!~~begin::Card body~~>
														<div class="card-body pt-0">
															<!~~begin::Table~~>
															<table class="table table-row-dashed fs-6 gy-5 my-0" id="kt_ecommerce_add_product_reviews">
																<!~~begin::Table head~~>
																<thead>
																	<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
																		<th class="w-10px pe-2">
																			<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
																				<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_add_product_reviews .form-check-input" value="1" />
																			</div>
																		</th>
																		<th class="min-w-125px">Rating</th>
																		<th class="min-w-175px">Customer</th>
																		<th class="min-w-175px">Comment</th>
																		<th class="min-w-100px text-end fs-7">Date</th>
																	</tr>
																</thead>
																<!~~end::Table head~~>
																<!~~begin::Table body~~>
																<tbody>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<div class="symbol-label bg-light-danger">
																						<span class="text-danger">M</span>
																					</div>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Melody Macy</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">I like this design</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">Today</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<span class="symbol-label" style="background-image:url(assets/media/avatars/300-1.jpg)"></span>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Max Smith</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Good product for outdoors or indoors</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">day ago</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-4">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<span class="symbol-label" style="background-image:url(assets/media/avatars/300-5.jpg)"></span>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Sean Bean</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Awesome quality with great materials used, but could be more comfortable</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">11:20 PM</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<span class="symbol-label" style="background-image:url(assets/media/avatars/300-25.jpg)"></span>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Brian Cox</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">This is the best product I've ever used.</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">2 days ago</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-3">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<div class="symbol-label bg-light-warning">
																						<span class="text-warning">C</span>
																					</div>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Mikaela Collins</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">I thought it was just average, I prefer other brands</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">July 25</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<span class="symbol-label" style="background-image:url(assets/media/avatars/300-9.jpg)"></span>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Francis Mitcham</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Beautifully crafted. Worth every penny.</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">July 24</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-4">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<div class="symbol-label bg-light-danger">
																						<span class="text-danger">O</span>
																					</div>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Olivia Wild</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Awesome value for money. Shipping could be faster tho.</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">July 13</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<div class="symbol-label bg-light-primary">
																						<span class="text-primary">N</span>
																					</div>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Neil Owen</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Excellent quality, I got it for my son's birthday and he loved it!</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">May 25</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<span class="symbol-label" style="background-image:url(assets/media/avatars/300-23.jpg)"></span>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Dan Wilson</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">I got this for Christmas last year, and it's still the best product I've ever used!</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">April 15</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<div class="symbol-label bg-light-danger">
																						<span class="text-danger">E</span>
																					</div>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Emma Bold</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Was skeptical at first, but after using it for 3 months, I'm hooked! Will definately buy another!</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">April 3</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-4">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<span class="symbol-label" style="background-image:url(assets/media/avatars/300-12.jpg)"></span>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Ana Crown</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Great product, too bad I missed out on the sale.</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">March 17</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<div class="symbol-label bg-light-info">
																						<span class="text-info">A</span>
																					</div>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">Robert Doe</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Got this on sale! Best decision ever!</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">March 12</span>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<!~~begin::Checkbox~~>
																			<div class="form-check form-check-sm form-check-custom form-check-solid mt-1">
																				<input class="form-check-input" type="checkbox" value="1" />
																			</div>
																			<!~~end::Checkbox~~>
																		</td>
																		<td data-order="rating-5">
																			<!~~begin::Rating~~>
																			<div class="rating">
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																				<div class="rating-label checked">
																					<!~~begin::Svg Icon | path: icons/duotune/general/gen029.svg~~>
																					<span class="svg-icon svg-icon-2">
																						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																							<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																						</svg>
																					</span>
																					<!~~end::Svg Icon~~>
																				</div>
																			</div>
																			<!~~end::Rating~~>
																		</td>
																		<td>
																			<a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
																				<!~~begin::Avatar~~>
																				<div class="symbol symbol-circle symbol-25px me-3">
																					<span class="symbol-label" style="background-image:url(assets/media/avatars/300-13.jpg)"></span>
																				</div>
																				<!~~end::Avatar~~>
																				<!~~begin::Name~~>
																				<span class="fw-bold">John Miller</span>
																				<!~~end::Name~~>
																			</a>
																		</td>
																		<td class="text-gray-600 fw-bold">Firesale is on! Buy now! Totally worth it!</td>
																		<td class="text-end">
																			<span class="fw-semibold text-muted">March 11</span>
																		</td>
																	</tr>
																</tbody>
																<!~~end::Table body~~>
															</table>
															<!~~end::Table~~>
														</div>
														<!~~end::Card body~~>
													</div>
													<!~~end::Reviews~~>
												</div>
											</div> -->
											<!--end::Tab pane-->
										</div>
										<!--end::Tab content-->
										<div class="d-flex justify-content-end">
											<!--begin::Button-->
											<!-- <a href="product-list" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a> -->
											<!--end::Button-->
											<!--begin::Button-->
											<button class="btn btn-primary" onclick="saveChangeProduct();">
												<span class="indicator-label">Guardar cambios</span>
												<span class="indicator-progress">Por favor espere...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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

	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
				<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
			</svg>
		</span>
	</div>
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
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used by this page)-->
	<script src="assets/js/custom/apps/ecommerce/catalog/save-product.js"></script>
	<script src="assets/js/widgets.bundle.js"></script>
	<script src="assets/js/custom/widgets.js"></script>
	<script src="assets/js/custom/apps/chat/chat.js"></script>
	<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
	<script src="assets/js/custom/utilities/modals/create-app.js"></script>
	<script src="assets/js/custom/utilities/modals/users-search.js"></script>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->

	<!-- JS Propios -->
	<?php require_once('../php/libs/sweet-alert.php'); ?>
	<script src="../js/util/methods.js"></script>
	<script src="js/view/product-edit.js"></script>

	<!-- <script src="../js/constants.js"></script> -->
	<script src="js/components/close-session.js"></script>
</body>
<!--end::Body-->

</html>