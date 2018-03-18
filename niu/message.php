<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>消息</title>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>
<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
session_start();
if(empty($_SESSION["uid"])){
	header("location:../llw/login.php");
	exit;
	}
$uid = $_SESSION["uid"];
?>
<!--导航栏-->
<nav class="navbar navbar-default" role="navigation" width:100%" >
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


    <table class="table table-striped" style="width:100%;">
     
      <thead>
        <tr>
          <th>发送人</th>
           <th>内容</th>
          <th>发送时间</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php 
	/*	session_start();*/
		$to = $_SESSION["uid"];
		require "../gonggong/fengzhuang/DBDA.class.php";
		$sql = "select * from message where uidto='{$to}'";
		$db = new DBDA();
		$arr = $db->query($sql);
		 foreach($arr as $v){
			 if(strlen($v[3])>15){
				 $str = substr($v[3],0,15);
			 }else{
				$str = $v[3];
			 }
			 if($v[5]==0){
				$do = "<a href='messagereply.php?uid={$v[1]}&ids=$v[0]'><button type='button' class='btn btn-default' id='hide'>查看</button></a>";
			}else{
				$do = "<a href='messagedel.php?uid={$v[1]}&ids=$v[0]'><button type='button' class='btn btn-default' id='hide'>删除</button></a>";
			}
			echo "
				<tr>
				  <td>{$v[1]}</td>
				  <th>$str....</th>
				  <td>{$v[4]}</td>
				  <td>{$do}</td>
				</tr>
				
			";	 
		 }
?>
      </tbody>
    </table>

</body>
</html>