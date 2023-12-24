<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])){
    $blogId = $body['id'];
    $blogDetailRows = getRows("SELECT id FROM blog WHERE id=$blogId");
    if ($blogDetailRows>0){

        //Thực hiện xoá
        $condition = "id=$blogId";

        $deleteStatus = delete('blog', $condition);
        if (!empty($deleteStatus)){
            setFlashData('msg', 'Xoá blog thành công');
            setFlashData('msg_type', 'success');
        }else{
            setFlashData('msg', 'Xoá blog không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }

    }else{
        setFlashData('msg', 'Blog không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
}else{
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=blog');