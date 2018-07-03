<?php 
$ids = $_POST['ids'];
include_once '../include/mysql.php';
$sql = "delete from ali_pic where pic_id in($ids)";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}




?>