<?php 
// 1\ 接收前端数据
$id = $_POST['id'];
// 2\ 更新数据表
include_once '../include/mysql.php';
$sql = "delete from ali_comment where cmt_id = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}

?>