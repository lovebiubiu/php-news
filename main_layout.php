<?php
function main_top(){
    echo '<link href="main_layout.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
          $("#search_content").focus(function(){
            $("#search_content").css("background-color","#FFFFCC");
          });
          $("#search_content").blur(function(){
            $("#search_content").css("background-color","#D6D6FF");
          });
           $("#map_show").focus(function(){
             $("#map").css("visibility","visible");
          });
          $("#map").blur(function(){
            $("#map").css("visibility","hidden");
          });

        });
        </script>
      <div id="map">
      <text>网站导航</text><hr>
      <a href="news_main.php">首页</a>
      <a href="change_type.php?id=1">时政</a>
      <a href="change_type.php?id=2">科教</a>
      <a href="change_type.php?id=3">经济</a>
      <a href="change_type.php?id=4">社会</a>
      <a href="change_type.php?id=5">娱乐</a>
      <a href="change_type.php?id=6">体育</a>
      <a href="change_type.php?id=7">军事</a>
      <a href="change_type.php?id=8">其他</a>
      </div>
    <div class="top_layout">
        <div class="login_layout">
            <div class="login_left">
                <a href="news_main.php">biubiu新闻网首页</a>
                <a href="#" id="map_show">网站地图</a>
                <a href="#">帮助</a>
            </div>
            <div class="login_right">
                ';
                if($_SESSION)
                {
                    echo '<text>欢迎您,尊敬的:'.$_SESSION["username"].'&nbsp&nbsp</text>';
                    echo '<a href="index.php" >管理我的新闻&nbsp&nbsp</a>';
                    echo '<a href="exit_login.php">退出登录</a>';
                }
                else
                {
                    echo '<text>您还没有登录,请<a href="login.php">登录</a></text>';
                }
                echo '
            </div>
            
        </div>
        <div class="login_title">
            <img src="images/web_images/title_logo.png" />
            <text>biubiu新闻网</text>
        </div>
        <div class="search">
            <form action="search_res.php" method="post" id="search_list">
                <input type="text" name="content" id="search_content"/>
                <input type="submit" name="sub" id="search_button" value=""/>
            </form>
            <select name="searchlist" form="search_list" id="select_layout">
                <option value="1">按标题搜索</option>
                <option value="2">按发布人</option>
                <option value="3">按发布单位</option>
            </select> 
            
        </div>
        <div class="guide">
            <ul>
                <li><a href="news_main.php">首页</a></li>
                <li><a href="change_type.php?id=1">时政</a></li>
                <li><a href="change_type.php?id=2">科教</a></li>
                <li><a href="change_type.php?id=3">经济</a></li>
                <li><a href="change_type.php?id=4">社会</a></li>
                <li><a href="change_type.php?id=5">娱乐</a></li>
                <li><a href="change_type.php?id=6">体育</a></li>
                <li><a href="change_type.php?id=7">军事</a></li>
                <li><a href="change_type.php?id=8">其他</a></li>
            </ul>
        </div>
    </div>';
}

function main_bottom(){
    echo '
        <div class="bottom_layout">
            <div>
                <text>关于biubiu</text>|<text>隐私政策</text>|<text>广告服务</text>|<text>举报中心</text>|<text>网站导航</text><br>
            </div>
            <div>
                <text>ICP备案号：京ICP备18021476号-1</text><br>
            </div>
            <div>
                <text>biubiu个人 版权所有</text>
            </div>
            
        </div>
    ';
}

function show_search_title($content){
    echo '<div class="res_title">
            <text>关于搜索“'.$content.'”的结果：</text>
            </div>';
}
function show_search_none($content){
    echo '<div class="res_none">
            <text>没有搜索到关于“'.$content.'”的结果：</text>
            </div>';
}
function show_news($res){
    
    echo '<div class="show_news">
        ';foreach($res as $value){
           echo ' 
            <div class="news_item">
            <a href="shownews.php?id='.$value["pid"].'">'.$value["ptitle"].'</a><text>浏览次数:'.$value["browse"].'</text>
            </div>
             ';
        }
        echo '
    
    </div>';
}