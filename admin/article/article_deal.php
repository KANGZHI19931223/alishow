<?php 
// 1\ 接收前端的数据
$pageno = $_POST['pageno'];
$pagesize = $_POST['pagesize'];
$start = ($pageno - 1) * $pagesize;
// 1 连接数据库
include_once '../include/mysql.php';
//页面一加载从后台获取数据  并且渲染到页面上
$sql = "select art.*, a.admin_nickname, c.cate_name from ali_article art
      join ali_admin a on art.article_adminid = a.admin_id 
      join ali_cate c on art.article_cateid = c.cate_id 
      limit $start, $pagesize ";
$result = mysqli_query($conn, $sql);
// 将查询到的数据存储到一个数组中
$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
	$arr[] = $row;
}
echo json_encode($arr);
?>