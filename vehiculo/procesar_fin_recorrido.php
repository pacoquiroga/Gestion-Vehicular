<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("No Se Pudo Conectar Con El Servidor: " . mysqli_connect_error());
}

$IDRecorrido = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $placa = mysqli_real_escape_string($enlace, $_POST['placaVehiculo']);
    $IDVehiculo = mysqli_real_escape_string($enlace, $_POST['IDVehiculo']);
    
    $fechaInicio = mysqli_real_escape_string($enlace, $_POST['fechaInicioP']);
    $horaInicio = mysqli_real_escape_string($enlace, $_POST['horaInicioP']);
    $kmInicio = mysqli_real_escape_string($enlace, $_POST['kilometrajeInicioP']);
    
    $fechaFin = mysqli_real_escape_string($enlace, $_POST['fechaFinP']);
    $horaFin = mysqli_real_escape_string($enlace, $_POST['horaFinP']);
    $kmFin = mysqli_real_escape_string($enlace, $_POST['kmFin']);

    $ubiInicio = $_POST['ubiInicioProceso'];
    $ubiFin = $_POST['ubiFinProceso'];
   
    // Consulta para obtener el IDRecorrido
    $consultaRecorre = "SELECT IDRecorrido FROM recorre WHERE IDVehiculo = '$IDVehiculo' AND fechaInicio = '$fechaInicio' AND horaInicio = '$horaInicio' AND kmInicio = '$kmInicio'";
    $resultadoConsultaRecorre = mysqli_query($enlace, $consultaRecorre);

    if ($resultadoConsultaRecorre && mysqli_num_rows($resultadoConsultaRecorre) > 0) {
        $fila = mysqli_fetch_assoc($resultadoConsultaRecorre);
        $IDRecorrido = $fila['IDRecorrido'];

        // Actualizar recorrido
        $modificarRecorre = "UPDATE recorre SET fechaFin = '$fechaFin', horaFin = '$horaFin', kmFin = '$kmFin' WHERE IDRecorrido = '$IDRecorrido'";
        $resultadoModificarRecorre = mysqli_query($enlace, $modificarRecorre);

        // Actualizar kilometraje
        $actualizarkm = "UPDATE vehiculo SET kilometraje = '$kmFin', estado = 'Activo' WHERE IDVehiculo = '$IDVehiculo'";
        $resultadoActualizarKm = mysqli_query($enlace, $actualizarkm);

        if($resultadoModificarRecorre && $resultadoActualizarKm){
            echo "<script type='text/javascript'>
            window.location.href='vehiculos.php?placa=$placa';
            alert('El vehiculo finalizó su recorrido.');
            </script>";
        } else {
            echo "Error al actualizar el recorrido o el kilometraje.";
        }
    } else {
        echo "No se encontró ningún recorrido para actualizar.";
    }
}
?>
