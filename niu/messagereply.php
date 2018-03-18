<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>回复</title>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>
<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<?php
	session_start();
	$uid = $_SESSION["uid"];
	$id = $_GET["uid"];
	$ids = $_GET["ids"];
	require "../gonggong/fengzhuang/DBDA.class.php";
	$db = new DBDA();
	$sql = "update message set isread=1 where ids={$ids}";
	$db->query($sql,1);
	$sql = "select content from message where ids={$ids}";
	$content = $db->strquery($sql);
	//echo $content;
?>
<body>

<!--导航栏-->
<nav class="navbar navbar-default" role="navigation" style="position:fixed;width:100%" >
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
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            1111
        </h3>
    </div>
    <div class="panel-body">
    	<textarea class="form-control" rows="3" disabled="disabled"><?php echo $content;?></textarea>
        <br />
        <button  id='send' type='button' class='btn btn-default'>回复</button>
    </div>
</div>
<div id="textbox" hidden>
  	<!--<form role="form" action="messagepost.php" method="post" onsubmit="return check()">-->
      <div class="form-group">
        <label for="name">回复<?php echo $id ?></label>
        <textarea class="form-control" rows="3" id="text" name="message"></textarea>
        <input type="hidden" value="<?php echo $id ?>" name="uidto" />
      </div>
      <input type="submit" class='btn btn-default' value="回复" />&nbsp;<button type="button" class='btn btn-default' id="hide">取消</button>
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
						alert("ok");	
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
</script>
</body>
</html>