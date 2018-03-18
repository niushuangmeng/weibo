<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册</title>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>
<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
	input{
		display:inline;	
	}
</style>
</head>

<body>
	<h2 align="center">修改密码</h2>
	<div style="width:500px; margin:auto">
			<form class="bs-example bs-example-form" role="form" action="pwdpost.php" method="post" onsubmit="return check()">
                <div class="input-group">
                    <span class="input-group-addon">&nbsp;用&nbsp;户&nbsp;名&nbsp;</span>
                    <input type="text" class="form-control" placeholder="请输入用户名" name="uid" id="uid">
                    
                </div>
               <span id="tips1"></span>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">&nbsp;密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;</span>
                    <input type="password" class="form-control" placeholder="请输入密码" id="pwd1" name="pwd">
                  	
                </div>
              <!--  <span id="tips2"></span>-->
                <br />
                <div class="input-group">
                    <span class="input-group-addon">确认密码</span>
                    <input type="password" class="form-control" placeholder="请再次输入密码" id="pwd2">
                   
                </div>
                 <!--<span id="tips3"></span>-->
                <br />
               
               		<button type="submit" class="btn btn-primary btn-lg btn-block" id="btn">确认修改</button>
               
        	</form>
	</div>
    
</body>
<script type="text/javascript">

    function check(){
		var uid = $("#uid").val();
		var pwd1 = $("#pwd1").val();
		var pwd2 = $("#pwd2").val();
		if(uid == null || uid == ""){
			alert("用户名不能为空");
			return false;
		}else if(pwd1 == null || pwd1 == ""){
			alert("密码不能为空");
		}else if(pwd1!=pwd2){
			alert("两次密码输入不一致");
		}
		return true;	
	}

	
	/*var code = Math.floor(Math.random()*9000)+1000;
alert(code);
*/
	
</script>
</html>