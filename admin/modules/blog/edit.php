<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Cập nhật blog'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Lấy dữ liệu cũ của blog
$body = getBody('get');
if (!empty($body['id'])) {
  $blogId = $body['id'];
  $blogDetail = firstRaw("SELECT * FROM blog WHERE id = '$blogId'");
  if (empty($blogDetail)) {
    redirect('admin?module=blog');
  }
} else {
  redirect('admin?module=blog');
}

//Xử lý cập nhật nhóm người dùng
if (isPost()) {

  //Validate form
  $body = getBody(); //Lấy tất cả dữ liệu trong form

  $errors = []; //Mảng lưu trữ các lỗi

  //Validate tên blog: Bắt buộc nhập

  if (empty(trim($body['title']))) {
    $errors['title']['required'] = 'Tên blog bắt buộc phải nhập';
  }

  //Validate slug: Bắt buộc nhập
  if (empty(trim($body['slug']))) {
    $errors['slug']['required'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
  }

  //Validate nội dung: Bắt buộc phải nhập
  if (empty(trim($body['content']))) {
    $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
  }

  //Validate chuyên mục: Bắt buộc phải chọn
  if (empty(trim($body['category_id']))) {
    $errors['category_id']['required'] = 'Chuyên mục bắt buộc phải chọn';
  }

  $path = $_FILES['thumbnail']['name'];
  $path_tmp = $_FILES['thumbnail']['tmp_name'];

  $arr = explode(
    '.',
    $path
  );

  $filename = "blog_" . uniqid() . '.' . $arr[1];

  //Lưu đường dẫn lên server
  $upload_path = _WEB_HOST_ROOT . '/uploads/' . $filename;

  //Kiểm tra mảng $errors
  if (empty($errors)) {
    //Không có lỗi xảy ra

    if ($_FILES['thumbnail']['name'] != '') {
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
        redirect('admin?module=blog&action=edit&id=' . $blogId); //Load lại trang cập nhật dự án
      }
      $dataUpdate = [
        'title' => trim($body['title']),
        'slug' => trim($body['slug']),
        'content' => trim($body['content']),
        'category_id' => trim($body['category_id']),
        'thumbnail' => $upload_path,
        'description' => trim($body['description']),
        'update_at' => date('Y-m-d H:i:s')
      ];
    } else {
      $dataUpdate = [
        'title' => trim($body['title']),
        'slug' => trim($body['slug']),
        'content' => trim($body['content']),
        'category_id' => trim($body['category_id']),
        'description' => trim($body['description']),
        'update_at' => date('Y-m-d H:i:s')
      ];
    }

    $condition = "id = $blogId";

    $updateStatus = update('blog', $dataUpdate, $condition);

    if ($updateStatus) {
      setFlashData('msg', 'Cập nhật blog thành công');
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
  redirect('admin?module=blog&action=edit&id=' . $serviceId);
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($blogDetail)) {
  $old = $blogDetail;
}

//Lấy dữ liệu tất cả chuyên mục
$allCategories = getRaw("SELECT id, name FROM blog_categories ORDER BY name");
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
        <label for="">Tiêu đề</label>
        <input type="text" class="form-control slug" name="title" placeholder="Tiêu đề..." value="<?php echo old('title', $old); ?>" />
        <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Đường dẫn tĩnh</label>
        <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old); ?>" />
        <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
        <p class="render-link"><b>Link</b>: <span></span></p>
      </div>

      <div class="form-group">
        <label for="">Mô tả</label>
        <textarea name="description" id="file-picker" class="form-control"><?php echo old('description', $old) ?></textarea>
        <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Nội dung</label>
        <textarea name="content" id="file-picker" class="form-control"><?php echo old('content', $old) ?></textarea>
        <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Chuyên mục</label>
        <select class="form-control" name="category_id" id="">
          <option value="0">Chọn chuyên mục</option>
          <?php
          if (!empty($allCategories)) {
            foreach ($allCategories as $item) {
          ?>
              <option value="<?php echo $item['id']; ?>" <?php echo (old('category_id', $old) == $item['id']) ? 'selected' : false; ?>><?php echo $item['name']; ?></option>
          <?php
            }
          }
          ?>
        </select>
        <?php echo form_error('category_id', $errors, '<span class="error">', '</span>'); ?>
      </div>

      <div class="form-group">
        <label for="">Ảnh đại diện</label>
        <input name="thumbnail" class="form-control" type="file" style="width: 20%; padding: 0.25rem 0.75rem !important;" id="update_image">
        <img id="showImage" src="<?php echo old('thumbnail', $old); ?>" alt="" style="width: 100px; height: 100px; margin-top: 10px;">
        <?php echo form_error('thumbnail', $errors, '<span class="error">', '</span>'); ?>
      </div>


  </div>

  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="<?php echo getLinkAdmin('blog', 'lists'); ?>" class="btn btn-success">Quay lại</a>
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
