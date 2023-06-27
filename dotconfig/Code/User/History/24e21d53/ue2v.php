<?php
//ignore_user_abort(true);
require 'vendor/autoload.php';

use PHPStamp\Templator;
use PHPStamp\Document\WordDocument;

function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object))
                    rrmdir($dir . DIRECTORY_SEPARATOR . $object);
                else
                    unlink($dir . DIRECTORY_SEPARATOR . $object);
            }
        }
        rmdir($dir);
    }
}


if (!file_exists(__DIR__ . "/phpstampcache")) {
    mkdir(__DIR__ . "/phpstampcache", 0775);
}


$cachePath = __DIR__ . "/phpstampcache/";
$templator = new Templator($cachePath);

$documentPath = __DIR__ . '/resources/solicitud_evaluacion_template.docx';
$document = new WordDocument($documentPath);

date_default_timezone_set('America/Mexico_City');


$solNumber = 'DEEV2023-00001';
$solDate = date("d/m/Y H:i:s");
$nameIPES = 'Centro Educativo LANIA';
$keyIPES = $_COOKIE['keyIPES'];
$cctIPES = 'CCT1273512';
$addressIPES = 'Rebsamen 80';
$divIPES = 'Centro';
$townIPES = 'Xalapa';
$cityIPES = 'Xalapa';
$pcIPES = 91500;
$regionIPES = 'CAPITAL';
$phoneIPES = '228146107';
$websiteIPES = 'https://www.lania.mx';
$emailIPES = "$keyIPES@edusuperior.msev.gob.mx";
$nameContact = 'Juan Manuel Gutiérrez Méndez';
$emailContact = 'juan.gutierrez@lania.edu.mx';
$phoneContact = '2281872391';
$postContact = 'Director';
$nameHeadIPES = 'Maria Cristina Loyo Varela';

$values = array(
    'solNumber' => $solNumber,
    'solDate' => $solDate,
    'nameIPES' => $nameIPES,
    'keyIPES' => $keyIPES,
    'cctIPES' => $cctIPES,
    'addressIPES' => $addressIPES,
    'divIPES' => $divIPES,
    'townIPES' => $townIPES,
    'cityIPES' => $cityIPES,
    'pcIPES' => $pcIPES,
    'regionIPES' => $regionIPES,
    'phoneIPES' => $phoneIPES,
    'websiteIPES' => $websiteIPES,
    'emailIPES' => $emailIPES,
    'nameContact' => $nameContact,
    'emailContact' => $emailContact,
    'phoneContact' => $phoneContact,
    'postContact' => $postContact,
    'nameHeadIPES' => $nameHeadIPES
);

$result = $templator->render($document, $values);

$name = trim($solNumber);
$name .= '_' . $cctIPES;
$name .= date('Ymd');

rrmdir(__DIR__ . "/phpstampcache");

// Envía resultado al buffer
# echo $result->output();



$_POST['generarsol'] = 'success';
//header("Location: dashboard_index.php", true, 301);
echo $_POST['PHP_SELF'];
// Guarda el archivo localmente
// $saved = $result->save(__DIR__ . '/results', "$name" . "_initial.docx");
// if ($saved === true) {
//     echo 'Saved!' . "<br/>";
// }

?>