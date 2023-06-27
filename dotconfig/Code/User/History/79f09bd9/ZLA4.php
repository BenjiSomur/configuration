<div id="solicitudevaluacion">
    <div class="row title-row" style="left: -19%;">
        <h1 style="color: #53565a"><b>Solicitud de evaluación para el Distintivo de Excelencia Educativa Veracruzana
                2023 "EEV 2023"</b></h1>
    </div>
    <div class="container" id="mensajenoregistro" style="text-align:center">
        <h3 style="color: #53565a; opacity:50%; padding-bottom:10px"><b>Aún no ha registrado su solicitud para
                participar en la evaluación</b>
        </h3>
    </div>
    <div class="container" id="soldetalles">
        <div class="row">
            <div class="col-md-5 "><b style="font-size:18px">Archivo</b></div>
            <div class="col-md-4" style="text-align: center"><b style="font-size:18px">Fecha de envío</b></div>
            <div class="col-md-3" style="text-align: center"><b style="font-size:18px">Estatus</b></div>
        </div>
        <div class="row">
            <div class="col-md-5 col-file" id="nombrearchivo"></div>
            <div class="col-md-4 col-file" style="text-align: center" id="fechaenvio"></div>
            <div class="col-md-3 col-file" style="text-align: center" id="estatus"></div>
        </div>
    </div>

    <div class="container">
        <div class="row row-buttons">
            <form action="<?php echo $_POST['PHP_SELF']; ?>" method="post">
                <button id="btn-gen" class="btn btn-primary btn-lg btn-dgeu-submit"
                    style="padding: 5% 3%; max-width:90%" type="submit" name="generarsol">
                    Registrar solicitud de evaluación
                </button>
            </form>
            <form action="<?php echo $_POST['PHP_SELF']; ?>" method="post">
                <button id="btn-env" class="btn btn-primary btn-lg btn-dgeu-submit"
                    style="padding: 13% 7%; width: max-content;" type="submit" name="enviarsol">Enviar
                    solicitud firmada</button>
            </form>
        </div>
    </div>


</div>