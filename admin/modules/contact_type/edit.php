<?php
//Lấy dữ liệu cũ của phòng ban
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])) {
  $contactTypeId = $body['id'];

  $contactTypeDetail = firstRaw("SELECT * FROM `contact_type` WHERE id=$contactTypeId");

  if (empty($contactTypeDetail)) {
    //Không Tồn tại
    redirect('admin?module=contact_type');
  }
} else {
  redirect('admin?module=contact_type');
}

//Xử lý cập nhật phòng ban
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

    $dataUpdate = [
      'name' => trim($body['name']),
      'update_at' => date('Y-m-d H:i:s')
    ];

    $condition = "id=$contactTypeId";

    $updateStatus = update('contact_type', $dataUpdate, $condition);

    if ($updateStatus) {
      setFlashData('msg', 'Cập nhật phòng ban thành công');
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
  redirect('admin?module=contact_type&action=lists&view=edit&id=' . $contactTypeId);
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($contactTypeDetail)) {
  $old = $contactTypeDetail;
}

?>
<h4>Cập nhật phòng ban</h4>
<form action="" method="post">
  <div class="form-group">
    <label for="">Tên phòng ban</label>
    <input type="text" class="form-control" name="name" placeholder="Tên phòng ban.." value="<?php echo old('name', $old); ?>" />
    <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="<?php echo getLinkAdmin('contact_type', 'lists'); ?>" class="btn btn-success">Quay lại</a>
</form>