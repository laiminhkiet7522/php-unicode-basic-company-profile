<?php
$data = [
    'pageTitle' => 'Thêm nhóm người dùng'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

if (isPost()) {
    //Validate form
    $body = getBody(); //Lấy tất cả dữ liệu trong form

    $errors = []; //Mảng lưu trữ các lỗi

    //Validate tên nhóm: bắt buộc nhập, lớn hơn bằng 3 ký tự
    if (empty(trim($body['name']))) {
        $errors['name']['required'] = 'Tên nhóm bắt buộc phải nhập';
    } else {
        if (strlen($body['name']) < 3) {
            $errors['name']['min'] = 'Tên nhóm phải lớn hơn bằng 3 ký tự';
        }
    }

    if (empty($errors)) {
        //Không có lỗi xảy ra
        $dataInsert = [
            'name' => trim($body['name']),
            'create_at' => date('Y-m-d H:i:s')
        ];

        $insertStatus = insert('groups', $dataInsert);
        if ($insertStatus) {
            setFlashData('msg', 'Thêm mới nhóm người dùng thành công');
            setFlashData('msg_type', 'success');
            redirect('admin/?module=groups');
        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
            redirect('admin/?module=groups&action=add');
        }
    } else {
        //Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('admin/?module=groups&action=add');
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
        <?php
        getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên nhóm</label>
                <input type="text" class="form-control" name="name" placeholder="Tên nhóm..." value="<?php echo old('name', $old); ?>">
                <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
