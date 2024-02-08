<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "gestion_vehicular";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    echo "Error en la conexión con el servidor";
}
if(isset($_GET['busqueda'])){
    $CI = $_GET['busqueda'];

    $consulta = "SELECT * FROM chofer WHERE CI = '$CI' LIMIT 1";

    $resultado = mysqli_query($enlace, $consulta);

    $chofer = mysqli_fetch_assoc($resultado);
    if ($chofer == NULL) {
        $choferEncontrado = false; // Indicador de que el chofer no se encontró
    } else {
        $choferEncontrado = array(
            'IDChofer' => $chofer['IDChofer'],
            'nombreChofer' => $chofer['nombreChofer'],
            'apellidoChofer' => $chofer['apellidoChofer'],
            'edad' => $chofer['edad'],
            'numTelefono' => $chofer['numTelefono'],
            'CI' => $chofer['CI'],
            'sexo' => $chofer['sexo'],
            'tipoSangre' => $chofer['tipoSangre'],
            'licencia' => $chofer['licencia'],
            'correo' => $chofer['correo'],
            'foto' => $chofer['foto']
        );
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
 
    <script src="js/añadirChofer.js"></script>
    <script src="js/validaciones.js"></script>
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
                <li><a href="filtroVehiculos.php">Vehiculos</a></li>
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
                            <button id="cancelBtn" value="cancel">X</button>
                            <section class="ingreso">
                                <article class="info-chof">
                                    <form action="formularios/procesar-chofer.php" method="post"
                                        enctype="multipart/form-data" onsubmit="return validarFormulario()">
                                        <h1>Información del Chofer</h1>

                                        <label for="nombre">Nombre:</label>
                                        <input type="text" id="nombre" name="nombre" oninput="validarCampo('nombre')"
                                            required><br><br>

                                        <label for="apellido">Apellido:</label>
                                        <input type="text" id="apellido" name="apellido"
                                            oninput="validarCampo('apellido')" required><br><br>

                                        <label for="edad">Edad:</label>
                                        <input type="number" id="edad" name="edad" oninput="validarCampo('edad')"
                                            required min="18"><br><br>

                                        <label for="numCedula">Número de Cédula:</label>
                                        <input type="number" id="numCedula" name="numCedula"
                                            oninput="validarCampo('numCedula')" min="1000000000" max="9999999999"
                                            required><br><br>

                                        <label for="sexo">Sexo:</label>
                                        <select name="sexo" id="sexo" required>
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                            <option value="otro">Otro</option>
                                        </select><br><br>


                                </article>
                                <article class="info-chof-prof">
                                    <h1>Información Profesional</h1>

                                    <label for="licencia">Tipo de licencia:</label>
                                    <input type="text" id="licencia" name="licencia" oninput="validarCampo('licencia')"
                                        required maxlength="2"><br><br>

                                    <label for="sangre">Tipo de sangre:</label>
                                    <select type="text" id="sangre">
                                        <option value="a+">A+</option>
                                        <option value="a-">A-</option>
                                        <option value="b+">B+</option>
                                        <option value="b-">B-</option>
                                        <option value="o+">O+</option>
                                        <option value="o-">O-</option>
                                        <option value="ab+">AB+</option>
                                        <option value="ab-">AB-</option>
                                    </select><br><br>
                                    <label for="correo">Correo:</label>
                                    <input type="email" id="correo" name="correo" oninput="validarCampo('correo')"
                                        required><br><br>

                                    <label for="foto">Archivo de Foto:</label>
                                    <input type="file" id="foto" name="foto" accept="image/png,image/jpeg">
                                    <br>
                                    <br>
                                    <input type="submit" value="Enviar">
                                </article>
                                </form>
                            </section>
                        </dialog>
                    </section>
                </td>
            </tr>
        </table>
    </section>
    <?php if (isset($choferEncontrado) && $choferEncontrado): ?>
        <section class="contenedor-informacion">
            <section class="informacion">
                <article>
                    <h1>Información del Chofer</h1>
                    <p><strong class="titulo">Nombre: </strong><?php echo $choferEncontrado['nombreChofer']; ?></p>
                    <p><strong class="titulo">Apellido: </strong><?php echo $choferEncontrado['apellidoChofer']; ?></p>
                    <p><strong class="titulo">Edad: </strong><?php echo $choferEncontrado['edad']; ?></p>
                    <p><strong class="titulo">Numero de cedula: </strong><?php echo $choferEncontrado['CI']; ?></p>
                    <p><strong class="titulo">Sexo: </strong><?php echo $choferEncontrado['sexo']; ?></p>
                </article>
                <article>
                    <h1>Información Técnica</h1>
                    <p><strong class="titulo">Tipo de licencia: </strong><?php echo $choferEncontrado['licencia']; ?></p>
                    <p><strong class="titulo">Tipo de sangre: </strong><?php echo $choferEncontrado['tipoSangre']; ?></p>
                    <p><strong class="titulo">Numero celular: </strong><?php echo $choferEncontrado['numTelefono']; ?></p>
                    <p><strong class="titulo">Correo: </strong><?php echo $choferEncontrado['correo']; ?></p>
                </article>
                <article style="text-align:center;">
                    <h1>Foto del Chofer</h1>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($choferEncontrado['foto']); ?>" alt="foto-chofer" width="50%">
                </article>
            </section>
        </section>
            
                <?php elseif (isset($_GET['busqueda'])): ?>
        <section class="info-center">
            <article>
                <p>No se encontró ningún chofer con la cédula <?php echo $CI; ?></p>
            </article>
        </section>
        <?php else: ?>
            <section>

                <section class="info-center">

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