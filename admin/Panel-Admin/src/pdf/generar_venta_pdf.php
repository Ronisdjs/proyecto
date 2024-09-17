<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';

// Crear el PDF
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetTitle("Factura de Venta");

// Logo de la empresa
$pdf->Image("../../assets/img/logo.png", 180, 10, 30, 30, 'PNG');

// Encabezado de la empresa
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(195, 5, utf8_decode("JAMB-E-COMMERCE - FACTURA DE VENTA"), 0, 1, 'C');
$pdf->Ln(5); // Espacio entre secciones

// Obtener los datos del cliente
$idcliente = intval($_GET['cl']);
$clientes = mysqli_query($conexion, "SELECT * FROM users WHERE id = $idcliente");
$datosC = mysqli_fetch_assoc($clientes);

// Información del cliente
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Nombre: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, utf8_decode($datosC['name']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, "Email: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, utf8_decode($datosC['email']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, "Dirección: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, utf8_decode($datosC['shippingAddress']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, "Teléfono: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, utf8_decode($datosC['contactno']), 0, 1, 'L');

$pdf->Ln(10); // Espacio entre secciones

// Encabezado de la tabla de productos
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "Detalle de Producto", 1, 1, 'C', 1);

// Columnas de la tabla
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(10, 5, utf8_decode('N°'), 1, 0, 'L');
$pdf->Cell(70, 5, utf8_decode('Descripción'), 1, 0, 'L');
$pdf->Cell(25, 5, 'Cantidad', 1, 0, 'L');
$pdf->Cell(32, 5, 'Precio Unit.', 1, 0, 'L');
$pdf->Cell(25, 5, 'Descuento', 1, 0, 'L');
$pdf->Cell(34, 5, 'Total Producto', 1, 1, 'L');

// Obtener los detalles de la venta
$idventa = intval($_GET['v']);
$ventas = mysqli_query($conexion, "SELECT d.*, p.productName, p.discount, s.total_price, s.tax_iva FROM sale_detail d INNER JOIN products p ON d.product_id = p.id INNER JOIN sales s ON s.id = d.sale_id WHERE d.sale_id = $idventa");

// Detalles del carrito
$pdf->SetFont('Arial', '', 10);
$contador = 1;
$total_venta = 0;

while ($row = mysqli_fetch_assoc($ventas)) {
    $subtotal_producto = $row['price_discount'];
    $total_venta = $row['total_price'];
    $iva = $row['tax_iva'];
    $envio = 0;

    // Imprimir las celdas sin validaciones adicionales
    $pdf->Cell(10, 5, $contador, 1, 0, 'L');
    $pdf->Cell(70, 5, utf8_decode($row['productName']), 1, 0, 'L');
    $pdf->Cell(25, 5, $row['quantity_product'], 1, 0, 'L');
    $pdf->Cell(32, 5, number_format($row['unit_price'], 2, '.', ','), 1, 0, 'L');
    $pdf->Cell(25, 5, $row['discount'] . '%', 1, 0, 'L');
    $pdf->Cell(34, 5, number_format($subtotal_producto, 2, '.', ','), 1, 1, 'L');

    $contador++;
}
$pdf->Ln(10); // Espacio antes del total

// Mostrar envio de la venta
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(160, 5, 'Envio: ', 0, 0, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(36, 5, '$' . number_format($envio, 2, '.', ','), 0, 1, 'L');

// Mostrar iva de la venta
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(160, 5, 'Iva 19%: ', 0, 0, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(36, 5, '$' . number_format($iva, 2, '.', ','), 0, 1, 'L');

// Mostrar total de la venta
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(160, 5, 'Total de la Venta: ', 0, 0, 'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(36, 5, '$' . number_format($total_venta, 2, '.', ','), 0, 1, 'L');

// Descargar el PDF
$pdf->Output("factura_de_venta_id_" . $idventa . ".pdf", "D");
// Termina el script para que no continúe
ob_end_clean();  // Limpia el búfer de salida si es necesario
// Redirigir a la página de ventas después de generar el PDF
header('Location: ../ventas.php');
exit();
?>
