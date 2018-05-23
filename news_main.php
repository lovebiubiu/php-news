<!DOCTYPE html>
<?php 
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>biubiu新闻首页</title>
        <link href="news_main.css" rel="stylesheet" type="text/css" />
        <?php
        require 'main_layout.php';
        main_top();
        require 'database.php';
        $res_2= db_found_hot5();
        ?>
    </head>
    <body>
        <div class="content_layout">
            <div class="new_news">
                <div>
                    <img src="images/web_images/newthings.png" id="new_img"/>
                </div>
                <div class="news_content">
                <?php
                
                $res=db_found_main();
                $len=sizeof($res, 0);
                for($i=0;$i<$len;$i++)
                {
                    echo '<div class="news_item">'; 
                    echo '<img src="images/mysql_images/'.$res[$i]["ppicture"].'" id="news_image"/>';
                    echo '<a href="shownews.php?id='.$res[$i]["pid"].'" id="news_title">'.$res[$i]["ptitle"].'</a>';
                    echo '<text id="news_info">来源：'.$res[$i]["pdepartment"].'&nbsp时间：'.$res[$i]["pdate"].'&nbsp发布人：'.$res[$i]["uname"].'&nbsp浏览次数：'.$res[$i]["browse"].'</text>';
                    echo '</div>';
                }
                ?>
                </div>
                <?php
                main_bottom();
            ?>
            </div>
            
            <div class="rank_list">
                <div>
                    <img src="images/web_images/hot_things.png" id="rank_img"/>
                </div>
                <div class="hot_news">
                    <?php
                           $res=db_found_hot5();
                            foreach ($res as $value) {
                                echo '<div class="hot_news_content">';
                                echo '<a href="shownews.php?id='.$value["pid"].'">'.$value["ptitle"]."</a>";
                                echo '<text>浏览次数:'.$value["browse"].'</text>';
                                echo '</div>';
                            }
                    ?>
                </div>
            </div>
        </div>
        
    </body>
</html>
