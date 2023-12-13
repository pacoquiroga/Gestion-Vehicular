<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el valor seleccionado del formulario
    $opcionSeleccionada = $_POST['vehiculos'];

    // Cargar el contenido del archivo JSON
    $contenidoJson = file_get_contents("informacionVehiculos/vehiculos.json");

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
    <style>
        body {
            background-color: rgb(218, 217, 217);
            margin: 0px;
            padding: 0px;
            font-family: Arial, Helvetica, sans-serif;
        }

        header {
            display: flex;
            align-items: center;
            background-color: #1B3665;
            color: white;

        }

        nav {
            background-color: #000000;
            padding: 1px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        nav ul {
            list-style-type: none;
            margin: 10px;
            padding: 5px;
            display: flex;
            justify-content: flex-end;
        }

        nav li {
            border-right: 2px solid #ffffff;
            padding: 15px;
            transition: background-color 0.3s;
        }

        nav li:last-child {
            border-right: none;
        }

        nav a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            font-size: 15px;
        }

        nav li:hover {
            padding: 15px;
            background-color: grey;
        }

        .cuerpo{
            display: flex;
        }

        .menu {
            flex: 0.2;
            margin: 0;
            height: auto;
            background-color: #da6517ce;
        }

        .menu h1 {
            color: white;
            font-weight: bold;
            margin: 30% 15%;
            font-size: x-large;
            text-align: center;
        }

        .menu ul {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            list-style-type: none;
        }

        .menu li {
            margin-bottom: 1px 0px;
            text-align: center;
            box-sizing: border-box;
            padding: 20px;
        }

        .menu li :hover,
        .menu li :target { 
            background-color: #ffa060ce;
            width: 100%;
            margin-bottom: 1px;
            padding: 20px 30px;
            box-sizing: border-box;
        }

        li.selected {
            background-color: #4caf50;
            color: #fff;
        }


        .menu li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 20px;
            box-sizing: border-box;
        }

        
        .contenido h1,strong{
            color: #bd6009;
            font-size: large;
            font-style: bold;
        }

        

        .contenido {
            flex: 1;
            width: 85%;
           
            
        }

        .contenido select{
            padding: 10px;
            margin-top: 5%;
            margin-left: 10%;
            border-radius: 10px;
            font-weight: bold;
        }

        .informacion {
            width: 80%;
            height: 350px;
            background-color: white;
            margin-bottom: 5%;
            margin-top: 2%;
            margin-left: 10%;
            align-items: center;
            border: 1px solid;
            border-radius: 10px;
            text-align: center;
            justify-content: center;
            display: none;
        }

        .informacion:target{
            display: flex;
        }


        .tablaViajes:target {
            display: block;
        }

        .mantenimiento:target {
            display: block;
        }

        .seleccionar{
            margin-bottom: 5%; 
        }

        .info_box {
            width: 25%;
            height: 325px;
            margin: 2%;
            padding: 20px;
            padding-left: 100px;
            box-sizing: border-box;
            text-align:left;
            margin-bottom: 5%;
        }

        .image_box {
            width: 25%;
            height: 325px;
            margin: 2%;
            padding: 20px;
            padding-top: 70px;
            box-sizing: border-box;
            border-radius: 20%;
            

        }

        .image_box img{
            width: 100%;
            border-radius: 10%;
        }


        .info_box p{
            color: #1B3665;
            font-size: medium;
        }

        .tablaViajes{
            width: 90%;
            height: auto;
            margin: 5%;
            display: none;
        }


        .tablaViajes h1{
            font-size:x-large;
            margin: 0 10%;
        }
        
        .tablaViajes table{
            margin: 2% 10%;
            padding: 0;
            box-sizing: border-box;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .tablaViajes thead{
            background-color:#1B3665;
            color: white;
        }

        .tablaViajes th{
            padding: 20px 30px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .tablaViajes td{
            padding: 30px;
            border-bottom: solid 1px ;

        }

        .tablaViajes tbody tr:hover{
            background-color:#b6bfcf;
        }

        .tablaViajes tbody tr{
            cursor: pointer;
        }

        .vehiculoSeleccionado{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 90%;
            height: auto;
            color: #bd6009;
        }

        .mantenimiento{
            display: none;
            width: 90%;
            height: auto;
            margin: 5%;
        }

        .mantenimiento h1{
            font-size:x-large;
            margin: 1% 10%;
        }

        .mantenimiento table{
            margin: 2% 10%;
            padding: 0;
            border: none;
            box-sizing: border-box;
            table-layout: fixed;
            width: 80%;
        }

        .mantenimiento thead{
            background-color: #1B3665;
            color: white;
        }

        .mantenimiento th{
            padding: 20px 30px;
            border: none;
            font-weight: 700;
            text-transform: uppercase;
        }

        .mantenimiento td{
            padding: 30px;
            border: none;
            border-bottom: solid 1px ;
            text-align: center;
        }

        .mantenimiento tbody tr:hover{
            background-color:#b6bfcf;
        }

        .mantenimiento tbody tr{
            cursor: pointer;
        }

        footer {
            bottom: 0; 
            width: 100%;
            background-color: #000000;
            color: rgb(255, 255, 255);
            padding: 10px;
            text-align: center;
            box-sizing: border-box;
        }

    </style>
</head>

<body>
    <header>
        <img width="10%" src="images/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1 align="center" style="margin-right: 20px;">Gestión Vehicular</h1>
        <a href="index.php" style="margin-left: 1200px;"><img width="20%" src="images/LogoCerrarSesion.png" alt="Logo Cerrar Sesión" ></a>
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
        <hr color="white" width="75%" height="100px">
        <br><br>
        <ul>
            <li ><a href="#informacion">INFORMACION</a></li>
            <li><a href="#mantenimiento">MANTENIMIENTOS</a></li>
            <li><a href="#viajes">VIAJES</a></li>
        </ul>
        <br><br><br><br>
    </section>
        <section class="contenido">
            <form class="seleccionar" action="vehiculos.php" method="post">    
                <select name="vehiculos" id="vehiculos">
                    <option selected="true" disabled="disabled" value="0" >Seleccione la Placa del Vehículo</option>
                    <option value="PMA-7997">PMA-7997</option>
                    <option value="PME-4004">PME-4004</option>
                    <option value="PMA-3124">PMA-3124</option>
                </select>
                <input type="submit" value="Buscar" style="margin: 10px; font-size:20px; font-family: Arial, Helvetica, sans-serif; border-radius:8px;">
            </form>

            <?php if (isset($vehiculoEncontrado)) : ?>
                <section style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: auto; color: #1B3665; text-align: center; margin: 0 auto;"> 
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
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="images/LogoFacebook.png" alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="images/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="images/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>
</body>

</html>