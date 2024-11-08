<?php
    // Iniciar sesion
    session_start();

    include 'usuarios_y_coches.php';
    
    //Validacion de lo campos. Si no son validos, los añade a la variable $_SESSION['errores']
    
    //Comprobar si los campos de nombre y apellido están vacios
    comprobarVacio($_POST['nombre'] ?? '',"nombre");

    comprobarVacio($_POST['apellido'] ?? '', 'apellido');

    // Validar DNI
    if (!validarDNI()) {
        $_SESSION['errores']['dni'] = "El DNI no es válido.";
    }
    // Validar si el usuario existe
    if(!usuarioExiste()) {
        $_SESSION['errores']['usuario'] = "El usuario no está registrado";
    }
    // Validar si la fecha de inicio es porterior a la fecha actual
    if(strtotime($_POST['fechaInicio']) <= strtotime(date('Y-m-d'))) {
        $_SESSION['errores']['inicio'] = "La fecha de inicio tiene que ser posterior a la fecha actual";
    }
    // Validar si la duracion es un numero entre 1 y 30
    if (!is_numeric($_POST['duracion']) || $_POST['duracion'] < 1 || $_POST['duracion'] > 30) {
        $_SESSION['errores']['duracion'] = "La duracion de la reserva debe ser de entre 1 y 30 dias";
    }
    // Comprueba si el modelo solicitado se encuentra disponible
    if (!cocheDisponible($coches)) {
        $_SESSION['errores']['disponible'] = "El modelo solicitado no se encuentra disponible";
    }

    comprobarErrores();


    // FUNCIONES

    // Comprueba si el campo pasado por parametro se encuentra vacío y lo añade a la variable $_SESSION['errores']
    function comprobarVacio($campo, $nombreCampo) {
        if (empty($campo)) {
            $_SESSION['errores'][$nombreCampo] = "El ".$nombreCampo." no puede estar vacío.";
        }
    }

    // Comprueba si el DNI cumple con el algoritmo del modulo 23
    function validarDNI() {
        if (!empty($_POST['dni'])){

            $letra = strtoupper(substr($_POST['dni'], -1));
            $numerosDNI = substr($_POST['dni'], 0, -1);

            if (!is_numeric($numerosDNI) || strlen($numerosDNI) != 8){
            return false;  
            }
            $letrasValidas = "TRWAGMYFPDXBNJZSQVHLCKE";
            $asignacion = intval($numerosDNI) % 23;

            
            return $letrasValidas[$asignacion] == $letra;
        } 
        return false; 
            
    }

    // Comprueba si el usuario existe
    function usuarioExiste() {
        foreach (USUARIOS as $usuario) {
            if($usuario['nombre'] == ($_POST['nombre'] ?? '') && $usuario['apellido'] == ($_POST['apellido'] ?? '') 
            && $usuario['dni'] == ($_POST['dni'] ?? '')) {
                return true;
            }
        }
        return false;
    }

    // Comprueba si el modelo de vehiculo está disponible en la fecha seleccionada
    function cocheDisponible($coches) {
           
        foreach($coches as $coche) {           
            if ($coche['modelo'] == $_POST['modelo']) { 

                if($coche['disponible'] === true) {
                    return true;

                } else if(!empty($_POST['fechaInicio'])){
                    
                    $fechaReserva = new DateTime($_POST['fechaInicio']);
                    $fechaNoDisponible = new DateTime($coche['fecha_inicio']);
                    $fechaFin = (clone $fechaReserva)->modify('+' . $_POST['duracion'] . ' day');
                    $fechaNoDisponibleFin = new DateTime($coche['fecha_fin']);
                    if ($fechaReserva < $fechaNoDisponible && $fechaFin < $fechaNoDisponible) {
                        return true;
                    } else if ($fechaReserva > $fechaNoDisponibleFin && $fechaFin > $fechaNoDisponibleFin) {
                        return true;
                    } else {
                        return false;
                    }
                }
                return false;
            }            
        }  
        return false;  
    }

    // Comprueba si el array $_SESSION['errores'] está vacio o no
    // Si está vacío, abre la página reserva_valida.php, sino reserva_noValida.php
    function comprobarErrores() {
        if (empty($_SESSION['errores'])) {        
            include 'reserva_valida.php';
            
        } else {
            include 'reserva_noValida.php';
        }

    }


?>
