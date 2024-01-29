<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Trang chủ'
];
layout('header', 'client', $data);

require_once 'contents/slide.php';
require_once 'contents/about.php';
require_once 'contents/service.php';
require_once 'contents/facts.php';
require_once 'contents/portfolio.php';
require_once 'contents/cta.php';
require_once 'contents/blog.php';
require_once 'contents/partner.php';

layout('footer', 'client');
?>