<?php
if (!defined('_INCODE')) die('Access Deined...');

//Lấy từ khóa tìm kiếm
$keyword = '';
if (!empty(getBody()['keyword'])) {
  $keyword = getBody()['keyword'];
} else {
  loadError('404');
}
$data = [
  'pageTitle' => 'Search'
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);


//Xử lý phân trang

//Số lượng bản ghi blog
$allBlogNum = getRows("SELECT id FROM blog WHERE title LIKE '%$keyword%'OR content LIKE '%$keyword%'");

//Thiết lập số lượng bản ghi trên 1 trang
$perPage = getOption('blog_per_page') ? getOption('blog_per_page') : 6;

//Tính số trang
$maxPage = ceil($allBlogNum / $perPage);

//Xử lý số trang dựa vào phương thức GET
if (!empty(getBody()['page'])) {
  $page = getBody()['page'];
  if ($page < 1 || $page > $maxPage) {
    $page = 1;
  }
} else {
  $page = 1;
}

//Tính toán offset trong Limit dựa vào biến $page
/*
 * $page = 1 => offset = 0 = ($page-1)*$perPage = (1-1)*3 = 0
 * $page = 2 => offset = 3 = ($page-1)*$perPage = (2-1)*3 = 3
 * $page = 3 => offset = 6 = ($page-1)*$perPage = (3-1)*3 = 6
 *
 * */
$offset = ($page - 1) * $perPage;


//Truy vấn blog
$listBlog = getRaw("SELECT title, description, thumbnail, view_count, blog.create_at as create_at, blog.id, blog_categories.name as cate_name, blog_categories.id as cate_id FROM blog INNER JOIN blog_categories ON blog.category_id=blog_categories.id WHERE blog.title LIKE '%$keyword%'OR blog.content LIKE '%$keyword%' ORDER BY blog.create_at DESC LIMIT $offset, $perPage");

?>
<!-- Blogs Area -->
<section class="blogs-main archives section">
  <div class="container">
    <h3><?php echo ($allBlogNum) > 1 ? $allBlogNum . ' results found' : $allBlogNum . ' result found'; ?></h3>
    <?php
    if (!empty($listBlog)) :
    ?>
      <div class="row">
        <?php
        foreach ($listBlog as $item) :
        ?>
          <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <img src="<?php echo $item['thumbnail']; ?>" alt="#">
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="<?php echo _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $item['id']; ?>"><?php echo truncateText($item['title'], 30); ?></a></h4>
                  <p><?php echo $item['description']; ?></p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="<?php echo _WEB_HOST_ROOT . '?module=blog&action=category&id=' . $item['cate_id']; ?>"><?php echo $item['cate_name']; ?></a></span>
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
        ?>
      </div>
    <?php else : ?>
      <p>Không có bài viết</p>
    <?php
    endif;
    ?>
    <div class="row">
      <?php
      $begin = $page - 2;
      if ($begin < 1) {
        $begin = 1;
      }
      $end = $page + 2;
      if ($end > $maxPage) {
        $end = $maxPage;
      }
      if ($maxPage > 1) :
      ?>
        <div class="col-12">
          <!-- Start Pagination -->
          <div class="pagination-main">
            <ul class="pagination">
              <?php
              if ($page > 1) {
                $prevPage = $page - 1;
                echo '<li class="prev"><a href="' . _WEB_HOST_ROOT . '?module=search&keyword=' . $keyword . '&page=' . $prevPage . '"><i class="fa fa-angle-double-left"></i></a></li>';
              }
              for ($index = $begin; $index <= $end; $index++) :
                $classActive = ($index == $page) ? 'active' : '';
              ?>
                <li class="<?php echo $classActive; ?>"><a href="<?php echo _WEB_HOST_ROOT . '?module=search&keyword=' . $keyword . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
              <?php
              endfor;
              if ($page < $maxPage) {
                $nextPage = $page + 1;
                echo '<li class="next"><a href="' . _WEB_HOST_ROOT . '?module=search&keyword=' . $keyword . '&page=' . $nextPage . '"><i class="fa fa-angle-double-right"></i></a></li>';
              }
              ?>
            </ul>
          </div>
          <!--/ End Pagination -->
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!--/ End Blogs Area -->
<?php
layout('footer', 'client');
