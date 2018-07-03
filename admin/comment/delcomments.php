<?php 
// 1\ 获取前端发送的数据
$ids = $_POST['ids'];
// 2\ 数据库操作
include_once '../include/mysql.php';
$sql = "delete from ali_comment where cmt_id in($ids)";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}



?>