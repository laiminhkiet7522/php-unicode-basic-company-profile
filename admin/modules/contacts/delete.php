<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $contactId = $body['id'];
  $contactDetailRows = getRows("SELECT id FROM contacts WHERE id=$contactId");
  if ($contactDetailRows > 0) {

    //Thực hiện xoá
    $condition = "id=$contactId";

    $deleteStatus = delete('contacts', $condition);
    if (!empty($deleteStatus)) {
      setFlashData('msg', 'Xoá liên hệ thành công');
      setFlashData('msg_type', 'success');
    } else {
      setFlashData('msg', 'Xoá liên hệ không thành công. Vui lòng thử lại sau');
      setFlashData('msg_type', 'danger');
    }
  } else {
    setFlashData('msg', 'Liên hệ không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}

redirect('admin?module=contacts');
