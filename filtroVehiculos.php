<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "gestion_vehicular";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>

<?php
// Realiza la consulta a la base de datos
$consulta = "SELECT placa, estado, foto FROM vehiculo"; // Reemplaza 'nombre_de_tu_tabla' por el nombre real de tu tabla
$resultado = mysqli_query($enlace, $consulta);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($enlace));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/filtroVehiculo.css">
</head>

<body>
    <header>
        <section class="logoNav">
            <a href="#" class="logo" id="header">Gestión</a>
            <img class="logoEmpresa" src="img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular" />
            <a href="#" class="logo" id="header"> Vehicular</a>
        </section>
        <nav>
            <ul>
                <li><a href="vehiculos.php">Vehiculos</a></li>
                <li><a href="chofer.php">Choferes</a></li>
                <li><a href="index.php"><img class="logoSalir" src="img/LogoCerrarSesion.png"
                            alt="Logo Cerrar Sesión"></a></li>
            </ul>
        </nav>
    </header>
    <section class="busqueda">
        <input type="text" id="busquedaVehiculos" placeholder="Buscar por placa">
        <select name="filtro" id="filtroVehiculos">
            <option selected="true" value="todos">Todos</option>
            <option value="estadoActivo">Activo</option>
            <option value="estadoMantenimiento">En Mantenimiento</option>
            <option value="estadoRuta">En Ruta</option>
            <option value="estadoBaja">Dado de Baja</option>
        </select>
        <a href="formularios/form_ingreso_vehiculo.html">Ingresar Vehiculo</a>
    </section>
    <section class="contenedorVehiculos">
        <?php
        // Itera sobre los resultados de la consulta
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $placa = $fila['placa'];
            $estado = $fila['estado'];
            $foto = base64_encode($fila['foto']);
            echo "<a href='vehiculos.php?placa=$placa' class='vehiculo'>";
                echo "<section class='contenedorInfo'>";
                    echo "<h1>$placa</h1>";
                    echo "<p class='estado estado$estado'></p>";
                echo "</section>";
                echo "<img src='data:image/jpeg;base64,$foto' alt='$placa'>";
            echo "</a>";
        }
        ?>
    </section>
    <footer class="footerChofer">
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="img/LogoFacebook.png"
                alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>
    <script src="js/filtroVehiculo.js"></script>
</body>

</html>