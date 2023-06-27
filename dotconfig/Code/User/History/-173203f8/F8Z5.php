<!DOCTYPE html>
<html lang="en">

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
            position: sticky;
            top: 48px;
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
            -webkit-mask: url("images/icons/action-description.svg") no-repeat center;
        }

        .sol-eval {
            -webkit-mask: url("images/icons/solid-file-import.svg") no-repeat center;
        }

        .logout-dgeu {
            -webkit-mask: url("images/icons/regularlog-out.svg") no-repeat center;
        }


        .rep-inst {
            -webkit-mask: url("images/icons/file-earmark-medical.svg") no-repeat center;
        }


        li.sidebar-item:hover {
            background: #eaaa00;
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

        .sidebar-hoverable {
            width: 64px;
            transition: all 0.5s;
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
            bottom: 20px;
            color: #fff;

        }
    </style>

</head>

<body>

    <div class="limiter">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #790c2a;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="expand navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <li class="nav-item active">
                        <h4 style="color: #fff;">Nombre del responsable</h4>
                    </li>
                </form>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-0 d-none d-md-block sidebar" style="background-color: #53565a; width: auto">
                    <div class="sidebar-sticky sidebar-hoverable">
                        <ul class="nav flex-column mb-1">
                            <li class="nav-item">
                                <span class="navbar-toggler-icon"></span>
                            </li>
                            <a href="http://dgeu.sev.gob.mx/EEV2022.pdf" target="_blank" style="display: contents;">
                                <li class="nav-item sidebar-item">
                                    <i class="icon convocatoria"> </i>
                                    <span class="icon-text elem-name">CONVOCATORIA</span>
                                </li>
                            </a>

                            <a href="#" style="display: contents">
                                <li class="nav-item sidebar-item">
                                    <i class="icon sol-eval"> </i>
                                    <span class="icon-text elem-name">SOLICITUD DE EVALUACIÓN</span>
                                </li>
                            </a>
                            <a href="#" style="display: contents">
                                <li class="nav-item sidebar-item">
                                    <i class="icon rep-inst"> </i>
                                    <span class="icon-text elem-name">REPORTE INSTITUCIONAL</span>
                                </li>
                            </a>
                            <a href="#" style="display: contents">
                                <li class="nav-item sidebar-item">
                                    <i class="icon logout-dgeu"> </i>
                                    <span class="icon-text elem-name">SALIR</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </nav>
                <?php $content ?>
            </div>
        </div>
    </div>


</body>







<!--===============================================================================================-->
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