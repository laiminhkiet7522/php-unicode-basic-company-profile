<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Danh sách liên hệ'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


//Xử lý lọc dữ liệu

$filter = '';

if (isGet()) {
  $body = getBody();

  //Xử lý lọc status
  if (!empty($body['status'])) {
    $status = $body['status'];

    if ($status == 2) {
      $statusSql = 0;
    } else {
      $statusSql = $status;
    }

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= "$operator status=$statusSql";
  }

  //Xử lý lọc theo từ khoá
  if (!empty($body['keyword'])) {
    $keyword = $body['keyword'];

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= " $operator (fullname LIKE '%$keyword%' OR message LIKE '%$keyword%')";
  }

  //Xử lý lọc theo phòng ban
  if (!empty($body['type_id'])) {
    $typeId = $body['type_id'];

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= " $operator contacts.type_id=$typeId";
  }
}

//Xử lý phân contacts

//1. Lấy số lượng bản ghi contacts
$allContactNum = getRows("SELECT id FROM contacts $filter");

//2. Số lượng bản ghi trên 1 contacts
$perPage = _PER_PAGE; //Mỗi contacts có 3 bản ghi

//3. Tính số contacts
$maxPage = ceil($allContactNum / $perPage); //Làm tròn lên

//4. Xử lý số contacts dựa vào phương thức GET
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

//Xử lý query string tìm kiếm với phân contacts
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
  $queryString = $_SERVER['QUERY_STRING'];
  $queryString = str_replace('module=contacts', '', $queryString);
  $queryString = str_replace('&page=' . $page, '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy dữ liệu contacts
$listContacts = getRaw("SELECT contacts.id, fullname, contacts.create_at, email, message, status, note, contact_type.name as type_name, contacts.type_id FROM contacts INNER JOIN contact_type ON contacts.type_id=contact_type.id $filter ORDER BY contacts.create_at DESC LIMIT $offset, $perPage");

//Lấy dữ liệu tất cả phòng ban
$allContactType = getRaw("SELECT id, name FROM contact_type ORDER BY name");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <form action="" method="get">
      <div class="row">
        <div class="col-3">
          <div class="form-group">
            <select name="status" class="form-control">
              <option value="0">Chọn trạng thái</option>
              <option value="1" <?php echo (!empty($status) && $status == 1) ? 'selected' : false; ?>>Đã xử lý</option>
              <option value="2" <?php echo (!empty($status) && $status == 2) ? 'selected' : false; ?>>Chưa xử lý</option>
            </select>
          </div>
        </div>
        <div class="col-3">
          <select class="form-control" name="type_id">
            <option value="0">Chọn phòng ban</option>
            <?php
            if (!empty($allContactType)) {
              foreach ($allContactType as $item) {
            ?>
                <option value="<?php echo $item['id']; ?>" <?php echo (!empty($typeId) && $typeId == $item['id']) ? 'selected' : false; ?>><?php echo $item['name']; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="col-3">
          <input type="search" name="keyword" class="form-control" placeholder="Nhập từ khoá tìm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>" />
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
        </div>
      </div>
      <input type="hidden" name="module" value="contacts" />
    </form>
    <hr>
    <?php
    getMsg($msg, $msgType);
    ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="5%">STT</th>
          <th width="20%">Thông tin</th>
          <th>Nội dung</th>
          <th width="10%">Trạng thái</th>
          <th>Ghi chú</th>
          <th width="10%">Thời gian</th>
          <th width="10%">Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($listContacts)) :
          foreach ($listContacts as $key => $item) :
        ?>
            <tr>
              <td><?php echo $key + 1; ?></td>

              <td>
                Họ tên: <?php echo $item['fullname']; ?><br />
                Email: <?php echo $item['email']; ?><br />
                Phòng ban: <?php echo $item['type_name']; ?>
              </td>

              <td>
                <?php echo $item['message']; ?>
              </td>

              <td><?php echo $item['status'] == 1 ? '<button type="button" class="btn btn-success btn-sm">Đã xử lý</button>' : '<button type="button" class="btn btn-warning btn-sm">Chưa xử lý</button>'; ?></td>

              <td>
                <?php echo $item['note']; ?>
              </td>

              <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s'); ?></td>

              <td class="text-center">
                <a href="<?php echo getLinkAdmin('contacts', 'edit', ['id' => $item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a><br /><br />
                <a href="<?php echo getLinkAdmin('contacts', 'delete', ['id' => $item['id']]); ?>" id="delete_sweet_alert2" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
              </td>

            </tr>
          <?php
          endforeach;
        else :
          ?>
          <tr>
            <td colspan="8" class="alert alert-danger text-center">Không có liên hệ</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
      <ul class="pagination pagination-sm">
        <?php
        if ($page > 1) {
          $prevPage = $page - 1;
          echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
          <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
        <?php } ?>
        <?php
        if ($page < $maxPage) {
          $nextPage = $page + 1;
          echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
        }
        ?>

      </ul>
    </nav>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
