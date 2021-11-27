<?php 
ini_set("display_errors","on");
error_reporting(-1);
ob_start();
session_start();
date_default_timezone_set('Asia/Tehran');

require_once 'config.php';
require_once 'lib/jdf.php';
require_once 'lib/base.php';

if (stristr($_SERVER['REQUEST_URI'],'/admin/')) {
	require_once 'lib/backend.php';
	$backend=new Backend();
	if (!stristr($_SERVER['PHP_SELF'],'login.php')) {
		if (!$backend->isLogin('admin_id')) {
		$backend->redirect('login.php?err=logup');
		}
	}
	if ($backend->get('logout')==1) {
	$backend->beforeLogout();
    unset($_SESSION['admin_id']);
    session_destroy();
    $backend->redirect('login.php?msg=logout');
  	}
}else{
	require_once 'lib/frontend.php';
	$frontend=new Frontend();
}