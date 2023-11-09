<?php
//File này chứa các hằng số cấu hình

date_default_timezone_set('Asia/Ho_Chi_Minh');

//Thiết lập hằng số cho client
const _MODULE_DEFAULT = 'home'; //Module mặc định
const _ACTION_DEFAULT = 'lists'; //Action mặc định

//Thiết lập hằng số cho admin
const _MODULE_DEFAULT_ADMIN = 'dashboard';

const _INCODE = true; //Ngăn chặn hành vi truy cập trực tiếp vào file

//Thiết lập host

define('_WEB_HOST_ROOT', 'http://'.$_SERVER['HTTP_HOST'].'/php-unicode-basic-company-profile'); //Địa chỉ trang chủ

define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT.'/templates/client');

define('_WEB_HOST_ROOT_ADMIN', _WEB_HOST_ROOT.'/admin');

define('_WEB_HOST_ADMIN_TEMPLATE', _WEB_HOST_ROOT.'/templates/admin');

//Thiết lập path
define('_WEB_PATH_ROOT', __DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/templates');

//Thiết lập kết nối database

const _HOST = 'localhost';
const _USER = 'root';
const _PASS = ''; //Xampp => pass='';
const _DB = 'php_online_radix';
const _DRIVER = 'mysql';

//Thiết lập số lượng bản ghi hiển thị trên 1 trang
const _PER_PAGE = 10;