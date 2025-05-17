<?php
session_start();
require_once 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['nombre_usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?");
    $stmt->execute([$usuario]);
    $usuario_db = $stmt->fetch();

    if ($usuario_db && password_verify($contrasena, $usuario_db['contrasena'])) {
        $_SESSION['user_id'] = $usuario_db['id_usuario'];
        $_SESSION['nombre_usuario'] = $usuario_db['nombre_usuario'];
        $_SESSION['rol'] = $usuario_db['rol'];
        header("Location: Menú.php");	
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Hotel El Conquistador</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            background: url('hoteles-digitales-web.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .form-contenedor {
            background-color: rgba(255, 255, 255, 0.92);
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        h3 {
            text-align: center;
            font-weight: normal;
            color: #555;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #34495e;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #7b3f00;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            margin-top: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5e2e00;
        }

        .error {
            background-color: #f8d7da;
            color: #842029;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
        }

        p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        a {
            color: #7b3f00;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .form-contenedor {
                margin: 30px 20px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-contenedor">
        <h2>Hotel El Conquistador</h2>
        <h3>Inicio de Sesión</h3>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="nombre_usuario">Nombre de usuario:</label>
            <input type="text" name="nombre_usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
