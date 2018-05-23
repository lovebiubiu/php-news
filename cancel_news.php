<?php
session_start();
if($_SESSION["login_state"]!=1)
{
    header("Location:login.php");
}
require 'database.php';
if(isset($_GET["pid"]))
{
    $id=$_GET["pid"];
    $sql='UPDATE press set pcheck=0 where pid='.$id;
    $res=db_update($sql);
    if($res)
    {
         echo '<script type="text/javascript">
        alert("取消成功")
        window.location.href="index.php"
          </script>';
    }
    else
    {
        echo '<script type="text/javascript">
        alert("取消失败，请联系后台")
        window.location.href="index.php"
          </script>';
    }
}

