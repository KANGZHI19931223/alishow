<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<?php include_once '../include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php' ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
        <a href="addcate.php">添加新分类</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>时间</th>
                <th>图标</th>
                <th>状态</th>
                <th>显示</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
<?php 
include_once '../include/mysql.php';

$sql = "select * from ali_cate";
$result = mysqli_query($conn, $sql);
?>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><?php echo $row['cate_name']; ?></td>
                <td><?php echo $row['cate_slug']; ?></td>
                <td><?php echo $row['cate_addtime']; ?></td>
                <td><?php echo $row['cate_icon']; ?></td>
                <td><?php echo $row['cate_state']==1?'启用':'禁用'; ?></td>
                <td><?php echo $row['cate_show']==1?'显示':'不显示'; ?></td>
                <td class="text-center">
                  <a href="categoriesedit.php?id=<?php echo $row['cate_id']; ?>" class="btn btn-info btn-xs">编辑</a>
                  <?php if ($row['cate_state'] == 1) { ?>
                  <a href="catestate_deal.php?id=<?php echo $row['cate_id']; ?>&state=2" class="btn btn-danger btn-xs">禁用</a>
                  <?php } else if ($row['cate_state'] == 2) { ?>
                  <a href="catestate_deal.php?id=<?php echo $row['cate_id']; ?>&state=1" class="btn btn-danger btn-xs">启用</a>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
