<?php	
session_start();
/* Inicia validación del lado del servidor */
if (empty($_POST['name'])) {
    $errors[] = "Nombre vacío";
} else if (empty($_POST['lastname'])) {
    $errors[] = "Apellidos vacío";
} else if (empty($_POST['email'])) {
    $errors[] = "Correo vacío";
} else if ($_POST['status'] == "") {
    $errors[] = "Selecciona el estado";
} else if (empty($_POST['password'])) {
    $errors[] = "Contraseña vacío";
} else if (empty($_POST['direccion'])) {
    $errors[] = "Dirección vacío";
} else if (empty($_POST['cuil_dni'])) {
    $errors[] = "CUIL/DNI vacío";
} else if (
    !empty($_POST['name']) &&
    !empty($_POST['lastname']) &&
    $_POST['status'] != "" &&
    !empty($_POST['password']) &&
    !empty($_POST['direccion']) &&
    !empty($_POST['cuil_dni'])
) {

    include "../config/config.php";

    // escaping, additionally removing everything that could be (html/javascript-) code
    $name = mysqli_real_escape_string($con, (strip_tags($_POST["name"], ENT_QUOTES)));
    $lastname = mysqli_real_escape_string($con, (strip_tags($_POST["lastname"], ENT_QUOTES)));
    $email = mysqli_real_escape_string($con, (strip_tags($_POST["email"], ENT_QUOTES)));
	$direccion = mysqli_real_escape_string($con, strip_tags($_POST['direccion'], ENT_QUOTES));
	$cuil_dni = mysqli_real_escape_string($con, strip_tags($_POST['cuil_dni'], ENT_QUOTES));
    $password = mysqli_real_escape_string($con, (strip_tags(sha1(md5($_POST["password"])), ENT_QUOTES)));
    $status = intval($_POST['status']);
    $end_name = $name . " " . $lastname;
    $created_at = date("Y-m-d H:i:s");
    $user_id = $_SESSION['user_id'];
    $profile_pic = "default.png";

    $is_admin = 0;
    if (isset($_POST["is_admin"])) {
        $is_admin = 1;
    }

 
    $sql = "INSERT INTO user (name, password, email, profile_pic, is_active, created_at, direccion, cuil_dni) 
            VALUES ('$end_name', '$password', '$email', '$profile_pic', $status, '$created_at', '$direccion', '$cuil_dni')";
    
    $query_new_insert = mysqli_query($con, $sql);
    
    if ($query_new_insert) {
        $messages[] = "El usuario ha sido ingresado satisfactoriamente.";
    } else {
        $errors[] = "Lo siento, algo ha salido mal intenta nuevamente." . mysqli_error($con);
    }

} else {
    $errors[] = "Error desconocido.";
}

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