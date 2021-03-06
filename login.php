<?php require_once 'loader.php';

if ($frontend->isLogin('user_id'))
	$frontend->redirect('profile.php');


if ($frontend->post('btn_log')) {
	$res = $frontend->login();
	if ($res > 0)
		$frontend->redirect('profile.php');
	else
		$frontend->redirect("login.php?err=$res");
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
	<title> ورود | <?php print BRAND_NAME; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
<!-- 
	<link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,900,700,700italic,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,600' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'> -->
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-override.css">
	<link rel="stylesheet" href="css/skin-lblue.css">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">

	<link rel="stylesheet" href="css/font-face.css">
	<link rel="stylesheet" href="css/template.css">

	<script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>

<body>
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

			<div class="signinpanel">

				<div class="row">

					<div class="col-md-6 mx-auto">
						<?php
							$frontend->setAlert('err', '-1', 'danger', 'لطفا فیلد های زیر را وارد کنید');
							$frontend->setAlert('err', '-2', 'danger', 'ایمیل یا کلمه عبور وارد شده اشتباه میباشد');
							$frontend->setAlert('msg', 'logout', 'success', 'خروج از سیستم با موفقیت انجام شد');
							$frontend->setAlert('err', 'logup', 'danger', 'برای دسترسی به این قسمت باید وارد شوید');

						?>
						<form method="post" id="log_form" autocomplete="off" action="">
							<h4 class="nomargin">ورود</h4>
							<p class="mt5 mb20">برای دسترسی به حساب خود وارد شوید</p>
							<div class="input-group" style="align-items: flex-end !important;">
								<div class="input-group-prepend" style="margin-left:-2px !important;border-top-left-radius:0;border-bottom-left-radius:0;">
									<span class="input-group-text" style="padding:11px .75rem !important;border-radius: 0 !important;">
										<i class="fa fa-user"></i>
									</span>
								</div>
								<input name="email" id="email" dir="ltr" type="text" class="form-control" placeholder="ایمیل خود را وارد نمایید" />
							</div>

							<div class="input-group" style="align-items: flex-end !important;">
								<div class="input-group-prepend" style="margin-left:-2px !important;border-top-left-radius:0;border-bottom-left-radius:0;">
									<span class="input-group-text" style="padding:11px 13px !important;border-radius: 0 !important;">
										<i class="fa fa-lock"></i>
									</span>
								</div>
								<input name="pass" id="pass" dir="ltr" type="password" class="form-control" placeholder="کلمه عبور خود را وارد نمایید" />
							</div>

							<div class="mt-2 mx-1">
								<a href="/account_recovery.php"><small style="font-size:90%">کلمه عبور خود را فراموش کرده اید؟</small></a>
							</div>
							<button class="btn btn-success btn-block py-2" name="btn_log" type="submit" value="1">ورود</button>
							<div class="mt-3 text-center">
								اگر هنوز ثبت نام نکرده اید.لطفا
								<a class="border-bottom" href="<?php print SITE_URL; ?>/register.php"><strong>کلیک</strong></a>
								کنید
							</div>
						</form>
					</div><!-- col-sm-5 -->

				</div><!-- row -->


			</div><!-- signin -->

		</section>
	</main>
	<!-- end  main content -->

	<!-- start footer area -->
	<footer class="footer-area-content">
		<?php require_once 'template/footer.php' ?>
	</footer>
	<!-- footer area end -->



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
		$(document).ready(function () {
			$('#log_form').validate({
				rules: {
					email: {
						required: true,
						email: true
					},
					pass: {
						required: true
					}
				},
				messages: {
					email: {
						required: 'لطفا ایمیل را وارد نمایید',
						email: 'لطفا ایمیل معتبر وارد نمایید'
					},
					pass: {
						required: 'لطفا کلمه عبور را وارد نمایید'
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