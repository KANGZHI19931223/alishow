<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery-1.12.4.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
  <script src="/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
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
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      </div>
      <div class="page-action">
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right" id="pagination"></ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>
  <script>NProgress.done()</script>


  <?php 
  // 1\ 在数据库中查询ali_article表中数据的总条数
  include_once '../include/mysql.php';
  $sql = "select count(*) num from ali_article";
  $result = mysqli_query($conn, $sql);
  $inf = mysqli_fetch_assoc($result);
  // 数据总条数
  $num = $inf['num'];
  // 计算每页显示的信息的条数
  $pagesize = 2;
  // 计算总页数
  $totalpages = ceil($num / $pagesize);
  ?>
  
  <script type="text/template" id="tpl">
    <% for (var i = 0; i < list.length; i++) { %>
      <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td><%= list[i]['article_title'] %></td>
        <td><%= list[i]['admin_nickname'] %></td>
        <td><%= list[i]['cate_name'] %></td>
        <td class="text-center"><%= list[i].article_addtime %></td>
        <td class="text-center"><%= list[i].article_state %></td>
        <td class="text-center">
          <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
          <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
        </td>
      </tr>
    <% } %>
  </script>


  <script>

    $('#pagination').twbsPagination({
      // 总页数
      totalPages: <?php echo $totalpages; ?>,
      // 显示的分页导航条的页数的最大个数
      visiblePages: 5,
      // 第一页的按钮的显示内容
      first: '第一页',
      // 上一页按钮显示的内容
      prev: '上一页',
      // 下一页按钮显示的内容
      next: '下一页',
      // 尾页按钮显示的内容
      last: '尾页',
      onPageClick: function (event, page) {
        // 参数page代表就是选中页码按钮上的页码数
        // 发送ajax请求,将page和$pagesize发送给后端, 再使用模板引擎渲染页面
        $.post('article_deal.php', {"pageno": page, "pagesize": <?php echo $pagesize; ?>}, function (msg) {
          // 1\ 引入模引擎文件库
          // 2\ 构造一个json对象
          var json = {"list": msg};
          // 3\ 创建模板
          // 4\ 调用template方法
          var html = template('tpl', json);
          // 5\ 渲染页面
          $('tbody').html(html);
        }, 'json')

      }
    })
  </script>
</body>
</html>
