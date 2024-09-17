<?php
include "../conexion.php";

date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");


if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $fechaC = $_POST['fechaC'];
    $estado = $_POST['estado'];
    $alert = "";

    if (empty($nombre) || empty($fechaC) ||  !in_array($estado, array("0", "1"))) {

        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {

        $query_insert = mysqli_query($conexion, "INSERT INTO positions(name,status) values ( '$nombre','$estado')");
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">
               Rol  Registrado
              </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el  Rol
              </div>';
        }
    }
}


include_once "includes/header.php";
include_once "includes/slidebar.php";
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid p-0">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">Rol Empleado</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Registros</a></li>
                    <li class="breadcrumb-item active">Roles </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Roles Empleados</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-rol"><i class="fas fa-file-signature"></i> Nuevo Registro</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php echo isset($alert) ? $alert : ''; ?>

<br>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nombre </th>
                <th>Estado </th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT * FROM positions");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    if ($data['status'] == "1") {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
            ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $estado ?></td>
                        <td>
                            <?php if ($data['status'] == "1") { ?>

                                <a href="editar_roles_usuarios.php?id=<?php echo $data['id']; ?>" class="btn btn-success" ><i class='fas fa-edit'></i></a>
                            
                                <form action="eliminar_roles.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit" ><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>

    </table>
</div>


<div class="modal fade" id="modal-rol">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo" class="modal-title">Formulario De Registro Rol Usuario</h4>
                <button onclick="cancelarPeticion();" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="post" autocomplete="off" id="frmRol" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Nombre de Rol</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                                    </div>
                                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresar Nombre Rol">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Fecha Creación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" required="" name="fechaC" id="fechaC" class="form-control" value="<?php echo $fechaHoraActual; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Estado</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="1">ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer clearfix">
                    <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Registrar Rol</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php include_once "includes/footer.php"; ?>