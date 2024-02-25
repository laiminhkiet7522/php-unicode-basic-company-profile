<?php
if (!defined('_INCODE')) die('Access Deined...');

//Lấy dữ liệu cũ của nhóm người dùng
$body = getBody('get'); //Yêu cầu lấy phương thức get

if (!empty($body['id'])) {
  $groupId = $body['id'];

  $groupDetail = firstRaw("SELECT * FROM `groups` WHERE id=$groupId");

  if (empty($groupDetail)) {
    //Không Tồn tại
    redirect('admin?module=groups');
  }
} else {
  redirect('admin?module=groups');
}

$data = [
  'pageTitle' => 'Phân quyền: ' . $groupDetail['name']
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Xử lý cập nhật nhóm người dùng
if (isPost()) {

  //Validate form
  $body = getBody(); //Lấy tất cả dữ liệu trong form
  $errors = []; //Mảng lưu trữ các lỗi

  if (empty($errors)) {
    //Không có lỗi xảy ra
    if (!empty($body['permissions'])) {
      $permissionJson = json_encode($body['permissions']);
    } else {
      $permissionJson = null;
    }
    $dataUpdate = [
      'permission' => $permissionJson,
      'update_at' => date('Y-m-d H:i:s'),
    ];
    $condition = "id=$groupId";
    $updateStatus = update('groups', $dataUpdate, $condition);
    if ($updateStatus) {
      setFlashData('msg', 'Phân quyền cập nhật thành công');
      setFlashData('msg_type', 'success');
      redirect('admin?module=groups&action=permission&id=' . $groupId);
    } else {
      setFlashData('msg', 'Có lỗi xảy ra. Vui lòng thử lại');
      setFlashData('msg_type', 'danger');
      redirect('admin?module=groups&action=permission&id=' . $groupId);
    }
  } else {
    //Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);
  }
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($groupDetail)) {
  $old = $groupDetail;
}

//Lấy danh sách module
$moduleLists = getRaw("SELECT * FROM modules ORDER BY id DESC");

if (!empty($old['permission'])) {
  $permissionJson = $old['permission'];
  $permissionArr = json_decode($permissionJson, true);
}

?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <form action="" method="post">
      <?php
      getMsg($msg, $msgType);
      ?>
      <table class="table table-borderd">
        <thead>
          <tr>
            <th width="20%">Module</th>
            <th>Chức năng</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($moduleLists)) :
            foreach ($moduleLists as $item) :
              $actionArr = $item['actions'];
              $actionArr = json_decode($actionArr, true);
          ?>
              <tr>
                <td><?php echo $item['title']; ?></td>
                <td>
                  <div class="row">
                    <?php
                    if (!empty($actionArr)) :
                      foreach ($actionArr as $roleKey => $roleTitle) :
                    ?>
                        <div class="col">

                          <input style="cursor: pointer;" type="checkbox" name="<?php echo 'permissions[' . $item['name'] . '][]'; ?>" value="<?php echo $roleKey; ?>" id="<?php echo $item['name'] . '_' . $roleKey; ?>" <?php echo (!empty($permissionArr[$item['name']]) && in_array($roleKey, $permissionArr[$item['name']])) ? 'checked' : ''; ?>>

                          <label style="cursor: pointer;" for="<?php echo $item['name'] . '_' . $roleKey; ?>"><?php echo $roleTitle; ?></label>

                        </div>
                    <?php endforeach;
                    endif; ?>
                  </div>
                </td>
              </tr>
          <?php
            endforeach;
          endif;
          ?>
        </tbody>
      </table>
      <button type="submit" class="btn btn-primary">Phân quyền</button>
      <a href="<?php echo getLinkAdmin('groups', 'lists'); ?>" class="btn btn-success">Quay lại</a>
    </form>
  </div>
</section>

<?php
layout('footer', 'admin', $data);
