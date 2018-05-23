<?php 
session_start();
?>
    <head>
        <meta charset="UTF-8">
        <title>搜索结果</title>
        <?php
        require 'main_layout.php';
        main_top();
        ?>
    </head>
    <body>
        <?php
        require 'database.php';
        if(isset($_POST["sub"]))
        {
            $type=$_POST["searchlist"];
            $content=$_POST["content"];
            switch ($type){
                case 1:
                    $sql='select * from press where pcheck=1 and ptitle   like "%'.$content.'%"';
                    $res= db_found($sql);
                    if($res!=null)
                    {show_search_title($content);
                    show_news($res);}
                    else
                        show_search_none($content);
                    break;
                case 2:
                    $sql='select * from press where pcheck=1 and  uname like "%'.$content.'%"';
                    $res= db_found($sql);
                    if($res!=null){
                    show_search_title($content);
                    show_news($res);}
                    else
                        show_search_none($content);
                    break;
                case 3:
                    $sql='select * from press where pcheck=1 and pdepartment like "%'.$content.'%"';
                    $res= db_found($sql);
                    if($res!=null){
                    show_search_title($content);
                    show_news($res);}
                    else
                        show_search_none($content);
                    break;
            }
        }
        ?>
        <?php
        main_bottom();
        ?>
    </body>
</html>
