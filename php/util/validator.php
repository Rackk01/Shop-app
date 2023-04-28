<?php

function validateEmailPregMatch($email)
{
    if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $email)) {
        return true;
    } else {
        return false;
    }
}

function validateNumPhonePregMatch($phone)
{
    if (preg_match('/^(?:(?:00)?549?)?0?(?:11|[2368]\d)(?:(?=\d{0,2}15)\d{2})??\d{8}$/', $phone)) {
        return true;
    } else {
        return false;
    }
}

function validateNumCuitPregMatch($cuit)
{
    if (preg_match('/^(20|2[3-7]|30|3[3-4])(\d{8})(\d)$/', $cuit)) {
        return true;
    } else {
        return false;
    }
}

function validateNamePregMatch($name)
{
    // /^(?=.{3,18}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ])*$/
    // (?=.{3,18}$)-> te comprueba la longitud, si tiene mas de 3 y menos de 18 caracteres
    // [a-zñA-ZÑ]-> mira la primera palabra y si cumple la norma de ser solo Alfabetica con ñ incluio
    // (\s?[a-zñA-ZÑ])-> en caso de que haya un espacio, le indico que habra otra palabra
    // El apellido sera igual, pero indicamos que el máximo son 36 caracteres: ^(?=.{3,36}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ])*$

    if (preg_match('/^(?=.{3,60}$)[a-zñA-ZÑáéíóúÁÉÍÓÚ](\s?[a-zñA-ZÑáéíóúÁÉÍÓÚ])*$/', $name)) {
        return true;
    } else {
        return false;
    }
}

function validateDni($dni)
{
    if (preg_match('/^(?=.{8}$)[0-9]/', $dni)) {
        return true;
    } else {
        return false;
    }
}

function validatePassword($password)
{
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6) {
        return false; // 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    } else {
        return true; //'Strong password.';
    }
}

function validateNotQuery($str)
{
    // Controla que no tenga instrucciones que puedan dañar la base de datos
    if (preg_match('/^(?:(?!php\.ini|http|delete|select|insert|update|from|alter|where|DELETE|SELECT|INSERT|UPDATE|FROM|ALTER|WHERE).)*$\r?\n?/', $str)) {
        return true;
    } else {
        return false;
    }
}

function validateOnlyNumbersPregMatch($cadena)
{
    if (preg_match('/^[[:digit:]]+$/', $cadena)) {
        return true;
    } else {
        return false;
    }
}
