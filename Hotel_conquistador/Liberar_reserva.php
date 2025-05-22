<?php
session_start();
require_once 'includes/conexion.php';

$mensaje = '';
$id_reserva = filter_input(INPUT_POST, 'id_reserva', FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id_reserva) {
        // Actualizar estado de la reserva a 'finalizado'
        $sql = "UPDATE reserva SET estado = 'finalizado' WHERE id_reserva = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_reserva]);

        if ($stmt->rowCount() > 0) {
            // Liberar la habitación asociada
            $sql_hab = "UPDATE habitacion h
                        JOIN reserva r ON h.id_habitacion = r.id_habitacion
                        SET h.estado = 'disponible'
                        WHERE r.id_reserva = ?";
            $stmt_hab = $pdo->prepare($sql_hab);
            $stmt_hab->execute([$id_reserva]);
            $stmt_hab->closeCursor();

            $mensaje = '<div class="mensaje exito">Reserva liberada correctamente.</div>';
        } else {
            $mensaje = '<div class="mensaje error">No se pudo liberar la reserva. Verifica el ID.</div>';
        }
        $stmt->closeCursor();
    } else {
        $mensaje = '<div class="mensaje error">ID de reserva no válido.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Liberar Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('crown paradise club cancun.jpg') no-repeat center center fixed;
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
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #2c3e50;
        }
        input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            margin-top: 20px;
            padding: 12px;
            background: #2980b9;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background: #1c5980;
        }
        .mensaje {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }
        .mensaje.exito {
            color: #27ae60;
        }
        .mensaje.error {
            color: #c0392b;
        }
        .volver {
            text-align: center;
            margin-top: 30px;
        }
        .volver a {
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }
        .volver a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liberar Reserva</h2>
        <form method="post" action="">
            <label for="id_reserva">ID de Reserva a liberar:</label>
            <input type="number" name="id_reserva" id="id_reserva" required value="<?= htmlspecialchars($id_reserva ?? '') ?>" />
            <button type="submit">Liberar</button>
        </form>
        <?= $mensaje ?>
        <div class="volver">
            <a href="Menú.php">Volver al Menú</a>
        </div>
    </div>
</body>
</html>
