<?php require_once '../loader.php'; 
  $profile=$backend->getProfile();
  if ($backend->post('btn_save')) {
    $res=$backend->saveProfile();
    $backend->redirect('?e='.$res);
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>مشخصات</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-face.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
    <?php require_once 'template/nav.php'; ?>
      <!-- partial -->
      <div class="page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php require_once 'template/sidebar.php'; ?>
        <!-- partial -->
        <div class="main-panel">
        <div class="container">
          
          <div class="col-12 my-3 grid-margin stretch-card">

                <div class="card">
                  <div class="card-body">
                    <?php 
                    $backend->setAlert('e','1','success','ویرایش با موفقیت انجام شد'); 
                    $backend->setAlert('e','0','success','ویرایش با موفقیت انجام شد'); 
                    $backend->setAlert('e','-4','danger','نوع فایل های قابل بارگذاری فقط (jpg,png,gif,jpeg) می باشد.لطفا مجدد تلاش فرمایید');
                    $backend->setAlert('e','-5','danger','بارگذاری عکس با مشکل مواجه شده است.لطفا مجدد تلاش فرمایید');
                    ?>
                    <h4 class="card-title">مشخصات</h4>
                    <form enctype="multipart/form-data" id="prof_frm" class="forms-sample" method="post" action="" autocomplete="off">
                      <div class="row">
                        <div class="form-group col">
                          <label for="fn">نام</label><span class="star"></span>
                          <input type="text" class="form-control" name="fn" id="fn" value="<?php print $profile['firstname']; ?>">
                        </div>
                        <div class="form-group col">
                          <label for="ln">نام خانوادگی</label><span class="star"></span>
                          <input type="text" class="form-control" name="ln" value="<?php print $profile['lastname']; ?>" id="ln">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="mobile">موبایل</label><span class="star"></span>
                        <input type="text" class="form-control" name="mobile" id="mobile" value="<?php print $profile['mobile']; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="email1">ایمیل</label><span class="star"></span>
                        <input type="email" class="form-control" name="email" value="<?php print $profile['email']; ?>" id="email1">
                      </div>
                      <?php $backend->setAlert('e','-1','danger','ایمیل وارد شده وجود دارد');?>
                      <div>
                        <div class="form-group">
                          <label for="address">آدرس</label>
                          <textarea style="text-align:right !important;" rows="4" class="form-control" name="address" id="address"><?php print $profile['address'] ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>عکس پروفایل</label>
                        <?php 
                        $path='../'.$profile['avatar'];
                        if (!empty($profile['avatar'] && file_exists($path))) {
                          ?> 
                          <a href="<?php print $path; ?>" target="_blank">
                            <img style="width:160px;height:120px;" src="<?php print $path; ?>" alt="avatar">
                          </a>
                          <?php
                        }else{
                        ?>
                        <input type="file" id="img" name="img" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="بارگذاری عکس">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" id="btn_img" type="button">انتخاب عکس</button>
                          </span>
                        </div>
                        <?php 
                        }
                        ?>
                      </div>
                      <div class="px-3" style="background-color: #fff3cd;border-radius: 1%;" style="height: 300px;">
                        <div class="text-center">
                      <?php $backend->setAlert(' ','','warning','اگر لازم به تغییر رمزعبور خود باشید لطفا فیلدهای زیر را پر کنید'); ?>
                      </div>
                        <div class="form-group">
                          <label for="password1">رمزعبور فعلی</label>
                          <input type="password" class="form-control" name="password1" id="password1">
                        </div>
                      <?php $backend->setAlert('e','-2','danger','رمزعبور فعلی صحیح نمی باشد');?>

                        <div class="form-group">
                          <label for="password2">رمزعبور جدید</label>
                          <input type="password" class="form-control" name="password2" id="password2">
                        </div>
                        <div class="form-group">
                          <label for="password3"> تکرار رمزعبور جدید </label>
                          <input type="password" class="form-control" name="password3" id="password3">
                        </div>
                        <?php $backend->setAlert('e','-3','danger','تکرار رمزعبور جدید صحیح نمی باشد');?>

                        <div class="alert alert-warning"></div>
                      </div>
                      
                      
                      <button type="submit" name="btn_save" class="btn btn-primary mr-2" value="1">ذخیره</button>
                      <a href="<?php print ADMIN_URL ?>index.php" class="btn btn-light">لغو</a>
                    </form>
                  </div>
                </div>
              </div>
        </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php require_once 'template/footer.php'; ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- <script src="assets/vendors/chart.js/Chart.min.js"></script> -->
    <script src="assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>

    <script src="js/lib.js"></script>
    <script>
      $(document).ready(function() {
        $('#btn_img').click(function() {
          $('#img').click();
        });

        $('#prof_frm').validate({

          rules:{
            email: {
              required: true,
              email: true
            },
            mobile:{
              required: true,
              minlength: 11,
              maxlength: 11
            },
            fn:'required',
            ln:'required',
          },
          messages:{
            email:{
              required:'لطفا ایمیل را وارد نمایید',
              email:'لطفا ایمیل معتبر وارد نمایید'
            },
            mobile:{
              required:'لطفا موبایل خود را وارد نمایید',
              minlength:'لطفا شماره موبایل معتبر وارد نمایید',
              maxlength:'لطفا شماره موبایل معتبر وارد نمایید'
            },
            fn:'لطفا نام خود را وارد نمایید',
            ln:'لطفا نام خانوادگی خود را وارد نمایید',

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
    <!-- End custom js for this page -->
  </body>
</html>