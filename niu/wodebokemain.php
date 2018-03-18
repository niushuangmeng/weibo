<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>

<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="test.css" rel="stylesheet" type="text/css" />
</head>
<?php
session_start();
$uid = $_SESSION["uid"];
?>
<body style="background:url(../gonggong/img/body_bg_page.jpg) no-repeat ;background-color:#b4daf0">
<!--导航栏-->
<nav class="navbar navbar-default" role="navigation" style="margin-bottom:0px;">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="main.php">微博</a>
    </div>
     <div >
        <ul class="nav navbar-nav" style="color:#CC3">
            <li><a href="wodebokemain.php">博客</a></li>
            <li><a href="guanzhuderen.php">关注的人</a></li>
            <li><a href="fensi.php">粉丝</a></li>
             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo $uid  ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                	 <li>
                        <a href="message.php">
                           消息
                        </a>
                    </li>
                    <li><a href="../llw/info.php">设置个人信息</a></li>
                    <li><a href="../llw/pwd.php">修改密码</a></li>
                    <li><a style="text-decoration:none;color:
   #000" href="logout.php">退出登录</a></li>
                </ul>
            </li>
        </ul>
    </div>
    
     <form class="navbar-form navbar-left" role="search" action="haoyouchuli2.php" method="post" >
        <div class="form-group" style="position:relative">
            <input type="text" class="form-control" name="haoyou" placeholder="查找">
            
        </div>
        <button type="submit" class="btn btn-default" >提交</button>
       <!-- <span id="tishi"></span>-->
    </form>
    </div>
</nav>
<div  style="height:auto;margin-top:28px">
<?php
if(empty($_SESSION["uid"])){
	header("location:login.php");
	exit;
	}
?>
<!--博客显示-->  
<?php

//查询好友微博
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$sql = "select * from blog where uid = '{$uid}' order by times desc";//查询关注者，查询关注者的微博
$arr = $db->query($sql);
//查询博主的头像
$sql = "select pic from info where username = '{$uid}'";
$result3 = $db->strquery($sql);
if(empty($result3)){
	$result3 = "../gonggong/img/avatar.jpg";
	}
//var_dump($arr);
echo "<div id='wai' style='margin-top:0px;'>";
foreach($arr as $v){ 
	echo "
	<div style='height:auto;'>
	<div id='wai2'>
<div id='touxiang'><img src='{$result3}' style='width:50px;height:50px' class='img-circle'/> </div>   
 <div id='neirong'>
        	<div id='bozhu'>{$v[1]}</div>
            <div id='shijian'>{$v[3]}</div>
            <div id='boke'>{$v[2]}</div>
        </div>
    </div>
	 <div id='wai21'>	
	<a href='./delete.weibo.php?id={$v[0]}' onclick=\"return confirm('确认删除么？')\"><button type='button' class='btn btn-default btn-sm' style='float:right;margin-right:5px'>删除</button></a>	
</div>
</div>
	<div style='background-color:#93c5e3;height:10px'></div>
";
	}
?>
</div>
</div>
<div id="gotop">  
    <img src="../llw/img/timg.jpg"/ alt="回到顶部图片" style="width:35px;height:35px;position:fixed; LEFT: 96%;bottom:2px;">  
</div>
</body>
<script>
$(document).ready(function(){  
    $("#gotop").hide();  
    $(function () {  
        //检测屏幕高度  
       
        //scroll() 方法为滚动事件  
        $(window).scroll(function(){  
            if ($(window).scrollTop()>0){  
                $("#gotop").fadeIn(500);  
            }else{  
                $("#gotop").fadeOut(500);  
                }  
        });  
        $("#gotop").click(function(){  
            $('body,html').animate({scrollTop:0},100);  
            return false;  
        });  
    });  
});  
</script>
</html>