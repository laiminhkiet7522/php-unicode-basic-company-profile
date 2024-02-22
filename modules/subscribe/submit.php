<?php
if (!defined('_INCODE')) die('Access Deined...');

if (isPost()) {
  $body = getBody();
  $errors = [];

  //Validate full name
  if (empty($body['fullname'])) {
    $errors['fullname']['required'] = 'Please enter your name';
  } else {
    if (strlen(trim($body['fullname'])) < 5) {
      $errors['fullname']['min'] = 'Name must be at least 5 characters';
    }
  }

  //Validate email
  if (empty($body['email'])) {
    $errors['email']['required'] = 'Please enter your email';
  } else {
    if (!isEmail($body['email'])) {
      $errors['email']['invalid'] = 'Please enter a valid email';
    }
  }

  if (empty($errors)) {
    $dataInsert = [
      'fullname' => trim(strip_tags($body['fullname'])),
      'email' => trim(strip_tags($body['email'])),
      'status' => 0,
      'create_at' => date('Y-m-d H:i:s')
    ];
    $insertStatus = insert('subscribe', $dataInsert);
    if ($insertStatus) {
      setFlashData('msg', 'Sign Up Success');
      setFlashData('msg_type', 'success');
      redirect($_SERVER['HTTP_REFERER'] . '#newsletter', true);
    } else {
      setFlashData('msg', 'Registration failed');
      setFlashData('msg_type', 'danger');
      setFlashData('errors', $errors);
      setFlashData('old', $body);
      redirect($_SERVER['HTTP_REFERER'] . '#newsletter', true);
    }
  } else {
    //Có lỗi xảy ra
    setFlashData('msg', 'Plz check the entered data');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    redirect($_SERVER['HTTP_REFERER'] . '#newsletter', true);
  }
}
