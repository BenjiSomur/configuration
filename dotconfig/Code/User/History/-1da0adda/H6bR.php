<div id="mainmenu">
    <div class="row ">
        <ul class="navbar-nav mr-auto"></ul>
        <a href="index.html" style="position: relative; right: 100px;">
            <li class="nav-item sidebar-item">
                <i class="icon-logout logout-dgeu"> </i>
            </li>
        </a>
    </div>
    <div class="container">
        <form action="<?php echo $_POST['PHP_SELF']; ?>" method="post">
            <div class="card-dashboard mb-9 text-center">
                <a href="http://dgeu.sev.gob.mx/EEV2022.pdf" target="_blank" style="text-decoration:none; width: 100%;">

                    <div class="card mb-4 box-shadow" style="background-color: #53565a;">
                        <div class="card-body">


                            <h1 class="my-0 font-weight-normal" style="color:#fff;">CONVOCATORIA</h1>
                            <i class="icon-menu convocatoria-menu"> </i>


                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow" style="background-color: #53565a">
                    <div class="card-body">
                        <button name="soleval" type="submit" style="width: 100%">
                            <h1 class="my-0 font-weight-normal card-name" style="color:#fff;">SOLICITUD DE EVALUACIÓN
                            </h1>
                            <i class="icon-menu sol-eval-menu"> </i>
                        </button>
                    </div>
                </div>
                <div class="card mb-4 box-shadow" style="background-color: #53565a">
                    <div class="card-body">
                        <button name="repinstit" type="submit" style="width: 100%">
                            <h1 class="my-0 font-weight-normal card-name" style="color:#fff;">REPORTE INSTITUCIONAL</h1>
                            <i class="icon-menu rep-inst-menu"> </i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-dashboard mb-9 text-center">
                <div class="card mb-4 box-shadow" style="background-color: #53565a">
                    <div class="card-body">
                        <button name="entrevista" type="submit" style="width: 100%">
                            <h1 class="my-0 font-weight-normal card-name" style="color:#fff;">ENTREVISTA</h1>
                            <i class="icon-menu vid-entrev-menu"> </i>
                        </button>
                    </div>
                </div>

                <div class="card mb-4 box-shadow" style="background-color: #53565a">
                    <div class="card-body">
                        <button name="acreditacion" type="submit" style="width: 100%">
                            <h1 class="my-0 font-weight-normal card-name" style="color:#fff;">ACREDITACIÓN</h1>
                            <i class="icon-menu acreditacion-menu"> </i>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>