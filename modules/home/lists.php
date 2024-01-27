<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Trang chủ'
];
layout('header', 'client', $data);

require_once 'contents/slide.php';
require_once 'contents/about.php';
require_once 'contents/service.php';
require_once 'contents/facts.php';
require_once 'contents/portfolio.php';
require_once 'contents/cta.php';
require_once 'contents/blog.php';
?>

<!-- Partners -->
<section id="partners" class="partners section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg">Clients</span>
          <h1>Our Partners</h1>
          <p>Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam.
            Sed scelerisque maximus magna, a vehicula turpis Proin
          <p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="partners-inner">
          <div class="row no-gutters">
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-1.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-2.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-3.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-4.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-5.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-6.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-7.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-8.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-5.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-6.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-7.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/partner-3.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Partners -->
<?php
layout('footer', 'client');
?>