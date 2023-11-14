<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật nhóm người dùng'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$body = getBody('get'); //Lấy tất cả dữ liệu trong form theo GET
if (!empty($body['id'])) {
    $groupId = $body['id'];

    //Kiểm tra groupId có tồn tại trong database hay không
    //Nếu có tồn tại => Lấy ra thông tin
    //Nếu không tồn tại => Chuyển hướng về trang lists
    $groupDetail = firstRaw("SELECT * FROM `groups` WHERE id ='$groupId'");

    if (empty($groupDetail)) {
        redirect('admin/?module=groups');
    }
} else {
    redirect('admin/?module=groups');
}

//Xử lý cập nhật nhóm
if (isPost()) {

    //Validate form
    $body = getBody('post'); //Lấy tất cả dữ liệu trong form

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
        $dataUpdate = [
            'name' => trim($body['name']),
            'update_at' => date('Y-m-d H:i:s')
        ];

        $condition = "id=$groupId";

        $updateStatus = update('groups', $dataUpdate, $condition);

        if ($updateStatus) {
            setFlashData('msg', 'Cập nhật nhóm người dùng thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
        }
    } else {
        //Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }

    //Load lại trang cập nhật ngay cả khi cập nhật thành công và thất bại
    redirect('admin/?module=groups&action=edit&id=' . $groupId);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($groupDetail)) {
    $old = $groupDetail;
}
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
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('groups', ''); ?>" class="btn btn-secondary">Quay lại</a>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
