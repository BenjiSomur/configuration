<!DOCTYPE html>
<html lang="en">
<?php
require('vendor/autoload.php');
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\TextNode;

$dom = new Dom;
$dom->loadFromFile("ipes-dashboard.php");
$content = $dom->getElementsByTag("main")[0];
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

<head>
    <title>Dashboard convocatoria</title>
    <meta charset="utf-8">
    <meta name="description" content="SEV | SEMSyS | DGEU ">
    <meta property="og:image" content="http://dgeu.sev.gob.mx/DEEV/dis.jpeg" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="http://dgeu.sev.gob.mx/DEEV/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="http://dgeu.sev.gob.mx/DEEV/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="http://dgeu.sev.gob.mx/DEEV/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="http://dgeu.sev.gob.mx/DEEV/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="http://dgeu.sev.gob.mx/DEEV/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->


    <!-- A partir de aqui head chamilo -->

    <link href="https://aulavirtual.institutointeligente.org.mx/web/assets/fontawesome/css/font-awesome.min.css"
        rel="stylesheet" media="screen" type="text/css">
    <link href="https://aulavirtual.institutointeligente.org.mx/web/assets/jquery-ui/themes/smoothness/theme.css"
        rel="stylesheet" media="screen" type="text/css">
    <link
        href="https://aulavirtual.institutointeligente.org.mx/web/assets/jquery-ui/themes/smoothness/jquery-ui.min.css"
        rel="stylesheet" media="screen" type="text/css">
    <link
        href="https://aulavirtual.institutointeligente.org.mx/web/assets/mediaelement/build/mediaelementplayer.min.css"
        rel="stylesheet" media="screen" type="text/css">
    <link
        href="https://aulavirtual.institutointeligente.org.mx/web/assets/jqueryui-timepicker-addon/dist/jquery-ui-timepicker-addon.min.css"
        rel="stylesheet" media="screen" type="text/css">
    <link href="https://aulavirtual.institutointeligente.org.mx/web/assets/bootstrap/dist/css/bootstrap.min.css"
        rel="stylesheet" media="screen" type="text/css">
    <link href="https://aulavirtual.institutointeligente.org.mx/web/assets/jquery.scrollbar/jquery.scrollbar.css"
        rel="stylesheet" media="screen" type="text/css">
    <link
        href="https://aulavirtual.institutointeligente.org.mx/web/assets/bootstrap-daterangepicker/daterangepicker.css"
        rel="stylesheet" media="screen" type="text/css">
    <link
        href="https://aulavirtual.institutointeligente.org.mx/web/assets/bootstrap-select/dist/css/bootstrap-select.min.css"
        rel="stylesheet" media="screen" type="text/css">
    <link href="https://aulavirtual.institutointeligente.org.mx/web/assets/select2/dist/css/select2.min.css"
        rel="stylesheet" media="screen" type="text/css">
    <link href="https://aulavirtual.institutointeligente.org.mx/web/assets/flag-icon-css/css/flag-icon.min.css"
        rel="stylesheet" media="screen" type="text/css">
    <link
        href="https://aulavirtual.institutointeligente.org.mx/main/inc/lib/javascript/mediaelement/plugins/vrview/vrview.css"
        rel="stylesheet" media="screen" type="text/css">
    <link href="https://aulavirtual.institutointeligente.org.mx/main/inc/lib/javascript/chosen/chosen.css"
        rel="stylesheet" media="screen" type="text/css">
    <link href="https://aulavirtual.institutointeligente.org.mx/main/inc/lib/javascript/chat/css/chat.css"
        rel="stylesheet" media="screen" type="text/css">
    <style>
        /*
 * Sidebar
 */

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            /* Behind the navbar */
            padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .sidebar-sticky {
            position: -webkit-sticky;
            position: relative;
            top: 90px;
            /* Height of navbar */
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }

        .sidebar .nav-link.active {
            color: #007bff;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }

        .convocatoria {
            -webkit-mask: url("images/icons/list-check.svg") no-repeat center;
        }

        .convocatoria-menu {
            -webkit-mask: url("images/icons/list-check_menu.svg") no-repeat center;
        }

        .sol-eval {
            -webkit-mask: url("images/icons/solid-file-import.svg") no-repeat center;
        }

        .sol-eval-menu {
            -webkit-mask: url("images/icons/solid-file-import_menu.svg") no-repeat center;
        }

        .logout-dgeu {
            -webkit-mask: url("images/icons/regularlog-out.svg") no-repeat center;
        }


        .rep-inst {
            -webkit-mask: url("images/icons/file-earmark-medical.svg") no-repeat center;
        }

        .rep-inst-menu {
            -webkit-mask: url("images/icons/file-earmark-medical_menu.svg") no-repeat center;
        }

        .vid-entrev {
            -webkit-mask: url("images/icons/camera-video.svg") no-repeat center;
        }

        .vid-entrev-menu {
            -webkit-mask: url("images/icons/camera-video_menu.svg") no-repeat center;
        }

        .acreditacion {
            -webkit-mask: url("images/icons/trophy-fill.svg") no-repeat center;
        }

        .acreditacion-menu {
            -webkit-mask: url("images/icons/trophy-fill_menu.svg") no-repeat center;
        }


        li.sidebar-item:hover {
            background: #eaaa00;
        }

        .sidebar-item:hover {
            background: #eaaa00;
        }


        .icon-logout {
            display: inline-block;
            width: 60px;
            height: 60px;
            background: #53565a;
            mask: none;
        }

        .icon-logout:hover {
            fill: #eaaa00;
        }

        .icon {
            display: inline-block;
            width: 60px;
            height: 60px;
            background: white;
            mask: none;
        }

        .icon-text {
            vertical-align: middle;
        }

        .icon-menu {
            display: inline-block;
            width: 120px;
            height: 120px;
            background: white;
            mask: none;
        }

        .sidebar-hoverable {
            width: 64px;
            transition: all 0.2s 0.05s;
            white-space: nowrap;
        }

        .sidebar-hoverable:hover,
        .sidebar-hoverable:focus {
            white-space: normal;
            width: 240px;

        }

        .elem-name {
            display: inline-block;
            position: relative;
            inline-size: 150px;
            overflow-wrap: break-word;
            font-size: 18px;
            bottom: 25px;
            color: #fff;

        }

        .card-dashboard {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            margin-right: -15px;
            margin-left: -15px;
            flex-wrap: nowrap;
            flex-direction: column;
            align-content: center;
            align-items: stretch;
        }
        }

        .card-name {
            inline-size: 300px;
            overflow-wrap: break-word;
        }

        .card-body:hover {
            background-color: #eaaa00;
        }
    </style>

</head>

<body>
    <?php
    echo $dom;
    ?>


    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>