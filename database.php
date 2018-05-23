<?php

function db_link()
{
    $dbtype="mysql";
    $host="localhost";
    $dbname="news";
    $user="root";
    $pass="";
    $dbchoose="$dbtype:host=$host;dbname=$dbname";
    try{
        $db=new PDO($dbchoose,$user,$pass);
        $db->exec("set names utf8");
    }catch (PDOException $e){
        die('ERROR:'.$e->getMessage().'<br>');
        return null;
    }
    return $db;
}
function db_found($sql){
    $db= db_link();
    $stmt=$db->prepare($sql);
    $stmt->execute();
    $data=array();
    while($res=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        array_push($data, $res);
    }
    return $data;
}
function db_found_main(){
    $sql="select * from press where pcheck=1  ORDER BY pid DESC limit 10;";
    $db= db_link();
    $stmt=$db->prepare($sql);
    $stmt->execute();
    $data=array();
    while($res=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        array_push($data, $res);
    }
    return $data;
}
function db_found_hot5(){
    $sql = "select * from press where pcheck=1 ORDER BY browse DESC limit 5;";
    return db_found($sql);
}
function db_insert($sql){
    $db= db_link();
    $stmt=$db->prepare($sql);
    $res=$stmt->execute();
    if($res)
    {
        echo '插入成功<br>';
    }
    else
        '插入失败<br>';
}
function db_insert_user($sql){
    $db= db_link();
    $stmt=$db->prepare($sql);
    $res=$stmt->execute();
    if($res)
    {
        return 1;
    }
    else
        return 0;
}
function db_update($sql){
    $db= db_link();
    $stmt=$db->prepare($sql);
    $num=$stmt->execute();
    if($num)  return 1;
    else     return 0;
}

function db_login($email,$pass){
    $sql='select uname from user where email="'.$email.'" and upassword="'.$pass.'";';
    echo $sql;
    return db_found($sql);
}
function db_addbrowse($id){
    $sql="select browse from press where pid=$id";
    $res= db_found($sql);
    $num=$res[0]["browse"]+1;
    $sql='UPDATE press SET browse='.$num.' where pid='.$id.';';
    return db_update($sql);
}
function check_the_register($email,$password,$username){
    $mode_email='/^[a-zA-Z\d]{1}[a-zA-Z\d]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+[a-zA-Z]{2,3}$/';
    $mode_password='/[a-zA-Z\d]{6,18}/';  
    if(preg_match($mode_email,$email))
    {
        if(preg_match($mode_password, $password))
        {
            $sql='select * from user where email='.$email;
            $res= db_found($sql);
            if($res==null)
            {
                $sql='select * from user where uname='.$username;
                $res= db_found($sql);
                if($res==null)
                {
                    $sql='INSERT INTO `user`(`uname`,`upassword`,`email`) VALUES("'.$username.'","'.$password.'","'.$email.'");';
                    $res= db_insert_user($sql);
                    if($res)
                        echo '注册成功，请返回登录<br>';
                    else
                        echo '注册失败，请联系管理员<br>';
                }
                else
                {
                    echo '用户名已存在，请使用其他用户名<br>';
                }
            }
            else
                echo '邮箱已被注册，请输入新的邮箱<br>';
        }
        else
        {
            echo '密码格式错误<br>';
        }
    }
    else
    {
        echo '邮箱格式错误<br>';
    }
}
function switch_type($id){
    switch($id)
    {
        case 1:
            return "时政";
            break;
        case 2:
            return "科教";
            break;
        case 3:
            return "经济";
            break;
        case 4:
            return "社会";
            break;
        case 5:
            return "娱乐";
            break;
        case 6:
            return "体育";
            break;
        case 7:
            return "军事";
            break;
        case 8:
            return "其他";
            break;
    }
}