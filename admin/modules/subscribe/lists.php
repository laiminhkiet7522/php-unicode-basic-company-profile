<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Danh sách đăng ký nhận tin'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


//Xử lý lọc dữ liệu

$filter = '';

if (isGet()) {
  $body = getBody();

  //Xử lý lọc theo từ khoá
  if (!empty($body['keyword'])) {
    $keyword = $body['keyword'];

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= " $operator fullname LIKE '%$keyword%' OR email LIKE '%$keyword%';";
  }
}

//Xử lý phân trang

//1. Lấy số lượng bản ghi trang
$allSubscribeNum = getRows("SELECT id FROM subscribe $filter");

//2. Số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; //Mỗi trang có 3 bản ghi

//3. Tính số trang
$maxPage = ceil($allSubscribeNum / $perPage); //Làm tròn lên

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
  $queryString = str_replace('module=subscribe', '', $queryString);
  $queryString = str_replace('&page=' . $page, '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy dữ liệu người đăng ký nhận tin
$listSubscribe = getRaw("SELECT * FROM subscribe $filter ORDER BY create_at DESC LIMIT $offset, $perPage");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <form action="" method="get">
      <div class="row">
        <div class="col-9">
          <input type="search" name="keyword" class="form-control" placeholder="Nhập từ khóa..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>" />
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
        </div>
      </div>
      <input type="hidden" name="module" value="subscribe" />
    </form>
    <hr>
    <?php
    getMsg($msg, $msgType);
    ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="5%">STT</th>
          <th width="15%">Tên</th>
          <th width="15%">Email</th>
          <th width="10%">Thời gian</th>
          <th width="10%">Trạng thái</th>
          <th width="10%">Sửa</th>
          <th width="10%">Xoá</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($listSubscribe)) :
          foreach ($listSubscribe as $key => $item) :
        ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $item['fullname']; ?></td>
              <td><?php echo $item['email']; ?></td>
              <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s'); ?></td>
              <td class="text-center"><?php echo $item['status'] == 1 ? '<button type="button" class="btn btn-success btn-sm">Đã xử lý</button>' : '<button type="button" class="btn btn-info btn-sm">Chưa xử lý</button>'; ?></td>
              <td class="text-center"><a href="<?php echo getLinkAdmin('subscribe', 'edit', ['id' => $item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
              <td class="text-center"><a href="<?php echo getLinkAdmin('subscribe', 'delete', ['id' => $item['id']]); ?>" id="delete_sweet_alert2" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a></td>
            </tr>
          <?php
          endforeach;
        else :
          ?>
          <tr>
            <td colspan="7" class="alert alert-danger text-center">Không có người đăng ký nhận tin</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
      <ul class="pagination pagination-sm">
        <?php
        if ($page > 1) {
          $prevPage = $page - 1;
          echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
          <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
        <?php } ?>
        <?php
        if ($page < $maxPage) {
          $nextPage = $page + 1;
          echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
        }
        ?>

      </ul>
    </nav>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
