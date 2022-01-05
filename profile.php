<?php require_once 'loader.php';

if (!$frontend->isLogin('user_id'))
    $frontend->redirect('login.php?err=logup');

if ($frontend->post('update_btn')) {
    $res = $frontend->updateProfile();
    if ($res == 1) {
        $frontend->redirect('?c=1');
    } else {
        $frontend->redirect("?e=$res");
    }
}

if ($frontend->post('update_btn2')) {
    $res = $frontend->updateProfilePassword();
    if ($res == 1) {
        $frontend->redirect('?c=2');
    } else {
        $frontend->redirect("?e=$res");
    }
}

if ($frontend->get('del') == 1) {
    $res = $frontend->deleteAvatar();
    $frontend->redirect('?c=3');
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
    <style>
        .alert-override {
            font-size: 13px !important;
        }
    </style>
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>

<body>
    <!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

    <div class="modal" dir="rtl" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف تصویر پروفایل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">آیا میخواهید تصویر پروفایل شما حذف شود؟</div>
                <div class="modal-footer align-items-baseline">
                    <button type="button" class="btn btn-default" data-dismiss="modal">خیر</button>
                    <button type="button" class="btn btn-danger" onclick="redirect('?del=1');">حذف</button>
                </div>
            </div>
        </div>
    </div>
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
                            if ($profile['avatar'] == '' || !file_exists($profile['avatar'])) {
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
                        <div class="alert-override mt-2">
                            <?php $frontend->setAlert('c', '1', 'success', 'ویرایش با موفقیت انجام شد');
                            $frontend->setAlert('c', '3', 'success', 'تصویر پروفایل شما با موفقیت حذف شد');
                            $frontend->setAlert('e', '-1', 'danger', 'لطفا فیلدهای زیر را وارد کنید');
                            $frontend->setAlert('e', '-6', 'danger', 'نوع فایل های قابل بارگذاری فقط (jpg,png,gif,jpeg) می باشد.لطفا مجدد تلاش فرمایید');
                            $frontend->setAlert('e', '-7', 'danger', 'بارگذاری عکس با مشکل مواجه شده است.لطفا مجدد تلاش فرمایید');
                            ?>
                        </div>
                        <div class="p-3 pb-5 pt-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">مشخصات کاربری</h4>
                            </div>
                            <form action="" enctype="multipart/form-data" class="border-0 p-0" style="box-shadow:0 0 0 !important;" method="post" autocomplete="off">

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="firstname" class="control-label labels">نام</label>
                                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="نام" value="<?php print $profile['firstname']; ?>">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="lastname" class="control-label labels">نام خانوادگی</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?php print $profile['lastname']; ?>" placeholder="نام خانوادگی">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="email" class="control-label labels">ایمیل</label>
                                        <input type="text" class="form-control" placeholder="ایمیل" name="email" id="email" value="<?php print $profile['email']; ?>">
                                        <div class="alert-override mt-1">
                                            <?php $frontend->setAlert('e', '-2', 'danger', 'ایمیل وارد شده قبلا ثبت شده است'); ?>
                                        </div>
                                        <label for="mobile" class="control-label labels">موبایل</label>
                                        <input type="text" class="form-control" placeholder="موبایل" name="mobile" id="mobile" value="<?php print $profile['mobile']; ?>">
                                        <label for="address" class="control-label labels">آدرس</label>
                                        <textarea name="address" rows="10" id="address" class="form-control"><?php $profile['address'] ?></textarea>
                                        <?php
                                        if (!empty($profile['avatar']) && file_exists($profile['avatar'])) {
                                        ?>
                                            <button data-toggle="modal" data-target="#deleteModal" type="button" class="btn-sm btn-danger border-0 mt-2">حذف تصویر</button>
                                        <?php
                                        } else {

                                        ?>
                                            <input id="btn-file" type="button" class="mt-2 btn-sm btn-success text-white border-0" value="انتخاب تصویر">
                                            <input type="file" class="form-control d-none" id="avatar" name="avatar">
                                        <?php
                                        }
                                        ?>
                                        <br>

                                        <input type="submit" name="update_btn" class="btn-sm btn-primary border-0 py-1 px-3 text-white mt-2" value="ذخیره">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="alert-override mt-2">
                            <?php $frontend->setAlert('c', '2', 'success', 'کلمه عبور با موفقیت تغییر یافت'); ?>
                            <?php $frontend->setAlert('e', '-5', 'danger', 'اگر میخواهید کلمه عبور خود را تغییر دهید لطفا فیلد زیر را وارد کنید'); ?>
                        </div>
                        <div class="p-3 pt-2 pb-5">
                            <form action="" class="border-0 p-0" style="box-shadow:0 0 0 !important;" method="post" autocomplete="off">
                                <h5>اگر لازم به تغییر کلمه عبور باشید فیلد های زیر را وارد کنید</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="pass1" class="control-label labels">کلمه عبور فعلی</label>
                                        <input type="password" class="form-control" dir="ltr" name="pass1" id="pass1">
                                        <div class="alert-override mt-1">
                                            <?php $frontend->setAlert('e', '-3', 'danger', 'کلمه عبور وارد شده اشتباه میباشد'); ?>
                                        </div>
                                        <label for="pass2" class="control-label labels">کلمه عبور جدید</label>
                                        <input type="password" class="form-control" dir="ltr" name="pass2" id="pass2">
                                        <label for="pass3" class="control-label labels">تکرار کلمه عبور جدید</label>
                                        <input type="password" class="form-control" dir="ltr" name="pass3" id="pass3">
                                        <div class="mt-1">
                                            <?php $frontend->setAlert('e', '-4', 'danger', 'تکرار کلمه عبور جدید با کلمه عبور جدید مطابقت ندارد'); ?>
                                        </div>
                                        <button class="btn-sm btn-warning mt-1 border-0" type="submit" value="1" name="update_btn2">بروزرسانی</button>
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