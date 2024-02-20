<?php
if (!defined('_INCODE')) die('Access Deined...');
/*File này chứa chức năng đăng xuất*/
if (isLogin()) {
    $token = getSession('loginToken');
    delete('login_token', "token='$token'");
    removeSession('loginToken');
    if (!empty($_SERVER['HTTP_REFERER'])) {
        redirect($_SERVER['HTTP_REFERER'], true);
    }
    redirect('admin?module=auth&action=login');
}
