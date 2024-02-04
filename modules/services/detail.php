<?php
if (!defined('_INCODE')) die('Access Deined...');

if (!empty(getBody()['id'])) {
  $id = getBody()['id'];

  //Thực hiện truy vấn với bảng services
  $sql = "SELECT * FROM services WHERE id = $id";
  $serviceDetail = firstRaw($sql);
  if (empty($serviceDetail)) {
    loadError('404');
  }
} else {
  loadError('404');
}

$data = [
  'pageTitle' => $serviceDetail['name']
];

layout('header', 'client', $data);

$data['itemParent'] = '<li><a href="' . _WEB_HOST_ROOT . '?module=services' . '">' . getOption('service_title') . '</a></li>';

layout('breadcrumb', 'client', $data);

?>
<!-- Services -->
<section id="services" class="services archives section">
  <div class="container">
    <h1 class="text-small"><?php echo $serviceDetail['name']; ?></h1>
    <hr>
    <div class="content">
      <?php echo html_entity_decode($serviceDetail['content']); ?>
    </div>
  </div>
</section>
<!--/ End Services -->

<?php
layout('footer', 'client');
