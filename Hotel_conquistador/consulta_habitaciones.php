<?php
session_start();    
require_once 'includes/conexion.php';

$sql = "SELECT * FROM habitacion";
$result = $pdo->query($sql);

$tabla = "";
if ($result->rowCount() > 0) {
    $tabla .= "<div class='tabla-contenedor'>";
    $tabla .= "<table>";
    $tabla .= "<thead><tr><th>ID</th><th>Número</th><th>Tipo</th><th>Precio</th><th>Estado</th></tr></thead><tbody>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . htmlspecialchars($row['id_habitacion']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['numero']) . "</td>";
        $tabla .= "<td>" . htmlspecialchars($row['tipo']) . "</td>";
        $tabla .= "<td>$" . number_format($row['precio'], 2) . "</td>";
        $tabla .= "<td>" . ucfirst(htmlspecialchars($row['estado'])) . "</td>";
        $tabla .= "</tr>";
    }
    $tabla .= "</tbody></table></div>";
} else {
    $tabla = "<div class='mensaje-vacio'>⚠️ No se encontraron habitaciones registradas.</div>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Habitaciones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 960px;
            margin: 60px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
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
            margin-bottom: 20px;
            font-size: 15px;
        }

        thead {
            background-color: #2980b9;
            color: #fff;
        }

        th, td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f4f9fd;
        }

        .volver {
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

        .volver:hover {
            background-color: #1c5980;
        }

        .mensaje-vacio {
            text-align: center;
            padding: 20px;
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 20px;
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
        <h1>Consulta de Habitaciones</h1>
        <?php echo $tabla; ?>
        <a href="Menú.php" class="volver">← Volver al inicio</a>
    </div>
</body>
</html>
