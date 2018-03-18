<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require "../gonggong/fengzhuang/DBDA.class.php";
	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$db = new DBDA();
	$sql = "update user set password='{$pwd}' where username='{$uid}'";
	if($db->query($sql,1)){
		echo "修改成功，3秒后登录";
		header("refresh:3;url=login.php");	
	}else{echo "未知错误！";}