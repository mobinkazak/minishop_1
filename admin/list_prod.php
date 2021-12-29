<?php require_once '../loader.php';
$title_fa=$backend->safeString($backend->get('title_fa'));
$title_en=$backend->safeString($backend->get('title_en'));
$model=$backend->safeString($backend->get('model'));
$price=$backend->safeString($backend->get('price'));
$code=$backend->safeString($backend->get('code'));
$discount=$backend->safeString($backend->get('discount'));



if ($backend->get('status')=='')
   $status=-1;
else
   $status=$backend->toInt($backend->get('status'));

if ($backend->get('cat_id')=='')
   $cat_id=-1;
else
   $cat_id=$backend->toInt($backend->get('cat_id'));

if ($backend->get('sub_cat_id')=='')
   $sub_cat_id=-1;
else
   $sub_cat_id=$backend->toInt($backend->get('sub_cat_id'));

if ($backend->get('special')=='')
   $is_special=-1;
else
   $is_special=$backend->toInt($backend->get('special'));

$url="?title_fa=$title_fa&title_en=$title_en&model=$model&price=$price&code=$code&discount=$discount&cat_id=$cat_id&sub_cat_id=$sub_cat_id&status=$status&special=$is_special";
$where='';
if (!empty($title_fa))
   $where.=" AND title_fa LIKE '%$title_fa%' ";

if (!empty($title_en))
   $where.=" AND title_en LIKE '%$title_en%' ";

if (!empty($model))
   $where.=" AND model LIKE '%$model%' ";

if (!empty($price))
   $where.=" AND price LIKE '%$price%' ";

if (!empty($code))
   $where.=" AND code LIKE '%$code%' ";

if (!empty($discount))
   $where.=" AND discount LIKE '%$discount%' ";

if ($cat_id > 0)
   $where.=" AND cat_id='$cat_id' ";

if ($sub_cat_id > 0)
   $where.=" AND sub_cat_id='$sub_cat_id' ";

if ($status >= 0)
   $where.=" AND status='$status' ";

if ($is_special >= 0)
   $where.=" AND is_special='$is_special' ";


   $backend->setSortCol(['id','title_fa','title_en','cat_id','sub_cat_id','model','code','price','discount','status','is_special']);
   $resPagination=$backend->pagination('products',$where);
   if ($backend->get('st_id')!=''&& $backend->get('val')!='') {
   $res=$backend->changeStatusProd($backend->get('st_id'),$backend->get('val'));
   $backend->redirect("$url&p=$backend->page&st=$res");
   }
   if ($backend->get('sp_id')!=''&& $backend->get('val')!='') {
   $res=$backend->changeSpecialProd($backend->get('sp_id'),$backend->get('val'));
   $backend->redirect("$url&p=$backend->page&sp=$res");
   }

   if ($backend->get('del_id')) {
   $resDel=$backend->deleteProduct($backend->get('del_id'));
   $backend->redirect("$url&p=$backend->page&d=$resDel");
   }

   if($backend->post('btn_del_gp') && isset($_POST['checkbox_rows'])){
      $checkbox_rows=$_POST['checkbox_rows'];
      foreach ($checkbox_rows as $checkbox_id) {
         $backend->deleteProduct($checkbox_id);
      }
      $backend->redirect("$url&p=$backend->page&del_gp=1");
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>لیست محصولات</title>
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
                    <!-- <div id="delete-notice" class="d-none text-danger flex-grow-1">
                     <p>بدلیل دارا بودن فرزند قابل حذف نمی باشد</p>
                  </div> -->
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
                <div class="container-fluid">
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
                            <div class="card-body px-3">
                                <h4 class="card-title">لیست محصولات</h4>
                                <div class="card-description py-4"
                                    style="background-color: #181824;border-radius: 3px;">
                                    <div class="col-md-12">
                                        <form method="get" action="">
                                            <div class="input-group mx-auto">
                                                <input class="text-dark px-2 py-2 col-md-6"
                                                    value="<?php print $title_fa; ?>" data-toggle="tooltip"
                                                    title="عنوان محصول فارسی را وارد نمایید"
                                                    style="border:1px solid #ddd;" type="text" name="title_fa"
                                                    placeholder="عنوان فارسی محصول">
                                                <input class="text-dark px-2 col-md-6" value="<?php print $title_en; ?>"
                                                    data-toggle="tooltip" title="عنوان محصول انگلیسی را وارد نمایید"
                                                    style="border:1px solid #ddd;" type="text" name="title_en"
                                                    placeholder="عنوان انگلیسی محصول">
                                                <input class="text-dark px-2 py-2 col-md-3"
                                                    value="<?php print $model; ?>" data-toggle="tooltip"
                                                    title="مدل محصول را وارد نمایید" style="border:1px solid #ddd;"
                                                    type="text" name="model" placeholder="مدل محصول">
                                                <input class="text-dark px-2 col-md-3 col-sm-12"
                                                    value="<?php print $price; ?>" data-toggle="tooltip"
                                                    title="قیمت محصول را وارد نمایید" style="border:1px solid #ddd;"
                                                    type="text" name="price" placeholder="قیمت محصول">
                                                <input class="text-dark px-2 col-md-3 col-sm-12"
                                                    value="<?php print $code; ?>" data-placement="top"
                                                    data-toggle="tooltip" title="کد محصول را وارد نمایید"
                                                    style="border:1px solid #ddd;" type="text" name="code"
                                                    placeholder="کد محصول">
                                                <input class="text-dark px-2 col-md-3 col-sm-12"
                                                    value="<?php print $discount; ?>" data-placement="top"
                                                    data-toggle="tooltip" title="قیمت تخفیف محصول را وارد نمایید"
                                                    style="border:1px solid #ddd;" type="text" name="discount"
                                                    placeholder="قیمت تخفیف محصول">
                                                <div class="input-group-append">
                                                    <select class="py-2"
                                                        style="font-size:14px;border:1px solid #ddd;width:254px;margin-right: 1px"
                                                        name="cat_id" id="cat_id">
                                                        <option <?php ($cat_id == -1)?print 'selected':print ''; ?>
                                                            value="-1">دسته ای مورد نظر را انتخاب کنید</option>
                                                        <?php
                                             $res=$backend->getParentCategoryList();
                                             while ($parentRow=$backend->getRow($res)) {
                                             $sel1=($parentRow['id']==$cat_id)?'selected':'';
                                             ?>
                                                        <option <?php print $sel1; ?>
                                                            value="<?php print $parentRow['id'] ?>">
                                                            <?php print $parentRow['title']; ?></option>
                                                        <?php
                                             }
                                             ?>
                                                    </select>
                                                    <select style="font-size:14px;border:1px solid #ddd;width:254px;"
                                                        name="sub_cat_id" id="sub_cat_id">
                                                        <option <?php ($sub_cat_id == -1)?print 'selected':print ''; ?>
                                                            value="-1">زیر دسته ای مورد نظر را انتخاب کنید</option>
                                                        <?php
                                             if ($cat_id>0) {
                                                $result=$backend->getParentCategoryList($cat_id);
                                                while ($row=$backend->getRow($result)) {
                                                $sel2=($row['id']==$sub_cat_id)?'selected':'';
                                                ?>
                                                        <option <?php print $sel2; ?> value="<?php print $row['id'] ?>">
                                                            <?php print $row['title']; ?></option>
                                                        <?php
                                                }
                                             }
                                             ?>
                                                    </select>
                                                    <select name="status" id="status"
                                                        style="font-size:14px;border:1px solid #ddd;width:130px;">
                                                        <option value="-1"
                                                            <?php ($status==-1)?print 'selected':print ''; ?>>وضعیت
                                                            محصول</option>
                                                        <option value="1"
                                                            <?php ($status==1)?print 'selected':print ''; ?>>فعال
                                                        </option>
                                                        <option value="0"
                                                            <?php ($status==0)?print 'selected':print ''; ?>>غیر فعال
                                                        </option>
                                                    </select>
                                                    <select name="special" id="is_special"
                                                        style="font-size:14px;border:1px solid #ddd;width:129px;">
                                                        <option value="-1"
                                                            <?php ($is_special==-1)?print 'selected':print ''; ?>>
                                                            محصولات ویژه</option>
                                                        <option value="1"
                                                            <?php ($is_special==1)?print 'selected':print ''; ?>>بله
                                                        </option>
                                                        <option value="0"
                                                            <?php ($is_special==0)?print 'selected':print ''; ?>>خیر
                                                        </option>
                                                    </select>
                                                    <button data-toggle="tooltip" title="جستجو" type="submit"
                                                        class="btn btn-success px-3"> جستجو <i style="font-size:15px"
                                                            class="mdi mdi-magnify"></i></button>
                                                    <button type="button" onclick="redirect('?');" data-toggle="tooltip"
                                                        title="پاک کن" class="btn btn-info px-3">پاک کن <i
                                                            style="font-size:15px"
                                                            class="mdi mdi-auto-fix"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <?php $backend->setAlert('d','2','success','رکورد مورد نظر با موفقیت حذف شد'); ?>
                                    <?php $backend->setAlert('del_gp','1','success','حذف رکورد انتخاب شده با موفقیت حذف شد'); ?>
                                    <?php $backend->setAlert('st','1','success','وضعیت با موفقیت تغییر یافت'); ?>
                                    <?php $backend->setAlert('d','0','danger','بدلیل دارا بودن فرزند قابل حذف نمی باشد'); ?>
                                </div>
                                <?php 
                           if ($resPagination['totalRows']==0 && $where != '') {
                           ?>
                                <div class="col-md-12 text-center mx-auto mt-5">
                                    <?php $backend->setAlert('','','warning','هیچ رکوردی برای نمایش یافت نشد');?>
                                </div>
                                <?php
                           }
                           ?>
                                <?php $backend->showLimitTable($url);?>
                                <form action="" method="post">
                                    <button class="btn-sm btn-danger border-0" value="1" name="btn_del_gp"
                                        type="submit">حذف گروهی</button>
                                    <table
                                        class="table table-bordered table-responsive-sm table-hover table-responsive-md table-responsive-xl overflow-auto">
                                        <thead>
                                            <tr>
                                                <th width="1px"><input type="checkbox" id="check-all"></th>
                                                <th width="1px"><?php $backend->tableFieldSort($url,'#','id'); ?></th>
                                                <th><?php $backend->tableFieldSort($url,'عنوان(FA)','title_fa'); ?></th>
                                                <th><?php $backend->tableFieldSort($url,'عنوان(EN)','title_en'); ?></th>
                                                <th><?php $backend->tableFieldSort($url,'دسته','cat_id'); ?></th>
                                                <th><?php $backend->tableFieldSort($url,'زیردسته','sub_cat_id'); ?></th>
                                                <th><?php $backend->tableFieldSort($url,'مدل','model'); ?></th>
                                                <th><?php $backend->tableFieldSort($url,'کد','code'); ?></th>
                                                <th><?php $backend->tableFieldSort($url,'قیمت','price'); ?>(تومان)</th>
                                                <?php 
                                    if ($discount!="") {
                                    ?>
                                                <th><?php $backend->tableFieldSort($url,'تخفیف','discount'); ?></th>
                                                <?php 
                                    }
                                    ?>

                                                <!-- <th></th> -->
                                                <th width="1px">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                 $idList=$backend->renderId($resPagination['totalRows']);
                                 while ($row=$backend->getRow($resPagination['result'])) {
                                 $parent=$backend->getCategoryTitle($row['sub_cat_id']);
                                 $cat=$backend->getCategoryTitle($row['cat_id']);
                                 ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkbox_rows[]"
                                                        value="<?php print $row['id']; ?>" class="check-group"></td>
                                                <td class="text-center"> <?php print $idList; ?> </td>
                                                <td class="text-wrap text-break" style="line-height: 15px;">
                                                    <?php print $row['title_fa']; ?>
                                                </td>
                                                <td class="text-wrap" style="line-height:15px;">
                                                    <?php print $row['title_en']; ?></td>
                                                <td><?php print $cat['title']; ?></td>
                                                <td><?php (isset($parent))?print $parent['title']:print''; ?></td>
                                                <td class="text-wrap"><?php print $row['model']; ?></td>
                                                <td><?php print $row['code']; ?></td>
                                                <td><?php print number_format($backend->toFloat($row['price'])); ?></td>
                                                <?php 
                                    if ($discount!="") {
                                    ?>
                                                <td>
                                                    <?php print number_format($backend->toFloat($row['discount'])); ?>
                                                </td>
                                                <?php 
                                    }
                                    ?>
                                                <td>
                                                    <?php 
                                       if ($row['is_special']==1) {
                                          ?>
                                                    <button
                                                        onclick="redirect('<?php print "$url&p=$backend->page&sp_id=$row[id]&val=0"; ?>')"
                                                        data-toggle="tooltip" title="غیر ویژه کردن محصول" type="button"
                                                        class="btn-sm btn-danger border-0">
                                                        <i class="mdi mdi-star-off"></i>
                                                    </button>
                                                    <?php
                                       }else{
                                          ?>
                                                    <button
                                                        onclick="redirect('<?php print "$url&p=$backend->page&sp_id=$row[id]&val=1"; ?>')"
                                                        data-toggle="tooltip" title="ویژه سازی محصول" type="button"
                                                        class="btn-sm btn-info border-0">
                                                        <i class="mdi mdi-star"></i>
                                                    </button>
                                                    <?php
                                       }
                                       ?>

                                                    <?php 
                                       if ($row['status']==1) {
                                          ?>
                                                    <button onclick="change_status(<?php print $row['id'] ?>,0)"
                                                        data-toggle="tooltip" title="غیر فعال کردن محصول" type="button"
                                                        class="btn-sm btn-danger border-0">
                                                        <i class="mdi mdi-eye-off"></i>
                                                    </button>
                                                    <?php
                                       }else{
                                          ?>
                                                    <button onclick="change_status(<?php print $row['id'] ?>,1)"
                                                        data-toggle="tooltip" title="فعال کردن محصول" type="button"
                                                        class="btn-sm btn-success border-0">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    <?php
                                       }
                                       ?>

                                                    <a data-toggle="tooltip" title="ویرایش"
                                                        href="<?php print ADMIN_URL ?>edit_prod.php<?php print $url; ?>&index=<?php print $row['id']; ?>&p=<?php print $backend->page; ?>"
                                                        class="btn-sm btn-warning"><i class="mdi mdi-pencil"></i></a>

                                                    <button data-id="<?php print $row['id']; ?>"
                                                        data-idlist="<?php print $idList; ?>"
                                                        data-title="<?php print $row['title_fa']; ?>"
                                                        data-toggle="modal" data-target="#deleteModal" type="button"
                                                        rel="tooltip" title="حذف" class="btn-sm btn-danger border-0"><i
                                                            class="mdi mdi-delete-empty"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                              ($_SESSION['sort']=='asc')?$idList++:$idList--;
                              }
                              ?>
                                        </tbody>
                                    </table>
                                </form>
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
    <script src="js/lib.js"></script>
    <script>
    $(document).ready(function() {
        $('[rel="tooltip"]').tooltip({
            trigger: "hover"
        });

        $('#check-all').click(function() {
            var checkbox = $(this).is(':checked');
            $('.check-group').each(function() {
                $(this).prop('checked', checkbox);
            });
        });

        $('#deleteModal').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var idlist = button.data('idlist');
            var id = button.data('id');
            console.log(button);
            $(this).find('#delete-title').html(title);
            $(this).find('#delete-id').html(idlist);
            $(this).find('#delete-btn').attr('data-del-id', id);
        });

        $('#delete-btn').click(function() {
            var id = $(this).attr('data-del-id');
            redirect('<?php print "$url&p=$backend->page&del_id=" ?>' + id);
        });

        $('#cat_id').change(function() {
            var id = parseInt($(this).val());
            if (id > 0) {
                $('#sub_cat_id option:gt(0)').remove();
                $.post('ajax.php', {
                    'task': 'getSubCat',
                    'id': id
                }, function(data) {
                    $('#sub_cat_id').html(data);
                });
            } else {
                $('#sub_cat_id option:gt(0)').remove();
            }
        });

    });

    function change_status(id, val) {
        var url = '<?php print "$url&p=$backend->page"; ?>&st_id=' + id + '&val=' + val;
        redirect(url);
    }
    </script>
    <!-- End custom js for this page -->
</body>

</html>