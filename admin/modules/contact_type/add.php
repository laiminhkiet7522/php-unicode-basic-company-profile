<?php
if (isPost()) {

  //Validate form
  $body = getBody(); //Lấy tất cả dữ liệu trong form

  $errors = []; //Mảng lưu trữ các lỗi

  //Validate tên phòng ban: Bắt buộc nhập, >=4 ký tự
  if (empty(trim($body['name']))) {
    $errors['name']['required'] = 'Tên phòng ban bắt buộc phải nhập';
  } else {
    if (strlen(trim($body['name'])) < 4) {
      $errors['name']['min'] = 'Tên phòng ban phải >=4 ký tự';
    }
  }

  //Kiểm tra mảng $errors
  if (empty($errors)) {
    //Không có lỗi xảy ra

    $dataInsert = [
      'name' => trim($body['name']),
      'create_at' => date('Y-m-d H:i:s')
    ];

    $insertStatus = insert('contact_type', $dataInsert);

    if ($insertStatus) {
      setFlashData('msg', 'Thêm phòng ban thành công');
      setFlashData('msg_type', 'success');

      redirect('admin?module=contact_type'); //Chuyển hướng qua trang danh sách

    } else {
      setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
      setFlashData('msg_type', 'danger');

      redirect('admin?module=contact_type'); //Load lại trang thêm phòng ban người dùng
    }
  } else {

    //Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);
    redirect('admin?module=contact_type'); //Load lại trang phòng ban người dùng
  }
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>
<h4>Thêm phòng ban</h4>
<form action="" method="post">
  <div class="form-group">
    <label for="">Tên phòng ban</label>
    <input type="text" class="form-control" name="name" placeholder="Tên phòng ban.." value="<?php echo old('name', $old); ?>" />
    <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
  </div>

  <button type="submit" class="btn btn-primary">Thêm mới</button>
</form>