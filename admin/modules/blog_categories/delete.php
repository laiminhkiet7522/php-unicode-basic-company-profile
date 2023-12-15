<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $cateId = $body['id'];
  $cateDetailRows = getRows("SELECT id FROM blog_categories WHERE id=$cateId");
  if ($cateDetailRows > 0) {

    //Kiểm tra xem trong danh mục còn blog không
    $portfolioNum = getRows("SELECT id FROM blog WHERE category_id=$cateId");
    if ($portfolioNum > 0) {
      setFlashData('msg', 'Trong danh mục blog vẫn còn ' . $portfolioNum . ' blog');
      setFlashData('msg_type', 'danger');
    } else {
      //Thực hiện xoá
      $condition = "id=$cateId";

      $deleteStatus = delete('blog_categories', $condition);

      if (!empty($deleteStatus)) {
        setFlashData('msg', 'Xoá danh mục blog thành công');
        setFlashData('msg_type', 'success');
      } else {
        setFlashData('msg', 'Xoá danh mục blog không thành công. Vui lòng thử lại sau');
        setFlashData('msg_type', 'danger');
      }
    }
  } else {
    setFlashData('msg', 'Danh mục blog không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}

redirect('admin?module=blog_categories');
