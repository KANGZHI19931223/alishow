<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>

  <script src="/assets/vendors/template-web.js"></script>

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
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="fm">
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none" src="">
              <input id="image" class="form-control" name="image" type="file">
              <input type="hidden" class="url" value="" name="url">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="button">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"></th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>链接</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <?php 
            include_once '../include/mysql.php';
            $sql = "select * from ali_pic";
            $result = mysqli_query($conn, $sql);
            ?>
            <tbody>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="slide" src="<?php echo $row['pic_url']; ?>"></td>
                <td><?php echo $row['pic_text']; ?></td>
                <td><?php echo $row['pic_link']; ?></td>
                <td class="text-center">
                  <a href="javascript:;" class="del btn btn-danger btn-xs">删除</a>
                  <input type="hidden" class="id" x-data="<?php echo $row['pic_id']; ?>" name="id">
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
    <?php include_once '../include/aside.php'; ?>
  </div>
  <script>NProgress.done()</script>

<script type ="text/template" id="tmp">
  <tr>
    <td class="text-center"><input type="checkbox"></td>
    <td class="text-center"><img class="slide" src="<%= url %>"></td>
    <td><%= text %></td>
    <td><%= link %></td>
    <td class="text-center">
      <a href="javascript:;" class="del btn btn-danger btn-xs">删除</a>
      <input type="hidden" class="id" x-data="" name="id">
    </td>
  </tr>
</script>

  <script>
    // 完成图片上传
    // 1\ 文件上传表单域添加change事件
    $('#image').change(function () {
      // 2\ 创建一个空fd对象
      var fd = new FormData();
      var img = $(this)[0].files[0];
      fd.append('img', img);
      // 3\ 发送ajax请求
      $.ajax({
        url: 'upimg.php',
        data: fd,
        type: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        success: function (msg) {
          if (msg == 2) {
            layer.alert('上传失败');
          } else {
            // alert(msg);
            // 上传成功后, 将图片显示出来 display: block
            $('.help-block').css('display', 'block')
                            .attr('src', msg);
            // 将返回的图片路径保存到隐藏域中
            $('.url').val(msg);
          }
        }

      })
    })



    // 完成'添加'按钮操作
    $('.btn-primary').click(function () {
      //获取表单数据 发送ajax请求
      var fm = $('#fm')[0];
      var fd = new FormData(fm);

      $.ajax({
        url: 'addpic.php',
        data: fd,
        dataType: 'text',
        type: 'post',
        contentType: false,
        processData: false,
        success: function (msg) {
          if (msg == 2) {
            layer.alert('添加失败');
          } else {
            // 添加成功
            layer.alert('添加成功', function (index) {
              // (1) 在页面表格中添加对应的DOM元素

              // 使用模板引擎
              // ① 创建一个json对象
              var json = {
                'url': $('.url').val(),
                'text': $('#text').val(),
                'link': $('#link').val()
              }
              // ② 定义模板
              // ③ 调用template函数,传参(模板script的id  json对象)
              var html = template('tmp', json);
              // ④ 渲染页面
              $('tbody').append(html);

              // (2) 清空普通表单
              $('#fm')[0].reset();
              // (3) 清空文件上传表单
              $('#image').val('');
              // (4) 将图片预览隐藏
              $('.help-block').css('display', 'none');
              // (5) 将返回的数据(json字符串)中的id属性值 写入到隐藏域id的x-data中
              var inf = JSON.parse(msg);
              $('tr').last().find('.id').attr('x-data', inf['pic_id']);

              // (5) 关闭layer弹框
              layer.close(index);
            })
          }

        }
      })
    })



    // 完成删除按钮
    // 1\ 获取所有的'删除'按钮, 添加点击事件
    $(document).on('click', '.del', function () {
      // 2\ 获取id隐藏域中的id值
      var id = $(this).next().attr('x-data');
      // 3\ 发送ajax请求
      _this = $(this);
      $.post('delpic.php', {'id': id}, function (msg) {
        if (msg == 2) {
          layer.alert('删除失败');
        } else {
          layer.alert('删除成功', function (index) {
            // 4\ 后端删除成功,前端将页面上对应的表格tr删除
            _this.parents('tr').remove();
            layer.close(index);
          })
          
        }

      })
    })



    // 完成批量删除
    // 1\ 给'批量删除'按钮添加点击事件
    $('.btn-sm').click(function () {
      var ids = '';
      $(':checkbox:checked').each(function () {
        // 2\ 将选中行对应的id获取到,拼接字符串
        ids += $(this).parents('tr').find('.id').attr('x-data') + ',';
      })
      ids = ids.slice(0, -1);
      // 3\ 发送ajax请求
      $.post('delpics.php', {'ids': ids}, function (msg) {
        if (msg == 2) {
          layer.alert('删除失败');
        } else {
          layer.alert('删除成功', function (index) {
            // 4\ 将页面上对应的tr删掉
            $(':checkbox:checked').parents('tr').remove();
            layer.close(index);
          })
        }

      })
    })
    



  </script>
</body>
</html>
