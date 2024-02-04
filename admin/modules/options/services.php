<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Thiết lập dịch vụ'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

updateOptions();

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');

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
        <label for=""><?php echo getOption('service_title', 'label'); ?></label>
        <input type="text" class="form-control" name="service_title" placeholder="<?php echo getOption('service_title', 'label'); ?>" value="<?php echo getOption('service_title'); ?>" />
        <?php echo form_error('service_title', $errors, '<span class="error">', '</span>'); ?>
      </div>
      <hr>

      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
  </div>
</section>

<?php
layout('footer', 'admin', $data);
