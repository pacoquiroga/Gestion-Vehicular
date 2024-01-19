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
    <style>
        body {
            background-color: #F2F2F2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
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

        .menu {
            border-radius: 20px;
            border: 1px solid #fff;
            background-color: #2C3E50;
            padding: 1px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 200px;
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

        .adicional ul{
            list-style-type: none;
            margin: 10px;
            padding: 5px;
            display: flex;
            justify-content:flex-end;
            margin-left: 500px;
           
        }

        .adicional li{
            padding: 15px;
            transition: background-color 0.3s;
        }
        .adicional a{
            color: #ECF0F1;
            text-decoration: none;
        }

        .redes ul {
            list-style-type: none;
            margin: 10px;
            padding: 5px;
            display: flex;
            justify-content:flex-end;
        }

        .redes li {
            border-right: 2px solid #fff;
            padding: 15px;
            transition: background-color 0.3s;
        }

        .redes li:last-child {
            border-right: none;
        }


        section {
            display: flex;
            align-items: center;
            width: 100%;
            margin-top: 20px;
        }

        .informacion {
            text-align: right;
            display: flex;
            justify-content: center;
            margin-left: 60px;
            width: 90%;
            max-width: 800px;
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
            color: #3498DB;
        }
        footer {
            background-color: #34495E; 
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: auto;
        }
        .redes {
            background-color: #1B3665;
            padding: 1px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

    </style>
</head>

<body>
    <header>
        <img width="7%" src="../img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular">
        <h1 align="center">Gestión Vehicular</h1>
        <nav class="adicional">
            <ul>
                <li><a href="#index.html">Ayuda</a></li>
                <li><a href="vehiculos.html">¿Quienes somos?</a></li>
                <li><a href="chofer.php">Contacto</a></li>
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
        <nav class="menu">
            <ul>
                <li><a href="#inicio.php">INICIO</a></li>
                <li><a href="#">VEHICULOS</a></li>
                <li><a href="chofer.php">CHOFERES</a></li>
                <li><a href="../index.html">SALIR</a></li>
            </ul>
        </nav>
        <section class="informacion">
            <article>
                <h1 class="titulo">Bienvenido</h1>
                <img width="30%" src="../img/logo-cliente.png" alt="Logo-cliente">
                <p></p>
                <p>Usuario: <?php echo $nombreUsuario ?> </p>
            </article>
        </section>
    </section>

    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
    </footer>
</body>

</html>
