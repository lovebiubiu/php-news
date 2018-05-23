<?php
session_start();
if($_SESSION["login_state"]!=1)
{
    header("Location:login.php");
}
if(isset($_GET["id"]))
{
    require 'database.php';
    $id=$_GET["id"];
    $sql='delete from press where pid='.$id;
    $res=db_update($sql);
    if($res)
    {
       echo '<script type="text/javascript">
        alert("删除成功")
        window.location.href="index.php"
          </script>';
    }
    else 
    {
        echo '<script type="text/javascript">
          alert("删除失败，请联系管理员删除")
        window.location.href="index.php"
         </script>';
    }
}
