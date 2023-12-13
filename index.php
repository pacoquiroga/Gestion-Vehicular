<?php

$usuario_correcto = "usuario";
$contrasena_correcta = "contrasena";
$alerta = "";

if (isset($_POST['username']) && isset($_POST['password'])){
    if($_POST['username'] === $usuario_correcto && $_POST['password'] === $contrasena_correcta){
        header("Location: inicio.html");
        exit();
    }else {
        $alerta = "<p style='width:100%; margin:0px; background-color:black; color:red; text-align:center; padding:10px;'>Usuario o contraseña incorrectos. Inténtalo de nuevo.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Vehicular - Iniciar Sesión</title>
    <style>
        body {
            background-color: rgb(218, 217, 217);
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        header {
            display: flex;
            align-items: center;
            background-color: #1B3665;
            color: white;
            padding: 10px;
        }

        .login-container {
            width: 30%;
            margin: auto;
            margin-top: 110px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            display: flex; 
            flex-direction: column; 
            align-items: center;
        }

        .login-container article {
            margin: 0px;
            margin-bottom: 40px;
            background-color: #1B3665;
            display: flex;
            width: 100%;
            border-radius: 10px;
        }

        .login-container article h2 {
            margin: 0px;
            padding: 10px;
            color: white;
            width: 100%;
            text-align: left;
            margin-top: 5px;
            margin-left: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #1B3665;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        footer {
            position: fixed; 
            bottom: 0; 
            width: 100%;
            background-color: #000000;
            color: rgb(255, 255, 255);
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <img class="imgLogo" src="images/LogoGestionVehicular.png" alt="Logo Gestion Vehicular" width=8% >
        <h1 align="center">Gestión Vehicular - Iniciar Sesión</h1>
    </header>

    <?php
    echo $alerta;
    ?>

    <section class="login-container">
        <article >
            <h2 >Iniciar Sesión</h2>
            <img src="images/Usuario.png" alt="Logo Gestion Vehicular" width=10% height=5% >
        </article>
        <form action="index.php" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </section>

    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="images/LogoFacebook.png" alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="images/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="images/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>
</body>

</html>