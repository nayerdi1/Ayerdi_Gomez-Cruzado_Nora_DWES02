<?php
    session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva válida</title>
</head>
<body>
    <!-- Titulo de página -->
    <h1>Reserva válida</h1>
    <!-- Linea para nombre -->
    <p><strong>Nombre:</strong> <?php echo $_POST['nombre']; ?></p>
    <!-- Linea para apellido -->
    <p><strong>Apellido:</strong> <?php echo $_POST['apellido']; ?></p>
   
    <!-- Mostrar imagen del coche dependiendo del modelo -->
    <img src="img/<?php echo $_POST['modelo']?>.jpg" alt="Imagen de coche" width="300">

</body>
</html>