<?php
require_once 'includes/conexion.php';
$usuario = null;
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['buscar'])) {
        $id_usuario = $_POST['id_usuario'];
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $mensaje = "<div class='error'>❌ Usuario no encontrado.</div>";
        }

    } elseif (isset($_POST['eliminar'])) {
        $id_usuario = $_POST['id_usuario'];
        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_usuario]);

        if ($stmt->rowCount() > 0) {
            $mensaje = "<div class='exito'>✅ Usuario eliminado correctamente.</div>";
            $usuario = null;
        } else {
            $mensaje = "<div class='error'>❌ No se pudo eliminar el usuario.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #c0392b;
        }
        .mensaje {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            border-radius: 6px;
        }
        .exito {
            background-color: #eafaf1;
            color: #27ae60;
        }
        .error {
            background-color: #fdecea;
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Eliminar Usuario</h2>
        <form method="post">
            <label for="id_usuario">ID del Usuario:</label>
            <input type="number" name="id_usuario" id="id_usuario" required value="<?= htmlspecialchars($_POST['id_usuario'] ?? '') ?>">
            <button type="submit" name="buscar">Buscar</button>
            <li><a href="admin.php">Volver</a></li>
        </form>

        <?php if ($usuario): ?>
            <form method="post">
                <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">
                <p><strong>Nombre de usuario:</strong> <?= htmlspecialchars($usuario['nombre_usuario']) ?></p>
                <p><strong>Nombre completo:</strong> <?= htmlspecialchars($usuario['nombre_completo']) ?></p>
                <p><strong>Rol:</strong> <?= htmlspecialchars($usuario['rol']) ?></p>
                <button type="submit" name="eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar Usuario</button>
            </form>
        <?php endif; ?>

        <?php if ($mensaje): ?>
            <div class="mensaje <?= strpos($mensaje, '✅') !== false ? 'exito' : 'error' ?>"><?= $mensaje ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
