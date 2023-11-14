<?php
if (!defined('_INCODE')) die('Access Deined...');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function layout($layoutName = 'header', $dir = '', $data = [])
{

    if (!empty($dir)) {
        $dir = '/' . $dir;
    }

    if (file_exists(_WEB_PATH_TEMPLATE . $dir . '/layouts/' . $layoutName . '.php')) {
        require_once _WEB_PATH_TEMPLATE . $dir . '/layouts/' . $layoutName . '.php';
    }
}

function sendMail($to, $subject, $content)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'kietminh070502@gmail.com';                     //SMTP username
        $mail->Password   = 'pyfogqbjgpfzvxlo';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP

        //Recipients
        $mail->setFrom('kietminh070502@gmail.com', 'Unicode Training');
        $mail->addAddress($to);     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML

        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        return $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//Kiểm tra phương thức POST
function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }

    return false;
}

//Kiểm tra phương thức GET
function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }

    return false;
}

//Lấy giá trị phương thức POST, GET
function getBody($method = '')
{

    $bodyArr = [];

    if (empty($method)) {
        if (isGet()) {
            //Xử lý chuỗi trước khi hiển thị ra
            //return $_GET;
            /*
             * Đọc key của mảng $_GET
             *
             * */
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if (isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
    } else {
        if ($method == 'get') {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        } else {
            if ($method == 'post') {
                if (!empty($_POST)) {
                    foreach ($_POST as $key => $value) {
                        $key = strip_tags($key);
                        if (is_array($value)) {
                            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        } else {
                            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
                }
            }
        }
    }

    return $bodyArr;
}

//Kiểm tra email
function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

//Kiểm tra số nguyên
function isNumberInt($number, $range = [])
{
    /*
     * $range = ['min_range'=>1, 'max_range'=>20];
     *
     * */
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    }

    return $checkNumber;
}

//Kiểm tra số thực
function isNumberFloat($number, $range = [])
{
    /*
     * $range = ['min_range'=>1, 'max_range'=>20];
     *
     * */
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    }

    return $checkNumber;
}

//Kiểm tra số điện thoại (0123456789 - Bắt đầu bằng số 0, nối tiếp là 9 số)
function isPhone($phone)
{

    $checkFirstZero = false;

    if ($phone[0] == '0') {
        $checkFirstZero = true;
        $phone = substr($phone, 1);
    }

    $checkNumberLast = false;

    if (isNumberInt($phone) && strlen($phone) == 9) {
        $checkNumberLast = true;
    }

    if ($checkFirstZero && $checkNumberLast) {
        return true;
    }

    return false;
}

//Hàm tạo thông báo
function getMsg($msg, $type = 'success')
{
    if (!empty($msg)) {
        echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
        echo  '<strong>';
        echo $msg;
        echo '</strong>';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
    }
}

//Hàm chuyển hướng
function redirect($path = 'index.php')
{
    $url = _WEB_HOST_ROOT . '/' . $path;
    header("Location: $url");
    exit;
}

//Hàm thông báo lỗi
function form_error($fieldName, $errors, $beforeHtml = '', $afterHtml = '')
{
    return (!empty($errors[$fieldName])) ? $beforeHtml . reset($errors[$fieldName]) . $afterHtml : null;
}

//Hàm hiển thị dữ liệu cũ
function old($fieldName, $oldData, $default = null)
{
    return (!empty($oldData[$fieldName])) ? $oldData[$fieldName] : $default;
}

//Kiểm tra trạng thái đăng nhập
function isLogin()
{
    $checkLogin = false;
    if (getSession('loginToken')) {
        $tokenLogin = getSession('loginToken');

        $queryToken = firstRaw("SELECT user_id FROM login_token WHERE token='$tokenLogin'");

        if (!empty($queryToken)) {
            //$checkLogin = true;
            $checkLogin = $queryToken;
        } else {
            removeSession('loginToken');
        }
    }

    return $checkLogin;
}

//Tự động xoá token login đếu đăng xuất
function autoRemoveTokenLogin()
{
    $allUsers = getRaw("SELECT * FROM users WHERE status=1");

    if (!empty($allUsers)) {
        foreach ($allUsers as $user) {
            $now = date('Y-m-d H:i:s');

            $before = $user['last_activity'];

            $diff = strtotime($now) - strtotime($before);
            $diff = floor($diff / 60);

            if ($diff >= 15) {
                delete('login_token', "user_id=" . $user['id']);
            }
        }
    }
}

//Lưu lại thời gian cuối cùng hoạt động
function saveActivity()
{
    $user_id = isLogin()['user_id'];
    update('users', ['last_activity' => date('Y-m-d H:i:s')], "id=$user_id");
}

//Lấy thông tin user
function getUserInfo($user_id)
{
    $info = firstRaw("SELECT * FROM users WHERE id=$user_id");
    return $info;
}

//Action menu sidebar
function activeMenuSidebar($module = '')
{
    if (!empty(getBody()['module'])) {
        if (getBody()['module'] == $module) {
            return true;
        }
    }
    return false;
}

//Get Link Admin
function getLinkAdmin($module, $action = '', $params = [])
{
    $url = _WEB_HOST_ROOT_ADMIN;
    $url = $url . '/?module=' . $module;
    if (!empty($action)) {
        $url = $url . '&action=' . $action;
    }
    /*
    params = ['id'=>1,'keyword'=>'unicode']
    => paramsString (id=1&keyword=unicode)
    */
    if (!empty($params)) {
        $paramsString = http_build_query($params);
        $url = $url . '&' . $paramsString;
    }
    return $url;
}

//Format date
function getDateFormat($strDate, $format)
{
    $dateObject = date_create($strDate);
    if (!empty($dateObject)) {
        return date_format($dateObject, $format);
    }
    return false;
}
