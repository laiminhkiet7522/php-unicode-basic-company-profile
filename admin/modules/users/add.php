<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Thêm người dùng'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Truy vấn lấy danh sách nhóm
$allGroup = getRaw("SELECT id,name FROM `groups` ORDER BY name");

//Xử lý thêm người dùng
if (isPost()) {

  //Validate form
  $body = getBody();

  $errors = []; //Mảng chứa các lỗi

  //Validate họ tên: Bắt buộc nhập, lớn hơn 5 ký tự
  if (empty(trim($body['fullname']))) {
    $errors['fullname']['required'] = 'Vui lòng nhập họ và tên';
  } else if (strlen(trim($body['fullname'])) < 5) {
    $errors['fullname']['min'] = 'Họ tên phải từ 5 ký tự trở lên';
  }

  //Validate nhóm người dùng: Bắt buộc phải chọn
  if (empty(trim($body['group_id']))) {
    $errors['group_id']['required'] = 'Vui lòng chọn nhóm người dùng';
  }

  //Validate Email: Bắt buộc nhập, đúng định dạng, email phải duy nhất
  if (empty(trim($body['email']))) {
    $errors['email']['required'] = 'Vui lòng nhập email';
  } else {
    //Kiểm tra email hợp lệ
    if (!isEmail($body['email'])) {
      $errors['email']['isEmail'] = 'Email vừa nhập không hợp lệ';
    } else {
      //Kiểm tra email có tồn tại trong database chưa
      $email = trim($body['email']);
      $sql = "SELECT id FROM users WHERE email='$email'";
      if (getRows($sql) > 0) {
        $errors['email']['unique'] = 'Email vừa nhập đã tồn tại';
      }
    }
  }

  //Validate Mật khẩu: Bắt buộc nhập, Độ dài lớn hơn hoặc bằng 8 ký tự
  if (empty(trim($body['password']))) {
    $errors['password']['required'] = 'Vui lòng nhập mật khẩu';
  } else {
    if (strlen(trim($body['password'])) < 8) {
      $errors['password']['min'] = 'Mật khẩu không được nhỏ hơn 8 ký tự';
    }
  }

  //Validate Nhập lại Mật khẩu: Bắt buộc nhập, phải giống trường mật khẩu đã nhập trước đó
  if (empty(trim($body['confirm_password']))) {
    $errors['confirm_password']['required'] = 'Vui lòng nhập lại xác nhận mật khẩu';
  } else {
    if (trim($body['password']) != trim($body['confirm_password'])) {
      $errors['confirm_password']['match'] = 'Hai mật khẩu không khớp nhau';
    }
  }

  //Kiểm tra mảng errors
  if (empty($errors)) {
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
    if ($insertStatus) {
      setFlashData('msg', 'Thêm mới người dùng thành công');
      setFlashData('msg_type', 'success');
      redirect('admin/?module=users');
    } else {
      setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
      setFlashData('msg_type', 'danger');
      redirect('admin/?module=users&action=add');
    }
  } else {
    //Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);
    redirect('admin/?module=users&action=add');
  }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msgType);
    ?>
    <form action="" method="post">
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
              <option value="0">Chọn nhóm</option>
              <?php
              if (!empty($allGroup)) :
                foreach ($allGroup as $item) :
              ?>
                  <option value="<?php echo $item['id']; ?>" <?php echo (!empty($groupId) && $groupId == $item['id']) ? 'selected' : false; ?>><?php echo $item['name']; ?></option>
              <?php
                endforeach;
              endif;
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
            <div class="input-group" id="show_hide_password">
              <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu...">
              <a href="javascript:;" class="input-group-text bg-transparent"><i style="width: 25px;" class='fa-solid fa-eye-slash'></i></a>
            </div>
            <?php echo form_error('password', $errors, '<span class="error">', '</span>'); ?>
          </div>

          <div class="form-group">
            <label for="">Nhập lại mật khẩu</label>
            <div class="input-group" id="show_hide_confirm_password">
              <input type="password" name="confirm_password" class="form-control" id="password" placeholder="Nhập lại mật khẩu...">
              <a href="javascript:;" class="input-group-text bg-transparent"><i style="width: 25px;" class='fa-solid fa-eye-slash'></i></a>
            </div>
            <?php echo form_error('confirm_password', $errors, '<span class="error">', '</span>'); ?>
          </div>

          <div class="form-group">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control">
              <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa kích hoạt</option>
              <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Kích hoạt</option>
            </select>
          </div>

        </div>

      </div>
      <button type="submit" class="btn btn-primary">Thêm mới</button>
      <a href="<?php echo getLinkAdmin('users', ''); ?>" class="btn btn-secondary">Quay lại</a>
    </form>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
  $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
      event.preventDefault();
      if ($('#show_hide_password input').attr("type") == "text") {
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass("fa-eye-slash");
        $('#show_hide_password i').removeClass("fa-eye");
      } else if ($('#show_hide_password input').attr("type") == "password") {
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass("fa-eye-slash");
        $('#show_hide_password i').addClass("fa-eye");
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#show_hide_confirm_password a").on('click', function(event) {
      event.preventDefault();
      if ($('#show_hide_confirm_password input').attr("type") == "text") {
        $('#show_hide_confirm_password input').attr('type', 'password');
        $('#show_hide_confirm_password i').addClass("fa-eye-slash");
        $('#show_hide_confirm_password i').removeClass("fa-eye");
      } else if ($('#show_hide_confirm_password input').attr("type") == "password") {
        $('#show_hide_confirm_password input').attr('type', 'text');
        $('#show_hide_confirm_password i').removeClass("fa-eye-slash");
        $('#show_hide_confirm_password i').addClass("fa-eye");
      }
    });
  });
</script>
<?php
layout('footer', 'admin', $data);
