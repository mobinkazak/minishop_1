<?php require_once '../loader.php';
   $title=$backend->safeString($backend->get('title'));
   if ($backend->get('parent_id')=='') {
      $parent_id=-1;
   }else{
      $parent_id=$backend->toInt($backend->get('parent_id'));
   }

   $url="?title=$title&parent_id=$parent_id";
   $where='';
   if (!empty($title)) {
      $where.=" AND title LIKE '%$title%' ";
   }

   if ($parent_id >= 0) {
      $where.=" AND parent_id='$parent_id' ";
   }

   $resPagination=$backend->pagination('categories',5,$where);

   if (isset($_SESSION['limit'])) {
      $resPagination=$backend->pagination('categories',$_SESSION['limit'],$where);
   }

   if ($backend->page > $resPagination['totalPage']) {
      $backend->redirect('?p=1');
   }


?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>لیست دسته ها</title>
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
                  <div class="col-lg-12 grid-margin stretch-card">
                     <?php
                     if ($resPagination['totalRows']==0) {
                     ?>
                     <div class="col-md-8 text-center mx-auto mt-5">
                        <?php $backend->setAlert('','','warning','هیچ رکوردی برای نمایش یافت نشد');?>
                     </div>
                     <?php
                     }else{
                     ?>
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title">لیست دسته ها</h4>
                           <div class="card-description">
                              <form class="form-inline" method="get" action="">
                                 <div class="input-group">
                                    <input class="px-2" value="<?php print $title; ?>" data-toggle="tooltip" title="عنوان دسته را وارد کنید" style="border:1px solid #ddd;" type="text" name="title" placeholder="عنوان دسته">
                                    <div class="input-group-append">
                                       <select style="font-size:14px;border:1px solid #ddd;" name="parent_id" id="parent_id">
                                          <option <?php ($parent_id == -1)?print 'selected':print ''; ?> value="-1">دسته ای مورد نظر را انتخاب کنید</option>
                                          <option <?php ($parent_id==0)?print 'selected':print ''; ?> value="0">دسته اصلی</option>
                                          <?php
                                          $res=$backend->getParentCategoryList();
                                          while ($parentRow=$backend->getRow($res)) {
                                          $sel1=($parentRow['id']==$parent_id)?'selected':'';
                                          ?>
                                          <option disabled></option>
                                          <option <?php print $sel1; ?> value="<?php print $parentRow['id'] ?>"><?php print $parentRow['title']; ?></option>
                                          <!-- <option  disabled value="">--مدل <?php //print $parentRow['title']; ?></option> -->
                                          <?php
                                          $res2=$backend->getParentCategoryList($parentRow['id']);
                                          while ($parentRow2=$backend->getRow($res2)) {
                                          $sel2=($parentRow2['id']==$parent_id)?'selected':'';
                                          ?>
                                          <option <?php print $sel2; ?> value="<?php print $parentRow2['id'] ?>">----<?php print $parentRow2['title']; ?></option>
                                          <?php
                                          }
                                          }
                                          ?>
                                       </select>
                                       <button data-toggle="tooltip" title="جستجو" type="submit" class="btn btn-success"><i style="font-size:15px" class="mdi mdi-magnify"></i></button>
                                       <button type="button" onclick="redirect('?');" data-toggle="tooltip" title="پاک کن" class="btn btn-info"><i style="font-size:15px" class="mdi mdi-auto-fix"></i></button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th> # </th>
                                    <th> عنوان دسته </th>
                                    <th> دسته ها </th>
                                    <th width="20px"> ویرایش </th>
                                    <th width="20px"> حذف </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 while ($row=$backend->getRow($resPagination['result'])) {
                                    $parent=$backend->getParentTitle($row['parent_id']);
                                 ?>
                                 <tr>
                                    <td> 1 </td>
                                    <td><?php print $row['title'] ?></td>
                                    <td>
                                       <?php ($row['parent_id']==0)?print 'دسته اصلی':print $parent['title']; ?>
                                    </td>
                                    <td><button type="button" class="btn btn-warning">ویرایش</button></td>
                                    <td><button type="button" class="btn btn-danger">حذف</button></td>
                                 </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                           </table>
                           <?php $backend->showLimitTable($url); ?>
                        </div>
                        <?php $backend->renderPagination($url,$resPagination['totalPage']); ?>
                     </div>
                     <?php
                     }
                     ?>
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