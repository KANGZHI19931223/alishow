<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <?php include_once 'left.php'; ?>
    <?php 
      // 接收链接传递过来的数据id和cate_name
      $cate_id = $_GET['id'];
      $cate_name = $_GET['name'];
      $sql = "select * from ali_article art
              join ali_admin a on art.article_adminid = a.admin_id
              where article_cateid = $cate_id and article_state = '已发布'";
      $result = mysqli_query($conn, $sql);
    ?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $cate_name; ?></h3>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="entry">
          <div class="head">
            <a href="/detail.php?id=<?php echo $row['article_id']; ?>"><?php echo $row['article_title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $row['admin_nickname']; ?> 发表于 <?php echo $row['article_addtime']; ?></p>
            <p class="brief"><?php echo $row['article_desc']; ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $row['article_click']; ?>)</span>
              <span class="comment">评论(<?php echo $row['article_cmt']; ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $row['article_good']; ?>)</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
<?php } ?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
