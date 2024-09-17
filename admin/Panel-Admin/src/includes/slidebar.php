<?php
include '../conexion.php';
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Administración</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.min.css">
    <script src="../assets/js/all.min.js" crossorigin="anonymous"></script>
    <link type="text/css" href="../../images/icons/css/font-awesome.css" rel="stylesheet">

</head>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu ">
                    <div class="nav">



                        <a class="nav-link" data-toggle="collapse" href="#togglePages">
                            <i class="fas fa-cogs"></i>

                            <div class="sb-nav-link-icon"></i></div>
                            Gestion de Pedidos
                            <i class="fas fa-chevron-down float-right ml-2"></i>
                        </a>

                        <ul id="togglePages" class="unstyled collapse" style="padding-left: 2; margin-left: 0;">

                            <a class="nav-link d-flex justify-content-between align-items-center" href="todays-orders.php">
                                <i class="fas fa-tasks"></i>
                                <span class="me-2">Hoy</span>
                                <?php
                                include '../conexion.php';
                                $f1 = "00:00:00";
                                $from = date('Y-m-d') . " " . $f1;
                                $t1 = "23:59:59";
                                $to = date('Y-m-d') . " " . $t1;

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, "SELECT * FROM orders WHERE orderDate BETWEEN '$from' AND '$to'");
                                $num_rows1 = mysqli_num_rows($result); {
                                ?>
                                    <span class="badge bg-warning text-dark ms-auto"><?php echo htmlentities($num_rows1); ?></span>
                                <?php } ?>
                            </a>


                            <a class="nav-link d-flex justify-content-between align-items-center" href="pending-orders.php">
                                <i class="fas fa-tasks"></i>
                                <span class="me-2">Pendientes</span>
                                <?php
                                $status = 'Enviado';
                                $status2 = 'Entregado';
                                $ret = mysqli_query($conexion, "SELECT * FROM Orders where orderStatus!='$status' and orderStatus!='$status2'");
                                $num = mysqli_num_rows($ret); { ?>
                                    <span class="badge bg-warning text-dark ms-auto"><?php echo htmlentities($num); ?></span>
                                <?php } ?>
                            </a>

                            <a class="nav-link d-flex justify-content-between align-items-center" href="delivered-orders.php">
                                <i class="fas fa-inbox"></i>
                                Enviados
                                <?php
                                $status = 'Enviado';
                                $ret = mysqli_query($conexion, "SELECT * FROM Orders where orderStatus='$status'");
                                $nume = mysqli_num_rows($ret); { ?>
                                    <b class="badge bg-success text-dark float-end"><?php echo htmlentities($nume); ?></b>
                                <?php } ?>
                            </a>

                        </ul>



                        <a class="nav-link" href="categorias.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Categorias
                        </a>
                        <a class="nav-link" href="subCategorias.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-ul"></i></div>
                            Sub Categorias
                        </a>
                        <a class="nav-link" href="marcas.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-copyright"></i></div>
                            Marcas
                        </a>
                        <a class="nav-link" href="productos.php">
                            <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                            Productos
                        </a>
                        <a class="nav-link" href="empleado.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                            Empleados
                        </a>
                        <a class="nav-link" href="clientes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="ventas.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                            Ventas
                        </a>
                        <a class="nav-link" href="proveedores.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Proveedores
                        </a>

                        <a class="nav-link" href="roles_usuarios.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Roles
                        </a>

                        <a class="nav-link" data-toggle="collapse" href="#togglePages2">
                            <i class="fas fa-cog"></i>

                            <div class="sb-nav-link-icon"></i></div>
                            Configuración 
                            <i class="fas fa-chevron-down float-right ml-2"></i>
                        </a>

                        <ul id="togglePages2" class="unstyled collapse" style="padding-left: 2; margin-left: 0;">

                            <a class="nav-link d-flex justify-content-between align-items-center" href="user-logs.php">
                                <i class="fas fa-sign-in-alt"></i>
                                <span class="me-2">Sesiones de usuario</span>
                            </a>


                            <a class="nav-link d-flex justify-content-between align-items-center" href="config.php">
                                <i class="fas fa-wrench"></i><span class="me-2">Configuración </span>
                            </a>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-2">