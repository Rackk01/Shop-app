
<?php
if (file_exists('php/services/service.php')) {
    require_once('php/services/service.php');
    require_once('php/helper/error.php');
    require_once('php/util/methods.php');
} else {
    require_once('../php/services/service.php');
    require_once('../php/helper/error.php');
    require_once('../php/util/methods.php');
}

// =====================================================================================================================================
// VARIABLES ASOCIADAS A LAS VISTAS
$dataArrayBranchesOffices = getAllBranchesOffices();
// setMessageInfoText('dataArrayBranchesOffices', $dataArrayBranchesOffices);
$amountOfBranchesOffices = 0;
if ($dataArrayBranchesOffices != 0) {
    $amountOfBranchesOffices = count(json_decode($dataArrayBranchesOffices, true));
}

$dataArrayEmpres =  getDataEmpres(); // '{"nombre":"BRINCO IT Servicios Profesionales","nrorec":"25","dgriib":"","cajpre":"","iva":"","jubila":"","nrocaj":"","precio":"S","conta":"","ctacte":"","stocko":"","orden":"","remito":"","nrosuc":"","remito1":"","sto_neg":"","pedido":"","pedido1":"","imp_fac":"","puerto":"","subdicoja":"","color":"","deccant":"2","syspat":"","cartera":"","matricula":"","modipro":"","red":"","exporta":"","prove":"","sijp":"","barras":"","lector":"","a2000":"","serie":"","seriebak":"","jaiubic":"","interes":"","fiscal":"","ivaart":"","caja":"","solowin":"","ciecaj":"","tieimi":"","canitem":"","rapido":"","envase":"","aimi":"","vendedor":"","agencia":"","surtidor":"","relisp":"","turno":"","bonif":"","facrec":"","cope":"","muelis":"","lista":"1  ","cven":"1","descrip":"Apoyados en alianzas estratégicas con las principales marcas tecnológicas nos fuimos volviendo referentes del mercado, ampliando nuestra oferta a mas de 2.000 productos de u00faltima generación, los cuales mantenemos y renovamos día a día con el objetivo de trasladar a nuestros clientes la excelencia, calidad, innovación y vanguardia que nos exigimos en cada paso que damos.","somos":"Somos una empresa familiar fundada en la ciudad de Córdoba en el año 2009. Nuestro principal capital invertido fue esfuerzo, trabajo y las ganas de superarnos día a día con la esperanza de crear una estructura sólida que nos permitiera hacer frente a los distintos desafíos que se nos podían presentar a lo largo del tiempo..","inicios":"Inicialmente nuestro primer local se ubicaba en el garaje de una casa, local en el cual nos enfocábamos principalmente en brindar servicio técnico de computadoras. Con el pasar del tiempo fuimos incorporando distintos productos para su comercialización lo que nos llevó a ampliar nuestras instalaciones de ventas y fue así como luego de un año el local se traslado al domicilio donde se encuentra hoy en día..","mision":"Ofrecer productos que acompañen y satisfagan las necesidades de nuestros clientes, acompañando los mismos con la mejor atención, asesoramiento y servicio post venta. Brindando además, la posibilidad de que cualquier persona en todo el territorio nacional pueda adquirir nuestros productos desde la comodidad de su hogar..","vision":"Ser la empresa líder y de referencia, a nivel nacional, en la comercialización y distribución de productos..","email_admin":"fristo@hls.com.ar","email_admin_password":"d;$&z.7ltdv","descri":"Brinco - Servicios Profesionales","domicilio":"Alem 154","localidad":"Villa María - CÓRDOBA","tel":"3512274431"}'; //
$whatsappEmpres = getOneValueOfJsonData($dataArrayEmpres, 'tel');
$_SESSION['SD_EMPRES'] = $dataArrayEmpres;

$dataArraySliders = getAllSliders(); // '[{"id":"1","titulo":"Productos frescos, con el mejor descuento...","subtitulo":"Los productos son de calidad...","linkprod":"http://localhost/santiago/santiago-app","url_img":"src/img/slider/slider-1.png"},{"id":"2","titulo":"Productos frescos, con el mejor descuento...","subtitulo":"Los productos son de calidad...","linkprod":"http://localhost/santiago/santiago-app","url_img":"src/img/slider/slider-2.png"}]'; //
// setMessageInfoText('dataArraySliders', $dataArraySliders);
$dataDescuentoGeneral = getDescuentoGeneralEmpresConfig(); // getDescuentoGeneralEmpresConfig();
// setMessageInfoText('dataDescuentoGeneral', $dataDescuentoGeneral);

$_SESSION['SD_COSTO_ENVIO_PEDIDO'] = $costoEnvio = getCostoEnvio(); // getCostoEnvio();
$_SESSION['SD_TOPE_ENVIO_GRATIS_PEDIDO'] = $topeEnvioGratis = getTopeEnvioGratis(); // getTopeEnvioGratis();
$_SESSION['SD_PORCENTAJE_RECARGO_PEDIDO'] = $porcentajeRecargoPedido = getRecargoPedidoMP(); // getRecargoPedidoMP();

// setMessageInfoText('costoEnvio', $costoEnvio);
// setMessageInfoText('topeEnvioGratis', $topeEnvioGratis);
// setMessageInfoText('porcentajeRecargoPedido', $porcentajeRecargoPedido);


getCBU();
getAlias();
getEmailVentas();
// =====================================================================================================================================

// =====================================================================================================================================

// =====================================================================================================================================
// FUNCIONES

function getRectangularUrlLogo()
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getRectangularUrlLogo');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    $responseQuery = str_replace('[', '', $responseQuery);
    $responseQuery = str_replace(']', '', $responseQuery);

    $_SESSION['rectangularLogo'] = getOneValueOfJsonData($responseQuery, 'valor');

    return getOneValueOfJsonData($responseQuery, 'valor');
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getNewsletterImg()
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getNewsletterImg');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    $responseQuery = str_replace('[', '', $responseQuery);
    $responseQuery = str_replace(']', '', $responseQuery);

    return getOneValueOfJsonData($responseQuery, 'valor');
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getTittlePest()
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getTittlePest');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    $responseQuery = str_replace('[', '', $responseQuery);
    $responseQuery = str_replace(']', '', $responseQuery);

    return getOneValueOfJsonData($responseQuery, 'valor');
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getSquareLogo()
{
    // Logo cuadrado - Obtengo la ruta desde la base de datos

    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getSquareLogo');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    $responseQuery = str_replace('[', '', $responseQuery);
    $responseQuery = str_replace(']', '', $responseQuery);

    $_SESSION['squareLogo'] = getOneValueOfJsonData($responseQuery, 'valor');

    return getOneValueOfJsonData($responseQuery, 'valor');
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getAllBranchesOffices()
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getBranchesOffices');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery | getBranchesOffices()', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getDataEmpres()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getDataEmpres');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    $responseQuery = str_replace('[', '', $responseQuery);
    $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery | getBranchesOffices()', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getAllSliders()
{
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getAllSliders');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery | getBranchesOffices()', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    return reemplazarPorAcentos($responseQuery);
    // setMessageInfoText('reemplazarPorAcentos($responseQuery)', reemplazarPorAcentos($responseQuery));

    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getDescuentoGeneralEmpresConfig()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getDescuentoGeneralEmpresConfig');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // setMessageInfoText('$responseQuery | getBranchesOffices()', $responseQuery);
    // setMessageInfoText('$responseQuery | getBranchesOffices() | getOneValueOfJsonData($responseQuery, valor', getOneValueOfJsonData($responseQuery, 'valor'));

    // return getOneValueOfJsonData($responseQuery, 'valor');
    // session_start();
    $_SESSION['SD_GENERAL_DISCOUNT'] = reemplazarPorAcentos($responseQuery);
    return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getTittleSectionCombo()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getTittleSectionCombo');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            echo decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    // $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // $_SESSION['SD_GENERAL_DISCOUNT'] = reemplazarPorAcentos($responseQuery);
    // return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    // return $responseQuery;
}

function getCostoEnvio()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getCostoEnvio');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            return decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    // $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // $_SESSION['SD_GENERAL_DISCOUNT'] = reemplazarPorAcentos($responseQuery);
    // return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    return $responseQuery;
}

function getTopeEnvioGratis()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getTopeEnvioGratis');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            return decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    // $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // $_SESSION['SD_GENERAL_DISCOUNT'] = reemplazarPorAcentos($responseQuery);
    // return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    return $responseQuery;
}

function getRecargoPedidoMP()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getRecargoPedidoMP');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            return decodificarData($value);
            $arrayValue = json_decode(decodificarData($value), true);
            $responseQuery = json_encode($arrayValue, true);
        }
    }

    // $responseQuery = str_replace('\/', '/', $responseQuery);
    // $responseQuery = str_replace('[', '', $responseQuery);
    // $responseQuery = str_replace(']', '', $responseQuery);

    // $_SESSION['SD_GENERAL_DISCOUNT'] = reemplazarPorAcentos($responseQuery);
    // return reemplazarPorAcentos($responseQuery);
    // return str_replace('\/', '/', ($responseQuery));
    return $responseQuery;
}

function getMercadoPagoAccessToken()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getMercadoPagoAccessToken');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getMercadoPagoPublicKey()
{
    // Tabla empres
    // setMessageInfoText('empres-config.php', 'LLAMADA');

    $funcion = codificarData('getMercadoPagoPublicKey');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getEmailVentas()
{
    // Email de ventas config. en empres_config

    $funcion = codificarData('getEmailVentas');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            $_SESSION['SD_EMAIL_VENTAS'] = decodificarData($value);
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getCBU()
{
    // Email de ventas config. en empres_config

    $funcion = codificarData('getCBU');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            $_SESSION['SD_CBU'] = decodificarData($value);
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getAlias()
{
    // Email de ventas config. en empres_config

    $funcion = codificarData('getAlias');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            $_SESSION['SD_ALIAS'] = decodificarData($value);
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getUrlFace()
{
    // Email de ventas config. en empres_config

    $funcion = codificarData('getUrlFace');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // $_SESSION['SD_URL_FACE'] = decodificarData($value);
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getUrlInsta()
{
    // Email de ventas config. en empres_config

    $funcion = codificarData('getUrlInsta');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // $_SESSION['SD_URL_FACE'] = decodificarData($value);
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getUrlTwi()
{
    // Email de ventas config. en empres_config

    $funcion = codificarData('getUrlTwi');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // $_SESSION['SD_URL_FACE'] = decodificarData($value);
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getUrlYout()
{
    // Email de ventas config. en empres_config

    $funcion = codificarData('getUrlYout');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // $_SESSION['SD_URL_FACE'] = decodificarData($value);
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}

function getFlagCountProductSpecials()
{
    // Email de ventas config. en empres_config

    $funcion = codificarData('getFlagCountProductSpecials');
    $bd = codificarData(DB_APP); // codificarData(getOneValueOfJsonData($_SESSION['SD_USER'], 'bd'));

    $response = decodificarData(SendRequest('empres_config.php', $funcion, $bd));
    $array = json_decode($response, true);

    $responseQuery = '';

    // setMessageInfoText('empres-config.php', $response);

    foreach ($array as $key => $value) {
        if ($key == 'data') {
            // $_SESSION['SD_URL_FACE'] = decodificarData($value);
            return decodificarData($value);
            // $arrayValue = json_decode(decodificarData($value), true);
            // $responseQuery = json_encode($arrayValue, true);
        }
    }
}
// =====================================================================================================================================