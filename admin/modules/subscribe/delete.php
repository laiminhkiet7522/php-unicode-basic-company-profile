<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $subscribeId = $body['id'];
  $subscribeDetailRows = getRows("SELECT id FROM subscribe WHERE id=$subscribeId");
  if ($subscribeDetailRows > 0) {

    //Thực hiện xoá
    $condition = "id=$subscribeId";

    $deleteStatus = delete('subscribe', $condition);
    if (!empty($deleteStatus)) {
      setFlashData('msg', 'Xoá thành công');
      setFlashData('msg_type', 'success');
    } else {
      setFlashData('msg', 'Xoá không thành công. Vui lòng thử lại sau');
      setFlashData('msg_type', 'danger');
    }
  } else {
    setFlashData('msg', 'Trang không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}

redirect('admin?module=subscribe');
