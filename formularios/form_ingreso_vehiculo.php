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
            justify-content: flex-end;
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
            box-sizing: border-box;
            
            display: flex;
            justify-content: center;
            width: 100%;

        }

        .imgLogo {
            width: 10%;
        }

<<<<<<< HEAD
        footer {
=======
        form {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer{
>>>>>>> 062f7a71327757b8d7b6b2a9397391ee0122b3b2
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
        <img class="imgLogo" src="../img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1 align="center">Agregar Vehiculo</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../inicio.php">INICIO</a></li>
            <li><a href="../vehiculos.php">VEHICULOS</a></li>
            <li><a href="../chofer.php">CHOFERES</a></li>
        </ul>
    </nav>
    <script>
        function validarLetras(input) {
        input.value = input.value.replace(/[^a-zA-Z]/g, '');
        }
    </script>
    <script>
        function validarNumero(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
        }
    </script>
    <section>
<<<<<<< HEAD
        <form action="../vehiculoNuevo.php" method="post">
            <h2>Información del vehículo</h2>
            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" oninput="validarPlaca(this)" required><br>



            <br>
=======
        <img src="../img/vehiculo_logo.png" alt="camioneta">
            <form action="../vehiculoNuevo.php" method="post">
            <h2>Información del vehículo</h2>
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" pattern="[A-Z]{3}\d{3}" title="Ingresa una placa válida (3 letras y 3 números, todo en mayúsculas)" required><br>
                <br>
                
                <label for="marca">Marca:</label>
                <input type="text" id="marca" oninput="validarLetra(this)" name="marca" pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+" title="Ingresa únicamente texto (sin números ni caracteres especiales)" required><br>
                <br>
                
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+" title="Ingresa únicamente texto (sin números ni caracteres especiales)" required><br>
                <br>

                <label for="anio">Año:</label>
                <input type="number" id="anio" oninput="validarNumero(this)" name="anio" min="1900" max="2023" pattern="\d+" title="Ingresa un número positivo" required><br>
                
                <br>

                <label for="tipo_vehiculo">Tipo de Vehículo:</label>
                <input type="text" id="tipo_vehiculo" oninput="validarLetra(this)" name="tipo_vehiculo" pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+" title="Ingresa únicamente texto (sin números ni caracteres especiales)" required><br>
                <br>

                <label for="capacidad">Capacidad:</label>
                <input type="text" id="capacidad" oninput="validarNumero(this)" name="capacidad" pattern="[1-9]|[1-4][0-9]|50" title="Ingresa un número del 1 al 50" required><br>
                <br>
>>>>>>> 062f7a71327757b8d7b6b2a9397391ee0122b3b2

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required><br>
            
            <br>

<<<<<<< HEAD
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required><br>
            <br>

            <label for="anio">Año:</label>
            <input type="number" id="anio" oninput="validarNumero(this)" name="anio" min="1900" max="2023" pattern="\d+"
                title="Ingresa un número positivo" required><br>
            <script>
                function validarNumero(input) {
                    input.value = input.value.replace(/[^0-9]/g, '');
                }
            </script>
            <br>
=======
                <label for="kilometraje">Kilometraje:</label>
                <input type="number" id="kilometraje" oninput="validarNumero(this)" name="kilometraje" min="0" required><br>
                <br>

                <label for="tipo_combustible">Tipo de Combustible:</label>
                <input type="text" id="tipo_combustible" oninput="validarLetra(this)" name="tipo_combustible" pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+" title="Ingresa únicamente texto (sin números ni caracteres especiales)" required><br>
                <br>
>>>>>>> 062f7a71327757b8d7b6b2a9397391ee0122b3b2

            <label for="tipo_vehiculo">Tipo de Vehículo:</label>
            <input type="text" id="tipo_vehiculo" name="tipo_vehiculo" required><br>
            <br>

<<<<<<< HEAD
            <label for="capacidad">Capacidad:</label>
            <input type="text" id="capacidad" name="capacidad" required><br>
            <br>
=======
                <label for="peso">Peso:</label>
                <input type="number" id="peso" oninput="validarNumero(this)" name="peso" min="0" required><br>
                <br>
>>>>>>> 062f7a71327757b8d7b6b2a9397391ee0122b3b2

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