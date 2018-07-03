<?php 
// 1\ 接收前端传送的数据
$old_pwd = md5($_POST['old_pwd']);
$new_pwd = $_POST['new_pwd'];
$re_pwd = $_POST['re_pwd'];
// 2\ 使用session获取id 查找数据表中对应的数据
session_start();
$id = $_SESSION['id'];

include_once './include/mysql.php';
$sql = "select * from ali_admin where admin_id = $id";

$result = mysqli_query($conn, $sql);
$inf = mysqli_fetch_assoc($result);
$admin_pwd = $inf['admin_pwd'];
// 3\ 将前端提交的旧密码与查询到的密码进行对比
if ($old_pwd == $admin_pwd) {
	// 4\ 旧密码输入正确时 , 先对比两次输入的新密码是否一致
	if ($new_pwd == $re_pwd) {
		// 5\ 两次输入一致时, 将新密码更新到数据表中
		$pwd = md5($new_pwd);
		$sql = "update ali_admin set admin_pwd = '$pwd' where admin_id = $id ";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo 4;
		} else {
			echo 3;
		}
	} else {
		echo 2;
	}
} else {
	echo 1;
}


?>