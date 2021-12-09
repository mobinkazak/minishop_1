<?php require_once '../loader.php';
  

  if ($backend->post('btn_add_step1')) {
    $result=$backend->addProdStep1();
    if ($result > 0) {
      $backend->redirect('?step=2&e='.$result);
    }else{
      $backend->redirect('?e='.$result);
    }

  }
  $step=$backend->toInt($backend->get('step'));

  if ($step==2) {
    
    $tab1="disabled";
    $activeTab1="";
    $showTab1="";

    $tab2="";
    $activeTab2="active";
    $showTab2="show";

    $tab3="disabled";
    $activeTab3="";
    $showTab3="";

    $tab4="disabled";
    $activeTab4="";
    $showTab4="";

  }elseif($step==3){
    $tab1="disabled";
    $activeTab1="";
    $showTab1="";

    $tab2="disabled";
    $activeTab2="";
    $showTab2="";

    $tab3="";
    $activeTab3="active";
    $showTab3="show";

    $tab4="disabled";
    $activeTab4="";
    $showTab4="";

  }elseif ($step==4) {
    $tab1="disabled";
    $activeTab1="";
    $showTab1="";

    $tab2="disabled";
    $activeTab2="";
    $showTab2="";

    $tab3="disabled";
    $activeTab3="";
    $showTab3="";

    $tab4="";
    $activeTab4="active";
    $showTab4="show";
    
  }else{
    $tab1="";
    $activeTab1="active";
    $showTab1="show";

    $tab2="disabled";
    $activeTab2="";
    $showTab2="";

    $tab3="disabled";
    $activeTab3="";
    $showTab3="";

    $tab4="disabled";
    $activeTab4="";
    $showTab4="";

  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ثبت محصول جدید</title>
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
    <link rel="stylesheet" href="css/select2.css">
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
          <div class="container py-md-4 px-4 py-sm-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link <?php print $activeTab1; ?> <?php print $tab1; ?> " id="step_1" data-toggle="tab" href="#step1" role="tab" aria-selected="true">مشخصات کلی</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link <?php print $activeTab2; ?> <?php print $tab2; ?> " id="step_2" data-toggle="tab" href="#step2" role="tab" aria-selected="false">
                  مشخصات محصول
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link <?php print $activeTab3; ?> <?php print $tab3; ?>" id="step_3" data-toggle="tab" href="#step3" role="tab" aria-selected="false">تصاویر محصول</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link <?php print $activeTab4; ?> <?php print $tab4; ?>" id="step_4" data-toggle="tab" href="#step4" role="tab" aria-selected="false">سایر</a>
              </li>
            </ul>
            <div class="tab-content px-5" id="myTabContent">
            <?php $backend->setAlert('e','-1','danger','برای رفتن به مرحله بعد لازم است فیلدهای زیر پر شوند'); ?>

              <div class="tab-pane fade <?php print $activeTab1; ?> <?php print $showTab1; ?>" id="step1" role="tabpanel">
                <form class="form_1" method="post" action="" autocomplete="off">
                  <div class="form-group">
                    <label for="title_fa">عنوان محصول (فارسی)</label><span class="star"></span>
                    <input type="text" class="form-control" name="title_fa" id="title_fa">
                  </div>
                  <div class="form-group">
                    <label for="title_en">عنوان محصول (انگلیسی)</label><span class="star"></span>
                    <input type="text" dir="ltr" class="form-control" name="title_en" id="title_en">
                  </div>
                  <div class="form-group">
                    <label for="short_desc">توضیحات کوتاه</label><span class="star"></span>
                    <textarea style="resize:none;height:100px;" class="form-control" name="short_desc" id="short_desc"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="long_desc">توضیحات کامل</label><span class="star"></span>
                    <textarea style="height:150px;" class="form-control" name="long_desc" id="long_desc"></textarea>
                  </div>
                  <div class="form-group mb-4">
                    <label>وضعیت محصول : </label><span class="star"></span>
                    <span class="mr-4">
                      <span class="">
                        <label class="form-check-label" for="active">فعال</label>
                        <input class="" type="radio" name="status" id="active" value="1">
                      </span>
                      <span class="mr-3">
                        <label class="form-check-label" for="inactive">غیرفعال</label>
                        <input class="" type="radio" name="status" id="inactive" value="0">
                      </span>
                    </span>
                  </div>
                  <button type="submit" name="btn_add_step1" class="btn btn-info mr-2" value="1">مرحله بعد</button>
                  <a href="<?php print ADMIN_URL ?>index.php" class="btn btn-light">لغو</a>
                </form>
              </div>
              <div class="tab-pane fade <?php print $activeTab2 ?> <?php print $showTab2; ?>" id="step2" role="tabpanel">
                
                <form class="form_2" method="post" action="" autocomplete="off">
                  <div class="row">
                    <div class=" col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">
                        <label for="model">مدل محصول</label><span class="star"></span>
                        <input type="text" class="form-control" name="model" id="model">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">
                        <label for="code">کد محصول</label><span class="star"></span>
                        <input type="text" class="form-control" name="code" id="code">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cat_id">دسته محصول</label>
                    <select class="form-control" dir="rtl" name="cat_id" id="cat_id">
                      <option value="">دسته بندی مورد نظر خود را انتخاب کنید</option>
                      <?php
                      
                      $res=$backend->getParentCategoryList();
                      while ($parentRow=$backend->getRow($res)) {
                      ?>
                      <option value="<?php print $parentRow['id'] ?>"><?php print $parentRow['title']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sub_cat_id">زیردسته محصول</label>
                    <select class="form-control" dir="rtl" name="sub_cat_id" id="sub_cat_id">
                      <option value="0">--------</option>
                      
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="price">قیمت محصول</label><span class="star"></span>
                        <input type="text" dir="ltr" class="form-control" name="price" id="price">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="discount">قیمت تخفیف محصول</label><span class="star"></span>
                        <input type="text" dir="ltr" class="form-control" name="discount" id="discount">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="quantity">موجودی انبار</label><span class="star"></span>
                    <input type="text" dir="ltr" class="form-control" name="quantity" id="quantity">
                  </div>
                  
                  <button type="submit" name="btn_add" class="btn btn-info mr-2" value="1">مرحله بعد</button>
                  <a href="<?php print ADMIN_URL ?>index.php" class="btn btn-light">لغو</a>
                </form>
              </div>
              <!-- step 3 -->
              <div class="tab-pane fade <?php print $activeTab3; ?> <?php print $showTab3; ?>" id="step3" role="tabpanel">
                <form class="form_3" method="post" action="" autocomplete="off">
                  <div class="form-group">
                    <label for="thumb_img">تصویر محصول</label><span class="star"></span>
                    <input type="text" dir="ltr" class="form-control" name="thumb_img" id="thumb_img">
                  </div>

                  <table class="table table-bordered" id="tbl-list">
                    <tr class="text-center">
                      <th class="text-center">تصویر</th>
                      <th class="text-center"> توضیحات</th>
                      <th class="text-center">عملیات</th>
                    </tr>
                    <tr class="text-center">
                      <td><input type="text" dir="ltr" class="form-control"></td>
                      <td><input type="text" dir="ltr" class="form-control"></td>
                      <td>
                        <button type="button" class="btn btn-success" id="btn-add-row">
                          <span class="mdi mdi-plus"></span>
                        </button>
                        <button style="display:none;" type="button" class="btn btn-danger" id="btn-del-row">
                          <span class="mdi mdi-minus"></span>
                        </button>
                      </td>
                    </tr>
                  </table>
                  
                  <button type="submit" name="btn_add" class="btn btn-info mr-2" value="1">مرحله بعد</button>
                  <a href="<?php print ADMIN_URL ?>index.php" class="btn btn-light">لغو</a>
                </form>
              </div>

              <!-- step 4 -->
              <div class="tab-pane fade <?php print $activeTab4; ?> <?php print $showTab4; ?>" id="step4" role="tabpanel">
                <form class="form_4" method="post" action="" autocomplete="off">
                  <div class="form-group">
                    <label for="short_desc">کلمات کلیدی (سئو)</label><span class="star"></span>
                    <textarea style="resize:none;height:100px;" class="form-control" name="short_desc" id="short_desc"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="long_desc">توضیحات (سئو)</label><span class="star"></span>
                    <textarea style="height:150px;" class="form-control" name="long_desc" id="long_desc"></textarea>
                  </div>
                  <button type="submit" name="btn_add" class="btn btn-info mr-2" value="1">مرحله بعد</button>
                  <a href="<?php print ADMIN_URL ?>index.php" class="btn btn-light">لغو</a>
                </form>
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
    <script src="js/lib.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/select2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#cat_id').select2();
      $('#sub_cat_id').select2();
      $('#cat_id').change(function() {
        var id=parseInt($(this).val());
        if(id>0){
          $.post('ajax.php', {'task': 'getSubCat','id':id}, function(data) {
          $('#sub_cat_id').html(data);
          });
        }else{
          $('#sub_cat_id option:gt(0)').remove();
        }
      });
      $('#btn-add-row').click(function() {
        var tr=$('#tbl-list tr').last().clone(true);
        tr.find('#btn-del-row').show();
        tr.find('input[type="text"]').val('');
        $('#tbl-list').append(tr);
      });
      $('#btn-del-row').click(function() {
        $(this).parent().parent().remove();
      });
    });
    </script>
  </body>
</html>