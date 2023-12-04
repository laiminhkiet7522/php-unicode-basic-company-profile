<?php
if (!defined('_INCODE')) die('Access Deined...');
$body = getBody();
if (!empty($body['id'])) {
  $serviceId = $body['id'];
  $serviceDetail = firstRaw("SELECT * FROM services WHERE id=$serviceId");
  if (!empty($serviceDetail)) {

    //Loại bỏ thời gian tạo và thời gian cập nhật
    $serviceDetail['create_at'] = date('Y-m-d H:i:s');
    unset($serviceDetail['update_at']);
    unset($serviceDetail['id']);

    $duplicate = $serviceDetail['duplicate'];
    $duplicate++;

    $name = $serviceDetail['name'] . ' (' . $duplicate . ')';

    $serviceDetail['name'] = $name;

    $insertStatus = insert('services', $serviceDetail);
    if ($insertStatus) {
      setFlashData('msg', 'Nhân bản dịch vụ thành công');
      setFlashData('msg_type', 'success');

      update('services', [
        'duplicate' => $duplicate
      ], "id=$serviceId");
    }
  } else {
    setFlashData('msg', 'Dịch vụ không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
  }
} else {
  setFlashData('msg', 'Liên kết không tồn tại');
  setFlashData('msg_type', 'danger');
}

redirect('admin?module=services');
