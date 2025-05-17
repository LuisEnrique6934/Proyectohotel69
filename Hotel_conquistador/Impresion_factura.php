<?php
session_start(); 
require_once 'includes/conexion.php'; 

$id_reserva = isset($_POST['id_reserva']) ? $_POST['id_reserva'] : null; 
$factura = ""; 

if ($id_reserva) { 
    
    $sql = "SELECT r.*, c.nombre, c.dni, c.telefono, c.email, h.numero, h.tipo, h.precio
            FROM reserva r
            JOIN cliente c ON r.id_cliente = c.id_cliente
            JOIN habitacion h ON r.id_habitacion = h.id_habitacion
            WHERE r.id_reserva = ?";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$id_reserva]); 
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 

    if ($row) { 
        $dias = (strtotime($row['fecha_salida']) - strtotime($row['fecha_entrada'])) / 86400; 
        $dias = $dias > 0 ? $dias : 1; 
        $total = $dias * $row['precio']; 

      
        $factura = "
        <div class='factura'>
            <h2>Factura de Reserva</h2>
            <hr>
            <h3>Datos del Cliente</h3>
            <p><strong>Nombre:</strong> " . htmlspecialchars($row['nombre']) . "</p>
            <p><strong>DNI:</strong> " . htmlspecialchars($row['dni']) . "</p>
            <p><strong>Teléfono:</strong> " . htmlspecialchars($row['telefono']) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>
            <h3>Datos de la Reserva</h3>
            <p><strong>ID Reserva:</strong> " . htmlspecialchars($row['id_reserva']) . "</p>
            <p><strong>Fecha Entrada:</strong> " . htmlspecialchars($row['fecha_entrada']) . "</p>
            <p><strong>Fecha Salida:</strong> " . htmlspecialchars($row['fecha_salida']) . "</p>
            <p><strong>Número de Personas:</strong> " . htmlspecialchars($row['numero_personas']) . "</p>
            <h3>Habitación</h3>
            <p><strong>Número:</strong> " . htmlspecialchars($row['numero']) . "</p>
            <p><strong>Tipo:</strong> " . htmlspecialchars($row['tipo']) . "</p>
            <p><strong>Precio por noche:</strong> $" . htmlspecialchars($row['precio']) . "</p>
            <hr>
            <p><strong>Días:</strong> $dias</p>
            <p><strong>Total:</strong> $" . number_format($total, 2) . "</p>
        </div>
        <button onclick='window.print()'>Imprimir Factura</button>
        ";
    } else {
        $factura = "<div class='error'>No se encontró la reserva.</div>"; 
    }
    $stmt->closeCursor(); 
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $factura = "<div class='error'>No se especificó una reserva.</div>"; 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Impresión de Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .factura {
            width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2, h3 {
            color: #2c3e50;
        }
        .error {
            color: #c0392b;
            text-align: center;
            margin-top: 30px;
        }
        button {
            display: block;
            margin: 30px auto 0 auto;
            padding: 10px 20px;
            background: #2980b9;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #1c5980;
        }
        @media print {
            button { display: none; }
            .factura { box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="factura">
        <h2>Buscar Reserva para Facturar</h2>
        <form method="post" action="">
            <label for="id_reserva">ID de Reserva:</label>
            <input type="number" name="id_reserva" id="id_reserva" required>
            <button type="submit">Buscar</button> 
            <h3><a href="Menú.php">Volver</a></h3>
        </form>
    </div>
    <?php if ($id_reserva) echo $factura; ?>
</body>
</html>