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
    
    <link rel="stylesheet" href="css/login.css">
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