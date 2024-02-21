<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $commentId = $body['id'];
  $commentDetail = getRows("SELECT id FROM comments WHERE id=$commentId");
  if ($commentDetail > 0) {

    $allowStatus = [0, 1];

    if (isset($body['status']) && in_array($body['status'], $allowStatus)) {
      $status = $body['status'];
      //Thực hiện duyệt
      $condition = "id=$commentId";

      $statusUpdate = update('comments', ['status' => $status], $condition);

      if (!empty($statusUpdate) && $status == 1) {
        setFlashData('msg', 'Duyệt bình luận thành công');
        setFlashData('msg_type', 'success');
      } elseif (!empty($statusUpdate) && $status == 0) {
        setFlashData('msg', 'Bỏ duyệt bình luận thành công');
        setFlashData('msg_type', 'success');
      } else {
        setFlashData('msg', 'Duyệt bình luận không thành công. Vui lòng thử lại sau');
        setFlashData('msg_type', 'danger');
      }
    } else {
      setFlashData('msg', 'Liên kết không tồn tại');
      setFlashData('msg_type', 'danger');
    }
  } else {
    setFlashData('msg', 'Bình luận không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}

redirect('admin?module=comments');
