<?php
if (!defined('_INCODE')) die('Access Deined...');

if (!empty(getBody()['id'])) {
  $id = getBody()['id'];

  //Thực hiện truy vấn với bảng portfolio
  $sql = "SELECT p.*, c.name as cate_name FROM portfolios as p INNER JOIN portfolio_categories as c ON p.portfolio_category_id = c.id WHERE p.id = $id";
  $portfolioDetail = firstRaw($sql);

  $portfolioImages = getRaw("SELECT * FROM portfolio_images WHERE portfolio_id = $id");
  
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
      if(!empty($portfolioImages)):
      ?>
      <h3>Thumbnail</h3>
      <hr>
      <div class="row">
        <?php
        foreach ($portfolioImages as $item):
        ?>
        <div class="col-4 mb-4">
          <a href="<?php echo $item['image']; ?>" data-fancybox="gallery"><img src="<?php echo $item['image']; ?>" alt=""></a>
        </div>
        <?php endforeach;?>
      </div>
      <?php
      endif;
      echo '</div>';
      ?>
    </div>
  </div>
</section>
<!--/ End Portfolio -->

<?php
layout('footer', 'client');
