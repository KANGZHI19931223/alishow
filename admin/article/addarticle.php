<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>

  <link href="/assets/vendors/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
  <script type="text/javascript" src="/assets/vendors/jquery-1.12.4.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/umeditor/umeditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/umeditor/umeditor.min.js"></script>
  <script type="text/javascript" src="/assets/vendors/umeditor/lang/zh-cn/zh-cn.js"></script>

  <script src="/assets/vendors/layer/layer.js"></script>

  <script src="/assets/vendors/template-web.js"></script>
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
        <h1>写文章</h1>
      </div>
      <form class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="desc">摘要</label>
            <textarea id="desc" class="form-control input-lg" name="desc" cols="30" rows="2" placeholder="摘要"></textarea>
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="feature">特色图像</label>
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
            
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="未发布">草稿</option>
              <option value="已发布">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="button" value="保存">
          </div>
        </div>
        <input type="hidden" name="pic" value="" id="pic">
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>

  <script type="text/template" id="tpl">
    <% for (var i = 0; i < list.length; i++) { %>
      <option value="<%= list[i].cate_id %>"><%= list[i].cate_name %></option>
    <% } %>
  </script>

  <script>
    // 完成富文本编辑器
    //实例化编辑器
    var um = UM.getEditor('content', {
      initialFrameWidth: '100%', //初始化编辑器宽度,默认500
      initialFrameHeight:300,  //初始化编辑器高度,默认500
      initialContent: txt
    });
    


    // 完成特色头像上传的功能
    $('#feature').change(function () {
      // input文本上传框内容改变触发change事件时, 发送ajax请求, 最后将上传的图片显示再对应的位置
      // (1) 使用formdata获取表单内容
      var fd = new FormData();
      // (2) 获取上传图片的对象信息
      var img = $(this)[0].files[0];
      // (3) 将获取到的图片对象信息添加到fd中
      fd.append('file', img);
      // (4) 发送ajax请求
      $.ajax({
        url: 'pic_deal.php',
        data: fd,
        dataType: 'text',
        type: 'post',
        contentType: false,
        processData: false,
        success: function (msg) {
          layer.alert(msg.length>4?'上传成功':'上传失败');
          $('.help-block').attr({'src': msg, 'style': 'display: block'});
          $('#pic').val(msg);
        }
      })

    })


    // 完成所属分类下拉菜单选项
    // 1\ 页面加载完发送ajax, 使用模板引擎渲染到页面上
    $.post('select.php', function (msg) {
      // console.log(msg);
      // (1)创建一个json对象
      var json = {"list": msg};
      // (2)创建模板
      // (3)调用template函数, 参数1: 模板<script>标签的id 参数2 : json对象
      var html = template('tpl', json);
      // (4)渲染到页面指定位置
      $('#category').html(html);
    }, 'json')


    // 完成保存操作
    // 1\ 给保存按钮添加点击事件
    $('.btn-primary').click(function () {
      // 2\ 使用formdata获取所有表达中的数据
      var fm = $('.row')[0]; // 注意::此处得到的必须是DOM对象
      var fd = new FormData(fm);
      // 2\ 发送ajax请求
      $.ajax({
        url: 'addarticle_deal.php',
        data: fd,
        dataType: 'text',
        type: 'post',
        contentType: false,
        processData: false,
        success: function (msg) {
          // alert(msg);
          if (msg == 1) {
            alert('保存成功');
            // 保存成功后将表单中的内容回复到默认值
            $('.row')[0].reset();
            $('.btn-primary').val('保存');
            $('#feature').val('');
            $('.help-block').css('display', 'none');
            um.setContent('文章正文');
          } else {
            layer.alert('保存失败');
          }
        }
      })
    })







  </script>
</body>
</html>
