<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Danh mục dự án'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


//Xử lý lọc dữ liệu

$filter = '';

if (isGet()) {
  $body = getBody();

  if (isset($body['keyword'])) {
    $keyword = $body['keyword'];
  }

  if (!empty($keyword)) {
    $filter = "WHERE name LIKE '%$keyword%'";
  }
}

//Xử lý phân trang

//1. Lấy số lượng bản ghi danh mục dự án
$allPagesNum = getRows("SELECT id FROM `portfolio_categories` $filter");

//2. Số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; //Mỗi trang có 3 bản ghi

//3. Tính số trang
$maxPage = ceil($allPagesNum / $perPage); //Làm tròn lên

//4. Xử lý số trang dựa vào phương thức GET
if (!empty(getBody()['page'])) {
  $page = getBody()['page'];
  if ($page < 1 || $page > $maxPage) {
    $page = 1;
  }
} else {
  $page = 1;
}

//5. Tính toán offset trong Limit dựa vào biến $page
$offset = ($page - 1) * $perPage;

//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
  $queryString = $_SERVER['QUERY_STRING'];
  $queryString = str_replace('module=portfolio_categories', '', $queryString);
  $queryString = str_replace('&page=' . $page, '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy dữ liệu nhóm ngưòi dùng
$listCate = getRaw("SELECT * FROM `portfolio_categories` $filter ORDER BY create_at DESC LIMIT $offset, $perPage");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msgType);
    ?>
    <div class="row">
      <div class="col-6">
        <?php require_once('add.php'); ?>
      </div>
      <div class="col-6">
        <h4>Danh sách danh mục</h4>
        <form action="" method="get">
          <div class="row">
            <div class="col-9">
              <input type="search" name="keyword" class="form-control" placeholder="Nhập tên danh mục..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>" />
            </div>
            <div class="col-3">
              <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
            </div>
          </div>
          <input type="hidden" name="module" value="portfolio_categories" />
        </form>
        <hr>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">STT</th>
              <th>Tên</th>
              <th width="15%">Thời gian</th>
              <th width="10%">Sửa</th>
              <th width="10%">Xoá</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($listCate)) :
              foreach ($listCate as $key => $item) :
            ?>
                <tr>
                  <td><?php echo $key + 1; ?></td>
                  <td><a href="<?php echo getLinkAdmin('portfolio_categories', 'edit', ['id' => $item['id']]); ?>"><?php echo $item['name']; ?></a></td>
                  <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s'); ?></td>
                  <td class="text-center"><a href="<?php echo getLinkAdmin('portfolio_categories', 'edit', ['id' => $item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                  <td class="text-center"><a href="<?php echo getLinkAdmin('portfolio_categories', 'delete', ['id' => $item['id']]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                </tr>
              <?php
              endforeach;
            else :
              ?>
              <tr>
                <td colspan="5" class="text-center">Không có danh mục dự án</td>
              </tr>
            <?php
            endif;
            ?>
          </tbody>
        </table>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
          <ul class="pagination pagination-sm">
            <?php
            if ($page > 1) {
              $prevPage = $page - 1;
              echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolio_categories' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
            }
            ?>
            <?php
            $begin = $page - 2;
            if ($begin < 1) {
              $begin = 1;
            }
            $end = $page + 2;
            if ($end > $maxPage) {
              $end = $maxPage;
            }
            for ($index = $begin; $index <= $end; $index++) { ?>
              <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=portfolio_categories' . $queryString . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
            <?php } ?>
            <?php
            if ($page < $maxPage) {
              $nextPage = $page + 1;
              echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolio_categories' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
            }
            ?>

          </ul>
        </nav>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
