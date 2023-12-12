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
        form{
            margin: 24px;
        }
    </style>
</head>

<body>
    <header>
        <img class="imgLogo" src="images/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1 align="center">Gestión Vehicular</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="#">INICIO</a></li>
            <li><a href="#">VEHICULOS</a></li>
            <li><a href="#">CHOFERES</a></li>
        </ul>
    </nav>

        <section class="ingreso">

    <form action="procesar_formulario.php" method="post">
        <h1>Información del Chofer</h1>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>
    <br>
    
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" required><br>
    <br>
    
    <label for="edad">Edad:</label>
    <input type="text" id="edad" name="edad" required><br>
    <br>

    <label for="numCedula">Número de Cédula:</label>
    <input type="number" id="numCedula" name="numCedula" required><br>
    <br>

    <label for="sexo">Sexo:</label>
    <input type="text" id="sexo" name="sexo" required><br>
    <br>
    
        <h1>Información Técnica</h1>

    <label for="licencia">Tipo de licencia:</label>
    <input type="text" id="licencia" name="licencia" required><br>
    <br>

    <label for="sangre">Tipo de sangre:</label>
    <input type="text" id="sangre" name="sangre" min="0" required><br>
    <br>

    <label for="fentrada">Fecha de entrada:</label>
    <input type="text" id="fecha_entrada" name="fecha_entrada" required><br>
    <br>

    <input type="submit" value="Enviar">
    </section>
</form>
    
    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
    </footer>
</body>

</html>