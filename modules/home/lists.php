<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Trang chủ'
];
layout('header', 'client', $data);

require_once 'contents/slide.php';
?>


<!-- About Us -->
<section class="about-us section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title wow fadeInUp">
          <span class="title-bg">Radix</span>
          <h1>About Company</h1>
          <p>contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
            Latin literature from 45 BC, making it over 2000 years old
          <p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-12 wow fadeInLeft" data-wow-delay="0.6s">
        <!-- Video -->
        <div class="about-video">
          <div class="single-video overlay">
            <a href="https://www.youtube.com/watch?v=E-2ocmhF6TA" class="video-popup mfp-fade"><i class="fa fa-play"></i></a>
            <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/gallery-4.jpg" alt="#">
          </div>
        </div>
        <!--/ End Video -->
      </div>
      <div class="col-lg-6 col-12 wow fadeInRight" data-wow-delay="0.8s">
        <!-- About Content -->
        <div class="about-content">
          <h2>We are professional website design & development company!</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. You think water moves
            fast? You should see ice.</p>
          <p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the
            world once and got a taste for murder. After the avalanche, it took us a weeked do incididunt magna Lorem
          </p>
          <p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the
            world once and got a taste for murder. After the avalancip isicing elit, sed do eiusmod tempor incididunt
          </p>
        </div>
        <!--/ End About Content -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="progress-main">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.4s">
              <!-- Single Skill -->
              <div class="single-progress">
                <h4>Communication</h4>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 78%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span class="percent">78%</span></div>
                </div>
              </div>
              <!--/ End Single Skill -->
            </div>
            <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.6s">
              <!-- Single Skill -->
              <div class="single-progress">
                <h4>Business Develop</h4>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span class="percent">80%</span></div>
                </div>
              </div>
              <!--/ End Single Skill -->
            </div>
            <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.8s">
              <!-- Single Skill -->
              <div class="single-progress">
                <h4>Creative Work</h4>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span class="percent">90%</span></div>
                </div>
              </div>
              <!--/ End Single Skill -->
            </div>
            <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay="1s">
              <!-- Single Skill -->
              <div class="single-progress">
                <h4>Bootstrap 4</h4>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span class="percent">95%</span></div>
                </div>
              </div>
              <!--/ End Single Skill -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End About Us -->

<!-- Services -->
<section id="services" class="services section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg">Services</span>
          <h1>What we provide</h1>
          <p>Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam.
            Sed scelerisque maximus magna, a vehicula turpis Proin
          <p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="service-slider">
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-magic"></i>
            <h2><a href="service-single.html">Consulting</a></h2>
            <p>welcome to our consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt</p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-lightbulb-o"></i>
            <h2><a href="service-single.html">Creative Idea</a></h2>
            <p>Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin
            </p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-wordpress"></i>
            <h2><a href="service-single.html">Development</a></h2>
            <p>just fine erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-bullhorn "></i>
            <h2><a href="service-single.html">Marketing</a></h2>
            <p>Possible of erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-magic"></i>
            <h2><a href="service-single.html">Consulting</a></h2>
            <p>welcome to our consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt</p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-lightbulb-o"></i>
            <h2><a href="service-single.html">Creative Idea</a></h2>
            <p>Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin
            </p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-wordpress"></i>
            <h2><a href="service-single.html">Development</a></h2>
            <p>just fine erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-bullhorn "></i>
            <h2><a href="service-single.html">Marketing</a></h2>
            <p>Possible of erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-bullseye "></i>
            <h2><a href="service-single.html">Direct Work</a></h2>
            <p>Everything ien erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat Latin</p>
          </div>
          <!-- End Single Service -->
          <!-- Single Service -->
          <div class="single-service">
            <i class="fa fa-cube"></i>
            <h2><a href="service-single.html">Creative Plan</a></h2>
            <p>Information sapien erat, non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin
            </p>
          </div>
          <!-- End Single Service -->
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Services -->

<!-- Fun Facts -->
<section id="fun-facts" class="fun-facts section">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-12 wow fadeInLeft" data-wow-delay="0.5s">
        <div class="text-content">
          <div class="section-title">
            <h1><span>Our achievements</span>With smooth animation numbering </h1>
            <p>Pellentesque vitae gravida nulla. Maecenas molestie ligula quis urna viverra venenatis. Donec at ex
              metus. Suspendisse ac est et magna viverra eleifend. Etiam varius auctor est eu eleifend.</p>
            <a href="contact.html" class="btn primary">Contact Us</a>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-12">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.6s">
            <!-- Single Fact -->
            <div class="single-fact">
              <div class="icon"><i class="fa fa-clock-o"></i></div>
              <div class="counter">
                <p><span class="count">35</span></p>
                <h4>years of success</h4>
              </div>
            </div>
            <!--/ End Single Fact -->
          </div>
          <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.8s">
            <!-- Single Fact -->
            <div class="single-fact">
              <div class="icon"><i class="fa fa-bullseye"></i></div>
              <div class="counter">
                <p><span class="count">88</span>K</p>
                <h4>Project Complete</h4>
              </div>
            </div>
            <!--/ End Single Fact -->
          </div>
          <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1s">
            <!-- Single Fact -->
            <div class="single-fact">
              <div class="icon"><i class="fa fa-dollar"></i></div>
              <div class="counter">
                <p><span class="count">10</span>M</p>
                <h4>Total Earnings</h4>
              </div>
            </div>
            <!--/ End Single Fact -->
          </div>
          <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1.2s">
            <!-- Single Fact -->
            <div class="single-fact">
              <div class="icon"><i class="fa fa-trophy"></i></div>
              <div class="counter">
                <p><span class="count">32</span></p>
                <h4>Winning Awards</h4>
              </div>
            </div>
            <!--/ End Single Fact -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Fun Facts -->

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