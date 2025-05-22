<!DOCTYPE html>
<html lang="es-MX">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Hotel Conquistador</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(44, 62, 80, 0.9);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        .logo {
            font-size: 20px;
            font-weight: bold;
        }

        .logout-btn {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 120px auto;
            background-color: #ffffffdd;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        nav ul li {
            display: flex;
            justify-content: center;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            background-color: #2980b9;
            padding: 14px 24px;
            border-radius: 10px;
            font-size: 16px;
            text-align: center;
            width: 100%;
            max-width: 280px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #3498db;
        }

        @media (max-width: 600px) {
            nav ul {
                grid-template-columns: 1fr;
            }

            .logout-btn {
                padding: 6px 12px;
                font-size: 14px;
            }

            .logo {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <div class="navbar">
        <div class="logo">Hotel Conquistador</div>
        <button class="logout-btn" onclick="location.href='logout.php'">Cerrar sesión</button>
    </div>

    <div class="container">
        <h1>Menú Principal</h1>
        <nav>
            <ul>
                <li><a href="Registro_reserva.php">Registrar reservación</a></li>
                <li><a href="Consulta_reserva.php">Consultar reservación</a></li>
                <li><a href="Liberar_reserva.php">Liberar reservación</a></li>
                <li><a href="Registro_cliente.php">Registrar cliente</a></li>
                <li><a href="Consultar_cliente.php">Consultar cliente</a></li>
                <li><a href="Impresion_factura.php">Imprimir factura</a></li>
                <li><a href="Consulta_habitaciones.php">Consultar habitación</a></li>
                <li><a href="Administracion.php">Administración</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
