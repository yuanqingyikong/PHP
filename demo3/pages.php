<?php
session_start();
$ID = $_GET['id'];
require_once 'dbconf.php';
$sql = "select * from article where tid='$ID'";
$res = mysqli_query($link,$sql);
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>墨 尘</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /*
* 文章内容样式
*/
        .article-title {
            margin-bottom: 30px;
        }

        #content {
            margin: 20px 0;
        }

        #content img {
            /*width: 1140px;*/
            margin-bottom: 5px;
        }
    </style>
</head>
<body>


<!--导航栏-->
<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">墨尘</a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li><a class="" href="#">关于我</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(isset($_SESSION['admin'])){
                    echo '<li><a href="admin/deal/lgout.php"><span class="glyphicon glyphicon-log-in"></span> 注销</a></li>';
                }else{
                    echo '<li><a href="admin/login.html"><span class="glyphicon glyphicon-user"></span> 登录</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>
</div>

<!--内容-->
<div class="container">
    <div class="row">
        <div class="container">
            <div class="col-md-12">

                <h1 class="article-title"><?php echo $row['title'];?></h1>
                <footer class="content-meta ">
                    <time><?php echo $row['date'];?></time>
                    <span><a href="#"><?php echo $row['tag'];?></a></span>
                    <span><a href="#"><?php echo $row['writer'];?></a></span>
                    <div id="content">
                        <img class="img-responsive center-block" src="img/<?php echo $row['pic'];?>" alt="" style="width: 1000px;height: 300px">
                        <p class="text-center">
                            <?php echo $row['content'];?>
                        </p>
                    </div>
                </footer>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div>
                <hr>
                <h2 contenteditable="false">评论列表</h2>
                <hr>
                <?php
                    $sql1 = "select * from comment where carticle='$ID'";
                    $res1 = mysqli_query($link,$sql1);
                    while ($row1 = mysqli_fetch_array($res1)){
                      echo  '<h4 contenteditable="false" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.$row1["cuser"];
                      if(isset($_SESSION['admin'])){
                          echo "<a href='admin/deal/delcont.php?id=".$row1['cid']."&tid=".$ID."'>删除</a>";
                      }
                      echo '</h4>';
                      echo  '<p class="text-right"><time>'.$row1["cdate"].'</time></p>';
                      echo  '<p contenteditable="false">'.$row1["ccontent"].'</p>';
                      echo  '<hr>';
                    }
                ?>
                <form action="#" method="post">
                    <div class="form-group">
                        <h4 contenteditable="false">评论</h4>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">姓名</span>
                            <input type="text" class="form-control" name="user" placeholder="姓名" required aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">邮箱</span>
                            <input type="text" class="form-control" name="email" placeholder="邮箱" required aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <textarea  class="form-control" rows="3" name="content" required></textarea>
                    </div>
                    <P> </P>
                    <p class="text-center"><input type="submit" name="sub" class="btn btn-default" value="提交评论"></p>
                    </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="bootstrap/js/jquery.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if($_POST['sub']){
    $name = $_POST['user'];
    $email = $_POST['email'];
    $date = date('Y-m-d');
    $content = $_POST['content'];
    $ctitle = $row['title'];
    $article = $ID;
    $sql2 = "insert into comment (cuser,cemail,cdate,ctitle,carticle,ccontent) values ('$name','$email','$date','$ctitle','$article','$content')";
    mysqli_query($link,$sql2);

}
?>