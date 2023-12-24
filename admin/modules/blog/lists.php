<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách blog'
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

        $filter .= " $operator (title LIKE '%$keyword%' OR content LIKE '%$keyword%')";
    }

    //Xử lý lọc theo user
    if (!empty($body['user_id'])) {
        $userId = $body['user_id'];

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= " $operator blog.user_id=$userId";
    }

    //Xử lý lọc theo chuyên mục
    if (!empty($body['cate_id'])) {
        $cateId = $body['cate_id'];

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= " $operator blog.category_id=$cateId";
    }
}

//Xử lý phân blog

//1. Lấy số lượng bản ghi blog
$allBlogNum = getRows("SELECT id FROM blog $filter");

//2. Số lượng bản ghi trên 1 blog
$perPage = _PER_PAGE; //Mỗi blog có 3 bản ghi

//3. Tính số blog
$maxPage = ceil($allBlogNum / $perPage); //Làm tròn lên

//4. Xử lý số blog dựa vào phương thức GET
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

//Xử lý query string tìm kiếm với phân blog
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=blog', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&' . $queryString;
}

//Lấy dữ liệu blog
$listBlog = getRaw("SELECT blog.id, title, blog.create_at, fullname, users.id as user_id, view_count, blog_categories.name as cate_name, category_id FROM blog INNER JOIN users ON blog.user_id=users.id INNER JOIN blog_categories ON blog.category_id=blog_categories.id $filter ORDER BY blog.create_at DESC LIMIT $offset, $perPage");

//Lấy dữ liệu tất cả người dùng
$allUsers = getRaw("SELECT id, fullname, email FROM users ORDER BY fullname");

//Lấy dữ liệu tất cả chuyên mục
$allCategories = getRaw("SELECT id, name FROM blog_categories ORDER BY name");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <a href="<?php echo getLinkAdmin('blog', 'add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm blog</a>
        <hr>
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
                    <select class="form-control" name="cate_id" id="">
                        <option value="0">Chọn chuyên mục</option>
                        <?php
                        if (!empty($allCategories)) {
                            foreach ($allCategories as $item) {
                        ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo (!empty($cateId) && $cateId == $item['id']) ? 'selected' : false; ?>><?php echo $item['name']; ?></option>
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
            <input type="hidden" name="module" value="blog" />
        </form>
        <hr>
        <?php
        getMsg($msg, $msgType);
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tiêu đề</th>
                    <th width="15%">Chuyên mục</th>
                    <th width="15%">Đăng bởi</th>
                    <th width="10%">Thời gian</th>

                    <th width="10%">Sửa</th>
                    <th width="10%">Xoá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($listBlog)) :
                    foreach ($listBlog as $key => $item) :
                ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>

                            <td><a href="<?php echo getLinkAdmin('blog', 'edit', ['id' => $item['id']]); ?>">
                                    <?php echo $item['title']; ?></a><br />
                                <a href="<?php echo getLinkAdmin('blog', 'duplicate', ['id' => $item['id']]); ?>" style="padding: 0 5px;" class="btn btn-danger btn-sm">Nhân bản</a>
                                <span class="btn btn-success btn-sm" style="padding: 0 5px;"><?php echo $item['view_count']; ?> lượt xem</span>
                                <a href="#" class="btn btn-primary btn-sm" style="padding: 0 5px;" target="_blank">Xem</a>
                            </td>
                            <td>
                                <a href="?<?php echo getLinkQueryString('cate_id', $item['category_id']); ?>"><?php echo $item['cate_name']; ?></a>
                            </td>
                            <td>
                                <a href="?<?php echo getLinkQueryString('user_id', $item['user_id']); ?>"><?php echo $item['fullname']; ?></a>
                            </td>
                            <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s'); ?></td>

                            <td class="text-center"><a href="<?php echo getLinkAdmin('blog', 'edit', ['id' => $item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                            <td class="text-center"><a href="<?php echo getLinkAdmin('blog', 'delete', ['id' => $item['id']]); ?>" id="delete_sweet_alert2" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a></td>
                        </tr>
                    <?php
                    endforeach;
                else :
                    ?>
                    <tr>
                        <td colspan="8" class="alert alert-danger text-center">Không có blog</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
            <ul class="pagination pagination-sm">
                <?php
                if ($page > 1) {
                    $prevPage = $page - 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blog' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                    <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=blog' . $queryString . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
                <?php } ?>
                <?php
                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blog' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>

            </ul>
        </nav>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
