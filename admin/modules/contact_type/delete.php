<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $contactTypeId = $body['id'];
  $cateDetailRows = getRows("SELECT id FROM contact_type WHERE id=$contactTypeId");
  if ($cateDetailRows > 0) {

    //Kiểm tra xem trong phòng ban còn contacts không
    $contactNum = getRows("SELECT id FROM contacts WHERE type_id=$contactTypeId");
    if ($contactNum > 0) {
      setFlashData('msg', 'Trong phòng ban vẫn còn ' . $contactNum . ' liên hệ');
      setFlashData('msg_type', 'danger');
    } else {

      //Thực hiện xoá
      $condition = "id=$contactTypeId";

      $deleteStatus = delete('contact_type', $condition);
      if (!empty($deleteStatus)) {
        setFlashData('msg', 'Xoá phòng ban thành công');
        setFlashData('msg_type', 'success');
      } else {
        setFlashData('msg', 'Xoá phòng ban không thành công. Vui lòng thử lại sau');
        setFlashData('msg_type', 'danger');
      }
    }
  } else {
    setFlashData('msg', 'Phòng ban không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}

redirect('admin?module=contact_type');
