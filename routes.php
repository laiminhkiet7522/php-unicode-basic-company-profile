<?php
$route['/'] = 'index.php?module=home';
$route['bai-viet/.+-(.+).html'] = 'index.php?module=blog&action=detail&id=$1';
$route['chuyen-muc/(.+)'] = 'index.php?module=blog&action=category&id=$1';
