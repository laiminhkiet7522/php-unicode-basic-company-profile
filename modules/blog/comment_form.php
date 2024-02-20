<?php
$commentName = null;
if (!empty(getBody('get')['comment_id'])) {
  $commentId = getBody('get')['comment_id'];
  $commentName = $commentData[$commentId]['name'];
}

//Check admin login
if (!empty(isLogin())) {
  $userId = isLogin()['user_id'];
}

if (isPost()) {
  $body = getBody();
  $errors = [];

  if (empty($userId)) {
    //Validate name
    if (empty($body['name'])) {
      $errors['name']['required'] = 'Please enter your name';
    } else {
      if (strlen(trim($body['name'])) < 5) {
        $errors['name']['min'] = 'Name must be at least 5 characters';
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
  }

  //Validate content
  if (empty($body['content'])) {
    $errors['content']['required'] = 'Please enter your message';
  } else {
    if (strlen(trim($body['content'])) < 10) {
      $errors['content']['min'] = 'Message must be at least 10 characters';
    }
  }

  if (empty($errors)) {

    //Lưu tất cả thông tin vào cookie
    if (empty($userId)) {
      $commentInfo = [
        'name' => trim(strip_tags($body['name'])),
        'email' => trim(strip_tags($body['email'])),
        'website' => trim(strip_tags($body['website']))
      ];
      setcookie('commentInfo', json_encode($commentInfo), time() + (86400 * 365));
    }

    $dataInsert = [
      'content' => trim(strip_tags($body['content'])),
      'parent_id' => 0,
      'blog_id' => $id,
      'user_id' => !empty($userId) ? $userId : NULL,
      'create_at' => date('Y-m-d H:i:s'),
      'status' => 0
    ];

    if (empty($userId)) {
      $dataInsert['name'] = trim(strip_tags($body['name']));
      $dataInsert['email'] = trim(strip_tags($body['email']));
      $dataInsert['website'] = trim(strip_tags($body['website']));
    }

    if (!empty($commentId)) {
      $dataInsert['parent_id'] = $commentId;
      $dataInsert['status'] = 1; //bỏ duyệt khi trả lời
    }

    $insertStatus = insert('comments', $dataInsert);

    if ($insertStatus) {
      setFlashData('msg', 'Comment added successfully');
      setFlashData('msg_type', 'success');
      redirect('?module=blog&action=detail&id=' . $id . '#comment-form');
    } else {
      setFlashData('msg', 'Comment added failed');
      setFlashData('msg_type', 'danger');
      setFlashData('errors', $errors);
      setFlashData('old', $body);
      redirect('?module=blog&action=detail&id=' . $id . '#comment-form');
    }
  } else {
    //Có lỗi xảy ra
    setFlashData('msg', 'Please check the entered data');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);
    redirect('?module=blog&action=detail&id=' . $id . '#comment-form');
  }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

//Lấy dữ liệu từ cookie
$commentInfo = [];
if (!empty($_COOKIE['commentInfo'])) {
  $commentInfo = json_decode($_COOKIE['commentInfo'], true);
}
?>
<div class="comments-form">
  <h2 class="title"><?php echo !(empty($commentName)) ? 'Reply to ' . $commentName . '\'s comment ' . '<a href="' . _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $id . '"><i class="fa fa-times"></i> Cancel</a>' : 'Leave a comment'; ?></h2>
  <!-- Contact Form -->
  <?php

  //Check admin login
  if (!empty($userId)) {
    $userDetail = getUserInfo($userId);
    echo 'You are login with: ' . '<b>' . $userDetail['fullname'] . '</b>' . ' - <a href="' . _WEB_HOST_ROOT . '/admin?module=auth&action=logout' . '">Logout</a>';
  }
  getMsg($msg, $msgType);
  ?>
  <form class="form" method="post" action="">
    <div class="row">
      <?php if (empty($userId)) : ?>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <input type="text" name="name" placeholder="Full Name" value="<?php echo !empty($commentInfo['name']) ? $commentInfo['name'] : ''; ?>">
            <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" value="<?php echo !empty($commentInfo['email']) ? $commentInfo['email'] : ''; ?>">
            <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <input type="text" name="website" placeholder="Website" value="<?php echo !empty($commentInfo['website']) ? $commentInfo['website'] : ''; ?>">
            <?php echo form_error('website', $errors, '<span class="error">', '</span>'); ?>
          </div>
        </div>
      <?php endif; ?>
      <div class="col-12">
        <div class="form-group">
          <textarea name="content" rows="5" placeholder="Type Your Message Here"></textarea>
          <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
        </div>
      </div>
      <div class="col-12">
        <div class="form-group button">
          <button type="submit" class="btn primary">Submit Comment</button>
        </div>
      </div>
    </div>
  </form>
  <!--/ End Contact Form -->
</div>