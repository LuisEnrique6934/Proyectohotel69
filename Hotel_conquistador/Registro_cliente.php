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

    $sql = "INSERT INTO cliente (id_cliente, nombre, apellido, dni, telefono, email, direccion) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_cliente, $nombre, $apellido, $dni, $telefono, $email, $direccion]);

    if ($stmt->rowCount() > 0) {
        $mensaje = '<div class="mensaje exito">✅ Cliente registrado exitosamente.</div>';
    } else {
        $mensaje = '<div class="mensaje error">❌ Error al registrar el cliente.</div>';
    }

    $stmt->closeCursor();
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente | Hotel Conquistador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('IMGL5305.jpeg') no-repeat center center fixed;
            margin: 0;
            padding: 0;
            
        }

        .container {
            max-width: 500px;
            margin: 60px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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
            margin-top: 12px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus {
            border-color: #2980b9;
            outline: none;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #21618c;
        }

        .mensaje {
            margin-top: 20px;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
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
            text-align: center;
            margin-top: 25px;
            font-weight: bold;
            text-decoration: none;
            color: #2980b9;
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
        <h2>Registrar Cliente</h2>
        <form method="post" action="">
            <label for="id_cliente">ID Cliente</label>
            <input type="number" name="id_cliente" id="id_cliente" required>

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" required>

            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" required>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" required>

            <button type="submit">Registrar Cliente</button>
        </form>
        <?php echo $mensaje; ?>

        <a class="volver" href="Menú.php">← Volver al Menú Principal</a>
    </div>
</body>
</html>
