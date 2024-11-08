<?php
    // Iniciar la sesión
    session_start();
    // Creación de variables de sesión
    $_SESSION['errores'] = array();
    $_SESSION['datos'] = array();
    // Creación de cookies
    setcookie('error', 'red', time() + 60*60*24*30);
    setcookie ('ok', 'green', time() + 60*60*24*30);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva de Vehículo</title>
</head>
<body>
    <h2>Formulario de Reserva de Vehículo</h2>
    <form action="proceso_validacion.php" method="post">
        <!-- Campo de Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <br>
        <br>
        <!-- Campo de Apellido -->
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido">
        <br>
        <br>
        <!-- Campo de DNI -->
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni">
        <br>
        <br>
        <!-- Desplegable del Modelo del Vehículo -->
        <label for="modelo">Modelo del Vehículo:</label>
        <select id="modelo" name="modelo">
            <option value="Lancia Stratos">Lancia Stratos</option>
            <option value="Audi Quattro">Audi Quattro</option>
            <option value="Ford Escort RS1800">Ford Escort RS1800</option>
            <option value="Subaru Impreza 555">Subaru Impreza 555</option>
        </select>
        <br>
        <br>
        <!-- Campo de Fecha de Inicio de la Reserva -->
        <label for="fechaInicio">Fecha de Inicio de la Reserva:</label>
        <input type="date" id="fechaInicio" name="fechaInicio">
        <br>
        <br>
        <!-- Campo de Duración de la Reserva -->
        <label for="duracion">Duración de la Reserva (en días):</label>
        <input type="number" id="duracion" name="duracion">
        <br>
        <br>
        <!-- Botón de Reservar -->
        <button type="submit">Reservar</button>
    </form>
</body>
</html>
