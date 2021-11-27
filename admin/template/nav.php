<?php 
  $profile=$backend->getProfile();

?>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="<?php print ADMIN_URL; ?>"><h4 class="text-light">Minishop</h4></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch p-0">
    <button class="navbar-toggler navbar-toggler align-self-center p-3" type="button" data-toggle="minimize">
    <span class="mdi mdi-menu"></span>
    </button>
    <div class="search-field d-none d-xl-block" style="">
      <form class="d-flex align-items-center" action="#">
        <div class="input-group p-0 mt-3">
          <div class="input-group-prepend">
            <!-- <i class="input-group-text border-0 mdi mdi-magnify py-0 px-3"></i> -->
          <button class="input-group-text text-transparent border-0 mdi mdi-magnify py-0 px-2"></button>
          </div>
          <input type="text" class="form-control bg-transparent border-0" placeholder="جستجو">
        </div>
      </form>
    </div>
    <ul class="navbar-nav navbar-nav-right mr-auto">
      <li class="nav-item  dropdown d-none d-md-block">
        <a class="nav-link dropdown-toggle" id="reportDropdown" href="#" data-toggle="dropdown" aria-expanded="false"> Reports </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="reportDropdown">
          <a class="dropdown-item" href="#">
          <i class="mdi mdi-file-pdf mr-2"></i>PDF </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
          <i class="mdi mdi-file-excel mr-2"></i>Excel </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
          <i class="mdi mdi-file-word mr-2"></i>doc </a>
        </div>
      </li>
      <li class="nav-item  dropdown d-none d-md-block">
        <a class="nav-link dropdown-toggle" id="projectDropdown" href="#" data-toggle="dropdown" aria-expanded="false"> Projects </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="projectDropdown">
          <a class="dropdown-item" href="#">
          <i class="mdi mdi-eye-outline mr-2"></i>View Project </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
          <i class="mdi mdi-pencil-outline mr-2"></i>Edit Project </a>
        </div>
      </li>
      
    </ul>
    <div class="pull-left dropdown">
      <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img ml-1">
            <img src="<?php print $profile['avatar']; ?>" alt="image">
          </div>
          <div class="nav-profile-text ml-0">
            <p class="mt-3 text-black"><?php print $profile['firstname'].' '.$profile['lastname'] ?></p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
          <div class="p-3 text-center bg-primary">
            <img class="img-avatar img-avatar48 img-avatar-thumb" src="<?php $profile['avatar']; ?>" alt="">
          </div>
          <div class="p-2">
           <!--  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
              <span>Inbox</span>
              <span class="p-0">
                <span class="badge badge-primary">3</span>
                <i class="mdi mdi-email-open-outline ml-1"></i>
              </span>
            </a> -->
            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="<?php print ADMIN_URL.'profile.php' ?>">
              <span>مشخصات</span>
              <span class="p-0">
                <span class="badge badge-success">1</span>
                <i class="mdi mdi-account-outline"></i>
              </span>
            </a>
            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="javascript:void(0)">
              <span>تنظیمات</span>
              <i class="mdi mdi-settings"></i>
            </a>
            <div role="separator" class="dropdown-divider"></div>
            <!-- <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
              <span>Lock Account</span>
              <i class="mdi mdi-lock ml-1"></i>
            </a> -->
            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="?logout=1">
              <span>خروج</span>
              <i class="mdi mdi-logout"></i>
            </a>
          </div>
        </div>
    </div>
    <div class="ml-3 mr-3 pull-left">
      <p style="font-size:13px;" class="text-center d-flex flex-column mt-3 text-muted font-italic">آخرین ورود شما<b><?php print $backend->persianDate($profile['last_login']); ?></b></p>
    </div>
  </div>
</nav>