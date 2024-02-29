<?php

// Verificar si se recibió el parámetro 'placa' en la URL
if (isset($_GET['placa'])) {
    // Capturar el valor de 'placa'
    $placaEnviada = $_GET['placa'];
}


//Conexion a la base de datos
$servidor = "srv4";
$usuario = "gestion_vehicular";
$clave = "gestion_vehicular";
$baseDeDatos = "gestion_vehicular";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}


//CONSULTA CHOFER
$consultaChofer =
    "SELECT nombreChofer, apellidoChofer FROM chofer AS c
JOIN bitacora_chofer AS bc
ON c.IDChofer = bc.IDChofer
JOIN vehiculo AS v
ON v.IDVehiculo = bc.IDVehiculo
WHERE v.placa = '$placaEnviada' AND bc.fechaFinalizacion IS NULL";

$resultadoChofer = mysqli_query($enlace, $consultaChofer);
if (mysqli_num_rows($resultadoChofer) > 0){
    $chofer = mysqli_fetch_assoc($resultadoChofer);
    $nombreChofer = $chofer['nombreChofer'] . " " . $chofer['apellidoChofer'];
} else {
    echo "Error en la consulta: " . mysqli_error($enlace);
}

// Realiza la consulta a la base de datos
$consultaV = "SELECT * FROM vehiculo WHERE placa = '$placaEnviada'";
$vehiculoEnviado = mysqli_query($enlace, $consultaV);
$row = mysqli_fetch_assoc($vehiculoEnviado);

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
$consultaM_terminados = "SELECT * FROM vehiculo_mantenimiento WHERE IDVehiculo = '$IDVehiculo' AND exitoso = '1'";
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
$consultaM_en_proceso = "SELECT * FROM vehiculo_mantenimiento WHERE IDVehiculo = '$IDVehiculo' AND fechaFin IS NULL";
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


// Consulta para obtener las rutas
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

//Consulta recorridos en proceso
$consultaRP = "SELECT r.ubiInicio, r.ubiFin,re.fechaInicio, re.horaInicio  
FROM recorre AS re
JOIN ruta AS r
ON r.IDRuta = re.IDRuta 
JOIN vehiculo AS v
ON v.IDVehiculo = re.IDVehiculo 
WHERE re.fechaFin IS NULL AND v.placa = '$placa'";

$resultadoRP = mysqli_query($enlace, $consultaRP);
// Verificar si la consulta fue exitosa
if ($resultadoRP) {
    // Arreglo para almacenar las rutas
    $rutasProceso = array();

    // Iterar sobre los resultados y almacenar cada fila en el arreglo
    while ($row = mysqli_fetch_assoc($resultadoRP)) {
        $rutasProceso[] = $row;
    }

    // Liberar el resultado
    mysqli_free_result($resultadoRP);

    // Ahora $rutas contiene todas las rutas de la base de datos
} else {
    // Manejar el error de la consulta, si lo hay
    echo "Error en la consulta: " . mysqli_error($enlace);
}


//Consulta recorridos terminados
$consultaRT = "SELECT r.ubiInicio, r.ubiFin, re.fechaInicio, re.fechaFin, re.horaInicio, re.horaFin, re.kmInicio, re.kmFin
FROM recorre AS re
JOIN ruta AS r
ON r.IDRuta = re.IDRuta
JOIN vehiculo AS v
ON v.IDVehiculo = re.IDVehiculo
WHERE re.fechaFin IS NOT NULL AND v.placa = '$placa'";

$resultadosRT = mysqli_query($enlace, $consultaRT);

// Verificar si la consulta fue exitosa
if ($resultadosRT) {
    // Arreglo para almacenar las rutas
    $rutasTerminadas = array();

    // Iterar sobre los resultados y almacenar cada fila en el arreglo
    while ($row = mysqli_fetch_assoc($resultadosRT)) {
        $rutasTerminadas[] = $row;
    }

    // Liberar el resultado
    mysqli_free_result($resultadosRT);

    // Ahora $rutas contiene todas las rutas de la base de datos
} else {
    // Manejar el error de la consulta, si lo hay
    echo "Error en la consulta: " . mysqli_error($enlace);
}


/* =======================
OBTENER TODOS LOS CHOFERES
========================== */
$choferesDB = "SELECT * FROM chofer";
$resultadoChoferesDB = mysqli_query($enlace, $choferesDB);
// Verificar si la consulta fue exitosa
if (!$resultadoChoferesDB) {
    // Manejar el error de la consulta, si lo hay
    echo "Error en la consulta de todos los choferes: " . mysqli_error($enlace);
} else {
    // Arreglo para almacenar las ubicaciones de inicio
    $choferes = array();

    // Recorrer los resultados y almacenarlos en el arreglo
    while ($row = mysqli_fetch_assoc($resultadoChoferesDB)) {
        $choferes[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Vehicular</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/vehiculos.css">
    <link rel="icon" href="../img/LogoGestionVehicular.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/form.css">
    <!-- <script src="../js/validacionesChofer.js"></script> -->
</head>

<body>

    <dialog id="popupformViajes" class="form-container">
        <section class="formHeader">
            <h2>Iniciar Nuevo Recorrido</h2>
            <button id="cerrarFormV" class="cerrarForm">&times;</button>
        </section>
        <form action="procesar_nuevo_recorrido.php" method="post">
            <input type="hidden" name="IDVehiculo" value="<?php echo $IDVehiculo; ?>">
            <input type="hidden" name="placaVehiculo" value="<?php echo $placaEnviada; ?>">
            <section class="form-body">
                <section class="info-container">
                    <h2>RUTA </h2>
                    <section class="grupo2">
                        <label for="ubiInicioS" class="seleccionarUbi">Ubicación de Inicio:</label>
                        <br><br>
                        <select name="ubiInicioS" id="ubiInicioS" required onchange=filtrarUbi()>
                            <option value=""></option>
                            <?php foreach ($rutas as $ubicacion) { ?>
                                <option value="<?php echo $ubicacion['ubiInicio']; ?>">
                                    <?php echo $ubicacion['ubiInicio']; ?>
                                </option>
                            <?php } ?>

                            <script>
                                function filtrarUbi() {
                                    var selectI = document.getElementById("ubiInicioS");
                                    var selectF = document.getElementById("ubiFinS");
                                    var bloquearSelectI = document.getElementById("nuevaUbiI");

                                    var ubiISelecionada = selectI.value;
                                    console.log(ubiISelecionada);


                                    selectF.innerHTML = "<option value='' disabled>Seleccione una Ubicacion de Inicio</option>";

                                    if (ubiISelecionada != "") {
                                        <?php foreach ($rutas as $ubicacionF) { ?>
                                            if ("<?php echo $ubicacionF['ubiInicio']; ?>" == ubiISelecionada) {
                                                var option = document.createElement("option");
                                                option.value = "<?php echo $ubicacionF['ubiFin']; ?>";
                                                option.textContent = "<?php echo $ubicacionF['ubiFin']; ?>";
                                                selectF.appendChild(option);
                                            }
                                        <?php } ?>
                                    }
                                }
                            </script>

                        </select><br><br>
                        <label for="nuevaUbiI" style="font-size:x-small;">Agregar ubicación</label>
                        <input type="checkbox" id="nuevaUbiI" name="nuevaUbiI" onclick="bloquearSelectUbiI()"><br>

                        <br>
                        <section class="nuevaUbi" id="nuevaUbiI-container">
                            <section class="grupo">
                                <input type="text" id="nuevaUbiInicio" name="nuevaUbiInicio"><br>
                                <label for="nuevaUbiInicio">Ingrese nueva ubicación</label>
                            </section>
                        </section>
                    </section>

                    <br>

                    <section class="grupo2">
                        <label for="ubiFin" class="seleccionarUbi">Ubicación Final:</label>
                        <br><br>
                        <select name="ubiFinS" id="ubiFinS" required>
                            <option value='' disabled>Seleccione una Ubicacion de Inicio</option>

                        </select><br><br>
                        <label for="nuevaUbiF" style="font-size:x-small;">Agregar ubicación</label>
                        <input type="checkbox" id="nuevaUbiF" name="nuevaUbiF" onclick="bloquearSelectUbiF()"><br>

                        <br>
                        <section class="nuevaUbi" id="nuevaUbiF-container">
                            <section class="grupo">
                                <input type="text" id="nuevaUbiFin" name="nuevaUbiFin"><br>
                                <label for="nuevaUbiFin">Ingrese nueva ubicación</label>
                            </section>
                        </section>
                        <br><br>
                    </section>

                </section>
                <section class="info-container">
                    <h2>RECORRIDO</h2>
                    <section class="grupo2">
                        <h4>Fecha de Inicio:</h4>
                        <input type="text" id="fechaInicio" name="fechaInicio" readonly>

                        <h4>Hora de Inicio:</h4>
                        <input type="text" id="horaInicio" name="horaInicio" readonly>
                    </section>
                    <br>
                    <section class="grupo">
                        <input type="number" id="kmInicio" oninput="validarNumero(this)" name="kmInicio" min="<?php echo $kilometraje ?>" required><br>
                        <label for="peso">Kilometraje Inicio</label>
                    </section>
                    <br>
                </section>
            </section>
            <section class="formFooter">
                <input type="submit" value="Enviar">
            </section>
        </form>
    </dialog>


    <dialog id="popupTerminarViaje" class="form-container">
        <section class="formHeader">
            <h2>Terminar Recorrido</h2>
            <button id="cerrarFormTV" class="cerrarForm">&times;</button>
        </section>
        <form action="procesar_fin_recorrido.php" method="post">
            <input type="hidden" name="IDVehiculo" value="<?php echo $IDVehiculo; ?>">
            <input type="hidden" name="placaVehiculo" value="<?php echo $placaEnviada; ?>">
            <section class="form-body">
                <section class="info-container">
                    <h2>RUTA</h2>
                    <section class="grupo2">
                        <label for="ubiInicioProceso" class="seleccionarUbi">Ubicación de Inicio:</label>
                        <br><br>
                        <input type="text" id="ubiInicioProceso" name="ubiInicioProceso" readonly value="<?php echo $rutasProceso[0]['ubiInicio'] ?>">
                        <br>
                    </section>
                    <br>
                    <section class="grupo2">
                        <label for="ubiInicioProceso" class="seleccionarUbi">Ubicación Final:</label>
                        <br><br>
                        <input type="text" id="ubiFinProceso" name="ubiFinProceso" readonly value="<?php echo $rutasProceso[0]['ubiFin'] ?>">
                        <br>
                    </section>

                </section>
                <section class="info-container">
                    <h2>RECORRIDO</h2>
                    <section class="grupo2">
                        <h4>Fecha de Inicio:</h4>
                        <input type="text" id="fechaInicioP" name="fechaInicioP" readonly value="<?php echo $rutasProceso[0]['fechaInicio'] ?>">

                        <h4>Hora de Inicio:</h4>
                        <input type="text" id="horaInicioP" name="horaInicioP" readonly value="<?php echo $rutasProceso[0]['horaInicio'] ?>">

                        <h4>Kilometraje Inicio:</h4>
                        <input type="text" id="kilometrajeInicioP" name="kilometrajeInicioP" readonly value="<?php echo $kilometraje ?>">
                    </section>
                    <br>
                </section>
                <section class="iRECORRIDOnfo-container">
                    <br><br><br>
                    <section class="grupo">
                        <h4>Fecha de Fin:</h4>
                        <input type="text" id="fechaFinP" name="fechaFinP" readonly>

                        <h4>Hora de Fin:</h4>
                        <input type="text" id="horaFinP" name="horaFinP" readonly>
                    </section>
                    <br><br>
                    <section class="grupo">

                        <input type="number" id="kmFinP" oninput="validarNumero(this)" name="kmFin" min="<?php echo $kilometraje ?>" required><br>
                        <label for="peso">Kilometraje Fin</label>
                    </section>

                    <br>
                </section>
            </section>
            <section class="formFooter">
                <input type="submit" value="Finalizar">
            </section>
        </form>
    </dialog>

    <!-- ============================
    VENTANA MODAL MANTENIMIENTOS
    ================================= -->
    <dialog id="popupFormMantenimiento">
        <section class="formHeader">
            <h2>Iniciar Nuevo Mantenimiento</h2>
            <button id="cerrarFormMantenimiento" class="cerrarForm" onclick="cerrarPopupMantenimiento()">&times;</button>
        </section>
        <form id="formularioMantenimiento">
            <input type="hidden" name="IDVehiculo" id="IDVehiculoFormMantenimiento" value="<?php echo $IDVehiculo; ?>">
            <section class="contenedorFormularioMantenimiento">
                <section class="informacionMantenimiento">
                    <h2>MANTENIMIENTO</h2>

                    <section class="checkboxNuevoMantenimiento">

                        <label class="content-input">
                            <input type="checkbox" name="nuevoMantenimiento" id="nuevoMantenimiento">Agregar
                            Mantenimiento
                            <i></i>
                        </label>

                    </section>

                    <section id="contenedorTodosMantenimientos">
                        <section class="inputsFormMantenimiento">
                            <label for="nombreMantenimiento" class="seleccionarMantenimiento">Nombre del
                                Mantenimiento:</label>
                            <select name="nombreMantenimiento" id="nombreMantenimiento">
                                <option value="" selected disabled>Seleccione el nombre del mantenimiento</option>
                            </select>

                            <section class="error"></section>
                        </section>
                    </section>

                    <section class="nuevoMantenimiento" id="contenedorNuevoMantenimiento" hidden>

                        <section class="inputsFormMantenimiento">
                            <label for="nombreNuevoMantenimiento">
                                Ingrese el nombre del nuevo mantenimiento
                            </label>
                            <input type="text" id="nombreNuevoMantenimiento" name="nombreNuevoMantenimiento">
                            <section class="error"></section>
                        </section>

                        <section class="inputsFormMantenimiento">
                            <label for="tipoNuevoMantenimiento">
                                Ingrese el tipo de mantenimiento
                            </label>
                            <select id="tipoNuevoMantenimiento" name="tipoNuevoMantenimiento">
                                <option value="" selected disabled>Seleccione el tipo de mantenimiento</option>
                                <option value="preventivo">Preventivo</option>
                                <option value="correctivo">Correctivo</option>
                            </select>
                            <section class="error"></section>
                        </section>

                    </section>

                </section>
                <section class="informacionMantenimiento">
                    <h2>DATOS DEL MANTENIMIENTO</h2>
                    <section class="inputsFormMantenimiento">
                        <label for="costoMantenimiento">Costo</label>
                        <input type="number" id="costoMantenimiento" name="costoMantenimiento">
                        <section class="error"></section>
                    </section>

                    <section class="inputsFormMantenimiento">
                        <label for="fechaInicioMantenimiento">Fecha de Inicio</label>
                        <input type="text" id="fechaInicioMantenimiento" name="fechaInicioMantenimiento" readonly>
                    </section>
                </section>
            </section>
            <section class="formFooter">
                <button id="enviarFormularioMantenimiento">Enviar</button>
            </section>
        </form>
    </dialog>

    <!-- ============================
    VENTANA MODAL TERMINAR MANTENIMIENTOS
    ================================= -->
    <dialog id="popupFormEliminarMantenimiento">

        <section class="formHeader">

            <h2>Terminar Mantenimiento</h2>

            <button id="cerrarFormEliminarMantenimiento" class="cerrarForm" onclick="cerrarPopupEliminarMantenimiento()">&times;</button>

        </section>

        <form id="formularioTerminarMantenimiento">

            <input type="hidden" name="IDVehiculoMANTENIMIENTOForm" id="IDVehiculoMANTENIMIENTOForm">
            <input type="hidden" name="IDVehiculo" id="IDVehiculo" value="<?php $IDVehiculo ?>">

            <section class="contenedorFormularioMantenimiento">

                <section class="informacionMantenimiento">

                    <h2>DATOS DEL MANTENIMIENTO</h2>

                    <section class="inputsFormMantenimiento">
                        <label for="nombreEliminarMantenimiento">Nombre del Mantenimiento</label>
                        <input type="text" id="nombreEliminarMantenimiento" name="nombreEliminarMantenimiento" readonly>
                    </section>

                    <section class="inputsFormMantenimiento">
                        <label for="tipoEliminarMantenimiento">Tipo de Mantenimiento</label>
                        <input type="text" id="tipoEliminarMantenimiento" name="tipoEliminarMantenimiento" readonly>
                    </section>

                    <section class="inputsFormMantenimiento">
                        <label for="fechaInicioEliminarMantenimiento">Fecha Inicio</label>
                        <input type="text" id="fechaInicioEliminarMantenimiento" name="fechaInicioEliminarMantenimiento" readonly>
                    </section>

                </section>

                <section class="informacionMantenimiento">

                    <h2>DATOS PARA TERMINAR EL MANTENIMIENTO</h2>

                    <section class="inputsFormMantenimiento">
                        <label for="nuevoCosto">Costo</label>
                        <input type="number" id="nuevoCosto" name="nuevoCosto" readonly>
                        <section class="error"></section>
                    </section>

                    <section class="checkboxActualizarCosto">

                        <label class="content-input">
                            <input type="checkbox" name="actualizarCosto" id="actualizarCosto">Actualizar Costo
                            <i></i>
                        </label>

                    </section>

                    <section id="contenedorFechaFin">
                        <section class="inputsFormMantenimiento">
                            <label for="fechaFinMantenimiento">Fecha de finalización del mantenimiento:</label>
                            <input type="text" id="fechaFinMantenimiento" name="fechaFinMantenimiento" readonly>
                        </section>
                    </section>

                </section>

            </section>

            <section class="formFooter">

                <button id="enviarFormularioFinMantenimiento">Enviar</button>

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
                <li><a href="../index.php"><img class="logoSalir" src="../img/LogoCerrarSesion.png" alt="Logo Cerrar Sesión"></a></li>
            </ul>
        </nav>
    </header>

    <section class="menu">
        <a href="#informacion">
            <img src="../img/BusMercedes.jpg" alt="Información">
            <p>INFORMACION</p>
        </a>
        <a href="#mantenimiento">
            <img src="../img/mantenimiento.jpg" alt="Mantenimientos">
            <p>MANTENIMIENTOS</p>
        </a>
        <a href="#viajes">
            <img src="../img/recorridos.jpg" alt="Viajes">
            <p>VIAJES</p>
        </a>
    </section>

    <?php if (isset($vehiculoEnviado)) : ?>
        <section class="seleccionado">
            <h2>Vehículo seleccionado:
                <?php echo $placa; ?>
            </h2>
        </section>

        <section class="grid">
            <section id="informacion" class="informacion">

                <section class="contenedor-imagen">

                    <?php
                    echo "<img src='data:image/jpeg;base64,$foto' class='fotoVehiculo' alt='$placa'>";
                    $busquedaBitacora = ("SELECT * FROM bitacora_chofer WHERE IDVehiculo = '$IDVehiculo' AND fechaFinalizacion IS NULL");
                    $resultadoBusquedaBitacora = mysqli_query($enlace, $busquedaBitacora);
                    if ($resultadoBusquedaBitacora != null && mysqli_num_rows($resultadoBusquedaBitacora) > 0) :
                        $bitacoraEncontrada = mysqli_fetch_assoc($resultadoBusquedaBitacora);
                        $IDChofer = $bitacoraEncontrada['IDChofer'];
                        $busquedaChofer = ("SELECT * FROM chofer WHERE IDChofer = " . $IDChofer);
                        $resultadoBusquedaChofer = mysqli_query($enlace, $busquedaChofer);
                        $choferEncontrado = mysqli_fetch_assoc($resultadoBusquedaChofer);
                    ?>
                        <section id="contenedorChofer">
                            <p>Chofer Asignado:</p>
                            <a href="../chofer/chofer.php?busqueda=<?php echo $choferEncontrado['CI']; ?>">
                                <?php echo $choferEncontrado["nombreChofer"] . " " . $choferEncontrado["apellidoChofer"]; ?>
                            </a>
                            <br>
                            <br>
                            <button type="button" class="btnEliminarChofer" onclick="abrirPopupEliminar()">
                                Eliminar Asignación
                            </button>

                            <dialog id="popupEliminarAsignacion">
                                <button class="btnCerrar" onclick="cerrarPopup()">Cerrar</button>
                                <section id="infoPopupEliminar">
                                    <h1>Eliminar Asignación</h1>
                                    <h3>Ingrese una observación para eliminar la asignación:</h3>
                                    <input type="text" id="observacion" name="observacion">
                                    <button type="button" class="btnSiguiente" onClick="confirmarEliminacion()"></button>
                                </section>
                            </dialog>

                        </section>

                    <?php else : ?>
                        <section id="contenedorChofer">
                            <button class="btnAsignarChofer" onclick="abrirPopup()">Asignar Chofer</button>
                        </section>
                    <?php endif; ?>
                    <dialog id="popupAsignarChofer">
                        <button class="btnCerrar" onclick="cerrarPopup()">Cerrar</button>
                        <section id="infoPopup">
                            <h1>Asignar Chofer</h1>
                            <section class="buscarCedula">
                                <input type="hidden" id="IDVehiculoAsignar" value="<?php echo $IDVehiculo; ?>">
                                <select name="cedulaBuscada" class="cedulaBuscada">
                                    <option value="" selected disabled>ingresa la cedula del chofer</option>
                                    <?php foreach ($choferes as $choferBD) {
                                        $consultaBitacora = "SELECT * FROM bitacora_chofer
                                        WHERE IDChofer = '" . $choferBD['IDChofer'] . "'
                                        AND fechaFinalizacion IS NULL";
                                        $resultado = mysqli_query($enlace, $consultaBitacora);
                                        $bitacoraChofer = mysqli_fetch_assoc($resultado);

                                        if ($bitacoraChofer == NULL) { ?>
                                            <option value="<?php echo $choferBD['CI']; ?>">
                                                <?php echo $choferBD['CI'] . " - " . $choferBD['nombreChofer'] . " " . $choferBD['apellidoChofer']; ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $choferBD['IDChofer']; ?>" disabled>
                                                <?php echo $choferBD['CI'] . " - " . $choferBD['nombreChofer'] . " " . $choferBD['apellidoChofer']; ?>
                                            </option>
                                    <?php
                                        }
                                    } ?>
                                </select>
                                <button id="btnBuscarChofer" onclick="AsignarChofer()"></button>
                            </section>
                        </section>
                    </dialog>
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
                <article class="contenedorEstado">
                    <h3>Estado - <?php echo $estado; ?></h3>
                    <?php echo "<p class='estado estado$estado'></p>"; ?>

                </article>
            </section>

        </section>

        <!-- MANTENIMEINTOS -->

        <section id="mantenimiento" class="mantenimiento">
            <h1>MANTENIMIENTOS</h1>
            <section class="mant-container">
                <section>
                    <ul class="options">
                        <li id="enProceso" class="option option-active">En Proceso</li>
                        <li id="historial" class="option">Historial</li>
                        <nav>
                            <button id="abrirFormMantenimiento">Poner en Mantenimiento</button>
                        </nav>
                    </ul>
                    <section class="contents">
                        <section id="enProceso-content" class="content content-active">
                            <h3>En Proceso</h3>
                            <section class='table-container'>
                                <?php if (count($mantenimientos_en_proceso) == 0) { ?>
                                    <p>No existen mantenimientos en proceso</p>
                                <?php } else { ?>

                                    <table>
                                        <thead>
                                            <th>Vehículo</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Fecha Inicio</th>
                                            <th>Costo</th>
                                            <th>Terminar</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($mantenimientos_en_proceso as $mantenimiento) {
                                                $consultaMantenimiento = "SELECT * FROM mantenimiento WHERE IDMantenimiento = '" . $mantenimiento['IDMantenimiento'] . "' LIMIT 1";
                                                $resultadoMantenimiento = mysqli_query($enlace, $consultaMantenimiento);
                                                $infoMantenimiento = mysqli_fetch_assoc($resultadoMantenimiento);

                                            ?>
                                                <tr class="filaTablaMantenimiento">
                                                    <td>
                                                        <?php echo $placa; ?>
                                                    </td>
                                                    <td class="filaNombreMantenimiento">
                                                        <?php echo $infoMantenimiento['nombreMantenimiento']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $infoMantenimiento['tipoMantenimiento']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $mantenimiento['fechaInicio']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $mantenimiento['costo']; ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btnTerminarMantenimiento" onclick="abrirPopupEliminarMantenimiento(
                                                            '<?php echo $mantenimiento['IDVehiculoMANTENIMIENTO']; ?>',
                                                            '<?php echo $infoMantenimiento['nombreMantenimiento']; ?>',
                                                            '<?php echo $infoMantenimiento['tipoMantenimiento']; ?>',
                                                            '<?php echo $mantenimiento['fechaInicio']; ?>',
                                                            <?php echo $mantenimiento['costo']; ?>
                                                        )">
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </section>
                        </section>
                        <section id="historial-content" class="content">
                            <h3>Historial</h3>
                            <section class='table-container'>
                                <?php if (count($mantenimientos_terminados) == 0) { ?>
                                    <p>No existen mantenimientos terminados</p>
                                <?php } else { ?>
                                    <table>
                                        <thead>
                                            <th>Vehículo</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Fecha Inicio</th>
                                            <th>Costo</th>
                                            <th>Fecha Fin</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($mantenimientos_terminados as $mantenimiento) {
                                                $consultaMantenimiento = "SELECT * FROM mantenimiento WHERE IDMantenimiento = '" . $mantenimiento['IDMantenimiento'] . "' LIMIT 1";
                                                $resultadoMantenimiento = mysqli_query($enlace, $consultaMantenimiento);
                                                $infoMantenimiento = mysqli_fetch_assoc($resultadoMantenimiento);

                                            ?>
                                                <tr class="filaTablaMantenimiento">
                                                    <td>
                                                        <?php echo $placa; ?>
                                                    </td>
                                                    <td class="filaNombreMantenimiento">
                                                        <?php echo $infoMantenimiento['nombreMantenimiento']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $infoMantenimiento['tipoMantenimiento']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $mantenimiento['fechaInicio']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $mantenimiento['costo']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $mantenimiento['fechaFin']; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </section>
                        </section>
                    </section>

                </section>


            </section>
        </section>

        <!-- VIAJES -->

        <section id="viajes" class="viajes">
            <h1>Viajes Realizados</h1>

            <section class="mant-container">
                <section>
                    <ul class="options">
                        <li id="enProcesoViaje" class="optionV option-activeV">En Proceso</li>
                        <li id="historialViaje" class="optionV">Historial</li>
                        <nav>
                            <?php if ($nombreChofer == " ") : ?>
                                <button id="abrirAlertaChofer">Poner en Ruta</button>
                            <?php elseif ($estado == "Ruta") : ?>
                                <button id="abrirAlertaViaje">Poner en Ruta</button>
                            <?php elseif ($estado == "Mantenimiento") : ?>
                                <button id="abrirAlertaViajeMant">Poner en Ruta</button>
                            <?php else : ?>
                                <button id="abrirFormV">Poner en Ruta</button>
                            <?php endif; ?>
                        </nav>
                    </ul>
                    <section class="contentsV">
                        <section id="enProceso-contentV" class="contentV content-activeV">
                            <h3>En Proceso</h3>
                            <?php if ($estado == "Ruta") : ?>
                                <section class='table-containerV'>
                                    <table>
                                        <thead>
                                            <th>Vehiculo</th>
                                            <th>Chofer</th>
                                            <th>Hora de Salida</th>
                                            <th>Ubicacion de Salida</th>
                                            <th>Ubicacion de Llegada</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rutasProceso as $ruta) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $placaEnviada; ?>
                                                    </td>
                                                    <td><?php echo $nombreChofer; ?></td>
                                                    <td><?php echo $ruta['horaInicio']; ?></td>
                                                    <td>
                                                        <?php echo $ruta['ubiInicio']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $ruta['ubiFin']; ?>
                                                    </td>
                                                    <td>
                                                        <button id="btnTerminarViaje" type="button" class="btnTerminarAccion">
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </section>
                            <?php else : ?>
                                <p>No hay recorridos en proceso</p>
                            <?php endif; ?>

                        </section>
                        <section id="historial-contentV" class="contentV">
                            <h3>Historial</h3>
                            <section class='table-containerV'>
                                <table>
                                    <thead>

                                        <th>Ubicacion de Salida</th>
                                        <th>Ubicacion de Llegada</th>
                                        <th>Fecha y Hora de Salida</th>
                                        <th>Fecha y Hora de Llegada</th>
                                        <th>KM Recorridos</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rutasTerminadas as $rutaT) {
                                            $kmRecorridos = $rutaT['kmFin'] - $rutaT['kmInicio'] ?>
                                            <tr>

                                                <td>
                                                    <?php echo $rutaT['ubiInicio']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rutaT['ubiFin']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rutaT['fechaInicio'] . "<br>" . $rutaT['horaInicio']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rutaT['fechaFin'] . "<br>" . $rutaT['horaFin']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $kmRecorridos; ?>
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
        </section>

    <?php endif; ?>


    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="../img/LogoFacebook.png" alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="../img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="../img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>


    <script src="../js/terminarViaje.js"></script>
    <script src="../js/mantenimiento.js"></script>
    <script src="../js/viajes.js"></script>
    <script src="../js/header.js"></script>
    <script defer src="../js/asignarChofer.js"></script>
    <script src="../js/formViajesMantenimiento.js"></script>
    <script src="../js/alertaViajeMant.js"></script>
    <script src="../js/alertaViajeSinChofer.js"></script>
    <script defer src="../js/asignarMantenimiento.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>