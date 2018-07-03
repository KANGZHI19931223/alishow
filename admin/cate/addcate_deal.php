<?php 
header('content-type:text/html;charset=utf-8');
include_once '../include/checksession.php';
$name = $_POST['name'];
$slug = $_POST['name'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
$time = date('Y-m-d');

include_once '../include/mysql.php';
$sql = "insert into ali_cate values(null, '$name', '$slug', '$time', '$icon', '$state', '$show')";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo '添加新分类成功';
	header('refresh: 2; url=categories.php');
} else {
	echo '添加新分类失败';
	header('refresh: 2; url=addcate.php');
}

?>