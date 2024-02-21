<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "gestion_vehicular";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("No Se Pudo Conectar Con El Servidor: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $placa = mysqli_real_escape_string($enlace, $_POST['placaVehiculo']);
    $IDVehiculo = mysqli_real_escape_string($enlace, $_POST['IDVehiculo']);
    $fechaInicio = mysqli_real_escape_string($enlace, $_POST['fechaInicio']);
    $horaInicio = mysqli_real_escape_string($enlace, $_POST['horaInicio']);
    $kmInicio = mysqli_real_escape_string($enlace, $_POST['kmInicio']);

    $ubiInicioS = $_POST['ubiInicioS'];
    $nuevaUbiI = $_POST['nuevaUbiInicio'];

    $ubiFinS = $_POST['ubiFinS'];
    $nuevaUbiF = $_POST['nuevaUbiFin'];

    echo $ubiInicioS;
    echo $nuevaUbiI;
    echo $ubiFinS;
    echo $nuevaUbiF;

    $ubiInicio = "";
    $ubiFin = "";

    if($ubiInicioS == ""){
        $ubiInicio = mysqli_real_escape_string($enlace,$nuevaUbiI);
    }else{
        $ubiInicio = mysqli_real_escape_string($enlace,$ubiInicioS);
    }


    if($ubiFinS == ""){
        $ubiFin = mysqli_real_escape_string($enlace,$nuevaUbiF);
    }else{
        $ubiFin = mysqli_real_escape_string($enlace,$ubiFinS);
    }

    echo $ubiInicio;
    echo $ubiFin;
   


    $ubi = "SELECT * FROM ruta WHERE ubiInicio = '$ubiInicio' AND ubiFin = '$ubiFin'";
    $resultadoUbi = mysqli_query($enlace, $ubi);

    // Comprobar si se encontró alguna fila
    if (mysqli_num_rows($resultadoUbi) > 0) {
        // Se encontró al menos una fila con las mismas ubiInicio y ubiFin
        
        $ubiArray = mysqli_fetch_assoc($resultadoUbi);
<<<<<<< HEAD
        $IDRuta = $ubiArray['IDRuta'];
=======
        $IDRecorrido = $ubiArray['IDRecorrido'];
>>>>>>> 0c843adde211df1a96480057cb920403351eadad
    } else {
        // No se encontraron filas con las mismas ubiInicio y ubiFin
        // Por lo tanto, inserta una nueva fila
        $insertar = "INSERT INTO ruta (ubiInicio, ubiFin) VALUES ('$ubiInicio', '$ubiFin')";
        
        if (mysqli_query($enlace, $insertar)) {
            // Obtener el ID de la última inserción
<<<<<<< HEAD
            $IDRuta = mysqli_insert_id($enlace);
            echo "Se insertó una nueva línea en la tabla ruta con ID: " . $IDRuta;
=======
            $IDRecorrido = mysqli_insert_id($enlace);
            echo "Se insertó una nueva línea en la tabla ruta con ID: " . $IDRecorrido;
>>>>>>> 0c843adde211df1a96480057cb920403351eadad
        } else {
            echo "Error al insertar la nueva línea: " . mysqli_error($enlace);
        }
    }

<<<<<<< HEAD
    $insertarRecorre = "INSERT INTO recorre (IDVehiculo, IDRuta, fechaInicio, horaInicio, kmInicio) 
             VALUES ('$IDVehiculo', '$IDRuta', '$fechaInicio', '$horaInicio', '$kmInicio')";
=======
    $insertarRecorre = "INSERT INTO recorre (IDVehiculo, IDRecorrido, fechaInicio, horaInicio, kmInicio) 
             VALUES ('$IDVehiculo', '$IDRecorrido', '$fechaInicio', '$horaInicio', '$kmInicio')";
>>>>>>> 0c843adde211df1a96480057cb920403351eadad

    $resultadoInsertarRecorre = mysqli_query($enlace, $insertarRecorre);

    $actualizarkm = "UPDATE vehiculo SET kilometraje = '$kmInicio', estado = 'Ruta' WHERE IDVehiculo = '$IDVehiculo'";
    $resultadoActualizarKm = mysqli_query($enlace, $actualizarkm);

    if($resultadoInsertarRecorre && $resultadoActualizarKm){
        echo "<script type='text/javascript'>
        window.location.href='vehiculos.php?placa=$placa';
        alert('Se puso al vehiculo en ruta.');
        </script>";
    }

    
}
?>