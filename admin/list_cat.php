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
   $backend->setSortCol(['id','title']);
   $resPagination=$backend->pagination('categories',$where);

   if ($backend->get('del_id')) {
      $resDel=$backend->deleteCategory($backend->get('del_id'),$backend->get('cid'),$backend->get('sid'));
      $backend->redirect("$url&p=$backend->page&d=$resDel");
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

      <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">حذف رکورد <span id="delete-id"></span></h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <span>
               آیا میخواهید رکورد 
               <b id="delete-title" class="text-danger border-bottom"></b>
               حذف شود؟
              </span>
            </div>

            <div class="modal-footer">
               <div id="delete-notice" class="d-none text-danger flex-grow-1">
                 <p></p>
               </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
              <button id="delete-btn" type="button" class="btn btn-danger">حذف</button>
            </div>
          </div>
        </div>
      </div>


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
                     if ($resPagination['totalRows']==0 && $where=='') {
                     ?>
                     <div class="col-md-12 text-center mx-auto mt-5">
                        <?php $backend->setAlert('','','warning','هیچ رکوردی برای نمایش یافت نشد');?>
                     </div>
                     <?php
                     }else{
                     ?>
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title">لیست دسته ها</h4>
                           <div class="card-description py-3" style="background-color: #181824;border-radius: 3px;">
                              <div class="col-md-12">
                              <form method="get" action="">
                                 <div class="input-group mx-auto">
                                    
                                    <input class="px-3 py-3" value="<?php print $title; ?>" data-toggle="tooltip" title="عنوان دسته را وارد کنید" style="width: 30%;border:1px solid #ddd;" type="text" name="title" placeholder="عنوان دسته">
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
                                       <button data-toggle="tooltip" title="جستجو" type="submit" class="btn btn-success px-3"> جستجو <i style="font-size:15px" class="mdi mdi-magnify"></i></button>
                                       <button type="button" onclick="redirect('?');" data-toggle="tooltip" title="پاک کن" class="btn btn-info px-3">پاک کن <i style="font-size:15px" class="mdi mdi-auto-fix"></i></button>

                                    </div>
                                 </div>
                              </form>
                              </div>
                           </div>
                           <div class="text-center">
                           <?php $backend->setAlert('d','1','success','رکورد مورد نظر با موفقیت حذف شد'); ?>
                           <?php $backend->setAlert('d','-1','danger','بدلیل دارا بودن فرزند قابل حذف نمی باشد'); ?>
                           <?php $backend->setAlert('d','-2','danger','بدلیل دارا بودن محصول قابل حذف نمی باشد'); ?>
                           </div>
                           <?php $backend->showLimitTable($url); 

                           if ($resPagination['totalRows']==0 && $where != '') {
                           ?>
                           <div class="col-md-12 text-center mx-auto mt-5">
                              <?php $backend->setAlert('','','warning','هیچ رکوردی برای نمایش یافت نشد');?>
                           </div>
                           <?php
                           }

                           ?>

                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th width="10px"><?php $backend->tableFieldSort($url,'ردیف','id'); ?></th>
                                    <th><?php $backend->tableFieldSort($url,' عنوان دسته ','title'); ?></th>
                                    <th> دسته ها </th>
                                    <th width="10px"> ویرایش </th>
                                    <th width="10px"> حذف </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $idList=$backend->renderId($resPagination['totalRows']);
                                 while ($row=$backend->getRow($resPagination['result'])) {
                                 ?>
                                 <tr>
                                    <td  class="text-center"> <?php print $idList; ?> </td>
                                    <td><?php print $row['title'] ?></td>
                                    <td>
                                       <?php
                                       if($row['parent_id']==0){
                                          print 'دسته اصلی';
                                          $cat_id=$row['id'];
                                          $sub_cat_id=0;
                                       }else{
                                          $parent=$backend->getCategoryTitle($row['parent_id']);
                                          print $parent['title'];
                                          $cat_id=$row['parent_id'];
                                          $sub_cat_id=$row['id'];
                                       } 
                                       ?>
                                    </td>
                                    <td><a href="<?php print ADMIN_URL ?>edit_cat.php<?php print $url; ?>&rowId=<?php print $row['id']; ?>&p=<?php print $backend->page; ?>" class="btn btn-warning">ویرایش</a></td>
                                    <td><button data-cat-id="<?php print $cat_id; ?>" data-sub-cat-id="<?php print $sub_cat_id; ?>" data-prod-count="<?php print $backend->getCountProd($cat_id,$sub_cat_id); ?>" data-id="<?php print $row['id']; ?>" data-child="<?php print $backend->getCountChildForCategory($row['id']); ?>" data-idlist="<?php print $idList; ?>" data-title="<?php print $row['title']; ?>" data-toggle="modal" data-target="#deleteModal" type="button" class="btn btn-danger">حذف</button></td>
                                 </tr>
                                 <?php
                                 ($_SESSION['sort']=='asc')?$idList++:$idList--;
                                 }
                                 ?>
                              </tbody>
                           </table>
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
         $('#deleteModal').on('shown.bs.modal',function(event) {
            var button=$(event.relatedTarget);
            var title=button.data('title');
            var idlist=button.data('idlist');
            var child=button.data('child');
            var cid=button.data('cat-id');
            var sid=button.data('sub-cat-id');
            var prod_count=button.data('prod-count');
            var id=button.data('id');
            $(this).find('#delete-title').html(title);
            $(this).find('#delete-id').html(idlist);
            $(this).find('#delete-btn').attr('data-del-id',id);
            $(this).find('#delete-btn').attr('data-cid',cid);
            $(this).find('#delete-btn').attr('data-sid',sid);
            if(child!=0){
               $(this).find('#delete-notice').html('بدلیل دارا بودن فرزند قابل حذف نمی باشد').removeClass('d-none').addClass('d-flex');
               $(this).find('#delete-btn').attr('disabled','disabled');

            }
            else if(prod_count !=0){
               $(this).find('#delete-notice').html('بدلیل دارا بودن محصول قابل حذف نمی باشد').removeClass('d-none').addClass('d-flex');
               $(this).find('#delete-btn').attr('disabled','disabled');
            }

            else{
               $(this).find('#delete-notice').removeClass('d-flex').addClass('d-none');
               $(this).find('#delete-btn').removeAttr('disabled');
            }
         });

         $('#delete-btn').click(function() {
            var id=$(this).attr('data-del-id');
            var cid=$(this).attr('data-cid');
            var sid=$(this).attr('data-sid');
            redirect('<?php print "$url&p=$backend->page&del_id=" ?>'+id+'&cid='+cid+'&sid='+sid);
         });


      });
      </script>
      <!-- End custom js for this page -->
   </body>
</html>