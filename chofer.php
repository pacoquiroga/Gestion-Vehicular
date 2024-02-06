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
    <link rel="stylesheet" href="css/chofer.css">

    <script src="js/script.js"></script>
    <script src="js/validaciones.js"></script>
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

                                    <label for="fentrada">Fecha de entrada:</label>
                                    <input type="date" id="fecha_entrada" name="fecha_entrada"
                                        oninput="validarCampo('fecha_entrada')" required min="2000-01-01"><br><br>

                                    <label for="foto">Archivo de Foto:</label>
                                    <input type="file" id="foto" name="foto">
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
                    <img src="../img/<?php echo $choferEncontrado['foto']; ?>" width="50%" alt="foto-chofer">

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