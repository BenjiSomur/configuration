<?php
require 'vendor/autoload.php';

use PHPStamp\Templator;
use PHPStamp\Document\WordDocument;

$cachePath = __DIR__ . "/results";
$templator = new Templator($cachePath);

$documentPath = __DIR__ . '/resources/solicitud_evaluacion_template(1).docx';
$document = new WordDocument($documentPath);


date_default_timezone_set('America/Mexico_City');


$solNumber = 'DEEV2023-00001';
$datesol = date("d/m/Y H:i:s");
$nameIPES = 'Centro Educativo LANIA';
$keyIPES = 'CE21387653';
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


?>