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
?>

<!-- Call To Action -->
<section class="call-to-action section" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-12 wow fadeInUp">
        <div class="call-to-main">
          <h2>We have 35+ Years of experiences for creating creative website project.</h2>
          <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim feugiat, facilisis arcu
            vehicula, consequat sem. Cras et vulputate nisi, ac dignissim mi. Etiam laoreet</p>
          <a href="contact.html" class="btn">Buy This Theme</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Call To Action -->

<!-- Blogs Area -->
<section class="blogs-main section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg">News</span>
          <h1>Latest Blogs</h1>
          <p>Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam.
            Sed scelerisque maximus magna, a vehicula turpis Proin
          <p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="row blog-slider">
          <div class="col-lg-4 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/blogs/blog1.jpg" alt="#">
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="blog-single.html">Recognizing the need is the primary</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor
                    sedelon bond</p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="#">Marketing</a></span>
                    <span><i class="fa fa-calendar"></i>03 May, 2018</span>
                    <span><i class="fa fa-eye"></i><a href="#">333k</a></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
          <div class="col-lg-4 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/blogs/blog2.jpg" alt="#">
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="blog-single.html">How to grow your business with blank table!</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor
                    sedelon bond</p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="#">Business</a></span>
                    <span><i class="fa fa-calendar"></i>28 April, 2018</span>
                    <span><i class="fa fa-eye"></i><a href="#">5m</a></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
          <div class="col-lg-4 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/blogs/blog3.jpg" alt="#">
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="blog-single.html">10 ways to improve your startup Business</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor
                    sedelon bond</p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="#">Brand</a></span>
                    <span><i class="fa fa-calendar"></i>15 April, 2018</span>
                    <span><i class="fa fa-eye"></i><a href="#">10m</a></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
          <div class="col-lg-4 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/blogs/blog4.jpg" alt="#">
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="blog-single.html">Recognizing the need is the primary</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor
                    sedelon bond</p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="#">Online</a></span>
                    <span><i class="fa fa-calendar"></i>25 March, 2018</span>
                    <span><i class="fa fa-eye"></i><a href="#">38k</a></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
          <div class="col-lg-4 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/blogs/blog5.jpg" alt="#">
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="blog-single.html">How to grow your business with blank table!</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor
                    sedelon bond</p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="#">Marketing</a></span>
                    <span><i class="fa fa-calendar"></i>10 March, 2018</span>
                    <span><i class="fa fa-eye"></i><a href="#">100k</a></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
          <div class="col-lg-4 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/blogs/blog6.jpg" alt="#">
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="blog-single.html">10 ways to improve your startup Business</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac tincidunt tortor
                    sedelon bond</p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="#">Website</a></span>
                    <span><i class="fa fa-calendar"></i>21 February, 2018</span>
                    <span><i class="fa fa-eye"></i><a href="#">320k</a></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Blogs Area -->

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