<?php
session_start();
require_once 'includes/conexion.php';

$sql = "SELECT * FROM cliente";
$result = $pdo->query($sql);

$tabla = "";
if ($result->rowCount() > 0) {
    $tabla .= "<div class='tabla-contenedor'>";
    $tabla .= "<table>";
    $tabla .= "<thead><tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>DNI</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Dirección</th>
    </tr></thead><tbody>";
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
    $tabla .= "</tbody></table></div>";
} else {
    $tabla = "<div class='mensaje-vacio'>⚠️ No se encontraron clientes registrados.</div>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta de Clientes</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #eef2f3, #ffffff);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .tabla-contenedor {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        thead {
            background-color: #2980b9;
            color: white;
        }

        th, td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .mensaje-vacio {
            text-align: center;
            padding: 20px;
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        a.volver {
            display: block;
            width: fit-content;
            margin: 20px auto 0;
            padding: 10px 24px;
            background-color: #2980b9;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        a.volver:hover {
            background-color: #1c5980;
        }

        @media (max-width: 600px) {
            table {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Consulta de Clientes</h1>
        <?php echo $tabla; ?>
        <a href="Menú.php" class="volver">← Volver al menú</a>
    </div>
</body>
</html>
