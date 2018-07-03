<?php 

// 1\ 接收数据
$logo_src = $_POST['logo_src'];
$site_name = $_POST['site_name'];
$site_description = $_POST['site_description'];
$site_keywords = $_POST['site_keywords'];
$comment_status = isset($_POST['comment_status']) ? '1' : '2';
$comment_reviewed = isset($_POST['comment_reviewed']) ? '1' : '2';

// 2\ 拼接字符串
$str = "<?php 
	return [
		'logo_src' => '$logo_src',
		'site_name' => '$site_name',
		'site_description' => '$site_description',
		'site_keywords' => '$site_keywords',
		'comment_status' => '$comment_status',
		'comment_reviewed' => '$comment_reviewed'
		]
?>";

// 3\ 将$str 写入sitemsg文件中file_put_contents ( ' 文件路径 ' , ' 要写入文件的字符串 ' [ , FILE_APPEND ]  )
$result = file_put_contents('./sitemsg.php', $str);
if ($result) {
	echo 1;
} else {
	echo 2;
}


?>