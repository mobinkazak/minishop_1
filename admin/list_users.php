<?php require_once '../loader.php';
$email = $backend->safeString($backend->get('email'));
$mobile = $backend->toInt($backend->get('mobile'));
$firstname = $backend->safeString($backend->get('firstname'));
$lastname = $backend->safeString($backend->get('lastname'));

if ($backend->get('status') == '')
    $status = -1;
else
    $status = $backend->toInt($backend->get('status'));

if ($backend->get('is_admin') == '')
    $is_admin = -1;
else
    $is_admin = $backend->toInt($backend->get('is_admin'));

$url = "?email=$email&mobile=$mobile&firstname=$firstname&lastname=$lastname&status=$status&is_admin=$is_admin";
$where = '';
if (!empty($email))
    $where .= " AND email LIKE '%$email%' ";

if (!empty($mobile))
    $where .= " AND mobile LIKE '%$mobile%' ";

if (!empty($firstname))
    $where .= " AND firstname LIKE '%$firstname%' ";

if (!empty($lastname))
    $where .= " AND lastname LIKE '%$lastname%' ";

if ($status >= 0)
    $where .= " AND status='$status' ";

if ($is_admin >= 0)
    $where .= " AND is_admin='$is_admin' ";

$backend->setSortCol(['id', 'firstname', 'lastname', 'email', 'mobile', 'status', 'is_admin','last_login']);

$resPagination = $backend->pagination('users', $where);

if ($backend->get('a_id') != '' && $backend->get('val') != '') {
    $res = $backend->changeUserType($backend->get('a_id'), $backend->get('val'));
    if ($res ==1) {
        $backend->redirect("$url&p=$backend->page&admin=1");
    } else {
        $backend->redirect("$url&p=$backend->page&admin=0");
    }
}
if ($backend->get('st_id') != '' && $backend->get('val') != '') {
    $res = $backend->changeUserStatus($backend->get('st_id'), $backend->get('val'));
    if ($res == 1) {
        $backend->redirect("$url&p=$backend->page&st=1");
    } else {
        $backend->redirect("$url&p=$backend->page&st=0");
    }
}

if ($backend->get('del_id')) {
    $resDel = $backend->deleteUser($backend->get('del_id'));
    $backend->redirect("$url&p=$backend->page&d=$resDel");
}

if ($backend->post('btn_del_gp') && isset($_POST['checkbox_rows'])) {
    $checkbox_rows = $_POST['checkbox_rows'];
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
    <title>لیست کاربران</title>
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
                        آیا میخواهید 
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
                        if ($resPagination['totalRows'] == 0 && $where == '') {
                        ?>
                            <div class="col-md-12 text-center mx-auto mt-5">
                                <?php $backend->setAlert('', '', 'warning', 'هیچ رکوردی برای نمایش یافت نشد'); ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="card">
                                <div class="card-body px-3">
                                    <h4 class="card-title">لیست کاربران</h4>
                                    <div class="card-description py-4" style="background-color: #181824;border-radius: 3px;">
                                        <div class="col-md-12">
                                            <form method="get" action="">
                                                <div class="input-group mx-auto">
                                                    <input class="text-dark px-2 py-2 col" value="<?php print $email; ?>" data-toggle="tooltip" title="ایمیل را وارد نمایید" style="border:1px solid #ddd;" type="text" dir="ltr" name="email" placeholder="ایمیل">
                                                    <input class="text-dark px-2 col" value="<?php print $mobile; ?>" data-toggle="tooltip" title="موبایل را وارد نمایید" style="border:1px solid #ddd;" type="text" name="mobile" placeholder="موبایل">
                                                    <input class="text-dark px-2 py-2 col" value="<?php print $firstname; ?>" data-toggle="tooltip" title="نام را وارد نمایید" style="border:1px solid #ddd;" type="text" name="firstname" placeholder="نام">
                                                    <input class="text-dark px-2 col" value="<?php print $lastname; ?>" data-toggle="tooltip" title="نام خانوادگی را وارد نمایید" style="border:1px solid #ddd;" type="text" name="lastname" placeholder="نام خانوادگی">
                                                    <div class="input-group-append">

                                                        <select name="status" id="status" style="font-size:14px;border:1px solid #ddd;">
                                                            <option value="-1" <?php ($status == -1) ? print 'selected' : print ''; ?>>وضعیت کاربر</option>
                                                            <option value="1" <?php ($status == 1) ? print 'selected' : print ''; ?>>فعال
                                                            </option>
                                                            <option value="0" <?php ($status == 0) ? print 'selected' : print ''; ?>>غیر فعال
                                                            </option>
                                                        </select>
                                                        <select name="is_admin" id="is_admin" style="font-size:14px;border:1px solid #ddd;">
                                                            <option value="-1" <?php ($is_admin == -1) ? print 'selected' : print ''; ?>>همه کاربرها</option>
                                                            <option value="1" <?php ($is_admin == 1) ? print 'selected' : print ''; ?>>مدیران
                                                            </option>
                                                            <option value="0" <?php ($is_admin == 0) ? print 'selected' : print ''; ?>>کاربران
                                                            </option>
                                                        </select>
                                                        <button data-toggle="tooltip" title="جستجو" type="submit" class="btn btn-success px-3"> جستجو <i style="font-size:15px" class="mdi mdi-magnify"></i></button>
                                                        <button type="button" onclick="redirect('?');" data-toggle="tooltip" title="پاک کن" class="btn btn-info px-3">پاک کن <i style="font-size:15px" class="mdi mdi-auto-fix"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <?php $backend->setAlert('d', '1', 'success', 'کاربر مورد نظر با موفقیت حذف شد'); ?>
                                        <?php $backend->setAlert('st', '1', 'success', 'وضعیت کاربر مورد نظر به فعال تغییر یافت'); ?>
                                        <?php $backend->setAlert('st', '0', 'success', 'وضعیت کاربر مورد نظر به غیر فعال تغییر یافت'); ?>
                                        <?php $backend->setAlert('admin', '1', 'warning', 'نوع کاربر مورد نظر به مدیر تغییر یافت'); ?>
                                        <?php $backend->setAlert('admin', '0', 'warning', 'نوع کاربر مورد نظر به کاربر تغییر یافت'); ?>
                                        <?php $backend->setAlert('d', '0', 'danger', 'بدلیل دارا بودن فرزند قابل حذف نمی باشد'); ?>
                                    </div>
                                    <?php
                                    if ($resPagination['totalRows'] == 0 && $where != '') {
                                    ?>
                                        <div class="col-md-12 text-center mx-auto mt-5">
                                            <?php $backend->setAlert('', '', 'warning', 'هیچ رکوردی برای نمایش یافت نشد'); ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php $backend->showLimitTable($url); ?>
                                    <table class="table table-bordered table-responsive-sm table-hover table-responsive-md table-responsive-xl overflow-auto">
                                        <thead>
                                            <tr>
                                                <th width="1px">تصویر</th>
                                                <th width="1px"><?php $backend->tableFieldSort($url, '#', 'id'); ?></th>
                                                <th><?php $backend->tableFieldSort($url, 'نام', 'firstname'); ?></th>
                                                <th><?php $backend->tableFieldSort($url, 'نام خانوادگی', 'lastname'); ?></th>
                                                <th><?php $backend->tableFieldSort($url, 'ایمیل', 'email'); ?></th>
                                                <th><?php $backend->tableFieldSort($url, 'موبایل', 'mobile'); ?></th>
                                                <th><?php $backend->tableFieldSort($url, 'وضعیت', 'status'); ?></th>
                                                <th><?php $backend->tableFieldSort($url, 'نوع کاربر', 'is_admin'); ?></th>
                                                <th><?php $backend->tableFieldSort($url, 'آخرین ورود', 'last_login'); ?></th>
                                                <th width="1px">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $idList = $backend->renderId($resPagination['totalRows']);
                                            while ($row = $backend->getRow($resPagination['result'])) {

                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $path = "../$row[avatar]";
                                                        if ($row['avatar'] == '' || !file_exists($path)) {
                                                        ?>
                                                            <img class="rounded-circle" src="<?php print SITE_URL . "/avatars/avatar.png" ?>">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img class="rounded-circle" src="<?php print $path; ?>">
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center"> <?php print $idList; ?> </td>
                                                    <td class="">
                                                        <?php print $row['firstname']; ?>
                                                    </td>
                                                    <td><?php print $row['lastname']; ?></td>
                                                    <td><?php print $row['email']; ?></td>
                                                    <td>
                                                        <?php 
                                                        if($row['mobile'] == '' || $row['mobile'] == 0) { 
                                                            print 'ندارد';
                                                        }else{
                                                            print "0$row[mobile]"; 
                                                        }
                                                         ?>
                                                        </td>
                                                    <td><?php $row['status'] == 1 ? print 'فعال' : print 'غیرفعال'; ?></td>
                                                    <td><?php $row['is_admin'] == 1 ? print 'مدیر' : print 'کاربر'; ?></td>
                                                    <td><?php ($row['last_login']!='0000-00-00 00:00:00')? print $backend->persianDate($row['last_login']):print ''; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['is_admin'] == 1) {
                                                        ?>
                                                            <button onclick="redirect('<?php print "$url&p=$backend->page&a_id=$row[id]&val=0"; ?>')" data-toggle="tooltip" title="تبدیل مدیر به کاربر" type="button" class="btn-sm btn-info border-0">
                                                                <i class="mdi mdi-account-remove"></i>
                                                            </button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button onclick="redirect('<?php print "$url&p=$backend->page&a_id=$row[id]&val=1"; ?>')" data-toggle="tooltip" title="تبدیل کاربر به مدیر" type="button" class="btn-sm btn-dark border-0">
                                                                <i class="mdi mdi-account-star"></i>
                                                            </button>
                                                        <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($row['status'] == 1) {
                                                        ?>
                                                            <button onclick="change_status(<?php print $row['id'] ?>,0)" data-toggle="tooltip" title="غیر فعال کردن کاربر" type="button" class="btn-sm btn-danger border-0">
                                                                <i class="mdi mdi-close"></i>
                                                            </button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button onclick="change_status(<?php print $row['id'] ?>,1)" data-toggle="tooltip" title="فعال کردن کاربر" type="button" class="btn-sm btn-success border-0">
                                                                <i class="mdi mdi-check"></i>
                                                            </button>
                                                        <?php
                                                        }
                                                        ?>

                                                        <a data-toggle="tooltip" title="ویرایش" href="<?php print ADMIN_URL ?>edit_user.php<?php print $url; ?>&uid=<?php print $row['id']; ?>&p=<?php print $backend->page; ?>" class="btn-sm btn-warning"><i class="mdi mdi-pencil"></i></a>

                                                        <button data-id="<?php print $row['id']; ?>" data-idlist="<?php print $idList; ?>" data-title="<?php print $row['email']; ?>" data-toggle="modal" data-target="#deleteModal" type="button" rel="tooltip" title="حذف" class="btn-sm btn-danger border-0"><i class="mdi mdi-delete-empty"></i></button>
                                                    </td>
                                                </tr>
                                            <?php
                                                ($_SESSION['sort'] == 'asc') ? $idList++ : $idList--;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php $backend->renderPagination($url, $resPagination['totalPage']); ?>
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

            $('#deleteModal').on('shown.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var title = button.data('title');
                var idlist = button.data('idlist');
                var id = button.data('id');
                $(this).find('#delete-title').html(title);
                $(this).find('#delete-id').html(idlist);
                $(this).find('#delete-btn').attr('data-del-id', id);
            });

            $('#delete-btn').click(function() {
                var id = $(this).attr('data-del-id');
                redirect('<?php print "$url&p=$backend->page&del_id=" ?>' + id);
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