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
?>

<!-- Portfolio -->
<section id="portfolio" class="portfolio section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg">Projects</span>
          <h1>Our Portfolio</h1>
          <p>Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam.
            Sed scelerisque maximus magna, a vehicula turpis Proin
          <p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <!-- portfolio Nav -->
        <div class="portfolio-nav">
          <ul class="tr-list list-inline" id="portfolio-menu">
            <li data-filter="*" class="cbp-filter-item active">All Works<div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".animation" class="cbp-filter-item">Animation<div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".website" class="cbp-filter-item">Website<div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".package" class="cbp-filter-item">Package<div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".development" class="cbp-filter-item">Development<div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".printing" class="cbp-filter-item">Printing<div class="cbp-filter-counter"></div>
            </li>
          </ul>
        </div>
        <!--/ End portfolio Nav -->
      </div>
    </div>
    <div class="portfolio-inner">
      <div class="row">
        <div class="col-12">
          <div id="portfolio-item">
            <!-- Single portfolio -->
            <div class="cbp-item website animation printing">
              <div class="portfolio-single">
                <div class="portfolio-head">
                  <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p1.jpg" alt="#" />
                </div>
                <div class="portfolio-hover">
                  <h4><a href="portfolio-single.html">Creative Work</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                    <a class="primary" data-fancybox="gallery" href="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p1.jpg"><i class="fa fa-search"></i></a>
                    <a href="portfolio-single.html"><i class="fa fa-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!--/ End portfolio -->
            <!-- Single portfolio -->
            <div class="cbp-item website package development">
              <div class="portfolio-single">
                <div class="portfolio-head">
                  <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p2.jpg" alt="#" />
                </div>
                <div class="portfolio-hover">
                  <h4><a href="portfolio-single.html">Responsive Design</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                    <a href="https://www.youtube.com/watch?v=E-2ocmhF6TA" class="primary cbp-lightbox"><i class="fa fa-play"></i></a>
                    <a href="portfolio-single.html"><i class="fa fa-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!--/ End portfolio -->
            <!-- Single portfolio -->
            <div class="cbp-item website animation">
              <div class="portfolio-single">
                <div class="portfolio-head">
                  <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p3.jpg" alt="#" />
                </div>
                <div class="portfolio-hover">
                  <h4><a href="portfolio-single.html">Bootstrap Based</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                    <a class="primary" data-fancybox="gallery" href="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p3.jpg"><i class="fa fa-search"></i></a>
                    <a href="portfolio-single.html"><i class="fa fa-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!--/ End portfolio -->
            <!-- Single portfolio -->
            <div class="cbp-item development printing">
              <div class="portfolio-single">
                <div class="portfolio-head">
                  <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p4.jpg" alt="#" />
                </div>
                <div class="portfolio-hover">
                  <h4><a href="portfolio-single.html">Clean Design</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                    <a href="https://www.youtube.com/watch?v=E-2ocmhF6TA" class="primary cbp-lightbox"><i class="fa fa-play"></i></a>
                    <a href="portfolio-single.html"><i class="fa fa-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!--/ End portfolio -->
            <!-- Single portfolio -->
            <div class="cbp-item development package">
              <div class="portfolio-single">
                <div class="portfolio-head">
                  <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p5.jpg" alt="#" />
                </div>
                <div class="portfolio-hover">
                  <h4><a href="portfolio-single.html">Animation</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                    <a class="primary" data-fancybox="gallery" href="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p5.jpg"><i class="fa fa-search"></i></a>
                    <a href="portfolio-single.html"><i class="fa fa-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!--/ End portfolio -->
            <!-- Single portfolio -->
            <div class="cbp-item website animation printing">
              <div class="portfolio-single">
                <div class="portfolio-head">
                  <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/portfolio/p6.jpg" alt="#" />
                </div>
                <div class="portfolio-hover">
                  <h4><a href="portfolio-single.html">Parallax</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                    <a href="https://www.youtube.com/watch?v=E-2ocmhF6TA" class="primary cbp-lightbox"><i class="fa fa-play"></i></a>
                    <a href="portfolio-single.html"><i class="fa fa-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!--/ End portfolio -->
          </div>
        </div>
        <div class="col-12">
          <div class="button">
            <a class="btn primary" href="portfolio-3-column.html">More Portfolio</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End portfolio -->

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