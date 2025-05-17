<?php
// filepath: c:\xampp\htdocs\Hotel_conquistador\Liberar_reserva.php
session_start();
require_once 'includes/conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_reserva = $_POST['id_reserva'];

    // Cambia el estado de la reserva a 'finalizado' y libera la habitación
    $sql = "UPDATE reserva SET estado = 'finalizado' WHERE id_reserva = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_reserva]);

    if ($stmt->rowCount() > 0) {
        // También puedes liberar la habitación si tu lógica lo requiere
        $sql_hab = "UPDATE habitacion h
                    JOIN reserva r ON h.id_habitacion = r.id_habitacion
                    SET h.estado = 'disponible'
                    WHERE r.id_reserva = ?";
        $stmt_hab = $pdo->prepare($sql_hab);
        $stmt_hab->execute([$id_reserva]);

        $mensaje = '<div class="mensaje">Reserva liberada correctamente.</div>';
    } else {
        $mensaje = '<div class="mensaje error">No se pudo liberar la reserva. Verifica el ID.</div>';
    }
    $stmt->closeCursor();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Liberar Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .container {
            width: 400px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            margin-bottom: 4px;
        }
        input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 18px;
            padding: 10px;
            background: #2980b9;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #1c5980;
        }
        .mensaje {
            margin-top: 18px;
            text-align: center;
            color: #27ae60;
        }
        .error {
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liberar Reserva</h2>
        <form method="post" action="">
            <label for="id_reserva">ID de Reserva a liberar:</label>
            <input type="number" name="id_reserva" id="id_reserva" required>
            <button type="submit">Liberar</button>
        </form>
        <?php echo $mensaje; ?>
        <div style="text-align:center;margin-top:20px;">
            <a href="Menú.php">Volver al Menú</a>
        </div>
    </div>
</body>
</html>