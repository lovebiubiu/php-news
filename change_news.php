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
        <title>修改新闻</title>
    </head>
    <body>
        <?php 
        require 'database.php';
        if(isset($_GET["id"]))
        {
            $id=$_GET["id"];
            $sql='select * from press where pid='.$id;
            $res=db_found($sql);
            if(!$res)
                header ("Location:index.php");
        }
        else
        {
            header("Location:index.php");
        }
        ?>
        <h1 align="center">新闻发布</h1>
        <form action="" method="post" align="center" enctype="multipart/form-data" id="add_form">
            新闻标题：<input type="text" name="title" value="<?php echo $res[0]["ptitle"];?>"><br>
            发布单位：<input type="text" name="fbdw" value="<?php echo $res[0]["pdepartment"];?>"><br>
        发布人：<input type="text" name="fbr" readonly="true" value="<?php echo $res[0]["uname"];?>"><br>
        发布日期：<input type="text" name="fbrq" readonly="true" value="<?php echo $res[0]["pdate"]; ?>"><br>
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
                    新闻内容：<br><textarea  name="nr" style="width: 300px ;height: 200px;"><?php echo $res[0]["pcontent"]?></textarea><br>
        上传图片<input type="file" name="file" id="upload"><br>
        <input type="submit" name="sure" value="提交" ><br>
        <button><a href="index.php" >转到新闻目录</a></button>
        <form>
        <?php
            if(isset($_POST["sure"]))
            {
                $title=$_POST["title"];
                $department=$_POST["fbdw"];
                $uname=$_POST["fbr"];
                $fbdate=$_POST["fbrq"];
                $selection=$_POST["selectlist"];
                $content=$_POST["nr"];
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
                        $imgname=$res[0]["ppicture"];
                        move_uploaded_file($_FILES["file"]["tmp_name"], 'images/mysql_images/'.$imgname.'');
                        $sql='update press set ptitle="'.$title.'" pcontent="'.$content.'" pdepartment="'.$department.'" cid="'.$selection.'" ppicture="'.$imgname.'" where pid='.$id.';';
                    }
                    else{
                        echo '上传失败，图片必须为jpg,gif,png其中一类<br>';
                    }   
                }
                else
                    $sql='UPDATE `press` SET ptitle="'.$title.'", pcontent="'.$content.'", pdepartment="'.$department.'", cid="'.$selection.'" where pid='.$id.';';
                if(db_update($sql))
                    echo '修改成功<br>';
                else
                {
                    echo $sql;
                    echo '修改失败<br>';
                }
            }
        ?>
    </body>
</html>
