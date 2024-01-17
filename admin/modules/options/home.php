<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Thiết lập trang chủ'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

updateOptions();

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');

//Lấy dữ liệu tất cả chuyên mục
$allCategories = getRaw("SELECT id, name FROM blog_categories ORDER BY name");

?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <form action="" method="post">
      <?php
      getMsg($msg, $msgType);
      ?>
      <h5>Thiết lập slide</h5>
      <div class="slide-wrapper">
        
      </div><!-- End slide--wrapper -->
      <p><button type="button" class="btn btn-warning btn-sm add-slide">Thêm slide</button></p>
      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
  </div>
</section>

<?php
layout('footer', 'admin', $data);
