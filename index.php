<?php
        session_start();
        if($_SESSION["login_state"]!=1)
        {
            header("Location:login.php");
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>biubiu新闻管理系统主页</title>
        <link href="index_layout.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        
        <div class="welcome">
            <text>欢迎您的到来,尊敬的:<?php echo $_SESSION["username"];?></text>
            
            <text id="exit_login"><a href="exit_login.php" >退出登录</a></text>&nbsp
            <text id="exit_login"><a href="news_main.php" >返回主页</a></text>
        </div>
        <div class="guide">
            <text><a href="index.php">我的新闻</a></text>
            <text><a href="add_news.php">添加新闻</a></text>
        </div>
        <div class="index_layout">
            <table>
            <tr>
              <th>新闻编号</th>
              <th>新闻标题</th>
              <th>发布单位</th>
              <th>发布时间</th>
              <th>发布人</th>
              <th>新闻类型</th>
              <th>操作</th>
            </tr>
            <?php
            require 'database.php';
            $user=$_SESSION["username"];
            if($user!="biubiu")
                $sql='select * from press where uname="'.$user.'"';
            else {
                $sql="select * from press;";
            }
            $res=db_found($sql);
            foreach ($res as $value) {
                $type=switch_type($value["cid"]);
                echo '<tr>';
                echo '<td>'.$value["pid"].'</td>';
                echo '<td>'.$value["ptitle"].'</td>';
                echo '<td>'.$value["pdepartment"].'</td>';
                echo '<td>'.$value["pdate"].'</td>';
                echo '<td>'.$value["uname"].'</td>';
                echo '<td>'.$type.'</td>';
                
                if($user=="biubiu"&&$value["pcheck"]==0)
                    echo '<td><a href="change_news?id='.$value["pid"].'">修改</a>&nbsp<a href="delete_news.php?id='.$value["pid"].'">删除</a>&nbsp<a href="check_news.php?pid='.$value["pid"].'">发布</a></td>';
                else if($user=="biubiu"&&$value["pcheck"]==1)
                    echo '<td><a href="change_news?id='.$value["pid"].'">修改</a>&nbsp<a href="delete_news.php?id='.$value["pid"].'">删除</a>&nbsp<a href="cancel_news.php?pid='.$value["pid"].'">取消发布</a></td>';
                else if($value["pcheck"]==1)
                    echo '<td><a href="change_news?id='.$value["pid"].'">修改</a>&nbsp&nbsp<a href="delete_news.php?id='.$value["pid"].'">删除</a>&nbsp<text id="text_success">已发布</text></td>';
                else
                    echo '<td><a href="change_news?id='.$value["pid"].'">修改</a>&nbsp&nbsp<a href="delete_news.php?id='.$value["pid"].'">删除</a>&nbsp<text id="text_check">审核中</text></td>';
                echo '</tr>';
            }
                ?>
        </div>
        
        </table>
    </body>
</html>
