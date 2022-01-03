<?php
require_once '../loader.php';

$title_fa = $backend->safeString($backend->get('title_fa'));
$title_en = $backend->safeString($backend->get('title_en'));
$model = $backend->safeString($backend->get('model'));
$price = $backend->safeString($backend->get('price'));
$code = $backend->safeString($backend->get('code'));
$discount = $backend->safeString($backend->get('discount'));

if ($backend->get('status') == '')
    $status = -1;
else
    $status = $backend->toInt($backend->get('status'));

if ($backend->get('cat_id') == '')
    $cat_id = -1;
else
    $cat_id = $backend->toInt($backend->get('cat_id'));

if ($backend->get('sub_cat_id') == '')
    $sub_cat_id = -1;
else
    $sub_cat_id = $backend->toInt($backend->get('sub_cat_id'));

if ($backend->get('special') == '')
    $is_special = -1;
else
    $is_special = $backend->toInt($backend->get('special'));

$url = "?title_fa=$title_fa&title_en=$title_en&model=$model&price=$price&code=$code&discount=$discount&cat_id=$cat_id&sub_cat_id=$sub_cat_id&status=$status&special=$is_special";

// product id
$index = $backend->toInt($backend->get('index'));

$thisProd = $backend->getProductWithId($index);

if ($backend->post('btn_update_step1')) {
    $result = $backend->updateProdStep1($index);
    if ($result > 0) {
        $backend->redirect("$url&p=$backend->page&step=2&e=0&index=$index");
    } else {
        $backend->redirect("$url&p=$backend->page&step=1&e=$result&index=$index");
    }
}

if ($backend->post('btn_update_step2')) {
    $res = $backend->updateProdStep2($index);
    if ($res == 0) {
        $backend->redirect("$url&p=$backend->page&step=3&e=0&index=$index");
    } else {
        $backend->redirect("$url&p=$backend->page&step=2&e=$res&index=$index");
    }
}

if ($backend->post('btn_update_step3')) {
    $res = $backend->updateProdStep3Edited($index);
    if ($res == 0) {
        $backend->redirect("$url&p=$backend->page&step=4&e=0&index=$index");
    } else {
        $backend->redirect("$url&p=$backend->page&step=3&e=$res&index=$index");
    }
}

if ($backend->post('btn_update_step4')) {
    $res = $backend->updateProdStep4($index);
    if ($res == 0) {
        $backend->redirect("$url&p=$backend->page&step=1&e=0&index=$index&product=1");
    } else {
        $backend->redirect("$url&p=$backend->page&step=4&e=$res&index=$index");
    }
}
if ($backend->get('img_id')) {
    $backend->deleteImageProduct($backend->get('img_id'), $index);
    $backend->redirect("$url&p=$backend->page&step=3&index=$index&d=1");
}

$step = $backend->toInt($backend->get('step'));
if ($step == 2) {

    $tab1 = "disabled";
    $activeTab1 = "";
    $showTab1 = "";

    $tab2 = "";
    $activeTab2 = "active";
    $showTab2 = "show";

    $tab3 = "disabled";
    $activeTab3 = "";
    $showTab3 = "";

    $tab4 = "disabled";
    $activeTab4 = "";
    $showTab4 = "";
} elseif ($step == 3) {
    $tab1 = "disabled";
    $activeTab1 = "";
    $showTab1 = "";

    $tab2 = "disabled";
    $activeTab2 = "";
    $showTab2 = "";

    $tab3 = "";
    $activeTab3 = "active";
    $showTab3 = "show";

    $tab4 = "disabled";
    $activeTab4 = "";
    $showTab4 = "";
} elseif ($step == 4) {
    $tab1 = "disabled";
    $activeTab1 = "";
    $showTab1 = "";

    $tab2 = "disabled";
    $activeTab2 = "";
    $showTab2 = "";

    $tab3 = "disabled";
    $activeTab3 = "";
    $showTab3 = "";

    $tab4 = "";
    $activeTab4 = "active";
    $showTab4 = "show";
} else {
    $tab1 = "";
    $activeTab1 = "active";
    $showTab1 = "show";

    $tab2 = "disabled";
    $activeTab2 = "";
    $showTab2 = "";

    $tab3 = "disabled";
    $activeTab3 = "";
    $showTab3 = "";

    $tab4 = "disabled";
    $activeTab4 = "";
    $showTab4 = "";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>در حال ویرایش محصول <?php print $thisProd['title_fa']; ?></title>
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
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف تصویر <span id="delete-id"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>
                        آیا میخواهید تصویر
                        <b id="delete-title" class="text-danger border-bottom"></b>
                        حذف شود؟
                    </span>
                </div>
                <div class="modal-footer">
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
                        <?php $backend->setAlert('e', '-1', 'danger', 'برای رفتن به مرحله بعد لازم است فیلدهای زیر پر شود');
                        $backend->setAlert('e', '-2', 'danger', 'عنوان محصول وارد شده وجود دارد');
                        $backend->setAlert('e', '-3', 'danger', 'برای رفتن به مرحله بعد لازم است فیلدهای زیر پر باشد');
                        $backend->setAlert('e', '-4', 'danger', 'لطفا تصاویر محصول خود را انتخاب کنید');
                        $backend->setAlert('e', '-5', 'danger', 'برای اتمام مراحل ثبت محصول فیلدهای زیر را هم پر کنید');
                        $backend->setAlert('product', '1', 'success', "محصول مورد نظر با موفقیت ویرایش یافت");
                        $backend->setAlert('d', '1', 'success', "تصویر مورد نظر با موفقیت حذف شد");
                        ?>

                        <div class="tab-pane fade <?php print $activeTab1; ?> <?php print $showTab1; ?>" id="step1" role="tabpanel">
                            <form class="form_1" method="post" action="" autocomplete="off">
                                <div class="form-group">
                                    <label for="cat_id">دسته محصول</label><span class="star"></span>
                                    <select class="form-control" dir="rtl" name="cat_id" id="cat_id">
                                        <option value="0">دسته بندی مورد نظر خود را انتخاب کنید</option>
                                        <?php

                                        $catRes = $backend->getParentCategoryList();
                                        while ($parentRow = $backend->getRow($catRes)) {
                                        ?>
                                            <option <?php if ($index) ($parentRow['id'] == $thisProd['cat_id']) ? print 'selected' : print ''; ?> value="<?php print $parentRow['id'] ?>"><?php print $parentRow['title']; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_cat_id">زیردسته محصول</label><span class="star"></span>
                                    <select class="form-control" dir="rtl" name="sub_cat_id" id="sub_cat_id">
                                        <option value="-1">-----------------------------------</option>
                                        <?php

                                        $subRes = $backend->getParentCategoryList($thisProd['cat_id']);
                                        while ($subCatRow = $backend->getRow($subRes)) {
                                        ?>
                                            <option <?php if ($index) ($subCatRow['id'] == $thisProd['sub_cat_id']) ? print 'selected' : print ''; ?> value="<?php print $subCatRow['id'] ?>"><?php print $subCatRow['title']; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title_fa">عنوان محصول (فارسی)</label><span class="star"></span>
                                    <input type="text" class="form-control" name="title_fa" id="title_fa" value="<?php if ($index) print $thisProd['title_fa']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="title_en">عنوان محصول (انگلیسی)</label><span class="star"></span>
                                    <input type="text" dir="ltr" class="form-control" name="title_en" id="title_en" value="<?php if ($index) print $thisProd['title_en']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="short_desc">توضیحات کوتاه</label><span class="star"></span>
                                    <textarea style="resize:none;height:100px;" class="form-control" name="short_desc" id="short_desc"><?php if ($index) print $thisProd['short_desc']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="long_desc">توضیحات کامل</label><span class="star"></span>
                                    <textarea style="height:150px;" class="form-control" name="long_desc" id="long_desc"><?php if ($index) print $thisProd['long_desc']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>وضعیت محصول : </label><span class="star"></span>
                                    <span class="mr-4">
                                        <span class="">
                                            <label class="form-check-label" for="active">فعال</label>
                                            <input class="" type="radio" name="status" id="active" value="1" <?php if ($index) ($thisProd['status'] == 1) ? print 'checked' : print ''; ?>>
                                        </span>
                                        <span class="mr-3">
                                            <label class="form-check-label" for="inactive">غیرفعال</label>
                                            <input class="" type="radio" name="status" id="inactive" value="0" <?php if ($index) ($thisProd['status'] == 0) ? print 'checked' : print ''; ?>>
                                        </span>
                                    </span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="is_special">محصول ویژه : </label>
                                    <input class="form-check-input" type="checkbox" name="is_special" id="is_special" <?php if ($index) ($thisProd['is_special'] == 1) ? print 'checked' : print ''; ?>>
                                </div>
                                <div class="clearfix mb-1"></div>

                                <button type="submit" name="btn_update_step1" class="btn btn-info mr-2" value="1">مرحله
                                    بعد</button>
                                <a href="<?php print ADMIN_URL . "list_prod.php$url&p=$backend->page" ?>" class="btn btn-light">بازگشت</a>
                            </form>
                        </div>
                        <div class="tab-pane fade <?php print $activeTab2 ?> <?php print $showTab2; ?>" id="step2" role="tabpanel">

                            <form class="form_2" method="post" action="" autocomplete="off">
                                <div class="row">
                                    <div class=" col-md-6 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="model">مدل محصول</label><span class="star"></span>
                                            <input type="text" class="form-control" name="model" id="model" value="<?php if ($index) print $thisProd['model']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="code">کد محصول</label><span class="star"></span>
                                            <input type="text" class="form-control" name="code" id="code" value="<?php if ($index) print $thisProd['code']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="price">قیمت محصول</label><span class="star"></span>
                                            <input type="text" dir="ltr" class="form-control" name="price" id="price" value="<?php if ($index) print $thisProd['price']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="discount">قیمت تخفیف محصول</label><span class="star"></span>
                                            <input type="text" dir="ltr" class="form-control" name="discount" id="discount" value="<?php if ($index) print $thisProd['discount']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">موجودی انبار</label><span class="star"></span>
                                    <input type="text" dir="ltr" class="form-control" name="quantity" id="quantity" value="<?php if ($index) print $thisProd['quantity']; ?>">
                                </div>
                                <a href="<?php print ADMIN_URL . "edit_prod.php$url&p=$backend->page&step=1&e=0&index=$index" ?>" class="btn btn-danger">مرحله قبل</a>
                                <button type="submit" name="btn_update_step2" class="btn btn-info mr-2" value="1">مرحله
                                    بعد</button>
                                <a href="<?php print ADMIN_URL . "list_prod.php$url&p=$backend->page" ?>" class="btn btn-light">بازگشت</a>

                            </form>
                        </div>
                        <!-- step 3 -->
                        <div class="tab-pane fade <?php print $activeTab3; ?> <?php print $showTab3; ?>" id="step3" role="tabpanel">
                            <form class="form_3" method="post" action="" autocomplete="off">
                                <?php
                                if ($thisProd['thumb_img'] != '') {
                                ?>
                                    <button class="btn-sm btn-info img-show border-0 mb-2" type="button">نمایش تصویر محصول</button>

                                <?php
                                }
                                ?>
                                <div style="display:none;opacity:0.90;margin-bottom:20px;" id="image-box">
                                    <a href="<?php print SITE_URL . $thisProd['thumb_img']; ?>" target="<?php print $thisProd['thumb_img']; ?>">
                                        <img width="300px" class="img-responsive img-thumbnail" src="<?php print SITE_URL . $thisProd['thumb_img']; ?>" alt="<?php print $thisProd['title_fa']; ?>">
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label for="thumb_img">تصویر محصول</label><span class="star"></span>
                                    <input dir="ltr" placeholder="تصویر محصول را انتخاب کنید" type="text" class="form-control imgUploader" name="thumb_img" id="thumb_img" value="<?php if ($index) print $thisProd['thumb_img']; ?>">

                                </div>

                                <table class="table table-bordered" id="tbl-list">
                                    <?php
                                    $resultImg = $backend->getImageProductList($index);
                                    ?>
                                    <tr class="text-center">
                                        <th class="text-center">تصویر</th>
                                        <th class="text-center">توضیحات تصویر</th>
                                        <?php ($resultImg->num_rows > 0) ? print "<th>تصاویر محصول</th>" : print ''; ?>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                    <?php
                                    if ($resultImg->num_rows == 0) {
                                    ?>
                                        <tr class="text-center">
                                            <td>
                                                <input type="text" dir="ltr" name="img[]" placeholder="انتخاب تصویر" class="form-control imgUploader">
                                            </td>
                                            <td>
                                                <input type="text" placeholder="توضیح کوتاه تصویر" name="alt[]" class="form-control">
                                            </td>
                                            <td>
                                                <button type="button" class="btn-sm btn-success border-0 btn-add-row">
                                                    <span class="mdi mdi-plus"></span>
                                                </button>
                                                <button style="display:none;" type="button" class="btn-sm btn-danger border-0 btn-del-row">
                                                    <span class="mdi mdi-minus"></span>
                                                </button>
                                                <input type="hidden" value="0" name="imgStatus[]">
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        while ($img = $backend->getRow($resultImg)) {
                                        ?>
                                            <tr class="text-center">
                                                <td>
                                                    <input type="text" dir="ltr" name="img[]" placeholder="انتخاب تصویر" class="form-control imgUploader" value="<?php print $img['img']; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="alt[]" placeholder="توضیح کوتاه تصویر" class="form-control" value="<?php print $img['alt'] ?>">
                                                </td>
                                                <td>
                                                    <a href="<?php print SITE_URL . $img['img']; ?>" target="<?php print $img['img']; ?>">
                                                        <img src="<?php print SITE_URL . $img['img']; ?>" alt="<?php print $img['alt']; ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn-sm btn-success border-0 btn-add-row">
                                                        <span class="mdi mdi-plus"></span>
                                                    </button>
                                                    <button data-title="<?php print $img['alt']; ?>" data-id="<?php print $img['id']; ?>" style="display:inline;" type="button" class="btn-sm btn-danger border-0 btn-del-row">
                                                        <span class="mdi mdi-minus"></span>
                                                    </button>
                                                    <input type="hidden" value="<?php print $img['id']; ?>" name="imgStatus[]">
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>
                                <a href="<?php print ADMIN_URL . "edit_prod.php$url&p=$backend->page&step=2&e=0&index=$index" ?>" class="btn btn-danger">مرحله قبل</a>
                                <button type="submit" name="btn_update_step3" class="btn btn-info mr-2" value="1">مرحله
                                    بعد</button>
                                <a href="<?php print ADMIN_URL . "list_prod.php$url&p=$backend->page" ?>" class="btn btn-light">بازگشت</a>
                            </form>
                        </div>

                        <!-- step 4 -->
                        <div class="tab-pane fade <?php print $activeTab4; ?> <?php print $showTab4; ?>" id="step4" role="tabpanel">
                            <form class="form_4" method="post" action="" autocomplete="off">
                                <div class="form-group">
                                    <label for="meta_key">کلمات کلیدی (سئو)</label><span class="star"></span>
                                    <textarea style="resize:none;height:100px;" class="form-control" name="meta_key" id="meta_key"><?php if ($index) print $thisProd['meta_keywords']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_desc">توضیحات (سئو)</label><span class="star"></span>
                                    <textarea class="form-control" name="meta_desc" id="meta_desc"><?php if ($index) print $thisProd['meta_desc']; ?></textarea>
                                </div>
                                <a href="<?php print ADMIN_URL . "edit_prod.php$url&p=$backend->page&step=3&e=0&index=$index" ?>" class="btn btn-danger">مرحله قبل</a>
                                <button type="submit" name="btn_update_step4" class="btn btn-success mr-2" value="1">تکمیل
                                    ویرایش</button>
                                <a href="<?php print ADMIN_URL . "list_prod.php$url&p=$backend->page" ?>" class="btn btn-light">بازگشت</a>

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
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="js/lib.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/select2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="tinymce/tinymce.min.js"></script>
    <script src="js/numeral.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('.btn-add-row').click(function() {
                var tr = $('#tbl-list tr').eq(1).clone(true);
                tr.find('#btn-del-row').show();
                tr.find('input[type="text"]').val('');
                tr.find('input[name="imgStatus[]"]').val(0);
                tr.find('img').remove();
                tr.find('.btn-del-row').attr('data-title', '');
                tr.find('.btn-del-row').attr('data-id', 0);
                $('#tbl-list').append(tr);
            });

            $('.btn-del-row').click(function() {
                if ($(this).attr('data-id') == 0)
                    $(this).parent().parent().remove();
                else {
                    var data = $(this);
                    $('#deleteModal').modal('show', data);
                }
            });

            $('#deleteModal').on('shown.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var title = button.data('title');
                var id = button.data('id');
                $(this).find('#delete-title').html(title);
                $(this).find('#delete-btn').attr('data-del-id', id);
            });

            $('#delete-btn').click(function() {
                var id = $(this).attr('data-del-id');
                redirect('<?php print "$url&p=$backend->page&step=3&index=$index&img_id=" ?>' + id);
            });

            $('.img-show').click(function() {
                $('#image-box').toggle('slow');
            });

            initEditor('#long_desc');

            $('#cat_id').select2();
            $('#sub_cat_id').select2();

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
            priceFormat($('#price'));
            priceFormat($('#discount'));
            $('#price,#discount').keyup(function(){
                priceFormat($(this));
            });
        });
        function priceFormat(price){
            var val=numeral($(price).val()).format('0,0');
            $(price).val(val);
        }
    </script>
</body>

</html>