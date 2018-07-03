<?php 
$pic_url = $_POST['url'];
$pic_text = $_POST['text'];
$pic_link = $_POST['link'];
include_once '../include/mysql.php';
$sql = "insert into ali_pic values(null, '$pic_url', '$pic_text', '$pic_link')";
$result = mysqli_query($conn, $sql);
if ($result) {
	// echo 1;
	// 完成前端删除表格的操作,需要在添加数据表成功后,重新查询最新添加的数据, 并将数据返回(前端需要对应的pic_id)
	$sql = "select * from ali_pic order by pic_id desc limit 0, 1";
	$result = mysqli_query($conn, $sql);
	$inf = mysqli_fetch_assoc($result);
	echo json_encode($inf); 
} else {
	echo 2;
}



?>