<?php
session_start();

// Inicia validación del lado del servidor
if (empty($_POST['mod_id'])) {
    $errors[] = "ID vacío";
} else if (empty($_POST['nombre'])) {
    $errors[] = "Nombre vacío";
} else if (empty($_POST['descripcion'])) {
    $errors[] = "Descripción vacío";
} else {

    // Conectar a la base de datos
    include "../config/config.php";

    $id = $_POST["mod_id"];
    $descripcion = $_POST["descripcion"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

    // Preparar la consulta
    $sql = "UPDATE presupuesto SET descripcion=?, nombre=?, precio=?, updated_at=NOW() WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $descripcion, $nombre, $precio, $id);
    mysqli_stmt_execute($stmt);

    // Verificar resultado
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $messages[] = "El presupuesto ha sido actualizado satisfactoriamente.";
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

// FPDF - acordate
// Verificar si la solicitud es válida
if (empty($id) || empty($descripcion) || empty($nombre) || empty($precio)) {
    echo 'Error: Faltan campos obligatorios';
    exit;
}

echo 'Presupuesto actualizado.';
?>