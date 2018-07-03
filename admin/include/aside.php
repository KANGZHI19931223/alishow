 <div class="profile">
      <?php 
      // 链接数据库 头像是从数据库中得到的
      include_once 'mysql.php';
      $id = $_SESSION['id'];
      $sql = "select * from ali_admin where admin_id = $id";
      $result = mysqli_query($conn, $sql);
      $inf = mysqli_fetch_assoc($result);
      ?>
      <img class="avatar" src="/admin/admin/<?php echo $inf['admin_pic']; ?>">
      <h3 class="name"><?php echo $_SESSION['nickname']; ?></h3>
    </div>
<?php 
$url = $_SERVER['REQUEST_URI'];
$arr = explode('/', $url);
?>
    <ul class="nav">
      <li class="<?php echo $arr[2] == 'index.php' ? 'active' : ''; ?>">
        <a href="/admin/index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li class="<?php echo $arr[2] == 'article' || $arr[2] == 'cate' ? 'active' : ''; ?>">
        <a href="#menu-posts" data-toggle="collapse" class="<?php echo $arr[2] != 'article' && $arr[2] != 'cate' ? 'collapsed' : ''; ?>">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?php echo $arr[2] == 'article' || $arr[2] == 'cate' ? 'in' : ''; ?>">
          <li><a href="/admin/article/article.php">所有文章</a></li>
          <li><a href="/admin/article/addarticle.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">分类目录</a></li>
        </ul>
      </li>
      <li class="<?php echo $arr[2] == 'comment' ? 'active' : ''; ?>">
        <a href="/admin/comment/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li class="<?php echo $arr[2] == 'admin' ? 'active' : ''; ?>">
        <a href="/admin/admin/users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li class="<?php echo $arr[2] == 'other' || $arr[2] == 'site' ? 'active' : ''; ?>">
        <a href="#menu-settings" class="<?php echo $arr[2] != 'other' && $arr[2] != 'site' ? 'collapsed' : ''; ?>" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?php echo $arr[2] == 'other' || $arr[2] == 'site' ? 'in' : ''; ?>">
          <!-- <li><a href="/admin/cate/categories.php">导航菜单</a></li> -->
          <li><a href="/admin/other/slides.php">图片轮播</a></li>
          <li><a href="/admin/site/settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>