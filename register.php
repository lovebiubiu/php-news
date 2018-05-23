<html>
    <head>
        
        <meta charset="UTF-8">
        <title>biubiu新闻管理系统登录</title>
        <link href="register.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="bg">
        <div class="welcome">
            <image src="images/web_images/news_icon.png" id="news_icon"></image>
            <text id="welcome_content">biubiu新闻管理系统欢迎您</text>
        </div>
        <div class="space_1">
            <text id="login">Register</text>
        </div>
        <div class="bg">
            <div class="layout_set">
                <div class="login_content">
                    <text id="login_title">注册</text>
                    <form action="register.php" method="post">
                        <div id="username">
                            <text>用户邮箱:</text><input type="text" name="email"  style="height: 30px;"/><br>

                        </div>
                        <div id="username">
                            <text>用户名:</text><input type="text" name="user"  style="float: right;height: 30px;"/><br>

                        </div>
                        <div id="password">
                            <text>密码:</text><input type="password" name="password"  style="float:right; height: 30px;"/><br>

                        </div>
                        <div id="login_button">
                            <input type="submit" name="register" value="注册" id="button_sty"/>  
                            <button id="button_sty"><a href="login.php" >返回登录</a></button>
                        </div>
                                
                    </form>
                </div>
                <div class="about_content">
                    <h2>注意:</h2>
                    <text id="about">用户邮箱应为邮箱地址</text><br>
                    <text id="about">密码长度为6-18，不含特殊符号</text><br>
                    <?php
                    require 'database.php';
                    if(isset($_POST["register"]))
                    {
                        $email=$_POST["email"];
                        $password=$_POST["password"];
                        $username=$_POST["user"];
                        check_the_register($email, $password, $username);
                    }
                    
                    ?>
                </div>
                
            </div>
        </div>
        
        <div class="space_2">
            
        </div>
        </div>
    </body>
</html>
