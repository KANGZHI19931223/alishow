<?php 
header('content-type:text/html;charset=utf-8');
include_once '../include/checksession.php';
// 1\ 接收点击 启用/禁用 按钮时传递过来的数据
$id = $_GET['id'];
$state = $_GET['state'];
// 2\ 链接数据库 将state状态改变
include_once '../include/mysql.php';
$sql = "update ali_cate set cate_state = $state where cate_id = $id";
$result = mysqli_query($conn, $sql);
// 3\ 判断修改结果
if ($result) {
	echo '修改状态成功';
} else {
	echo '修改状态失败';
}
header('refresh: 2; url = categories.php');
mysqli_close($conn);
?>