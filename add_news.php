<!DOCTYPE html>
<?php 
session_start();
if($_SESSION["login_state"]!=1)
{
    header("Location:login.php");
}
$time=date("Y-m-d H:i",time());
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>添加新闻</title>
        <?php
        
        ?>
    </head>
    <body>
        <h1 align="center">新闻发布</h1>
        <form action="add_news.php" method="post" align="center" enctype="multipart/form-data" id="add_form">
        新闻标题：<input type="text" name="title"><br>
        发布单位：<input type="text" name="fbdw"><br>
        发布人：<input type="text" name="fbr" readonly="true" value="<?php echo $_SESSION["username"]?>"><br>
        发布日期：<input type="text" name="fbrq" readonly="true" value="<?php echo $time; ?>"><br>
        新闻类别：  <select name="selectlist" form="add_form">
                        <option value="1">时政</option>
                        <option value="2">科教</option>
                        <option value="3">经济</option>
                        <option value="4">社会</option>
                        <option value="5">娱乐</option>
                        <option value="6">体育</option>
                        <option value="7">军事</option>
                        <option value="8">其他</option>
                    </select> <br>
        新闻内容：<br><textarea  name="nr" style="width: 300px ;height: 200px;"></textarea><br>
                    
        上传图片<input type="file" name="file" id="upload"><br>
        <input type="submit" name="sure" value="提交" id="navigator"><br>
        <button id="navigator"><a href="index.php" >转到新闻目录</a></button>
        <form>
        <?php
            require 'database.php';
            function gettime()
            {
               $time=date("Y-m-d H:i",time());
               return $time;
            }
            if(isset($_POST["sure"]))
            {
                if(!empty($_FILES["file"]["tmp_name"]))
                {
                    if($_FILES["file"]["error"]>0)
                    {
                        echo '图片上传出错'.$_FILES["file"]["error"].'<br>';
                    }
                    else if($_FILES["file"]["size"]>2000000)
                    {
                        echo '上传失败，图片不得大于2M<br>';
                    }
                    else if($_FILES["file"]["type"]=="image/gif"||$_FILES["file"]["type"] == "image/jpeg"||$_FILES["file"]["type"] == "image/pjpeg"||$_FILES["file"]["type"] == "image/png")
                    {
                        echo '图片格式正确<br>';
                        $sql="select count(pid) as sum from press";
                        $res= db_found($sql);
                        if($res==null)
                            $imgname='img1';
                        else
                            $imgname='img'.($res[0]["sum"]+1);
                        move_uploaded_file($_FILES["file"]["tmp_name"], 'images/mysql_images/'.$imgname.'');
                    }
                    else{
                        echo '上传失败，图片必须为jpg,gif,png其中一类<br>';
                    }   
                }
                else
                {
                    $imgname="noimg.png";
                }
                $title=$_POST["title"];
                $department=$_POST["fbdw"];
                $uname=$_POST["fbr"];
                $fbdate=$_POST["fbrq"];
                $selection=$_POST["selectlist"];
                $content=$_POST["nr"];
                $content= nl2br($content);
                $sql='insert into press(ptitle,pcontent,pdepartment,pdate,ppicture,uname,cid) values(\''.$_POST["title"].'\',\''.$_POST["nr"].'\',\''.$_POST["fbdw"].'\',\''. gettime().'\',\''.$imgname.'\',\''.$_POST["fbr"].'\','.$_POST["selectlist"].');';
                db_insert($sql);
                
            }
            
        ?>
    </body>
</html>
