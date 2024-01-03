<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Danh sách phòng ban'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


//Xử lý lọc dữ liệu

$filter = '';

$view = 'add'; //Mặc định

$id = 0; //id mặc định

$body = getBody('get');

if (isset($body['keyword'])) {
  $keyword = $body['keyword'];
}

if (!empty($keyword)) {
  $filter = "WHERE name LIKE '%$keyword%'";
}

if (!empty($body['view'])) {
  $view = $body['view'];
}

if (!empty($body['id'])) {
  $id = $body['id'];
}

//Xử lý phân trang

//1. Lấy số lượng bản ghi danh sách phòng ban
$allContactTypeNum = getRows("SELECT id FROM contact_type $filter");

//2. Số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; //Mỗi trang có 3 bản ghi

//3. Tính số trang
$maxPage = ceil($allContactTypeNum / $perPage); //Làm tròn lên

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
  $queryString = str_replace('module=contact_type', '', $queryString);
  $queryString = str_replace('&page=' . $page, '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy dữ liệu nhóm ngưòi dùng
$listContactType = getRaw("SELECT *, (SELECT count(contacts.id) FROM contacts WHERE contacts.type_id=contact_type.id) as contact_count FROM contact_type $filter ORDER BY create_at DESC LIMIT $offset, $perPage");

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
        <?php
        if (!empty($view) && !empty($id)) {
          require_once $view . '.php';
        } else {
          require_once 'add.php';
        }
        ?>
      </div>
      <div class="col-6">
        <h4>Danh sách phòng ban</h4>
        <form action="" method="get">
          <div class="row">
            <div class="col-9">
              <input type="search" name="keyword" class="form-control" placeholder="Nhập tên phòng ban..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>" />
            </div>
            <div class="col-3">
              <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
            </div>
          </div>
          <input type="hidden" name="module" value="contact_type" />
        </form>
        <hr>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">STT</th>
              <th>Tên</th>
              <th width="20%">Thời gian</th>
              <th width="10%">Sửa</th>
              <th width="10%">Xoá</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($listContactType)) :
              foreach ($listContactType as $key => $item) :
            ?>
                <tr>
                  <td><?php echo ($key + 1); ?></td>
                  <td><a href="<?php echo getLinkAdmin('contact_type', '', ['id' => $item['id'], 'view' => 'edit']); ?>"><?php echo $item['name']; ?></a> (<?php echo $item['contact_count']; ?>)<br /><a href="<?php echo getLinkAdmin('contact_type', 'duplicate', ['id' => $item['id']]); ?>" style="padding: 0 5px;" class="btn btn-danger btn-sm">Nhân bản</a></td>
                  <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : ''; ?></td>
                  <td><a href="<?php echo getLinkAdmin('contact_type', '', ['id' => $item['id'], 'view' => 'edit']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                  <td>
                    <a href="<?php echo getLinkAdmin('contact_type', 'delete', ['id' => $item['id']]); ?>" class="btn btn-danger btn-sm" id="delete_sweet_alert2"><i class=" fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php
              endforeach;
            else :
              ?>
              <tr>
                <td colspan="5" class="alert alert-danger text-center">Không có danh sách phòng ban</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
          <ul class="pagination pagination-sm">
            <?php
            if ($page > 1) {
              $prevPage = $page - 1;
              echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contact_type' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
              <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=contact_type' . $queryString . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
            <?php } ?>
            <?php
            if ($page < $maxPage) {
              $nextPage = $page + 1;
              echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contact_type' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
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
