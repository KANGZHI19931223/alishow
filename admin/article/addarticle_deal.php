<?php 
// 1\ 接收前端发送的数据
// print_r($_POST);
$article_title = $_POST['title'];
$article_des = $_POST['desc'];
$article_text = $_POST['content'];
$article_cateid = $_POST['category'];
$article_state = $_POST['status'];
$article_file = $_POST['pic'];
session_start();
$article_adminid = $_SESSION['id'];
$article_addtime = date('Y-m-d');
$article_click = rand(200, 3000);
$article_good = rand(100, 500);
$article_bad = rand(10, 50);
$article_cmt = 0;

include_once '../include/mysql.php';
$sql = "insert into ali_article values(null, '$article_title', '$article_text', '$article_adminid', '$article_cateid', '$article_addtime', '$article_state', '$article_file', '$article_click', '$article_good', '$article_bad', '$article_cmt', '$article_des')";
$result = mysqli_query($conn, $sql);
if ($result) {
	echo 1;
} else {
	echo 2;
}






?>