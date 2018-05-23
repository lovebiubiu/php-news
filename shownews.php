<!DOCTYPE html>
<?php 
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新闻详情</title>
        <link href="shownews_layout.css" rel="stylesheet" type="text/css" />
        <?php 
            require 'main_layout.php';
            main_top();
            if(isset($_GET["id"]))
            {
                require 'database.php';
                $id=$_GET["id"];
                db_addbrowse($id);
            }
            else
                header("Location:news_main.php");
        ?>
    </head>
    <body>
        <div class="news_content">
      <?php 
                $sql='select * from press where pid='.$id;
                $res=db_found($sql);
                echo '<div class="news_title">'.$res[0]["ptitle"].'</div>';
                echo '<div class="news_info">';
                echo '<text id="info_layout">发布时间：'.$res[0]["pdate"].'</text>';
                echo '<text id="info_layout">发布人：'.$res[0]["uname"].'</text>';
                echo '<text id="info_layout">浏览次数：'.$res[0]["browse"].'</text></div>';
                echo '<img class="news_image" src="images/mysql_images/'.$res[0]["ppicture"].'"/>';
                echo '<div class="news_nr">'.$res[0]["pcontent"];
      ?>
            </div>
        <?php
                main_bottom();
        ?>
    </body>
</html>
