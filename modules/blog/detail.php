<?php
if (!defined('_INCODE')) die('Access Deined...');

if (!empty(getBody('get')['id'])) {
  $id = getBody('get')['id'];

  setView($id);

  $blogDetail = firstRaw("SELECT blog.*, blog_categories.name as cate_name, blog_categories.id as cate_id, users.fullname, users.email, groups.name as group_name, users.about_content, users.contact_facebook, users.contact_twitter, users.contact_linkedin, users.contact_pinterest, (SELECT count(id) FROM blog WHERE user_id = users.id) as total_blog FROM blog INNER JOIN blog_categories ON blog.category_id = blog_categories.id INNER JOIN users ON blog.user_id = users.id INNER JOIN `groups` ON users.group_id = `groups`.id WHERE blog.id = $id");

  if (empty($blogDetail)) {
    loadError('404');
  }
} else {
  loadError('404');
}

$parentBreadcrumb = '<li><a href="' . _WEB_HOST_ROOT . '?module=blog' . '">' . getOption('blog_title') . '</a></li>';
$parentBreadcrumb .= '<li><a href="' . _WEB_HOST_ROOT . '?module=blog&action=category&id=' . $blogDetail['cate_id'] . '">' . $blogDetail['cate_name'] . '</a></li>';

$data = [
  'pageTitle' => $blogDetail['title'],
  'pageName' => getOption('blog_title'),
  'itemParent' => $parentBreadcrumb,
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

//Truy vấn lấy tất cả bài viết
$allBlogs = getRaw("SELECT * FROM blog ORDER BY create_at DESC");

$currentKey = array_search($id, array_column($allBlogs, 'id'));

$userEmail = $blogDetail['email'];
$hashGravatar = md5($userEmail);
$avatarUrl = 'https://gravatar.com/avatar/' . $hashGravatar . '?s=200';
?>
<!-- Blogs Area -->
<section class="blogs-main archives single section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 col-12">
        <div class="row">
          <div class="col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <?php
              if (!empty($blogDetail['thumbnail'])) :
              ?>
                <div class="blog-head">
                  <img src="<?php echo $blogDetail['thumbnail']; ?>" alt="#">
                </div>
              <?php endif; ?>
              <div class="blog-inner">
                <div class="blog-top">
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="<?php echo _WEB_HOST_ROOT . '?module=blog&action=category&id=' . $blogDetail['cate_id']; ?>"><?php echo $blogDetail['cate_name']; ?></a></span>
                    <span><i class="fa fa-calendar"></i><?php echo getDateFormat($blogDetail['create_at'], 'd M, Y') ?></span>
                    <span><i class="fa fa-eye"></i><?php echo $blogDetail['view_count']; ?></span>
                  </div>
                  <ul class="social-share">
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $id; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>

                    <li><a href="http://twitter.com/share?text=<?php echo $blogDetail['title'] . '&url=' . _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $id; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>

                    <li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $id; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>

                    <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $id; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>

                  </ul>
                </div>
                <h2><?php echo $blogDetail['title']; ?></h2>
                <?php echo html_entity_decode($blogDetail['content']); ?>
                <div class="bottom-area">
                  <!-- Next Prev -->
                  <ul class="arrow">
                    <?php
                    if ($currentKey > 0) :
                    ?>
                      <li class="prev"><a href="<?php echo _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $allBlogs[$currentKey - 1]['id']; ?>"><i class="fa fa-angle-double-left"></i>Previews Posts</a></li>
                    <?php endif; ?>
                    <?php
                    if ($currentKey < count($allBlogs) - 1) :
                    ?>
                      <li class="next"><a href="<?php echo _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $allBlogs[$currentKey + 1]['id']; ?>">Next Posts<i class="fa fa-angle-double-right"></i></a></li>
                    <?php endif; ?>
                  </ul>
                  <!--/ End Next Prev -->
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
          <div class="col-12">
            <div class="author-details">
              <div class="author-left">
                <img src="<?php echo $avatarUrl; ?>" alt="#">
                <h4><?php echo $blogDetail['fullname']; ?><span><?php echo $blogDetail['group_name']; ?></span></h4>
                <p><a href="#"><i class="fa fa-pencil"></i><?php echo $blogDetail['total_blog']; ?> posts</a></p>
              </div>
              <div class="author-content">
                <p><?php echo $blogDetail['about_content']; ?></p>
                <ul class="social-share">
                  <li><a href="<?php echo $blogDetail['contact_facebook']; ?>"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="<?php echo $blogDetail['contact_twitter']; ?>"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="<?php echo $blogDetail['contact_linkedin']; ?>"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="<?php echo $blogDetail['contact_pinterest']; ?>"><i class="fa fa-pinterest"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-12">
            <?php require_once _WEB_PATH_ROOT . '/modules/blog/comment_lists.php'; ?>
          </div>
          <div class="col-12" id="comment-form">
            <?php require_once _WEB_PATH_ROOT . '/modules/blog/comment_form.php'; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Blogs Area -->
<?php
layout('footer', 'client');
