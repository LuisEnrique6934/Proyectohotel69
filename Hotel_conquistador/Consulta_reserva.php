<?php
session_start();    
require_once 'includes/conexion.php';

$sql = "SELECT * FROM reserva";
$result = $pdo->query($sql);

$tabla = "";
if ($result->rowCount() > 0) {
    $tabla .= "<table>";
    $tabla .= "<tr>
        <th>ID Reserva</th>
        <th>ID Cliente</th>
        <th>ID Habitación</th>
        <th>Número de Personas</th>
        <th>Fecha Entrada</th>
        <th>Fecha Salida</th>
        <th>Estado</th>
    </tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . htmlspecialchars($row['id_reserva']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['id_cliente']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['id_habitacion']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['numero_personas']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['fecha_entrada']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['fecha_salida']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['estado']) . "</td>";
        $tabla .= "</tr>";
    }
    $tabla .= "</table>";
} else {
    $tabla = "No se encontraron reservas.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            padding: 12px 8px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #2980b9;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .volver {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 18px;
            background: #2980b9;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.2s;
        }
        .volver:hover {
            background: #1c5980;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Consulta de Reservas</h1>
        <?php echo $tabla; ?>
        <a href="Menú.php" class="volver">Volver al inicio</a>
    </div>
</body>
</html>