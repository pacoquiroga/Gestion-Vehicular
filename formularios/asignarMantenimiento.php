<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}

$IDMantenimiento = $_POST['IDMantenimiento'];
$IDVehiculo = $_POST['IDVehiculo'];
$costo = $_POST['costo'];
$fechaInicio = $_POST['fechaInicio'];
$exitoso = 0;

$consulta = "INSERT INTO vehiculo_mantenimiento (IDMantenimiento, IDVehiculo, costo, fechaInicio, exitoso)
VALUES ('$IDMantenimiento', '$IDVehiculo', '$costo', '$fechaInicio', '$exitoso')";

$resultado = mysqli_query($enlace, $consulta);

$updateEstadoVehiculo = "UPDATE vehiculo SET estado = 'Mantenimiento' WHERE IDVehiculo = '$IDVehiculo'";
$resultadoUpdate = mysqli_query($enlace, $updateEstadoVehiculo);

if ($resultado && $resultadoUpdate) {
    echo "Mantenimiento asignado correctamente";
} else {
    echo "Error al asignar bitacora";
}