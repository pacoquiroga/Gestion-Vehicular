<?php
session_start();

$nombreUsuario = $_SESSION['nombreUsuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Vehicular</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/inicio.css">
</head>

<body>
    <header>
        <section class="logoEmpresa">
            <img id="logoEmpresa" src="img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
            <h1>Gestión Vehicular</h1>
        </section>
        <a href="index.html"><img class="logoSalir" src="img/LogoCerrarSesion.png" alt="Logo Cerrar Sesión"></a>
    </header>

    <nav>
        <ul>
            <li><a href="vehiculos.php">VEHICULOS</a></li>
            <li><a href="chofer.php">CHOFERES</a></li>
        </ul>
    </nav>
    <section>
        <section class="informacion">
            <article>
                <h1 class="titulo">Bienvenido</h1>
                <img width="30%" src="img/logo-cliente.png" alt="Logo-cliente">
                <p></p>
                <h3>Usuario:
                    <?php echo $nombreUsuario ?>
                </h3>
            </article>
        </section>
    </section>
    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img id="logoRedes" src="img/LogoFacebook.png"
                alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img id="logoRedes" src="img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img id="logoRedes" src="img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>

</body>

</html>