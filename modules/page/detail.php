<?php
if (!defined('_INCODE')) die('Access Deined...');
if (!empty(getBody()['id'])) {
  $id = getBody()['id'];
  $pageDetail = firstRaw("SELECT * FROM pages WHERE id = $id");

  if (empty($pageDetail)) {
    loadError('404');
  }
} else {
  loadError('404');
}
$data = [
  'pageTitle' => $pageDetail['title']
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
?>
<!-- Blogs Area -->
<section class="blogs-main archives single section">
  <div class="container">
    <h1 class="page-title"><?php echo $pageDetail['title']; ?></h1>
    <hr>
    <div><?php echo html_entity_decode($pageDetail['content']); ?></div>
</section>
<!--/ End Blogs Area -->
<?php
layout('footer', 'client');
