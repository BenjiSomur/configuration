<?php
# Para pasar la clave de la institución (primaria) y utilizarla
# para la base de datos, se guarda como cookie
$cookie_name = "keyIPES";
$cookie_value = "CE21387653";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

require('vendor/autoload.php');
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\TextNode;
use PHPHtmlParser\Dom\HtmlNode;

# Funciones para manejar archivos a nivel de servidor
# reciben la solicitud post y regresan un JSON con
# la respuesta nada más o bien un archivo generado para que se decargue

if (isset($_POST['generarsol'])) {
    header("Location: generateDocument.php", true, 301);
}

if (isset($_POST['enviarsolicitud'])) {
    $namefield = "solicitudarchivo";
    $target_dir = "IPES/solicitudes/";
    require('fileManager.php');

    $responseObj = new stdClass();
    $responseObj->code = $code;
    $responseObj->strong = $strong;
    $responseObj->message = $message;

    $responseJSON = json_encode($responseObj);
    header("Content-Type: application/json");
    if (ob_get_contents())
        ob_clean();
    echo $responseJSON;
    exit();
}

if (isset($_POST['enviarreporte'])) {
    $namefield = "reportearchivo";
    $target_dir = "IPES/reportes/";
    require('fileManager.php');

    $responseObj = new stdClass();
    $responseObj->code = $code;
    $responseObj->strong = $strong;
    $responseObj->message = $message;

    $responseJSON = json_encode($responseObj);
    header("Content-Type: application/json");
    if (ob_get_contents())
        ob_clean();
    echo $responseJSON;
    exit();
}

if (isset($_POST['requestinterview'])) {
    $responseObj = new stdClass();
    $responseObj->link = null;
    $responseObj->code = 400;
    $responseObj->message = "No se ha habilitado el link de su entrevista, favor de volver mas tarde";

    $responseJSON = json_encode($responseObj);
    header("Content-Type: application/json");
    if (ob_get_contents())
        ob_clean();
    echo $responseJSON;
    exit();
}



# A partir de aqui es el controlador de las pantallas y lo que se despliega
$dom = new Dom;
$dom->loadFromFile("html/ipes-dashboard.html");
$mainscreen = $dom->getElementById('mainscreen');
$content = $dom->getElementsByTag("main")[0];
$content->setAttribute("class", "container-fluid");
$content->setAttribute("style", "width: 85%; text-align:center; padding-left:0; padding-right:0;");
$nombre = "Juan Somur";
$nameresp = new TextNode("<h4 id='nombre-resp' style='color: #fff; font-size: 25px'>$nombre</h4>");
$responsable = $dom->getElementById("nombreresp");
$responsable->addChild($nameresp);

########### PANTALLA SOLICITUD DE EVALUACIÓN ############
if (isset($_POST['soleval']) || isset($_POST['enviararchivo'])) {
    $aux = new Dom;
    $aux->loadFromFile("html/solicitud-evaluacion.html");

    $selectModal = $aux->getElementById('selectmodal');
    $mainscreen->addChild($selectModal);


    $colFilename = $aux->getElementById("nombrearchivo");
    $colDate = $aux->getElementById("fechaenvio");
    $colEstatus = $aux->getElementById("estatus");


    # Numero de solicitud, si no hay una solicitud registrada en la 
    # base de datos entonces se desactiva el boton enviar solicitud
    $no_sol = 1234;

    if (is_null($no_sol)) {
        $aux->getElementById('soldetalles')->delete();
        $aux->getElementById('btn-env')->delete();
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
}
############# PANTALLA REPORTE INSTITUCIONAL ############
elseif (isset($_POST['repinstit'])) {
    $aux = new Dom;
    $aux->loadFromFile("html/reporte-institucional.html");

    $selectModal = $aux->getElementById('selectmodal');
    $mainscreen->addChild($selectModal);


    $colFilename = $aux->getElementById("nombrearchivo");
    $colDate = $aux->getElementById("fechaenvio");
    $colEstatus = $aux->getElementById("estatus");


    $no_sol = 1234;
    if (is_null($no_sol)) {
        $aux->getElementById('repdetalles')->delete();
        $aux->getElementById('btn-env')->delete();
    } else {
        $aux->getElementById('mensajenoregistro')->setAttribute("hidden", "true");


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
    $template = $aux->getElementById("reporteinstitucional");
    $content->addChild($template);

}
######### PANTALLA CUANDO LINK DE ENTREVISTA NO ESTÁ HABILITADO ########
elseif (isset($_POST['entrevistanull'])) {
    $message = $_POST["message"];
    $test = new TextNode("<h1>$message</h1>");
    $content->addChild($test);
}
################# PANTALLA DEL DISTINTIVO OTORGADO ############
elseif (isset($_POST['acreditacion'])) {
    $test = new TextNode("<h1>Aqui va el distintivo de acreditacion</h1>");
    $content->addChild($test);
}
####################### MENU PRINCIPAL ###########################
else {
    $content->setAttribute("class", "col");
    $dom->getElementById("sidedash")->delete();
    $test = new Dom;
    $test->loadFromFile("html/menu.html");
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