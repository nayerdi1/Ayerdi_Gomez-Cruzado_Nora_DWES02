<?php
    if (isset($_COOKIE['error'])) {
        $colorError = $_COOKIE['error'];            
    } else {
        $colorError = 'black';
    }
    if (isset($_COOKIE['ok'])) {
        $colorOk = $_COOKIE['ok'];            
    } else {
        $colorOk = 'black';
    }
    function comprobarError($campo) {
        if (isset($_SESSION['errores'][$campo])){
            echo '<span class="error">'. $_SESSION['errores'][$campo].' </span>';
        };
    }

    session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva no válida</title>
    <style>
        .error {  color: <?php echo $colorError?>; }
        .ok { color: <?php echo $colorOk?>; }
    </style>
</head>
<body>
    <!-- Titulo de página -->
    <h1>Reserva no válida</h1>

    <form action="procesar_reserva.php" method="POST">

        <!-- Campo de Nombre -->
        <label class="<?php echo isset($_SESSION['errores']['nombre']) ? 'error' : 'ok'; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        </label>
        <?php comprobarError('nombre')?>
        <br>
        <br>
        <!-- Campo de Apellido -->
        <label class="<?php echo isset($_SESSION['errores']['apellido']) ? 'error' : 'ok'; ?>">
            Apellido: <input type="text" name="apellido" value="<?php echo ($_POST['apellido']); ?>">
        </label>
        <?php comprobarError('apellido')?>
        <br>
        <br>
        <!-- Campo de DNI -->
        <label class="<?php echo isset($_SESSION['errores']['dni']) ? 'error' : 'ok'; ?>">
            DNI: <input type="text" name="dni" value="<?php echo ($_POST['dni']); ?>">
        </label>
        <?php comprobarError('dni')?>
        <br>
        <br>
        <!-- Linea para usuario incorrecto -->
        <?php comprobarError('usuario')?>
        <br>
        <br>
        <!-- Linea de modelo disponible  -->
        <label class="<?php echo isset($_SESSION['errores']['disponible']) ? 'error' : 'ok'; ?>">
            Modelo de Vehículo: <?php echo ($_POST['modelo'])?></label>
        <?php comprobarError('disponible')?>
        <br>
        <br>
        <!-- Campo de Fecha Inicio  -->
        <label class="<?php echo isset($_SESSION['errores']['inicio']) ? 'error' : 'ok'; ?>">
            Fecha de Inicio: <input type="date" name="fecha_inicio" value="<?php echo ($_POST['fechaInicio']); ?>">
        </label>
        <?php comprobarError('inicio')?>
        <br>
        <br>
        <!-- Campo de Duración de la Reserva  -->
        <label class="<?php echo isset($_SESSION['errores']['duracion']) ? 'error' : 'ok'; ?>">
            Duración (días): <input type="number" name="duracion" value="<?php echo ($_POST['duracion']); ?>">
        </label>
        <?php comprobarError('duracion')?>
    </form>

</body>
</html>