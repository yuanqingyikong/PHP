<?php
require_once '../dbconf.php';
$sql = "select * from article";
$res = mysqli_query($link,$sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>后台管理</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container" >

    <h3 class="text-center">控制面板</h3>


    <div class="tabbable" id="tabs-405846" style="margin-top: 50px;">
        <hr>
        <ul class="nav nav-tabs">
            <li  class="active">
                <a href="#panel-31603" data-toggle="tab">文章</a>
            </li>
            <li>
                <a href="#panel-279457" data-toggle="tab">评论</a>
            </li>
            <li>
                <a href="#panel-279460" data-toggle="tab">用户</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="panel-31603">

                <h4><a href="add_article.php">发布</a></h4>
                <hr>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            标题
                        </th>
                        <th>
                            作者
                        </th>
                        <th>
                            标签
                        </th>
                        <th>
                            发表时间
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($res)){
                        echo "<tr>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['writer']."</td>";
                        echo "<td>".$row['tag']."</td>";
                        echo "<td>".$row['date']."</td>";
                        echo '<td><a href="rewrite.php?id='.$row["tid"].'">修改</a><a href="dela.php?id='.$row["tid"].'">删除</a></td>';
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="panel-279457">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            评论者
                        </th>
                        <th>
                            评论时间
                        </th>
                        <th>
                            评论地点
                        </th>
                        <th>
                            评论内容
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql1 = "select * from comment";
                    $res1 = mysqli_query($link,$sql1);
                    while ($row1 = mysqli_fetch_array($res1)){
                        echo "<tr>";
                        echo "<td>".$row1['cuser']."</td>";
                        echo "<td>".$row1['cdate']."</td>";
                        echo "<td>".$row1['ctitle']."</td>";
                        echo "<td>".$row1['ccontent']."</td>";
                        echo '<td><a href="deal/delcont.php?id='.$row1["cid"].'">删除</a></td>';
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="panel-279460">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            用户
                        </th>
                        <th>
                            密码
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql2 = "select * from user";
                    $res2 = mysqli_query($link,$sql2);
                    while ($row2 = mysqli_fetch_array($res2)){
                        echo "<tr>";
                        echo "<td>".$row2['uname']."</td>";
                        echo "<td>".$row2['upass']."</td>";
                        echo '<td><a href="deal/rw_user.php?id='.$row2["uid"].'">修改</a></td>';
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="../bootstrap/js/jquery.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>