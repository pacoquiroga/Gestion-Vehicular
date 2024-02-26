<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}

$consulta = "SELECT * FROM mantenimiento";

$resultado = mysqli_query($enlace, $consulta);

if (mysqli_num_rows($resultado) == 0) {
    echo "No existen mantenimientos";
    return;
}

$mantenimientos = array();

while ($mantenimiento = mysqli_fetch_assoc($resultado)) {
    $mantenimientos[] = array(
        'IDMantenimiento' => $mantenimiento['IDMantenimiento'],
        'nombreMantenimiento' => $mantenimiento['nombreMantenimiento'],
        'tipoMantenimiento' => $mantenimiento['tipoMantenimiento']
    );
}

echo json_encode($mantenimientos);
