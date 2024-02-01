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
        <label for=""><?php echo getOption('team_title', 'label'); ?></label>
        <input type="text" class="form-control" name="team_title" placeholder="<?php echo getOption('team_title', 'label'); ?>" value="<?php echo getOption('team_title'); ?>" />
        <?php echo form_error('team_title', $errors, '<span class="error">', '</span>'); ?>
      </div>
      <hr>

      <h5>Thiết lập chung</h5>
      <div class="form-group">
        <label for=""><?php echo getOption('team_primary_title', 'label'); ?></label>
        <input type="text" class="form-control" name="team_primary_title" placeholder="<?php echo getOption('team_primary_title', 'label'); ?>" value="<?php echo getOption('team_primary_title'); ?>" />
        <?php echo form_error('team_primary_title', $errors, '<span class="error">', '</span>'); ?>
      </div>
      <div class="form-group">
        <label for=""><?php echo getOption('team_title_bg', 'label'); ?></label>
        <input type="text" class="form-control" name="team_title_bg" placeholder="<?php echo getOption('team_title_bg', 'label'); ?>" value="<?php echo getOption('team_title_bg'); ?>" />
        <?php echo form_error('team_title_bg', $errors, '<span class="error">', '</span>'); ?>
      </div>
      <div class="form-group">
        <label for=""><?php echo getOption('team_desc', 'label'); ?></label>
        <textarea name="team_desc" class="form-control" placeholder="<?php echo getOption('team_desc', 'label'); ?>" rows="5" cols="20"><?php echo getOption('team_desc'); ?></textarea>
        <?php echo form_error('team_desc', $errors, '<span class="error">', '</span>'); ?>
      </div>
      <hr>

      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
  </div>
</section>

<?php
layout('footer', 'admin', $data);
