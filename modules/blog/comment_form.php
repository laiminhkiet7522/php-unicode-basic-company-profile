<?php
if (isPost()) {
  $body = getBody();
  $errors = [];

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

  //Validate content
  if (empty($body['content'])) {
    $errors['content']['required'] = 'Please enter your message';
  } else {
    if (strlen(trim($body['content'])) < 10) {
      $errors['content']['min'] = 'Message must be at least 10 characters';
    }
  }

  if (empty($errors)) {
  } else {
    //Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
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
?>
<div class="comments-form" id="comment-form">
  <h2 class="title">Leave a comment</h2>
  <!-- Contact Form -->
  <form class="form" method="post" action="">
    <div class="row">
      <div class="col-lg-4 col-12">
        <div class="form-group">
          <input type="text" name="name" placeholder="Full Name">
          <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
        </div>
      </div>
      <div class="col-lg-4 col-12">
        <div class="form-group">
          <input type="email" name="email" placeholder="Your Email">
          <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
        </div>
      </div>
      <div class="col-lg-4 col-12">
        <div class="form-group">
          <input type="text" name="website" placeholder="Website">
          <?php echo form_error('website', $errors, '<span class="error">', '</span>'); ?>
        </div>
      </div>
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