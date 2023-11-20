<?php
$data = [
    'pageTitle' => 'Đổi mật khẩu'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userId = isLogin()['user_id'];
$userDetail = getUserInfo($userId);

setFlashData('userDetail', $userDetail);

//Xử lý cập nhật thông tin cá nhân

if (isPost()){

    //Validate form
    $body = getBody(); //Lấy tất cả dữ liệu trong form

    $errors = []; //Mảng lưu trữ các lỗi

    //Validate mật khẩu cũ: Bắt buộc nhập, trùng với mật khẩu trong database
    if (empty(trim($body['old_password']))){
        $errors['old_password']['required'] = 'Vui lòng nhập mật khẩu cũ';
    }else{
        $oldPassword = trim($body['old_password']);
        $hashPassword = $userDetail['password'];
        if (!password_verify($oldPassword, $hashPassword)){
            $errors['old_password']['match'] = 'Mật khẩu cũ không chính xác';
        }
    }

    //Validate mật khẩu: Bắt buộc phải nhập, >=8 ký tự
    if (empty(trim($body['password']))){
        $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập';
    }else{
        if (strlen(trim($body['password']))<8){
            $errors['password']['min'] = 'Mật khẩu không được nhỏ hơn 8 ký tự';
        }
    }

    //Validate nhập lại mật khẩu: Bắt buộc phải nhập, giống trường mật khẩu
    if (empty(trim($body['confirm_password']))){
        $errors['confirm_password']['required'] = 'Xác nhận mật khẩu không được để trống';
    }else{
        if (trim($body['password'])!=trim($body['confirm_password'])){
            $errors['confirm_password']['match'] = 'Hai mật khẩu không khớp nhau';
        }
    }

    //Kiểm tra mảng $errors
    if (empty($errors)){
        //Không có lỗi xảy ra

        $dataUpdate = [
            'password' => password_hash($body['password'], PASSWORD_DEFAULT),
            'update_at' => date('Y-m-d H:i:s')
        ];

        $condition = "id=$userId";

        $updateStatus = update('users', $dataUpdate, $condition);
        if ($updateStatus){
            setFlashData('msg', 'Đổi mật khẩu thành công. Bạn có thể đăng nhập bằng mật khẩu mới ngay bây giờ.');
            setFlashData('msg_type', 'success');

            //Thiết lập gửi email
            $subject = $userDetail['fullname'].' thay đổi mật khẩu thành công';
            $content = 'Chào bạn: '.$userDetail['fullname'].'<br/>';
            $content.='Chúc mừng bạn đã thay đổi mật khẩu thành công. Hiện tại bạn có thể đăng nhập với mật khẩu mới <br/>';
            $content.='Nếu không phải bạn thay đổi, vui lòng liên hệ ngay với chúng tôi. <br/>';
            $content.='Trân trọng!';

            //Tiến hành gửi email
            $send = sendMail($userDetail['email'], $subject, $content);

            //Đăng xuất
            redirect('admin?module=auth&action=logout');

        }else{
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');

        }

    }else{
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
    }

    redirect('admin?module=users&action=change_password');
}


$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php
            getMsg($msg, $msgType);
            ?>
            <form action="" method="post">

                <div class="form-group">
                    <label for="">Mật khẩu cũ</label>
                    <input type="password" class="form-control" name="old_password" placeholder="Mật khẩu cũ..." value=""/>
                    <?php echo form_error('old_password', $errors, '<span class="error">', '</span>'); ?>
                </div>

                <div class="form-group">
                    <label for="">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới..." value=""/>
                    <?php echo form_error('password', $errors, '<span class="error">', '</span>'); ?>
                </div>

                <div class="form-group">
                    <label for="">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu mới..." value=""/>
                    <?php echo form_error('confirm_password', $errors, '<span class="error">', '</span>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php
layout('footer', 'admin', $data);
