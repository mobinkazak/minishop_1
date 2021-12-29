<?php require_once '../loader.php'; 
  
  $title=$backend->safeString($backend->get('title'));
  if ($backend->get('parent_id')=='') {
      $parent_id=-1;
   }else{
      $parent_id=$backend->toInt($backend->get('parent_id'));
   }
  $url="?title=$title&parent_id=$parent_id&p=$backend->page";
  $rowId=$backend->toInt($backend->get('rowId'));
  $titleRow=$backend->getCategoryTitle($rowId);

  if ($backend->post('btn_save')) {
    $result=$backend->updateCategory($rowId);
    if ($result > 0) {
      $backend->redirect($url.'&e=0&rowId='.$rowId);
    }else{
      $backend->redirect($url.'&e=1&rowId='.$rowId);
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>درحال ویرایش <?php print $titleRow['title'] ?></title>
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
<!-- Modal -->


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
                    $backend->setAlert('e','0','success','ویرایش با موفقیت انجام شد');
                    $backend->setAlert('e','1','danger','عنوان وارد شده قبلا ثبت شده است');
                    
                    ?>
                    <h4 class="card-title">ثبت دسته جدید</h4>
                    <form class="forms-sample" method="post" action="" autocomplete="off">
                      <div class="form-group">
                        <label for="title">عنوان دسته</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php print $titleRow['title'] ?>">
                      </div>
                        
                      <div class="form-group">
                        <label for="parent_id">انتخاب دسته بندی</label>
                        <select <?php ($titleRow['parent_id']==0)? print 'disabled':print ''; ?> class="form-control" name="parent_id" id="parent_id">
                          <?php 
                          if ($titleRow['parent_id']==0) {
                            ?>
                          <option <?php ($titleRow['parent_id']==0)?print 'selected':print ''; ?> >دسته اصلی</option>

                            <?php
                          }
                          ?>

                          <?php 
                          $res=$backend->getParentCategoryList();
                          while ($parentRow=$backend->getRow($res)) {
                            $sel=($parentRow['id']==$titleRow['parent_id'])?'selected':'';
                            ?>
                            <option disabled></option>
                            <option <?php print $sel; ?> style="background-color: #dedede;color:#333;" value="<?php print $parentRow['id'] ?>"><?php print $parentRow['title']; ?></option>
                            <!-- <option  disabled value="">--مدل <?php //print $parentRow['title']; ?></option> -->
                            <?php 
                            $res2=$backend->getParentCategoryList($parentRow['id']);
                            while ($parentRow2=$backend->getRow($res2)) {

                            ?>
                            <option value="<?php print $parentRow2['id'] ?>">----<?php print $parentRow2['title']; ?></option>

                              <?php 
                              //$res3=$backend->getParentCategoryList($parentRow2['id']);
                              //while ($parentRow3=$backend->getRow($res3)) {
                              ?>
                              <!--<option value="<?php //print $parentRow3['id'] ?>">--------<?php //print $parentRow3['title']; ?></option> -->

                              <?php
                              //}
                            }
                          }
                          ?>

                        </select>
                      </div>
                      <button type="submit" name="btn_save" class="btn btn-warning mr-2" value="1">ویرایش</button>
                      <a href="<?php print ADMIN_URL ?>list_cat.php<?php print $url; ?>" class="btn btn-light">لغو</a>
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

      });
    </script>
    <!-- End custom js for this page -->
  </body>
</html>