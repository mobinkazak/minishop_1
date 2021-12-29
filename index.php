<?php require_once 'loader.php' ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
	<title>صفحه اصلی | <?php print BRAND_NAME; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">

	<!-- Font -->

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">


	<!-- Magnific Popup -->
	<link href="css/magnific-popup.css" rel="stylesheet">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skin-lblue.css">

	<link rel="stylesheet" href="css/ecommerce.css">

	<!-- Owl carousel -->
	<link href="css/owl.carousel.min.css" rel="stylesheet">
	<link href="css/owl.theme.default.min.css" rel="stylesheet">

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/font-face.css">
	<link rel="stylesheet" href="css/template.css">
	<link rel="stylesheet" type="text/css" href="css/revolutionslider_settings.css" media="screen" />

	<script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>

<body class="style-14">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- Start Loading -->
<section class="loading-overlay">
	<div class="Loading-Page">
		<h1 class="loader">Loading...</h1>
	</div>
</section>
<!-- End Loading  -->

<!-- start header -->
<?php require_once 'template/header.php' ?>
<!-- end header -->

<!-- start main content -->
<main class="main-container">

	<!-- new collection directory -->
	<section id="content-block" class="slider_area">
		<div class="container">
			<div class="content-push">
				<div class="row">

					<?php require_once 'template/prod_cats.php'; ?>

					<div class="col-md-9 col-md-pull-3">

						<div class="header_slider">
							<?php require_once 'template/head_slider.php'; ?>
						</div><!-- /.header_slider -->

						<div class="clear"></div>

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- end new collection directory -->


<!-- pop items -->
<!-- <section id="popular-product" class="ecommerce"> -->

	<?php //require_once 'template/pop_items.php' ?>

<!-- </section> -->

<!-- end pop items -->

<section id="shop" class="shop-4 pt-0">
		<div class="container">
			<div class="row">
				<!-- Projects Filter
                ============================================= -->
				<div class="col-xs-12 col-sm-12 col-md-12 shop-filter">
					<ul class="list-inline">
						<li>
							<a class="active-filter" href="#" data-filter="*">All Products</a>
						</li>
						<li>
							<a href="#" data-filter=".filter-best">Best Selling</a>
						</li>
						<li>
							<a href="#" data-filter=".filter-featured">Featured</a>
						</li>
						<li>
							<a href="#" data-filter=".filter-sale">On Sale</a>
						</li>
					</ul>
				</div>
				<!-- .projects-filter end -->
			</div>
			<!-- .row end -->
			<!-- Projects Item
            ============================================= -->
			<div id="shop-all" class="row">
				<!-- Product Item #1 -->
				<div class="col-xs-12 col-sm-6 col-md-3 product-item filter-best">
					<div class="product-img">
						<img src="img/shop/index2_product1.png" alt="product">
						<div class="product-hover">
							<div class="product-cart">
								<a class="btn btn-secondary btn-block" href="#">Add To Cart</a>
							</div>
						</div>
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
						<h4>
							<a href="#">Modern Watch</a>
						</h4>
						<p class="product-price">
							<span class="discount1">
							50000
							<span>تومان</span>
							</span>

							<span class="price1">
							32000
							<span>تومان</span>
							</span>

							
						</p>
					</div>
					<!-- .product-bio end -->

				</div>
				<!-- .product-item end -->

				<!-- Product Item #2 -->
				<div class="col-xs-12 col-sm-6 col-md-3 product-item filter-sale">
					<div class="product-img">
						<img src="img/shop/index2_product2.png" alt="product">
						<div class="product-sale">
							sale
						</div>
						<div class="product-hover">
							<div class="product-cart">
								<a class="btn btn-secondary btn-block" href="#">Add To Cart</a>
							</div>
						</div>
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
						<h4>
							<a href="#">Titan Measures</a>
						</h4>
						<p class="product-price">
							<span>$40.00</span>
							$32.00</p>
					</div>
					<!-- .product-bio end -->

				</div>
				<!-- .product-item end -->

				<!-- Product Item #3 -->
				<div class="col-xs-12 col-sm-6 col-md-3 product-item filter-best">
					
					<div class="product-img">
						<img src="img/shop/index2_product3.png" alt="product">
						<div class="product-hover">
							<div class="product-cart">
								<a class="btn btn-secondary btn-block" href="#">Add To Cart</a>
							</div>
						</div>
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
						<h4>
							<a href="#">Charger/Radio</a>
						</h4>
						<p class="product-price">$180.00</p>
					</div>
					<!-- .product-bio end -->

				</div>
				<!-- .product-item end -->

				<!-- Product Item #4 -->
				<div class="col-xs-12 col-sm-6 col-md-3 product-item filter-featured">
					<div class="product-img">
						<img src="img/shop/index2_product4.png" alt="product">
						<div class="product-hover">
							<div class="product-cart">
								<a class="btn btn-secondary btn-block" href="#">Add To Cart</a>
							</div>
						</div>
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
						<h4>
							<a href="#">Plate Compactor</a>
						</h4>
						<p class="product-price">$230.00</p>
					</div>
					<!-- .product-bio end -->

				</div>
				<!-- .product-item end -->

				<!-- Product Item #5 -->
				<div class="col-xs-12 col-sm-6 col-md-3 product-item filter-best">
					<div class="product-img">
						<img src="img/shop/index2_product5.png" alt="product">
						<div class="product-hover">
							<div class="product-cart">
								<a class="btn btn-secondary btn-block" href="#">Add To Cart</a>
							</div>
						</div>
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
						<h4>
							<a href="#">Black Tape</a>
						</h4>
						<p class="product-price">$12.00</p>
					</div>
					<!-- .product-bio end -->

				</div>
				<!-- .product-item end -->

				<!-- Product Item #6 -->
				<div class="col-xs-12 col-sm-6 col-md-3 product-item filter-best filter-featured">
					<div class="product-img">
						<img src="img/shop/index2_product6.png" alt="product">
						<div class="product-hover">
							<div class="product-cart">
								<a class="btn btn-secondary btn-block" href="#">Add To Cart</a>
							</div>
						</div>
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
						<h4>
							<a href="#">ICS Concrete Saw</a>
						</h4>
						<p class="product-price">$40.00</p>
					</div>
					<!-- .product-bio end -->

				</div>
				<!-- .product-item end -->

				<!-- Product Item #7 -->
				<div class="col-xs-12 col-sm-6 col-md-3 product-item filter-featured">
					<div class="product-img">
						<img src="img/shop/index2_product7.png" alt="product">
						<div class="product-new">
							new
						</div>
						<div class="product-hover">
							<div class="product-cart">
								<a class="btn btn-secondary btn-block" href="#">Add To Cart</a>
							</div>
						</div>
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
						<h4>
							<a href="#">NorthStar Asphalt</a>
						</h4>
						<p class="product-price">$150.00</p>
					</div>
					<!-- .product-bio end -->

				</div>
				<!-- .product-item end -->

				<!-- Product Item #8 -->
				<div class="col-xs-12 col-sm-6 col-md-3 product-item filter-best">
					<div class="product-img">
						<img src="img/shop/index2_product8.png" alt="product">
						<div class="product-hover">
							<div class="product-cart">
								<a class="btn btn-secondary btn-block" href="#">Add To Cart</a>
							</div>
						</div>
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
						<h4>
							<a href="#">Keson Fiberglass</a>
						</h4>
						<p class="product-price">$550.00</p>
					</div>
					<!-- .product-bio end -->

				</div>
				<!-- .product-item end -->
			</div>
			<!-- .row end -->

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<a class="btn btn-secondary" href="#">more products <i class="fa fa-plus ml-xs"></i></a>
				</div>
				<!-- .col-md-12 end -->
			</div>
			<!-- .row End -->
		</div>
		<!-- .container end -->
	</section>



	<!-- Start Our Shop Items -->

	<!-- Recent items Starts -->
	<section id="recent-product">
		<?php require_once 'template/special_items.php' ?>
	</section>

	<!-- Recent items Ends -->

	<!-- start collections -->
	<?php require_once 'template/collections.php'; ?>
	<!-- end collections -->

	<!-- /.bt-block-home-parallax -->

	<!-- Start Our Clients -->

	<!-- <section id="Clients" class="light-wrapper"> -->
		<?php //require_once 'template/clients.php' ?>
	<!-- </section> -->

	<!-- End Our Clients  -->

</main>
<!-- end main content -->



<!-- start footer area -->
<footer class="footer-area-content">
	<?php require_once 'template/footer.php' ?>	
</footer>
<!-- footer area end -->


<!-- All script -->
<script src="js/vendor/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/smoothscroll.js"></script>
<!-- Scroll up js
============================================ -->
<script src="js/jquery.scrollUp.js"></script>
<script src="js/menu.js"></script>
<!-- new collection section script -->
<script src="js/swiper/idangerous.swiper.min.js"></script>
<script src="js/swiper/swiper.custom.js"></script>

<script src="js/pluginse209.js?v=1.0.0"></script>

<!-- Magnific Popup -->
<script src="js/jquery.magnific-popup.min.js"></script>

<script src="js/jquery.countdown.min.js"></script>

<!-- SLIDER REVOLUTION SCRIPTS  -->
<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!-- Owl carousel -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script src="js/app.js"></script>



<script type="text/javascript">

	/*-----------------------------------------------------------------------------------*/
	/* Product Carousel
	 /*-----------------------------------------------------------------------------------*/
	


	if (jQuery().owlCarousel) {
		var productCarousel = $("#product-carousel");
		productCarousel.owlCarousel({
		rtl:true,
		margin:8,
	    loop:false,
	    dots:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:4
	        }
	    }
	});

		// Custom Navigation Events
		
	}

	/* Main Slider */
	$('.tp-banner0').show().revolution({
		dottedOverlay: "none",
		delay: 5000,
		startWithSlide: 0,
		startwidth: 869,
		startheight: 520,
		hideThumbs: 10,
		hideTimerBar: "on",
		thumbWidth: 50,
		thumbHeight: 50,
		thumbAmount: 4,
		navigationType: "bullet",
		navigationArrows: "solo",
		navigationStyle: "round",
		touchenabled: "on",
		onHoverStop: "on",
		swipe_velocity: 0.7,
		swipe_min_touches: 1,
		swipe_max_touches: 1,
		drag_block_vertical: false,
		parallax: "mouse",
		parallaxBgFreeze: "on",
		parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],
		keyboardNavigation: "off",
		navigationHAlign: "right",
		navigationVAlign: "bottom",
		navigationHOffset: 30,
		navigationVOffset: 30,
		soloArrowLeftHalign: "left",
		soloArrowLeftValign: "center",
		soloArrowLeftHOffset: 50,
		soloArrowLeftVOffset: 8,
		soloArrowRightHalign: "right",
		soloArrowRightValign: "center",
		soloArrowRightHOffset: 50,
		soloArrowRightVOffset: 8,
		shadow: 0,
		fullWidth: "on",
		fullScreen: "off",
		spinner: "spinner4",
		stopLoop: "on",
		stopAfterLoops: -1,
		stopAtSlide: -1,
		shuffle: "off",
		autoHeight: "off",
		forceFullWidth: "off",
		hideThumbsOnMobile: "off",
		hideNavDelayOnMobile: 1500,
		hideBulletsOnMobile: "off",
		hideArrowsOnMobile: "off",
		hideThumbsUnderResolution: 0,
		hideSliderAtLimit: 0,
		hideCaptionAtLimit: 500,
		hideAllCaptionAtLilmit: 500,
		videoJsPath: "rs-plugin/videojs/",
		fullScreenOffsetContainer: ""
	});







</script>


</body>


</html>