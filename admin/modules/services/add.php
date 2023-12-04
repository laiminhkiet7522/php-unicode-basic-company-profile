<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Thêm dịch vụ'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Lấy userId đăng nhập
$userId = isLogin()['user_id'];

//Xử lý thêm nhóm người dùng
if (isPost()) {
  //Validate form
  $body = getBody(); //Lấy tất cả dữ liệu trong form

  $errors = []; //Mảng lưu trữ các lỗi

  //Validate tên dịch vụ: Bắt buộc nhập
  if (empty(trim($body['name']))) {
    $errors['name']['required'] = 'Tên nhóm bắt buộc phải nhập';
  }

  //Validate slug: Bắt buộc nhập
  if (empty(trim($body['slug']))) {
    $errors['slug']['required'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
  }

  //Validate nội dung: Bắt buộc nhập
  if (empty(trim($body['content']))) {
    $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
  }

  //Kiểm tra mảng $errors
  if (empty($errors)) {
    //Không có lỗi xảy ra

    $path = $_FILES['icon']['name'];
    $path_tmp = $_FILES['icon']['tmp_name'];

    $arr = explode('.', $path);
    $filename = "services_" . uniqid() . '.' . $arr[1];

    if (
      $arr[1] == "jpg" || $arr[1] == "png" || $arr[1] == "gif" || $arr[1] == "pdf"
    ) {
      move_uploaded_file(
        $path_tmp,
        $_SERVER['DOCUMENT_ROOT']. '/php-unicode-basic-company-profile/uploads/' . $filename
      );
    } else {
      echo 'Invalid Format';
    }

    //Lưu đường dẫn lên server
    $upload_path = _WEB_HOST_ROOT . '/uploads/' . $filename;

    $dataInsert = [
      'name' => trim($body['name']),
      'slug' => trim($body['slug']),
      'icon' => $upload_path,
      'description' => trim($body['description']),
      'content' => trim($body['content']),
      'user_id' => $userId,
      'create_at' => date('Y-m-d H:i:s')
    ];

    $insertStatus = insert('services', $dataInsert);

    if ($insertStatus) {
      setFlashData('msg', 'Thêm dịch vụ thành công');
      setFlashData('msg_type', 'success');

      redirect('admin?module=services'); //Chuyển hướng qua trang danh sách

    } else {
      setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
      setFlashData('msg_type', 'danger');

      redirect('admin?module=services&action=add'); //Load lại trang thêm dịch vụ
    }
  } else {

    //Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);
    redirect('admin?module=services&action=add'); //Load lại trang dịch vụ
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
    <form action="" method="post" enctype="multipart/form-data">
      <?php
      getMsg($msg, $msgType);
      ?>
      <div class="form-group">
        <label for="">Tên dịch vụ</label>
        <input type="text" class="form-control slug" name="name" placeholder="Tên dịch vụ..." value="<?php echo old('name', $old); ?>" />
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Đường dẫn tĩnh</label>
        <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old); ?>" />
        <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
        <p class="render-link"><b>Link</b>: <span></span></p>
      </div>

      <div class="form-group">
        <label for="">Icon</label>
        <input name="icon" class="form-control" type="file" style="width: 20%; padding: 0.25rem 0.75rem !important;" onchange="loadImage(this)">
        <img src="" id="load_image" alt="" style="margin-top: 10px;">
        <?php echo form_error('icon', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Mô tả ngắn</label>
        <textarea name="description" id="file-picker" class="form-control editor" placeholder="Mô tả ngắn..."><?php echo old('description', $old) ?></textarea>
        <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Nội dung</label>
        <textarea name="content" id="file-picker" class="form-control editor"><?php echo old('content', $old) ?></textarea>
        <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
      </div>
  </div>

  <button type="submit" class="btn btn-primary">Thêm mới</button>
  <a href="<?php echo getLinkAdmin('services', 'lists'); ?>" class="btn btn-success">Quay lại</a>
  </form>
  </div>
</section>
<script type="text/javascript">
  function loadImage(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#load_image').attr('src', e.target.result).width(100).height(100);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<?php
layout('footer', 'admin', $data);
