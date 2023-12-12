<?php

    $placa = $_POST["placa"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $anio = $_POST["anio"];
    $tipo_vehiculo = $_POST["tipo_vehiculo"];
    $capacidad = $_POST["capacidad"];
    $kilometraje = $_POST["kilometraje"];
    $tipo_combustible = $_POST["tipo_combustible"];
    $motor = $_POST["motor"];
    $peso = $_POST["peso"];

    

    echo "Información del vehículo ingresada:<br>";
    echo "Placa: $placa<br>";
    echo "Marca: $marca<br>";
    echo "Modelo: $modelo<br>";
    echo "Año: $anio<br>";
    echo "Tipo de Vehículo: $tipo_vehiculo<br>";
    echo "Capacidad: $capacidad<br>";
    echo "Kilometraje: $kilometraje<br>";
    echo "Tipo de Combustible: $tipo_combustible<br>";
    echo "Motor: $motor<br>";
    echo "Peso: $peso<br>";

?>
