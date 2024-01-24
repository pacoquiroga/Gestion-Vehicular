<?php
if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];


    $choferes = json_decode(file_get_contents('choferes.json'), true);


    $choferEncontrado = null;
    foreach ($choferes as $chofer) {
        if ($chofer['cedula'] == $busqueda) {
            $choferEncontrado = $chofer;
            break;
        }
    }
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

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
            border-radius: 10px;
        }

        .barra-navegacion {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2C3E50;
            padding: 10px;
            border-radius: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .barra-navegacion form {
            margin-right: 20px;
        }

        .barra-navegacion form input {
            padding: 5px;
        }



        .barra-navegacion nav a {
            margin-right: 10px;
        }

        .informacion {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }

        .informacion article {
            flex: 1;
            max-width: 40%;
            background-color: #ECF0F1;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
        }

        .informacion h1 {
            color: #3498DB;
            text-align: center;
        }

        .informacion p {
            color: #34495E;
            margin: 10;
        }

        .informacion .titulo {
            color: #3498DB;
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
        <table>
            <tr>
                <td>
                    <section class="barra-navegacion">
                        <form>
                            <label for="busqueda">
                                <font color="white">Buscar:</font>
                            </label>
                            <input type="number" id="busqueda" placeholder="Ingresa Cedula" name="busqueda">
                            <input type="submit" value="Buscar">
                        </form>
                        <nav class="adicional">
                            <a href="formularios/form_ingreso_chofer.php">Agregar Chofer</a>
                        </nav>
                </td>
            </tr>
            <tr>
                <td>
                    </section>
                    <section class="contenedor-informacion">
                        <?php if (isset($choferEncontrado)): ?>
                            <section class="informacion">
                                <article>
                                    <h1>Información del Chofer</h1>
                                    <p><strong class="titulo">Nombre: </strong>
                                        <?php echo $choferEncontrado['nombre']; ?>
                                    </p>
                                    <p><strong class="titulo">Apellido: </strong>
                                        <?php echo $choferEncontrado['apellido']; ?>
                                    </p>
                                    <p><strong class="titulo">Edad: </strong>
                                        <?php echo $choferEncontrado['edad']; ?>
                                    </p>
                                    <p><strong class="titulo">Numero de Cedula: </strong>
                                        <?php echo $choferEncontrado['cedula']; ?>
                                    </p>
                                    <p><strong class="titulo">Sexo: </strong>
                                        <?php echo $choferEncontrado['sexo']; ?>
                                    </p>
                                </article>
                                <article>
                                    <h1>Información Técnica</h1>
                                    <p><strong class="titulo">Tipo de licencia: </strong>
                                        <?php echo $choferEncontrado['licencia']; ?>
                                    </p>
                                    <p><strong class="titulo">Tipo de sangre: </strong>
                                        <?php echo $choferEncontrado['sangre']; ?>
                                    </p>
                                    <p><strong class="titulo">Fecha de entrada: </strong>
                                        <?php echo $choferEncontrado['fecha_entrada']; ?>
                                    </p>
                                </article>
                                <article style=" text-align:center; ">
                                    <h1>Foto del Chofer</h1>
                                    <img src="../img/<?php echo $choferEncontrado['foto']; ?>" width="50%"
                                        alt="foto-chofer">

                                </article>
                            </section>
                        <?php elseif (isset($_GET['busqueda'])): ?>
                            <section>
                                <article>
                                    <p>No se encontró ningún chofer con la cédula
                                    </p>
                                </article>
                            </section>
                        <?php else: ?>
                            <section>
                                <article>
                                    <p> </p>
                                    <p>Ingrese la cédula del chofer que desea buscar</p>
                                    <p> </p>
                                </article>
                            </section>
                        <?php endif; ?>
                    </section>
                </td>
            </tr>
        </table>
    </section>
    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
    </footer>
</body>

</html>