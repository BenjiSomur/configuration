<?php
include_once(__DIR__.'/vendor/autoload.php');

use PhpOffice\PhpWord\TemplateProcessor;

$templateProcessor = new TemplateProcessor('../resources/solicitud_evaluacion_template.docx');

if (!empty($templateProcessor)) {
    echo 'Cargado exitosamente<br/>';
}

$solNumber = 'DEEV2023 - 00001';
$solDate = date('Y-m-d H:i:s');
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
$websiteIPES= 'https://www.lania.mx';
$emailIPES = "$keyIPES@edusuperior.msev.gob.mx";
$nameContact = 'Juan Manuel Gutiérrez Méndez';
$emailContact = 'juan.gutierrez@lania.edu.mx';
$phoneContact = '2281872391';
$postContact = 'Director';
$nameHeadIPES = 'Maria Cristina Loyo Varela';

$templateProcessor->setValue('solNumber', $solNumber);
$templateProcessor->setValue('dateTimeSol',$solDate);
$templateProcessor->setValue('nameIPES',$nameIPES);
$templateProcessor->setValue('keyIPES',$keyIPES);
$templateProcessor->setValue('cctIPES', $cctIPES);
$templateProcessor->setValue('addressIPES', $addressIPES);
$templateProcessor->setValue('divIPES',$divIPES);
$templateProcessor->setValue('townIPES', $townIPES);
$templateProcessor->setValue('cityIPES',$cityIPES);
$templateProcessor->setValue('pcIPES', $pcIPES);
$templateProcessor->setValue('regionIPES',$regionIPES);
$templateProcessor->setValue('phoneIPES', $phoneIPES);
$templateProcessor->setValue('websiteIPES', $websiteIPES);
$templateProcessor->setValue('emailIPES',$emailIPES);
$templateProcessor->setValue('nameContact', $nameContact);
$templateProcessor->setValue('emailContact',$emailContact);
$templateProcessor->setValue('phoneContact', $phoneContact);
$templateProcessor->setValue('postContact',$postContact);
$templateProcessor->setValue('nameHeadIPES',$nameHeadIPES);

if (!file_exists('../test')) {
    mkdir('path/to/directory', 0777, true);
}

echo date('H:i:s'), ' Saving the result document... <br/>';
$templateProcessor->saveAs('../results/solicitud_evaluacion_lania.docx');
echo "Document saved <br/>";


?>