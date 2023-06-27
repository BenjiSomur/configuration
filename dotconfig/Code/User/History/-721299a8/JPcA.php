<?php
require 'vendor/autoload.php';

use PHPStamp\Templator;
use PHPStamp\Document\WordDocument;

$cachePath = __DIR__ . "/results";
$templator = new Templator($cachePath);

$documentPath = __DIR__ . '/resources/solicitud_evaluacion_template(1).docx';
$document = new WordDocument($documentPath);


date_default_timezone_set('America/Mexico_City');

$dategen = date("H:i:s");
$datesol = date("d/m/Y") . " $dategen";



?>