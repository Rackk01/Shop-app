<?php
session_start();
require_once('../php/constants.php');
require_once('../php/middleware/empres-config.php');

unset($_SESSION["SD_USUARIO_ADMIN"]);

// if (isset($_SESSION["SD_USUARIO_ADMIN"])) {
// 	header('Location: ' . URL_APP . 'admin/product-list');
// 	die();
// 	return;
// }
?>

<!DOCTYPE html>
<html lang="es">
<!--begin::Head-->

<head>
	<!-- <base href="../../../"> -->
	<!-- <title> - the world's #1 selling Bootstrap Admin Theme Ecosystem for HTML, Vue, React, Angular &amp; Laravel by </title> -->
	<!-- <link rel="shortcut icon" href="assets/media/logos/favicon.ico" /> -->
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

<body data-kt-name="" id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
	<!--begin::Theme mode setup on page load-->
	<script>
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
	</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<!--begin::Page bg image-->
		<style>
			body {
				background-image: url('assets/media/auth/bg10.jpeg');
			}

			[data-theme="dark"] body {
				background-image: url('assets/media/auth/bg10-dark.jpeg');
			}
		</style>
		<!--end::Page bg image-->
		<!--begin::Authentication - Sign-in -->
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<!--begin::Aside-->
			<div class="d-flex flex-lg-row-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
					<!--begin::Image-->
					<!-- <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/media/auth/agency.png" alt="" /> -->
					<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="../src/img/empresa/LogoEmpresaRectangular.jpg" alt="" />
					<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="../src/img/empresa/LogoEmpresaRectangular.jpg" alt="" />
					<!-- <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/media/auth/agency-dark.png" alt="" /> -->
					<!--end::Image-->
					<!--begin::Title-->
					<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Rápido, eficiente y productivo</h1>
					</h1>
					<!--end::Title-->
					<!--begin::Text-->
					<div class="text-gray-600 fs-base text-center fw-semibold">En nuestro nuevo,
						<a href="#" class="opacity-75-hover text-primary me-1">panel administrativo</a>reunímos todas las funcionalidades
						<br />que necesitas para el funcionamiento de tu
						<a href="#" class="opacity-75-hover text-primary me-1">tienda ecommerce</a>.
						<br />Nuestro trabajo está respaldado por años de experiencia y capacitación constante en nuevas tecnologías.
						<br />
						<br />Copyright © 2022 All rights reserved | <a href="#" class="opacity-75-hover text-primary me-1">Servicios profesionales HUELLAS NET</a>
					</div>
					<!--end::Text-->
				</div>
				<!--end::Content-->
			</div>
			<!--begin::Aside-->
			<!--begin::Body-->
			<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
				<!--begin::Wrapper-->
				<div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
					<!--begin::Content-->
					<div class="w-md-400px">
						<!--begin::Form-->
						<!-- <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="#" action="#"> -->
						<form class="form w-100" id="id-form-login" method="POST">
							<!--begin::Heading-->
							<div class="text-center mb-11">
								<!--begin::Title-->
								<h1 class="text-dark fw-bolder mb-3">Iniciar sesión</h1>
								<!--end::Title-->
								<!--begin::Subtitle-->
								<div class="text-gray-500 fw-semibold fs-6">Solo podrás iniciar sesión con datos de administrador</div>
								<!--end::Subtitle=-->
							</div>
							<!--begin::Heading-->
							<!--begin::Login options-->
							<!-- <div class="row g-3 mb-9">
								<div class="col-md-6">
									<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
										<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3" />Sign in with Google
									</a>
								</div>
								<div class="col-md-6">
									<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
										<img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3" />
										<img alt="Logo" src="assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3" />Sign in with Apple
									</a>
								</div>
							</div> -->
							<!--end::Login options-->
							<!--begin::Separator-->
							<div class="separator separator-content my-14">
								<span class="w-125px text-gray-500 fw-semibold fs-7">Ingresá tus datos</span>
							</div>
							<!--end::Separator-->
							<!--begin::Input group=-->
							<div class="fv-row mb-8">
								<!--begin::Email-->
								<input id="id-input-email" type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
								<!--end::Email-->
							</div>
							<!--end::Input group=-->
							<div class="fv-row mb-3">
								<!--begin::Password-->
								<input id="id-input-password" type="password" placeholder="Contraseña" name="password" autocomplete="off" class="form-control bg-transparent" />
								<!--end::Password-->
							</div>
							<!--end::Input group=-->
							<!--begin::Wrapper-->
							<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
								<div></div>
								<!--begin::Link-->
								<!-- <a href="../../demo1/dist/authentication/layouts/overlay/reset-password.html" class="link-primary">Forgot Password ?</a> -->
								<!--end::Link-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Submit button-->
							<div class="d-grid mb-10">
								<!-- <button type="submit" id="kt_sign_in_submit" class="btn btn-primary"> -->
								<button type="submit" id="id-btn-login" class="btn btn-primary">
									<!--begin::Indicator label-->
									<span class="indicator-label">Iniciar sesión</span>
									<!--end::Indicator label-->
									<!--begin::Indicator progress-->
									<span class="indicator-progress">Por favor espere...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									<!--end::Indicator progress-->
								</button>
							</div>
							<!--end::Submit button-->
							<!--begin::Sign up-->
							<!-- <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
								<a href="../../demo1/dist/authentication/layouts/overlay/sign-up.html" class="link-primary">Sign up</a>
							</div> -->
							<!--end::Sign up-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Authentication - Sign-in-->
	</div>
	<!--end::Root-->
	<!--begin::Javascript-->
	<script>
		// var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Custom Javascript(used by this page)-->
	<!-- <script src="assets/js/custom/authentication/sign-in/general.js"></script> -->
	<!--end::Custom Javascript-->
	<!--end::Javascript-->

	<!-- JS PROPIOS -->
	<script src="../js/constants.js"></script>

	<script src="js/view/login-admin.js"></script>

	<?php require_once('../php/libs/sweet-alert.php'); ?>

</body>
<!--end::Body-->

</html>