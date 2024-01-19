<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Vehicular</title>
    <style>
        body {
            background-color: #F2F2F2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            max-width: 100vw;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        header {
            display: flex;
            align-items: center;
            background-color: #34495E;
            backdrop-filter: blur(5px);
            color: white;
            padding: 10px;
        }

        section {
            display: flex;
            justify-content: center;
            margin-top: 4px;
        }

        .menu {
            border-radius: 20px;
            border: 3px solid #fff;
            background-color: #2C3E50;
            padding: 1px;
            display: flex;
            margin-right: 450px;
            flex-direction: column;
            align-items: flex-start;
            width: 200px;
            margin-top: 10px;
        }

        .menu ul {
            list-style-type: none;
            padding: 0;
            margin: 30px;
            display: flex;
            flex-direction: column;
        }

        .menu li {
            padding: 20px;
            transition: background-color 0.3s;
            border: none;
        }

        .menu a {
            text-decoration: none;
            color: #ECF0F1;
            font-weight: bold;
            font-size: 15px;
            display: block;
            width: 100%;
            height: 100%;
        }

        .menu li:hover {
            background-color: #3498DB;
        }


        .adicional {

            padding: 0px;
            margin-bottom: 5px;
        }

        .adicional ul {
            list-style-type: none;
            margin: 10px;
            padding: 5px;
            display: flex;
            justify-content: flex-end;
            margin-left: 500px;

        }

        .adicional li {
            padding: 15px;
            transition: background-color 0.3s;
        }

        .adicional a {
            color: #ECF0F1;
            text-decoration: none;
        }

        .redes {
            background-color: #1B3665;
            padding: 1px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .redes ul {
            list-style-type: none;
            margin: 10px;
            padding: 5px;
            display: flex;
            justify-content: flex-end;
        }

        .redes li {
            border-right: 2px solid #fff;
            padding: 15px;
            transition: background-color 0.3s;
        }

        .redes li:last-child {
            border-right: none;
        }

        .ingreso {
            margin-right: 150px;
        }


        input[type="text"],
        input[type="date"],
        input[type="file"],
        input[type="number"],
        select {

            border: none;
            border-bottom: 1px solid #000;
            background: transparent;
            outline: none;

            color: #000;
            font-size: 16px;

            text-align: center;
        }

        footer {
            background-color: #34495E;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <header>
        <img width="7%" src="../img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1 align="center">Gestión Vehicular</h1>
        <nav class="adicional">
            <ul>
                <li><a href="#">Ayuda</a></li>
                <li><a href="#">Quienes somos</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <nav class="redes">
        <ul>
            <li><a href="https://x.com"><img width="50px" src="../img/LogoTwitter.png" alt="Twitter"></a></li>
            <li><a href="https://facebook.com"><img width="50px" src="../img/LogoFacebook.png" alt="Facebook"></a></li>
            <li><a href="https://instagram.com"><img width="50px" src="../img/LogoInsta.png" alt="Instagram"></a></li>
        </ul>
    </nav>
    <section>
        <section class="menu">
            <nav>
                <ul>
                    <li><a href="inicio.php">INICIO</a></li>
                    <li><a href="#">VEHICULOS</a></li>
                    <li><a href="chofer.php">CHOFERES</a></li>
                    <li><a href="../index.html">SALIR</a></li>
                </ul>
            </nav>
        </section>
        <section class="ingreso">

            <form action="procesar-chofer.php" method="post" enctype="multipart/form-data">
                <h1>Información del Chofer</h1>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br>
                <br>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required><br>
                <br>

                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" required min="18"><br>
                <br>

                <label for="numCedula">Número de Cédula:</label>
                <input type="number" id="numCedula" name="numCedula" min="1000000000" max="9999999999" required><br>
                <br>

                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo">
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select><br>
                <br>

                <h1>Información Profesional</h1>

                <label for="licencia">Tipo de licencia:</label>
                <input type="text" id="licencia" name="licencia" required maxlength="2"><br>
                <br>

                <label for="sangre">Tipo de sangre:</label>
                <input type="text" id="sangre" name="sangre" required maxlength="3"><br>
                <br>

                <label for="fentrada">Fecha de entrada:</label>
                <input type="date" id="fecha_entrada" name="fecha_entrada" required min="2000-01-01"><br>
                <br>

                <label for="foto">Archivo de Foto:</label>
                <input type="file" id="foto" name="foto">
                <br>
                <input type="submit" value="Enviar">
        </section>

        </form>
    </section>

    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
    </footer>
</body>

</html>