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


//Consulta ubi Rutas
$ubi = "SELECT * from ruta";
$resultadoUbi = mysqli_query($enlace, $ubi);

// Verificar si la consulta fue exitosa
if (!$resultadoUbi) {
    // Manejar el error de la consulta, si lo hay
    echo "Error en la consulta de ubicacion de inicio: " . mysqli_error($enlace);
} else {
    // Arreglo para almacenar las ubicaciones de inicio
    $ubicaciones= array();

    // Recorrer los resultados y almacenarlos en el arreglo
    while ($row = mysqli_fetch_assoc($resultadoUbi)) {
        $ubicaciones[] = $row;
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
</head>

<body>

<dialog  id="popupformViajes" class="form-container">
        <section class="formHeader">
            <h2>Iniciar Nuevo Recorrido</h2>
            <button id="cerrarFormV" class="cerrarForm">&times;</button>
        </section >
        <form action="procesar_nuevo_recorrido.php" method="post">
            <input type="hidden" name="IDVehiculo" value="<?php echo $IDVehiculo; ?>">
            <input type="hidden" name="placaVehiculo" value="<?php echo $placaEnviada; ?>">
            <section class="form-body">
                <section class="info-container">
                    <h2>RUTA</h2>
                    <section class="grupo2">
                        <label for="ubiInicioS" class="seleccionarUbi">Ubicación de Inicio:</label>
                        <br><br>
                        <select name="ubiInicioS" id="ubiInicioS" required onchange=filtrarUbi()>
                            <option value=""></option>
                            <?php foreach ($ubicaciones as $ubicacion) { ?>
                                <option value="<?php echo $ubicacion['ubiInicio']; ?>">
                                    <?php echo $ubicacion['ubiInicio']; ?>
                                </option>
                            <?php } ?>

                            <script>
                                function filtrarUbi(){
                                    var selectI = document.getElementById("ubiInicioS");
                                    var selectF = document.getElementById("ubiFinS");
                                    var bloquearSelectI = document.getElementById("nuevaUbiI");

                                    var ubiISelecionada = selectI.value;
                                    console.log(ubiISelecionada);
                    

                                    selectF.innerHTML = "<option value='' disabled>Seleccione una Ubicacion de Inicio</option>";

                                    if(ubiISelecionada != "" ){
                                        <?php foreach($ubicaciones as $ubicacionF){ ?>
                                            if("<?php echo $ubicacionF['ubiInicio']; ?>" == ubiISelecionada){
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
                                <input  type="text" id="nuevaUbiInicio" name="nuevaUbiInicio" ><br>
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
                                <input  type="text" id="nuevaUbiFin" name="nuevaUbiFin" ><br>
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
<<<<<<< HEAD
                        <input type="number" id="kmInicio" oninput="validarNumero(this)" name="kmInicio" 
                        min="<?php echo $kilometraje ?>" required><br>
=======
                        <input type="number" id="kmInicio" oninput="validarNumero(this)" name="kmInicio" min="<?php echo $kilometraje ?>" required><br>
>>>>>>> 0c843adde211df1a96480057cb920403351eadad
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

    <?php if (isset($vehiculoEnviado)): ?>
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
                    if ($resultadoBusquedaBitacora != null && mysqli_num_rows($resultadoBusquedaBitacora) > 0):
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
                            <button type="button" class="btnEliminarChofer" onclick="abrirPopupEliminar()">Asignar Nuevo
                                Chofer</button>

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

                    <?php else: ?>
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
                                <input type="number" class="cedulaBuscada" placeholder="Ingresa Cedula" name="busqueda"
                                    required>
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

            </section>



            <section id="mantenimiento" class="mantenimiento">
                <h1>MANTENIMIENTOS</h1>
                <section class="mant-container">
                    <section>
                        <ul class="options">
                            <li id="enProceso" class="option option-active">En Proceso</li>
                            <li id="historial" class="option">Historial</li>
                            <nav>
                                <button id="abrirFromM">Poner en Mantenimiento</button>
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
                        <ul class="options">
                            <li id="enProcesoViaje" class="optionV option-activeV">En Proceso</li>
                            <li id="historialViaje" class="optionV">Historial</li>
                            <nav>
                                <button id="abrirFormV">Poner en Ruta</button>
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
        </section>

    <?php endif; ?>


    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="../img/LogoFacebook.png"
                alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="../img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="../img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>

    <script src="../js/mantenimiento.js"></script>
    <script src="../js/viajes.js"></script>
    <script src="../js/header.js"></script>
    <script src="../js/asignarChofer.js"></script>
    <script src="../js/formViajesMantenimiento.js"></script>
</body>

</html>