<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}

$idChofer = $_POST['IDChofer'];
$idVehiculo = $_POST['IDVehiculo'];
$fecha = $_POST['fecha'];

$validacion = "SELECT * FROM bitacora_chofer WHERE IDChofer = '$idChofer' AND IDVehiculo = '$idVehiculo'";
$resultadoValidacion = mysqli_query($enlace, $validacion);

if (mysqli_num_rows($resultadoValidacion) > 0) {
    echo "Ya existe un registro de bitacora para este chofer y vehiculo, no se puede asignar nuevamente.";
} else {
    $insertarBitacora = "INSERT INTO bitacora_chofer (IDChofer, IDVehiculo, fechaAsignacion, fechaFinalizacion, observacion) VALUES ('$idChofer', '$idVehiculo', '$fecha', NULL, NULL)";
    $resultado = mysqli_query($enlace, $insertarBitacora);

    if ($resultado) {
        echo "Bitacora asignada correctamente";
    } else {
        echo "Error al asignar bitacora";
    }
}
?>