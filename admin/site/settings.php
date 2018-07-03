<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Settings &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>

  <script src="/assets/vendors/layer/layer.js"></script>
</head>
<body>
<?php include_once '../include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>网站设置</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
<?php 
  // 引入sitemsg网站信息存储文件
  $sitemsg = include_once './sitemsg.php';
?>
      <form class="form-horizontal">
        <div class="form-group">
          <label for="site_logo" class="col-sm-2 control-label">网站图标</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="logo" type="file">
              <img id="img" src="<?php echo $sitemsg['logo_src']; ?>">
              <i class="mask fa fa-upload"></i>
              <input type="hidden" name="logo_src" id="logo_src" value="<?php echo $sitemsg['logo_src']; ?>">
            </label>
          </div>
        </div>

        <div class="form-group">
          <label for="site_name" class="col-sm-2 control-label">站点名称</label>
          <div class="col-sm-6">
            <input id="site_name" name="site_name" class="form-control" type="type" placeholder="站点名称" value="<?php echo $sitemsg['site_name']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="site_description" class="col-sm-2 control-label">站点描述</label>
          <div class="col-sm-6">
            <textarea id="site_description" name="site_description" class="form-control" placeholder="站点描述" cols="30" rows="6"><?php echo $sitemsg['site_description']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="site_keywords" class="col-sm-2 control-label">站点关键词</label>
          <div class="col-sm-6">
            <input id="site_keywords" name="site_keywords" class="form-control" type="type" placeholder="站点关键词" value="<?php echo $sitemsg['site_keywords']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">评论</label>
          <div class="col-sm-6">
            <div class="checkbox">
              <label><input id="comment_status" name="comment_status" type="checkbox" <?php echo $sitemsg['comment_status'] == 1 ? 'checked' : ''; ?>>开启评论功能</label>
            </div>
            <div class="checkbox">
              <label><input id="comment_reviewed" name="comment_reviewed" type="checkbox" <?php echo $sitemsg['comment_reviewed'] == 1 ? 'checked' : ''; ?>>评论必须经人工批准</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-6">
            <button type="button" class="btn btn-primary">保存设置</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>
  <script>NProgress.done()</script>

  <script>
    
    // 完成头像上传
    $('#logo').change(function () {
      // 1\ 获取头像图片信息
      var fd = new FormData();
      var pic = $(this)[0].files[0];
      fd.append('file', pic);
      // 2\ 发送ajax请求
      $.ajax({
        url: '/admin/site/uplogo.php',
        type: 'post',
        dataType: 'text',
        data: fd,
        contentType: false,
        processData: false,
        success: function (msg) {
          // 1\ 将上传的图片显示再img标签中
          $('#img').attr('src', msg);
          $('#logo_src').val('/admin/admin/' + msg);
        }
      })
    })


    // 完成'保存设置'
    // 1\ 给按钮添加点击事件
    $('.btn').click(function () {
      // 2\ 获取表单中的所有数据
      var fm = $('.form-horizontal')[0];
      var fd = new FormData(fm);
      // 3\ 发送ajax请求
      $.ajax({
        url: 'dealsitemsg.php',
        data: fd,
        dataType: 'text',
        type: 'post',
        contentType: false,
        processData: false,
        success: function (msg) {
          if (msg == 1) {
            layer.alert('保存成功');
          } else {
            layer.alert('保存失败');
          }
        }
      })
    })



  </script>
</body>
</html>
