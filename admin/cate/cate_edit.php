<?php 
header('content-type:text/html;charset=utf-8');
include_once '../include/checksession.php';
// 1\ 接收数据
$id = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
// 2\ 链接数据库

include_once '../include/mysql.php';
$sql = "update ali_cate set cate_name = '$name', cate_slug = '$slug', cate_icon = '$icon', cate_state = $state, cate_show = $show where cate_id = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo '修改成功';
	header('refresh: 2; url = categories.php');
} else {
	echo '修改失败';
	header('refresh: 2; url = categoriesedit.php?id=' . $id);
}
mysqli_close($conn);
?>