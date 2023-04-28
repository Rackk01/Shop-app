<?php
session_start();
require_once('php/constants.php');

// echo '<br>';
// echo '<br>';
// echo json_encode($_SESSION["SD_CLIENTE_WEB_LOGUEADO"], true);
// echo '<br>';
// echo '<br>';
// echo str_replace('\/', '', json_encode($_SESSION["SD_CLIENTE_WEB_LOGUEADO"], true));

// echo $_SESSION["SD_CLIENTE_WEB_LOGUEADO"];
// return;

if (!isset($_SESSION["SD_CLIENTE_WEB_LOGUEADO"]) || $_SESSION["SD_CLIENTE_WEB_LOGUEADO"] == 'es_1') {
    unset($_SESSION["SD_CLIENTE_WEB_LOGUEADO"]);
    header('Location: ' . URL_APP) . 'login';
    die();
    return;
}

require_once('php/middleware/empres-config.php');
require_once('php/middleware/categorias.php');
require_once('php/middleware/modal-init.php');
require_once('php/middleware/pedidos.php');

require_once('php/util/methods.php');
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
	<!--begin::Vendor Stylesheets(used by this page)-->
	<link href="admin/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Vendor Stylesheets-->

    <!-- Styles Prop. -->
    <link rel="stylesheet" href="assets/css/modules/styles-maxi.css">
    <link rel="stylesheet" href="css/libs/sweetAlert.css">
    <link rel="stylesheet" href="css/disable-input-arrows.css">

</head>

<body>

    <?php require_once('php/components/header.php'); ?>

    <!-- ########################################################################################################## -->
    <!-- Mobile section -->
    <?php require_once('php/components/header-mobile.php'); ?>
    <!-- ########################################################################################################## -->

    <main class="main pages">

        <!-- <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                    <span></span> Pages <span></span> My Account
                    <span></span> Mi Cuenta
                </div>
            </div>
        </div> -->

        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>INICIO</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>MIS PEDIDOS</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>
                                                SEGUIMIENTO DE PEDIDO
                                            </a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" onclick="setDataDomicilio();" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>
                                                MI DOMICILIO
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" onclick="setDatosCuenta();" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>
                                                DATOS DE LA CUENTA
                                            </a>
                                        </li>
                                        <li class="nav-item" style="background: #ff7675;">
                                            <a class="nav-link" style=" color: white;" onclick="closeSession(); return false;"><i class="fi-rs-sign-out mr-10" style=" color: white;"></i>CERRAR SESIÓN</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">

                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 id="id-greeting-data-account" class="mb-0"></h3>
                                            </div>
                                            <div class="card-body">
                                                <p>
                                                    <!-- From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                                    manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a> -->
                                                    Desde el panel de tu cuenta podés verificar y ver fácilmente tus pedidos recientes,
                                                    administrar tu dirección de envío y editar tu contraseña junto con los detalles de su cuenta. Todo en un solo lugar!
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Listado de todos tus pedidos</h3>
                                            </div>
                                            <div class="card-body">
                                                <!-- <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Código</th>
                                                                <th>Fecha</th>
                                                                <th>Estado</th>
                                                                <th>Total</th>
                                                                <th>Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>#1357</td>
                                                                <td>March 45, 2020</td>
                                                                <td>Processing</td>
                                                                <td>$125.00 for 2 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2468</td>
                                                                <td>June 29, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$364.00 for 5 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2366</td>
                                                                <td>August 02, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$280.00 for 3 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#1357</td>
                                                                <td>March 45, 2020</td>
                                                                <td>Processing</td>
                                                                <td>$125.00 for 2 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2468</td>
                                                                <td>June 29, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$364.00 for 5 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2366</td>
                                                                <td>August 02, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$280.00 for 3 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#1357</td>
                                                                <td>March 45, 2020</td>
                                                                <td>Processing</td>
                                                                <td>$125.00 for 2 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2468</td>
                                                                <td>June 29, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$364.00 for 5 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2366</td>
                                                                <td>August 02, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$280.00 for 3 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#1357</td>
                                                                <td>March 45, 2020</td>
                                                                <td>Processing</td>
                                                                <td>$125.00 for 2 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2468</td>
                                                                <td>June 29, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$364.00 for 5 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2366</td>
                                                                <td>August 02, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$280.00 for 3 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> -->
                                                <section class="content-main">
                                                    <div class="content-header">
                                                        <div>
                                                            <!-- <h2 class="content-title card-title">Listado de pedidos</h2> -->
                                                            <p>Este es el historial de pedidos realizados con tu cuenta.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card mb-4">
                                                                <!-- <header class="card-header">
                                                                    <div class="row gx-3">
                                                                        <div class="col-lg-4 col-md-6 me-auto">
                                                                            <input type="text" placeholder="Search..." class="form-control">
                                                                        </div>
                                                                        <div class="col-lg-2 col-md-3 col-6">
                                                                            <select class="form-select">
                                                                                <option>Status</option>
                                                                                <option>Active</option>
                                                                                <option>Disabled</option>
                                                                                <option>Show all</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-2 col-md-3 col-6">
                                                                            <select class="form-select">
                                                                                <option>Show 20</option>
                                                                                <option>Show 30</option>
                                                                                <option>Show 40</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </header> -->
                                                                <!-- card-header end// -->
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table id="tabla-pedidos" class="table table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>Fecha</th>
                                                                                    <th>Total</th>
                                                                                    <th>Estado</th>
                                                                                    <!-- <th></th> -->
                                                                                    <th class="text-end">Acción</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $nombreCliente = getOneValueOfJsonData($_SESSION['SD_CLIENTE_WEB_LOGUEADO'], 'nombre');
                                                                                $emailCliente = getOneValueOfJsonData($_SESSION['SD_CLIENTE_WEB_LOGUEADO'], 'email');
                                                                                $telCliente = getOneValueOfJsonData($_SESSION['SD_CLIENTE_WEB_LOGUEADO'], 'ctel1');

                                                                                $dataArrayAllSales = getAllOrdersFromACustomer(getOneValueOfJsonData($_SESSION['SD_CLIENTE_WEB_LOGUEADO'], 'id_cliente'));
                                                                                //todo  Arreglar respuesta del servidor getAllOrdersFromACustomer() => retorna null en caso de no tener registros
                                                                                $amount = $dataArrayAllSales != 'null' ? count(json_decode($dataArrayAllSales, true)) : 0;
                                                                                if ($amount > 0) {
                                                                                    foreach (json_decode($dataArrayAllSales, true) as $dato) {
                                                                                ?>
                                                                                        <tr>
                                                                                            <td>#<?php echo $dato['nrocomp']; ?></td>
                                                                                            <td><b><?php echo date_format(date_create($dato['fecha']), 'd/m/Y'); ?></b></td>
                                                                                            <td>$<?php echo number_format($dato['debe'], 2); ?></td>
                                                                                            <td><span class="badge fs-6 rounded-pill badge-<?php echo strtolower($dato['estado']); ?>"><?php echo $dato['estado']; ?></span></td>
                                                                                            <!-- <td>07.05.2020</td> -->
                                                                                            <td class="text-end">
                                                                                                <a href="invoice?cp=<?php echo $dato['nrocomp']; ?>&ce=<?php echo $dato['costo_envio']; ?>&pd=<?php echo $dato['porcdesc']; ?>&fp=<?php echo $dato['nombre_for_pag']; ?>&fe=<?php echo $dato['fecha']; ?>&co=<?php echo $dato['comentario']; ?>&nc=<?php echo $nombreCliente; ?>&ec=<?php echo $emailCliente; ?>&tc=<?php echo $telCliente; ?>&de=<?php echo number_format($dato['debe'], 2); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-md rounded font-sm">Detalle</a>
                                                                                                <!-- <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div> -->
                                                                                            </td>
                                                                                        </tr>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>

                                                                                <!-- <tr>
                                                                                    <td>789</td>
                                                                                    <td><b>Guy Hawkins</b></td>
                                                                                    <td>$0.00</td>
                                                                                    <td><span class="badge rounded-pill alert-danger">Cancelled</span></td>
                                                                                    <td>25.05.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>478</td>
                                                                                    <td><b>Leslie Alexander</b></td>
                                                                                    <td>$293.01</td>
                                                                                    <td><span class="badge rounded-pill alert-warning">Pending</span></td>
                                                                                    <td>18.05.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>589</td>
                                                                                    <td><b>Albert Flores</b></td>
                                                                                    <td>$105.55</td>
                                                                                    <td><span class="badge rounded-pill alert-warning">Pending</span></td>
                                                                                    <td>07.02.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>345</td>
                                                                                    <td><b>Eleanor Pena</b></td>
                                                                                    <td>$779.58</td>
                                                                                    <td><span class="badge rounded-pill alert-success">Received</span></td>
                                                                                    <td>18.03.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>456</td>
                                                                                    <td><b>Dianne Russell</b></td>
                                                                                    <td>$576.28</td>
                                                                                    <td><span class="badge rounded-pill alert-success">Received</span></td>
                                                                                    <td>23.04.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>768</td>
                                                                                    <td><b>Savannah Nguyen</b></td>
                                                                                    <td>$589.99</td>
                                                                                    <td><span class="badge rounded-pill alert-success">Received</span></td>
                                                                                    <td>18.05.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>977</td>
                                                                                    <td><b>Kathryn Murphy</b></td>
                                                                                    <td>$169.43</td>
                                                                                    <td><span class="badge rounded-pill alert-success">Received</span></td>
                                                                                    <td>23.03.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>687</td>
                                                                                    <td><b>Jacob Jones</b></td>
                                                                                    <td>$219.78</td>
                                                                                    <td><span class="badge rounded-pill alert-success">Received</span></td>
                                                                                    <td>07.05.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>688</td>
                                                                                    <td><b>Jacob Jones</b></td>
                                                                                    <td>$219.78</td>
                                                                                    <td><span class="badge rounded-pill alert-success">Received</span></td>
                                                                                    <td>07.05.2020</td>
                                                                                    <td class="text-end">
                                                                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                                                                        <div class="dropdown">
                                                                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                                                            <div class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="#">View detail</a>
                                                                                                <a class="dropdown-item" href="#">Edit info</a>
                                                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr> -->
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- table-responsive //end -->
                                                                </div>
                                                                <!-- card-body end// -->
                                                            </div>
                                                            <!-- card end// -->
                                                        </div>
                                                        <!-- <div class="col-md-3">
                                                            <div class="card mb-4">
                                                                <div class="card-body">
                                                                    <h5 class="mb-3">Filter by</h5>
                                                                    <form>
                                                                        <div class="mb-4">
                                                                            <label for="order_id" class="form-label">Order ID</label>
                                                                            <input type="text" placeholder="Type here" class="form-control" id="order_id">
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label for="order_customer" class="form-label">Customer</label>
                                                                            <input type="text" placeholder="Type here" class="form-control" id="order_customer">
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label class="form-label">Order Status</label>
                                                                            <select class="form-select">
                                                                                <option>Published</option>
                                                                                <option>Draft</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label for="order_total" class="form-label">Total</label>
                                                                            <input type="text" placeholder="Type here" class="form-control" id="order_total">
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label for="order_created_date" class="form-label">Date Added</label>
                                                                            <input type="text" placeholder="Type here" class="form-control" id="order_created_date">
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label for="order_modified_date" class="form-label">Date Modified</label>
                                                                            <input type="text" placeholder="Type here" class="form-control" id="order_modified_date">
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label for="order_customer_1" class="form-label">Customer</label>
                                                                            <input type="text" placeholder="Type here" class="form-control" id="order_customer_1">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <!-- <div class="pagination-area mt-15 mb-50">
                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination justify-content-start">
                                                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#">
                                                                        <i class="fi-rs-arrow-small-right"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div> -->
                                                </section>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Seguimiento de pedido</h3>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order-id" placeholder="Found in your order confirmation email" type="text" />
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Billing email</label>
                                                                <input name="billing-email" placeholder="Email you used during checkout" type="email" />
                                                            </div>
                                                            <button class="submit submit-auto-width" type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Dirección de envío</h3>
                                            </div>

                                            <div class="toggle_info" style="background-color: PapayaWhip; margin-top: 25px; display: flex; justify-content: center;">
                                                <span>
                                                    <span class="text-muted font-lg">Aquí puedes setear la dirección en la que deseas recibir tus pedidos. Esta info. es super importante ¡Adelante!</span>
                                                </span>
                                            </div>

                                            <!-- Linea separadora -->
                                            <hr />

                                            <div class="card-body">
                                                <h5 class="card-title text-secondary">
                                                    Aquí puedes modificar la info. de tu domicilio que se utilizará para enviarte los pedidos.
                                                </h5>
                                                <form id="id-form-domicilio">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>DOMICILIO (Calle y altura/nro) <span class="required">*</span></label>
                                                            <input id="id-input-domi" style="color: #60A3D9; font-weight: bold" required="" class="form-control" name="calle" type="text" maxlength="50" placeholder="Ej. Bv. España 529" />
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>LOCALIDAD <span class="required">*</span></label>
                                                            <input id="id-input-locali" style="color: #60A3D9; font-weight: bold" required="" class="form-control" name="localidad" type="text" maxlength="50" placeholder="Ej. Villa María" />
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>CODIGO POSTAL (Número) <span class="required">*</span></label>
                                                            <input id="id-input-cpost" style="color: #60A3D9; font-weight: bold" required="" class="form-control" name="codpost" type="number" maxlength="10" placeholder="Ej. 5900" />
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>PROVINCIA <span class="required">*</span></label>
                                                            <input id="id-input-prov" style="color: #60A3D9; font-weight: bold" required="" class="form-control" name="provin" type="text" maxlength="40" placeholder="Ej. Córdoba" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Guardar cambios</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">Dirección de envío</h3>
                                                    </div>
                                                    <div class="card-body">

                                                        <p>
                                                            IMPORTANTE! Es la dirección a la que se enviará tu pedido en caso de que selecciones, <br />
                                                            como forma de envío a domicilo. Porcura proporcionar información exacta para evitar demoras. ¡Muchas gracias!
                                                        </p>

                                                        <address>
                                                            3522 Interstate<br />
                                                            75 Business Spur,<br />
                                                            Sault Ste. <br />Marie, MI 49783
                                                        </address>
                                                        <p>New York</p>
                                                        <a href="#" class="btn-small">Edit</a>

                                                        <form method="post" name="enq">
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Calle y altura <span class="required">*</span></label>
                                                                    <input required="" class="form-control" name="calle" type="text" placeholder="Ej. Bv. España 529" />
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Localidad <span class="required">*</span></label>
                                                                    <input required="" class="form-control" name="localidad" type="text" placeholder="Ej. Villa María" />
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Cod. postal <span class="required">*</span></label>
                                                                    <input required="" class="form-control" name="codpost" type="number" placeholder="Ej. 5900" />
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Provincia <span class="required">*</span></label>
                                                                    <input required="" class="form-control" name="provin" type="text" placeholder="Ej. Córdoba" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Shipping Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                            4299 Express Lane<br />
                                                            Sarasota, <br />FL 34249 USA <br />Phone: 1.941.227.4444
                                                        </address>
                                                        <p>Sarasota</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> -->

                                    </div>

                                    <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <!-- <h5>Account Details</h5> -->
                                                <h3 class="mb-0">Detalle de la cuenta</h3>
                                            </div>
                                            <div class="card-body">
                                                <!-- <p>Already have an account? <a href="page-login.html">Log in instead!</a></p> -->
                                                <form id="formDatosCuenta">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="idInputNombre">Nombre y apellido <span class="required">*</span></label>
                                                            <input id="idInputNombre" class="form-control" name="name" type="text" placeholder="Ingrese aquí el nombre y apellido" required />
                                                        </div>
                                                        <!-- <div class="form-group col-md-6">
                                                            <label>Last Name <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="phone" />
                                                        </div> -->
                                                        <div class="form-group col-md-12">
                                                            <label for="idInputEmail">Dirección email <span class="required">*</span></label>
                                                            <input id="idInputEmail" class="form-control" name="email" type="email" placeholder="Ingrese aquí el email" required />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <h3 class="mb-0">Seguridad</h3>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="idInputPasswordActual">Contraseña actual<span class="required">*</span></label>
                                                            <input id="idInputPasswordActual" class="form-control" name="password" placeholder="Ingrese aquí la contraseña actual" type="password" />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="idInputPasswordNueva">Nueva contraseña</label>
                                                            <input id="idInputPasswordNueva" class="form-control" name="newpassword" placeholder="Ingrese aquí la nueva contraseña" type="password" />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="idInputConfirmarPassword">Confirmar contraseña</label>
                                                            <input id="idInputConfirmarPassword" class="form-control" name="confirmpassword" placeholder="Confirmación de la contraseña" type="password" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit font-weight-bold">Guardar cambios</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once 'php/components/wp-floating.php'; ?>
    </main>

    <?php require_once('php/components/footer.php'); ?>

    <!-- Preloader Start -->
    <!-- <?php //require_once('php/components/preloader-start.php'); 
            ?> -->

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

    <!--begin::Vendors Javascript(used by this page)-->
    <script src="admin/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->

    <!-- JS Propios -->
    <script src="js/constants.js"></script>
    <script src="js/view/index.js"></script>

    <!-- Deben llamarse después del index.js -->
    <script src="js/middleware/sucursales.js"></script>

    <?php require_once('php/libs/sweet-alert.php'); ?>
    <script src="js/middleware/footer.js"></script>
    <script src="js/components/header.js"></script>
    <script src="js/view/data-account.js"></script>
</body>

</html>