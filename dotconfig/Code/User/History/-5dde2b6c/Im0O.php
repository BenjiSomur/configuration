<?php
# Para pasar la clave de la institución (primaria) y utilizarla
# para la base de datos, se guarda como cookie
$cookie_name = "keyIPES";
$cookie_value = "CE21387653";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

require('vendor/autoload.php');
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\TextNode;

$dom = new Dom;
$dom->loadFromFile("ipes-dashboard.php");
$content = $dom->getElementsByTag("main")[0];
$content->setAttribute("class", "container-fluid");
$nombre = "Juan Somur";
$nameresp = new TextNode("<h4 id='nombre-resp' style='color: #fff; font-size: 25px'>$nombre</h4>");
$responsable = $dom->getElementById("nombreresp");
$responsable->addChild($nameresp);

if (isset($_POST['generarsol'])) {
    header("Location: generateDocument.php", true, 301);
    exit();
}

if (isset($_POST['soleval'])) {
    # Numero de solicitud, si no hay una solicitud registrada en la 
    # base de datos entonces se desactiva el boton enviar solicitud
    $no_sol = 1234;
    $aux = new Dom;
    $aux->loadFromFile("solicitud-evaluacion.php");
    $colFilename = $aux->getElementById("nombrearchivo");
    $colDate = $aux->getElementById("fechaenvio");
    $colEstatus = $aux->getElementById("estatus");

    if (is_null($no_sol)) {
        $aux->getElementById('soldetalles')->setAttribute("hidden", "true");
        $aux->getElementById('btn-env')->setAttribute("disabled", "true");
    } else {
        $aux->getElementById('mensajenoregistro')->setAttribute("hidden", "true");
        $btnEnv = $aux->getElementById('btn-gen');
        $newText = new TextNode("Descargar solicitud de evaluación");
        $btnEnv->addChild($newText);
        $btnEnv->removeChild($btnEnv->firstChild()->id());

        /*Esta parte se llena con una llamada a la base de datos*/
        $filenameSol = "NOMBRE DEL ARCHIVO";
        $dateFile = "16/05/2023 14:56:23";
        # $estatus puede ser 1, 2 o 3 
        # representando aprobado, rechazado o pendiente
        $estatus = 3;

        $filenameHtml = new TextNode("<h4>$filenameSol</h4>");
        $dateHtml = new TextNode("<h4>$dateFile</h4>");
        if ($estatus == 1) {
            $estatusHtml = new TextNode("<h4><span class='badge-success'>Aprobado</span></h4>");
        } elseif ($estatus == 2) {
            $estatusHtml = new TextNode("<h4><span class='badge-danger'>Rechazado</span></h4>");
        } elseif ($estatus == 3) {
            $estatusHtml = new TextNode("<h4><span class='badge-warning'>Pendiente</span></h4>");
        }

        $colFilename->addChild($filenameHtml);
        $colDate->addChild($dateHtml);
        $colEstatus->addChild($estatusHtml);

    }
    $template = $aux->getElementById("solicitudevaluacion");
    $content->addChild($template);
} elseif (isset($_POST['repinstit'])) {
    $test = new TextNode("<h1>Aqui va la pantalla del reporte institucional</h1>");
    $content->addChild($test);
} elseif (isset($_POST['entrevista'])) {
    $test = new TextNode("<h1>Aqui va el elink de la entrevista</h1>");
    $content->addChild($test);
} elseif (isset($_POST['acreditacion'])) {
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
<!DOCTYPE html>
<html lang="en">
<?php
include("header.php");
echo $dom;
include("footer.php");
?>