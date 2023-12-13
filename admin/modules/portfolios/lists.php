<?php
if (!defined('_INCODE')) die('Access Deined...');
/*
 * File này hiển thị danh sách dự án
 * */

$data = [
  'pageTitle' => 'Quản lý dự án'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$UserId = isLogin()['user_id']; //Lấy PortfolioId đang đăng nhập

//Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
  $body = getBody();

  //Xử lý lọc theo người dùng
  if (!empty($body['user_id'])) {
    $userId = $body['user_id'];

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= "$operator portfolios.user_id=$userId";
  }

  //Xử lý lọc theo từ khoá
  if (!empty($body['keyword'])) {
    $keyword = $body['keyword'];

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= " $operator portfolios.name LIKE '%$keyword%'";
  }

  //Xử lý lọc theo group
  if (!empty($body['cate_id'])) {
    $CateId = $body['cate_id'];

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= " $operator portfolio_category_id =$CateId";
  }
}


//Xử lý phân trang

$allPortfolioNum = getRows("SELECT id FROM portfolios $filter");

//1. Xác định được số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; //Mỗi trang có 3 bản ghi

//2. Tính số trang
$maxPage = ceil($allPortfolioNum / $perPage);

//3. Xử lý số trang dựa vào phương thức GET
if (!empty(getBody()['page'])) {
  $page = getBody()['page'];
  if ($page < 1 || $page > $maxPage) {
    $page = 1;
  }
} else {
  $page = 1;
}

//4. Tính toán offset trong Limit dựa vào biến $page
/*
 * $page = 1 => offset = 0 = ($page-1)*$perPage = (1-1)*3 = 0
 * $page = 2 => offset = 3 = ($page-1)*$perPage = (2-1)*3 = 3
 * $page = 3 => offset = 6 = ($page-1)*$perPage = (3-1)*3 = 6
 *
 * */
$offset = ($page - 1) * $perPage;

//Truy vấn lấy tất cả bản ghi
$listAllPortfolio = getRaw("SELECT portfolios.id, portfolios.name, portfolios.create_at, portfolio_categories.name as cate_name, users.fullname FROM portfolios INNER JOIN `portfolio_categories` ON portfolios.portfolio_category_id=`portfolio_categories`.id INNER JOIN users ON portfolios.user_id=users.id $filter ORDER BY portfolios.create_at DESC LIMIT $offset, $perPage");

//Truy vấn lấy danh sách danh mục
$allportfolio_categories = getRaw("SELECT id, name FROM `portfolio_categories` ORDER BY name");

//Truy vấn lấy danh sách người dùng
$allUsers = getRaw("SELECT * FROM users ORDER BY fullname");

//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
  $queryString = $_SERVER['QUERY_STRING'];
  $queryString = str_replace('module=portfolios', '', $queryString);
  $queryString = str_replace('&page=' . $page, '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <a href="<?php echo getLinkAdmin('portfolios', 'add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm dự án</a>
    <hr>
    <form action="" method="get">
      <div class="row">
        <div class="col-3">
          <div class="form-group">
            <select name="user_id" class="form-control">
              <option value="0">Chọn người đăng</option>
              <?php
              if (!empty($allUsers)) :
                foreach ($allUsers as $item) :
              ?>
                  <option value="<?php echo $item['id'] ?>" <?php echo (!empty($userId) && $userId == $item['id']) ? 'selected' : false; ?>><?php echo $item['fullname'] . ' (' . $item['email'] . ')'; ?></option>
              <?php
                endforeach;
              endif;
              ?>
            </select>
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <select name="cate_id" class="form-control">
              <option value="0">Chọn danh mục</option>
              <?php
              if (!empty($allportfolio_categories)) {
                foreach ($allportfolio_categories as $item) {
              ?>
                  <option value="<?php echo $item['id']; ?>" <?php echo (!empty($CateId) && $CateId == $item['id']) ? 'selected' : false; ?>><?php echo $item['name']; ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-4">
          <input type="search" class="form-control" name="keyword" placeholder="Từ khoá tìm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
        </div>
      </div>
      <input type="hidden" name="module" value="portfolios">
    </form>
    <?php
    getMsg($msg, $msgType);
    ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="5%">STT</th>
          <th>Tên</th>
          <th>Danh mục</th>
          <th>Đăng bởi</th>
          <th width="15%">Thời gian</th>
          <th width="10%">Sửa</th>
          <th width="10%">Xoá</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($listAllPortfolio)) :
          $count = 0; //Hiển thị số thứ tự
          foreach ($listAllPortfolio as $item) :
            $count++;
        ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $item['id']]); ?>"><?php echo $item['name']; ?></a></td>
              <td><a href="£"><?php echo $item['cate_name']; ?></a></td>
              <td><a href="£"><?php echo $item['fullname']; ?></a></td>
              <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
              <td><a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
              <td>
                <?php if ($item['id'] != $UserId) : ?>
                  <a href="<?php echo getLinkAdmin('portfolios', 'delete', ['id' => $item['id']]); ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach;
        else : ?>
          <tr>
            <td colspan="8">
              <div class="alert alert-danger text-center">Không có dự án</div>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
      <ul class="pagination pagination-sm">
        <?php
        if ($page > 1) {
          $prevPage = $page - 1;
          echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?module=portfolios' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
          <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT . '?module=portfolios' . $queryString . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
        <?php } ?>
        <?php
        if ($page < $maxPage) {
          $nextPage = $page + 1;
          echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?module=portfolios' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
        }
        ?>

      </ul>
    </nav>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer', 'admin', $data);
