<?php 
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>分类新闻</title>
        <?php
        require 'main_layout.php';
        main_top();
        ?>
    </head>
    <body>
        <?php
        if(isset($_GET["id"]))
        {            
           require 'database.php';
           $id=$_GET["id"];
           $sql='select * from press where pcheck=1 and press.cid='.$id ;
           $res=db_found($sql);
           if($res==null)
               echo '<div class="no_search"><text >没有搜索到该类别新闻<br></text></div>';
           else
           {
               show_news($res);
           }
        }
        ?>
         <?php
        main_bottom();
        ?>
    </body>
</html>
