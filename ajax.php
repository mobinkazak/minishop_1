<?php
require_once 'loader.php';
$do=$_POST['do'];
if ($do=='checkEmail') {
    $email=$frontend->safeString($frontend->post('email'));
    if ($frontend->checkUserEmail($email)) {
        print true;
    }else{
        print 2;
    }
}

