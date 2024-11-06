<?php
// Conectar a la db
$conn = mysqli_connect("smtp187.controlvps.com", "webit", "Artigas77", "webmayoitnuke");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Consultar presupuestos
$query = "SELECT * FROM presupuestos";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Mostrar resultados
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?= $row['descripcion'] ?></td>
        <td><?= $row['precio'] ?></td>
        <td>
            <button type="button" class="btn btn-primary" onclick="obtener_datos(<?= $row['id'] ?>)">Editar</button>
            <button type="button" class="btn btn-danger" onclick="eliminar(<?= $row['id'] ?>)">Eliminar</button>
        </td>
    </tr>
    <?php
}

// Cerrar conexión
mysqli_close($conn);
?>