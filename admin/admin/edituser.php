<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
<link rel="stylesheet" href="/assets/css/admin.css">
<script src="/assets/vendors/nprogress/nprogress.js"></script>
<script src="/assets/vendors/jquery-1.12.4.js"></script>
<div class="col-md-4">

<?php 
include_once '../include/checksession.php';
// 1\ 接收前端发送过来的id值
$id = $_GET['id'];
// 2\ 链接数据库
include_once '../include/mysql.php';
$sql = "select * from ali_admin where admin_id = $id";
$result = mysqli_query($conn, $sql);
$inf = mysqli_fetch_assoc($result);
?>


  <form id="fm">
    <h2>修改用户信息</h2>
    <input type="hidden" name="id" value="<?php echo $inf['admin_id']; ?>">
    <div class="form-group">
      <label for="email">邮箱</label>
      <input id="email" class="form-control" name="email" type="email" value="<?php echo $inf['admin_email']; ?>">
    </div>
    <div class="form-group">
      <label for="slug">别名</label>
      <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $inf['admin_slug']; ?>">
    </div>
    <div class="form-group">
      <label for="nickname">昵称</label>
      <input id="nickname" class="form-control" name="nickname" type="text" value="<?php echo $inf['admin_nickname']; ?>">
    </div>
    <div class="form-group">
      <label>状态</label>
      <?php if ($inf['admin_state'] == '激活') { ?>
      <input name="state" type="radio" value="激活" checked>激活
      <input name="state" type="radio" value="禁用">禁用
      <?php } else { ?>
      <input name="state" type="radio" value="激活">激活
      <input name="state" type="radio" value="禁用" checked>禁用
      <?php } ?>
    </div>
    <div class="form-group">
      <input class="btn btn-primary" type="button" id="edit" value="修改">
    </div>
  </form>

  <script>
  // 1\ 给添加按钮添加点击事件
    $('#edit').click(function () {
      // 使用FormData发送表单信息
      // 2\ 获取form表单元素
      var fm = $('#fm')[0];
      // 3\ 构造FormData实例对象
      var fd = new FormData(fm);
      // 4\ 发送ajax请求
      $.ajax({

        url: 'edituser_deal.php',
        data: fd,
        type: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        success: function (msg) {
          //alert(msg);
          //alert(msg);
          // 接收后端返回的数据 调用弹出层插件
          if (msg == 1) {
            parent.layer.alert('修改成功', function (i) {
              var index = parent.layer.getFrameIndex(window.name);
              parent.layer.close(index);
              parent.location.reload();
            });
          } else {
            parent.layer.alert('修改失败');
          }
          
        }

      })
    }) 

  </script>
</div>
