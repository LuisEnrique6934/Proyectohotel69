<?php
session_start();
require_once 'includes/conexion.php'; // Conexión a la base de datos

$mensaje = "";
$nombre_usuario = "";
$nombre_completo = "";
$contrasena = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['buscar'])) {
        $id = $_POST['id_usuario'];
        $sql = "SELECT nombre_usuario, contrasena, nombre_completo FROM usuario WHERE id_usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($datos) {
            $nombre_usuario = $datos['nombre_usuario'];
            $contrasena = $datos['contrasena'];
            $nombre_completo = $datos['nombre_completo'];
        } else {
            $mensaje = "<div class='error'>❌ Usuario no encontrado.</div>";
        }
    }

    if (isset($_POST['actualizar'])) {
        $id = $_POST['id_usuario'];
        $nuevo_usuario = $_POST['nombre_usuario'];
        $nueva_contrasena = $_POST['contrasena'];
        $nuevo_nombre_completo = $_POST['nombre_completo'];

        $sql = "UPDATE usuario SET nombre_usuario = ?, contrasena = ?, nombre_completo = ? WHERE id_usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nuevo_usuario, $nueva_contrasena, $nuevo_nombre_completo, $id]);

        if ($stmt->rowCount() > 0) {
            $mensaje = "<div class='exito'>✅ Usuario actualizado correctamente.</div>";
            $nombre_usuario = $nuevo_usuario;
            $contrasena = $nueva_contrasena;
            $nombre_completo = $nuevo_nombre_completo;
        } else {
            $mensaje = "<div class='error'>⚠️ No se realizaron cambios o ID inválido.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }
        .formulario {
            width: 400px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #2980b9;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #1c5980;
        }
        .exito {
            color: green;
            margin-top: 15px;
            text-align: center;
        }
        .error {
            color: red;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="formulario">
        <h2>Editar Usuario</h2>
        <form method="post">
            <label for="id_usuario">ID de Usuario:</label>
            <input type="number" name="id_usuario" id="id_usuario" required value="<?= htmlspecialchars($_POST['id_usuario'] ?? '') ?>">

            <?php if ($nombre_usuario !== ""): ?>
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?= htmlspecialchars($nombre_usuario) ?>" required>

                <label for="contraseña">Contraseña:</label>
                <input type="text" name="contraseña" id="contraseña" value="<?= htmlspecialchars($contrasena) ?>" required>

                <label for="nombre_completo">Nombre Completo:</label>
                <input type="text" name="nombre_completo" id="nombre_completo" value="<?= htmlspecialchars($nombre_completo) ?>" required>

                <button type="submit" name="actualizar">Actualizar Datos</button>
            <?php else: ?>
                <button type="submit" name="buscar">Buscar Usuario</button>
                <li><a href="admin.php">Volver</a></li>
            <?php endif; ?>
        </form>

        <?= $mensaje ?>
    </div>
</body>
</html>
