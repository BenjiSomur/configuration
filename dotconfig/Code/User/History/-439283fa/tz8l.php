<?php
include_once(__DIR__.'/vendor/autoload.php');
use PhpOffice\PhpWord\TemplateProcessor;

$templateProcessor = new TemplateProcessor('../resources/solicitud_evaluacion_template.docx');

if (!empty($templateProcessor)) {
    echo "Cargado exitosamente";
}
$templateProcessor->setValue('solNumber', 'DEEV2023-000003');
$templateProcessor->saveAs('resources/template_filled.docx');
?>