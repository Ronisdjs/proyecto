<?php
//session_start();

?>

<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled" >

					<?php if (strlen($_SESSION['login'])) {   ?>
						<li><a href="#" style="color: white;"><i class="icon fa fa-user"></i>Bienvenido -<?php echo htmlentities($_SESSION['username']); ?></a></li>
					<?php } ?>

					<li><a href="my-account.php" style="color: white;"><i class="icon fa fa-user"></i>Mi Cuenta</a></li>
					<li><a href="my-wishlist.php" style="color: white;"><i class="icon fa fa-heart"></i>Mi Lista de Deseos</a></li>
					<li><a href="my-cart.php" style="color: white;"><i class="icon fa fa-shopping-cart"></i>Mi Carrito</a></li>
					<?php if (strlen($_SESSION['login']) == 0) {   ?>
						<li><a href="login.php" style="color: white;"><i class="icon fa fa-sign-in"></i>Inicio Sesion</a></li>
						<li><a href="admin/Panel-Admin/" style="color: white;"><i class="icon fa fa-shopping-cart"></i>Portal Admin</a></li>
					<?php } else { ?>

						<li><a href="logout.php" style="color: white;"><i class="icon fa fa-sign-out"></i>Cerrar Sesion</a></li>
					<?php } ?>
				</ul>
			</div><!-- /.cnt-account -->

			<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
						<a href="track-orders.php" class="dropdown-toggle"><span class="key">Seguir Order/ pedido</b></a>

					</li>


				</ul>
			</div>

			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->