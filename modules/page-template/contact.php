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
                <form class="form" method="post" action="mail/mail.php">
                  <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <input type="text" name="name" placeholder="Full Name" required="required">
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" required="required">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <select name="subject">
                          <option class="option" value="1">Starting a new business</option>
                          <option class="option" value="2">Startup Consultation</option>
                          <option class="option" value="3">Financial Consultation</option>
                          <option class="option" value="4">Business Consultation</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12 col-12">
                      <div class="form-group">
                        <textarea name="message" rows="6" placeholder="Type Your Message"></textarea>
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
