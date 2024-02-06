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

    <style>
        

        .informacion {
            padding-top: 9%;
            padding-bottom: 2%;
            margin: auto;
            width: 800px;
            height: 435px;
        }

        .informacion article {
            margin: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #ECF0F1;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .informacion article h1 {
            color: #3498DB;
            text-align: center;
        }

        .informacion article p {
            color: #34495E;
            padding: 20px;
            margin: 0;
            text-align: center;
        }

        .titulo {
            padding: 20px;
            color: #3498DB;
        }

        .informacion article h3 {
            color: #34495E;
            padding: 20px;
            margin: 0;
            text-align: center;
        }


    </style>
</head>

<body>
    <header>

        <section class="logoNav">
            <a href="#" class="logo" id="header">Gestión</a>
            <img class="logoEmpresa" src="../img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular" />
            <a href="#" class="logo" id="header"> Vehicular</a>
        </section>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#about">Nosotros</a></li>
                <li><button id="show-login" class="log-btn">Log In</button></li>
            </ul>
        </nav>
    </header>

    
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