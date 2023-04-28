<?php

require_once('../middleware/error.php');
require_once('../helper/error.php');
require_once('../helper/success.php');
require_once('../util/methods.php');
require_once('service.php');

if (!isset($_POST['funcion']) || $_POST['funcion'] == '') {
    // echo sendErrorMessage(1) . ' || ' . basename($_SERVER['PHP_SELF']);
    echo 'e1 - session.php';
    die;
    return;
}
$funcion = $_POST['funcion'];

switch ($funcion) {
    case 'file_exists':
        $url = $_POST['url'];
        $file_headers = @get_headers($url);
        if (str_replace('\/', '/', $file_headers[0]) == 'HTTP/1.1 404 Not Found') {
            echo 0;
        } else {
            echo 1;
        }
        break;
}
