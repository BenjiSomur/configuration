<!DOCTYPE html>
<html lang="en">
<?php
require('vendor/autoload.php');
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\TextNode;

$dom = new Dom;
$dom->loadFromFile("ipes-dashboard.php");
$content = $dom->getElementById("main");
$nombre = "Juan Somur";
$nameresp = new TextNode("<h4 id='nombre-resp' style='color: #fff; font-size: 25px'>$nombre</h4>");
$responsable = $dom->getElementById("nombreresp");
$responsable->addChild($nameresp);

if (isset($_POST['generarsol'])) {
    include('generateDocument.php');
}

if (isset($_POST['soleval'])) {
    $cct = null;
    if (is_null($cct)) {
        $aux = new Dom;
        $aux->loadFromFile("solicitud-evaluacion.php");
        $template = $aux->getElementById("solicitudevaluacion");
        $content->addChild($template);
    }
} elseif (isset($_POST['repinstit'])) {
    $test = new TextNode("<h1>Aqui va la pantalla del reporte institucional</h1>");
    $content->addChild($test);
} elseif (isset($_POST['entrevista'])) {
    $test = new TextNode("<h1>Aqui va el elink de la entrevista</h1>");
    $content->addChild($test);
} elseif (isset($_POST['acreditacion'])) {
    $content->setAttribute("class", "col-md-9 ml-sm-auto col-lg-10 pt-3 px-4");
    $test = new TextNode("<h1>Aqui va el distintivo de acreditacion</h1>");
    $content->addChild($test);
} else {
    $content->setAttribute("class", "col");
    $dom->getElementById("sidedash")->setAttribute("style", "display: none;");
    $test = new Dom;
    $test->loadFromFile("menu.php");
    $menu = $test->getElementById("mainmenu");
    $content->addChild($menu);

}
?>


<?php
include("header.php");
echo $dom;
include("footer.php");
?>