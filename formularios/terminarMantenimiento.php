<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}

$IDVehiculoMANTENIMIENTO = $_POST['IDVehiculoMANTENIMIENTO'];
$costo = $_POST['costo'];
$fechaFin = $_POST['fechaFin'];

$consulta = ("UPDATE vehiculo_mantenimiento SET fechaFin = '$fechaFin', costo = '$costo' , exitoso = 1 WHERE IDVehiculoMANTENIMIENTO = '$IDVehiculoMANTENIMIENTO'");
$resultado = mysqli_query($enlace, $consulta);

$updateEstadoVehiculo = "UPDATE vehiculo SET estado = 'Activo' WHERE IDVehiculo = '$IDVehiculoMANTENIMIENTO'";
$resultadoUpdate = mysqli_query($enlace, $updateEstadoVehiculo);

if ($resultado && $resultadoUpdate) {
    echo "Mantenimiento terminado con éxito";
} else {
    echo "No se pudo terminar el mantenimiento";
}

