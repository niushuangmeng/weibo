<?php
session_start();
require_once "../gonggong/fengzhuang/DBDA.class.php";//加载类
$uid= $_POST["uid"];  //name="uid"
$pwd = $_POST["pwd"];	//name="pwd"

$db = new DBDA();  //建立DBDA对象
$sql = "select password from user where username='{$uid}'";
$mm = $db->strquery($sql);  //返回一个二维数组

if($pwd == $mm){
	$_SESSION["uid"] = $uid;
	header("location:main.php");  //跳转页面
	}else
	{
	header("location:login.php");
	}