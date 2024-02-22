<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Cập nhật đăng ký nhận tin'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Lấy dữ liệu cũ của nhóm người dùng
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])) {
  $subscribeId = $body['id'];

  $subscribeDetail = firstRaw("SELECT * FROM subscribe WHERE id=$subscribeId");

  if (empty($subscribeDetail)) {
    //Không Tồn tại
    redirect('admin?module=subscribe');
  }
} else {
  redirect('admin?module=subscribe');
}


//Xử lý cập nhật nhóm người dùng
if (isPost()) {

  //Validate form
  $body = getBody(); //Lấy tất cả dữ liệu trong form

  $errors = []; //Mảng lưu trữ các lỗi

  //Validate tên: Bắt buộc nhập
  if (empty(trim($body['fullname']))) {
    $errors['fullname']['required'] = 'Tên bắt buộc phải nhập';
  }

  //Validate email: Bắt buộc nhập
  if (empty(trim($body['email']))) {
    $errors['email']['required'] = 'Email bắt buộc phải nhập';
  }

  //Kiểm tra mảng $errors
  if (empty($errors)) {
    //Không có lỗi xảy ra

    $dataUpdate = [
      'fullname' => trim($body['fullname']),
      'email' => trim($body['email']),
      'status' => trim($body['status']),
      'update_at' => date('Y-m-d H:i:s')
    ];

    $condition = "id=$subscribeId";

    $updateStatus = update('subscribe', $dataUpdate, $condition);

    if ($updateStatus) {
      setFlashData('msg', 'Cập nhật thông tin thành công');
      setFlashData('msg_type', 'success');
    } else {
      setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
      setFlashData('msg_type', 'danger');
    }
  } else {

    //Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);
  }

  //Load lại trang sửa hiện tại
  redirect('admin?module=subscribe&action=edit&id=' . $subscribeId);
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($subscribeDetail)) {
  $old = $subscribeDetail;
}

?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <form action="" method="post">
      <?php
      getMsg($msg, $msgType);
      ?>

      <div class="form-group">
        <label for="">Họ và tên</label>
        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên..." value="<?php echo old('fullname', $old); ?>" />
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Email</label>
        <input type="text" class="form-control" name="email" placeholder="Email..." value="<?php echo old('email', $old); ?>" />
        <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Trạng thái</label>
        <select name="status" class="form-control">
          <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa xử lý</option>
          <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Đã xử lý</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Cập nhật</button>
      <a href="<?php echo getLinkAdmin('subscribe', 'lists'); ?>" class="btn btn-success">Quay lại</a>
    </form>
  </div>
</section>

<?php
layout('footer', 'admin', $data);
