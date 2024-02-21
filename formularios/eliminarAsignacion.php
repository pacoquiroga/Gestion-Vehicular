<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}

$IDVehiculo = $_POST['IDVehiculo'];
$observacion = $_POST['observacion'];
$fechaFinalizacion = $_POST['fechaFinalizacion'];

$consulta = ("UPDATE bitacora_chofer SET fechaFinalizacion = '$fechaFinalizacion', observacion = '$observacion' WHERE IDVehiculo = '$IDVehiculo' AND fechaFinalizacion IS NULL");
$resultado = mysqli_query($enlace, $consulta);

if ($resultado) {
    echo "Bitácora eliminada correctamente";
} else {
    echo "No se encontró la bitácora";
}

?>