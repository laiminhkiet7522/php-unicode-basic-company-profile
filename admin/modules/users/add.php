<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thêm người dùng'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Truy vấn lấy danh sách nhóm
$allGroups = getRaw("SELECT id, name FROM `groups` ORDER BY name");

//Xử lý thêm người dùng

if (isPost()){

    //Validate form
    $body = getBody(); //Lấy tất cả dữ liệu trong form

    $errors = []; //Mảng lưu trữ các lỗi

    //Validate họ tên: Bắt buộc nhập, >=5 ký tự
    if (empty(trim($body['fullname']))){
        $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập';
    }else{
        if (strlen(trim($body['fullname']))<5){
            $errors['fullname']['min'] = 'Họ tên phải >= 5 ký tự';
        }
    }

    //Validate nhóm người dùng: Bắt buộc phải chọn nhóm

    if (empty(trim($body['group_id']))){
        $errors['group_id']['required'] = 'Vui lòng chọn nhóm người dùng';
    }

    //Validate email: Bắt buộc phải nhập, định dạng email, email phải duy nhất
    if (empty(trim($body['email']))){
        $errors['email']['required'] = 'Email bắt buộc phải nhập';
    }else{
        //Kiểm tra email hợp lệ
        if (!isEmail(trim($body['email']))){
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        }else{
            //Kiểm tra email có tồn tại trong DB
            $email = trim($body['email']);
            $sql = "SELECT id FROM users WHERE email='$email'";
            if (getRows($sql)>0){
                $errors['email']['unique'] = 'Địa chỉ email đã tồn tại';
            }
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
        $dataInsert = [
            'email' => $body['email'],
            'fullname' => $body['fullname'],
            'group_id' => $body['group_id'],
            'password' => password_hash($body['password'], PASSWORD_DEFAULT),
            'status' => $body['status'],
            'create_at' => date('Y-m-d H:i:s')
        ];

        $insertStatus = insert('users', $dataInsert);
        if ($insertStatus){
            setFlashData('msg', 'Thêm mới người dùng thành công');
            setFlashData('msg_type', 'success');

            redirect('admin?module=users'); //Chuyển hướng qua trang danh sách

        }else{
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');

            redirect('admin?module=users&action=add'); //Load lại trang thêm người dùng
        }

    }else{
        //Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('admin?module=users&action=add'); //Load lại trang thêm người dùng
    }
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">
                <?php
                getMsg($msg, $msgType);
                ?>

                <div class="row">
                    <div class="col">

                        <div class="form-group">
                            <label for="">Họ tên</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Họ tên..." value="<?php echo old('fullname', $old); ?>">
                            <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="">Nhóm người dùng</label>
                            <select name="group_id" class="form-control">
                                <option value="0">Chọn nhóm người dùng</option>
                                <?php
                                if (!empty($allGroups)) {
                                    foreach ($allGroups as $item) {
                                        ?>
                                        <option value="<?php echo $item['id']; ?>" <?php echo (!empty($groupId) && $groupId==$item['id'])?'selected':false; ?>><?php echo $item['name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('group_id', $errors, '<span class="error">', '</span>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email..." value="<?php echo old('email', $old); ?>">
                            <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                        </div>


                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu...">
                            <?php echo form_error('password', $errors, '<span class="error">', '</span>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu...">
                            <?php echo form_error('confirm_password', $errors, '<span class="error">', '</span>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="0" <?php echo (old('status', $old)==0)?'selected':false; ?>>Chưa kích hoạt</option>
                                <option value="1" <?php echo (old('status', $old)==1)?'selected':false; ?>>Kích hoạt</option>
                            </select>
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <a href="<?php echo getLinkAdmin('users', 'lists'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div>
    </section>

<?php
layout('footer', 'admin', $data);
