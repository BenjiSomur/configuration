<?php
include_once(__DIR__.'/vendor/autoload.php');

use PhpOffice\PhpWord\TemplateProcessor;

$templateProcessor = new TemplateProcessor('../resources/solicitud_evaluacion_template.docx');

if (!empty($templateProcessor)) {
    echo 'Cargado exitosamente<br/>';
}
$templateProcessor->setValue('solNumber','DEEV2023-00002');
$templateProcessor->setValue('dateTimeSol',date('l'));
$templateProcessor->setValue('solNumber','DEEV2023-00002');
$templateProcessor->setValue('solNumber','DEEV2023-00002');
$templateProcessor->setValue('solNumber','DEEV2023-00002');


echo date('H:i:s'), ' Saving the result document... <br/>';
$templateProcessor->saveAs('../results/solicitud_evaluacion_template.docx');
echo "Document saved <br/>";


?>