<?php

function SendRequest($file, $function, $db)
{
    $url = URL_BACKEND . 'backend/' . $file;
    $data = array(
        'a' => $function,
        'b' => $db,
        'c' => 'web'
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n", // 'header'  => "Content-Type: text/json; charset=UTF-8'",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        echo sendErrorMessage(4) . ' || ' . $file . ' || ' . $function . ' || ' . $db . ' || ' . basename($_SERVER['PHP_SELF']);
    } else {
        return $result;
    }
}

function SendRequestOneParam($file, $function, $db, $jsonDataArray)
{
    $url = URL_BACKEND . 'backend/' . $file;
    $data = array(
        'a' => $function,
        'b' => $db,
        'c' => 'web',
        'd' => $jsonDataArray
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n", // 'header'  => "Content-Type: text/json; charset=UTF-8'",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
        return false; // echo sendErrorMessage(4) . ' || ' . $file . ' || ' . $function . ' || ' . $db . ' || ' . basename($_SERVER['PHP_SELF']); // echo 'ERROR';
    } else {
        // var_dump($result);
        return $result;
    }
}
