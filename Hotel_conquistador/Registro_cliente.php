<?php
session_start();
require_once 'includes/conexion.php';

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO cliente (id_cliente, nombre, apellido, dni, telefono, email, direccion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_cliente, $nombre, $apellido, $dni, $telefono, $email, $direccion]);

    if ($stmt->rowCount() > 0) {
        $mensaje = '<div class="mensaje">Cliente registrado exitosamente.</div>';
    } else {
        $mensaje = '<div class="mensaje error">Error al registrar el cliente.</div>';
    }
    $stmt->closeCursor();
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente</title>
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
        <h2>Registrar Cliente</h2>
        <form method="post" action="">
            <label for="id_cliente">ID Cliente:</label>
            <input type="number" name="id_cliente" id="id_cliente" required>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" required>
            
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" required>

            <button type="submit">Registrar</button>
        </form>
        <?php echo $mensaje; ?>
    </div>
    <div class="container">
        <h2><a href="Menú.php">Volver al Menú</a></h2>
    </div>
</body>
</html>

