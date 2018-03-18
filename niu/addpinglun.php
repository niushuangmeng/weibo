<?php
session_start();
if(empty($_SESSION["uid"])){
	header("location:login.php");
	exit;
	}
$uid = $_SESSION["uid"];
$blogid = $_POST["blogid"];
$pinglun = $_POST["pinglun"];
if(!empty($pinglun)){
	include("../gonggong/fengzhuang/DBDA.class.php");
    $db = new DBDA();
    $sql = "insert into pinglun values(0,'{$blogid}','{$pinglun}','{$uid}',now())";
    $result = $db->query($sql,1);
	header("location:main.php");
	}else{
		header("location:main.php");
		}

