<div class="limiter">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top flex-md-nowrap p-1" style="
      background-color: #790c2a;
      background-image: url('../images/img-01.png');
    ">
        <img src="../images/logob.png" style="width: 30%" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="expand navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto"></ul>
            <div id="nombreresp" class="form-inline mt-2 mt-md-0">

            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div id="sidedash" class="sidebar-sticky sidebar-hoverable" style="background-color: #53565a;">
                <ul class="nav flex-column mb-1">
                    <li class="nav-item">
                        <span class="navbar-toggler-icon"></span>
                    </li>

                    <a href="http://dgeu.sev.gob.mx/EEV2022.pdf" target="_blank" style="display: contents">
                        <li class="nav-item sidebar-item">
                            <i class="icon convocatoria"> </i>
                            <span class="icon-text elem-name">CONVOCATORIA</span>
                        </li>
                    </a>
                    <form action="<?php echo $_POST['PHP_SELF']; ?>" method="post">
                        <li class="nav-item sidebar-item">
                            <button name="soleval" type="submit" style="text-align: left;">
                                <i class="icon sol-eval"> </i>
                                <span class="icon-text elem-name">SOLICITUD DE EVALUACIÓN</span>
                            </button>
                        </li>
                        <li class="nav-item sidebar-item">
                            <button name="repinstit" type="submit" style="text-align: left;">
                                <i class="icon rep-inst"> </i>
                                <span class="icon-text elem-name">REPORTE INSTITUCIONAL</span>
                            </button>
                        </li>
                        <li class="nav-item sidebar-item">
                            <button name="entrevista" type="submit" style="text-align: left;">
                                <i class="icon vid-entrev"> </i>
                                <span class="icon-text elem-name">ENTREVISTA</span>
                            </button>
                        </li>
                        <li class="nav-item sidebar-item">
                            <button name="acreditacion" type="submit"
                                style="text-align: left; padding-top: 10px; padding-bottom: 10px">
                                <i class="icon acreditacion"> </i>
                                <span class="icon-text elem-name">ACREDITACIÓN</span>
                            </button>
                        </li>
                    </form>
                    <a href="../index.html" style="display: contents">
                        <li class="nav-item sidebar-item">
                            <i class="icon logout-dgeu"> </i>
                            <span class="icon-text elem-name">SALIR</span>

                        </li>
                    </a>
                </ul>
            </div>
            <main id="main" role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

            </main>
        </div>
    </div>
</div>