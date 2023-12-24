<?php
//Lấy dữ liệu cũ của danh mục
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])){
    $blog_categorieId = $body['id'];

    $blog_categorieDetail = firstRaw("SELECT * FROM `blog_categories` WHERE id=$blog_categorieId");

    if (empty($blog_categorieDetail)){
        //Không Tồn tại
        redirect('admin?module=blog_categories');
    }

}else{
    redirect('admin?module=blog_categories');
}


//Xử lý cập nhật danh mục
if (isPost()){

    //Validate form
    $body = getBody(); //Lấy tất cả dữ liệu trong form

    $errors = []; //Mảng lưu trữ các lỗi

    //Validate tên danh mục: Bắt buộc nhập, >=4 ký tự
    if (empty(trim($body['name']))){
        $errors['name']['required'] = 'Tên danh mục bắt buộc phải nhập';
    }else{
        if (strlen(trim($body['name']))<4){
            $errors['name']['min'] = 'Họ tên phải >=4 ký tự';
        }
    }

    //Validate đường dẫn tĩnh: Bắt buộc nhập
    if (empty(trim($body['slug']))){
        $errors['slug']['required'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    //Kiểm tra mảng $errors
    if (empty($errors)) {
        //Không có lỗi xảy ra

        $dataUpdate = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'update_at' => date('Y-m-d H:i:s')
        ];

        $condition = "id=$blog_categorieId";

        $updateStatus = update('blog_categories', $dataUpdate, $condition);

        if ($updateStatus){
            setFlashData('msg', 'Cập nhật danh mục thành công');
            setFlashData('msg_type', 'success');

        }else{
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');

        }

    }else{

        //Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);

    }

    //Load lại trang sửa hiện tại
    redirect('admin?module=blog_categories&action=lists&view=edit&id='.$blog_categorieId);
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($blog_categorieDetail)){
    $old = $blog_categorieDetail;
}

?>
<h4>Cập nhật danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control slug" name="name" placeholder="Tên danh mục.." value="<?php echo old('name', $old); ?>"/>
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>
    <div class="form-group">
        <label for="">Đường dẫn tĩnh</label>
        <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh.." value="<?php echo old('slug', $old); ?>"/>
        <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
        <p class="render-link"><b>Link</b>: <span></span></p>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('blog_categories', 'lists'); ?>" class="btn btn-success">Quay lại</a>
</form>