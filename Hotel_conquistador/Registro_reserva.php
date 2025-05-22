<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include 'includes/conexion.php';
    session_start();

    $id_reserva = $_POST['id_reserva'];
    $id_cliente = $_POST['id_cliente'];
    $id_habitacion = $_POST['id_habitacion'];
    $numero_personas = $_POST['numero_personas'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO reserva (id_reserva, id_cliente, id_habitacion, numero_personas, fecha_entrada, fecha_salida, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_reserva, $id_cliente, $id_habitacion, $numero_personas, $fecha_entrada, $fecha_salida, $estado]);

    if ($stmt->rowCount() > 0) {
        $mensaje = '<div class="mensaje exito">✅ Reserva registrada exitosamente.</div>';
    } else {
        $mensaje = '<div class="mensaje error">❌ Error al registrar la reserva.</div>';
    }
    $stmt->closeCursor();
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Reserva | Hotel Conquistador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('65345792-h1-facb_angular_pool_view_300dpi.webp') no-repeat center center fixed;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 80px auto;
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: 600;
        }

        input, select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus, select:focus {
            border-color: #2980b9;
            outline: none;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            background-color: #2980b9;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #1c5980;
        }

        .mensaje {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
        }

        .mensaje.exito {
            background-color: #eafaf1;
            color: #27ae60;
        }

        .mensaje.error {
            background-color: #fdecea;
            color: #c0392b;
        }

        .volver {
            display: block;
            margin: 20px auto 0;
            text-align: center;
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }

        .volver:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrar Reserva</h2>
        <form method="post" action="">
            <label for="id_reserva">ID de Reserva</label>
            <input type="number" name="id_reserva" id="id_reserva" required>

            <label for="id_cliente">ID de Cliente</label>
            <input type="number" name="id_cliente" id="id_cliente" required>

            <label for="id_habitacion">ID de Habitación</label>
            <input type="number" name="id_habitacion" id="id_habitacion" required>

            <label for="numero_personas">Número de Personas</label>
            <input type="number" name="numero_personas" id="numero_personas" required min="1" max="5">

            <label for="fecha_entrada">Fecha de Entrada</label>
            <input type="date" name="fecha_entrada" id="fecha_entrada" required>

            <label for="fecha_salida">Fecha de Salida</label>
            <input type="date" name="fecha_salida" id="fecha_salida" required>

            <label for="estado">Estado</label>
            <select name="estado" id="estado" required>
                <option value="">Seleccione un estado</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelado">Cancelado</option>
                <option value="completada">Completada</option>
            </select>

            <button type="submit">Registrar Reserva</button>
        </form>

        <?php if (isset($mensaje)) echo $mensaje; ?>

        <a href="Menú.php" class="volver">← Volver al Menú Principal</a>
    </div>
</body>
</html>
