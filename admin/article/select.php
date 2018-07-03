<?php 
include_once '../include/mysql.php';
// 在ali_cate 表中查询 state是1的数据
$sql = "select * from ali_cate where cate_state = 1";
$result = mysqli_query($conn, $sql);
//将数据存入一个数组中
$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
	$arr[] = $row;
}
echo json_encode($arr);

?>