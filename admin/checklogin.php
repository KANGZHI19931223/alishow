<?php 
// 1\ 接收前端发送过来的数据
$email = $_POST['email'];
$pwd = md5($_POST['pwd']);
// 2\ 链接数据库 
include_once './include/mysql.php';
$sql = "select * from ali_admin where admin_email = '$email' ";
// 执行sql语句
$result_obj = mysqli_query($conn, $sql);
$inf = mysqli_fetch_assoc($result_obj);
// 3\ 判断是够存在该用户
if (empty($inf)) {
	echo 1; // 用户名错误
} else {
	if ($pwd == $inf['admin_pwd']) {
		echo 2; // 成功
		// 记录session
		session_start();
		$_SESSION['id'] = $inf['admin_id'];
		$_SESSION['email'] = $inf['admin_email'];
		$_SESSION['nickname'] = $inf['admin_nickname'];
	} else {
		echo 3; // 密码错误
	}
}
?>