<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once "../gonggong/fengzhuang/DBDA.class.php";
	
	
	//if(!empty($_POST["uid"])&&!empty($_POST["pwd"])){
	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	/*echo $uid;
	echo "<br />";
	echo $pwd;*/
	//}
	$db = new DBDA();
	$sql= "select count(*) from user where username='{$uid}'";
	$re = $db->query($sql);
	if($re[0][0]==1){
		echo "该用户名已存在，请重新注册";
		header("refresh:3;url=register.php");	
	
	}else{
		$sql = "insert into user values('{$uid}','{$pwd}')";
		if($db->query($sql,1)){
			echo "注册成功，三秒后跳转到登录页面";
			header("refresh:3;url=../niu/main.php");
		}
	}
	
	