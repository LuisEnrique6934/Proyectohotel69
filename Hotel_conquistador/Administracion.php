<?php
session_start();
require_once 'includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $error = "";

    // Verifica la contraseña
    if ($password === 'HotelConquistador123') { // Cambia por tu contraseña real
        $_SESSION['admin'] = true;
        header("Location: Admin.php");
        exit();
    } else {
        $error = "Contraseña incorrecta. Inténtalo de nuevo.";
    }
} else {
    $error = "";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso de Administrador - Hotel Conquistador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('images.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            background-color: #ffffffdd;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }

        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3498db;
        }

        .error {
            color: #e74c3c;
            margin-top: 15px;
            font-size: 14px;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 15px;
            background-color: rgba(44, 62, 80, 0.9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        .navbar .title {
            flex: 1;
            text-align: center;
            font-weight: bold;
        }

        .navbar button {
            background: none;
            border: 2px solid white;
            color: white;
            padding: 8px 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .navbar button:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <div class="navbar">
        <button onclick="location.href='Menú.php'">Volver</button>
        <div class="title">Acceso Administrativo</div>
    </div>

    <div class="container">
        <h2>Área Restringida para Administradores</h2>
        <form method="POST" action="">
            <input type="password" name="password" placeholder="Introduce la contraseña" required>
            <button type="submit">Acceder</button>
            <?php if ($error): ?>
                <p class="error"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
