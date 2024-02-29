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
        $foto_contenido = file_get_contents($foto_temp); // No es necesario codificarlo en base64

        // Escapar y obtener otros datos del formulario
        $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
        $apellido = mysqli_real_escape_string($enlace, $_POST['apellido']);
        $edad = mysqli_real_escape_string($enlace, $_POST['edad']);
        $numTelefono = mysqli_real_escape_string($enlace, $_POST['telefono']);
        $CI = mysqli_real_escape_string($enlace, $_POST['numCedula']);
        $sexo = mysqli_real_escape_string($enlace, $_POST['sexo']);
        $tipoSangre = mysqli_real_escape_string($enlace, $_POST['sangre']);
        $tipoLicencia = mysqli_real_escape_string($enlace, $_POST['licencia']);
        $correo = mysqli_real_escape_string($enlace, $_POST['correo']);

        // Inserta los datos en la base de datos
        $sql = "INSERT INTO chofer (nombreChofer, apellidoChofer, edad, numTelefono, CI, sexo, tipoSangre, licencia, correo, foto) 
                VALUES ('$nombre', '$apellido', '$edad', '$numTelefono', '$CI', '$sexo','$tipoSangre', '$tipoLicencia', '$correo', ?)";

        // Preparar la consulta
        $stmt = mysqli_prepare($enlace, $sql);
        mysqli_stmt_bind_param($stmt, "s", $foto_contenido); // "s" indica que es un string binario (BLOB)

        // Ejecutar la consulta
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
        } else {
        }
    } else {
    }
}

mysqli_close($enlace);

echo "<script type='text/javascript'>
    window.location.href='../chofer/chofer.php';
    alert('Datos agregados correctamente.');
</script>";
?>