<?php
require "../conexion.php";
$usuarios = mysqli_query($conexion, "SELECT * FROM users");
$totalU = mysqli_num_rows($usuarios);
$pedidos = mysqli_query($conexion, "SELECT * FROM orders WHERE orderStatus = 'EN PROGRESO'");
$totalPe = mysqli_num_rows($pedidos);
$productos = mysqli_query($conexion, "SELECT * FROM products");
$totalP = mysqli_num_rows($productos);
$ventas = mysqli_query($conexion, "SELECT * FROM sales");
$totalV = mysqli_num_rows($ventas);
include_once "includes/header.php"; ?>
<?php include_once "includes/slidebar.php";
?>



<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray">Panel de Administración</h1>
</div>

<!-- Content Row -->
<div class="row">
    <a class="col-xl-3 col-md-6 mb-4" href="usuarios.php">
        <div class="card border-left-primary shadow h-100 py-2 ">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Clientes Registrados</div>
                        <div class="h5 mb-0 text-dark font-weight-bold "><?php echo $totalU; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-success   text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Earnings (Monthly) Card Example -->
    <a class="col-xl-3 col-md-6 mb-4" href="pending-orders.php">
        <div class="card border-left-success shadow h-100 py-2 ">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Pedidos</div>
                        <div class="h5 mb-0 font-weight-bold text-dark"><?php echo $totalPe; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fas fa-truck fa-2x text-success  text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Earnings (Monthly) Card Example -->
    <a class="col-xl-3 col-md-6 mb-4" href="productos.php">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold  text-dark text-uppercase mb-1">Productos</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-dark"><?php echo $totalP; ?></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-success text-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Pending Requests Card Example -->
    <a class="col-xl-3 col-md-6 mb-4" href="ventas.php">
        <div class="card border-left-warning  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Ventas</div>
                        <div class="h5 mb-0 font-weight-bold text-dark"><?php echo $totalV; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-success text-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <div class="card">
                    <div class="card-header" style="background-color: #336B87; color: white">
                        <h3 class="card-title" style="font-size: 16px; font-style: inherit;">REPORTE GRÁFICO DE COMPRAS EN LOS ÚLTIMOS AÑOS</h3>
                        <div class="card-tools">
                            <button type="button" disabled="" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times" style="color: #336B87"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus" style="color: white"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <canvas id="graficoComprasUltimosAños" height="200"></canvas>
                        </div>
                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square" style="color: #336B87;"></i> Este Año
                            </span>
                            <span>
                                <i class="fas fa-square" style="color: #2a3132"></i> Año Pasado
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="card">
                    <div class="card-header" style="background-color: #505160; color: white">
                        <h3 class="card-title" style="font-size: 16px; font-style: inherit;">REPORTE GRÁFICO DE LOS 10 PRODUCTOS MÁS COMPRADOS</h3>
                        <div class="card-tools">
                            <button type="button" disabled="" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times" style="color: #505160"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus" style="color: white"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="graficoProductosMasVendidos" style="min-height: 350px; height: 350px; max-height: 700px; max-width: 700px;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3132; color: white">
                        <h3 class="card-title" style="font-size: 16px; font-style: inherit;">REPORTE GRÁFICO DE LAS COMPRAS REALIZADAS EN LAS ÚLTIMAS SEMANAS</h3>
                        <div class="card-tools">
                            <button type="button" disabled="" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times" style="color: #2a3132"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus" style="color: white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <canvas id="graficoComprasUltimasSemanas" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square" style="color: #2a3132;"></i> Esta Semana
                            </span>

                            <span>
                                <i class="fas fa-square" style="color: #336B87"></i> Semana Pasada
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="card">
                    <div class="card-header" style="background-color: #68829e; color: white">
                        <h3 class="card-title" style="font-size: 16px; font-style: inherit;">REPORTE GRÁFICO DE LOS 10 CLIENTES QUE MAS COMPRAN</h3>
                        <div class="card-tools">
                            <button type="button" disabled="" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times" style="color: #68829e"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus" style="color: white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="grafico10Clientes" style="min-height: 350px; height: 350px; max-height: 700px; max-width: 700px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function crearGrafico(idGrafico, etiquetas, datos, tipo = 'bar') {
            const ctx = document.getElementById(idGrafico).getContext('2d');
            const grafico = new Chart(ctx, {
                type: tipo,
                data: {
                    labels: etiquetas,
                    datasets: [{
                        label: 'Compras',
                        data: datos,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function cargar10ProductosMasVendidos() {
            fetch('top10ProductosMasVendidos.php')
                .then(response => response.json())
                .then(data => {
                    // Procesar los datos de cada gráfico
                    const productosMasVendidos = data.productosMasVendidos;
                    const comprasUltimosAnos = data.comprasUltimosAnos;
                    const comprasUltimasSemanas = data.comprasUltimasSemanas;
                    const clientesQueMasCompran = data.clientesQueMasCompran;

                    // Crear los gráficos
                    crearGrafico('graficoProductosMasVendidos', productosMasVendidos.nombresP, productosMasVendidos.contadores, 'pie');
                    crearGrafico('graficoComprasUltimosAños', comprasUltimosAnos.anos, comprasUltimosAnos.totales, 'pie');
                    crearGrafico('graficoComprasUltimasSemanas', comprasUltimasSemanas.semanas, comprasUltimasSemanas.totales, 'pie');
                    crearGrafico('grafico10Clientes', clientesQueMasCompran.clientes, clientesQueMasCompran.totales, 'pie');
                });

            // Cargar el gráfico cuando el DOM esté listo
            document.addEventListener('DOMContentLoaded', cargar10ProductosMasVendidos);
        }
        cargar10ProductosMasVendidos();
    </script>

    <?php include_once "includes/footer.php"; ?>