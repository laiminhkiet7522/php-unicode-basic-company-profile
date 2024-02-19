<?php
if (!defined('_INCODE')) die('Access Deined...');

if (!empty(getBody()['id'])) {
  $id = getBody()['id'];

  //Thực hiện truy vấn với bảng portfolio
  $sql = "SELECT p.*, c.name as cate_name FROM portfolios as p INNER JOIN portfolio_categories as c ON p.portfolio_category_id = c.id WHERE p.id = $id";
  $portfolioDetail = firstRaw($sql);
  if (empty($portfolioDetail)) {
    loadError('404');
  }
} else {
  loadError('404');
}

$data = [
  'pageTitle' => $portfolioDetail['name']
];

layout('header', 'client', $data);

$data['itemParent'] = '<li><a href="' . _WEB_HOST_ROOT . '?module=portfolios' . '">Portfolio</a></li>';

layout('breadcrumb', 'client', $data);

?>
<!-- Portfolio -->
<section id="services" class="services archives section">
  <div class="container">
    <h1 class="text-small"><?php echo $portfolioDetail['name']; ?></h1>
    <div class="portfolio-meta">
      Category: <?php echo $portfolioDetail['cate_name']; ?> | Hour: <?php echo getDateFormat($portfolioDetail['create_at'], 'd/m/Y'); ?>
    </div>
    <hr>
    <div>
      <?php echo html_entity_decode($portfolioDetail['content']); ?>
    </div>
    <div class="row" style="margin-top: 30px;">
      <?php
      $checkVideo = false;
      if (!empty($portfolioDetail['video'])) :
        $checkVideo = true;
      ?>
        <div class="col-6">
          <h3>Video</h3>
          <hr>
          <?php
          $videoId = getYoutubeId($portfolioDetail['video']);
          if (!empty($videoId)) {
            echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
          }
          ?>
        </div>
      <?php endif; ?>
      <?php
      if ($checkVideo) {
        echo '<div class="col-6">';
      } else {
        echo '<div class="col-12">';
      }
      ?>
      <h3>Thumbnail</h3>
      <hr>
      <div class="row">
        <div class="col-4 mb-4">
          <a href="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" data-fancybox="gallery"><img src="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" alt=""></a>
        </div>
        <div class="col-4 mb-4">
          <a href="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" data-fancybox="gallery"><img src="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" alt=""></a>
        </div>
        <div class="col-4 mb-4">
          <a href="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" data-fancybox="gallery"><img src="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" alt=""></a>
        </div>
        <div class="col-4 mb-4">
          <a href="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" data-fancybox="gallery"><img src="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" alt=""></a>
        </div>
        <div class="col-4 mb-4">
          <a href="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" data-fancybox="gallery"><img src="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" alt=""></a>
        </div>
        <div class="col-4 mb-4">
          <a href="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" data-fancybox="gallery"><img src="https://media.istockphoto.com/id/1868061596/vi/vec-to/m%E1%BB%99t-ng%C6%B0%E1%BB%9Di-%C4%91%C3%A0n-%C3%B4ng-trang-tr%C3%AD-c%C3%A2y-th%C3%B4ng-noel-trong-khi-v%E1%BB%A3-mang-qu%C3%A0.jpg?s=1024x1024&w=is&k=20&c=jrbIlZfDg8MNyjAJfhY2sYGDMo-SrsCJ3rM5NZ77ds8=" alt=""></a>
        </div>
      </div>
      <?php
      echo '</div>';
      ?>
    </div>
  </div>
</section>
<!--/ End Portfolio -->

<?php
layout('footer', 'client');
