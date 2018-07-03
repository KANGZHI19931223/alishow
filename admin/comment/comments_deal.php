<?php 
// 1\ 接收前端传递的数据
$pageno = $_POST['page'];
$pagesize = $_POST['pagesize'];
// 2\ 在数据表中查询数据
// 计算limit查询的起始索引
$start = ($pageno - 1) * $pagesize;
include_once '../include/mysql.php';
$sql = "select * from ali_comment c 
join ali_member m on c.cmt_memid = m.member_id 
join ali_article a on c.cmt_articleid = a.article_id 
limit $start, $pagesize";
$result = mysqli_query($conn, $sql);
$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
	$row['cmt_addtime'] = date('Y/m/d', $row['cmt_addtime']);
	$arr[] = $row;
}
echo json_encode($arr);
?>