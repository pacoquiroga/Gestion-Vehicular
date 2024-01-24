<?php
if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];


    $choferes = json_decode(file_get_contents('datos/choferes.json'), true);


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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/chofer.css">
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
            <li><a href="inicio.php">INICIO</a></li>
            <li><a href="vehiculos.php">VEHICULOS</a></li>
            <li><a href="chofer.php">CHOFERES</a></li>
        </ul>
    </nav>
    <section>
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
        </table>
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
                    <?php
                    if ($choferEncontrado['vehiculo_asignado'] == '') { ?>
                        <a href="vehiculos.php" class="botonAsignar">Asignar Vehículo</a>
                    <?php } else { ?>
                        <form action="vehiculos.php" method="post" class="formVehiculo">
                            <input type="hidden" class="titulo" name="vehiculos"
                                value="<?php echo $choferEncontrado['vehiculo_asignado']; ?>">
                            <span><strong class="titulo">Vehículo Asignado: </strong></span>
                            <button type="submit" class="vehiculoAsignado">
                                <?php echo $choferEncontrado['vehiculo_asignado']; ?>
                            </button>
                        </form>
                        <?php
                    }
                    ?>

                </article>
                <article style=" text-align:center; ">
                    <h1>Foto del Chofer</h1>
                    <img src="img/<?php echo $choferEncontrado['foto']; ?>" width="50%" alt="foto-chofer">
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
    <footer class="footerChofer">
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="img/LogoFacebook.png"
                alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>

</body>

</html>