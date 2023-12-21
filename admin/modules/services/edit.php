<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Cập nhật dịch vụ'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Lấy dữ liệu cũ của nhóm người dùng
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])) {
  $serviceId = $body['id'];

  $serviceDetail = firstRaw("SELECT * FROM services WHERE id=$serviceId");

  if (empty($serviceDetail)) {
    //Không Tồn tại
    redirect('admin?module=services');
  }
} else {
  redirect('admin?module=services');
}


//Xử lý cập nhật nhóm người dùng
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

  //Validate nội dung: Bắt buộc phải nhập
  if (empty(trim($body['content']))) {
    $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
  }

  $path = $_FILES['icon']['name'];
  $path_tmp = $_FILES['icon']['tmp_name'];

  $arr = explode(
    '.',
    $path
  );

  $filename = "service_" . uniqid() . '.' . $arr[1];

  //Lưu đường dẫn lên server
  $upload_path = _WEB_HOST_ROOT . '/uploads/' . $filename;


  //Kiểm tra mảng $errors
  if (empty($errors)) {
    //Không có lỗi xảy ra

    if ($_FILES['icon']['name'] != '') {
      if (
        $arr[1] == "jpg" || $arr[1] == "png" || $arr[1] == "jpeg"
      ) {
        move_uploaded_file(
          $path_tmp,
          $_SERVER['DOCUMENT_ROOT'] . '/php-unicode-basic-company-profile/uploads/' . $filename
        );
      } else {
        setFlashData('msg', 'Hình ảnh upload phải thuộc dạng jpg, jpeg, png');
        setFlashData('msg_type', 'danger');
        setFlashData('old', $body);
        redirect('admin?module=services&action=edit&id=' . $serviceId); //Load lại trang cập nhật dự án
      }
      $dataUpdate = [
        'name' => trim($body['name']),
        'slug' => trim($body['slug']),
        'icon' => $upload_path,
        'description' => trim($body['description']),
        'content' => trim($body['content']),
        'update_at' => date('Y-m-d H:i:s')
      ];
    } else {
      $dataUpdate = [
        'name' => trim($body['name']),
        'slug' => trim($body['slug']),
        'description' => trim($body['description']),
        'content' => trim($body['content']),
        'update_at' => date('Y-m-d H:i:s')
      ];
    }

    $condition = "id=$serviceId";

    $updateStatus = update('services', $dataUpdate, $condition);

    if ($updateStatus) {
      setFlashData('msg', 'Cập nhật dịch vụ thành công');
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

  //Load lại trang sửa hiện tại
  redirect('admin?module=services&action=edit&id=' . $serviceId);
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($serviceDetail)) {
  $old = $serviceDetail;
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
        <input name="icon" class="form-control" type="file" style="width: 20%; padding: 0.25rem 0.75rem !important;" id="update_image">
        <img id="showImage" src="<?php echo old('icon', $old); ?>" alt="" style="width: 150px; height: 140px; margin-top: 10px;">
        <?php echo form_error('icon', $errors, '<span class="error">', '</span>'); ?>
      </div>
  </div>

  <div class="form-group">
    <label for="">Mô tả ngắn</label>
    <textarea name="description" id="file-picker" class="form-control" placeholder="Mô tả ngắn..."><?php echo old('description', $old) ?></textarea>
    <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>
  </div>

  <div class="form-group">
    <label for="">Nội dung</label>
    <textarea name="content" id="file-picker" class="form-control"><?php echo old('content', $old) ?></textarea>
    <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
  </div>

  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="<?php echo getLinkAdmin('services', 'lists'); ?>" class="btn btn-success">Quay lại</a>
  </form>
  </div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
    $('#update_image').change(function(e) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });
</script>
<?php
layout('footer', 'admin', $data);
