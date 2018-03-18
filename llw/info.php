<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人信息</title>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>
<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/cropbox.js"></script>
</head>
<?php
	session_start();
	$uid = $_SESSION["uid"];
	?>
<body>
<!--导航栏-->
<nav class="navbar navbar-default" role="navigation" style="width:100%" >
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="../niu/main.php">微博</a>
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
                        <a href="../niu/message.php">
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

<?php

	if(empty($_SESSION["uid"])){
		echo "<h2>请先登录，三秒后跳转到登录页面</h2>";
		header("refresh:3;url=login.php");
		exit;	
	}
	
	require "../gonggong/fengzhuang/DBDA.class.php";
	$db = new DBDA();
	$sql = "select * from info where username='{$uid}'";
	$arr = $db->query($sql);
	$sel ="";
	if(empty($arr)){
	
		@$name = "";
		@$sex = "";
		@$pacode = "";
		@$date = "";
		@$jdfname = "";	
	}
	foreach($arr as $v){
		$name = $v[1];
		$sex = $v[2];
		$date= $v[3];
		$pacode  = $v[4];	
		$_SESSION["pic"] =$v[5];	
	}
	//echo $_SESSION['pic'];
	
?>
<div style="width:350px; margin:100px auto">
	<h3 align="center">个人信息</h3>
    <form class="bs-example bs-example-form" role="form" method="post" action="infopost.php" enctype="multipart/form-data">
    	
         <div class="input-group">
                <span class="input-group-addon">姓名</span>
                <input type="text" class="form-control" placeholder="请输入真实姓名" name="name" value="<?php echo $name ?>">
               
         </div>
         <br />
         <div class="input-group">
         <span class="input-group-addon">性别</span>
                <select class="form-control" id="sex" name="sex" >
                	<option value="">请选择</option>
                    <option value="1">男</option>
                    <option value="0">女</option>
                </select>
         </div>
         <br />
         <div class="input-group">
            <span class="input-group-addon">生日</span>
            <input type="date" class="form-control" name="date" value="<?php echo "$date" ?>"> 
         </div>
         <br />
         <div class="input-group">
            <span class="input-group-addon">&nbsp;&nbsp;省&nbsp;&nbsp;</span>
            <select id="sf" class="form-control">
            	<option selected value="">请选择</option>
            </select>
         </div>
         <br />
         <div class="input-group">
            <span class="input-group-addon">&nbsp;&nbsp;市&nbsp;&nbsp;</span>
            <select id="ds" class="form-control">
            	<option selected value="">请选择</option>
            </select>
         </div>
         <br />
         <div class="input-group">
            <span class="input-group-addon">&nbsp;&nbsp;区&nbsp;&nbsp;</span>	
            <select id="qx" class="form-control" name="pacode">
            	<option selected value="">请选择</option>
            </select>
         </div>
         <br />
         <div class="input-group">
           
         <div class="container" style="padding:0px">
  			<div class="imageBox">
                <div class="thumbBox"></div>
                <div class="spinner" style="display: none">Loading...</div>
            </div>
            <div class="action"> 
   <!--  <input type="file" id="pic" style=" width: 200px">-->
            <div class="new-contentarea tc"> <a href="javascript:void(0)" class="upload-img">
              <label for="upload-file">上传图像</label>
              </a>
              <input type="file" class="" name="pic" id="upload-file" />
            </div>
            <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
            <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
            <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
  		</div>
</div>
</div>



         <input type="submit" class="btn btn-primary btn-lg btn-block" id="btn" value="修改资料">
	</form>
</div>
</body>
<script type="text/javascript">
$(window).load(function() {
	var options =
	{
		thumbBox: '.thumbBox',
		spinner: '.spinner',
		imgSrc: '<?php if(empty($v[5])){echo "../gonggong/img/avatar.jpg";}else{echo "{$v[5]}";}?>'
	}
	var cropper = $('.imageBox').cropbox(options);
	$('#upload-file').on('change', function(){
		var reader = new FileReader();
		reader.onload = function(e) {
			//alert(e.target.result);{}
			options.imgSrc = e.target.result;
			cropper = $('.imageBox').cropbox(options);
		}
		reader.readAsDataURL(this.files[0]);
		this.files = [];
	})
	$('#btnCrop').on('click', function(){
		var img = cropper.getDataURL();
		$('.cropped').html('');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;border-radius:128px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');
	})
	$('#btnZoomIn').on('click', function(){
		cropper.zoomIn();
	})
	$('#btnZoomOut').on('click', function(){
		cropper.zoomOut();
	})
});



$(document).ready(function(e) {
	sex();
	//sf();
	//ds();
	//qx();
	region();
	
});
$("#sf").change(function(){
	ds();
	qx();
});
	$("#ds").change(function(){
		qx();	
	});
function sf(){
	var pacode = "0001";
	$.ajax({
		async:false,
		url:"sel.php",
		type:"POST",
		data:{pacode:pacode},
		dataType:"TEXT",
		success:function(data){
			var hang = data.split("|");
			var str = "";
			for(i=0;i<hang.length;i++){
				var lie = hang[i].split("^");
				str = str+"<option value='"+lie[0]+"'>"+lie[1]+"</option>"	
			} 
			var str0 = str+"<option selected value=''>请选择</option>"; 
			$("#sf").html(str0)
			
		}
	
	})
}
function ds(){
	var pacode = $("#sf").val();
	$.ajax({
		async:false,
		url:"sel.php",
		type:"POST",
		data:{pacode:pacode},
		dataType:"TEXT",
		success:function(data){
			var hang = data.split("|");
			var str = "";
			for(i=0;i<hang.length;i++){
				var lie = hang[i].split("^");
				str = str+"<option value='"+lie[0]+"'>"+lie[1]+"</option>"	
			} 
			var str0 = str+"<option selected value=''>请选择</option>";
			$("#ds").html(str0)
			
		}
	
	})
}
function qx(){
	var pacode = $("#ds").val();
	$.ajax({
		async:false,
		url:"sel.php",
		type:"POST",
		data:{pacode:pacode},
		dataType:"TEXT",
		success:function(data){
			var hang = data.split("|");
			var str = "";
			for(i=0;i<hang.length;i++){
				var lie = hang[i].split("^");
				str = str+"<option value='"+lie[0]+"'>"+lie[1]+"</option>"	
			} 
			var str0 = str+"<option selected value=''>请选择</option>";
	
			$("#qx").html(str0)
			
		}
	
	})
}

function sex(){
	//var sex = $().val();	
	$.ajax({
		url:"sex.php",
		//async:false,
		type:"POST",
		dataType:"TEXT",
		success: function(data){
			$("#sex option[value='']").removeAttr("selected");	
			$("#sex option[value='"+data+"']").attr("selected","selected");  
  
		}	
	})
}
function region(){
	$.ajax({
		url:"region.php",
		dataType:"TEXT"	,
		success: function(data){
			if(!data){
				
			}else{
				//sf();
			//alert (data);
				var str = data.split("|");
				sf();
				$("#sf option[value='']").removeAttr("selected");	
				$("#sf option[value='"+str[0]+"']").attr("selected","selected");
				
				ds();
				$("#ds option[value='']").removeAttr("selected");	
				$("#ds option[value='"+str[1]+"']").attr("selected","selected"); 
				qx();
				//alert(str[2]);
				$("#qx option[value='']").removeAttr("selected");	
				$("#qx option[value='"+str[2]+"']").attr("selected","selected");
			}
		}
	})	
}

</script>

</html>