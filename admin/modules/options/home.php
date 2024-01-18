<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Thiết lập trang chủ'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// updateOptions();

if (isPost()) {

  $homeSlideJson = '';

  if (!empty(getBody()['home_slide'])) {

    $homeSlide = getBody()['home_slide'];

    $homeSlideArr = [];

    if (!empty($homeSlide['slide_title'])) {

      foreach ($homeSlide['slide_title'] as $key => $value) {
        $homeSlideArr[] = [
          'slide_title' => $value,
          'slide_button_text' => isset($homeSlide['slide_button_text'][$key]) ? $homeSlide['slide_button_text'][$key] : '',
          'slide_button_link' => isset($homeSlide['slide_button_link'][$key]) ? $homeSlide['slide_button_link'][$key] : '',
          'slide_video' => isset($homeSlide['slide_video'][$key]) ? $homeSlide['slide_video'][$key] : '',
          'slide_image_1' => isset($homeSlide['slide_image_1'][$key]) ? $homeSlide['slide_image_1'][$key] : '',
          'slide_image_2' => isset($homeSlide['slide_image_2'][$key]) ? $homeSlide['slide_image_2'][$key] : '',
          'slide_desc' => isset($homeSlide['slide_desc'][$key]) ? $homeSlide['slide_desc'][$key] : '',
          'slide_bg' => isset($homeSlide['slide_bg'][$key]) ? $homeSlide['slide_bg'][$key] : '',
          'slide_position' => isset($homeSlide['slide_position'][$key]) ? $homeSlide['slide_position'][$key] : 'left',
        ];
      }
    }

    //Chuyển mảng thành chuỗi json
    $homeSlideJson = json_encode($homeSlideArr);
  }

  /*
     * Cấu trúc mảng cần chuyển:
     *
     * [0] => [
     *   'slide_title' => 'Tiêu đề 1',
     *   'slide_button_text' => 'Xem thêm',
     *   'slide_button_link'  => '#'
     * ]
     *
     * */

  $data = [
    'home_slide' => $homeSlideJson
  ];

  updateOptions($data);
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <form action="" method="post">
      <?php
      getMsg($msg, $msgType);
      ?>
      <h5>Thiết lập slide</h5>
      <div class="slide-wrapper">
        <?php
        $homeSlideJson = getOption('home_slide');
        if (!empty($homeSlideJson)) {
          $homeSlideArr = json_decode($homeSlideJson, true);
          if (!empty($homeSlideArr)) {
            foreach ($homeSlideArr as $item) {
        ?>
              <div class="slide-item">
                <div class="row">
                  <div class="col-11">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Tiêu đề</label>
                          <input type="text" class="form-control" name="home_slide[slide_title][]" placeholder="Tiêu đề slide..." value="<?php echo $item['slide_title']; ?>" />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Nút xem thêm</label>
                          <input type="text" class="form-control" name="home_slide[slide_button_text][]" placeholder="Chữ của nút..." value="<?php echo $item['slide_button_text']; ?>" />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Link xem thêm</label>
                          <input type="text" class="form-control" name="home_slide[slide_button_link][]" placeholder="Link của nút..." value="<?php echo $item['slide_button_link']; ?>" />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Link Youtube</label>
                          <input type="text" class="form-control" name="home_slide[slide_video][]" placeholder="Link video youtube..." value="<?php echo $item['slide_video']; ?>" />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Ảnh 1</label>
                          <div class="row ckfinder-group">
                            <div class="col-10">
                              <input type="text" class="form-control image-render" name="home_slide[slide_image_1][]" placeholder="Đường dẫn ảnh..." value="<?php echo $item['slide_image_1']; ?>" />
                            </div>
                            <div class="col-2">
                              <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-upload" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Ảnh 2</label>
                          <div class="row ckfinder-group">
                            <div class="col-10">
                              <input type="text" class="form-control image-render" name="home_slide[slide_image_2][]" placeholder="Đường dẫn ảnh..." value="<?php echo $item['slide_image_2']; ?>" />
                            </div>
                            <div class="col-2">
                              <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-upload" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Mô tả</label>
                          <textarea name="home_slide[slide_desc][]" class="form-control" placeholder="Mô tả slide..."><?php echo $item['slide_desc']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Ảnh nền</label>
                          <div class="row ckfinder-group">
                            <div class="col-10">
                              <input type="text" class="form-control image-render" name="home_slide[slide_bg][]" placeholder="Đường dẫn ảnh..." value="<?php echo $item['slide_bg']; ?>" />
                            </div>
                            <div class="col-2">
                              <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-upload" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-1">
                    <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a>
                  </div>
                </div>
              </div><!--End .slide-item-->
        <?php
            }
          }
        }
        ?>
      </div><!-- End slide--wrapper -->
      <p><button type="button" class="btn btn-warning btn-sm add-slide">Thêm slide</button></p>
      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
  </div>
</section>

<?php
layout('footer', 'admin', $data);
