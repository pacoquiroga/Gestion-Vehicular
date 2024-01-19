<?php
session_start();

$mensajeError = '';
$emailAnterior = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST["email"];
    $contrasena = $_POST["password"];
    $usuarios = json_decode(file_get_contents("usuarios.json"), true);

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
        header("Location: inicio.php");
        exit();
    } else {
        $mensajeError = "Correo o contraseña incorrectos";
        $emailAnterior = $correo;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ingreso</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #1B3665;
            font-family: 'poppins', sans-serif;

        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            background-position: center;
            background-size: cover;
        }

        .form-box {
            position: relative;
            width: 400px;
            height: 450px;
            background: #ccc;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            display: flex;
            justify-content: center;
            align-items: center;

        }

        h2 {
            font-size: 2em;
            color: #000000;
            text-align: center;
        }

        .inputbox {
            position: relative;
            margin: 30px 0;
            width: 310px;
            border-bottom: 2px solid #fff;
        }

        .inputbox label {
            position: absolute left: 5px;
            color: #000000;
            font-size: 1em;
            transform: translateY(-250%);

        }

        .inputbox input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            padding: 0 35px 0 5px;
            color: #fff;
        }

        .forget {
            margin: -15px 0 15px;
            font-size: .9em;
            color: #fff;
            display: flex;
            justify-content: space-between;
        }

        .forget label input {
            margin-right: 3px;

        }

        .forget label a {
            color: #fff;
            text-decoration: none;
        }

        .forget label a:hover {
            text-decoration: underline;
        }

        .imgLogo {
            width: 10%;
            height: 10%;
            margin: 0 auto;
            display: block;
            
        }

        button {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <img src="../img/LogoGestionVehicular.png" alt="" class="imgLogo">
    <section>
        <article class="form-box">
            <article class="form-value">
                <form action="login.php" method="POST">
                    <h2>Login</h2>

                    <?php
                    if (!empty($mensajeError)) {
                        echo "<p style='color: red;'>$mensajeError</p>";
                    }
                    ?>

                    <article class="inputbox">
                        <label for="">Correo</label>
                        <input type="email" id="email" name="email" required
                            value="<?php echo htmlspecialchars($emailAnterior); ?>">

                    </article>
                    <article class="inputbox">
                        <label for="">Contraseña</label>
                        <input type="password" id="password" name="password" required>

                    </article>
                    <button>Ingresar</button>
                </form>
            </article>
        </article>
    </section>
</body>

</html>