<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}

$idChofer = $_POST['IDChofer'];
$idVehiculo = $_POST['IDVehiculo'];
$fecha = $_POST['fecha'];

$insertarBitacora = "INSERT INTO bitacora_chofer (IDChofer, IDVehiculo, fechaAsignacion, fechaFinalizacion, observacion) VALUES ('$idChofer', '$idVehiculo', '$fecha', NULL, NULL)";
$resultado = mysqli_query($enlace, $insertarBitacora);

if ($resultado) {
    echo "Bitacora asignada correctamente";
} else {
    echo "Error al asignar bitacora";
}

?>