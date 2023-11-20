<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])){
    $groupId = $body['id'];
    $groupDetailRows = getRows("SELECT id FROM `groups` WHERE id=$groupId");
    if ($groupDetailRows>0){

        //Kiểm tra xem trong nhóm còn người dùng không
        $userNum = getRows("SELECT id FROM users WHERE group_id=$groupId");
        if ($userNum>0){
            setFlashData('msg', 'Trong nhóm vẫn còn '.$userNum.' người dùng');
            setFlashData('msg_type', 'danger');
        }else{
            //Thực hiện xoá
            $condition = "id=$groupId";

            $deleteStatus = delete('groups', $condition);
            if (!empty($deleteStatus)){
                setFlashData('msg', 'Xoá nhóm thành công');
                setFlashData('msg_type', 'success');
            }else{
                setFlashData('msg', 'Xoá nhóm không thành công. Vui lòng thử lại sau');
                setFlashData('msg_type', 'danger');
            }
        }


    }else{
        setFlashData('msg', 'Nhóm không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
}else{
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=groups');