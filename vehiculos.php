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
        }

        header {
            display: flex;
            align-items: center;
            background-color: #1B3665;
            color: white;
            font-family: Arial, Helvetica, sans-serif;

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
            font-family: Arial, Helvetica, sans-serif;
        }

        nav li:hover {
            padding: 15px;
            background-color: #2980b9;
        }

        .menu {
            float: left;
            width: 15%;
            height: 5000px;
            background-color: #da6517ce;
        }

        .menu ul {
            padding: 0;
            list-style-type: none;
        }

        .menu ul li {
            margin-bottom: 79px;
            text-align: center;

        }

        .menu a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 15px;

        }

        .menu h1 {
            color: #074b79;
            font-weight: bold;
            font-size: 15px;

        }


        .contenido h1,strong{
            color: #bd6009;
            font-size: large;
            font-family: Arial, Helvetica, sans-serif;
            font-style: bold;
        }

        

        .contenido {
            float: left;
            width: 85%;
            height: 1000px;
            
        }

        .contenido select{
            padding: 10px;
            margin-top: 5%;
            margin-left: 10%;
            border-radius: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }

        .informacion {
            width: 80%;
            height: 350px;
            background-color: white;
            margin: 5%;
            margin-left: 10%;
            display: flex;
            align-items: center;
            border: 1px solid;
            border-radius: 10px;

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
            font-family: Arial, Helvetica, sans-serif;
            font-size: medium;
        }

        .tablaViajes{
            width: 90%;
            height: auto;
            margin: 5%;
        }

        .tablaViajes h1{
            font-family: Arial, Helvetica, sans-serif;
            font-size:x-large;
            margin: 0 10%;
        }
        
        .tablaViajes table{
            margin: 2% 10%;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
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


        footer {
            background-color: #000000;
            color: rgb(255, 255, 255);
            padding: 10px;
            margin-top: 5px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            align-items: center;
            float: left;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <img width="10%" src="images/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1 align="center">Gestión Vehicular</h1>


    </header>

    <nav>
        <ul>
            <li><a href="index.html">INICIO</a></li>
            <li><a href="vehiculos.html">VEHICULOS</a></li>
            <li><a href="chofer.html">CHOFERES</a></li>
        </ul>
    </nav>

    
        <section class="menu">
            <ul>
                <h1 align="center">MENU</h1>
                <li><a href="#info">Vehículo 1</a></li>
                <li><a href="#">Vehículo 2</a></li>
                <li><a href="#">Vehículo 3</a></li>
                <hr>
                <li><a href="formularios/form_ingreso_vehiculo.php">AGREGAR </a></li>
            </ul>
        </section>


        <section class="contenido">
            <form action="vehiculos.php" method="post">    
                <select name="vehiculos" id="vehiculos">
                    <option selected="true" disabled="disabled" value="0" >Seleccione la Placa del Vehiculo</option>
                    <option value="PMA-7997">PMA-7997</option>
                    <option value="PME-4004">PME-4004</option>
                    <option value="PMA-3124">PMA-3124</option>
                </select>
                <input type="submit" value="Buscar" style="margin: 10px; font-size:20px; font-family: Arial, Helvetica, sans-serif; border-radius:8px;">
            </form>

            <?php if (isset($vehiculoEncontrado)) : ?>
                <section class="informacion">
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

                <section class="tablaViajes">
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
                                    <td><?php echo $viaje["vehiculo"]; ?></td>
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
                            <article>
                                <p>Seleccione la placa de un vehiculo para mostrar la informacion.</p>
                            </article>
                </section>
            
            <?php endif; ?>

        </section>
    

    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="#"><img width="5%" src="images/LogoFacebook.png" alt="LogoInsta"></a>
        <a href="#"><img width="5%" src="images/LogoInsta.png" alt="LogoInsta"></a>
        <a href="#"><img width="5%" src="images/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>
</body>

</html>