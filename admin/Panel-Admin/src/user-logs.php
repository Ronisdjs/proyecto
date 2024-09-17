<?php
include "../conexion.php";
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administrador | Usuarios logs</title>
</head>

<body>
	<?php
	include_once "includes/header.php";
	include_once "includes/slidebar.php";
	?>


	<div class="card card-purple card-outline">
		<div class="card-header">
			<h5 class="card-title">Sesiones De Usuario</h5>
		</div>
		<div class="card-body">
			<div class="module-body">
				<h4 id="titulo" class="modal-title"></h4>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tbl">
					<thead class="thead-dark">
						<tr>
							<th>Id</th>
							<th>Email Usuario </th>
							<th>User IP </th>
							<th>Hora de inicio de sesión </th>
							<th>Hora de cierre de sesión </th>
							<th>Estado </th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conexion, "select * from userlog");
						$cnt = 1;
						while ($row = mysqli_fetch_array($query)) {
						?>
							<tr>
								<td><?php echo htmlentities($cnt); ?></td>
								<td><?php echo htmlentities($row['userEmail']); ?></td>
								<td><?php echo htmlentities($row['userip']); ?></td>
								<td> <?php echo htmlentities($row['loginTime']); ?></td>
								<td><?php echo htmlentities($row['logout']); ?></td>
								<td><?php $st = $row['status'];

									if ($st == 1) {
										echo "Successfull";
									} else {
										echo "Failed";
									}
									?></td>


							<?php $cnt = $cnt + 1;
						} ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</body>
<?php include_once "includes/footer.php"; ?>