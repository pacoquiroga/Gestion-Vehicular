<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el valor seleccionado del formulario
    $opcionSeleccionada = $_POST['vehiculos'];

    // Cargar el contenido del archivo JSON
    $contenidoJson = file_get_contents("informacionVehiculos/vehiculos.json");

    if ($contenidoJson != false || $opcionSeleccionada == "0" ) {
        // Decodificar el JSON
        $vehiculos = json_decode($contenidoJson, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            // Buscar el vehículo seleccionado
            $vehiculoEncontrado = null;

            foreach ($vehiculos as $vehiculo) {
                if ($opcionSeleccionada == $vehiculo['placa']) {
                    $vehiculoEncontrado = $vehiculo;
                    break;
                }else{
                    $vehiculoEncontrado = null;
                }
            }

        } else {
            echo "Error al decodificar el JSON: " . json_last_error_msg();
        }
    } else {
        echo "Error al leer el archivo JSON.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Vehicular</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/vehiculos.css">
</head>

<body>
    <header>
        <img id="logoEmpresa" src="img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1>Gestión Vehicular</h1>
        <a href="index.php" style="margin-left: 1200px;"><img class="logoSalir" src="img/LogoCerrarSesion.png"
                alt="Logo Cerrar Sesión"></a>
    </header>

    <nav>
        <ul>
            <li><a href="inicio.html">INICIO</a></li>
            <li><a href="vehiculos.php">VEHICULOS</a></li>
            <li><a href="#">CHOFERES</a></li>
        </ul>
    </nav>

    <section class="cuerpo">
        <section class="menu">
            <h1>MENU PRINCIPAL</h1>
            <hr>
            <br>
            <ul>
                <li ><a href="#informacion">INFORMACION</a></li>
                <li><a href="#mantenimiento">MANTENIMIENTOS</a></li>
                <li><a href="#viajes">VIAJES</a></li>
                <br><br><br>
            </ul>
            <br><br><br><br>
        </section>
        <section class="contenido">
            <section class="agregarSeleccionar">
                <form class="seleccionar" action="vehiculos.php" method="post">    
                    <select name="vehiculos" id="vehiculos">
                        <option selected="true" disabled="disabled" value="0" >Seleccione la Placa del Vehículo</option>
                        <option value="PMA-7997">PMA-7997</option>
                        <option value="PME-4004">PME-4004</option>
                        <option value="PMA-3124">PMA-3124</option>
                    </select>
                    <input type="submit" value="Buscar" >
                </form>
                <section class="agregar">
                    <a href="formularios/form_ingreso_vehiculo.php">INGRESAR VEHICULO</a>
                </section>
            </section>

            <?php if (isset($vehiculoEncontrado)) : ?>
                <section class="vehiculoSeleccionado"> 
                    <h2>Vehículo seleccionado: <?php echo $vehiculoEncontrado["placa"]; ?></h2>
                    <hr width="40%">
                    <br>
                </section>

                <section id="informacion" class="informacion">
                    <article class="info_box">
                        <h1>Información General</h1>
                        <p><strong>Placa: </strong><?php echo $vehiculo["placa"]; ?> </p>
                        <p><strong>Marca: </strong><?php echo $vehiculo["marca"]; ?></p>
                        <p><strong>Modelo: </strong><?php echo $vehiculo["modelo"]; ?></p>
                        <p><strong>Año: </strong><?php echo $vehiculo["ano"]; ?></p>
                        <p><strong>Tipo de Vehículo: </strong><?php echo $vehiculo["tipo_vehiculo"]; ?></p>
                        <p><strong>Capacidad: </strong><?php echo $vehiculo["capacidad"]; ?></p>
                    </article>
                    <article class="info_box">
                        <h1>Información Técnica</h1>
                        <p><strong>Tipo de combustible: </strong><?php echo $vehiculo["informacion_tecnica"]["tipo_combustible"]; ?></p>
                        <p><strong>Motor: </strong><?php echo $vehiculo["informacion_tecnica"]["motor"]; ?></p>
                        <p><strong>Kilometraje: </strong><?php echo $vehiculo["informacion_tecnica"]["kilometraje"]; ?></p>
                        <p><strong>Peso: </strong><?php echo $vehiculo["informacion_tecnica"]["peso"]; ?></p>
                    </article>
                    <article class="image_box">
                        <img src="<?php echo $vehiculo["imagen"]; ?>" alt="<?php echo $vehiculo["modelo"]; ?>">
                    </article>
                </section>

                <section id="mantenimiento" class="mantenimiento">
                    <h1>Mantenimiento</h1>
                    <table border="1">
                        <thead>
                            <th>Vehículo</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                        </thead>
                        <tbody>
                            <?php foreach ($vehiculo["mantenimientos_proximos"] as $mantenimiento) : ?>
                                <tr>
                                    <td><?php echo $vehiculo["placa"]; ?></td>
                                    <td><?php echo $mantenimiento["fecha"]; ?></td>
                                    <td><?php echo $mantenimiento["descripcion"]; ?></td>
                                    <td><?php echo $mantenimiento["costo"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>

                <section id="viajes" class="tablaViajes">
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
                            <?php foreach ($vehiculo["viajes_realizados"] as $viaje) : ?>
                                <tr>
                                    <td><?php echo $vehiculo["placa"]; ?></td>
                                    <td><?php echo $viaje["conductor"]; ?></td>
                                    <td><?php echo $viaje["hora_salida"]; ?></td>
                                    <td><?php echo $viaje["hora_llegada"]; ?></td>
                                    <td><?php echo $viaje["recorrido_km"]; ?></td>
                                    <td><?php echo $viaje["tiempo_h"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            <?php else: ?>
                <section class="informacion">
                    <p>Seleccione la placa de un vehículo para mostrar la información.</p>
                </section>
            
            <?php endif; ?>

        </section>
    </section>

    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a  href="https://www.facebook.com/zuck?locale=es_LA"><img id="logoRedes" src="img/LogoFacebook.png" alt="LogoInsta"></a>
        <a  href="https://www.instagram.com/zuck/"><img id="logoRedes" src="img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img id="logoRedes" src="img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>
</body>

</html>