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
require_once('../php/middleware/combo-producto.php');
require_once('../php/middleware/pedidos.php');
require_once('../php/util/methods.php');

$pedidoSeleccionado = reemplazarPorAcentos(getOneSaleOfCod($_GET['cod']));
// echo $pedidoSeleccionado;
// return;

$pedidoSeleccionado = str_replace('[', '', $pedidoSeleccionado);
$pedidoSeleccionado = str_replace(']', '', $pedidoSeleccionado);

$pedidoSeleccionado = json_decode($pedidoSeleccionado, true);
// echo $pedidoSeleccionado['zf'];
// return;

// echo $dataArrayIteremProductsPedidoSeleccionado;
// echo $dataArrayIteremCombosPedidoSeleccionado;
// return;
?>
<!DOCTYPE html>
<!--
Author: 
Product Name:  - Bootstrap 5 HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www..com
Contact: support@.com
Follow: www.twitter.com/
Dribbble: www.dribbble.com/
Like: www.facebook.com/
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
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
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Editar orden</h1>
									<!--end::Title-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="index" class="text-muted text-hover-primary">Inicio</a>
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
										<li class="breadcrumb-item text-muted">Pedidos</li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->
							</div>
							<!--end::Toolbar container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Content-->
						<div id="kt_app_content" class="app-content flex-column-fluid">
							<!--begin::Content container-->
							<div id="kt_app_content_container" class="app-container container-xxl">
								<!--begin::Form-->
								<form id="kt_ecommerce_edit_order_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/sales/listing.html">
									<!--begin::Aside column-->
									<div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
										<!--begin::Order details-->
										<div class="card card-flush py-4">
											<!--begin::Card header-->
											<div class="card-header">
												<div class="card-title">
													<h2>Detalle de orden</h2>
												</div>
											</div>
											<!--end::Card header-->
											<!--begin::Card body-->
											<div class="card-body pt-0">
												<div class="d-flex flex-column gap-10">
													<!--begin::Input group-->
													<div class="fv-row">
														<!--begin::Label-->
														<label class="form-label">Nro de comprobante</label>
														<!--end::Label-->
														<!--begin::Auto-generated ID-->
														<div class="fw-bold fs-3"><?php echo $_GET['cod']; ?></div>
														<!--end::Input-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row">
														<!--begin::Label-->
														<label class="form-label">Método de pago</label>
														<!--end::Label-->
														<!--begin::Select2-->
														<select class="form-select mb-2" name="payment_method" id="select_payment_method" disabled>
															<?php
															$paymentMethods = json_decode(getAllPaymentMethods(), true);

															foreach ($paymentMethods as $payMethod) {
																if ($payMethod['codigo'] == $pedidoSeleccionado['cod_forpag']) { ?>
																	<option value="<?php echo $payMethod['codigo'] ?>" selected><?php echo $payMethod['nombre'] ?></option>
																<?php
																} else {
																?>
																	<option value="<?php echo $payMethod['codigo'] ?>"><?php echo $payMethod['nombre'] ?></option>
															<?php
																}
															}
															?>

														</select>
														<!--end::Select2-->
														<!--begin::Description-->
														<div class="text-muted fs-7">Set the date of the order to process.</div>
														<!--end::Description-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row">
														<!--begin::Label-->
														<label class="form-label">Método de envío</label>
														<!--end::Label-->
														<!--begin::Select2-->
														<select class="form-select mb-2" name="shipping_method" id="select_shipping_method" disabled>
															<?php
															$shippingMethods = json_decode(getAllShippingMethods(), true);
															// echo var_dump($shippingMethods);

															foreach ($shippingMethods as $shipping) {
																if ($shipping['codigo'] == $pedidoSeleccionado['forenv']) { ?>
																	<option value="<?php echo $shipping['codigo'] ?>" selected><?php echo $shipping['nombre'].' : '.$shipping['detalle'] ?></option>

																<?php
																} else {
																?>
																	<option value="<?php echo $shipping['codigo'] ?>"><?php echo $shipping['nombre'].' : '.$shipping['detalle'] ?></option>
															<?php
																}
															}
															?>
														</select>
														<!--end::Select2-->
														<!--begin::Description-->
														<div class="text-muted fs-7">Set the date of the order to process.</div>
														<!--end::Description-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row">
														<!--begin::Label-->
														<label class="form-label">Estado del pedido</label>
														<!--end::Label-->
														<!--begin::Select2-->
														<select class="form-select mb-2" name="order_state" id="select_order_state">
															<?php
															$orderStates = json_decode(getAllOrderStates(), true);

															foreach ($orderStates as $orderState) {
																if ($orderState['id_estado'] == $pedidoSeleccionado['id_estado']) { ?>
																	<option value="<?php echo $orderState['id_estado'] ?>" selected><?php echo $orderState['descri'] ?></option>

																<?php
																} else {
																?>
																	<option value="<?php echo $orderState['id_estado'] ?>"><?php echo $orderState['descri'] ?></option>
															<?php
																}
															}
															?>
														</select>
														<!--end::Select2-->
														<!--begin::Description-->
														<div class="text-muted fs-7">Set the date of the order to process.</div>
														<!--end::Description-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<!-- <div class="fv-row">
														<!~~begin::Label~~>
														<label class="required form-label">Order Date</label>
														<!~~end::Label~~>
														<!~~begin::Editor~~>
														<input id="kt_ecommerce_edit_order_date" name="order_date" placeholder="Select a date" class="form-control mb-2" value="2021-12-22" />
														<!~~end::Editor~~>
														<!~~begin::Description~~>
														<div class="text-muted fs-7">Set the date of the order to process.</div>
														<!~~end::Description~~>
													</div> -->
													<!--end::Input group-->
												</div>
											</div>
											<!--end::Card header-->
										</div>
										<!--end::Order details-->
									</div>
									<!--end::Aside column-->
									<!--begin::Main column-->
									<div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
										<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
											<li class="nav-item">
												<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#tab_detail">Detalle</a>
											</li>
											<li class="nav-item">
												<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#tab_shipping">Seguimiento</a>
											</li>
											<!-- Reviews | Revisiones | Comentarios enviados por los clientes -->
											<!-- <li class="nav-item">
												<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_reviews">Revisiones</a>
											</li> -->
										</ul>
										<div class="tab-content">
											<div class="tab-pane fade show active" id="tab_detail" role="tab-panel">
												<!--begin::Order details-->
												<div class="card card-flush py-4 my-4">
													<!--begin::Card header-->
													<div class="card-header">
														<div class="card-title">
															<h2>Items del pedido</h2>
														</div>
													</div>
													<!--end::Card header-->
													<!--begin::Card body-->
													<div class="card-body pt-0">
														<div class="d-flex flex-column gap-10">
															<!--begin::Input group-->
															<div>
																<!--begin::Label-->
																<!-- <label class="form-label">Add products to this order</label> -->
																<!--end::Label-->
																<!--begin::Selected products-->
																<div class="row row-cols-1 row-cols-xl-3 row-cols-md-2 border border-dashed rounded pt-3 pb-1 px-2 mb-5 mh-300px overflow-scroll" id="kt_ecommerce_edit_order_selected_products">
																	<!--begin::Empty message-->
																	<!-- <span class="w-100 text-muted d-none">Select one or more products from the list below by ticking the checkbox.</span> -->
																	<!--end::Empty message-->
																	<?php
																	$productosPedido = getAllProductsOfSaleCod($_GET['cod']);
																	$importeTotal = 0;
																	if ($productosPedido != 'null') {

																		foreach (json_decode($productosPedido, true) as $producto) {
																			// echo var_dump($producto);
																			$imgProducto = getAllImgsOfOneProductSecondOption($producto['cod']);
																			$importeTotal += floatval($producto['importe']);
																	?>
																			<div class="col my-2">
																				<div class="d-flex align-items-center border border-dashed p-3 rounded bg-light-info">
																					<!--begin::Thumbnail-->
																					<a href="product-edit?num=<?php echo $producto['cod'] ?>" class="symbol symbol-50px">
																						<span class="symbol-label" style="background-image:url(<?php echo $imgProducto[0] ?>);"></span>
																					</a>
																					<!--end::Thumbnail-->
																					<div class="ms-5">
																						<!--begin::Title-->
																						<a href="product-edit?num=<?php echo $producto['cod'] ?>" class="text-gray-800 text-hover-primary fs-5 fw-bold"><?php echo mb_strimwidth($producto['denom'], 0, 35, "..."); ?></a>
																						<!--end::Title-->
																						<!--begin::cod-->
																						<div class="text-muted fs-7">Cód: <?php echo $producto['cod'] ?></div>
																						<!--end::cod-->
																						<!--begin::Price-->
																						<div class="fw-semibold fs-7">Precio: $
																							<span data-kt-ecommerce-edit-order-filter="price"><?php echo number_format(floatval($producto['precio']), 2) ?></span>
																						</div>
																						<!--end::Price-->
																						<!--begin::SKU-->
																						<div class="text-muted fs-7">Cantidad: <?php echo $producto['piezas'] ?></div>
																						<!--end::SKU-->
																					</div>
																				</div>
																			</div>

																	<?php
																		}
																	}
																	?>

																	<?php
																	$combosPedido = getAllCombosOfSaleCod($_GET['cod']);
																	// echo var_dump($combosPedido);
																	if ($combosPedido != 'null') {
																		foreach (json_decode($combosPedido, true) as $combo) {
																			// echo var_dump($combo);
																			$imgCombo = getAllImgsOfOneCombo(intval($combo['id_combo']));
																			$importeTotal += floatval($combo['importe']);
																	?>
																			<div class="col my-2">
																				<div class="d-flex align-items-center border border-dashed p-3 rounded bg-light-info">
																					<!--begin::Thumbnail-->
																					<a href="combo-edit?num=<?php echo $combo['id_combo'] ?>" class="symbol symbol-50px">
																						<span class="symbol-label" style="background-image:url(<?php echo $imgCombo[0] ?>);"></span>
																					</a>
																					<!--end::Thumbnail-->
																					<div class="ms-5">
																						<!--begin::Title-->
																						<a href="combo-edit?num=<?php echo $combo['id_combo'] ?>" class="text-gray-800 text-hover-primary fs-5 fw-bold"><?php echo mb_strimwidth($combo['denom_combo'], 0, 35, "..."); ?></a>
																						<!--end::Title-->
																						<!--begin::cod-->
																						<div class="text-muted fs-7">Cód: <?php echo $combo['id_combo'] ?></div>
																						<!--end::cod-->
																						<!--begin::Price-->
																						<div class="fw-semibold fs-7">Precio: $
																							<span data-kt-ecommerce-edit-order-filter="price"><?php echo number_format(floatval($combo['precio']), 2) ?></span>
																						</div>
																						<!--end::Price-->
																						<!--begin::SKU-->
																						<div class="text-muted fs-7">Cantidad: <?php echo $combo['piezas'] ?></div>
																						<!--end::SKU-->
																					</div>
																				</div>
																			</div>

																	<?php
																		}
																	}
																	?>
																</div>
																<!--begin::Selected products-->
																<!--begin::Total price-->
																<div class="fw-bold fs-4">Total: $
																	<span id="kt_ecommerce_edit_order_total_price"><?php echo number_format($importeTotal, 2); ?></span>
																</div>
																<!--end::Total price-->
															</div>
															<!--end::Input group-->
															<!--begin::Separator-->
															<div class="separator"></div>
															<!--end::Separator-->
															<!--begin::Search products-->
															<!-- <div class="d-flex align-items-center position-relative mb-n7">
														<!~~begin::Svg Icon | path: icons/duotune/general/gen021.svg~~>
														<span class="svg-icon svg-icon-1 position-absolute ms-4">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
															</svg>
														</span>
														<!~~end::Svg Icon~~>
														<input type="text" data-kt-ecommerce-edit-order-filter="search" class="form-control form-control-solid w-100 w-lg-50 ps-14" placeholder="Search Products" />
													</div> -->
															<!--end::Search products-->
															<!--begin::Table-->
															<!-- <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_edit_order_product_table">
														<!~~begin::Table head~~>
														<thead>
															<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
																<th class="w-25px pe-2"></th>
																<th class="min-w-200px">Product</th>
																<th class="min-w-100px text-end pe-5">Qty Remaining</th>
															</tr>
														</thead>
														<!~~end::Table head~~>
														<!~~begin::Table body~~>
														<tbody class="fw-semibold text-gray-600">
															<!~~begin::Table row~~>
															<tr>
																<!~~begin::Checkbox~~>
																<td>
																	<div class="form-check form-check-sm form-check-custom form-check-solid">
																		<input class="form-check-input" type="checkbox" value="1" />
																	</div>
																</td>
																<!~~end::Checkbox~~>
																<!~~begin::Product=~~>
																<td>
																	<div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_1">
																		<!~~begin::Thumbnail~~>
																		<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
																			<span class="symbol-label" style="background-image:url(assets/media//stock/ecommerce/1.gif);"></span>
																		</a>
																		<!~~end::Thumbnail~~>
																		<div class="ms-5">
																			<!~~begin::Title~~>
																			<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Maximiliano Depetris</a>
																			<!~~end::Title~~>
																			<!~~begin::Price~~>
																			<div class="fw-semibold fs-7">Price: $
																				<span data-kt-ecommerce-edit-order-filter="price">256.00</span>
																			</div>
																			<!~~end::Price~~>
																			<!~~begin::SKU~~>
																			<div class="text-muted fs-7">SKU: 02614006</div>
																			<!~~end::SKU~~>
																		</div>
																	</div>
																</td>
																<!~~end::Product=~~>
																<!~~begin::Qty=~~>
																<td class="text-end pe-5" data-order="34">
																	<span class="fw-bold ms-3">34</span>
																</td>
																<!~~end::Qty=~~>
															</tr>
															<!~~end::Table row~~>
															<!~~begin::Table row~~>
															<tr>
																<!~~begin::Checkbox~~>
																<td>
																	<div class="form-check form-check-sm form-check-custom form-check-solid">
																		<input class="form-check-input" type="checkbox" value="1" />
																	</div>
																</td>
																<!~~end::Checkbox~~>
																<!~~begin::Product=~~>
																<td>
																	<div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_2">
																		<!~~begin::Thumbnail~~>
																		<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
																			<span class="symbol-label" style="background-image:url(assets/media//stock/ecommerce/2.gif);"></span>
																		</a>
																		<!~~end::Thumbnail~~>
																		<div class="ms-5">
																			<!~~begin::Title~~>
																			<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Product 2</a>
																			<!~~end::Title~~>
																			<!~~begin::Price~~>
																			<div class="fw-semibold fs-7">Price: $
																				<span data-kt-ecommerce-edit-order-filter="price">121.00</span>
																			</div>
																			<!~~end::Price~~>
																			<!~~begin::SKU~~>
																			<div class="text-muted fs-7">SKU: 01116003</div>
																			<!~~end::SKU~~>
																		</div>
																	</div>
																</td>
																<!~~end::Product=~~>
																<!~~begin::Qty=~~>
																<td class="text-end pe-5" data-order="32">
																	<span class="fw-bold ms-3">32</span>
																</td>
																<!~~end::Qty=~~>
															</tr>
															<!~~end::Table row~~>
														</tbody>
														<!~~end::Table body~~>
													</table> -->
															<!--end::Table-->
														</div>
													</div>
													<!--end::Card header-->
												</div>
												<!--end::Order details-->
												<!--begin::Order details-->
												<div class="card card-flush py-4 my-4">
													<!--begin::Card header-->
													<div class="card-header">
														<div class="card-title">
															<h2>Detalle de envío</h2>
														</div>
													</div>
													<!--end::Card header-->
													<!--begin::Card body-->
													<div class="card-body pt-0">
														<!--begin::Billing address-->
														<div class="d-flex flex-column gap-5 gap-md-7">
															<!--begin::Title-->
															<!-- <div class="fs-3 fw-bold mb-n2">Billing Address</div> -->
															<!--end::Title-->
															<!--begin::Input group-->
															<div class="d-flex flex-column flex-md-row gap-5">
																<div class="fv-row flex-row-fluid">
																	<!--begin::Label-->
																	<label class="form-label">Dirección</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input class="form-control" name="billing_order_address_1" value="<?php echo $pedidoSeleccionado['domicilio'] ?>" readonly />
																	<!--end::Input-->
																</div>
																<!-- <div class="flex-row-fluid">
															<!~~begin::Label~~>
															<label class="form-label">Address Line 2</label>
															<!~~end::Label~~>
															<!~~begin::Input~~>
															<input class="form-control" name="billing_order_address_2" placeholder="Address Line 2" />
															<!~~end::Input~~>
														</div> -->
															</div>
															<!--end::Input group-->
															<!--begin::Input group-->
															<div class="d-flex flex-column flex-md-row gap-5">
																<div class="flex-row-fluid">
																	<!--begin::Label-->
																	<label class="form-label">Ciudad</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input class="form-control" name="billing_order_city" value="<?php echo $pedidoSeleccionado['localidad'] ?>" readonly />
																	<!--end::Input-->
																</div>
																<div class="fv-row flex-row-fluid">
																	<!--begin::Label-->
																	<label class="form-label">Código postal</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input class="form-control" name="billing_order_postcode" value="<?php echo $pedidoSeleccionado['codpost'] ?>" readonly />
																	<!--end::Input-->
																</div>
																<div class="fv-row flex-row-fluid">
																	<!--begin::Label-->
																	<label class="form-label">Provincia</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input class="form-control" name="billing_order_state" value="<?php echo $pedidoSeleccionado['provincia'] ?>" readonly />
																	<!--end::Input-->
																</div>
															</div>
															<!--end::Input group-->
															<!--begin::Input group-->
															<!-- <div class="fv-row"> -->
															<!--begin::Label-->
															<!-- <label class="required form-label">Country</label> -->
															<!--end::Label-->
															<!-- </div> -->
															<!--end::Input group-->
															<!--begin::Checkbox-->
															<!-- <div class="form-check form-check-custom form-check-solid">
														<input class="form-check-input" type="checkbox" value="" id="same_as_billing" />
														<label class="form-check-label" for="same_as_billing">Shipping address is the same as billing address</label>
													</div> -->
															<!--end::Checkbox-->
															<!--begin::Shipping address-->
															<!-- <div class="d-flex flex-column gap-5 gap-md-7" id="kt_ecommerce_edit_order_shipping_form">
														<!~~begin::Title~~>
														<div class="fs-3 fw-bold mb-n2">Shipping Address</div>
														<!~~end::Title~~>
														<!~~begin::Input group~~>
														<div class="d-flex flex-column flex-md-row gap-5">
															<div class="fv-row flex-row-fluid">
																<!~~begin::Label~~>
																<label class="form-label">Address Line 1</label>
																<!~~end::Label~~>
																<!~~begin::Input~~>
																<input class="form-control" name="kt_ecommerce_edit_order_address_1" placeholder="Address Line 1" value="20 Randy Road" />
																<!~~end::Input~~>
															</div>
															<div class="flex-row-fluid">
																<!~~begin::Label~~>
																<label class="form-label">Address Line 2</label>
																<!~~end::Label~~>
																<!~~begin::Input~~>
																<input class="form-control" name="kt_ecommerce_edit_order_address_2" placeholder="Address Line 2" />
																<!~~end::Input~~>
															</div>
														</div>
														<!~~end::Input group~~>
														<!~~begin::Input group~~>
														<div class="d-flex flex-column flex-md-row gap-5">
															<div class="flex-row-fluid">
																<!~~begin::Label~~>
																<label class="form-label">City</label>
																<!~~end::Label~~>
																<!~~begin::Input~~>
																<input class="form-control" name="kt_ecommerce_edit_order_city" placeholder="" value="Melbourne" />
																<!~~end::Input~~>
															</div>
															<div class="fv-row flex-row-fluid">
																<!~~begin::Label~~>
																<label class="form-label">Postcode</label>
																<!~~end::Label~~>
																<!~~begin::Input~~>
																<input class="form-control" name="kt_ecommerce_edit_order_postcode" placeholder="" value="3000" />
																<!~~end::Input~~>
															</div>
															<div class="fv-row flex-row-fluid">
																<!~~begin::Label~~>
																<label class="form-label">State</label>
																<!~~end::Label~~>
																<!~~begin::Input~~>
																<input class="form-control" name="kt_ecommerce_edit_order_state" placeholder="" value="Victoria" />
																<!~~end::Input~~>
															</div>
														</div>
														<!~~end::Input group~~>
													</div> -->
															<!--end::Shipping address-->
														</div>
														<!--end::Billing address-->
													</div>
													<!--end::Card body-->
												</div>
												<!--end::Order details-->
											</div>
											<div class="tab-pane fade" id="tab_shipping" role="tab-panel">
												<div class="card card-flush py-4 my-4">
													<!--begin::Card header-->
													<div class="card-header">
														<div class="card-title">
															<h2>Estado del pedido</h2>
														</div>
													</div>
													<!--end::Card header-->
													<!--begin::Card body-->
													<div class="card-body pt-0">
														<!--begin::Billing address-->
														<div class="d-flex flex-column gap-5 gap-md-7">
															<!--begin::Title-->
															<!-- <div class="fs-3 fw-bold mb-n2">Billing Address</div> -->
															<!--end::Title-->
															<!--begin::Input group-->
															<div class="d-flex flex-column flex-md-row gap-5">
																<div class="fv-row flex-row-fluid">
																	<!--begin::Label-->
																	<label class="form-label">Comentario</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<textarea maxlength="500" id="textarea_comment" class="form-control resize-none"></textarea>
																	<!--end::Input-->
																</div>
															</div>
															<div class="d-flex justify-content-end">
																<!--begin::Button-->
																<a href="" class="btn btn-primary" id="btn_add_comment">
																	<span class="indicator-label">Agregar comentario</span>
																</a>
																<!--end::Button-->
															</div>
															<!--end::Input group-->
														</div>
														<!--end::Billing address-->
													</div>
													<!--end::Card body-->
												</div>

												<div class="card card-flush py-4 my-4">
													<!--begin::Card header-->
													<div class="card-header">
														<div class="card-title">
															<h2>Listado de comentarios</h2>
															<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Al cliente se le mostrará el último mensaje ingresado."></i>
														</div>
													</div>
													<!--end::Card header-->
													<!--begin::Card body-->
													<div class="card-body pt-0">
														<!--begin::Billing address-->
														<div class="d-flex flex-column gap-5 gap-md-7">
															<!-- begin::Table-->
															<table class="table align-middle table-row-dashed fs-6 gy-5" id="comments_table">
																<thead>
																	<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
																		<th class="min-w-200px">Comentario</th>
																		<th class="min-w-100px text-end pe-5">Fecha</th>
																	</tr>
																</thead>
																<tbody class="fw-semibold text-gray-600">
																	<?php
																	$comments = json_decode(getAllOrderComments($_GET['cod']), true);
																	//  echo var_dump($comments);
																	if ($comments != '') {
																		foreach ($comments as $comment) {
																			$day = separateDayHour($comment['hora'])['day'];

																	?>
																			<tr>
																				<td class="text-start pe-5">
																					<p><?php echo $comment['comentario'] ?></p>
																				</td>
																				<td class="text-end pe-5">
																					<span class="fw-bold ms-3"><?php echo date_format(date_create($day), 'd/m/Y') ?></span>
																				</td>
																			</tr>
																	<?php
																		}
																	}
																	?>
																</tbody>
															</table>
															<!--end::Table -->
														</div>
														<!--end::Billing address-->
													</div>
													<!--end::Card body-->
												</div>
											</div>
										</div>

										<!-- <div class="d-flex justify-content-end">
											<!~~begin::Button~~>
											<!~~ <a href="../../demo1/dist/apps/ecommerce/catalog/products.html" id="kt_ecommerce_edit_order_cancel" class="btn btn-light me-5">Cancel</a> ~~>
											<!~~end::Button~~>
											<!~~begin::Button~~>
											<button type="submit" id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
												<span class="indicator-label">Guardar cambios</span>
											</button>
											<!~~end::Button~~>
										</div>  -->
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
	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
				<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->
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
	<script src="assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used by this page)-->
	<!-- <script src="assets/js/custom/apps/ecommerce/sales/save-order.js"></script> -->

	<?php require_once('../php/libs/sweet-alert.php'); ?>
	<script src="../js/util/methods.js"></script>
	<script src="js/view/sale-edit.js"></script>

	<script src="../js/constants.js"></script>
	<script src="js/components/close-session.js"></script>

	<!--end::Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>