<?php
	
	session_start();
	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	require_once "../gonggong/fengzhuang/DBDA.class.php";
	$db = new DBDA();
	$sql = "select password from user where username='{$uid}'";
	$attr = $db->query($sql);
	$mm = $attr[0][0];
	if(!empty($pwd) && $pwd==$mm){
		header("location:../niu/main.php");
		$_SESSION["uid"]=$uid;	
	}else{
		echo "用户名或密码不正确";
		header("location:login.php");
		}