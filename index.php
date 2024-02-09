<?php
session_start();

$mensajeError = '';
$emailAnterior = '';
$alerta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {

    $correo = $_POST["username"];
    $contrasena = $_POST["password"];
    $usuarios = json_decode(file_get_contents("datos/usuarios.json"), true);

    $autenticado = false;
    foreach ($usuarios as $usuario) {
        if ($usuario["correo"] === $correo && $usuario["contrasena"] === $contrasena) {
            $autenticado = true;
            $nombreUsuario = $usuario["nombre"];
            break;
        }
    }
    if ($autenticado) {
        $_SESSION['nombreUsuario'] = $nombreUsuario;
        header("Location:inicio.php");
        exit();
    } else {
        $alerta = "<p style='width:100%; margin:0px; background-color:black; color:red; box-sizing: border-box; text-align:center; padding:10px;'>Usuario o contraseña incorrectos. Inténtalo de nuevo.</p>";
        $emailAnterior = $correo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión Vehicular</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="../img/LogoGestionVehicular.png" type="image/x-icon">
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
          <li><a href="#">Inicio</a></li>
          <li><a href="#about">Nosotros</a></li>
          <li><button id="show-login" class="log-btn">Log In</button></li>
        </ul>
      </nav>
  </header>

  <?php
    echo $alerta;
    ?>

  <section class="popup" id="popup-1">
    <section class="close-btn">X</section>
    <section class="content">
      <h2>Log in</h2>
      <form action="index.php" method="post">
        <section class="input-field">
          <label for="email">Correo</label>
          <input type="text"  id="username" name="username" placeholder="Correo" class="validate" required
                value="<?php echo htmlspecialchars($emailAnterior); ?>">  
        </section>
        <section class="input-field">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Contraseña" class="validate" required>
        </section>
        <button class="btn">Ingresar</button>
      </form>
    </section>
  </section>

  <!-- carousel -->
  <section class="window-container">
    <section class="carousel">
      <!-- list item -->
      <section class="list">
        <section class="item">
          <img src="img/ubitec-vehículos-por-GPS.jpg" class="imgThumbnail">
          <section class="content">
            <section class="author"></section>
            <section class="title">GESTIÓN DE</section>
            <section class="topic">FLOTAS</section>
            <section class="des">
              <!-- lorem 50 -->

              <p class="first-p">La gestión de flotas es un componente esencial para las empresas que dependen del
                transporte para llevar
                a cabo sus operaciones de manera eficiente. </p>

              <p>Nuestra solución integral de gestión de flotas está diseñada
                para ofrecer un control total sobre los activos móviles, maximizando la eficiencia operativa y mejorando
                la rentabilidad.</p>

            </section>
          </section>
        </section>
        <section class="item">
          <img src="img/chofer.jpg" class="imgThumbnail">
          <section class="content">
            <section class="author"></section>
            <section class="title">GESTIÓN DE</section>
            <section class="topic">CHOFERES</section>
            <section class="des">
              <p class="first-p">Mantenemos perfiles detallados de cada chofer en la plataforma,
                incluyendo información personal, historial de conducción y calificaciones.
                Esto facilita la asignación de tareas específicas según las habilidades y
                experiencia de cada conductor.</p>

              <p>La plataforma permite la asignación de tareas de manera inteligente,
                considerando la ubicación actual de los conductores, su historial de
                desempeño y las necesidades operativas. Esto asegura una asignación
                eficiente y equitativa de las responsabilidades.</p>
            </section>
          </section>
        </section>
        <section class="item">
          <img src="img/flota.jpg" class="imgThumbnail">
          <section class="content">
            <section class="author"></section>
            <section class="title">GESTIÓN DE</section>
            <section class="topic">VEHÍCULOS</section>
            <section class="des">
              <p class="first-p">Cada vehículo en la flota cuenta con un registro detallado que incluye
                información sobre mantenimientos, reparaciones y revisiones técnicas.
                Esto ayuda a prevenir fallas inesperadas y prolonga la vida útil de los vehículos.</p>

              <p>Facilita la coordinación de servicios de mantenimiento externos al integrar la
                solución con talleres y proveedores de servicios. Optimice la gestión de citas y
                reduzca el tiempo de inactividad.</p>
            </section>
          </section>
        </section>

      </section>
      <!-- list thumnail -->
      <section class="thumbnail">
        <section class="item">
          <img src="img/ubitec-vehículos-por-GPS.jpg">
          <section class="content">
            <section class="title">
              <p>Gestión Flotas</p>
            </section>
          </section>
        </section>
        <section class="item">
          <img src="img/chofer.jpg">
          <section class="content">
            <section class="title">
              <p>Gestión Chofer</p>
            </section>
          </section>
        </section>
        <section class="item">
          <img src="img/flota.jpg">
          <section class="content">
            <section class="title">
              <p>Gestión Vehículos</p>
            </section>
          </section>
        </section>
      </section>
      <!-- next prev -->

      <section class="arrows">
        <button id="prev"><</button>
            <button id="next">></button>
      </section>
      <!-- time running -->
      <section class="time"></section>
    </section>
    <section class="somos">
      <article class="texto" id="about">
        <h2 class="tituloSeccion">¿Quiénes Somos?</h2>
        <p class="textoSeccion">
          En la vanguardia del sector de gestión vehicular de transporte
          público, nos presentamos como una empresa comprometida con la
          eficiencia, la seguridad y la calidad en cada trayecto. Nos
          especializamos en la administración integral de flotas de transporte
          público, con el objetivo primordial de brindar un servicio excepcional
          a la comunidad que servimos.
        </p>
        <p class="textoSeccion">
          Reconocemos la importancia crítica de la seguridad y la productividad
          en la gestión de vehículos y choferes. Por ello, nuestra plataforma
          integra funciones avanzadas de seguimiento, mantenimiento preventivo y
          gestión de conductores, asegurando no solo la eficiencia operativa,
          sino también el cumplimiento de estándares de seguridad y regulaciones
          del sector.
        </p>
      </article>
      <img src="img/flota.jpg" alt="gestion de flota" class="imgSomos" />
    </section>

    <section class="bgSection">
      <article class="slogan">
        <h2>
          Transformando la gestión del transporte a través de la tecnología
        </h2>
        <p class="textSlogan">
          Nuestra plataforma de gestión de transporte le permite a las empresas
          de transporte y logística, controlar y optimizar sus operaciones de
          transporte, reduciendo costos y aumentando la productividad.
        </p>
      </article>
    </section>

    <footer>
      <p>&copy Sistema de Gestión Vehicular</p>
      <a href="https://www.facebook.com/zuck?locale=es_LA"><img id="logoRedes" src="img/LogoFacebook.png"
          alt="LogoInsta" /></a>
      <a href="https://www.instagram.com/zuck/"><img id="logoRedes" src="img/LogoInsta.png" alt="LogoInsta" /></a>
      <a href="https://twitter.com/MarkCrtlC"><img id="logoRedes" src="img/LogoTwitter.png" alt="LogoInsta" />
      </a>
    </footer>
  </section>
  <script src="js/index.js"></script>
</body>

</html>