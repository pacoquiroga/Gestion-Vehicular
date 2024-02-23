<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}
$nombreMantenimiento = $_POST['nombreMantenimiento'];
$tipoMantenimiento = $_POST['tipoMantenimiento'];

$consultaValidarRepetido = "SELECT * FROM mantenimiento WHERE nombreMantenimiento = '$nombreMantenimiento' AND tipoMantenimiento = '$tipoMantenimiento'";
$resultadoValidarRepetido = mysqli_query($enlace, $consultaValidarRepetido);

if (mysqli_num_rows($resultadoValidarRepetido) > 0) {
    echo "repetido";
    return;
} else {

    $consulta = "INSERT INTO mantenimiento (nombreMantenimiento, tipoMantenimiento) VALUES ('$nombreMantenimiento', '$tipoMantenimiento')";
    $resultado = mysqli_query($enlace, $consulta);

    if ($resultado) {
        $consultaID = "SELECT * FROM mantenimiento WHERE nombreMantenimiento = '$nombreMantenimiento' AND tipoMantenimiento = '$tipoMantenimiento' LIMIT 1";
        $resultadoID = mysqli_query($enlace, $consultaID);
        $IDMantenimiento = mysqli_fetch_assoc($resultadoID)['IDMantenimiento'];
        echo $IDMantenimiento;
    } else {
        echo "Error al insertar mantenimiento";
    }
}
