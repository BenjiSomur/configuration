<?php
include_once(__DIR__.'/vendor/autoload.php');
include_once 'Sample_Header.php';

use PhpOffice\PhpWord\TemplateProcessor;

$templateProcessor = new TemplateProcessor('../resources/solicitud_evaluacion_template.docx');

if (!empty($templateProcessor)) {
    echo nl2br('Cargado exitosamente\n');
}
$templateProcessor->setValue('solNumber','DEEV2023-00002');

echo date('H:i:s'), ' Saving the result document...';
$templateProcessor->saveAs('../results/solicitud_evaluacion_template.docx');
echo "Document saved";


?>