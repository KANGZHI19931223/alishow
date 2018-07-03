<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery-1.12.4.js"></script>
  <script src="/assets/vendors/layer/layer.js"></script>
  <script src="/assets/vendors/template-web.js"></script>
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
        <h1>用户</h1>
        <!-- <input type="button" value="添加新用户" id="adduser"> -->
        <a href="javascript:;" id="adduser">添加新用户</a>
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
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
<script type="text/template" id="tmp">
<% for (var i = 0; i < list.length; i++) { %>
  <tr>
    <td class="text-center"><input type="checkbox"></td>
    <td class="text-center"><img class="avatar" src="/assets/img/default.png"></td>
    <td><%= list[i].admin_email %></td>
    <td><%= list[i].admin_slug %></td>
    <td><%= list[i].admin_nickname %></td>
    <td><%= list[i].admin_state %></td>
    <td class="text-center">
      <a href="javascript:;" data-id="<%= list[i].admin_id %>" class="btn edit btn-default btn-xs">编辑</a>
      <a href="javascript:;" data-id="<%= list[i].admin_id %>" class="btn del btn-danger btn-xs">删除</a>
    </td>
  </tr>
<% } %>
</script>
<script>
  // 1\  页面一加载就发送ajax请求 获取后台的数据 将表格显示使用  --  模板
  $.post('getusers.php', function (msg) {
    //alert(msg);
    // 1\ 将后台返回的数据转换成数组
    var inf = JSON.parse(msg);
    // 2\ 创建一个json对象
    var json = {"list": inf};
    // 4\ 调用模板函数  =>   参数1 : 对应的目标标签的id  参数2: json对象
    var html = template('tmp', json);
    $('tbody').html(html);
  })


  // 1\ 给a标签添加点击事件
  $('#adduser').click(function () {
    // 2\ 调用弹层
    layer.ready(function(){ 
      layer.open({
        type: 2,
        title: '添加新用户',
        maxmin: true,
        area: ['800px', '500px'],
        content: 'adduser.php'
      });
    });
  })

  // 1\ 用事件委托给删除按钮添加点击事件
  $(document).on('click', '.del', function () {
    var _this = $(this);
    // 先弹框confirm, 点击确定时 删除, 点击取消时不删除
    layer.confirm('确定要删除么', function () {
      // 点击确定时  要将对应行的id发送给后端, 使用ajax实现
      var id = _this.attr('data-id');
      $.post('deluser_deal.php', {"id": id}, function (msg) {
        // alert(msg);
        // 根据后台返回的数据判断删除是否成功
        if (msg == 1){
          // 删除成功, 弹层, 回调函数中弹层关闭, 并且刷新页面
          parent.layer.alert('删除成功', function () {
            // 将对应的行tr删除
            _this.parents('tr').remove();
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
            parent.location.reload();
          });
        } else {
          parent.layer.alert('删除失败');
        }


      })

    })

  })




  // 使用事件委托给编辑按钮添加点击事件
  $(document).on('click', '.edit', function () {
    var id = $(this).attr('data-id');
    // 先有个弹层 , 并且将对应的数据填回对应表单域中
    layer.ready(function(){ 
      layer.open({
        type: 2,
        title: '更改用户信息',
        maxmin: true,
        area: ['800px', '500px'],
        content: 'edituser.php?id=' + id
      });
    });
  })






</script>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
