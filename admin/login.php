<?php
	require_once '../loader.php';

	if ($backend->isLogin('admin_id')) {
		$backend->redirect('index.php');
	}

	if ($backend->post('btn_login')) {
		$res=$backend->login($backend->post('email'),$backend->post('password'));
		if ($res) {
			$backend->redirect('index.php');
		}else{
			$backend->redirect('?err=loginerr');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-rtl.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/font-face.css">
		<title>ورود به پنل مدیریت</title>
	</head>
	<body>
		<div class="wrapper1 fadeInDown mt-4">
			
			<?php $backend->setAlert('err','loginerr','danger','ایمیل یا کلمه عبور وارد شده اشتباه است.لطفا مجدد تلاش کنید'); ?>
			<?php $backend->setAlert('err','logup','danger','برای ورود به پنل مدیریت باید ایمیل و کلمه عبور خود را وارد نمایید'); ?>
			<?php $backend->setAlert('msg','logout','success','شما با موفقیت از پنل مدیریت خارج شدید'); ?>

			<div id="formContent" >
			<div class="fadeIn first pt-4 pb-4 text-center">
				<h4 class="h4 text-muted">ورود به پنل مدیریت</h4>
			</div>
			<div class="px-2">
				<form id="login_form" autocomplete="off" method="post" action="">
					<div class="form-group">
						<div class="col-sm-12">
							<input type="email" id="email" dir="ltr" class="form-control fadeIn second" name="email" placeholder="ایمیل">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="password" dir="ltr" id="password" class="form-control fadeIn third" name="password" placeholder="کلمه عبور">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="submit" class="fadeIn fourth py-3 w-100 mt-2 mb-3" name="btn_login" value="ورود">
						</div>
					</div>
				</form>
				</div>
				<div id="formFooter">
					<a class="underlineHover" href="#">کلمه عبور خود را فراموش کرده اید؟</a>
				</div>
			</div>
		</div>


		<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script>
			$(document).ready(function() {
				$('#login_form').validate({

					rules:{
						email: {
							required: true,
							email: true
						},
						password:{
							required: true,
							minlength: 5
						}
					},
					messages:{
						email:{
							required:'لطفا ایمیل را وارد نمایید',
							email:'لطفا ایمیل معتبر وارد نمایید'
						},
						password:'لطفا کلمه عبور را وارد نمایید'

					},
					errorPlacement: function ( error, element ) {
					// Add the `invalid-feedback` class to the error element
					error.addClass( "invalid-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.next( "label" ) );
					} else {
						error.insertAfter( element );
					}
					},
					highlight: function ( element, errorClass, validClass ) {
						$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
					},
					unhighlight: function (element, errorClass, validClass) {
						$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
					}

				});
			});

		</script>

	</body>
</html>