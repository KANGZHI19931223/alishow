<?php 
header('content-type:text/html;charset=utf-8');
include_once '../include/checksession.php';
// 1\ 接收前端提交的数据

$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$password = md5($_POST['password']);
$state = $_POST['state'];
$time = time();
// $email = 'aa';
// $slug = 'aa';
// $nickname = 'aa';
// $password = '123';
// $state = '禁用';

// 2\ 链接数据库
include_once '../include/mysql.php';
$sql = "insert into ali_admin (admin_id, admin_email, admin_slug, admin_nickname, admin_pwd, admin_state, admin_addtime) values(null, '$email', '$slug', '$nickname', '$password', '$state', '$time') ";
$result_bool = mysqli_query($conn, $sql);
if ($result_bool) {
	echo 1;
} else {
	echo 2;
}
mysqli_close($conn);
?>