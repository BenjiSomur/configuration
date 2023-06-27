<div id="solicitudevaluacion">
    <h1 style="color: #53565a">Generar solicitud de evaluación</h1>
    <form action="generateDocument.php" method="post">
    <input type="hidden" name="keyIPES" value="CE21387653" />
        <button id="btn-gen" class="btn btn-primary my-3" type="submit" name="generarsol"> Generar solicitud</button>
    </form>
    <form action="<?php echo $_POST['PHP_SELF']; ?>" method="post">
        <button id="btn-env" class="btn btn-secondary my-2" type="submit" name="enviarsol">Enviar solicitud</button>
    </form>
</div>