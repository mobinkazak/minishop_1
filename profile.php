<?php require_once 'loader.php';

if (!$frontend->isLogin('user_id'))
    $frontend->redirect('login.php?err=logup');




?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->


<head>
    <title> حساب کاربری | <?php print BRAND_NAME; ?></title>
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
            <div class="signuppanel rounded border" style="max-width: 1200px !important;">
                <div class="row">
                    <div class="col-md-3" style="border-left:1px solid #eee;">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <?php
                            if ($profile['avatar'] == '') {
                            ?>
                                <img class="rounded-circle mt-5" width="150px" src="<?php print SITE_URL . "/avatars/avatar.png" ?>">
                            <?php

                            } else {
                            ?>
                                <img class="rounded-circle mt-5" width="150px" src="<?php print $profile['avatar']; ?>">
                            <?php
                            }
                            ?>
                            <span class="font-weight-bold"><?php print $profile['firstname'] . ' ' . $profile['lastname']; ?></span><span class="text-black-50"><?php print $profile['email']; ?></span><span> </span>
                        </div>
                    </div>
                    <div class="col-md-5" style="border-left:1px solid #eee;">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">مشخصات کاربری</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label labels">نام</label>
                                    <input type="text" class="form-control" placeholder="نام" value="<?php print $profile['firstname']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label labels">نام خانوادگی</label>
                                    <input type="text" class="form-control" value="<?php print $profile['lastname']; ?>" placeholder="نام خانوادگی">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label labels">ایمیل</label>
                                    <input type="text" class="form-control" placeholder="ایمیل" name="email" id="email" value="<?php print $profile['email']; ?>">
                                    <label class="control-label labels">موبایل</label>
                                    <input type="text" class="form-control" placeholder="موبایل" name="mobile" id="mobile" value="<?php print $profile['mobile']; ?>">
                                    <label class="control-label labels">آدرس</label>
                                    <textarea name="address" rows="10" id="address" class="form-control"><?php $profile['address'] ?></textarea>
                                    <input id="btn-file" type="button" class="mt-2 btn-sm btn-info text-white border-0" value="انتخاب تصویر">
                                    <input dir="ltr" type="file" class="form-control d-none" id="avatar" name="avatar">
                                    <br>
                                    <button class="btn btn-primary mt-2" type="submit" name="update_btn">ذخیره</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="p-3 py-5">
                            <form action="" class="border-0 p-0" style="box-shadow:0 0 0 !important;" method="post" autocomplete="off">
                                <h5>اگر لازم به تغییر کلمه عبور باشید فیلد های زیر را وارد کنید</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="pass1" class="control-label labels">کلمه عبور فعلی</label>
                                        <input type="password" class="form-control" dir="ltr" name="pass1" id="pass1">
                                        <label for="pass2" class="control-label labels">کلمه عبور جدید</label>
                                        <input type="password" class="form-control" dir="ltr" name="pass2" id="pass2">
                                        <label for="pass3" class="control-label labels">تکرار کلمه عبور جدید</label>
                                        <input type="password" class="form-control" dir="ltr" name="pass3" id="pass3">
                                        <br>
                                        <button class="btn-sm btn-warning mt-1 border-0" type="submit" name="update_btn2">بروزرسانی</button>
                                    </div>
                                </div>
                            </form>
                        </div>

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
            $('#btn-file').click(function() {
                $('#avatar').click();
            });
        });
    </script>
</body>


</html>