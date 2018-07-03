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
      $id = $_GET['id'];
      $sql = "select * from ali_article art
              join ali_cate c on art.article_cateid = c.cate_id
              join ali_admin a on art.article_adminid = a.admin_id
              where article_id = $id";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
    ?>
    <div class="content">
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="/list.php?id=<?php echo $row['cate_id'] ?>&name=<?php echo $row['cate_name']; ?>"><?php echo $row['cate_name']; ?></a></dd>
            <dd><?php echo $row['article_title']; ?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $row['article_title']; ?></a>
        </h2>
        <div class="meta">
          <span><?php echo $row['admin_nickname']; ?> 发布于 <?php echo $row['article_addtime']; ?></span>
          <span>分类: <a href="javascript:;"><?php echo $row['cate_name']; ?></a></span>
          <span>阅读: (<?php echo $row['article_click']; ?>)</span>
          <span>评论: (<?php echo $row['article_cmt']; ?>)</span>
        </div>
      </div>
      <div><?php echo $row['article_text']; ?></div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
<?php 
$sql = "select * from ali_article order by article_click desc limit 0, 4";
$result = mysqli_query($conn, $sql);
?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <li>
            <a href="/detail.php?id=<?php echo $row['article_id']; ?>">
              <img src="/admin/admin/<?php echo $row['article_file']; ?>" alt="">
              <span><?php echo $row['article_title']; ?></span>
            </a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
