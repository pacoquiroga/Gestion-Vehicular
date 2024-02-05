<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "gestion_vehicular";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    /* =================== OBTENER INFO DE BD =================== */

    // Obtener el valor seleccionado del formulario
    $opcionSeleccionadaBD = mysqli_real_escape_string($enlace, $_GET['vehiculos']);

    // Consultar la base de datos para obtener información del vehículo seleccionado
    $query = "SELECT * FROM vehiculo WHERE placa = '$opcionSeleccionadaBD'";
    $result = mysqli_query($enlace, $query);

    if ($result) {
        $vehiculoEncontradoBD = mysqli_fetch_assoc($result);
    } else {
        echo "Error en la consulta: " . mysqli_error($enlace);
    }

    /* =================== FIN OBTENER INFO DE BD =================== */

    /* =================== OBTENER INFO DE JSON =================== */

    // Obtener el valor seleccionado del formulario
    $opcionSeleccionada = $_GET['vehiculos'];

    // Cargar el contenido del archivo JSON
    $contenidoJson = file_get_contents("datos/vehiculos.json");

    if ($contenidoJson !== false) {
        // Decodificar el JSON
        $vehiculos = json_decode($contenidoJson, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            // Buscar el vehículo seleccionado
            $vehiculoEncontrado = null;

            foreach ($vehiculos as $vehiculo) {
                if ($opcionSeleccionada == $vehiculo['placa']) {
                    $vehiculoEncontrado = $vehiculo;
                    break;
                } else {
                    $vehiculoEncontrado = null;
                }
            }

        } else {
            echo "Error al decodificar el JSON: " . json_last_error_msg();
        }
    } else {
        echo "Error al leer el archivo JSON.";
    }
    /* =================== FIN OBTENER INFO DE JSON =================== */
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/vehiculos.css">
    <link rel="stylesheet" href="css/form.css">

    <title>Gestión Vehicular</title>
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
                <li><a href="index.php"><img class="logoSalir" src="img/LogoCerrarSesion.png" alt="Logo Cerrar Sesión"></a></li>
            </ul>
        </nav>
    </header>

    <dialog  id="popupform-container" class="form-container">
            <section class="formHeader">
                <h2>Ingreso Nuevo Vehiculo</h2>
                <button id="cerrarForm">&times;</button>
            </section >


            <form method="dialog" action="../vehiculoNuevo.php" method="get">
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
                            <input type="text" id="marca" oninput="validarLetra(this)" name="marca"
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
                            
                            <input type="file" id="foto" name="foto" accept="image/*">
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
                            <input type="text" id="tipo_combustible" oninput="validarLetra(this)" name="tipo_combustible"
                                pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+"
                                title="Ingresa únicamente texto (sin números ni caracteres especiales)" required><br>
                            <label for="tipo_combustible">Tipo de Combustible</label>
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


    <section class="busqueda">
        <form action="vehiculos.php" method="get">
            <select name="vehiculos" id="vehiculos">
                <option selected="true" disabled="disabled" value="0">Seleccione la Placa del Vehículo</option>
                <?php
                $queryPlacas = "SELECT placa FROM vehiculo";
                $resultPlacas = mysqli_query($enlace, $queryPlacas);

                if ($resultPlacas) {
                    while ($placa = mysqli_fetch_assoc($resultPlacas)) {
                        echo "<option value='" . $placa['placa'] . "'>" . $placa['placa'] . "</option>";
                    }
                } else {
                    echo "Error en la consulta: " . mysqli_error($enlace);
                }
                ?>
            </select>
            <input type="submit" value="">
        </form>
        <button id="abrirForm">Ingresar Vehiculo</button>
        
        

    </section>

    <section class="menu">
        <a href="#informacion">
            <img src="img/BusMercedes.jpg" alt="Información">
            <p>INFORMACION</p>
        </a>
        <a href="#mantenimiento">
            <img src="img/mantenimiento.jpg" alt="Mantenimientos">
            <p>MANTENIMIENTOS</p>
        </a>
        <a href="#viajes">
            <img src="img/recorridos.jpg" alt="Viajes">
            <p>VIAJES</p>
        </a>
    </section>

    <?php if (isset($vehiculoEncontrado)): ?>
        <section class="seleccionado">
            <h2>Vehículo seleccionado:
                <?php echo $vehiculoEncontradoBD["placa"]; ?>
            </h2>
        </section>

        <section id="informacion" class="informacion">

            <section class="contenedor-imagen">

                <img src="<?php echo $vehiculoEncontradoBD["fotoVehiculo"]; ?>"
                    alt="<?php echo $vehiculoEncontradoBD["marca_modelo"]; ?>">

                <?php if ($vehiculoEncontradoBD["cedulaChofer"] != ""): ?>
                    <section id="contenedorChofer">
                        <p>Chofer Asignado:</p>
                        <a
                            href="http://localhost/Gestion-Local/chofer.php?busqueda=<?php echo $vehiculoEncontradoBD['cedulaChofer']; ?>">
                            <?php echo $vehiculoEncontradoBD["nombreChofer"]; ?>
                        </a>
                    </section>

                <?php else: ?>
                    <section id="contenedorChofer">

                        <button id="btnAsignarChofer" onclick="abrirPopup()">Asignar Chofer</button>
                        <dialog id="popupAsignarChofer">
                            <button class="btnCerrar" onclick="cerrarPopup()">Cerrar</button>
                            <section id="infoPopup">
                                <h1>Asignar Chofer</h1>
                                <section class="buscarCedula">
                                    <input type="number" class="cedulaBuscada" placeholder="Ingresa Cedula" name="busqueda">
                                    <button id="btnBuscarChofer" onclick="AsignarChofer()"></button>
                                </section>
                            </section>
                        </dialog>
                    </section>
                <?php endif; ?>
            </section>
            <article>
                <h1>Información General</h1>
                <p><strong>Placa: </strong>
                    <?php echo $vehiculoEncontradoBD["placa"]; ?>
                </p>
                <p><strong>Modelo: </strong>
                    <?php echo $vehiculoEncontradoBD["marca_modelo"]; ?>
                </p>
                <p><strong>Año: </strong>
                    <?php echo $vehiculoEncontradoBD["anio"]; ?>
                </p>
                <p><strong>Tipo de Vehículo: </strong>
                    <?php echo $vehiculoEncontrado["tipo_vehiculo"]; ?>
                </p>
                <p><strong>Capacidad: </strong>
                    <?php echo $vehiculoEncontrado["capacidad"]; ?>
                </p>
            </article>
            <article>
                <h1>Información Técnica</h1>
                <p><strong>Combustible: </strong>
                    <?php echo $vehiculoEncontradoBD["tipoCombustible"]; ?>
                </p>
                <p><strong>Motor: </strong>
                    <?php echo $vehiculoEncontrado["informacion_tecnica"]["motor"]; ?>
                </p>
                <p><strong>Kilometraje: </strong>
                    <?php echo $vehiculoEncontradoBD["kilometraje"]; ?>
                </p>
                <p><strong>Peso: </strong>
                    <?php echo $vehiculoEncontradoBD["peso"]; ?>
                </p>
            </article>

        </section>

        <section id="mantenimiento" class="mantenimiento">
            <h1>MANTENIMIENTOS</h1>
            <section class="mant-container">
                <section>
                    <ul class="options">
                        <li id="enProceso" class="option option-active">En Proceso</li>
                        <li id="historial" class="option">Historial</li>
                        <nav>
                            <a href="formularios/form_ingreso_chofer.php">Agregar Mantenimiento</a>
                        </nav>
                    </ul>
                    <section class="contents">
                        <section id="enProceso-content" class="content content-active">
                            <h3>En Proceso</h3>
                            <p>No existe ningun mantenimiento en proceso para este vehiculo.</p>

                        </section>
                        <section id="historial-content" class="content">
                            <h3>Historial</h3>
                            <section class="table-container">
                                <table>
                                    <thead>
                                        <th>Vehículo</th>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Costo</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($vehiculo["mantenimientos_proximos"] as $mantenimiento): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $vehiculo["placa"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $mantenimiento["fecha"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $mantenimiento["descripcion"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $mantenimiento["costo"]; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </section>
                        </section>
                    </section>

                </section>


            </section>
        </section>






        <section id="viajes" class="viajes">
            <h1>Viajes Realizados</h1>
            <table>
                <thead>
                    <tr>
                        <th>Vehiculo</th>
                        <th>Conductor</th>
                        <th>Hora de Salida</th>
                        <th>Hora de Llegada</th>
                        <th>Recorrido (km)</th>
                        <th>Tiempo (h)</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($vehiculo["viajes_realizados"] as $viaje): ?>
                    <tr>
                        <td>
                            <?php echo $vehiculo["placa"]; ?>
                        </td>
                        <td>
                            <?php echo $viaje["conductor"]; ?>
                        </td>
                        <td>
                            <?php echo $viaje["hora_salida"]; ?>
                        </td>
                        <td>
                            <?php echo $viaje["hora_llegada"]; ?>
                        </td>
                        <td>
                            <?php echo $viaje["recorrido_km"]; ?>
                        </td>
                        <td>
                            <?php echo $viaje["tiempo_h"]; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </section>
    <?php endif; ?>

    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="img/LogoFacebook.png"
                alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>

    <script src="js/mantenimiento.js"></script>
    <script src="js/header.js"></script>
    <script src="js/asignarChofer.js"></script>
    <script src="js/form.js"></script>
    
</body>

</html>