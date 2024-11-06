<?php	
session_start();

if (empty($_POST['mod_name'])) {
    $errors[] = "Nombre vacío";
} else if (empty($_POST['mod_email'])) {
    $errors[] = "Correo vacío";
} else if ($_POST['mod_status'] == "") {
    $errors[] = "Selecciona el estado";
} else if (!empty($_POST['mod_name']) && !empty($_POST['mod_email']) && $_POST['mod_status'] != "") {

    include "../config/config.php"; // Conexión a la base de datos

    $name = mysqli_real_escape_string($con, (strip_tags($_POST["mod_name"], ENT_QUOTES)));
    $email = mysqli_real_escape_string($con, (strip_tags($_POST["mod_email"], ENT_QUOTES)));
    $direccion = mysqli_real_escape_string($con, (strip_tags($_POST["mod_direccion"], ENT_QUOTES))); // Dirección
    $cuil_dni = mysqli_real_escape_string($con, (strip_tags($_POST["mod_cuil_dni"], ENT_QUOTES))); // CUIL
    $status = intval($_POST['mod_status']);
    $id = intval($_POST['mod_id']); // Asegúrate de que ID sea un entero

    // Actualiza la consulta para incluir direccion y cuil_dni
    $sql = "UPDATE user SET name=\"$name\", email=\"$email\", direccion=\"$direccion\", cuil_dni=\"$cuil_dni\", is_active=$status WHERE id=$id";
    
    $query_update = mysqli_query($con, $sql);
    
    if ($query_update) {
        $messages[] = "Datos actualizados satisfactoriamente.";

        // Actualiza la contraseña solo si se proporciona
        if ($_POST["password"] != "") {
            $password = mysqli_real_escape_string($con, (strip_tags(sha1(md5($_POST["password"])), ENT_QUOTES))); // Asegúrate de encriptar correctamente la contraseña
            $update_passwd = mysqli_query($con, "UPDATE user SET password=\"$password\" WHERE id=$id");
            if ($update_passwd) {
                $messages[] = "Y la contraseña ha sido actualizada.";
            }
        }

    } else {
        $errors[] = "Lo siento, algo ha salido mal. Intenta nuevamente." . mysqli_error($con);
    }
} else {
    $errors[] = "Error desconocido.";
}

// Manejo de errores y mensajes
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
?>
