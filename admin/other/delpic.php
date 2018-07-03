<?php 
// 1\ 接收前端传的数据
$id = $_POST['id'];
// 2\ 删除数据表中的数据
include_once '../include/mysql.php';
$sql = "delete from ali_pic where pic_id = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}


?>