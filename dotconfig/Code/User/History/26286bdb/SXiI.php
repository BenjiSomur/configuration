<?php
include_once(__DIR__ . '/vendor/autoload.php');

\PhpOffice\PhpWord\Settings::setPdfRendererPath(__DIR__ . '/vendor/tecnickcom/tcpdf');
\PhpOffice\PhpWord\Settings::setPdfRendererName('TCPDF');


use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\Element\Link;
use PhpOffice\PhpWord\Element\TextRun;

date_default_timezone_set('America/Mexico_City');

$templateProcessor = new TemplateProcessor(__DIR__ . '/resources/solicitud_evaluacion_template.docx');

if (!empty($templateProcessor)) {
    echo 'Cargado exitosamente<br/>';
}

$solNumber = 'DEEV2023-00001';
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
$websiteIPES = 'https://www.lania.mx';
$emailIPES = "$keyIPES@edusuperior.msev.gob.mx";
$nameContact = 'Juan Manuel Gutiérrez Méndez';
$emailContact = 'juan.gutierrez@lania.edu.mx';
$phoneContact = '2281872391';
$postContact = 'Director';
$nameHeadIPES = 'Maria Cristina Loyo Varela';

$templateProcessor->setValue('solNumber', $solNumber);
$templateProcessor->setValue('dateTimeSol', $solDate);
$templateProcessor->setValue('nameIPES', $nameIPES);
$templateProcessor->setValue('keyIPES', $keyIPES);
$templateProcessor->setValue('cctIPES', $cctIPES);
$templateProcessor->setValue('addressIPES', $addressIPES);
$templateProcessor->setValue('divIPES', $divIPES);
$templateProcessor->setValue('townIPES', $townIPES);
$templateProcessor->setValue('cityIPES', $cityIPES);
$templateProcessor->setValue('pcIPES', $pcIPES);
$templateProcessor->setValue('regionIPES', $regionIPES);
$templateProcessor->setValue('phoneIPES', $phoneIPES);
$templateProcessor->setValue('websiteIPES', $websiteIPES);
$templateProcessor->setValue('emailIPES', $emailIPES);
$templateProcessor->setValue('nameContact', $nameContact);
$templateProcessor->setValue('emailContact', $emailContact);
$templateProcessor->setValue('phoneContact', $phoneContact);
$templateProcessor->setValue('postContact', $postContact);
$templateProcessor->setValue('nameHeadIPES', $nameHeadIPES);

$name = trim($solNumber);
$name .= '_' . $cctIPES;
$name .= date('Ymd');

$pathname = __DIR__ . "/results/$name";

echo date('H:i:s'), ' Saving the result document... <br/>';
$templateProcessor->saveAs("$pathname.docx");


$phpWord = IOFactory::load("$pathname.docx", "Word2007");


$phpWord->setDefaultFontName('Calibri');

echo $phpWord->getDefaultFontName() . "<br/>";


$linkstyle = 'linkStyle';

$phpWord->addLinkStyle($linkstyle, ["underline" => "single", "name" => "Calibri", "size" => 8, "bold" => true, "color" => "808000"]);

$section = $phpWord->addSection();

foreach ($phpWord->getSections() as $sect) {
    foreach ($sect->getElements() as $element) {
        if ($element instanceof TextRun) {
            foreach ($element->getELements() as $aux) {
                if ($aux instanceof Link) {
                    $aux->getFontStyle()->set;
                }
            }
        }

    }
}

$phpWord->save($pathname . "_test.docx", "Word2007");

$objWriter = IOFactory::createWriter($phpWord, 'PDF');
$objWriter->save("$pathname.pdf");

$objWriter = IOFactory::createWriter($phpWord, 'Word2007');
# unlink("$pathname.docx");

echo "Document saved <br/>";


?>