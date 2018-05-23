<?php
session_start();
if($_SESSION["login_state"]!=1)
{
    header("Location:login.php");
}
if(isset($_GET["pid"]))
{
    require 'database.php';
    $id=$_GET["pid"];
    $sql='UPDATE press set pcheck=1 where pid='.$id;
    $res=db_update($sql);
    if($res)
    {
        echo '<script type="text/javascript">
        alert("发布成功")
        window.location.href="index.php"
          </script>';
    }
    else
    {
        echo '<script type="text/javascript">
        alert("发布失败，请联系后台")
        window.location.href="index.php"
          </script>';  
    }
}
