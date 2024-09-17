<?php
header('Content-Type: application/json');

try {
    // Incluir la conexión a la base de datos
    include('../conexion.php');

    // Consulta para obtener los 10 productos más vendidos
    $query = "SELECT p.productName AS nombre_producto, SUM(v.quantity_product) AS total_vendido
              FROM sale_detail v
              JOIN products p  ON p.id = v.product_id
              GROUP BY p.id
              ORDER BY total_vendido DESC
              LIMIT 10";

    $result = mysqli_query($conexion, $query);

    $nombresP = [];
    $contadores = [];
    // Recorrer los resultados
    while ($row = mysqli_fetch_assoc($result)) {
        $nombresP[] = $row['nombre_producto'];
        $contadores[] = $row['total_vendido'];
    }

    // Consulta para obtener las compras en los últimos años
    $query2 = "SELECT YEAR(s.creation_date) AS año, SUM(s.total_price) AS total_compras
                FROM sales s
                GROUP BY año
                ORDER BY año desc";

    $result2 = mysqli_query($conexion, $query2);

    $anos = [];
    $totales = [];
    while ($row = mysqli_fetch_assoc($result2)) {
        $anos[] = $row['año'];
        $totales[] = $row['total_compras'];
    }

    // Consulta para obtener las compras en las últimas semanas
    $query3 = "SELECT WEEK(s.creation_date) AS semana, SUM(s.total_price) AS total_compras
				FROM sales s
				WHERE s.creation_date >= NOW() - INTERVAL 1 MONTH
				GROUP BY semana
				ORDER BY semana desc";

    $result3 = mysqli_query($conexion, $query3);

    $semanas = [];
    $totales2 = [];
    while ($row = mysqli_fetch_assoc($result3)) {
        $semanas[] = $row['semana'];
        $totales2[] = $row['total_compras'];
    }

    // Consulta para obtener los 10 clientes que más compran
    $query4 = "SELECT c.name AS cliente, SUM(s.total_price) AS total_compras
            FROM sales s
            JOIN users c ON s.user_id = c.id
            GROUP BY cliente
            ORDER BY total_compras DESC
            LIMIT 10";

    $result4 = mysqli_query($conexion, $query4);

    $clientes = [];
    $totales3 = [];
    while ($row = mysqli_fetch_assoc($result4)) {
        $clientes[] = $row['cliente'];
        $totales3[] = $row['total_compras'];
    }

    // Devolver los datos en formato JSON
    echo json_encode([
        'productosMasVendidos' => ['nombresP' => $nombresP, 'contadores' => $contadores],
        'comprasUltimosAnos' => ['anos' => $anos, 'totales' => $totales],
        'comprasUltimasSemanas' => ['semanas' => $semanas, 'totales' => $totales2],
        'clientesQueMasCompran' => ['clientes' => $clientes, 'totales' => $totales3]
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al cargar los datos: ' . $e->getMessage()]);
}
