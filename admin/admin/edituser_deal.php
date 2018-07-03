<?php 
include_once '../include/checksession.php';
// 1\ 节后前端传递过来的数据
$id = $_POST['id'];
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$state = $_POST['state'];
// 2\ 将数据更新到数据库中
$sql = "update ali_admin set admin_email = '$email', admin_slug = '$slug', admin_nickname = '$nickname', admin_state = '$state' where admin_id = $id ";
include_once '../include/mysql.php';
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}

?>