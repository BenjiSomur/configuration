<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Generar solicitud</title>
</head>

<body style="text-align: center">
  <h1 style="color: #53565a">Generar solicitud de evaluación</h1>
  <?php
  if (isset($_POST['button1'])) {
    require './generateDocument.php';
  }
  ?>
  <form method="post">
    <input type="submit" name="button1" value="Generar solicitud" />
  </form>
</body>

</html>