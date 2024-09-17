<?php
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['email']) || empty($_POST['identificacion']) || empty($_POST['password']) || empty($_POST['confirmpassword'])) {
        $alert = '<div class="alert alert-danger" role="alert">
            Ingrese todos los campos
            </div>';
    } else if ( $_POST['password'] == $_POST['confirmpassword'] ){
        require_once "../conexion.php";
        $email = mysqli_real_escape_string($conexion, $_POST['email']);
        $identification = mysqli_real_escape_string($conexion, $_POST['identificacion']);
        $clave = md5(mysqli_real_escape_string($conexion, $_POST['password']));
        $confirmClave = md5(mysqli_real_escape_string($conexion, $_POST['confirmpassword']));

        $queryEmploye = mysqli_query($conexion, "SELECT * from employees e  where e.email = '$email' and e.identification = '$identification' and e.status = '1'");

        $resultado = mysqli_num_rows($queryEmploye);
        if ($resultado > 0) {
            $dato = mysqli_fetch_array($queryEmploye);
            $idUser = $dato['id'];

            $queryAdmin = mysqli_query($conexion, "SELECT * from admin a  where a.employee_id = '$idUser' ");
            $resultado2 = mysqli_num_rows($queryAdmin);

            if ($resultado2 > 0) {
                $dato2 = mysqli_fetch_array($queryAdmin);
                $idAdmin = $dato2['id'];

                $query2 = mysqli_query($conexion, "UPDATE admin SET  password = '$clave', updationDate = '$fechaHoraActual' where id = '$idAdmin' ");

                mysqli_close($conexion);

                header('location: ../index.php');
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                Usuario no tiene acceso al sistema
                </div>';
            }
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Usuario no encontrado en sistema
                </div>';
        }
    }else {
        $alert = '<div class="alert alert-danger" role="alert">
                Las contraseñas no coinciden verifique de nuevo
            </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Iniciar Sessión</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <script src="../assets/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #F7F7F7;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-5 rounded-lg mt-5" style="border-color: black;">
                                <div class="card-header text-center">
                                    <h5 class="font-weight-light my-4">Recuperar Contraseña</h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label class="small mb-1" for="email"><i class="fas fa-user"></i> Email <span style="color: red;">*</span></label>
                                            <input class="form-control py-4" id="email" name="email" type="email" placeholder="Ingrese usuario" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="identificacion"><i class="fas fa-id-card"></i> Identificación <span style="color: red;">*</span></label>
                                            <input class="form-control py-4" id="identificacion" name="identificacion" type="number" placeholder="Ingrese Contraseña" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="password"><i class="fas fa-key"></i> Contraseña <span style="color: red;">*</span></label>
                                            <input type="password" class="form-control unicase-form-control text-input" id="password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="confirmpassword"><i class="fas fa-key"></i> Confirmar Contraseña <span style="color: red;">*</span></label>
                                            <input type="password" class="form-control unicase-form-control text-input" id="confirmpassword" name="confirmpassword" required>
                                            <?php echo isset($alert) ? $alert : ''; ?>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit">Enviar</button>
                                            </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <a href="http://angelsifuentes.com/" target="_blank" rel="noopener noreferrer">Visite mi página web</a> <?php echo date("Y"); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../assets/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>