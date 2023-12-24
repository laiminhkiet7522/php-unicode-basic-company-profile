<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])){
    $serviceId = $body['id'];
    $serviceDetailRows = getRows("SELECT id FROM services WHERE id=$serviceId");
    if ($serviceDetailRows>0){

        //Thực hiện xoá
        $condition = "id=$serviceId";

        $deleteStatus = delete('services', $condition);
        if (!empty($deleteStatus)){
            setFlashData('msg', 'Xoá dịch vụ thành công');
            setFlashData('msg_type', 'success');
        }else{
            setFlashData('msg', 'Xoá dịch vụ không thành công. Vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }

    }else{
        setFlashData('msg', 'Dịch vụ không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
}else{
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=services');