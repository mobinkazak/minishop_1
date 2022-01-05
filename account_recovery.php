<?php require_once 'loader.php';

if ($frontend->isLogin('user_id'))
    $frontend->redirect('profile.php');



?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->


<head>
    <title> بازیابی کلمه عبور | <?php print BRAND_NAME; ?></title>
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
    <style>
        form {
            border: none !important;
            box-shadow: none !important;
        }
    </style>
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

            <div class="signuppanel">

                <div class="row">
                    <div class="col-md-6 mx-auto border">
                        <div class="text-center">
                            <h3 class="pt-3"><i class="fa fa-lock fa-4x"></i></h3>
                            <h3 class="text-center">درخواست بازیابی کلمه عبور</h3>
                            <p>برای بازیابی کلمه عبور لطفا ایمیل خود را وارد نمایید</p>
                            <div class="panel-body">
                                <form id="recovery_form" class="py-0" action="" autocomplete="off" method="post">
                                    <div class="form-group">
                                        <input id="email" name="email" placeholder="ایمیل" class="form-control" type="email">
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-primary btn-block" value="بازیابی" type="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
        $(document).ready(function() {

        });
    </script>

</body>


</html>