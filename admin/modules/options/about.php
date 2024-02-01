<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Thiết lập chung'
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
      <h5>Thiết lập tiêu đề</h5>
      <div class="form-group">
        <label for=""><?php echo getOption('about_title', 'label'); ?></label>
        <input type="text" class="form-control" name="about_title" placeholder="<?php echo getOption('about_title', 'label'); ?>" value="<?php echo getOption('about_title'); ?>" />
        <?php echo form_error('about_title', $errors, '<span class="error">', '</span>'); ?>
      </div>
      <hr>

      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
  </div>
</section>

<?php
layout('footer', 'admin', $data);
