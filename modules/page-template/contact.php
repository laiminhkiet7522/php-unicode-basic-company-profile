<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => getOption('contact_title')
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

$title = getOption('contact_primary_title');
$titleBg = getOption('contact_title_bg');
$desc = getOption('contact_desc');

$facebook = getOption('general_facebook');
$twitter = getOption('general_twitter');
$linkedin = getOption('general_linkedin');
$behance = getOption('general_behance');
$youtube = getOption('general_youtube');

//Truy vấn lấy phòng ban
$contactTypeLists = getRaw("SELECT * FROM contact_type ORDER BY name ASC");

//Xử lý gửi liên hệ
if (isPost()) {
  $body = getBody();
  $errors = [];

  //Validate full name
  if (empty(trim($body['fullname']))) {
    $errors['fullname']['required'] = 'Full name is required';
  } elseif (strlen(trim($body['fullname'])) < 5) {
    $errors['name']['min'] = 'Full name must be at least 5 characters';
  }

  //Validate email
  if (empty(trim($body['email']))) {
    $errors['email']['required'] = 'Email is required';
  } elseif (!isEmail(trim($body['email']))) {
    $errors['email']['invalid'] = 'Email is invalid';
  }

  //Validate message
  if (empty($body['message'])) {
    $errors['message']['required'] = 'Please enter your message';
  } else {
    if (strlen(trim($body['message'])) < 10) {
      $errors['message']['min'] = 'Message must be at least 10 characters';
    }
  }

  if (empty($errors)) {
    //Xử lý thêm liên hệ vào cơ sở dữ liệu
    $dataInsert = [
      'fullname' => trim(strip_tags($body['fullname'])),
      'email' => trim(strip_tags($body['email'])),
      'type_id' => $body['contact_type'],
      'message' => trim(strip_tags($body['message'])),
      'status' => 0,
      'create_at' => date('Y-m-d H:i:s')
    ];

    $insertStatus = insert('contacts', $dataInsert);
    if ($insertStatus) {
      setFlashData('msg', 'Contact sent successfully');
      setFlashData('msg_type', 'success');

      $contactType = getContactType($dataInsert['type_id']);
      $siteName = getOption('general_sitename');

      //Gửi mail cho khách hàng
      $subjectCustomer = 'Thank you for your contact';
      $contentCustomer = '<p>Dear ' . '<b>' . $dataInsert['fullname'] . ',</b>' . '</p>';
      $contentCustomer .= '<p>Thank you for contacting us, below is your information</p>';
      $contentCustomer .= '<p>Full name: ' . $dataInsert['fullname'] . '</p>';
      $contentCustomer .= '<p>Email: ' . $dataInsert['email'] . '</p>';
      $contentCustomer .= '<p>Message: ' . $dataInsert['message'] . '</p>';
      $contentCustomer .= '<p>Department: ' . $contactType['name'] . '</p>';
      $contentCustomer .= '<p>Sending time: ' . $dataInsert['create_at'] . '</p>';
      $contentCustomer .= '<p>We will contact you as soon as possible</p>';
      $contentCustomer .= '<p>Best regards</p>';
      sendMail($dataInsert['email'], $subjectCustomer, $contentCustomer);

      //Gửi email cho admin
      $subjectAdmin = 'There is 1 new contact';
      $contentAdmin = '<p>Sender contact information</p>';
      $contentAdmin .= '<p>Full name: ' . $dataInsert['fullname'] . '</p>';
      $contentAdmin .= '<p>Email: ' . $dataInsert['email'] . '</p>';
      $contentAdmin .= '<p>Message: ' . $dataInsert['message'] . '</p>';
      $contentAdmin .= '<p>Department: ' . $contactType['name'] . '</p>';
      $contentAdmin .= '<p>Sending time: ' . $dataInsert['create_at'] . '</p>';
      sendMail(getOption('general_email'), $subjectAdmin, $contentAdmin);

      redirect('?module=page-template&action=contact');
    } else {
      setFlashData('msg', 'Sending contact failed');
      setFlashData('msg_type', 'danger');
      setFlashData('errors', $errors);
      setFlashData('old', $body);
      redirect('?module=page-template&action=contact');
    }
  } else {
    //Có lỗi xảy ra
    setFlashData('msg', 'Please check the entered data');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    redirect('?module=page-template&action=contact');
  }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');

?>
<!-- Start Contact -->
<section id="contact-us" class="contact-us section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <span class="title-bg"><?php echo !empty($titleBg) ? $titleBg : '' ?></span>
          <h1><?php echo !empty($title) ? $title : '' ?></h1>
          <p><?php echo !empty($desc) ? $desc : '' ?></<p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="contact-main">
          <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 col-12">
              <div class="form-main">
                <div class="text-content">
                  <h2>Send Message Us</h2>
                </div>
                <?php
                getMsg($msg, $msgType);
                ?>
                <form class="form" method="post" action="">
                  <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <input type="text" name="fullname" placeholder="Full Name">
                        <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email">
                        <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <select name="contact_type">
                          <?php
                          if (!empty($contactTypeLists)) :
                            foreach ($contactTypeLists as $item) : ?>
                              <option class="option" value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                          <?php
                            endforeach;
                          endif;
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12 col-12">
                      <div class="form-group">
                        <textarea name="message" rows="6" placeholder="Type Your Message"></textarea>
                        <?php echo form_error('message', $errors, '<span class="error">', '</span>'); ?>
                      </div>
                    </div>
                    <div class="col-lg-12 col-12">
                      <div class="form-group button">
                        <button type="submit" class="btn primary">Submit Message</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!--/ End Contact Form -->
            <!-- Contact Address -->
            <div class="col-lg-4 col-12">
              <div class="contact-address">
                <!-- Address -->
                <div class="contact">
                  <h2>Our Contact Address</h2>
                  <ul class="address">
                    <li><i class="fa fa-paper-plane"></i><span>Address: </span> <?php echo getOption('general_address'); ?></li>
                    <li><i class="fa fa-phone"></i><span>Hotline: </span><?php echo getOption('general_hotline'); ?></li>
                    <li class="email"><i class="fa fa-envelope"></i><span>Email: </span><a href="mailto:<?php echo getOption('general_email'); ?>"></a><?php echo getOption('general_email'); ?></li>
                  </ul>
                </div>
                <!--/ End Address -->
                <!-- Social -->
                <ul class="social">
                  <li class="active"><a target=_blank href="<?php echo !empty($facebook) ? $facebook : '#'; ?>"><i class="fa fa-facebook"></i>Like Us facebook</a></li>
                  <li><a target=_blank href="<?php echo !empty($twitter) ? $twitter : '#'; ?>"><i class="fa fa-twitter"></i>Follow Us twitter</a></li>
                  <li><a target=_blank href="<?php echo !empty($linkedin) ? $linkedin : '#'; ?>"><i class="fa fa-linkedin"></i>Follow Us linkedin</a></li>
                  <li><a target=_blank href="<?php echo !empty($behance) ? $behance : '#'; ?>"><i class="fa fa-behance"></i>Follow Us behance</a></li>
                  <li><a target=_blank href="<?php echo !empty($youtube) ? $youtube : '#'; ?>"><i class="fa fa-youtube"></i>Follow Us youtube</a></li>
                </ul>
                <!--/ End Social -->
              </div>
            </div>
            <!--/ End Contact Address -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Contact -->
<?php
require_once _WEB_PATH_ROOT . '/modules/home/contents/partner.php';
layout('footer', 'client');
