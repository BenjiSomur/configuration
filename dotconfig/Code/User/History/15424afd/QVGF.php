<div id="solicitudevaluacion" class="jumbotron" style="background-color: #fff;">
    <h1 style="color: #53565a"><b style="font-size:50px">Solicitud de evaluación para el Distintivo de Excelencia
            Educativa Veracruzana
            2023 "EEV 2023"</b></h1>
    <div class="container" id="mensajenoregistro" style="text-align:center; padding-top:5%">
        <h3 style="color: #53565a; opacity:50%; padding-bottom:10px"><b>Aún no ha registrado su solicitud para
                participar en la evaluación</b>
        </h3>
    </div>
    <div class="container" id="soldetalles" style="padding-top:5%">
        <div class="row">
            <div class="col-md-5" style="text-align: left"><b style="font-size:18px">Archivo</b></div>
            <div class="col-md-4" style="text-align: center"><b style="font-size:18px">Fecha de envío</b></div>
            <div class="col-md-3" style="text-align: center"><b style="font-size:18px">Estatus</b></div>
        </div>
        <div class="row">
            <div class="col-md-5 col-file" style="text-align: left" id="nombrearchivo"></div>
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
                    style="padding: 13% 7%; width: max-content;" type="button" data-toggle="modal"
                    data-target="#myModal" name="enviarsol">Enviar
                    solicitud firmada

                </button>

            </form>
        </div>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

</div>