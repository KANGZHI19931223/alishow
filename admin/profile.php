<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php include_once './include/checksession.php'; ?>
  <?php 
  // 1\ 先查找session中的id
  session_start();
  $id = $_SESSION['id'];
  include_once './include/mysql.php';
  $sql = "select * from ali_admin where admin_id = $id";
  $result = mysqli_query($conn, $sql);
  $inf = mysqli_fetch_assoc($result);
  ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once './include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file">
              <img id="header-pic" src="/admin/admin/<?php echo $inf['admin_pic']; ?>">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="<?php echo $inf['admin_email']; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="<?php echo $inf['admin_slug']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="<?php echo $inf['admin_nickname']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" class="form-control" placeholder="Bio" cols="30" rows="6"><?php echo $inf['admin_sign']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <input type="button" class="btn btn-primary" value="更新">
            <a class="btn btn-link" href="password-reset.php">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/layer/layer.js"></script>
  <script>NProgress.done()</script>

  <script>
    // 完成更换头像
    // 1\ 给file表单域添加change事件
    $('#avatar').change(function () {
      // 2\ 使用formdata获取表单信息

      // (1) 构造一个formdata空对象
      var fm = new FormData();
      // (2) 获取新头像图片信息
      var file = $(this)[0].files[0];
      // (3) 将新头像图片信息添加到formdata空对象中, 使用append方法
      fm.append('f', file);
      // 2\ 发送ajax请求 , 将新头像图片的信息发送给后端
      $.ajax({
        url: 'header-pic.php',
        data: fm,
        type: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        success: function (msg) {
          // alert(msg);
          if (msg == 2 || msg == 3) {
            layer.alert('头像上传失败');
          } else {
            // 弹出框使用layer弹框插件
            layer.alert('头像上传成功');
            // 将新头像渲染到页面上
            $('#header-pic').prop('src', '/admin/admin/' + msg);
            $('.avatar').prop('src', '/admin/admin/' + msg);
          }
        }
      })
    })


    // 完成更新按钮
    // 1\ 给更新按钮添加点击事件
    $('.btn-primary').click(function () {
      // 2\ 获取表单中的所有与数据
      
    })



  </script>
</body>
</html>
