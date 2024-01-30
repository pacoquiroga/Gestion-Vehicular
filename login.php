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
        $alerta = "<p style='width:100%; margin:0px; background-color:black; color:red; text-align:center; padding:10px;'>Usuario o contraseña incorrectos. Inténtalo de nuevo.</p>";
        $emailAnterior = $correo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Vehicular - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <header>
        <img class="imgLogo" src="img/LogoGestionVehicular.png" alt="Logo Gestion Vehicular" width=8%>
        <h1 align="center">Gestión Vehicular - Iniciar Sesión</h1>
    </header>

    <?php
    echo $alerta;
    ?>

    <section class="login-container">
        <article>
            <h2>Iniciar Sesión</h2>
            <img src="img/Usuario.png" class="icono" alt="Logo Gestion Vehicular" width=10% height=5%>
        </article>
        <form action="login.php" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required
                value="<?php echo htmlspecialchars($emailAnterior); ?>">

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </section>

    <footer>
        <p>&copy Sistema de Gestión Vehicular</p>
        <a href="https://www.facebook.com/zuck?locale=es_LA"><img width="2%" src="img/LogoFacebook.png"
                alt="LogoInsta"></a>
        <a href="https://www.instagram.com/zuck/"><img width="2%" src="img/LogoInsta.png" alt="LogoInsta"></a>
        <a href="https://twitter.com/MarkCrtlC"><img width="2%" src="img/LogoTwitter.png" alt="LogoInsta"> </a>
    </footer>
</body>

</html>