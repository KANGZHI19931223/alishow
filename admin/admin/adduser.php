<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
<link rel="stylesheet" href="/assets/css/admin.css">
<script src="/assets/vendors/nprogress/nprogress.js"></script>
<script src="/assets/vendors/jquery-1.12.4.js"></script>
  <?php 
    include_once '../include/checksession.php';
  ?>
<div class="col-md-4">
  <form id="fm">
    <h2>添加新用户</h2>
    <div class="form-group">
      <label for="email">邮箱</label>
      <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
    </div>
    <div class="form-group">
      <label for="slug">别名</label>
      <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
    </div>
    <div class="form-group">
      <label for="nickname">昵称</label>
      <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
    </div>
    <div class="form-group">
      <label for="password">密码</label>
      <input id="password" class="form-control" name="password" type="text" placeholder="密码">
    </div>
    <div class="form-group">
      <label>状态</label>
      <input name="state" type="radio" value="激活" checked>激活
      <input name="state" type="radio" value="禁用">禁用
    </div>
    <div class="form-group">
      <input class="btn btn-primary" type="button" id="add" value="添加">
      <!-- <button class="btn btn-primary">添加</button> -->
    </div>
  </form>

  <script>
  // 1\ 给添加按钮添加点击事件
    $('#add').click(function () {
      // 使用FormData发送表单信息
      // 2\ 获取form表单元素
      var fm = $('#fm')[0];
      // 3\ 构造FormData实例对象
      var fd = new FormData(fm);
      // 4\ 发送ajax请求
      $.ajax({

        url: 'adduser_deal.php',
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
            parent.layer.alert('添加新用户成功', function (i) {
              var index = parent.layer.getFrameIndex(window.name);
              parent.layer.close(index);
              parent.location.reload();
            });
          } else {
            parent.layer.alert('添加新用户失败');
          }
          
        }

      })
    }) 




//       $('.btn-primary').click(function () {
//   //2. 获取表单对象，实例化FormData对象
//   var fm = $('#fm')[0];
//   var fd = new FormData(fm);
//   //3. 发送ajax请求
//   $.ajax({
//     url: 'adduser_deal.php',
//     data: fd,
//     type: 'post',
//     dataType: 'text',
//     contentType: false,
//     processData: false,
//     success: function (msg) {
//       //4. 等待返回结果
//       //alert(msg);
//       //判断返回结果
//       if (msg == 1) {
//         //如果msg==1，提示成功，关闭弹出层
//         //参数2: 点击确定时触发的函数, 回调函数中的参数代表alert弹出层的索引
//         parent.layer.alert('添加成功', function (i) {
//           //先得到当前iframe层的索引
//           var index = parent.layer.getFrameIndex(window.name); 
//           //再执行关闭
//           parent.layer.close(index);
//           //重新刷新父页面
//           parent.location.reload(); 
//         });

//       } else {
//         //如果msg==2，提示失败
//         parent.layer.alert('添加失败');
//       }
//     }
//   });

// })

    
    

  </script>
</div>
