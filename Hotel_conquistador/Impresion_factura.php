<?php
session_start();
require_once 'includes/conexion.php';

$id_reserva = filter_input(INPUT_POST, 'id_reserva', FILTER_VALIDATE_INT);
$factura = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id_reserva) {
        $sql = "SELECT r.*, c.nombre, c.dni, c.telefono, c.email, h.numero, h.tipo, h.precio
                FROM reserva r
                JOIN cliente c ON r.id_cliente = c.id_cliente
                JOIN habitacion h ON r.id_habitacion = h.id_habitacion
                WHERE r.id_reserva = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_reserva]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $fechaEntrada = new DateTime($row['fecha_entrada']);
            $fechaSalida = new DateTime($row['fecha_salida']);
            $dias = max(1, $fechaSalida->diff($fechaEntrada)->days);
            $total = $dias * $row['precio'];

            $factura = <<<HTML
            <div class="factura">
                <h2>Factura de Reserva</h2>
                <hr>
                <h3>Datos del Cliente</h3>
                <p><strong>Nombre:</strong> {$row['nombre']}</p>
                <p><strong>DNI:</strong> {$row['dni']}</p>
                <p><strong>Teléfono:</strong> {$row['telefono']}</p>
                <p><strong>Email:</strong> {$row['email']}</p>
                <h3>Datos de la Reserva</h3>
                <p><strong>ID Reserva:</strong> {$row['id_reserva']}</p>
                <p><strong>Fecha Entrada:</strong> {$row['fecha_entrada']}</p>
                <p><strong>Fecha Salida:</strong> {$row['fecha_salida']}</p>
                <p><strong>Número de Personas:</strong> {$row['numero_personas']}</p>
                <h3>Habitación</h3>
                <p><strong>Número:</strong> {$row['numero']}</p>
                <p><strong>Tipo:</strong> {$row['tipo']}</p>
                <p><strong>Precio por noche:</strong> \$ {$row['precio']}</p>
                <hr>
                <p><strong>Días:</strong> {$dias}</p>
                <p><strong>Total:</strong> \$$total </p>
            </div>
            <button onclick="window.print()">Imprimir Factura</button>
            HTML;
        } else {
            $factura = '<div class="error">No se encontró la reserva.</div>';
        }
        $stmt->closeCursor();
    } else {
        $factura = '<div class="error">No se especificó una reserva válida.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Impresión de Factura</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <button onclick="window.print()">Imprimir Factura</button>
    <button id="descargarPDF">Descargar Factura (PDF)</button>


    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('el-dorado-maroma-1.webp') no-repeat center center fixed;
        }
        .factura {
            width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2, h3 {
            color: #2c3e50;
        }
        .error {
            color: #c0392b;
            text-align: center;
            margin-top: 30px;
        }
        button {
            display: block;
            margin: 30px auto 0 auto;
            padding: 10px 20px;
            background: #2980b9;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #1c5980;
        }
        @media print {
            button { display: none; }
            .factura { box-shadow: none; }
        }
        form {
            width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #2c3e50;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        a {
            color: #2980b9;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        h3 a {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <h2>Buscar Reserva para Facturar</h2>
        <label for="id_reserva">ID de Reserva:</label>
        <input type="number" name="id_reserva" id="id_reserva" required value="<?= htmlspecialchars($id_reserva ?? '') ?>" />
        <button type="submit">Buscar</button>
        <h3><a href="Menú.php">Volver</a></h3>
    </form>

    <?= $factura ?>


<script>
    document.getElementById('descargarPDF')?.addEventListener('click', async function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const content = document.querySelector('.factura');
        if (!content) return;

        // Convertimos el contenido HTML a texto plano
        let text = content.innerText;
        let lines = doc.splitTextToSize(text, 180);

        doc.setFont("helvetica", "normal");
        doc.setFontSize(12);
        doc.text(lines, 15, 20);

        // Guarda el archivo
        doc.save('Factura_Reserva.pdf');
    });
</script>


</body>
</html>
