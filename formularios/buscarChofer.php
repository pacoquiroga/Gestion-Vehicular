<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}

$CI = $_POST['numCedula'];

$consulta = "SELECT * FROM chofer WHERE CI = '$CI' LIMIT 1";

$resultado = mysqli_query($enlace, $consulta);

$chofer = mysqli_fetch_assoc($resultado);
if ($chofer == NULL) {
    echo "No se encontró el chofer";
    return;
}

$choferEncontrado = array(
    'IDChofer' => $chofer['IDChofer'],
    'nombreChofer' => $chofer['nombreChofer'],
    'apellidoChofer' => $chofer['apellidoChofer'],
    'edad' => $chofer['edad'],
    'numTelefono' => $chofer['numTelefono'],
    'CI' => $chofer['CI'],
    'sexo' => $chofer['sexo'],
    'tipoSangre' => $chofer['tipoSangre'],
    'licencia' => $chofer['licencia'],
    'correo' => $chofer['correo'],
    'foto' => base64_encode($chofer['foto'])
);


echo json_encode($choferEncontrado);

?>