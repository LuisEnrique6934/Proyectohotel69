<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include 'includes/conexion.php';
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=hotel', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id_reserva = $_POST['id_reserva'];
    $id_cliente = $_POST['id_cliente'];
    $id_habitacion = $_POST['id_habitacion'];
    $numero_personas = $_POST['numero_personas'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO reserva (id_reserva, id_cliente, id_habitacion, numero_personas, fecha_entrada, fecha_salida, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_reserva, $id_cliente, $id_habitacion, $numero_personas, $fecha_entrada, $fecha_salida, $estado]);

    if ($stmt->rowCount() > 0) {
        $mensaje = '<div class="mensaje">Reserva registrada exitosamente.</div>';
    } else {
        $mensaje = '<div class="mensaje error">Error al registrar la reserva.</div>';
    }
    $stmt->closeCursor();
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Reserva</title>
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
        input, select {
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
        <h2>Registrar Reserva</h2>
        <form method="post" action="">
            <label for="id_reserva">ID Reserva:</label>
            <input type="number" name="id_reserva" id="id_reserva" required>

            <label for="id_cliente">ID Cliente:</label>
            <input type="number" name="id_cliente" id="id_cliente" required>

            <label for="id_habitacion">ID Habitación:</label>
            <input type="number" name="id_habitacion" id="id_habitacion" required>

            <label for="numero_personas">Número de Personas:</label>
            <input type="number" name="numero_personas" id="numero_personas" required min="1" max="5">

            <label for="fecha_entrada">Fecha de Entrada:</label>
            <input type="date" name="fecha_entrada" id="fecha_entrada" required>

            <label for="fecha_salida">Fecha de Salida:</label>
            <input type="date" name="fecha_salida" id="fecha_salida" required>

            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="confirmada">Confrimada</option>
                <option value="cancelado">Cancelado</option>
                <option value="completada">completada</option>
            </select>

            <button type="submit">Registrar</button>
        </form>
        <?php if (isset($mensaje)) echo $mensaje; ?>
    </div>
    <div class="container">
        <a href="Menú.php" class="volver">Volver al inicio</a>
    </div>
</body>
</html>