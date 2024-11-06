<?php
session_start();

// Inicia validación del lado del server
if (empty($_POST['id'])) {
    $errors[] = "ID vacío";
} else if (empty($_POST['descripcion'])) {
    $errors[] = "Descripción vacío";
} else if (empty($_POST['nombre'])) {
    $errors[] = "Nombre vacío";
} else if (empty($_POST['precio'])) {
    $errors[] = "Precio vacío";
} else {

    // Conectar a la base de datos
    include "../config/config.php";

    $descripcion = $_POST["descripcion"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $creado_at = $_POST["creado_at"];
    $ticket_id = $_POST["ticket_id"];

    // Preparar la consulta
    $sql = "INSERT INTO presupuestos (descripcion, nombre, precio, creado_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $descripcion, $nombre, $precio);
    mysqli_stmt_execute($stmt);

    // Verificar resultado
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $messages[] = "Tu presupuesto ha sido ingresado satisfactoriamente.";
    } else {
        $errors[] = "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
    }

    // Cerrar la conexión
    mysqli_close($con);
}

// Mostrar errores o mensajes
if (isset($errors)) {
    ?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
    <?php
}
if (isset($messages)) {
    ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
    <?php
}