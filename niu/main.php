<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人主页</title>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>

<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="test.css" rel="stylesheet" type="text/css" />
<style>  
    #go_top{position:fixed; LEFT: 85%;bottom:50px;}  
 .navbar-nav:hover {
	 color:#eb7350;
	 }
	 .S_line1{
		 float:left;
		 width:65px;
		 text-align:center;
		 border-right-width:1px;
		 border-right-style:solid;
		 border-color:#d9d9d9;
		 height:33px;
		 
		 }
	strong{
		display:block;
		font-weight:bold;
		line-height:18px;
		font-size:18px;
		
		}
	.S_txt1{
		color:#333;
		}
	.S_txt2{
		color:#808080;
		}
	.headpic {
    width: 60px;
    height: 106px;
    padding: 3px;
    border-radius: 50%;
    bottom: -20px;
    left: 50%;
   }
    </style> 
</head>

<body style="background:url(../gonggong/img/body_bg_page.jpg) no-repeat ;background-color:#b4daf0">
<?php
session_start();
if(empty($_SESSION["uid"])){
	header("location:../llw/login.php");
	exit;
	}
$uid = $_SESSION["uid"];
include("../gonggong/fengzhuang/DBDA.class.php");

$db = new DBDA();
$sql = "select count(*) from friendship where user1='{$uid}'";//关注的人
$haoyoushu = $db->strquery($sql);
//var_dump($haoyoushu);
//查询用户发布的微博数量
$sql = "select count(*) from blog where uid = '{$uid}'";
$bokeshu = $db->strquery($sql);
//var_dump($bokeshu);
//查询粉丝数量
$sql = "select count(*) from friendship where user2 = '{$uid}'";
$fensishu = $db->strquery($sql);
//var_dump($fensishu);
//查询博主的头像
$sql = "select pic from info where username = '{$uid}'";
$touxiang = $db->strquery($sql);
if(empty($touxiang)){
	$touxiang = "../gonggong/img/avatar.jpg";
	}
	//未读信息查询
	$sql = "select count(*) from message where uidto='{$uid}' and isread = 0";
	
	$count = $db->strquery($sql);
?>
<!--导航栏-->
<nav class="navbar navbar-default" role="navigation" style="position:fixed;width:100%" >
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="main.php">微博</a>
    </div>
    <div >
        <ul class="nav navbar-nav" style="color:#CC3">
            <li><a href="wodebokemain.php">博客<span class='badge'><?php echo "{$bokeshu}"?></span></a></li>
            <li><a href="guanzhuderen.php">关注的人<span class='badge'><?php echo "{$haoyoushu}"?></span></a></li>
            <li><a href="fensi.php">粉丝<span class='badge'><?php echo "{$fensishu}"?></span></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo $uid  ?><span class="badge"><?php echo $count ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                	 <li>
                        <a href="message.php">
                            <span class="badge pull-right"><?php echo $count ?></span>消息
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
<!--表单  新增说说 ajax方法-->
<div id="wb_frame" style="">
 <div style="height:80px;"></div>
 <div style="height:200px">
 <div style="width:858px;height:200px;margin-left:362px;margin-bottom:20px">
 <div class="panel panel-default" style="width:600px;float:left;display:inline-block;">
    <div class="panel-body">
       <form role="form" action="addweibo.php" method="post" style="background-color:#FFF">
          <div class="form-group">
            <label for="name" style="color:#1b7fb6">有什么新鲜事告诉大家？</label>
            <textarea class="form-control" rows="3" name="textarea"></textarea>
            <br />    
            <button type="submit" class="btn btn-success"  style="background-color:#ffc09f;border-color:#ffc09f;margin-left:515px;" id="button" >发布</button>
          </div>
       </form> 
    </div>
   </div>
    <div style="margin-left:10px;width:230px;height:165px;background-color:#FFF;display:inline-block;">
    	<div style="width:230px;height:75px;background-image:url(../llw/img/2051_s.jpg);">
        	<div class="headpic"><img src="<?php echo "{$touxiang}" ?> "  style="width:60px;height:60px;margin-top:29px" class="img-circle"/></div>
        </div>
        <div style="width:230px;height:90px;padding:16px 16px 9px 16px;">
        	<div style="height:21px;padding-top:5px;line-height:16px;text-align:center;font-weight:bold"><?php echo "{$uid}"?>  </div>
            <ul style="height:34px;margin-top:10px!important;list-style:none;">
            	<li class="S_line1">
                	<a class="S_txt1" href="guanzhuderen.php" style="text-decoration:none"><strong><?php echo "{$haoyoushu}" ?></strong><span class="S_txt2">关注</span></a>
                </li>
                <li class="S_line1">
                	<a class="S_txt1" href="fensi.php" style="text-decoration:none"><strong><?php  echo "{$fensishu}" ?></strong><span class="S_txt2">粉丝</span></a>
                </li>
                <li class="S_line1">
                	<a class="S_txt1" href="wodebokemain.php" style="text-decoration:none"><strong><?php echo "{$bokeshu}"?></strong><span class="S_txt2">微博</span></a>
                 </li>
            </ul>
        </div>
    
    </div>
</div>

 </div>

<!--博客显示-->

<?php


//查询好友与自己的微博，按发表时间降序排序
$sql = "select * from blog where uid in (select user2 from friendship where user1='{$uid}') or uid = '{$uid}' order by times desc";//查询关注者，查询关注者的微博
$arr = $db->query($sql);
//var_dump($arr);
//查询关注的人数

foreach($arr as $v){
	
//判断是否已点赞
//1.没点赞
$sql = "select count(*) from zan where blogids='{$v[0]}'"; //查询博客点赞数
$result = $db->strquery($sql);
//查询博客评论数
$sql ="select count(*) from pinglun where blogids = '{$v[0]}'";
$result2 = $db->strquery($sql);
//查询博客评论
$sql ="select * from pinglun where blogids = '{$v[0]}'";
$arr2 = $db->query($sql);
//var_dump($arr2);
//查询给博客点赞的用户
$sql = "select uids from zan where blogids='{$v[0]}'";
$result1 = $db->query($sql);
//查询博主的头像
$sql = "select pic from info where username = '{$v[1]}'";
$result3 = $db->strquery($sql);
//var_dump($result3);
if(empty($result3)){
	$result3 = "../gonggong/img/avatar.jpg";
	}
echo "
<div id='wai' style='margin-left:362px'>
	<div id='wai2'>
<div id='touxiang'><img src='{$result3}' style='width:50px;height:50px' class='img-circle'/> </div>
 <div id='neirong'>
        	<div id='bozhu'>{$v[1]}</div>
            <div id='shijian'>{$v[3]}</div>
            <div id='boke'>{$v[2]}</div>
        </div>
    </div>
	 <div id='wai21'>
    	<ul id='lie'>
";
//var_dump($result);
//用户没对博客点赞也没有 select count(*) from zan where blogids='{$v[0]}';
if($result==0){  //如果点赞数为0，
	echo "
      <li class='line'><a  class='a_zan' href='zan.php?code={$v[0]}'>赞</a></li>
	  
   ";
	}		
	else{
		//var_dump($result1);
		//如果博客已有赞，判断是否是用户点赞
		if(deep_in_array($uid, $result1)){        //如果用户点赞,显示取消赞  
		echo "<li class='line'><a class='a_zan' href='quxiaozan.php?code={$v[0]}'>取消赞</a></li>
		
              ";	
		}else{ //如果用户未点赞,显示赞 
			echo "<li class='line'><a class='a_zan' href='zan.php?code={$v[0]}'>赞</a></li>";
		}			
		}	
	echo "
		 <li class='line'> 点赞数{$result}</li>
		 <li class='line pinglun'><a class='a_zan'>评论</a></li>   
		 <li class='line'><a class='a_zan' href='pinglunliebiao.php?code={$v[0]}'>查看评论{$result2}</a></li>
	  </ul>
    </div>	
</div>
	<div style='width:600px;height:auto;background-color:#f2f2f5;display:none;padding-top:10px'>
	<form role='form' action='addpinglun.php' method='post'>
  <div class='form-group' style='display:none;'>
    <label for='name'>文本框</label>
    <textarea class='form-control' rows='3' name='blogid'>{$v[0]}</textarea>
  </div>
 
  <div class='form-group' style='margin-top:10px;padding:0px 40px'>
  <img src='{$touxiang}' style='width:30px;height:30px;display:inline' />
    <textarea class='form-control' rows='3' name='pinglun' style='display:inline'></textarea>
  </div>
  <div style='height:50px'><button class='btn btn-default' type='submit' style='background:#ffc09f;color:#fff;border:1px solid #fbbd9e;float:right;margin-right:39px'>评论</button></div>
</form>

";
echo "<table  class='table' style='margin-left:0px'> <tbody>";
foreach($arr2 as $v){
	//查询评论人的图片
	$sql = "select pic from info where username = '{$v[3]}'";
    $result4 = $db->strquery($sql);
	echo "<tr>
<td><img src='{$result4}' style='width:30px;height:30px' />&nbsp;&nbsp;&nbsp;<span style=' color:#eb7350;font-size:12px;'>{$v[3]}</span>:<span style='font-size:12px'>{$v[2]}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:12px;color:#808080'>{$v[4]}</span></td></tr>
 ";

	}

echo "</tbody></table></div>";

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

<div id="gotop">  
    <img src="../llw/img/timg.jpg"/ alt="回到顶部图片" style="width:35px;height:35px;position:fixed; LEFT: 96%;bottom:2px;">  
</div>

</div>
</body>
<script type="text/javascript">
$("#pinglun").click(function(){
	//取发表内容
	var content = $("#content").text();
	//取博客代号
	alert($("#button").attr("value"));
	//alert(content);
	$.ajax({
		url:"addweibo.php", //处理页面的路径
		data:{content:content}, //要提交的数据
		type:"POST", //提交方式
		//dataType:"TEXT", //返回数据类型
		success:function(data){
			$("#textarea").val(""); 
			alert("发布成功！");
			} //回调函数
		});
	
	})

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

var menu = document.getElementsByClassName("pinglun");
for(var i=0;i<menu.length;i++){
	menu[i].onclick = function(){
		if(this.parentNode.parentNode.parentNode.nextElementSibling.style.display == "none"){
			this.parentNode.parentNode.parentNode.nextElementSibling.style.display = "block";
			}else{
				this.parentNode.parentNode.parentNode.nextElementSibling.style.display = "none"
				}
		
		//alert(this.parentNode.parentNode.nextSibling);
		//console.log(this.parentNode.parentNode.parentNode.nextElementSibling);
	}
}
/*for(var i=0;i<menu.length;i++){
	menu[i].onclick = function(){
		
	}
}*/
	//查询好友，不存在时
/*$("#haoyou").blur(function(){
		//取用户名
		var uid = $(this).val();
		//查数据库,调ajax
		//alert(uid);
		$.ajax({
				url: "haoyouchuli.php",//处理页面的地址
				data:{u:uid}, //要传递的数据（提交）
				type:"POST", //提交方式`
				dataType:"TEXT", //返回数据格式
				success:function(data){ //回调函数
						var str = "";
						//alert(data.trim());
						if(data.trim()=="NO")
						{
							str = "该用户名不存在";
							$("#tishi").css("color","red");
						}
						else
						{
							str = "该用户名已存在";
							$("#tishi").css("color","green");
						}
						$("#tishi").text(str);
					}
			});
	})
*/
</script>
</html>