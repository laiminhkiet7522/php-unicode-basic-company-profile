<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Cấu hình chung'
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
      <h5>Thông tin liên hệ</h5>
      <div class="form-group">
        <label for=""><?php echo getOption('general_hotline', 'label') ?></label>
        <input type="text" class="form-control slug" name="general_hotline" placeholder="Hotline..." value="<?php echo getOption('general_hotline'); ?>" />
        <?php echo form_error('general_hotline', $errors, '<span class="error">', '</span>'); ?>
      </div>
      <div class="form-group">
        <label for=""><?php echo getOption('general_email', 'label') ?></label>
        <input type="text" class="form-control slug" name="general_email" placeholder="Email..." value="<?php echo getOption('general_email'); ?>" />
        <?php echo form_error('general_email', $errors, '<span class="error">', '</span>'); ?>
      </div>
      <div class="form-group">
        <label for=""><?php echo getOption('general_time', 'label') ?></label>
        <input type="text" class="form-control slug" name="general_time" placeholder="Thời gian làm việc..." value="<?php echo getOption('general_time'); ?>" />
        <?php echo form_error('general_time', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
  </div>
</section>

<?php
layout('footer', 'admin', $data);
