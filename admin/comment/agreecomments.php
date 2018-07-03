<?php 
// 1\ 接收前端传递的数据
$ids = $_POST['ids'];
// 2\ 更新数据表
include_once '../include/mysql.php';
$sql = "update ali_comment set cmt_state = '已批准' where cmt_id in($ids)";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}


?>