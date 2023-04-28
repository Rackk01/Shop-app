<?php
function RandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function getDbUserConnect($sessionDataUser)
{
    $array = json_decode($sessionDataUser, true);
    foreach ($array as $key => $value) {
        if ($key == 'bd') {
            return $value;
            break;
        }
    }
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function encodeBase64($str)
{
    return base64_encode($str);
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function decodeBase64($str)
{
    return base64_decode($str);
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function randomChar($length)
{
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function deleteStartEndChar($str, $lengthStart, $lengthEnd)
{
    return substr(substr($str, $lengthStart), 0, -$lengthEnd);
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

// function codificarData($str)
// {
//     return randomChar(32) . encodeBase64($str) . randomChar(22);
// }

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function codificarData($data)
{
    $strAux = encodeBase64($data);
    return encodeBase64(randomChar(32) . $strAux . randomChar(22));
}

function decodificarData($data)
{
    // $strAux = decodeBase64($str);
    // return deleteStartEndChar($strAux, 32, 22);
    $strAux = decodeBase64($data);
    $strAux2 = deleteStartEndChar($strAux, 32, 22);

    return decodeBase64($strAux2);
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function getOneValueOfJsonData($jsonDataTypeString, $key)
{
    if (trim($jsonDataTypeString) != '' && trim($key) != '') {
        // Así tiene que venir el dato $jsonDataTypeString = {"id_usuario":"1","nombre":"b","pass":"1","nro_sistema":"242020","id_grupo_usuario":"1","id_tipo_usuario":"1","cven":"0","id_sistema":"7","nombre_sistema":"Bautista","bd":"maxi_bautista","version_sistema":"1"}
        $array = json_decode($jsonDataTypeString, true);
        foreach ($array as $keyIn => $value) {
            if ($keyIn == $key) {
                return $value;
            }
        }
    } else {
        return 'e_1_methods.php_getOneValueOfJsonData';
    }
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function removeAllSpacesEmptys($text)
{
    // trim() - Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
    return trim($text);
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function repleaceCharacter($text, $charToRepleace, $charRepleace)
{
    //Replace the characters "world" in the string "Hello world!" with "Peter":
    //echo str_replace("world","Peter","Hello world!");
    return str_replace($charToRepleace, $charRepleace, $text);
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function codificarToken($paramOne, $paramTwo)
{
    return codificarData(md5($paramOne + '|' + $paramTwo));
}

function decodificarToken($paramOne, $paramTwo)
{
    // return decodificarData(md5($paramOne + '|' + $paramTwo));
}

function getPartToken($token, $indice)
{
    $parts = explode("|", $token);
    return $parts[$indice];
}

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------

function codificarTokenId($id)
{
    return codificarData(md5($id));
}

function decodificarTokenId($paramOne, $paramTwo)
{
    // return codificarData(md5($paramOne + '|' + $paramTwo));
}

function setMessageInfoText($typeInfo, $textInfo)
{
    file_put_contents('NotificationInfo.txt', date('m-d-Y h:i:s a', time()) . ' | ----- | ' . strtoupper($typeInfo) . ' ----- ' . "\n", FILE_APPEND);
    file_put_contents('NotificationInfo.txt', $textInfo . "\n", FILE_APPEND);
    file_put_contents('NotificationInfo.txt', ' ############################################################################## ' . "\n", FILE_APPEND);
    file_put_contents('NotificationInfo.txt', "\n", FILE_APPEND);
    file_put_contents('NotificationInfo.txt', "\n", FILE_APPEND);
}

function getExtensionFile($nameFile)
{
    $temp = explode('.', $nameFile);
    $extension = end($temp);

    return $extension;
}

function reemplazarPorAcentos($str)
{
    // á --> \xe1
    if (str_contains($str, '\xe1')) {
        $str = str_replace('\xe1', 'á', $str);
    }
    if (str_contains($str, 'u00e1')) {
        $str = str_replace('u00e1', 'á', $str);
    }
    if (str_contains($str, 'Ã¡')) {
        $str = str_replace('Ã¡', 'á', $str);
    }
    if (str_contains($str, 'u00c3u00a1')) {
        $str = str_replace('u00c3u00a1', 'á', $str);
    }
    if (str_contains($str, '\u00c3\u00a1')) {
        $str = str_replace('\u00c3\u00a1', 'á', $str);
    }
    // Á --> \xc1
    if (str_contains($str, '\xc1')) {
        $str = str_replace('\xc1', 'Á', $str);
    }

    if (str_contains($str, 'u00c1')) {
        $str = str_replace('u00c1', 'Á', $str);
    }

    if (str_contains($str, '\xe9')) {
        $str = str_replace('\xe9', 'é', $str);
    }

    if (str_contains($str, '\xc9')) {
        $str = str_replace('\xc9', 'É', $str);
    }

    if (str_contains($str, 'u00c9')) {
        $str = str_replace('u00c9', 'É', $str);
    }

    // í --> \xed
    if (str_contains($str, '\xed')) {
        $str = str_replace('\xed', 'í', $str);
    }
    if (str_contains($str, 'u00c3u00ad')) {
        $str = str_replace('u00c3u00ad', 'í', $str);
    }
    
    // Í --> \xcd
    if (str_contains($str, '\xcd')) {
        $str = str_replace('\xcd', 'Í', $str);
    }

    if (str_contains($str, 'u00cd')) {
        $str = str_replace('u00cd', 'Í', $str);
    }

    if (str_contains($str, 'u00c3u008d')) {
        $str = str_replace('u00c3u008d', 'Í', $str);
    }

    // ó --> \xf3
    if (str_contains($str, '\xf3')) {
        $str = str_replace('\xf3', 'ó', $str);
    }
    if (str_contains($str, 'u00c3u0093')) {
        $str = str_replace('u00c3u0093', 'Ó', $str);
    }

    if (str_contains($str, '\xd3')) {
        $str = str_replace('\xd3', 'Ó', $str);
    }

    if (str_contains($str, '\xfa')) {
        $str = str_replace('\xfa', 'ú', $str);
    }
    if (str_contains($str, 'u00c3u00ba')) {
        $str = str_replace('u00c3u00ba', 'ú', $str);
    }
    if (str_contains($str, '\u00c3\u00ba')) {
        $str = str_replace('\u00c3\u00ba', 'ú', $str);
    }
    if (str_contains($str, '\xda')) {
        $str = str_replace('\xda', 'Ú', $str);
    }

    if (str_contains($str, '\u00ed')) {
        $str = str_replace('\u00ed', 'í', $str);
    }

    if (str_contains($str, '\xa1')) {
        $str = str_replace('\xa1', '¡', $str);
    }

    if (str_contains($str, 'u00f3')) {
        $str = str_replace('u00f3', 'ó', $str);
    }

    if (str_contains($str, 'u00f1')) {
        $str = str_replace('u00f1', 'ñ', $str);
    }
    if (str_contains($str, 'xf1')) {
        $str = str_replace('xf1', 'ñ', $str);
    }
    if (str_contains($str, 'u00d1')) {
        $str = str_replace('u00d1', 'Ñ', $str);
    }

    if (str_contains($str, 'u00e9')) {
        $str = str_replace('u00e9', 'é', $str);
    }

    if (str_contains($str, 'u00d3')) {
        $str = str_replace('u00d3', 'Ó', $str);
    }

    if (str_contains($str, 'Ãº')) {
        $str = str_replace('Ãº', 'ú', $str);
    }

    if (str_contains($str, 'u00fa')) {
        $str = str_replace('u00fa', 'ú', $str);
    }

    if (str_contains($str, 'u00da')) {
        $str = str_replace('u00da', 'Ú', $str);
    }

    //u00e9

    return str_replace('\\', '', $str);
}

function cortarPorCantidadDePalaras($cadena, $cantidad_palabras)
{
    /*
    Corta una cadena de texto en dos segun la cantidad de palabras indicadas. Devuelve un array en donde el índice cero correspnde a la primera parte
    de la cadena con las palabras cortadas inicialmente, y el indice 1 es el resto de palabras que forman la cadena
    */
    $palabras_arreglo = explode(" ", $cadena);
    $primer_texto = implode(" ", array_slice($palabras_arreglo, 0, $cantidad_palabras));
    $segundo_texto = implode(" ", array_slice($palabras_arreglo, $cantidad_palabras));
    // echo "Primer texto: " . $primer_texto;
    // echo "<br>";
    // echo "Segundo texto: " . $segundo_texto;

    $array = array($primer_texto, $segundo_texto);
    return $array;
    // echo "<br>";
    // echo "<br>";
    // echo "Primer texto: " . $array[0];
    // echo "<br>";
    // echo "Segundo texto: " . $array[1];
}

function isDecimal($n)
{
    // Note that floor returns a float 
    return is_numeric($n) && floor($n) != $n;
}

function setSesionDataError($title, $textMsj)
{
    // Para utilizar este método se debe inicializar la sesión dentro del archivo.
    $array = array(
        'tit' => $title,
        'msj' => $textMsj
    );

    $_SESSION["SD_ERROR"] = json_encode($array);
}

function properText($str)
{
    $str = mb_convert_encoding($str, "HTML-ENTITIES", "UTF-8");
    $str = preg_replace('[a-zA-Z áéíóúÁÉÍÓÚñÑ.]+', htmlentities('${1}'), $str);
    return ($str);
}

/**
 * Recibe una fecha en formato AAAA-MM-DD y devuelve DD/MM/AAAA
 * date_create(DD/MM/AAAA) ==> AAAA-MM-DD
 */
function changeDateFormat1($date)
{
    return date("d/m/Y", strtotime($date));
}

/**
 * Recibe el formato timestamp with timezone de Postgresql (yyyy-mm-dd hh:mm:ss-tz)
 * Retorna un array con day (yyyy-mm-dd) y hour (hh:mm:ss)
 */
function separateDayHour($date)
{
    list($day, $hour) = explode(' ', $date);

    $hour = explode('-', $hour)[0];

    return ['day' => $day, 'hour' => $hour];
}