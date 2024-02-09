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
    <title>Gestión Vehicular</title>
    <link rel="icon" href="../img/LogoGestionVehicular.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/filtroVehiculo.css">
    <link rel="stylesheet" href="../css/form.css">
</head>

<body>
    <dialog  id="popupform-container" class="form-container">
                <section class="formHeader">
                    <h2>Ingreso Nuevo Vehiculo</h2>
                    <button id="cerrarForm">&times;</button>
                </section >


                <form action="procesar_ingreso_vehiculo.php" method="post" enctype="multipart/form-data">
                    <section class="form-body">
                        <section class="info-container">
                            <h2>Información del Vehículo</h2>

                            <section class="grupo">
                                <input type="text" id="placa" name="placa" pattern="[A-Z]{3}\d{3-4}"
                                    title="Ingresa una placa válida (3 letras y 4 números, todo en mayúsculas)" required><br>
                                <label for="placa">Placa</label>
                            </section>
                            <br>

                            <section class="grupo">
                                <input type="text" id="marca" oninput="validarLetra(this)" name="modelo"
                                    pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+"
                                    title="Ingresa únicamente texto (sin números ni caracteres especiales)" required><br>
                                <label for="marca">Marca/Modelo</label>
                            </section>
                            <br>


                            <section class="grupo">
                                <input type="number" id="anio" oninput="validarNumero(this)" name="anio" min="1900" max="2023"
                                    pattern="\d+" title="Ingresa un número positivo" required><br>
                                <label for="anio">Año</label>
                            </section>
                            <br>

                            <section class="labelFoto">
                                
                                <input type="file" id="foto" name="foto" accept="image/*" required>
                            </section>
                            <br>


                            <br>
                        </section>
                        <section class="info-container">
                            <h2>Datos Técnicos</h2>

                            <section class="grupo">
                                <input type="number" id="kilometraje" oninput="validarNumero(this)" name="kilometraje" min="0"
                                    required><br>
                                <label for="kilometraje">Kilometraje</label>
                            </section>
                            <br>

                            <section class="grupo">
                            <label for="tipo_combustible" class="tipoCombustible">Tipo de Combustible:</label>
                            <br><br>
                                        <select name="tipo_combustible" id="tipo_combustible" required>
                                            <option value=""></option>
                                            <option>Super</option>
                                            <option>Extra</option>
                                            <option>Diesel</option>
                                            <option>Electrico</option>
                                        </select><br><br>
                            </section>
                            <br>


                            <section class="grupo">
                                <input type="number" id="peso" oninput="validarNumero(this)" name="peso" min="0" required><br>
                                <label for="peso">Peso</label>
                            </section>
                            <br>
                        </section>
                    </section>
                    <section class="formFooter">
                        <input type="submit" value="Enviar">
                    </section>

                </form>

    </dialog>
    <header>
        <section class="logoNav">
            <a href="../inicio.php" class="logo" id="header">Gestión</a>
            <img class="logoEmpresa" src="../img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular" />
            <a href="../inicio.php" class="logo" id="header"> Vehicular</a>
        </section>
        <nav>
            <ul>
                <li><a href="filtroVehiculos.php">Vehiculos</a></li>
                <li><a href="../chofer/chofer.php">Choferes</a></li>
                <li><a href="../index.php"><img class="logoSalir" src="../img/LogoCerrarSesion.png"
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
        <button id="abrirForm">Ingresar Vehiculo</button>



    </section>
    <section class="contenedorVehiculos">
        <?php
        // Itera sobre los resultados de la consulta
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $placa = $fila['placa'];
            $estado = $fila['estado'];
            $foto = $fila['foto'];
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
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="../img/LogoFacebook.png"
                alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="../img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="../img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>
    <script src="../js/filtroVehiculo.js"></script>
    <script src="../js/form.js"></script>
</body>

</html>