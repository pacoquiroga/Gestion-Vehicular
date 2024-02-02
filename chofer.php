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

        <section class="logoNav">
            <a href="#" class="logo" id="header">Gestión</a>
            <img class="logoEmpresa" src="img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular" />
            <a href="#" class="logo" id="header"> Vehicular</a>
        </section>
        <nav>
            <ul>
                <li><a href="vehiculos.php">Vehiculos</a></li>
                <li><a href="chofer.php">Choferes</a></li>
                <li><a href="index.php"><img class="logoSalir" src="img/LogoCerrarSesion.png"
                            alt="Logo Cerrar Sesión"></a></li>
            </ul>
        </nav>
    </header>
    <section class="barra-busqueda">
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
                        <section class="buton">
                            <button id="openDialog">Agregar Chofer</button>
                        </section>
    

                        <dialog id="dialog" class="dialog">
                            <section class="ingreso">
                                <article class="info-chof">
                                    <form action="formularios/procesar-chofer.php" method="post"
                                        enctype="multipart/form-data">
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
                                        <input type="number" id="numCedula" name="numCedula" min="1000000000"
                                            max="9999999999" required><br>
                                        <br>

                                        <label for="sexo">Sexo:</label>
                                        <select name="sexo" id="sexo">
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                            <option value="otro">Otro</option>
                                        </select><br>
                                        <br>
                                </article>
                                <article class="info-chof-prof">
                                    <h1>Información Profesional</h1>

                                    <label for="licencia">Tipo de licencia:</label>
                                    <input type="text" id="licencia" name="licencia" required maxlength="2"><br>
                                    <br>

                                    <label for="sangre">Tipo de sangre:</label>
                                    <input type="text" id="sangre" name="sangre" required maxlength="3"><br>
                                    <br>

                                    <label for="fentrada">Fecha de entrada:</label>
                                    <input type="date" id="fecha_entrada" name="fecha_entrada" required
                                        min="2000-01-01"><br>
                                    <br>

                                    <label for="foto">Archivo de Foto:</label>
                                    <input type="file" id="foto" name="foto">
                                    <br>
                                    <input type="submit" value="Enviar">
                                </article>
                                <section class="cerrar">
                                    <button id="cancelBtn" value="cancel">Cerrar</button>
                                    <button id="confirmBtn" value="default">Confirmar</button>
                                </section>
                                </form>
                            </section>
                        </dialog>
                    </section>
                </td>
            </tr>
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
            <section class="info-center">
                <article>
                    <p>No se encontró ningún chofer con la cédula
                    </p>
                </article>
            </section>
        <?php else: ?>
            <section class="info-center">
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
    <script src="js/añadirChofer.js"></script>
</body>

</html>