<?php $profile=$backend->getProfile(); 

?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-item2">
              <a class="nav-link" href="<?php print ADMIN_URL; ?>">
                <span class="menu-title">داشبورد</span>
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
              </a>
            </li>
            <li class="nav-item nav-item2">
              <a class="nav-link" data-toggle="collapse" href="#cat_mng" aria-expanded="false">
                <span class="menu-title">مدیریت دسته ها</span><i class="mr-2 menu-arrow"></i>
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
              </a>
              <div class="collapse" id="cat_mng">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php print ADMIN_URL; ?>add_cat.php">ثبت دسته جدید</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php print ADMIN_URL; ?>list_cat.php">لیست دسته ها</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item nav-item2">
              <a class="nav-link" data-toggle="collapse" href="#prod_mng" aria-expanded="false">
                <span class="menu-title">مدیریت محصولات</span><i class="mr-2 menu-arrow"></i>
                <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
              </a>
              <div class="collapse" id="prod_mng">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php print ADMIN_URL; ?>add_prod.php">ثبت محصول جدید</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php print ADMIN_URL; ?>list_prod.php">لیست محصولات</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item nav-item2">
              <a class="nav-link" data-toggle="collapse" href="#users_mng" aria-expanded="false">
                <span class="menu-title">مدیریت کاربران</span><i class="mr-2 menu-arrow"></i>
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
              </a>
              <div class="collapse" id="users_mng">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php print ADMIN_URL; ?>add_users.php">ثبت کاربر جدید</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php print ADMIN_URL; ?>list_users.php">لیست کاربران</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item nav-item2">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Forms</span>
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
              </a>
            </li>
            <li class="nav-item nav-item2">
              <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">Tables</span>
                <span class="icon-bg"><i class="mdi mdi-table-large menu-icon"></i></span>
              </a>
            </li>
            <li class="nav-item nav-item2">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title"><i class="mr-2 menu-arrow"></i>User Pages</span>
                <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
                
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li>
            <li class="my-3"></li>
            <li class="nav-item sidebar-user-actions">
              <div class="user-details">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="d-flex align-items-center">
                      <div class="sidebar-profile-img">
                        <?php
            if (!empty($profile['avatar']) && file_exists($profile['avatar'])) {
            ?>
            <img class="img-avatar img-avatar48" style="margin-left: 4px;width:40px;height:28px;" src="<?php print "../$profile[avatar]" ?>" alt="image">
            <?php
            }else{
              ?>
              <img class="img-avatar img-avatar48" style="margin-left: 4px;width:40px;height:28px;" src="../avatars/avatar.png" alt="image">

              <?php
            }
            ?>
                      </div>
                      <div class="sidebar-profile-text mr-3">
                        <p class="mb-1"><?php print $profile['firstname'].' '.$profile['lastname']; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="badge badge-danger">3</div>
                </div>
              </div>
            </li>
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="#" class="nav-link">
                  <span class="menu-title">تنظیمات</span>
                  <i class="mdi mdi-settings menu-icon"></i>
                </a>
              </div>
            </li>
            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="?logout=1" class="nav-link">
                  <span class="menu-title">خروج</span>
                  <i class="mdi mdi-logout menu-icon"></i>
                </a>
              </div>
            </li>
          </ul>
        </nav>