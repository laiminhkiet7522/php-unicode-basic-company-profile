<?php
$title = getOption('home_blog_title');
$titleBg = getOption('home_blog_title_bg');
$desc = getOption('home_blog_desc');

//Truy vấn blog
$listBlog = getRaw("SELECT title, description, thumbnail, view_count, blog.create_at as create_at, blog.id, blog_categories.name as cate_name FROM blog INNER JOIN blog_categories ON blog.category_id=blog_categories.id");
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
          <?php
          if (!empty($listBlog)) :
            foreach ($listBlog as $item) :
          ?>
              <div class="col-lg-4 col-12">
                <!-- Single Blog -->
                <div class="single-blog">
                  <div class="blog-head">
                    <img src="<?php echo $item['thumbnail']; ?>" alt="#">
                  </div>
                  <div class="blog-bottom">
                    <div class="blog-inner">
                      <h4><a href="blog-single.html"><?php echo truncateText($item['title'], 30); ?></a></h4>
                      <p><?php echo $item['description']; ?></p>
                      <div class="meta">
                        <span><i class="fa fa-bolt"></i><a href="#"><?php echo $item['cate_name']; ?></a></span>
                        <span><i class="fa fa-calendar"></i><?php echo getDateFormat($item['create_at'], 'd M, Y') ?></span>
                        <span><i class="fa fa-eye"></i><a href="#"><?php echo $item['view_count']; ?></a></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Single Blog -->
              </div>
          <?php
            endforeach;
          endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Blogs Area -->