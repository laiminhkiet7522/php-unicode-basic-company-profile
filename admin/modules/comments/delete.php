<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $commentId = $body['id'];
  $commentDetailRows = getRows("SELECT id FROM comments WHERE id=$commentId");
  if ($commentDetailRows > 0) {

    //Truy vấn lấy tất cả comment
    $commentData = getRaw("SELECT * FROM comments");

    //Xử lý comment
    $commentIdArr = getCommentReply($commentData, $commentId);

    $commentIdArr[] = $commentId;

    $condition = 'id IN (' . implode(',', $commentIdArr) . ')';

    //Thực hiện xoá
    $deleteStatus = delete('comments', $condition);
    if (!empty($deleteStatus)) {
      setFlashData('msg', 'Xoá bình luận thành công');
      setFlashData('msg_type', 'success');
    } else {
      setFlashData('msg', 'Xoá bình luận không thành công. Vui lòng thử lại sau');
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
