<?php
$title = getOption('home_blog_title');
$titleBg = getOption('home_blog_title_bg');
$desc = getOption('home_blog_desc');
?>
<!-- Blogs Area -->
<section class="blogs-main section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg"><?php echo (!empty($titleBg)) ? $titleBg : false; ?></span>
          <h1><?php echo (!empty($title)) ? $title : false; ?></h1>
          <p><?php echo (!empty($desc)) ? $desc : false; ?>
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