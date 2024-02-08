<?php

// Verificar si se recibió el parámetro 'placa' en la URL
if (isset($_GET['placa'])) {
    // Capturar el valor de 'placa'
    $placaEnviada = $_GET['placa'];
}


//Conexion a la base de datos
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "gestion_vehicular";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Realiza la consulta a la base de datos
$consultaV = "SELECT * FROM vehiculo WHERE placa = '$placaEnviada'";
$vehiculoEnviado = mysqli_query($enlace, $consultaV);
$row = mysqli_fetch_assoc($vehiculoEnviado);
// Ahora puedes acceder a los datos del vehículo usando $row
// Ejemplo:
$IDVehiculo = $row['IDVehiculo'];
$placa = $row['placa'];
$modelo = $row['modelo'];
$anio = $row['anio'];
$estado = $row['estado'];
$tipoCombustible = $row['tipoCombustible'];
$foto = $row['foto'];
$peso = $row['peso'];
$kilometraje = $row['kilometraje'];



// Consulta para obtener los mantenimientos terminados
$consultaM_terminados = "SELECT * FROM mantenimiento WHERE tipoMantenimiento = 'terminado'";
$resultado_terminados = mysqli_query($enlace, $consultaM_terminados);

// Verificar si la consulta fue exitosa
if (!$resultado_terminados) {
    // Manejar el error de la consulta, si lo hay
    echo "Error en la consulta de mantenimientos terminados: " . mysqli_error($enlace);
} else {
    // Arreglo para almacenar los mantenimientos terminados
    $mantenimientos_terminados = array();

    // Recorrer los resultados y almacenarlos en el arreglo
    while ($row = mysqli_fetch_assoc($resultado_terminados)) {
        $mantenimientos_terminados[] = $row;
    }
}

// Consulta para obtener los mantenimientos en proceso
$consultaM_en_proceso = "SELECT * FROM mantenimiento WHERE tipoMantenimiento = 'En Proceso'";
$resultado_en_proceso = mysqli_query($enlace, $consultaM_en_proceso);

// Verificar si la consulta fue exitosa
if (!$resultado_en_proceso) {
    // Manejar el error de la consulta, si lo hay
    echo "Error en la consulta de mantenimientos en proceso: " . mysqli_error($enlace);
} else {
    // Arreglo para almacenar los mantenimientos en proceso
    $mantenimientos_en_proceso = array();

    // Recorrer los resultados y almacenarlos en el arreglo
    while ($row = mysqli_fetch_assoc($resultado_en_proceso)) {
        $mantenimientos_en_proceso[] = $row;
    }
}



// Ejecutar la consulta
$consultaV = "SELECT * FROM ruta";

// Ejecutar la consulta
$rutas_resultado = mysqli_query($enlace, $consultaV);

// Verificar si la consulta fue exitosa
if ($rutas_resultado) {
    // Arreglo para almacenar las rutas
    $rutas = array();

    // Iterar sobre los resultados y almacenar cada fila en el arreglo
    while ($row = mysqli_fetch_assoc($rutas_resultado)) {
        $rutas[] = $row;
    }

    // Liberar el resultado
    mysqli_free_result($rutas_resultado);

    // Ahora $rutas contiene todas las rutas de la base de datos
} else {
    // Manejar el error de la consulta, si lo hay
    echo "Error en la consulta: " . mysqli_error($enlace);
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
                <li><a href="filtroVehiculos.php">Vehiculos</a></li>
                <li><a href="chofer.php">Choferes</a></li>
                <li><a href="index.php"><img class="logoSalir" src="img/LogoCerrarSesion.png"
                            alt="Logo Cerrar Sesión"></a></li>
            </ul>
        </nav>
    </header>





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

    <?php if (isset($vehiculoEnviado)): ?>
        <section class="seleccionado">
            <h2>Vehículo seleccionado:
                <?php echo $placa; ?>
            </h2>
        </section>

        <section id="informacion" class="informacion">

            <section class="contenedor-imagen">

                <?php
                echo "<img src='data:image/jpeg;base64,$foto' alt='$placa'>";
                $busquedaBitacora = ("SELECT * FROM bitacora_chofer WHERE IDVehiculo = '$IDVehiculo'");
                $resultadoBusquedaBitacora = mysqli_query($enlace, $busquedaBitacora);
                if ($resultadoBusquedaBitacora != null && mysqli_num_rows($resultadoBusquedaBitacora) > 0):
                    $bitacoraEncontrada = mysqli_fetch_assoc($resultadoBusquedaBitacora);
                    $IDChofer = $bitacoraEncontrada['IDChofer'];
                    $busquedaChofer = ("SELECT * FROM chofer WHERE IDChofer = " . $IDChofer);
                    $resultadoBusquedaChofer = mysqli_query($enlace, $busquedaChofer);
                    $choferEncontrado = mysqli_fetch_assoc($resultadoBusquedaChofer);
                    ?>
                    <section id="contenedorChofer">
                        <p>Chofer Asignado:</p>
                        <a href="http://localhost/Gestion-Local/chofer.php?busqueda=<?php echo $choferEncontrado['CI']; ?>">
                            <?php echo $choferEncontrado["nombreChofer"] . " " . $choferEncontrado["apellidoChofer"]; ?>
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
                                    <input type="hidden" id="IDVehiculoAsignar" value="<?php echo $IDVehiculo; ?>">
                                    <input type="number" class="cedulaBuscada" placeholder="Ingresa Cedula" name="busqueda"
                                        required>
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
                    <?php echo $placa ?>
                </p>
                <p><strong>Modelo: </strong>
                    <?php echo $modelo; ?>
                </p>
                <p><strong>Año: </strong>
                    <?php echo $anio; ?>
                </p>

            </article>
            <article>
                <h1>Información Técnica</h1>
                <p><strong>Combustible: </strong>
                    <?php echo $tipoCombustible; ?>
                </p>
                <p><strong>Kilometraje: </strong>
                    <?php echo $kilometraje; ?>
                </p>
                <p><strong>Peso: </strong>
                    <?php echo $peso; ?>
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
                            <section class='table-container'>
                                <table>
                                    <thead>
                                        <th>Vehículo</th>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Costo</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($mantenimientos_en_proceso as $mantenimiento) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $placa; ?>
                                                </td>
                                                <td>12/02/2024</td>
                                                <td>
                                                    <?php echo $mantenimiento['nombreMantenimiento']; ?>
                                                </td>
                                                <td>$50</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </section>
                        </section>
                        <section id="historial-content" class="content">
                            <h3>Historial</h3>
                            <section class='table-container'>
                                <table>
                                    <thead>
                                        <th>Vehículo</th>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Costo</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($mantenimientos_terminados as $mantenimiento) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $placaEnviada; ?>
                                                </td>
                                                <td>15/08/2023</td>
                                                <td>
                                                    <?php echo $mantenimiento['nombreMantenimiento']; ?>
                                                </td>
                                                <td>$500</td>
                                            </tr>
                                        <?php } ?>
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

            <section class="mant-container">
                <section>
                    <ul class="optionsV">
                        <li id="enProcesoViaje" class="optionV option-activeV">En Proceso</li>
                        <li id="historialViaje" class="optionV">Historial</li>
                        <nav>
                            <a href="formularios/form_ingreso_chofer.php">Agregar Mantenimiento</a>
                        </nav>
                    </ul>
                    <section class="contentsV">
                        <section id="enProceso-contentV" class="contentV content-activeV">
                            <h3>En Proceso</h3>
                            <p>No existen viajes en proceso</p>
                        </section>
                        <section id="historial-contentV" class="contentV">
                            <h3>Historial</h3>
                            <section class='table-containerV'>
                                <table>
                                    <thead>
                                        <th>Vehiculo</th>
                                        <th>Chofer</th>
                                        <th>Ubicacion de Salida</th>
                                        <th>Ubicacion de Llegada</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rutas as $ruta) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $placaEnviada; ?>
                                                </td>
                                                <td>Pedro Vicente Maldonado</td>
                                                <td>
                                                    <?php echo $ruta['ubiInicio']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $ruta['ubiFin']; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </section>
                        </section>
                    </section>

                </section>


            </section>
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
    <script src="js/viajes.js"></script>
    <script src="js/header.js"></script>
    <script src="js/asignarChofer.js"></script>
</body>

</html>