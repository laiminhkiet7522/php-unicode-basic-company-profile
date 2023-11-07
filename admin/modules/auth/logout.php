<?php
if (!defined('_INCODE')) die('Access Deined...');
/*File này chứa chức năng đăng xuất*/
if (isLogin()){
    $token = getSession('loginToken');
    delete('login_token', "token='$token'");
    removeSession('loginToken');
    redirect('?module=auth&action=login');
}