<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
// require_once './php/util/methods.php';

require_once '../../util/methods.php';
// require_once '../../middleware/empres-config.php';

$funcion = $_POST['funcion'];

session_start();

switch ($funcion) {
    // =================================================================================================================

    #region sendSimulacroPrestamo
  case 'sendSimulacroPrestamo':
    $host = 'smtp.gmail.com'; // 'bautista.hls.com.ar';
    $email_host = 'bautista.sfot@gmail.com'; // admin@bautista.hls.com.ar';
    $password_host = 'cklkwcdikdrxslun'; // '@~j?vOCvH&io';
    $port_host = 587; // 587; // 587 GMail || 465 hls
    $name_empresa = 'Adm. Bautista';
    $email_destinatario = $_SESSION['SD_EMAIL_EMPRESA']; // 'maxidepetris.hls@gmail.com';
    $name_destinatario = 'Administrador';
    $email_subject = '¡Nuevo simulacro de préstamo!';

    $tipoPrestamo = $_POST['tipoPrestamo'];
    $montoPrestamo = $_POST['montoPrestamo'];
    $cuotasPrestamo = $_POST['cuotasPrestamo'];
    // $gastosDeGestion = $_POST['gastosDeGestion'];
    $vechiculo = $_POST['vechiculo'];
    // $fileTitulo = $_POST['fileTitulo'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['tel'];
    $linkWhatsApp = $_POST['linkWhatsApp'];

    $email_body = '
        <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css" />
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                <style>
                    #tableProductos {
                        font-family: Arial, Helvetica, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                    }

                    #tableProductos td,
                    #tableProductos th {
                        border: 1px solid #ddd;
                        padding: 8px;
                    }

                    #tableProductos tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    #tableProductos tr:hover {
                        background-color: #ddd;
                    }

                    #tableProductos th {
                        padding-top: 12px;
                        padding-bottom: 12px;
                        text-align: left;
                        background-color: #2e7cc5;
                        color: white;
                    }

                    .cardDisc {
                        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                        max-width: 300px;
                        margin: auto;
                        margin-right: 0%;
                        text-align: center;
                        font-family: arial;
                    }

                    .price {
                        color: rgb(72, 65, 158);
                        font-size: 22px;
                        font-weight: bold;
                    }
                </style>
            </head>

            <body class="hold-transition sidebar-mini container">
                <!-- IMÁGENES Y TEXTOS INICIALES -->
                <div style="text-align:center;">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="background-color: white;">
                                    <!-- <img src="' . "" . '" style="align-self: center;" width="250"> -->
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: rgb(255, 255, 255);">
                                    <img src="https://brinco.hls.com.ar/images/Check.png" style="align-self: center;" width="100">
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: LightBlue;">
                                    <h2 style="color: rgb(17, 89, 161);">¡Nuevo simulacro de préstamo!</h2>
                                    <!-- <p style="font-size: 16px; color: #777777;">Nos pondremos en contacto contigo para realizar la entrega del pedido.<br></p> -->
                                    <!-- <p style="font-size: 16px; color: #3f3a3a;">Por cualquier consulta puedes escribirnos a <strong>' . "" . '</strong><br></p> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <br><br>

                    <a href=" ' . "$linkWhatsApp" . ' " target="_blank"><img src="https://bautista.hls.com.ar/src/img/logo-wasap.png" width="50" height="50"></a>
                    <h5>CONTACTO DIRECTO A WHATSAPP</h5>
                    
                </div>

                <!-- TABLA -->
                <div class="row" style="padding-top: 10px;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detalle del simulacro</h3>
                            </div>

                            <div>
                                <table id="tableProductos">
                                    <thead>
                                        <tr>
                                            <th>Monto</th>
                                            <th>Tipo</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Cuotas</th>
                                            <th>Vehículo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> $ ' . "$montoPrestamo" . ' </td>
                                            <td> ' . "$tipoPrestamo" . ' </td>
                                            <td> ' . "$nombre" . ' </td>
                                            <td> ' . "$telefono" . ' </td>
                                            <td> ' . "$cuotasPrestamo" . ' </td>
                                            <td> ' . "$vechiculo" . ' </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </body>
        </html>
        ';

    sendEmail(
      $host,
      $email_host,
      $password_host,
      $port_host,
      $name_empresa,
      $email_destinatario,
      $name_destinatario,
      $email_subject,
      $email_body
    );
    #endregion
    break;

    // =================================================================================================================

    #region sendEmailSuscriptionNewsletter
  case 'sendEmailSuscriptionNewsletter':
    $host = 'mail.hls.com.ar'; // 'smtp.gmail.com'; // 'bautista.hls.com.ar';
    $email_host = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin'); // 'bautista.sfot@gmail.com'; // admin@bautista.hls.com.ar';
    $password_host = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin_password'); // 'cklkwcdikdrxslun'; // '@~j?vOCvH&io';
    $port_host = 465; // 587; // 587; // 587 GMail || 465 hls
    $name_empresa = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'nombre'); // 
    $email_destinatario = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin'); // $_SESSION['SD_EMAIL_EMPRESA']; // 'maxidepetris.hls@gmail.com';
    $name_destinatario = 'Administrador';
    $email_subject = '¡Nueva suscripción newsletter!';

    $emailSuscribe = $_POST['emailSuscribe'];

    $email_body = 'Solicitud de suscripción de: ' . $emailSuscribe;

    sendEmail(
      $host,
      $email_host,
      $password_host,
      $port_host,
      $name_empresa,
      $email_destinatario,
      $name_destinatario,
      $email_subject,
      $email_body
    );
    #endregion
    break;

    // =================================================================================================================

    #region sendEmailPedido
  case 'sendEmailPedido':
    // setMessageInfoText("getOneValueOfJsonData(SESSION[SD_EMPRES], 'email_admin')", getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin'));
    // setMessageInfoText("getOneValueOfJsonData(SESSION[SD_EMPRES], 'email_admin_password')", getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin_password'));

    $host = 'mail.hls.com.ar'; // 'smtp.gmail.com'; // 'bautista.hls.com.ar';
    $email_host = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin'); // 'bautista.sfot@gmail.com'; // admin@bautista.hls.com.ar';
    $password_host = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin_password'); // 'cklkwcdikdrxslun'; // '@~j?vOCvH&io';
    $port_host = 465; // 587; // 587; // 587 GMail || 465 hls
    $name_empresa = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'nombre'); //
    $email_destinatario = getOneValueOfJsonData($_SESSION['SD_CLIENTE_WEB_LOGUEADO'], 'email'); // getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin'); // $_SESSION['SD_EMAIL_EMPRESA']; // 'maxidepetris.hls@gmail.com';
    $name_destinatario = getOneValueOfJsonData($_SESSION['SD_CLIENTE_WEB_LOGUEADO'], 'nombre'); // getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin'); // 'Cliente';
    $email_subject = '¡NUEVO PEDIDO!';

    $email_ventas_empresa = trim($_SESSION['SD_EMAIL_VENTAS']);

    $ctel = getOneValueOfJsonData(trim($_SESSION['SD_CLIENTE_WEB_LOGUEADO']), 'ctel1');

    $urlImg = file_exists($_SESSION['rectangularLogo']) ? $_SESSION['rectangularLogo'] : '../'.$_SESSION['rectangularLogo'];

    #region BODY ========================================================================================================
    $body = '<!DOCTYPE html>
        <html lang="es">

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css" />
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

          <style>
            #tableProductos {
              font-family: Arial, Helvetica, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
        
            #tableProductos td,
            #tableProductos th {
              border: 1px solid #ddd;
              padding: 8px;
            }
        
            #tableProductos tr:nth-child(even) {
              background-color: #f2f2f2;
            }
        
            #tableProductos tr:hover {
              background-color: #ddd;
            }
        
            #tableProductos th {
              padding-top: 12px;
              padding-bottom: 12px;
              text-align: left;
              background-color: #2e7cc5;
              color: white;
            }
        
            .cardDisc {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 300px;
                margin: auto;
                margin-right: 0%;
                text-align: center;
                font-family: arial;
              }
          
              .price {
                color: rgb(72, 65, 158);
                font-size: 22px;
                font-weight: bold;
              }
          </style>
        </head>
        <body class="hold-transition sidebar-mini">
          <!-- IMÁGENES Y TEXTOS INICIALES -->
          <div style="text-align:center;">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="background-color: white;">
                    <img src="'.$urlImg.'" style="align-self: center;" width="290">
                  </td>
                </tr>
                <tr>
                  <td style="background-color: rgb(255, 255, 255);">
                    <img src="https://brinco.hls.com.ar/images/Check.png" style="align-self: center;" width="100">
                  </td>
                </tr>
                <tr>
                  <td style="background-color: LightBlue;">
                    <h2 style="color: rgb(17, 89, 161);">Gracias por tu compra!</h2>
                    <p style="font-size: 16px; color: #777777;">
                      Nos pondremos en contacto contigo para realizar la entrega del pedido.<br></p>
                    <p style="font-size: 16px; color: #3f3a3a;">
                      Por cualquier consulta puedes escribirnos a <strong>' . "$email_ventas_empresa" . '</strong><br></p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        
          <!-- TABLA -->
          <div class="row" style="padding-top: 10px;">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Detalle del pedido</h3>
                </div>
        
                <div>
                  <table id="tableProductos">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Cantidad</th>
                        <th>Detalle</th>
                        <th>Precio Unit.</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>';


    // for ($i = 0; $i < count($arreglo); $i++) {
    // echo json_encode($_SESSION['SD_CART'], true);
    $montoTotalPedidoConDescuento = 0;
    $montoDescuento = 0;
    $montoTotalPedido = 0;
    $porcentajeDescuentoPedido = 0;
    $costoEnvio = $_SESSION['SD_MONTO_FINAL_ENVIO'];

    $porcentajeRecargoPorForpagSeleccionada = 00.00;
    $montoRecargoPorForpagSeleccionada = 00.00;
    if (isset($_SESSION['SD_MONTO_PORCENTAJE_INCREMENTO']) && $_SESSION['SD_MONTO_PORCENTAJE_INCREMENTO'] != '') {
      $montoRecargoPorForpagSeleccionada = $_SESSION['SD_MONTO_PORCENTAJE_INCREMENTO'];
    }
    if (isset($_SESSION['SD_PORCENTAJE_INCREMENTO']) && $_SESSION['SD_PORCENTAJE_INCREMENTO'] != '') {
      $porcentajeRecargoPorForpagSeleccionada = $_SESSION['SD_PORCENTAJE_INCREMENTO'];
    }

    $valueForpag = 1;
    $descrip = '';

    foreach (array($_SESSION['SD_PEDIDO_ACTUAL_CONFIRMADO']) as $dato) {
      $montoTotalPedido = (floatval($dato['montoTotalSinDescuentoNiEnvio']));
      $montoTotalPedidoConDescuento = (floatval($dato['montoTotalFinalPedido']));

      $montoDescuento = number_format(floatval($montoTotalPedido) - floatval($montoTotalPedidoConDescuento), 2);
      $porcentajeDescuentoPedido = number_format(trim($dato['descuentoGral']));

      $valueForpag = number_format(trim($dato['valueForpag']));
      $descrip = trim($dato['infoAdic']);
      setMessageInfoText('$descrip', $descrip);

      $montoTotalPedidoConDescuento += floatval($montoRecargoPorForpagSeleccionada);
      $montoTotalPedidoConDescuento = number_format($montoTotalPedidoConDescuento, 2);
    }

    $montoRecargoPorForpagSeleccionada = number_format($montoRecargoPorForpagSeleccionada, 2);
    $montoTotalPedido = number_format($montoTotalPedido, 2);

    foreach ($_SESSION['SD_CART'] as $dato) {
      $montoTotalItemLocal = floatval($dato['preciofinal']) * floatval($dato['cantidad']);

      $nroLocal = $dato['numero'];
      $denomLocal = $dato['denom'];
      $prefinLocal = number_format(floatval($dato['preciofinal']), 2);
      $cantidad = number_format($dato['cantidad']);

      $idpresentacion = 0;
      if (number_format($dato['idpresentacion']) > 0) {
        $idpresentacion = $dato['idpresentacion'];
      } else {
        $idpresentacion = 0;
      }

      $presentacion;
      if ($idpresentacion != 0) {
        $presentacion = $dato['pesopres'] . ' Kg.';
      } else {
        $presentacion = 'Unidades';
      }

      $body .= '<tr>
                        <td> ' . $nroLocal . ' </td>
                        <td> ' . $cantidad . ' </td>
                        <td> ' . $denomLocal . ' | Present.: ' . $presentacion . ' </td>
                        <td> $ ' . $prefinLocal . ' </td>
                        <td> $ ' . number_format($montoTotalItemLocal, 2, ',', '.') . ' </td>
                    </tr>';
    }

    $body .= '</tbody>
            </table>
            </div>
            </div>
            </div>
            </div>
            <!-- RESUMEN DE PEDIDO -->
              <div class="row" style="padding-top: 10px;">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <!-- <h3 class="card-title">Resumen</h3> -->
                    </div>
                    <!-- /.card-header -->
                    <div>
                    <table id="tableProductos" style="width: 300px;" align="right">
                    <thead>
                          <tr>
                          <th style="width: 35px; text-align: right;">Subtotal</th>
                          <td>$ ' . "$montoTotalPedido" . '</td>
                          </tr>
                          <tr>
                            <th style="text-align: right;">Descuento</th>
                            <td>' . "$porcentajeDescuentoPedido" . ' % - $ ' . "$montoDescuento" . '</td></td>
                          </tr>
                          <tr>
                            <th style="text-align: right;">Costo de envio</th>
                            <td>$ ' . "$costoEnvio" . '</td>
                            </tr>
                          <tr>
                          <tr>
                            <th style="text-align: right;">Recargo por forma de pago seleccionada</th>
                            <td>' . "$porcentajeRecargoPorForpagSeleccionada" . ' % - $ ' . "$montoRecargoPorForpagSeleccionada" . '</td>
                            </tr>
                          <tr>
                            <th style="text-align: right;">TOTAL</th>
                            <td>$ ' . "$montoTotalPedidoConDescuento" . '</td>
                          </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
        
              <!-- DATOS DEL CLIENTE -->
              <div style="text-align:center;">
                <table width="100%" cellspacing="0" cellpadding="0">
                  <tbody>
                      <td style="background-color: LightBlue;">
                      <br>
                      <br>
                        <h2 style="color: rgb(17, 89, 161);">CLIENTE</h2>
                        <p style="font-size: 16px; color: #777777;">
                        ' . "$name_destinatario" . '<br></p>
                        <p style="font-size: 16px; color: #3f3a3a;">
                        ' . utf8_encode('Nro tel.') . ': <strong>' . "$ctel" . '</strong><br></p>
                          Email: <strong>' . "$email_destinatario" . '</strong><br></p>
                          <br>
                          <br>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
        ';

    if ($valueForpag == 2 || $valueForpag == '2') { //En caso de que sea transferencia bancaria el método de pago seleccionado
      // Obtengo el CBU/ALIAS correspondiente
      $cbu = $_SESSION['SD_CBU'];
      $alias = $_SESSION['SD_ALIAS'];

      $body .= '
          <!-- DATOS PARA LA TRANSFERENCIA -->
          <div style="text-align:center;">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                  <td style="background-color: LightBlue;">
                    <h2 style="color: rgb(17, 89, 161);">Forma de pago seleccionada: Transferencia bancaria</h2>
                    <p style="font-size: 16px; color: #777777;">
                    Datos de la cuenta para realizar la transferencia<br></p>
                    <p style="font-size: 16px; color: #3f3a3a;">
                      CBU: <strong>' . "$cbu" . '</strong><br></p>
                    <p style="font-size: 16px; color: #3f3a3a;">
                      ALIAS: <strong>' . "$alias" . '</strong><br></p>
                      <br>
                      <br>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          ';
    } else {
      $body .= '
          <!-- DESCRIPCIÓN DE LA FORMA DE PAGO SELECCIONADA 
          <div style="text-align:center;">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                  <td style="background-color: LightBlue;">
                    <h2 style="color: rgb(17, 89, 161);">Forma de pago seleccionada: ' . "$descrip" . '</h2>
                      <br>
                      <br>
                  </td>
                </tr>
              </tbody>
            </table>
          </div> -->
          ';
    }

    $body .= '
        <!-- DESCRIPCIÓN DE LA FORMA DE ENVÍO SELECCIONADA -->
          <div style="text-align:center;">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                  <td style="background-color: LightBlue;">
                    <h2 style="color: rgb(17, 89, 161);">Comentario: ' . "$descrip" . '</h2>
                      <br>
                      <br>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        ';

    $body .= '
          </body>
          </html>
        ';
    #endregion ==============================================================================

    sendEmail(
      $host,
      $email_host,
      $password_host,
      $port_host,
      $name_empresa,
      $email_destinatario,
      $name_destinatario,
      $email_subject,
      $body
    );
    #endregion
    break;

    // =================================================================================================================

    #region sendEmailRecoverPass
  case 'sendEmailRecoverPass':
    $host = 'mail.hls.com.ar'; // 'smtp.gmail.com'; // 'bautista.hls.com.ar';
    $email_host = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin'); // 'bautista.sfot@gmail.com'; // admin@bautista.hls.com.ar';
    $password_host = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin_password'); // 'cklkwcdikdrxslun'; // '@~j?vOCvH&io';
    $port_host = 465; // 587; // 587; // 587 GMail || 465 hls
    $name_empresa = getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'nombre');
    $email_destinatario = $_POST['email']; // getOneValueOfJsonData($_SESSION['SD_EMPRES'], 'email_admin'); // $_SESSION['SD_EMAIL_EMPRESA']; // 'maxidepetris.hls@gmail.com';
    $name_destinatario = 'Recupero';
    $email_subject = '¡Solicitud de recupero de contraseña!';

    // $emailSuscribe = $_POST['emailSuscribe'];

    $email_body = 'Su contraseña actual para iniciar sesión es: <strong>' . $_SESSION['SD_PASSWORD_RECOVERER'] . '</strong>';

    sendEmail(
      $host,
      $email_host,
      $password_host,
      $port_host,
      $name_empresa,
      $email_destinatario,
      $name_destinatario,
      $email_subject,
      $email_body
    );
    #endregion
    break;

    // =================================================================================================================

}

function sendEmail(
  $host,
  $email_host,
  $password_host,
  $port_host,
  $name_empresa,
  $email_destinatario,
  $name_destinatario,
  $email_subject,
  $email_body
) {
  $mail = new PHPMailer(true); // Create an instance; passing `true` enables exceptions

  try {
    // Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
    $mail->isSMTP();                          // Send using SMTP
    $mail->Host         = 'mail.hls.com.ar';  // $host;          // 'mail.fristo.com.ar';                         // $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth     = true;               // Enable SMTP authentication
    $mail->Username     = 'fristo@hls.com.ar'; //$email_host;    // 'congelados@fristo.com.ar'; // $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password     = 'd;$[&z.7ltdv';   // $password_host; // 'Ge}*0,-$8!u~'; // $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure   = 'ssl';            // 'tsl';          // 'ssl'; // PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port         = 465;              // $port_host;     // 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('fristo@hls.com.ar', $name_empresa);
    $mail->addAddress($email_destinatario, $name_destinatario);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    $mail->addBCC('maxidepetris.hls@gmail.com', 'Nuevo Pedido!');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    $mail->SMTPKeepAlive = true;
    $mail->Mailer = "smtp";

    // Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $email_subject; // 'Here is the subject';
    $mail->Body    = $email_body; // 'This is the HTML message body <b>in bold!</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->CharSet = 'UTF-8';

    // $mail->send();
    // echo '1'; // ---> Message has been sent';
    if (!$mail->send()) {
      echo 'fe_1'; // 'Error al enviar email'; // Frontend Error 1
      // echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
      echo 'fs_1'; // 'Mail enviado correctamente'; // Frontend Success 1
    }
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
