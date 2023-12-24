<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])){
    $cateId = $body['id'];
    $cateDetailRows = getRows("SELECT id FROM blog_categories WHERE id=$cateId");
    if ($cateDetailRows>0){

        //Kiểm tra xem trong danh mục còn blog không
        $portfolioNum = getRows("SELECT id FROM blog WHERE category_id=$cateId");
        if ($portfolioNum>0){
            setFlashData('msg', 'Trong dah mục vẫn còn '.$portfolioNum.' dự án');
            setFlashData('msg_type', 'danger');
        }else{

            //Thực hiện xoá
            $condition = "id=$cateId";

            $deleteStatus = delete('blog_categories', $condition);
            if (!empty($deleteStatus)){
                setFlashData('msg', 'Xoá danh mục thành công');
                setFlashData('msg_type', 'success');
            }else{
                setFlashData('msg', 'Xoá danh mục không thành công. Vui lòng thử lại sau');
                setFlashData('msg_type', 'danger');
            }
        }


    }else{
        setFlashData('msg', 'Danh mục không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
}else{
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=blog_categories');