<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>

<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<?php
session_start();
$uid = $_SESSION["uid"];
?>
<body>
<!--导航栏-->
<nav class="navbar navbar-default" role="navigation">
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
<table class="table">
  <thead>
    <tr>
      <th>关注的人</th>  
    </tr>
  </thead>
<?php
$uid = $_SESSION["uid"];
//查询好友微博
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$sql = "select * from friendship where user1='{$uid}'";//关注的人
$arr = $db->query($sql);
//var_dump($arr);
foreach($arr as $v){
	$guanzhuren = $v[2];
	//查询头像
$sql = "select pic from info where username = '{$guanzhuren}'";
$result3 = $db->strquery($sql);
	echo "<tr>
      <td><img src='{$result3}' style='width:50px;height:50px' class='img-circle'/>&nbsp;&nbsp;&nbsp;<span style='font-weight:700'>{$v[2]}</span></td> 
	 <td><a href='quxiaoguanzhu2.php?user={$v[2]}'><button type='button' class='btn btn-default' id='quxiao'>取消关注</button></a></td>
    </tr>";
	}
?>
</table>

<a class="btn btn-default" href="main.php" role="button">返回首页</a>
</body>
</html>