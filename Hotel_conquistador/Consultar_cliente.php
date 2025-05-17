<?php
session_start();
require_once 'includes/conexion.php';

$sql = "SELECT * FROM cliente";
$result = $pdo->query($sql);

$tabla = "";
if ($result->rowCount() > 0) {
    $tabla .= "<table>";
    $tabla .= "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Teléfono</th><th>Email</th><th>Dirección</th></tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . htmlspecialchars($row['id_cliente']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['apellido']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['dni']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['telefono']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['email']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['direccion']) . "</td>";
        $tabla .= "</tr>";
    }
    $tabla .= "</table>";
} else {
    $tabla = "No se encontraron clientes.";
}          
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultar Cliente</title>
</head>
<body>
    <div class="container">
        <h1>Consultar Cliente</h1>
        <?php echo $tabla; ?>
        <a href="Menú.php">Volver</a>
    </div>
</body>
</html>