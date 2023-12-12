<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Vehicular</title>
    <style>

        body{
            background-color: rgb(218, 217, 217);
            margin: 0px;
            padding: 0px;
        }

        header {
            display: flex;
            align-items: center;
            background-color: #1B3665;
            color: white;
            
        }

        nav {
            background-color: #1B3665;
            padding: 1px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        nav ul {
            list-style-type: none;
            margin: 10px;
            padding: 5px;
            display: flex;
            justify-content:flex-end;
        }

        nav li {
            border-right: 2px solid #fff;
            padding: 15px;
            transition: background-color 0.3s;
        }

        nav li:last-child {
            border-right: none;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 15px;

        }

        nav li:hover {
            padding: 15px;
            background-color: #2980b9;
        }
        
        section {
            display: flex;
            justify-content: center;
            width: 100%;
            
        }

        .imgLogo {
            width: 10%;
        }

        footer{
            background-color: #1B3665;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <header>
        <img class="imgLogo" src="../images/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1 align="center">Agregar Vehiculo</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="#">INICIO</a></li>
            <li><a href="#">VEHICULOS</a></li>
            <li><a href="#">CHOFERES</a></li>
        </ul>
    </nav>
    <section>
            <form action="procesar_formulario.php" method="post">
            <h2>Información del vehículo</h2>
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" required><br>
                <br>
                
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required><br>
                <br>
                
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" required><br>
                <br>

                <label for="anio">Año:</label>
                <input type="number" id="anio" name="anio" min="1900" max="2023" required><br>
                <br>

                <label for="tipo_vehiculo">Tipo de Vehículo:</label>
                <input type="text" id="tipo_vehiculo" name="tipo_vehiculo" required><br>
                <br>

                <label for="capacidad">Capacidad:</label>
                <input type="text" id="capacidad" name="capacidad" required><br>
                <br>

                <h3>Datos Técnicos</h3>

                <label for="kilometraje">Kilometraje:</label>
                <input type="number" id="kilometraje" name="kilometraje" min="0" required><br>
                <br>

                <label for="tipo_combustible">Tipo de Combustible:</label>
                <input type="text" id="tipo_combustible" name="tipo_combustible" required><br>
                <br>

                <label for="motor">Motor:</label>
                <input type="text" id="motor" name="motor" required><br>
                <br>

                <label for="peso">Peso:</label>
                <input type="number" id="peso" name="peso" min="0" required><br>
                <br>

                <input type="submit" value="Enviar">
            </form>
            </section>
    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
    </footer>
</body>

</html>