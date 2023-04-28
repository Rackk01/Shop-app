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
	<!-- <script>if ( document.documentElement ) { const defaultThemeMode = "system"; const name = document.body.getAttribute("data-kt-name"); let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); if ( themeMode === null ) { if ( defaultThemeMode === "system" ) { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } else { themeMode = defaultThemeMode; } } document.documentElement.setAttribute("data-theme", themeMode); }</script> -->
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

				<!-- SIDEBAR MENU -->
				<?php require_once('php/components/side-bar-menu.php'); ?>
				<!-- END SIDEBAR MENU -->

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
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE PRODUCTOS</h1>
									<!--end::Title-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="#" class="text-muted text-hover-primary">Listado de todos los productos existentes en el sistema</a>
										</li>
										<!-- <li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
											</li>
											<li class="breadcrumb-item text-muted">eCommerce</li>
											<li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
											</li>
											<li class="breadcrumb-item text-muted">Catalog</li> -->
									</ul>
								</div>
								<!--end::Actions-->
							</div>
							<!--end::Toolbar container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Content-->
						<div id="kt_app_content" class="app-content flex-column-fluid">
							<!--begin::Content container-->
							<div id="kt_app_content_container" class="app-container container-xxl">
								<!--begin::Products-->
								<div class="card card-flush">
									<!--begin::Card header-->
									<div class="card-header align-items-center py-5 gap-2 gap-md-5">
										<!--begin::Card title-->
										<div class="card-title">
											<!--begin::Search-->
											<div class="d-flex align-items-center position-relative my-1">
												<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
												<span class="svg-icon svg-icon-1 position-absolute ms-4">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Buscar Producto..." />
											</div>
											<!--end::Search-->
										</div>
										<!--end::Card title-->
										<!--begin::Card toolbar-->
										<!-- <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
												<div class="w-100 mw-150px">
													<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
														<option></option>
														<option value="all">All</option>
														<option value="published">Published</option>
														<option value="scheduled">Scheduled</option>
														<option value="inactive">Inactive</option>
													</select>
												</div> -->
										<!--begin::Add product-->
										<a href="#" class="btn btn-primary">Nuevo Producto</a>
										<!--end::Add product-->
									</div>
									<!--end::Card toolbar-->
									<!--begin::Card body-->
									<div class="card-body pt-0">
										<!--begin::Table-->
										<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
													<!-- <th class="w-10px pe-2">
														<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
															<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1" />
														</div>
													</th> -->
													<th class="text-end min-w-50px">#</th>
													<th class="min-w-200px">Producto</th>
													<th class="text-end min-w-50px">Vistas</th>
													<th class="text-end min-w-70px">Stock</th>
													<th class="text-end min-w-100px">Precio</th>
													<th class="text-center min-w-100px">Bonif.</th>
													<th class="text-center min-w-100px">Estado</th>
													<th class="text-center min-w-70px">Acciones</th>
												</tr>
												<!--end::Table row-->
											</thead>

											<tbody class="fw-semibold text-gray-600">
												<?php
												$dataArrayAllProductos = getAllProducts();
												$amount = count(json_decode($dataArrayAllProductos, true));
												// echo $dataArrayAllProductos;
												if ($amount > 0) {
													$contador = 0;
													foreach (json_decode($dataArrayAllProductos, true) as $dato) {

														$urlOrig = trim($dato['url']); //@trim(getOneValueOfJsonData(getFirstImgProductOfCod($dato['numero']), 'url'));

														if (file_exists('../src/img/productos/' . $urlOrig)) {
															$urlImage = '../src/img/productos/' . $urlOrig;
														} else {
															$urlImage = '../assets/imgs/shop/product-1-1.jpg';
														}
												?>
														<tr>
															<!--begin::Checkbox-->
															<!-- <td>
																<div class="form-check form-check-sm form-check-custom form-check-solid">
																	<input class="form-check-input" type="checkbox" value="1" />
																</div>
															</td> -->

															<td class="text-end pe-0">
																<span class="fw-bold text-dark"><?php echo $dato['numero']; ?></span>
															</td>

															<td>
																<div class="d-flex align-items-center">
																	<!--begin::Thumbnail-->
																	<a onclick="return false;" class="symbol symbol-50px">
																		<span class="symbol-label" style="background-image:url(<?php echo $urlImage; ?>);"></span>
																	</a>
																	<!--end::Thumbnail-->
																	<div class="ms-5">
																		<!--begin::Title-->
																		<a href="product-edit?num=<?php echo trim($dato['numero']); ?>&den=<?php echo trim($dato['denom']); ?> class=" text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">
																			<?php echo $dato['denom']; ?>
																		</a>
																		<!--end::Title-->
																	</div>
																</div>
															</td>

															<!--end::Category=-->
															<!--begin::SKU=-->
															<td class="text-end pe-0">
																<span class="fw-bold">0</span>
															</td>
															<!--end::SKU=-->
															<!--begin::Qty=-->
															<td class="text-end pe-0">
																<span class="fw-bold ms-3"><?php echo intval($dato['stoact']); ?></span>
															</td>
															<!--end::Qty=-->
															<!--begin::Price=-->
															<td class="text-end pe-0">
																<span class="fw-bold text-dark">$ <?php echo number_format($dato['precio_final'], 2); ?></span>
															</td>
															<!--end::Price=-->

															<!--begin::Rating-->
															<!-- <td class="text-end pe-0" data-order="rating-3">
																<div class="rating justify-content-end">
																	<div class="rating-label checked">
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																	</div>
																	<div class="rating-label checked">
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																	</div>
																	<div class="rating-label checked">
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																	</div>
																	<div class="rating-label">
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																	</div>
																	<div class="rating-label">
																		<span class="svg-icon svg-icon-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor" />
																			</svg>
																		</span>
																	</div>
																</div>
															</td> -->
															<!--end::Rating-->

															<td class="text-center">
																<span class="fw-bold text-dark">
																	<?php
																	$info = '';
																	if (number_format($dato['bonfija'], 0) > 0) {
																		if ($dato['tipboni'] == 'f') {
																			$info = 'Fijo $ ' . number_format($dato['bonfija'], 2);
																		} else {
																			$info = 'Porc. ' . intval($dato['bonfija']) . ' %';
																		}
																	?>
																		<div class="badge badge-light-success"><?php echo $info; ?></div>
																	<?php
																	} else {
																		echo '--';
																	}
																	?>
																</span>
															</td>

															<!--begin::Status=-->
															<!-- <td class="text-end pe-0" data-order="Scheduled"> -->
															<td class="text-center">
																<!--begin::Badges-->
																<span class="badge badge-light-<?php echo $dato['class_color']; ?>"><?php echo trim($dato['descripcion']); ?></span>
																<!--end::Badges-->
															</td>
															<!--end::Status=-->
															<!--begin::Action=-->
															<td class="text-end">
																<a onclick="return false;" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Acción
																	<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
																	<span class="svg-icon svg-icon-5 m-0">
																		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</a>
																<!--begin::Menu-->
																<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
																	<!--begin::Menu item-->
																	<div class="menu-item px-3">
																		<a href="product-edit?num=<?php echo trim($dato['numero']); ?>&den=<?php echo trim($dato['denom']); ?>" class="menu-link px-3">Editar</a>
																	</div>
																	<!--end::Menu item-->
																	<!--begin::Menu item-->
																	<!-- <div class="menu-item px-3">
																		<a href="#" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">Delete</a>
																	</div> -->
																	<!--end::Menu item-->
																</div>
																<!--end::Menu-->
															</td>
															<!--end::Action=-->
														</tr>
												<?php
													}
												}
												?>
												<!--end::Table row-->
												<!--begin::Table row-->
												<!--end::Table row-->
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Card header-->
							</div>
							<!--end::Products-->
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
	<!--begin::Javascript-->
	<script>
		// var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Vendors Javascript(used by this page)-->
	<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used by this page)-->
	<script src="assets/js/custom/apps/ecommerce/catalog/products.js"></script>
	<script src="assets/js/widgets.bundle.js"></script>
	<script src="assets/js/custom/widgets.js"></script>

	<script src="../js/constants.js"></script>
	<script src="js/components/close-session.js"></script>

	<!--end::Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>