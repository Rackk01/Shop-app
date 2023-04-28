<?php
session_start();

require_once('../php/constants.php');

if (!isset($_SESSION["SD_USUARIO_ADMIN"])) {
	header('Location: ' . URL_APP . 'admin/login');
	die();
	return;
}

require_once('../php/middleware/empres-config.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<!-- <base href="../"> -->
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
	<link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Vendor Stylesheets-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->

	<!-- Styles Prop. -->
	<link rel="stylesheet" href="../assets/css/modules/styles-maxi.css">
	<link rel="stylesheet" href="../css/libs/sweetAlert.css">

</head>

<body data-kt-name="" id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
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

	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<div id="kt_app_header" class="app-header">
				<div class="app-container container-fluid d-flex align-items-stretch justify-content-between">

					<!-- HEADER INICIO -->
					<?php require_once('php/components/header.php'); ?>
					<!-- END HEADER -->
				</div>
			</div>

			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				<!-- SIDEBAR MENU -->
				<?php require_once('php/components/side-bar-menu.php'); ?>
				<!-- END SIDEBAR MENU -->

				<!-- CONTENT PAGE -->
				<!-- END CONTENT PAGE -->

			</div>
		</div>
	</div>

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
	<script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used by this page)-->
	<script src="assets/js/widgets.bundle.js"></script>
	<script src="assets/js/custom/widgets.js"></script>
	<script src="assets/js/custom/apps/chat/chat.js"></script>
	<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
	<script src="assets/js/custom/utilities/modals/users-search.js"></script>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->

	<!-- JS Propios -->
	<script src="../js/constants.js"></script>
	<?php require_once('../php/libs/sweet-alert.php'); ?>
	<script src="js/components/close-session.js"></script>

</body>
<!--end::Body-->

</html>