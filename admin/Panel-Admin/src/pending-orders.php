<?php
include_once "includes/header.php";
include_once "includes/slidebar.php";
include "../conexion.php";

date_default_timezone_set('Asia/Kolkata'); // change according timezone
$currentTime = date('d-m-Y h:i:s A', time());


?>



<div class="card card-purple card-outline">
	<div class="card-header">
		<h5 class="card-title">Pedidos Pendientes</h5>
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
						<th>Nombre</th>
						<th width="50">Email / No. Contacto</th>
						<th>Dirección de envío</th>
						<th>Tipo Venta</th>
						<th>Cantidad </th>
						<th>Valor Venta</th>
						<th>Fecha de Pedido</th>
						<th>Estado</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$status1 = 'Enviado';
					$status2 = 'Entregado';
					$query = mysqli_query($conexion, "select users.name as username,users.email as useremail,users.contactno as usercontact,
														users.shippingAddress as shippingaddress,users.shippingCity as shippingcity,users.shippingState as shippingstate,
														users.shippingPincode as shippingpincode ,orders.quantity as quantity,
														orders.orderDate as orderdate, s.total_price, s.sale_portal as tipeSale,orders.orderStatus as orderStatus,
														orders.id as idOrder , orders.sale_id as saleId
														from orders join users on  orders.userId=users.id 
														join sales s  on s.id = orders.sale_id
														where orders.orderStatus!='$status1' and orderStatus!='$status2'");
					$result = mysqli_num_rows($query);
					if ($result > 0) {
						$cnt = 1;
						while ($row = mysqli_fetch_assoc($query)) {
							if ($row['orderStatus'] == "Enviado") {
								$estado = '<span class="badge badge-pill badge-success">Enviado</span>';
							} else if ($row['orderStatus'] == "Entregado") {
								$estado = '<span class="badge badge-pill badge-success">Entregado</span>';
							} else if ($row['orderStatus'] == "En Progreso") {
								$estado = '<span class="badge badge-pill badge-danger">En Progreso</span>';
							}
					?>
							<tr>
								<td><?php echo htmlentities($row['idOrder']); ?></td>
								<td><?php echo htmlentities($row['username']); ?></td>
								<td><?php echo htmlentities($row['useremail']); ?>/<?php echo htmlentities($row['usercontact']); ?></td>
								<td><?php echo htmlentities($row['shippingaddress'] . "," . $row['shippingcity'] . "," . $row['shippingstate'] . "-" . $row['shippingpincode']); ?></td>
								<td><?php echo htmlentities($row['tipeSale']); ?></td>
								<td><?php echo htmlentities($row['quantity']); ?></td>
								<td><?php echo htmlentities(number_format($row['total_price'], 2, '.', ',')); ?></td>
								<td><?php echo htmlentities($row['orderdate']); ?></td>
								<td><?php echo $estado ?></td>
								<td>
									<?php
									if ($row['orderStatus'] != "Enviado" && $row['orderStatus'] != "Entregado") { ?>
										<a href="updateOrder.php?oid=<?php echo htmlentities($row['idOrder']); ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
										<br>
									<?php } ?>
									<br>
									<a href="detalle_de_venta.php?id=<?php echo $row['saleId']; ?>" class="btn btn-info"><i class='fas fa-info'></i></a>
								</td>
							</tr>

					<?php }
					} ?>
				</tbody>

			</table>
		</div>

		<?php if (isset($_GET['del'])) { ?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Vaya!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
			</div>
		<?php } ?>

		<br />
	</div>
</div>
<?php include_once "includes/footer.php"; ?>