<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>

  <script src="/assets/vendors/jquery-1.12.4.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
  <script src="/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>

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
        <h1>所有评论</h1>
      </div>
      <div class="page-action">
        <div class="btn-batch">
          <button id="agree" class="btn btn-info btn-sm">批量批准</button>
          <button id="no" class="btn btn-warning btn-sm">批量拒绝</button>
          <button id="dels" class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">

        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <?php 
        include_once '../include/mysql.php';

        // 现在数据表中查询一共有多少条数据
        $sql = "select count(*) num from ali_comment";
        $result = mysqli_query($conn, $sql);
        $n = mysqli_fetch_assoc($result);
        $pagesize = 3;
        $totalpage = ceil($n['num'] / $pagesize);


        // 链接数据库, 获取所有的数据, 渲染到页面上
        
        $sql = "select * from ali_comment ac
        join ali_article aa on ac.cmt_articleid = aa.article_id
        join ali_member am on ac.cmt_memid = am.member_id";
        $result = mysqli_query($conn, $sql);
        $num = 0;
        ?>
        <tbody>
        
        </tbody>

<script type="text/template" id="tmp">
    <% for (var i = 0; i < list.length; i++) { %>
        <% if (i == 0) { %>
          <tr class="danger">
        <% } else { %>
          <tr>
        <% } %>  
            <input type="hidden" name="id" class="id" value="<%= list[i].cmt_id %>">
            <td class="text-center"><input type="checkbox"></td>
            <td><%= list[i].member_nickname %></td>
            <td><%= list[i].cmt_content %></td>
            <td><%= list[i].article_title %></td>
            <td><%= list[i].cmt_addtime %></td>
            <td class="state"><%= list[i].cmt_state %></td>
            <td class="text-center">
              
              <% if (list[i].cmt_state == '未批准') { %>
              <a href="javascript:;" class="btn btn-info btn-xs deal">批准</a>
              <% } else { %>
              <a href="javascript:;" class="btn btn-warning btn-xs deal">驳回</a>
              <% } %>
              <a href="javascript:;" class="btn btn-danger btn-xs del">删除</a>
            </td>
          </tr>
    <% } %>
</script>

      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script>NProgress.done()</script>

  <script>
    //给批准和驳回按钮添加点击事件
    $('.deal').click(function () {
      // 获取按钮上的文字和id
      var text = $(this).html();
      var id = $(this).parents('tr').find('.id').val();
      // 发送ajax请求
      $.post('changestate.php', {'cmt_state': text, 'cmt_id': id}, function (msg) {
        alert(msg);
      }, 'text')
    })


    // 完成分页功能

    // 1\ 引入4个文件
    // 2\ 获取容器对象, 并且调用twbsPagination方法
    $('.pagination').twbsPagination({
      totalPages: <?php echo $totalpage; ?>,
      visiblePages: 5,
      first: '首页',
      prev: '上一页',
      next: '下一页',
      last: '尾页',
      onPageClick: function (event, page) {
        // 页面数据显示需要使用ajax请求
        $.post('comments_deal.php', {'page': page, 'pagesize': <?php echo $pagesize; ?>}, function (msg) {
          // console.log(msg);
          // 使用模板渲染页面
          // 1\ 引入文件
          // 2\ 创建一个json对象
          var json_obj = {'list': msg};
          // 3\ 使用script创建一个模板
          // 4\ 调用template方法
          var html = template('tmp', json_obj);
          // 5\ 将模板渲染到指定标签内
          $('tbody').html(html);
        }, 'json')
      }
    })



    // 完成点击'批准'或'驳回'按钮改变'状态'和按钮上文字, 使用时间委托
    $(document).on('click', '.deal', function () {
      // 1 \ 获取按钮上的文字以及对应点击行的id(从隐形域中获取)
      var id = $(this).parents('tr').children('.id').val();
      var text = $(this).html();
      // 2\ 发送ajax请求
      var _this = $(this);
      $.post('changestate.php', {'id': id, 'text': text}, function (msg) {
        if (msg == 1) {
          // 后端修改数据表完成后, 前端DOM修改'状态'和按钮上的文字
          if (_this.html() == '批准') {
            _this.html('驳回').removeClass('btn-info')
                              .addClass('btn-warning')
                              .parents('tr')
                              .children('.state')
                              .html('已批准');
          } else {
            _this.html('批准').removeClass('btn-warning')
                              .addClass('btn-info')
                              .parents('tr')
                              .children('.state')
                              .html('未批准');
          }
        } else {
          alert('修改失败');
        }
      })
    })


    // 完成删除
    $(document).on('click', '.del', function () {
      // 1\ 获取点击删除按钮所在行的id
      var id = $(this).parents('tr').children('.id').val();
      // 2\ 发送ajax请求
      var _this = $(this);
      layer.confirm('确定要删除么', function(index) {
        $.post('delcomment.php', {'id': id}, function (msg) {
          if (msg == 1) {
            // 3\ 将页面上的DOM元素删除
            _this.parents('tr').remove();
          } else {
            alert('删除失败');
          }
        })
        layer.close(index);
      });
      
    })



    // 完成批量删除
    // 1\ 给'批量删除'按钮添加点击事件
    $('#dels').on('click', function () {
      // 2\ 获取当前被选中的复选框所在行的id
      var ids = '';
      $(':checkbox:checked').each(function () {
        ids += $(this).parents('tr').children('.id').val() + ',';
      })
      ids = ids.slice(0, -1);
      layer.confirm('确定要都删除么', function (index) {
        // 3\ 发送ajax请求
        $.post('delcomments.php', {'ids': ids}, function (msg) {
          if (msg == 1) {
            // 4\ 后端数据表删除成功后, 将页面上对应的DOM也删除
            $(':checkbox:checked').each(function () {
              $(this).parents('tr').remove();
            })
            layer.alert('删除成功');
          } else {
            layer.alert('删除失败');
          }
        })
        layer.close(index);
      })
      
    })



    // 完成批量批准
    // 1\ 给'批量批准'按钮添加点击事件
    $('#agree').click(function () {
      // 2\ 获取所有别选中的复选框对应tr的id
      var ids = '';
      $(':checkbox:checked').each(function () {
        ids += $(this).parents('tr').children('.id').val() + ',';
      })
      ids = ids.slice(0, -1);
      // 3\ 发送ajax请求
      $.post('agreecomments.php', {'ids': ids}, function (msg) {
        if (msg == 1) {
          // 4\后端修改成功后, 将对应的页面DOM修改
          $(':checkbox:checked').each(function () {

            $(this).parents('tr')
                  .children('.state')
                  .html('已批准')
                  .end()
                  .find('.deal')
                  .html('驳回')
                  .removeClass('btn-info')
                  .addClass('btn-warning');
            $(this).attr('checked', false);

          })
        } else {
          alert('修改失败');
        }

      })
    })


    // 完成批量拒绝
    // 1\ 给'批量拒绝'按钮添加点击事件
    $('#no').click(function () {
      // 2\ 获取所有别选中的复选框对应tr的id
      var ids = '';
      $(':checkbox:checked').each(function () {
        ids += $(this).parents('tr').children('.id').val() + ',';
      })
      ids = ids.slice(0, -1);
      // 3\ 发送ajax请求
      $.post('refusecomments.php', {'ids': ids}, function (msg) {
        if (msg == 1) {
          // 4\后端修改成功后, 将对应的页面DOM修改
          $(':checkbox:checked').each(function () {

            $(this).parents('tr')
                  .children('.state')
                  .html('未批准')
                  .end()
                  .find('.deal')
                  .html('批准')
                  .removeClass('btn-warning')
                  .addClass('btn-info');
            $(this).attr('checked', false);

          })
        } else {
          alert('修改失败');
        }

      })
    })



  </script>

</body>
</html>
