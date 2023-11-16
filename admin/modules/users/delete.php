<?php
if (!defined('_INCODE')) {
  die('Access denied');
}
//Xử lý xóa người dùng
$body = getBody();
if (!empty($body['id'])) {
  $userId = $body['id'];
  $userDetails = getRows("SELECT id FROM users WHERE id=$userId");
  if ($userDetails > 0) {

    //Thực hiện xóa
    //  1. Xóa login_token
    $deleteToken = delete('login_token', "user_id=$userId");
    if ($deleteToken) {
      // 2.Xóa người dùng
      $deleteUser = delete('users', "id=$userId");
      if ($deleteUser) {
        setFlashData('msg', 'Xoá người dùng thành công');
        setFlashData('msg_type', 'success');
      } else {
        setFlashData('msg', 'Lỗi hệ thống! Vui lòng thử lại sau');
        setFlashData('msg_type', 'danger');
      }
    }
  } else {
    setFlashData('msg', 'Người dùng không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}
redirect('admin/?module=users');
