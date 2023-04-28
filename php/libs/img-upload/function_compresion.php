<?php
//info  Transforma una imagen [png, jpeg, webp] al tamaño solicitado y la comprime en calidad
//info  - Si la imagen es de mayor resolución la ajusta al tamaño solicitado
//info  - Si es más chica con la diferencia de porcentaje se agrega transparencia, si no cumple con el porcentaje mínimo devuelve error
/**
 * limitSize --> Debe ingresarse en bytes | 1kb = 1024bytes
 */
function comprimirImagen(
    $image,
    $name,
    $widthFijo,
    $heightFijo,
    $diferenciaPorcentaje,
    $url,
    $limitSize
) {

    $ubicacionTemp = $image['tmp_name'];
    $infoImagen = getimagesize($ubicacionTemp); //? Obtengo toda la información de la imagen
    $width = $infoImagen[0]; //? Obtengo el alto y el ancho de la imagen,  y el peso
    $height = $infoImagen[1];
    $size = $image['size'];
    $mime = $infoImagen['mime']; //? Obtengo el tipo de imagen ("image/[jpeg, png, webp]")

    // region Validacion de ancho y alto
    // if ($width < ($widthFijo * ($diferenciaPorcentaje / 100))) {
    //     $message = "error_1 || " . $width . ' || ' . ($widthFijo / (($diferenciaPorcentaje / 100) + 1));
    //     echo $message;
    //     return;
    // } else if ($height < $heightFijo * ($diferenciaPorcentaje / 100)) {
    //     $message = "error_2";
    //     echo $message;
    //     return;
    // }

    // region Validacion de peso
    // if ($size > $limitSize) {
    //     $message = "error_3";
    //     echo $message;
    //     return;
    // }


    //region Creamos la imagen según el formato ingresado
    switch ($mime) {
        case 'image/jpeg':
            $newImage = imagecreatefromjpeg($ubicacionTemp);
            break;
        case 'image/png':
            $newImage = imagecreatefrompng($ubicacionTemp);
            break;
        case 'image/webp':
            $newImage = imagecreatefromwebp($ubicacionTemp);
            break;
        default:
            $newImage = imagecreatefromjpeg($ubicacionTemp);
    }

    $urlComprimida = $url . "/" . $name . ".png"; //? URL donde con nombre del archivo donde se almacena
    $thumb = imagecreatetruecolor($widthFijo, $heightFijo); //? Creo una imagen nueva con el tamaño introducido

    $newWidth = $width; //? Seteo los parámetros de la imagen
    $newHeight = $height;
    $img = $newImage;

    if ($width >= $widthFijo || $height >= $heightFijo) { //info  Valida si el Width o el Height es mayor al indicado para reescalar la imagen
        while ($newWidth > $widthFijo || $newHeight > $heightFijo) { //? Le resta de a 1% a las medidas de la imagen hasta llegar a las medidas introducidas   
            $newWidth -= $newWidth * (1 / 100);
            $newHeight -= $newHeight * (1 / 100);
        }
        $img = imagecreatetruecolor($newWidth, $newHeight); //? Creo una imagen nueva con el tamaño introducido
        imagecopyresized($img, $newImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); //? Reescalo la imagen
    }

    if ($newWidth <= $widthFijo || $newHeight <= $heightFijo) { //info  Valida si el Width y el Height está dentro de los valores permitidos para Agregar la transparencia
        imagesavealpha($thumb, true); //? Guarda los valores de colores
        $trans_colour = imagecolorallocatealpha($thumb, 0, 0, 0, 127); //? Trasnformo en la imagen creada el color por transparencia
        imagefill($thumb, 0, 0, $trans_colour); //? Relleno la imagen con la transparencia

        //? Copio la imagen introducida para pegarla dentro de la imagen creada con fondo transparente
        imagecopy(
            $thumb,
            $img, //* Imagen creada con fondo transparente || Imagen ingresada
            ($widthFijo - $newWidth) / 2, //* Para pocisionar la imagen ingresada en el centro se resta los anchos de las imagenes y se divide por 2
            ($heightFijo - $newHeight) / 2,
            0,
            0, //* Pocision desde donde se toma la imagen ingresada (Al ser 0 se toma toda la imagen completa)
            $newWidth,
            $newHeight, //* Tamaño de la imagen ingresada
        );
    }


    imagepng($thumb, $urlComprimida, 9); //? Crea la imagen y la guarda con la mayor compresión

    imagedestroy($newImage); //? Libera memoria
    imagedestroy($img); //? Libera memoria
    imagedestroy($thumb); //? Libera memoria
    $message = "success";
    return $message;
    // echo $message;
}

//* Ejemplo de uso de la función
// comprimirImagen($_FILES['images'], 'compresa', 1920, 1080, 50, 'C:\Users\Diego\Desktop', 10000000);

//* Ejemplo de uso múltiple
// $arrayImages = [];
// for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
//     $image = array(
//         'name' => $_FILES['images']['name'][$i],
//         'type' => $_FILES['images']['type'][$i],
//         'size' => $_FILES['images']['size'][$i],
//         'tmp_name' => $_FILES['images']['tmp_name'][$i],
//         'error' => $_FILES['images']['error'][$i],
//         'full_path' => $_FILES['images']['full_path'][$i]
//     );
//     array_push($arrayImages, $image);
// }
// foreach ($arrayImages as $image) {
//     // comprimirImagen($image, $image['name'], 1920, 1080, 50, 'C:\Users\Diego\Desktop', 10000000);
//     comprimirImagen($image, $image['name'], 1920, 1080, 50, 'src/imagenes-prueba/', 10000000);
// }

// if (move_uploaded_file($_FILES["file"]["tmp_name"], 'http://localhost/santiago/santiago-app/src/img/imagenes-prueba' . $_FILES['file']['name'])) {
//     echo 'si';
// } else {
//     echo 'no';
// }
