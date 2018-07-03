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
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->

<?php 
header('content-type:text/html;charset=utf-8');
// 1\ 接收传递过来的id
$id = $_GET['id'];
// 2\ 链接数据库查询对应id的数据
include_once '../include/mysql.php';
$sql = "select * from ali_cate where cate_id = $id";
$result = mysqli_query($conn, $sql);
$inf = mysqli_fetch_assoc($result);
?>

      <div class="row">
        <div class="col-md-4">
          <form action="cate_edit.php" method="post">
            <input type="hidden" name = "id" value="<?php echo $inf['cate_id'] ?>">
            <h2>修改分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" value="<?php echo $inf['cate_name'] ?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $inf['cate_slug'] ?>">
            </div>
            <div class="form-group">
              <label for="slug">图标</label>
              <input id="slug" class="form-control" name="icon" type="text" value="<?php echo $inf['cate_icon'] ?>">
            </div>
            <div class="form-group">
              <label for="state">状态</label>
              <?php if ($inf['cate_state'] == 1) { ?>
              <input id="state" name="state" type="radio" checked value="1">启用
              <input id="state" name="state" type="radio" value="2">禁用
              <?php } else if ($inf['cate_state'] == 2) { ?>
              <input id="state" name="state" type="radio" value="1">启用
              <input id="state" name="state" type="radio" checked value="2">禁用
              <?php } ?>
            </div>
            <div class="form-group">
              <label for="show">是否显示</label>
              <?php if ($inf['cate_show'] == 1) { ?>
              <input id="show" name="show" type="radio" checked value="1">显示
              <input id="show" name="show" type="radio" value="2">不显示
              <?php } else if ($inf['cate_show'] == 2) { ?>
              <input id="show" name="show" type="radio" value="1">显示
              <input id="show" name="show" type="radio" checked value="2">不显示
              <?php } ?>
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="button" value="返回">
              <button class="btn btn-primary" type="submit">修改</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
    $('.btn-primary').filter('input').click(function () {
      location.href = 'categories.php';
    })
  </script>
</body>
</html>