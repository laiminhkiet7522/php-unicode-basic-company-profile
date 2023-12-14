<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $portfolioId = $body['id'];
  $portfolioDetailRows = getRows("SELECT id FROM portfolios WHERE id=$portfolioId");
  if ($portfolioDetailRows > 0) {

    //Thực hiện xoá
    $condition = "id=$portfolioId";

    $deleteStatus = delete('portfolios', $condition);
    if (!empty($deleteStatus)) {
      setFlashData('msg', 'Xoá dự án thành công');
      setFlashData('msg_type', 'success');
    } else {
      setFlashData('msg', 'Xoá dự án không thành công. Vui lòng thử lại sau');
      setFlashData('msg_type', 'danger');
    }
  } else {
    setFlashData('msg', 'Dự án không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}

redirect('admin?module=portfolios');
