<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Hotel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('6345971-Almare_2C_a_Luxury_Collection_Adult_All-Inclusive_Resort_2C_Isla_Mujeres-1.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .container {
            background-color: #ffffffdd;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 600px;
            width: 100%;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 30px 0 0;
        }

        nav ul li {
            margin: 15px 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            background-color: #2980b9;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 18px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="container">
            <div class="logo">Hotel Conquistador</div>
            <h2>Menú Principal</h2>
            <nav>
                <ul>
                    <li><a href="registro.php">Registrar Usuario</a></li>
                    <li><a href="moficar.php">Modificar Usuario</a></li> 
                    <li><a href="borrar.php">Borrar Usuario</a></li>
                    <li><a href="Menú.php">Menú</a></li>
                    <li><a href="Administracion.php">Salir</a></li>
                </ul>
            </nav>
        </div>
    </div>
</body>
</html>
