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
$user1 = $_SESSION["uid"];
?>
<body style="background-color:#b4daf0">
<!--导航栏-->
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="main.php">微博</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li><a href="wodebokemain.php">博客</a></li>
            <li><a href="guanzhuderen.php">关注的人</a></li>
             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo $user1  ?>
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
        <div class="form-group">
            <input type="text" class="form-control" name="haoyou" placeholder="查找好友">
            
        </div>
        <button type="submit" class="btn btn-default" >提交</button>
       <!-- <span id="tishi"></span>-->
    </form>
    </div>
</nav>

<table class="table">
  <caption>用户信息</caption>
  <thead>
    <tr>
      <th>用户名</th>
      <th>姓名</th>
      <th>性别</th>
      <th>生日</th>
	   <th>操作</th>  	       
    </tr>
  </thead>
<?php

include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$username = $_POST["haoyou"];
if(empty($_POST["haoyou"])){
	header("location:main.php");
	exit;}
//查询用户名
$sql = "select username from user where username = '{$username}'";
$attr = $db->strquery($sql);
//var_dump($attr);

if($attr==$username)
{
	//查询用户信息
$sql = "select * from info where username = '{$username}'";
$attr1 = $db->Query($sql);
	//var_dump($attr1);
	echo "
	<tbody>
    <tr>
      <td id='username'><a href='haoyouboke.php?uid={$attr1[0][0]}'>{$attr1[0][0]}</a></td>
      <td>{$attr1[0][1]}</td>
	  <td>{$attr1[0][2]}</td>
	  <td>{$attr1[0][3]}</td>    
  ";
  //查询用户关注的人数
   $db = new DBDA();
   $sql = "select count(*) from friendship where user1 ='{$user1}'";
   $result = $db->strquery($sql);
    //如果用户没有关注好友，输出关注
   if($result==0){
	   echo "
	   <td id='huan'>
	   	<button type='button' class='btn btn-default' id='guanzhu' >关注</button>
		<button  id='send' type='button' class='btn btn-default'>发私信</button>
	   </td>";
	   }else
	   {
		   //查询用户的关注列表
           $sql = "select user2 from friendship where user1 ='{$user1}'";
           $arr = $db->Query($sql);
		 //  var_dump($arr);
		
			    //如果查找的在关注列表里，输出取消关注
			if(deep_in_array($username, $arr)){
				 echo "
				 <td id='huan'>
				 	<button  id='quxiao' type='button' class='btn btn-default' >取消关注</button>
					<button  id='send' type='button' class='btn btn-default'>发私信</button>
				 </td>";
				}else{
		            //如果查找的不在关注列表里，输出关注
				 echo "
				 <td id='huan'>
				 	<button  id='guanzhu' type='button' class='btn btn-default'  >关注</button>
					<button  id='send' type='button' class='btn btn-default'>发私信</button>
				 </td>";
					}; 
		   }
		  
}
else
{
	header("location:main.php");
}

function deep_in_array($value, $array) {   
    foreach($array as $item) {   
        if(!is_array($item)) {   
            if ($item == $value) {  
                return true;  
            } else {  
                continue;   
            }  
        }   
            
        if(in_array($value, $item)) {  
            return true;      
        } else if(deep_in_array($value, $item)) {  
            return true;      
        }  
    }   
    return false;   
} 
?>
  </tbody>
  </table>
  <div id="textbox" hidden>
  	<!--<form role="form" action="messagepost.php" method="post" onsubmit="return check()">-->
      <div class="form-group">
        <label for="name">私信</label>
        <textarea class="form-control" rows="3" id="text" name="message"></textarea>
        <input type="hidden" value="<?php echo $username ?>" name="uidto" />
      </div>
      <input type="submit" class='btn btn-default' value="发送" />&nbsp;<button type="button" class='btn btn-default' id="hide">取消</button>
	<!--</form>-->
    
  </div>
<script type="text/javascript">
	$(document).ready(function(e) {
		$("input[type='submit']").click(function(){
			$("#textbox").attr("hidden","hidden");
			var uidto = $("input[type='hidden']").val();
			var message = $("#text").val();
			$.ajax({
				url:"messagepost.php",
				type:"POST",
				data:{
					uidto:uidto,
					message:message	
					},
				dataType:"TEXT",
				success: function(data){
					if(data==1){
						alert("发送成功");	
					}else{
						alert("未知错误");	
					}	
				}
			})
		})
    });
$("#send").click(function(){
	$("#textbox").removeAttr("hidden");	
})

	
	function check(){
		var text = $("#text").val();
		if(text == null || text == ""){
			return false;	
		}else{
			return true;	
		}
			
	}
</script>
</body>
<script type="text/javascript">
$(document).ready(function(){

$("#quxiao").click(function(){
	var user = $("#username").text();
	//alert("quxiaoguanzhu");
	//取发表内容
	$.ajax({
		url:"quxiaoguanzhu.php", //处理页面的路径
		data:{user:user}, //要提交的数据
		type:"POST", //提交方式
		//dataType:"TEXT", //返回数据类型
		success:function(data){
			location.reload(true);
			//$("#huan").html("<button  id='guanzhu' type='button' class='btn btn-default'>关注</button>");
			//alert(data);
			//$("#quxiao").text("关注"); 
			//$("#quxiao").attr("id","guanzhu");
			//alert("发布成功！");	
			} //回调函数
		});
	})

//关注
$("#guanzhu").click(function(){
	var user = $("#username").text();
	//alert("guanzhu");
	//取发表内容
	$.ajax({
		url:"addguanzhu.php", //处理页面的路径
		data:{user:user}, //要提交的数据
		type:"POST", //提交方式
		//dataType:"TEXT", //返回数据类型
		success:function(data){
			location.reload(true);
			//alert();
			//$("#huan").html("<button id='quxiao' type='button' class='btn btn-default' >取消关注</button>");
			//alert($("#guanzhu").html()); 
			//$("#guanzhu").attr("id","quxiao");
			//alert(data);
			//$("#guanzhu").text("取消关注"); 
			//$("#guanzhu").attr("id","quxiao");
			//alert("发布成功！");	
			} //回调函数
		});
	})


})

</script>

</html>