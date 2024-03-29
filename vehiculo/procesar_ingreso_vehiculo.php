<?php
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("No Se Pudo Conectar Con El Servidor: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha subido un archivo
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Lee el contenido del archivo de la imagen y lo codifica en base64
        $foto_temp = $_FILES['foto']['tmp_name'];
        $foto_contenido = base64_encode(file_get_contents($foto_temp));

        $placa = mysqli_real_escape_string($enlace, $_POST['placa']);
        $modelo = mysqli_real_escape_string($enlace, $_POST['modelo']);
        $anio = mysqli_real_escape_string($enlace, $_POST['anio']);
        $estado = 'Activo';
        $tipoCombustible = mysqli_real_escape_string($enlace, $_POST['tipo_combustible']);
        $peso = mysqli_real_escape_string($enlace, $_POST['peso']);
        $kilometraje = mysqli_real_escape_string($enlace, $_POST['kilometraje']);
        $observacionEstado = '';
        

        // Inserta los datos en la base de datos
        $sql = "INSERT INTO vehiculo (placa, modelo, anio, estado, tipoCombustible, peso, kilometraje, observacionEstado, fechaBaja, foto) 
                VALUES ('$placa', '$modelo', '$anio', '$estado', '$tipoCombustible', '$peso', '$kilometraje', '$observacionEstado', NULL, '$foto_contenido')";

        $resultado = mysqli_query($enlace, $sql);

        if ($resultado) {
            
        } else {
           
        }
    } else {
        
    }
}

$idVehiculo = 5;

// Realiza una consulta SELECT para obtener la información del vehículo, incluida la imagen
$sql = "SELECT placa, modelo, anio, estado, tipoCombustible, peso, kilometraje, observacionEstado, fechaBaja, foto FROM vehiculo WHERE placa = '$placa'";
$resultado = mysqli_query($enlace, $sql);

if (!$resultado) {
    die("Error al obtener los datos del vehículo: " . mysqli_error($enlace));
}

$vehiculo = mysqli_fetch_assoc($resultado);

mysqli_close($enlace);


echo "<script type='text/javascript'>
window.location.href='filtroVehiculos.php';
alert('Datos agregados correctamente.');
</script>";
?>

