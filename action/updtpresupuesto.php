<?php
	session_start();       
                        // Inicia validación del lado del servidor
                                    
               if (empty($_POST['mod_id'])) {
                $errors[] = "ID vacío";
                } else if (empty($_POST['nombre'])){
			$errors[] = "Nombre vacío";
		} else if (empty($_POST['descripcion'])){
			$errors[] = "Descripcion vacía";
		}  else if (
			!empty($_POST['nombre']) &&
			!empty($_POST['descripcion'])
		)
                {    
                    
                    
                    
                    
                    
                    
		include "../config/config.php";//Contiene funcion que conecta a la base de datos

    $id = $_POST["mod_id"];
    $descripcion = $_POST["descripcion"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

      //  $sql = "UPDATE presupuesto SET descripcion=?, nombre=?, precio=?, updated_at=NOW() WHERE id=?";


		$sql = "update presupuesto set descripcion=\"$descropcion\",nombre=\"$nombre\",precio=\"$precio\",updated_at=NOW() where id=$id";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El presupuesto ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
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
			if (isset($messages)){
				
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