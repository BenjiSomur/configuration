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
$pclIPES = 91500;
$regionIPES = 'CAPITAL';
$phoneIPES = '228146107';
$websiteIPES= 'https://www.lania.mx';
$

$templateProcessor->setValue('solNumber', $solNumber);
$templateProcessor->setValue('dateTimeSol',$solDate);
$templateProcessor->setValue('nameIPES',$nameIPES);
$templateProcessor->setValue('keyIPES',$keyIPES);
$templateProcessor->setValue('cctIPES', $cctIPES);
$templateProcessor->setValue('addressIPES', $addressIPES);
$templateProcessor->setValue('keyIPES','CE235162');
$templateProcessor->setValue('cctIPES','CCT126531523');
$templateProcessor->setValue('nameIPES','Centro Educativo LANIA');
$templateProcessor->setValue('keyIPES','CE235162');
$templateProcessor->setValue('cctIPES','CCT126531523');

echo date('H:i:s'), ' Saving the result document... <br/>';
$templateProcessor->saveAs('../results/solicitud_evaluacion_template.docx');
echo "Document saved <br/>";


?>