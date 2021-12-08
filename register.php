<?php require_once 'loader.php' ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
	<title> ثبت نام | <?php print BRAND_NAME; ?></title>
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
	<link rel="stylesheet" href="css/bootstrap-override.css">
	<link rel="stylesheet" href="css/skin-lblue.css">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">


	<link rel="stylesheet" href="css/font-face.css">
	<link rel="stylesheet" href="css/template.css">

	<script src="js/vendor/modernizr-2.6.2.min.js"></script>
	<style>
		label{
			margin: 6px 0 !important;
		}
	</style>
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
<main class="container">

	<section>

		<div class="signuppanel">

			<div class="row">

				<div class="col-md-6">

					<div class="signup-info">
						<div class="logopanel">
							<h1><span>[</span> Lookcare <span>]</span></h1>
						</div><!-- logopanel -->

						<div class="mb20"></div>

						<h5><strong>Bootstrap 3 Ecommerce Template!</strong></h5>
						<p>Lookcare is a great theme that is perfect any browser.</p>
						<p>Below are some of the benefits you can have when purchasing this template.</p>
						<div class="mb20"></div>

						<div class="feat-list">
							<i class="fa fa-wrench"></i>
							<h4 class="text-success">Easy to Customize</h4>
							<p>Lookcare is made using Bootstrap 3 so you can easily customize any element of this template following the structure of Bootstrap 3.</p>
						</div>

						<div class="feat-list">
							<i class="fa fa-compress"></i>
							<h4 class="text-success">Fully Responsive Layout</h4>
							<p>Lookcare is design to fit on all browser widths and all resolutions on all mobile devices. Try to scale your browser and see the results.</p>
						</div>

						<div class="feat-list mb20">
							<i class="fa fa-search-plus"></i>
							<h4 class="text-success">Retina Ready</h4>
							<p>When a user load a page, a script checks each image on the page to see if there's a high-res version of that image. If a high-res exists, the script will swap that image in place.</p>
						</div>

						<h4 class="mb20">and much more...</h4>

					</div><!-- signup-info -->

				</div><!-- col-sm-6 -->

				<div class="col-md-6">

					<form method="post" action="#">

						<h3 class="nomargin">ثبت نام</h3>
						<p class="mt5 mb20">
							اگر قبلا ثبت نام کرده باشید. لطفا
							<a class="border-bottom" href="<?php print SITE_URL; ?>login.php"><strong>کلیک</strong></a>
							کنید
						</p>

						<div class="row mb10">
							<div class="col-sm-6 float-lg-left float-md-left float-sm-none float-xl-left">
								<input type="text" class="form-control" placeholder="نام *" />
							</div>
							<div class="col-sm-6 float-lg-left float-md-left float-sm-none float-xl-left">
								<input type="text" class="form-control" placeholder="نام خانوادگی *" />
							</div>
						</div>
						<div class="mb10">
							<label for="email" class="control-label">ایمیل</label><span class="star"></span>
							<input type="text" name="email" id="email" class="form-control text-left" dir="ltr" />
						</div>

						<div class="mb10">
							<label for="pass" class="control-label">کلمه عبور</label><span class="star"></span>
							<input type="password" name="pass" id="pass" class="form-control text-left" dir="ltr" />
						</div>

						<div class="mb10">
							<label for="pass2" class="control-label">تکرار کلمه عبور</label><span class="star"></span>
							<input type="password" name="pass2" id="pass2" class="form-control text-left" dir="ltr" />
						</div>

						<label class="control-label">تاریخ تولد</label><span class="star"></span>
						<div class="row mb10">
							<div class="col-sm-4">
								<input type="text" class="form-control" placeholder="سال" />
							</div>
							<div class="col-sm-5">
								<select class="form-control chosen-select" data-placeholder="Month">
									<option value="Select">انتخاب ماه</option>
									<option value="January">January</option>
									<option value="February">February</option>
									<option value="March">March</option>
									<option value="April">April</option>
									<option value="May">May</option>
									<option value="June">June</option>
									<option value="July">July</option>
									<option value="August">August</option>
									<option value="September">September</option>
									<option value="October">October</option>
									<option value="November">November</option>
									<option value="December">December</option>
								</select>
							</div>
							<div class="col-sm-3">
								<input type="text" class="form-control" placeholder="روز" />
							</div>
							
						</div>

						<button class="btn btn-success btn-block" style="margin-top:10px !important;">ثبت نام</button>
					</form>
				</div><!-- col-sm-6 -->

			</div><!-- row -->



		</div><!-- signuppanel -->

	</section>
</main>
<!-- end  main content -->



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
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

<script src="js/app.js"></script>

</body>


</html>