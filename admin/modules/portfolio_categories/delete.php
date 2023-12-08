<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $cateId = $body['id'];
  $cateDetailRows = getRows("SELECT id FROM portfolio_categories WHERE id=$cateId");
  if ($cateDetailRows > 0) {

    //Kiểm tra xem trong danh mục còn dự án không
    $portfolioNum = getRows("SELECT id FROM portfolios WHERE portfolio_category_id=$cateId");
    if ($portfolioNum > 0) {
      setFlashData('msg', 'Trong danh mục vẫn còn ' . $portfolioNum . ' dự án nên không thể xóa được!');
      setFlashData('msg_type', 'danger');
    } else {

      //Thực hiện xoá
      $condition = "id=$cateId";

      $deleteStatus = delete('portfolio_categories', $condition);
      if (!empty($deleteStatus)) {
        setFlashData('msg', 'Xoá danh mục thành công');
        setFlashData('msg_type', 'success');
      } else {
        setFlashData('msg', 'Xoá danh mục không thành công. Vui lòng thử lại sau');
        setFlashData('msg_type', 'danger');
      }
    }
  } else {
    setFlashData('msg', 'Danh mục không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}

redirect('admin?module=portfolio_categories');
