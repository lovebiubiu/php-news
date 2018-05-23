        <?php
        session_start();
        ?>
<html>
    <head>

        <meta charset="UTF-8">
        <title>biubiu新闻管理系统登录</title>
        <link href="login_layout.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="bg">
        <div class="welcome">
            <image src="images/web_images/news_icon.png" id="news_icon"></image>
            <text id="welcome_content">biubiu新闻管理系统欢迎您</text>
        </div>
        <div class="return_main">
            <img src="images/web_images/right_arrow.png"/>
            <a href="news_main.php">返回新闻首页</a>
        </div>
            
        <div class="space_1">
            <text id="login">Login</text>
        </div>
        <div class="bg">
            <div class="layout_set">
                <div class="login_content">
                    <text id="login_title">登录新闻系统</text>
                    <form action="login.php" method="post">
                        <div id="username">
                            <text>用户邮箱:</text><input type="text" name="useremail" style="height: 27px;"/><br>
                        </div>
                        <div id="password">
                            <text>密码:</text><input type="password" name="password" style="height: 27px; float:right;"/><br>
                        </div>
                        <div id="login_button">
                            <text id="forget_psw"><a href="forget_pswd.php">忘记密码</a></text>
                            <input type="submit" name="login" value="登录" id="button_sty"/>
                        </div>
                    </form>
                </div>
                <div class="register">
                    <text>还不是会员？立即<a href="register.php" style="color:#4682B4">注册</a></text><hr>
                    
                    <text id="member_info">成为会员，可以立即发布新闻，并可随时修改自己添加的新闻</text>
                    
                </div>
            </div>
        </div>
            <div class="space_2">

            </div>
        </div>
        <?php
        require 'database.php';
            if(isset($_POST["login"]))
            {
                $email=$_POST["useremail"];
                $password=$_POST["password"];
                $res=db_login($email,$password);
                if($res!=null)
                {
                    echo '登录成功<br>';
                    $_SESSION["username"]=$res[0]["uname"];
                    $_SESSION["login_state"]=1;
                    header("Location:index.php");
                }
                else {
                        echo '<script type="text/javascript">';
                        echo '  alert("用户名或密码错误，请重新登录")';
                        echo '   </script>';
                }
            }
            
        ?>
    </body>
</html>
