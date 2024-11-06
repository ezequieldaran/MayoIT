<?php
    $con = mysqli_connect("localhost", "root", "", "database_name");

    if (!$con) {
        die("Conexion fallo: " . mysqli_connect_error());
    }

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $ticket_id = $_POST['ticket_id'];

    $query = "INSERT INTO presupuestos (nombre, descripcion, precio, ticket_id) VALUES ('$nombre', '$descripcion', '$precio', '$ticket_id')";

    if (mysqli_query($con, $query)) {
        echo "Presupuesto agregado con éxito.";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
?>