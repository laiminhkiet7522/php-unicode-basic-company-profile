<!-- Breadcrumbs -->
<section class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><i class="fa fa-pencil"></i><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : ''; ?></h2>
        <ul>
          <li><a href="<?php echo _WEB_HOST_ROOT; ?>"><i class="fa fa-home"></i>Home</a></li>
          <?php echo !empty($data['itemParent']) ? $data['itemParent'] : false; ?>
          <li class="active"><a href="#"><i class="fa fa-clone"></i><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : false; ?></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!--/ End Breadcrumbs -->