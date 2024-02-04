<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Dịch vụ'
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
?>
<!-- Services -->
<section id="services" class="services archives section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <span class="title-bg"><?php echo getOption('home_service_title_bg'); ?></span>
          <h1><?php echo getOption('home_service_title'); ?></h1>
          <p><?php echo html_entity_decode(getOption('home_service_desc')); ?>
          <p>
        </div>
      </div>
    </div>
    <?php
    $serviceLists = getRaw("SELECT * FROM `services` ORDER BY name ASC");
    if (!empty($serviceLists)) :
    ?>
      <div class="row">
        <?php foreach ($serviceLists as $item) : ?>
          <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Service -->
            <div class="single-service">
              <?php echo html_entity_decode($item['icon']); ?>
              <h2><a href="#"><?php echo $item['name']; ?></a></h2>
              <p><?php echo $item['description']; ?></p>
            </div>
            <!-- End Single Service -->
          </div>
        <?php endforeach; ?>
      </div>
    <?php else : ?>
      <div class="alert alert-danger text-center">
        Không có dịch vụ
      </div>
    <?php
    endif;
    ?>
  </div>
</section>
<!--/ End Services -->
<!-- Partners -->
<section id="partners" class="partners section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <span class="title-bg">Clients</span>
          <h1>Our Partners</h1>
          <p>Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin
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
                <a href="#" target="_blank"><img src="images/partner-1.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-2.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-3.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-4.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-5.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-6.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-7.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-8.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-5.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-6.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-7.png" alt="#"></a>
              </div>
            </div>
            <!--/ End Single Partner -->
            <!-- Single Partner -->
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="#" target="_blank"><img src="images/partner-3.png" alt="#"></a>
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
