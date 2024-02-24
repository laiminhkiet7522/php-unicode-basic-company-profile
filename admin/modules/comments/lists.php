<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'pageTitle' => 'Danh sách bình luận'
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

    $filter .= " $operator comments.status=$statusSql";
  }

  //Xử lý lọc theo từ khoá
  if (!empty($body['keyword'])) {
    $keyword = $body['keyword'];

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= " $operator comments.name LIKE '%$keyword%' OR comments.content LIKE '%$keyword%' OR comments.email LIKE '%$keyword%' OR comments.website LIKE '%$keyword%'";
  }

  //Xử lý lọc theo user
  if (!empty($body['user_id'])) {
    $userId = $body['user_id'];

    if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

      $operator = 'AND';
    } else {
      $operator = 'WHERE';
    }

    $filter .= " $operator comments.user_id=$userId";
  }
}

//Xử lý phân trang

//1. Lấy số lượng bản ghi trang
$allComments = getRows("SELECT id FROM comments $filter");

//2. Số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; //Mỗi trang có 3 bản ghi

//3. Tính số trang
$maxPage = ceil($allComments / $perPage); //Làm tròn lên

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
  $queryString = str_replace('module=comments', '', $queryString);
  $queryString = str_replace('&page=' . $page, '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy dữ liệu bình luận
$listComments = getRaw("SELECT comments.*, blog.title, users.fullname, users.email as user_email FROM comments INNER JOIN blog ON comments.blog_id = blog.id LEFT JOIN users ON comments.user_id=users.id $filter ORDER BY comments.create_at DESC LIMIT $offset, $perPage");

//Lấy dữ liệu tất cả người dùng
$allUsers = getRaw("SELECT id, fullname, email FROM users ORDER BY fullname");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <form action="" method="get">
      <div class="row">
        <div class="col-3">
          <select class="form-control" name="user_id" id="">
            <option value="0">Chọn người đăng</option>
            <?php
            if (!empty($allUsers)) {
              foreach ($allUsers as $item) {
            ?>
                <option value="<?php echo $item['id']; ?>" <?php echo (!empty($userId) && $userId == $item['id']) ? 'selected' : false; ?>><?php echo $item['fullname'] . ' (' . $item['email'] . ')'; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="col-3">
          <div class="form-group">
            <select name="status" class="form-control">
              <option value="0">Chọn trạng thái</option>
              <option value="1" <?php echo (!empty($status) && $status == 1) ? 'selected' : false; ?>>Đã duyệt</option>
              <option value="2" <?php echo (!empty($status) && $status == 2) ? 'selected' : false; ?>>Chưa duyệt</option>
            </select>
          </div>
        </div>
        <div class="col-4">
          <input type="search" name="keyword" class="form-control" placeholder="Từ khóa tiềm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>" />
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
        </div>
      </div>
      <input type="hidden" name="module" value="comments" />
    </form>
    <hr>
    <?php
    getMsg($msg, $msgType);
    ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="5%">STT</th>
          <th>Thông tin</th>
          <th width="30%">Nội dung</th>
          <th width="10%">Trạng thái</th>
          <th width="10%">Thời gian</th>
          <th width="10%">Bài viết</th>
          <th width="10%">Xoá</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($listComments)) :
          foreach ($listComments as $key => $item) :
            if (!empty($item['user_id'])) {
              $item['name'] = $item['fullname'];
              $item['email'] = $item['user_email'];
              $commentLists[$key] = $item;
            }
        ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td>
                - Name: <?php echo $item['name']; ?><br>
                - Email: <?php echo $item['email']; ?><br>
                <?php
                if (!empty($item['website'])) {
                  echo '- Website: ' . $item['website'] . '<br>';
                }
                ?>
                <?php
                if ($item['parent_id'] == 0) {
                  echo '- Loại bình luận: Viết mới' . '<br>';
                } else {
                  $commentData = getComment($item['parent_id']);
                  if (!empty($commentData['name'])) {
                    echo '- Loại Bình luận: Hồi đáp' . '<br>';
                    echo '- Trả lời: ' . $commentData['name'];
                  }
                }
                ?>
              </td>
              <td><?php echo truncateText($item['content'], 100); ?></td>
              <td><?php echo $item['status'] == 1 ? '<span class="badge badge-success">Đã duyệt</span>' : '<span class="badge badge-info">Chưa duyệt</span>'; ?>
                <?php
                echo '<br>';
                if ($item['status'] == 0) {
                  echo '<a href="' . _WEB_HOST_ROOT_ADMIN . '/?module=comments&action=status&id=' . $item['id'] . '&status=1" class="text-success">Duyệt</a>';
                } else {
                  echo '<a href="' . _WEB_HOST_ROOT_ADMIN . '/?module=comments&action=status&id=' . $item['id'] . '&status=0" class="text-danger">Bỏ duyệt</a>';
                }
                ?>
              </td>
              <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s') ?></td>
              <td class="text-center"><a target="_blank" href="<?php echo getLinkModule('blog', $item['blog_id']) ?>"><?php echo truncateText($item['title'], 25); ?></a></td>
              <td class="text-center"><a href="<?php echo getLinkAdmin('comments', 'delete', ['id' => $item['id']]); ?>" id="delete_sweet_alert2" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a></td>
            </tr>
          <?php
          endforeach;
        else :
          ?>
          <tr>
            <td colspan="7" class="alert alert-danger text-center">Không có bình luận</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
      <ul class="pagination pagination-sm">
        <?php
        if ($page > 1) {
          $prevPage = $page - 1;
          echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
          <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
        <?php } ?>
        <?php
        if ($page < $maxPage) {
          $nextPage = $page + 1;
          echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
        }
        ?>

      </ul>
    </nav>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
