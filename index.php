<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_GET['action']) && $_GET['action'] == "add") {
	$id = intval($_GET['id']);
	if (isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]['quantity']++;
	} else {
		$sql_p = "SELECT * FROM products WHERE id={$id}";
		$query_p = mysqli_query($con, $sql_p);
		if (mysqli_num_rows($query_p) != 0) {
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
		} else {
			$message = "Product ID is invalid";
		}
	}
	echo "<script>alert('Product has been added to the cart')</script>";
	echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">

	<title>JambEcommerce Portal Home </title>

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Customizable CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/green.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css">
	<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
	<link href="assets/css/lightbox.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/rateit.css">
	<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

	<!-- Demo Purpose Only. Should be removed in production -->
	<link rel="stylesheet" href="assets/css/config.css">

	<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
	<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
	<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
	<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
	<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<style type="text/css">


	</style>

</head>

<body class="cnt-home" >



	<!-- ============================================== HEADER ============================================== -->
	<header class="header-style-1">
		<?php include('includes/top-header.php'); ?>
		<?php include('includes/main-header.php'); ?>
		<?php include('includes/menu-bar.php'); ?>
	</header>

	<!-- ============================================== HEADER : END ============================================== -->
	<div class="body-content outer-top-xs" id="top-banner-and-menu">
		<div class="container">
			<div class="furniture-container homepage-container">
				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
						<!-- ================================== TOP NAVIGATION ================================== -->
						<?php include('includes/side-menu.php'); ?>
						<!-- ================================== TOP NAVIGATION : END ================================== -->
					</div><!-- /.sidemenu-holder -->

					<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
						<!-- ========================================== SECTION – HERO ========================================= -->

						<div id="hero" class="homepage-slider3">
							<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
								<div class="full-width-slider">
									<div class="item" style="background-image: url(assets/images/sliders/banner1.gif); width: 100%; height: 350px;">
										<!-- /.container-fluid -->
									</div><!-- /.item -->
								</div><!-- /.full-width-slider -->

								<div class="full-width-slider">
									<div class="item full-width-slider" style="background-image: url(assets/images/sliders/banner2.gif); width: 100%; height: 350px;">
									</div><!-- /.item -->
								</div><!-- /.full-width-slider -->

								<div class="full-width-slider">
									<div class="item">
										<img src="assets/images/sliders/banner3.gif">
										<!-- /.container-fluid -->
									</div><!-- /.item -->
								</div><!-- /.full-width-slider -->

								<div class="full-width-slider">
									<div class="item full-width-slider" style="background-image: url(assets/images/sliders/bannerC2.jpg); width: 100%; height: 350px;">
									</div><!-- /.item -->
								</div><!-- /.full-width-slider -->

								<div class="full-width-slider">
									<div class="item full-width-slider">
										<img src="assets/images/sliders/adidas.jfif" style="width:100%; height:350px" alt="">
									</div><!-- /.item -->
								</div><!-- /.full-width-slider -->

								<div class="full-width-slider">
									<div class="item full-width-slider" style="background-image: url(assets/images/sliders/banner6.gif);">
									</div><!-- /.item -->
								</div><!-- /.full-width-slider -->

							</div><!-- /.owl-carousel -->
						</div>

						<!-- ========================================= SECTION – HERO : END ========================================= -->
						<!-- ============================================== INFO BOXES ============================================== -->
						<div class="info-boxes wow fadeInUp">
							<div class="info-boxes-inner">
								<div class="row">
									<div class="col-md-6 col-sm-4 col-lg-4">
										<div class="info-box" style="border-color:  #262626;">
											<div class="row">
												<div class="col-xs-2">
													<i class="icon fa fa-dollar"></i>
												</div>
												<div class="col-xs-10">
													<h4 class="info-box-heading green" style="color: #008000;">Reembolso</h4>
												</div>
											</div>
											<h6 class="text">Garantía de devolución de dinero de 30 días.</h6>
										</div>
									</div><!-- .col -->

									<div class="hidden-md col-sm-4 col-lg-4">
										<div class="info-box" style="border-color:  #262626;">
											<div class="row">
												<div class="col-xs-2">
													<i class="icon fa fa-truck"></i>
												</div>
												<div class="col-xs-10">
													<h4 class="info-box-heading orange">Envío gratis</h4>
												</div>
											</div>
											<h6 class="text">Envío gratis en pedidos superiores a $. 300.000</h6>
										</div>
									</div><!-- .col -->

									<div class="col-md-6 col-sm-4 col-lg-4">
										<div class="info-box" style="border-color:  #262626;">
											<div class="row">
												<div class="col-xs-2">
													<i class="icon fa fa-gift"></i>
												</div>
												<div class="col-xs-10">
													<h4 class="info-box-heading red">Descuentos</h4>
												</div>
											</div>
											<h6 class="text">Ofertas hasta 70 % de descuento </h6>
										</div>
									</div><!-- .col -->
								</div><!-- /.row -->
							</div><!-- /.info-boxes-inner -->

						</div><!-- /.info-boxes -->
						<!-- ============================================== INFO BOXES : END ============================================== -->
					</div><!-- /.homebanner-holder -->

				</div><!-- /.row -->
				<br>
				<!-- ============================================== SCROLL TABS ============================================== -->
				<div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
					<div class="more-info-tab clearfix">
						<h3 class="new-product-title pull-left">Productos destacados</h3>
						<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
							<li class="active"><a href="#all" data-toggle="tab">Todos</a></li>
							<li><a href="#books" data-toggle="tab">Calzado</a></li>
							<li><a href="#furniture" data-toggle="tab">Accesorios</a></li>
						</ul><!-- /.nav-tabs -->
					</div>

					<div class="tab-content outer-top-xs">
						<div class="tab-pane in active" id="all">
							<div class="product-slider">
								<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
									<?php
									$ret = mysqli_query($con, "select * from products");
									while ($row = mysqli_fetch_array($ret)) {
										# code...


									?>


										<div class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<?php if ($row['discount'] > 0) { ?>
															<span class="badge badge-danger" style="background-color: red;">-<?php echo $row['discount']; ?>%</span>
														<?php } ?>
														<div class="image">
															<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
																<img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="180" height="300" alt=""></a>
														</div><!-- /.image -->


													</div><!-- /.product-image -->


													<div class="product-info text-left">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																$.<?php echo htmlentities($row['productPrice']); ?> </span>
															<?php
															if ($row['discount'] > 0) {
																$productPriceBeforeDiscount = $row['productPrice'] - ($row['productPrice'] * ($row['discount'] / 100)); ?>
																<span class="price-before-discount">$. <?php echo htmlentities($productPriceBeforeDiscount); ?> </span>

															<?php
															}
															?>


														</div><!-- /.product-price -->

													</div><!-- /.product-info -->
													<?php if ($row['stock'] == 'In Stock') { ?>
														<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Agregar al carrito</a></div>
													<?php } else { ?>
														<div class="action" style="color:red">Fuera de Stock</div>
													<?php } ?>
												</div><!-- /.product -->

											</div><!-- /.products -->
										</div><!-- /.item -->
									<?php } ?>

								</div><!-- /.home-owl-carousel -->
							</div><!-- /.product-slider -->
						</div>




						<div class="tab-pane" id="books">
							<div class="product-slider">
								<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
									<?php
									$ret = mysqli_query($con, "select * from products where category=15");
									while ($row = mysqli_fetch_array($ret)) {
										# code...


									?>


										<div class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<?php if ($row['discount'] > 0) { ?>
															<span class="badge badge-danger" style="background-color: red;">-<?php echo $row['discount']; ?>%</span>
														<?php } ?>
														<div class="image">
															<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
																<img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="180" height="300" alt=""></a>
														</div><!-- /.image -->


													</div><!-- /.product-image -->


													<div class="product-info text-left">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																$. <?php echo htmlentities($row['productPrice']); ?> </span>
															<?php
															if ($row['discount'] > 0) {
																$productPriceBeforeDiscount = $row['productPrice'] - ($row['productPrice'] * ($row['discount'] / 100)); ?>
																<span class="price-before-discount">$.<?php echo htmlentities($productPriceBeforeDiscount); ?></span>
															<?php

															}
															?>


														</div><!-- /.product-price -->

													</div><!-- /.product-info -->
													<?php if ($row['stock'] == 'In Stock') { ?>
														<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Agregar al carrito</a></div>
													<?php } else { ?>
														<div class="action" style="color:red">Fuera de Stock</div>
													<?php } ?>
												</div><!-- /.product -->

											</div><!-- /.products -->
										</div><!-- /.item -->
									<?php } ?>


								</div><!-- /.home-owl-carousel -->
							</div><!-- /.product-slider -->
						</div>






						<div class="tab-pane" id="furniture">
							<div class="product-slider">
								<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
									<?php
									$ret = mysqli_query($con, "select * from products where category=18");
									while ($row = mysqli_fetch_array($ret)) {
									?>


										<div class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<?php if ($row['discount'] > 0) { ?>
															<span class="badge badge-danger" style="background-color: red;">-<?php echo $row['discount']; ?>%</span>
														<?php } ?>
														<div class="image">
															<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
																<img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="180" height="300" alt=""></a>
														</div>


													</div>


													<div class="product-info text-left">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																$.<?php echo htmlentities($row['productPrice']); ?> </span>
															<?php
															if ($row['discount'] > 0) {
																$productPriceBeforeDiscount = $row['productPrice'] - ($row['productPrice'] * ($row['discount'] / 100)); ?>
																<span class="price-before-discount">$. <?php echo htmlentities($productPriceBeforeDiscount); ?></span>
															<?php
															}
															?>


														</div>

													</div>
													<?php if ($row['stock'] == 'In Stock') { ?>
														<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Agregar al carrito</a></div>
													<?php } else { ?>
														<div class="action" style="color:red">Fuera de Stock</div>
													<?php } ?>
												</div>

											</div>
										</div>
									<?php } ?>


								</div>
							</div>
						</div>
					</div>
				</div>


				<!-- ============================================== TABS ============================================== -->
				<div class="sections prod-slider-small outer-top-small">
					<div class="row">
						<div class="col-md-6">
							<section class="section">
								<h3 class="section-title">Calzado</h3>
								<div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">

									<?php
									$ret = mysqli_query($con, "select * from products where category=18");
									while ($row = mysqli_fetch_array($ret)) {
									?>



										<div class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<?php if ($row['discount'] > 0) { ?>
															<span class="badge badge-danger " style="background-color: red;">-<?php echo $row['discount']; ?>%</span>
														<?php } ?>
														<div class="image">
															<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="150" height="200"></a>
														</div><!-- /.image -->

													</div><!-- /.product-image -->


													<div class="product-info text-left">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																$. <?php echo htmlentities($row['productPrice']); ?> </span>

															<?php if ($row['discount'] > 0) {
																$productPriceBeforeDiscount = $row['productPrice'] - ($row['productPrice'] * ($row['discount'] / 100)); ?>
																<span class="price-before-discount">$. <?php echo htmlentities($productPriceBeforeDiscount); ?></span>
															<?php
															}
															?>



														</div>

													</div>
													<?php if ($row['stock'] == 'In Stock') { ?>
														<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Agregar al carrito</a></div>
													<?php } else { ?>
														<div class="action" style="color:red">Fuera de Stock</div>
													<?php } ?>
												</div>
											</div>
										</div>
									<?php } ?>


								</div>
							</section>
						</div>
						<div class="col-md-6">
							<section class="section">
								<h3 class="section-title">Accesorios</h3>
								<div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">
									<?php
									$ret = mysqli_query($con, "select * from products where category=19");
									while ($row = mysqli_fetch_array($ret)) {
									?>



										<div class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
													</div><!-- /.image -->
													<?php if ($row['discount'] > 0) { ?>
														<span class="badge badge-danger" style="background-color: red;">-<?php echo $row['discount']; ?>%</span>
													<?php } ?>
													<div class="image">
														<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"class="img-fluid"></a>

													</div><!-- /.product-image -->


													<div class="product-info text-left">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																$ .<?php echo htmlentities($row['productPrice']); ?> </span>
															<?php
															if ($row['discount'] > 0) {
																$productPriceBeforeDiscount = $row['productPrice'] - ($row['productPrice'] * ($row['discount'] / 100)); ?>
																<span class="price-before-discount">$. <?php echo htmlentities($productPriceBeforeDiscount); ?></span>
															<?php
															}
															?>
														</div>

													</div>
													<?php if ($row['stock'] == 'In Stock') { ?>
														<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Agregar al carrito</a></div>
													<?php } else { ?>
														<div class="action" style="color:red">Fuera de Stock</div>
													<?php } ?>
												</div>
											</div>
										</div>
									<?php } ?>



								</div>
							</section>

						</div>
					</div>
				</div>
				<!-- ============================================== TABS : END ============================================== -->



				<section class="section featured-product inner-xs wow fadeInUp">
					<h3 class="section-title">Moda</h3>
					<div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
						<?php
						$ret = mysqli_query($con, "select * from products where category=17");
						while ($row = mysqli_fetch_array($ret)) {
							# code...


						?>
							<div class="item">
								<div class="products">




									<div class="product">
										<div class="product-micro">
											<div class="row product-micro-row">
												<div class="col col-xs-6">
													<div class="product-image">
														<?php if ($row['discount'] > 0) { ?>
															<span class="badge badge-danger " style="background-color: red;">-<?php echo $row['discount']; ?>%</span>
														<?php } ?>
														<div class="image">
															<a href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']); ?>">
																<img data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="170" height="174" alt="">
																<div class="zoom-overlay"></div>
															</a>
														</div><!-- /.image -->


													</div><!-- /.product-image -->
												</div><!-- /.col -->
												<div class="col col-xs-6">
													<div class="product-info">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="product-price">
															<span class="price">
																$. <?php echo htmlentities($row['productPrice']); ?>
															</span>

														</div><!-- /.product-price -->
														<?php if ($row['stock'] == 'In Stock') { ?>
															<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Agregar al carrito</a></div>
														<?php } else { ?>
															<div class="action" style="color:red">Fuera de Stock</div>
														<?php } ?>
													</div>
												</div><!-- /.col -->
											</div><!-- /.product-micro-row -->
										</div><!-- /.product-micro -->
									</div>


								</div>
							</div><?php } ?>
					</div>
				</section>
				<?php include('includes/brands-slider.php'); ?>
			</div>
		</div>
		<?php include('includes/footer.php'); ?>

		<script src="assets/js/jquery-1.11.1.min.js"></script>

		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>

		<script src="assets/js/echo.min.js"></script>
		<script src="assets/js/jquery.easing-1.3.min.js"></script>
		<script src="assets/js/bootstrap-slider.min.js"></script>
		<script src="assets/js/jquery.rateit.min.js"></script>
		<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
		<script src="assets/js/bootstrap-select.min.js"></script>
		<script src="assets/js/wow.min.js"></script>
		<script src="assets/js/scripts.js"></script>


</body>

</html>