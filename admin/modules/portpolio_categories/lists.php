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

//1. Lấy số lượng bản ghi nhóm người dùng
$allGroupsNum = getRows("SELECT id FROM `groups` $filter");

//2. Số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; //Mỗi trang có 3 bản ghi

//3. Tính số trang
$maxPage = ceil($allGroupsNum / $perPage); //Làm tròn lên

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
  $queryString = str_replace('module=groups', '', $queryString);
  $queryString = str_replace('&page=' . $page, '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy dữ liệu nhóm ngưòi dùng
$listGroups = getRaw("SELECT * FROM `groups` $filter ORDER BY create_at DESC LIMIT $offset, $perPage");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <h4>Thêm danh mục</h4>
        <form action="" method="post">
          <div class="form-group">
            <label for="">Tên danh mục</label>
            <input type="text" name="name" class="form-control" placeholder="Tên danh mục...">
          </div>
          <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
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
          <input type="hidden" name="module" value="portpolio_categories" />
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
            <tr>
              <td>wdww</td>
              <td>đ</td>
              <td>ádsad</td>
              <td class="text-center"><a href="<?php echo getLinkAdmin('portpolio_categories', 'edit', ['id' => 1]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
              <td class="text-center"><a href="<?php echo getLinkAdmin('portpolio_categories', 'delete', ['id' => 1]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
