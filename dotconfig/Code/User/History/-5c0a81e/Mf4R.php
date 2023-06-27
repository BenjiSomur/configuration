<?php

$target_file = $target_dir . basename($_FILES[$namefield]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$message = "";
$code = 0;

// Check file size
if ($_FILES[$namefield]["size"] > 500000) {
    $message = "El archivo es demasiado grande";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "pdf") {
    $message = "Solo se permiten archivos de tipo pdf";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $strong = "No se pudo subir el archivo";
    $code = 401;
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES[$namefield]["tmp_name"], $target_file)) {
        $code = 200;
        $strong = "Operación exitosa";
        $message = "El archivo ha sido enviado correctamente";
    } else {
        $code = 500;
        $strong = "Operación fallida";
        $message = "Error al subir el archivo";
    }
}

?>