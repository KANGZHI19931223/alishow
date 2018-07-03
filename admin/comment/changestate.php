<?php 
$id = $_POST['id'];
$text = $_POST['text'];

include_once '../include/mysql.php';
if ($text == '批准') {
	$sql = "update ali_comment set cmt_state = '已批准' where cmt_id = $id";
} else if ($text == '驳回') {
	$sql = "update ali_comment set cmt_state = '未批准' where cmt_id = $id";
}
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}



?>