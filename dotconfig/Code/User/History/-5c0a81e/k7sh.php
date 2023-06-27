<?php
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

$target_file = $target_dir . basename($_FILES[$namefield]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$message = "";
$code = 0;

// Check file size
if ($_FILES[$namefield]["size"] > 5 * MB || $_FILES[$namefield]['size'] < 0) {
    $message = "El archivo es demasiado grande";
    $uploadOk = 0;
}

// Allow certain file formats
if ($fileType != "pdf") {
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
        $name = $_FILES[$namefield]['name'];
        $message = "Error al subir el archivo $name";
    }
}

?>