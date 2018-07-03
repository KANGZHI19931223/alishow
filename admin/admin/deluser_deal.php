<?php 
include_once '../include/checksession.php';
// 1\ 接收前端发送的数据
$id = $_POST['id'];
// 2\ 链接数据库 删除对应id 的数据
include_once '../include/mysql.php';
$sql = "delete from ali_admin where admin_id = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}
?>