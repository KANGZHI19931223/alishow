<?php 
include_once '../include/checksession.php';
// 1\  前端没有发送数据, 直接连接数据库 查询数据
include_once '../include/mysql.php';
$sql = "select * from ali_admin";
$result_obj = mysqli_query($conn, $sql);
// 将获取到的对象装换成数组
$arr = array();
while ($row = mysqli_fetch_assoc($result_obj)) {
	$arr[] = $row;
}
$admin_inf = json_encode($arr);
echo $admin_inf;
mysqli_close($conn);
?>