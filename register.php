<?php require_once 'loader.php';

if ($frontend->post('btn_reg')) {
	$res = $frontend->register();
	if ($res > 0)
		$frontend->redirect("login.php");
	else
		$frontend->redirect("?err=$res");
}


?>
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
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">


	<link rel="stylesheet" href="css/font-face.css">
	<link rel="stylesheet" href="css/template.css">

	<script src="js/vendor/modernizr-2.6.2.min.js"></script>
	<style>
		label {
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

					<div class="col-md-7 mx-auto">
						<?php
						$frontend->setAlert('err', '-1', 'danger', 'لطفا فیلد های زیر را پر کنید');
						$frontend->setAlert('err', '-2', 'danger', 'کلمه عبور با تکرار کلمه عبور یکسان نمیباشد');
						$frontend->setAlert('err', '-3', 'danger', 'ایمیل وارد شده قبلا ثبت شده است');
						$frontend->setAlert('err', '-4', 'danger', 'کلمه عبور باید بیشتر از 7 کاراکتر و ترکیبی از حروف کوچک-بزرگ و اعداد باشد');
						$frontend->setAlert('err', '-5', 'danger', 'لطفا ایمیل معتبر وارد نمایید');
						$frontend->setAlert('reg', '1', 'success', 'ثبت نام با موفقیت انجام شد');
						?>
						<form method="post" id="reg_form" autocomplete="off" action="">

							<h3 class="nomargin">ثبت نام</h3>
							<p class="mt5 mb20">
								اگر قبلا ثبت نام کرده باشید. لطفا
								<a class="border-bottom" href="<?php print SITE_URL; ?>/login.php"><strong>کلیک</strong></a>
								کنید
							</p>

							<div class="row mb10">
								<div class="col-sm-6 float-lg-left float-md-left float-sm-none float-xl-left">
									<input type="text" class="form-control" name="firstname" placeholder="نام " />
								</div>
								<div class="col-sm-6 float-lg-left float-md-left float-sm-none float-xl-left">
									<input type="text" class="form-control" name="lastname" placeholder="نام خانوادگی " />
								</div>
							</div>
							<div class="mb10">
								<label for="email" class="control-label">ایمیل</label><span class="star"></span>
								<input type="text" name="email" id="email" class="form-control" placeholder="ایمیل خود را وارد کنید" dir="ltr" />
								<div class="invalid-feedback">

								</div>
							</div>

							<div class="mb10">
								<label for="pass" class="control-label">کلمه عبور</label><span class="star"></span>
								<input type="password" name="pass" id="pass" class="form-control" placeholder="کلمه عبور خود را وارد کنید" dir="ltr" />
							</div>

							<div class="mb10">
								<label for="pass2" class="control-label">تکرار کلمه عبور</label><span class="star"></span>
								<input type="password" name="pass2" id="pass2" class="form-control" placeholder="تکرار کلمه عبور خود را وارد کنید" dir="ltr" />
							</div>

							<button class="btn btn-success btn-block" name="btn_reg" value="1" type="submit" style="margin-top:10px !important;">ثبت نام</button>
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
	<script src="js/jquery-3.6.0.min.js"></script>
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
	<script src="js/jquery.validate.js"></script>
	<script>
		$(document).ready(function() {

			$('#email').blur(function() {
				var email = $(this).val();
				if (email != '') {
					$('.invalid-feedback').html('');

					$.post("ajax.php", {
							'do': 'checkEmail',
							'email': email
						},
						function(data) {
							if (data == 1) {
								$('#email').addClass('is-invalid').removeClass('is-valid');
								$('.invalid-feedback').html('ایمیل وارد شده قبلا ثبت شده است');
							} else {
								$('#email').addClass('is-valid').removeClass('is-invalid');
							}
						}
					);
				}
			});

			$('#reg_form').validate({
				rules: {
					email: {
						required: true,
						email: true
					},
					pass: {
						required: true,
						minlength: 7
					},
					pass2: {
						required: true,
						minlength: 7
					}
				},
				messages: {
					email: {
						required: 'لطفا ایمیل را وارد نمایید',
						email: 'لطفا ایمیل معتبر وارد نمایید'
					},
					pass: {
						required: 'لطفا کلمه عبور را وارد نمایید',
						minlength: 'کلمه عبور شما باید بیشتر از 7 حروف و عدد باشد'
					},
					pass2: {
						required: 'لطفا تکرار کلمه عبور را وارد نمایید',
						minlength: 'کلمه عبور شما باید بیشتر از 7 حروف و عدد باشد'
					}
				},
				errorPlacement: function(error, element) {
					// Add the `invalid-feedback` class to the error element
					error.addClass("invalid-feedback");

					if (element.prop("type") === "checkbox") {
						error.insertAfter(element.next("label"));
					} else {
						error.insertAfter(element);
					}
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("is-invalid").removeClass("is-valid");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("is-valid").removeClass("is-invalid");
				}
			});
		});
	</script>
</body>


</html>