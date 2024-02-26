<?php
//Kiểm tra permission tương ứng với module, action
function checkPermission($permissionData, $module, $role = 'lists')
{
  if (!empty($permissionData[$module])) {
    $roleArr = $permissionData[$module];
    if (!empty($roleArr) && in_array($role, $roleArr)) {
      return true;
    }
  }
  return false;
}

//Lấy group_id hiện tại của user đăng nhập
function getGroupId()
{
  $userId = isLogin()['user_id'];

  $groupRow = firstRaw("SELECT group_id FROM users WHERE id=$userId");

  if (!empty($groupRow)) {
    $groupId = $groupRow['group_id'];
    return $groupId;
  }
  return false;
}

//Lấy mảng permission trong bảng group
function getPermissionsData($groupId)
{
  $groupRow = firstRaw("SELECT permission FROM `groups` WHERE id = $groupId");
  if (!empty($groupRow)) {
    $permissionData = json_decode($groupRow['permission'], true);
    return $permissionData;
  }
  return false;
}

function checkCurrentPermission($role = '', $module = '')
{
  $groupId = getGroupId();

  $permissionsData = getPermissionsData($groupId);

  $currentModule = null;

  $body = getBody('get');

  if (!empty($body['module'])) {
    $currentModule = $body['module'];
  }

  $action = !empty($body['action']) ? $body['action'] : 'lists';

  if (!empty($role)) {
    $action = $role;
  }

  if (!empty($module)) {
    $currentModule = $module;
  }

  if (!empty($action)) {
    $checkPermission = checkPermission($permissionsData, $currentModule, $action);

    return $checkPermission;
  }
  return false;
}

function redirectPermission($path = 'admin')
{
  setFlashData('msg', 'Bạn không có quyền truy cập với chức năng này.');
  setFlashData('msg_type', 'danger');
  redirect($path);
}
