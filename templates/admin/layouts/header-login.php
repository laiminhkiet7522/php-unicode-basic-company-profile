<?php
if (!defined('_INCODE')) die('Access Deined...');
autoRemoveTokenLogin();
?>
<html>
<head>
    <title><?php echo !empty($data['pageTitle'])?$data['pageTitle']:'Unicode'; ?></title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/css/auth.css?ver=<?php echo rand(); ?>"/>
</head>
<body>
