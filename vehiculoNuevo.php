<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $placa = $_POST["placa"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $ano = $_POST["anio"];
    $tipo_vehiculo = $_POST["tipo_vehiculo"];
    $capacidad = $_POST["capacidad"];
    $kilometraje = $_POST["kilometraje"];
    $tipo_combustible = $_POST["tipo_combustible"];
    $motor = $_POST["motor"];
    $peso = $_POST["peso"];

    // Crear un arreglo con la información del vehículo
    $vehiculo = array(
        "placa" => $placa,
        "marca" => $marca,
        "modelo" => $modelo,
        "ano" => $ano,
        "tipo_vehiculo" => $tipo_vehiculo,
        "capacidad" => $capacidad,
        "informacion_tecnica" => array(
            "tipo_combustible" => $tipo_combustible,
            "motor" => $motor,
            "kilometraje" => $kilometraje,
            "peso" => $peso
        ),
        "imagen" => "ruta_de_la_imagen.jpg" // Reemplaza esto con la ruta real de la imagen
    );
} else {
    // Si no se ha enviado el formulario, puedes inicializar el arreglo vacío o mostrar un mensaje de error
    $vehiculo = array();
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
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            
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
            display: flex;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
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
        <img width="10%" src="img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1 align="center" style="margin-right: 20px;">Gestión Vehicular</h1>
        <a href="index.php" style="margin-left: 1200px;"><img width="20%" src="img/LogoCerrarSesion.png" alt="Logo Cerrar Sesión" ></a>
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
            <br><br><br>
            <li><a href="formularios/form_ingreso_vehiculo.php">INGRESAR VEHICULO</a></li>
        </ul>
        <br><br><br><br>
    </section>
        <section class="contenido">
            <section id="informacion" class="informacion">
                <article class="info_box">
                    <h1>Información General</h1>
                    <p><strong>Placa: </strong><?php echo isset($vehiculo["placa"]) ? $vehiculo["placa"] : ""; ?> </p>
                    <p><strong>Marca: </strong><?php echo isset($vehiculo["marca"]) ? $vehiculo["marca"] : ""; ?></p>
                    <p><strong>Modelo: </strong><?php echo isset($vehiculo["modelo"]) ? $vehiculo["modelo"] : ""; ?></p>
                    <p><strong>Año: </strong><?php echo isset($vehiculo["ano"]) ? $vehiculo["ano"] : ""; ?></p>
                    <p><strong>Tipo de Vehículo: </strong><?php echo isset($vehiculo["tipo_vehiculo"]) ? $vehiculo["tipo_vehiculo"] : ""; ?></p>
                    <p><strong>Capacidad: </strong><?php echo isset($vehiculo["capacidad"]) ? $vehiculo["capacidad"] : ""; ?></p>
                </article>
                <article class="info_box">
                    <h1>Información Técnica</h1>
                    <p><strong>Tipo de combustible: </strong><?php echo isset($vehiculo["informacion_tecnica"]["tipo_combustible"]) ? $vehiculo["informacion_tecnica"]["tipo_combustible"] : ""; ?></p>
                    <p><strong>Motor: </strong><?php echo isset($vehiculo["informacion_tecnica"]["motor"]) ? $vehiculo["informacion_tecnica"]["motor"] : ""; ?></p>
                    <p><strong>Kilometraje: </strong><?php echo isset($vehiculo["informacion_tecnica"]["kilometraje"]) ? $vehiculo["informacion_tecnica"]["kilometraje"] : ""; ?></p>
                    <p><strong>Peso: </strong><?php echo isset($vehiculo["informacion_tecnica"]["peso"]) ? $vehiculo["informacion_tecnica"]["peso"] : ""; ?></p>
                </article>
                <article class="image_box">
                    
                </article>
            </section>
        </section>
    </section>

    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="img/LogoFacebook.png" alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>
</body>

</html>